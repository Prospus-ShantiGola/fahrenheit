import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Breadcrumb from './Breadcrumb';
import Adcalc from './Adcalc';
import {Provider} from 'react-redux';
import {createStore, applyMiddleware} from 'redux';

class AppContent extends Component {
    constructor(props) {
        let role=LOGGED_IN_ROLE;
        super(props);
        this.state = {
            role:role,
            formState:false
        }
        this.toggleRole=this.toggleRole.bind(this);
        this.handleForm=this.handleForm.bind(this);
        this.validateForm=this.validateForm.bind(this);
    }
    toggleRole(){
        var currentRole= (this.state.role=="expert")? "user":"expert";
        this.setState({
            role:currentRole
        })
    }
    handleForm(result){
       this.setState({
           formState:result
       })
    }
    validateForm(){
        if(CHANGE_FORM){
            $("#general-modal").modal("show");
        }else{
            location.reload();
        }
    }
    render() {
        let disableClass="";
        if(LOGGED_IN_ROLE=="user"){
            disableClass="disableCard";
        }
        return (
            <div>
           <Breadcrumb/>
            <section className="adcalc-content">
                <div className="container">
                <div className="adcalc-inner-content">
                    <div className="icon-area">
                        <div className="row">
                            <div className="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <ul className="list-inline left-icon-list">

                                <li ><a href="#"  onClick={this.validateForm} className= "add-new-adcalc "><img src="public/images/icon_1.png" alt="" className="toplinks" title="New project" /></a></li>
                                <li className="disableCard"><div data-toggle="modal" data-target=""><img src="public/images/icon_2.png"  alt="" title="Save  project"/></div></li>
                                <li className="disableCard"><a href="#"><img src="public/images/icon_3.png" alt="" title="Load project"/></a></li>

                            </ul>
                            </div>
                            <div className="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                            <ul className="list-inline right-icon-list">
                                <li className="disableCard"><a href="#"><img src="public/images/icon_4.png" alt="" title="Download"/></a></li>
                                <li className="disableCard"><a href="#"><img src="public/images/icon_5.png" alt="" title="Upload"/></a></li>
                                <li className={disableClass}><a href="#" ><img src="public/images/icon_6.png" alt="toggle" onClick={this.toggleRole} title="Toggle view"/></a></li>
                                <li><div data-toggle="modal" data-target="#contact-form-modal" ><img src="public/images/icon_7.png" alt="" title="Contact us"/></div></li>
                                <li><div data-toggle="modal" className= "login-modal"><img src="public/images/icon_8.png" alt="" title="My profile"/></div></li>
                            </ul>
                            </div>
                        </div>
                    </div>

                        <Provider store={store}>
                        <Adcalc role={this.state.role} onFormChange={this.handleForm}/>
                        </Provider>
                </div>
                </div>
            </section>
     </div>
        );
    }
}


if (document.getElementById('content')) {
    ReactDOM.render(<AppContent />, document.getElementById('content'));
}
