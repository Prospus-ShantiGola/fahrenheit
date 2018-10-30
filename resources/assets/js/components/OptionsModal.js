import React, { Component } from 'react';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
const Header = {
    padding: "10px 20px",
    textAlign: "center",
    color: "red",
    fontSize: "14px"
  }

class OptionsModal extends Component {

  constructor(props){
        super(props);
        this.state = {generalInformation: '',role:'user'};
        this.handleGeneralSubmit = this.handleGeneralSubmit.bind(this);
        this.changeState = this.changeState.bind(this);
      }


       componentDidMount(){
        jQuery(".help-toggle").unbind('click');
        jQuery(".help-toggle").click(function(){
            jQuery(".input-help-label").toggle();
        });
        var that=this;
        $('form.general-information-form input[required]').on('change invalid', function() {
            var textfield = $(this).get(0);

            // 'setCustomValidity not only sets the message, but also marks
            // the field as invalid. In order to see whether the field really is
            // invalid, we have to remove the message first
            textfield.setCustomValidity('');

            if (!textfield.validity.valid) {
              textfield.setCustomValidity(that.props.t('RequiredField.ErrorMsg'));
            }
        });
        jQuery('body').on('click', function (e) {
            jQuery('[data-toggle="popover"]').each(function () {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (!jQuery(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    jQuery(this).popover('hide');
                }
            });
        });
           $('.close-modal-general').on('click', function (e) {
               if ($('.general-information-form').hasClass('form-edited')) {
                   // alert('eeee')
                   e.preventDefault();
                   $('#general-modal-confirm').modal('show');
               }
               else {
                   $('#general-information').modal('hide');
                   $('.general-information-form')[0].reset()
               }
           })
               //Do stuff here

          }
          initializeAutocomplete(elem){
            var input = document.getElementById(elem.target.id);
            // var options = {
            //   types: ['(regions)'],
            //   componentRestrictions: {country: "IN"}
            // };
            var options = {}

            var autocomplete = new google.maps.places.Autocomplete(input,options);

            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                var place = autocomplete.getPlace();
                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();
                var placeId = place.place_id;
                // to set city name, using the locality param
                var componentForm = {
                    locality: 'short_name',
                };

                console.log(lat,lng);
                // initialize(lat, lng);
                // //Drawing map on the basis of latitude and longitude.
                // getMapInfo(lat, lng,place)
            });
          }




