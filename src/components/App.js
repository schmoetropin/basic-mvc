import React from 'react';
import {Route, BrowserRouter, Routes} from 'react-router-dom';
import Home from './pages/Home';
import AddProduct from './pages/AddProduct';
import NotFound from './pages/NotFound';
import Footer from './Footer';

//const API = 'http://marcospaulopeters-scandiwebjrtest.epizy.com/api/api.php';
// Thats where i put the api in my machine
const API = 'http://127.0.0.1/workspace/scandiweb-jr-web/src/api/api.php';

export default class App extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            products:[]
        }
    }

    componentDidMount(){
        this.getProducts();
    }

    // Send a form to api to add a new product
    saveProduct = (form) => {
        let DivError = document.getElementById('divError');
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = () => {
            if (xml.status === 200 && xml.readyState === 4) {
                let resp = xml.responseText.split('.');
                if (xml.responseText) {
                    if (resp.includes('Product created')) {
                        window.location.href ='/';
                    } else {
                        resp = resp.join('<br/>');
                        DivError.innerHTML = resp;
                        DivError.classList.add('errorMessage');
                    }
                }
            }
        }
        xml.open('POST',API);
        xml.send(form);
    }

    // Send a form to api to display all products
    getProducts = () => {
        let fd = new FormData();
        fd.append('displayProducts', 1);
        fetch(API, {
            method: 'POST',
            body:fd
        })
        .then(resp => resp.json())
        .then(respJson => {
            this.setState({products:respJson});
        });
    }

    // Send a form to api to delete selected products
    deleteData = (data) => {
        fetch(API,{
            method: 'POST',
            body: data
        })
        .then(resp => {
            this.getProducts();
        });
    }

    render(){
        return (
            <BrowserRouter>
                <Routes>
                    <Route 
                        path='/' 
                        element={<Home 
                            products={this.state.products} 
                            deleteData={this.deleteData.bind(this)}
                            title={'Product List'}
                        />} 
                    />
                    <Route 
                        path='/add-product'
                        element={<AddProduct
                            saveProduct={this.saveProduct.bind(this)}
                            title={'Product Add'}
                        />} 
                    />
                    <Route path='*' element={<NotFound/>} />
                    </Routes>
                <Footer/>
            </BrowserRouter>
        );
    }
}