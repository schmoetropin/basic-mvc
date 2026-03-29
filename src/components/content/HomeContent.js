import React from 'react';
import Header from '../Header';
var products = [];
export default class HomeContent extends React.Component{
    constructor(props){
        super(props);
        this.state = {
            delProducts: [],
        };
        this.selectProduct = this.selectProduct.bind(this);
    }

    // Select the products checkbox values to the array
    selectProduct = () => {
        document.querySelectorAll('.delete-checkbox').forEach((values) => {
            let id = values.id;
            let val = values.value;
            let prodId = document.getElementById(id);
            if (prodId.checked) {
                products.push(val);
            } else {
                let pLength = products.length;
                for (let i = 0; i < pLength; i++) {
                    if(products[i] === val)
                        products.splice(i,1);
                }
            }   
        });
        this.setState({delProducts:[...products]});
    }

    render(){
        return(
            <>
            <Header 
                url='home' 
                products={this.state.delProducts}
                deleteData={this.props.deleteData}
            />
            <div className="Home">
               <div className="siteContent">
                    <div className="contentBorder" id="contentBorder">
                        {this.props.products.map(p=>(
                            <div className="product" key={p.sku}>
                                <input className="delete-checkbox" 
                                    type="checkbox" 
                                    id={p.sku} 
                                    value={p.sku}
                                    onClick={this.selectProduct}
                                />
                                <div className="productDetails">
                                    <p>{p.sku}</p>
                                    <p>{p.name}</p>
                                    <p>{p.price}$</p>
                                    <p>{p.description}</p>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
            </>
        );
    }
}