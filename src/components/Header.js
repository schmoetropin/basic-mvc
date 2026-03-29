import React from 'react';

export default class Header extends React.Component{
    // Create a form of all selected products and send to deleteData method
    deleteProducts = (data) => {
        let fd = new FormData();
        fd.append('delProducts',JSON.stringify(data));
        this.props.deleteData(fd);
    }

    render(){
        return(
            <header className="siteTop">
                {this.title(this.props.url)}     
                <div className="topButtoms">
                    {this.buttons(this.props.url)}     
                </div>
                <hr/>
            </header>
        );
    }

    // Change the page title
    title = ($url) => {
        if($url === 'home') return(<h2>product list</h2>);
        else return(<h2>product add</h2>);
    }

    // Change the page header buttons
    buttons = ($url) => {
        if ($url === 'home') {
            return(
                <>
                <a href="/add-product" className="defaultButtom">ADD</a>
                <button 
                    onClick={()=>this.deleteProducts(this.props.products)} 
                    id="delete-product-btn" 
                    className="defaultButtom"
                >MASS DELETE</button>
                </>
            );
        } else {
            return(
                <>
                <a href="/" className="defaultButtom">CANCEL</a>
                <button type="submit" id="pro_form_buttom" 
                    form="product_form" className="defaultButtom">Save</button>
                </>
            );
        }
    }
}