import React, { Component } from 'react';

export default class Breadcrumb extends Component {

    render() {
        return (
            <section className="breadcrumbs" id="breadcrumb">
                <div className="container" >
                    <ol className="breadcrumb">

                        <li className="breadcrumb-item active" aria-current="page"><a href="/fahrenheit">Adcalc</a></li>
                    </ol>
                </div>
            </section>
        );
    }
}


