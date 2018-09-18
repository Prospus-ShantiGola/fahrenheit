import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class Breadcrumb extends Component {

    render() {
        return (
            <div className="container" >
                <ol className="breadcrumb">
                  
                    <li className="breadcrumb-item active" aria-current="page"><a href="/fahrenheit">Adcalc</a></li>
                </ol>
            </div>
        );
    }
}


if (document.getElementById('breadcrumb')) {
    ReactDOM.render(<Breadcrumb />, document.getElementById('breadcrumb'));
}
