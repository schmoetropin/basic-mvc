import React from 'react';
import HomeContent from '../content/HomeContent';

export default class Home extends React.Component{
    componentDidMount(){
        document.title = this.props.title;
    }

    render(){
        return(
            <div className="Home">
                <HomeContent 
                    products={this.props.products} 
                    deleteData={this.props.deleteData}
                />
            </div>
        );
    }
}