handleGeneralSubmit(event) {
    event.preventDefault();
    const that = this;

       var location    = $(".general-information-form").find("input[name=location]").val();
       var address    = $(".general-information-form").find("input[name=address]").val();


        fetch('adcalc/storeGeneralInformation', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                     location: location,
                     address: address

                })
        })
         .then((a) => {return a.json();})
        .then(function (data) {
                            $(".general-information-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $(".general-information-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $(".general-information-form");
                                var data = that.getFormData($form);
                                //console.log(data);
                                that.setState({
                                    generalInformation:data
                                })
                                that.changeState(that.state.generalInformation);
                                GENERAL_FORM_STATUS=true;
                                $("#general-information").modal("hide");

                            }
        })
        .catch((err) => {console.log(err)})



  }
  changeState(generalInformation){
    var result={
        generalInformation:generalInformation,
        state:true
    }
    CHANGE_FORM=true;
    this.props.onGeneralSubmit(result);
  }

  getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }


    render() {
        projectData['generalData']=this.state.generalInformation;


        return (
            <div className="modal " role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="general-information">
            <div className="modal-dialog ">
            <form  onSubmit={this.handleGeneralSubmit} className = "general-information-form">

           <div className="modal-content">
            <div className="modal-heading">
               <div className="left-head"> {this.props.t('General.Title')}</div>
               <div className="right-head">
                  <ul className="list-inline">

                    {/* <li className="help-toggle"><img src="public/images/help-icon.png" alt="no-image" /></li> */}
                     <li> <input className="save-changes-btn" type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')}/></li>
                      <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-general"  aria-label="Close"/></span></li>

                  </ul>
               </div>
            </div>
            <div className="modal-body-content">
               <ul id="tabsJustifieddouble" className="nav nav-tabs double-tab">
                  <li className="nav-item"><a href="" data-target="#project-data" data-toggle="tab" className="nav-link small active">{this.props.t('General.Tab.Project.Title')}</a></li>
                  <li className="nav-item"><a href="" data-target="#personal-data" data-toggle="tab" className="nav-link">{this.props.t('General.Tab.Personal.Title')}</a></li>
               </ul>
               <div id="tabsJustifiedContent" className="tab-content">
                  <div id="project-data" className="tab-pane fade  active show">
                     <div className="project-data-div">
                        <div className="table-responsive">
                           <table className="table">
                                   <tbody>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Project.ProjectNumber.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Project.ProjectNumber.InfoTool')}>
                                    <img src="public/images/help-red.png" alt=""  />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder={this.props.t('General.Tab.Project.ProjectNumber.Placeholder')} name = "project_number" id = "project_number" /> </td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Project.ProjectName.Title')}: </td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Project.ProjectName.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder={this.props.t('General.Tab.Project.ProjectName.Placeholder')} name = "project_name" id = "project_name" />
                                 <input type="hidden" placeholder="Chiller 1" id="generalformMode"   name="generalformMode" value="add" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Project.ProjectLocation.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Project.ProjectLocation.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" title={this.props.t('RequiredField.ErrorMsg')} placeholder={this.props.t('General.Tab.Project.ProjectLocation.Placeholder')} required  className="required-field" name = "location" id = "location" onFocus={(elem) => this.initializeAutocomplete(elem)} /> <i className="fa fa-map-marker disabled" aria-hidden="true"></i>

                                 <span className="invalid-feedback" role="alert">
                                             <strong>{this.props.t('RequiredField.Message')}</strong>
                                       </span>
                                       </td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Project.ProjectCustomer.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Project.ProjectCustomer.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name = "customer" id = "customer" placeholder={this.props.t('General.Tab.Project.ProjectCustomer.Placeholder')}/></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Project.ProjectContact.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Project.ProjectContact.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name = "contact" id = "contact" placeholder={this.props.t('General.Tab.Project.ProjectContact.Placeholder')} /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Project.ProjectPhone.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Project.ProjectPhone.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text"  pattern="^\d{10}$"   name = "phone_number" id = "phone_number" placeholder={this.props.t('General.Tab.Project.ProjectPhone.Placeholder')} /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Project.ProjectEmail.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Project.ProjectEmail.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="email" title={this.props.t('RequiredField.ErrorMsg')} name = "email_address" id = "email_address" required  className="required-field" placeholder={this.props.t('General.Tab.Project.ProjectEmail.Placeholder')} /></td>
                              </tr>
                                      </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div id="personal-data" className="tab-pane fade">
                     <div className="personal-data-div">
                        <div className="table-responsive">
                           <table className="table">
                                   <tbody>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Personal.PersonalEditor.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Personal.PersonalEditor.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name ="editor" id ="editor" placeholder={this.props.t('General.Tab.Personal.PersonalEditor.Placeholder')} /> </td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Personal.PersonalCompany.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Personal.PersonalCompany.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name = "company" id = "company" placeholder={this.props.t('General.Tab.Personal.PersonalCompany.Placeholder')}/></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Personal.PersonalAddress.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body"data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Personal.PersonalAddress.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" title={this.props.t('RequiredField.ErrorMsg')} name = "address" required   id = "address" onFocus={(elem) => this.initializeAutocomplete(elem)} placeholder={this.props.t('General.Tab.Personal.PersonalAddress.Placeholder')} className="required-field" /> <i className="fa fa-map-marker disabled" aria-hidden="true"></i>
                                 <span className="invalid-feedback" role="alert">
                                             <strong>{this.props.t('RequiredField.Message')}</strong>
                                       </span>

                                 </td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Personal.PersonalPhone.Title')}:</td>
                                 <td className="input-help-label"><button type="button"    className="" data-container="body"data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Personal.PersonalPhone.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text"  pattern="^\d{10}$"   name = "personal_phone_number" id = "personal_phone_number" placeholder={this.props.t('General.Tab.Personal.PersonalPhone.Placeholder')} /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Personal.PersonalMobile.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body"data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Personal.PersonalMobile.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" pattern="^\d{10}$"  name = "mobile_number" id = "mobile_number" placeholder={this.props.t('General.Tab.Personal.PersonalMobile.Placeholder')} /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('General.Tab.Personal.PersonalEmail.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body"data-trigger="hover" data-toggle="popover" data-placement="bottom" data-content={this.props.t('General.Tab.Personal.PersonalEmail.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="email"  required  className="required-field" name = "personal_email_address" id = "personal_email_address" placeholder={this.props.t('General.Tab.Personal.PersonalEmail.Placeholder')} /></td>
                              </tr>
                                      </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div style={Header}>{this.props.t('RequiredField.Note')}</div>
         </div>

            </form>
            </div>
         </div>

        );
    }
}

export default translate(OptionsModal);
