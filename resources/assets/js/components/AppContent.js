import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Breadcrumb from './Breadcrumb';
import Adcalc from './Adcalc';
import { setDefaultTranslations, setDefaultLanguage } from 'react-multi-lang'
import de from './../translations/de.json'
import en from './../translations/en.json'
import {Provider} from 'react-redux';
import store from './../store/index'

setDefaultTranslations({de, en})
setDefaultLanguage(LOCALE)
class AppContent extends Component {
    constructor(props) {
        //let role=LOGGED_IN_ROLE;
        let role="expert";
        super(props);
        this.state = {
            role:role,
            formState:false
        }
        this.toggleRole=this.toggleRole.bind(this);
        this.handleForm=this.handleForm.bind(this);
        this.validateForm=this.validateForm.bind(this);
        this.submitForm=this.submitForm.bind(this);
    }
    submitForm(e){
        //console.log('%c Project Result : ', 'background: #222; color: #bada55',projectData);
        if(!GENERAL_FORM_STATUS){
            $("#message-popup-modal").modal('show');
            return false;
        }
        const that = this;
        e.preventDefault();
        //console.log(data);
        fetch('adcalc/storeProjectInformation', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(projectData)
        })
        .then((a) => {return a.json();})
        .then(function (data) {
            console.log(data);
                            if(typeof data.errors=="undefined"){

                            }
                            else{
                                $("#message-popup-modal").modal('show');
                                return false;
                            }
        })
        .catch((err) => {console.log(err)})
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
        if(!GENERAL_FORM_STATUS){
            var generalError=(<li>General Information</li>);
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
                                <li className=""><a href="#"  onClick={this.submitForm} className= "add-new-adcalc "><img src="public/images/icon_2.png"  alt="" title="Save  project"/></a></li>
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


                        <Adcalc role={this.state.role} onFormChange={this.handleForm}/>

                </div>
                </div>
            </section>
            <div className="modal" id="message-popup-modal">
  <div className="modal-dialog">
    <div className="modal-content">



        <div className="modal-heading">

               <div className="right-head">

                    <span className="close" data-dismiss="modal"><img src="public/images/cancle-icon.png" alt="" /></span>

               </div>
            </div>
      <div className="modal-body-content">
       <p>Make sure you fill in all required fields in the following tiles:</p>
       <ul>
       {generalError}

       </ul>
      </div>

    </div>
  </div>
</div>
     </div>
        );
    }
}


if (document.getElementById('content')) {
    ReactDOM.render(<AppContent />, document.getElementById('content'));
}
