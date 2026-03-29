import React from 'react';
import Header from '../Header';

var option = null;

export default class AddProductContent extends React.Component{
    // Sends a form to add a new product
    addForm = (e) => {
        e.preventDefault();
        
        let form = document.getElementById('product_form');
        let fd = new FormData(form);
        fd.append('createProduct',1);
        fd.append('option',option);
        document.querySelectorAll('.prodDesc').forEach((values)=>{
            let key = values.id;
            let val = values.value;
            fd.append(key,val);
        });
        this.props.saveProduct(fd);
    }

    render(){
        return(
            <>
            <Header url='addProduct' />
            <div className="Home">
               <div className="siteContent">
                    <div className="contentBorder">
                        <form onSubmit={this.addForm} id="product_form" className="addProductForm">
                            <p>SKU</p> <input type="text" name="sku" id="sku"/><br/>
                            <p>Name</p> <input type="text" name="name" id="name"/><br/>
                            <p>Price($)</p> <input type="number" min="0" name="price" id="price"/><br/>
                            <div className="tSwitcher">
                                Type Switcher&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                {this.switcher()}
                                <div id="prodTypeDiv"></div>
                            </div>
                        </form>
                        <div id="divError"></div>
                    </div>
                </div>
            </div>
            </>
        );
    }

    // Select product type
    switcher = () => {
        return(
            <select onChange={this.pTypeSwitcher} id="productType">
                <option disable="true" defaultValue hidden>Select</option>
                <option value='Book'>Book</option>
                <option value='DVD'>DVD</option>
                <option value='Furniture'>Furniture</option>
            </select>
        );
    }
    
    // Adds product type inputs
    pTypeSwitcher = (e) => {
        option = e.target.value;
        const ProdTypeDiv = document.getElementById('prodTypeDiv');
        ProdTypeDiv.innerHTML = this.typesForm(option);
    }

    typesForm = (type) => {
        if (type === 'DVD') {
            return(
                '<p>Size(MB)</p> <input type="number" min="0" class="prodDesc" id="size"/><br/>'
                +'<small>Please provide the size in MB</small>'
            );
        } else if(type === 'Furniture') {
            return(
                '<p>Height(CM)</p> <input type="number" min="0" class="prodDesc" id="height"/><br/>'
                +'<p>Width(CM)</p> <input type="number" min="0" class="prodDesc" id="width"/><br/>'
                +'<p>Length(CM)</p> <input type="number" min="0" class="prodDesc" id="length"/><br/>'
                +'<small>Please provide the dimensions HxWxL in CM</small>'
            );
        } else if(type === 'Book') {
            return(
                '<p>Weight(KG)</p> <input type="number" min="0" class="prodDesc" id="weight"/><br/>'
                +'<small>Please provide the weight in KG</small>'
            );
        } else {
            return '';
        }
    }
    
}