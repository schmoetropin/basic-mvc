import React from 'react';
import AddProductContent from '../content/AddProductContent';

export default class AddProduct extends React.Component{
    componentDidMount(){
        document.title = this.props.title;
    }

    render(){
        return(
            <div className="AddProduct">
                <AddProductContent saveProduct={this.props.saveProduct} />
            </div>
        );
    }
}