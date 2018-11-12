import React, { Component } from 'react';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
const Header = {
    padding: "10px 20px",
    textAlign: "center",
    color: "red",
    fontSize: "14px"
  }

class AddChiller extends Component {

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
           $('.close-modal-ReCoolingProfile').on('click', function (e) {
               if ($('.general-information-form').hasClass('form-edited')) {
                   // alert('eeee')
                   e.preventDefault();
                   $('#general-modal-confirm').modal('show');
               }
               else {
                   $('#add-recooler').modal('hide');
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
                                $("#add-recooler").modal("hide");

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
            <div className="modal modal_multi" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add-recooler">

        <div className="modal-content">
          <div className="modal-heading">
            <div className="left-head">Add a Re-cooling System</div>
            <div className="right-head">
                            <ul className="list-inline">
                                <li><input className="save-changes-btn" onClick={this.handleCoolingSubmit} type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')} /></li>
                                <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-ReCoolingProfile" aria-label="Close" /></span></li>
                            </ul>
            </div>
          </div>
          <div className="modal-body-content">
            <ul id="tabsJustifieddd" className="nav nav-tabs">
              <li className="nav-item"><a href="" data-target="#addrecooling-technical-data" data-toggle="tab" className="nav-link small active">TECHNICAL
                  DATA</a></li>
              <li className="nav-item"><a href="" data-target="#addrecooling-calculation-data" data-toggle="tab" className="nav-link">CALCULATION
                  DATA</a></li>
            </ul>
            <div id="tabsJustifiedContenttt" className="tab-content">
              <div id="addrecooling-technical-data" className="tab-pane fade  active show">
                <div className="add-recooling-div">
                  <div className="table-responsive">
                    <table className="table">
                      <tbody>
                        <tr>
                          <td className="input-label">Components:</td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                              data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields">
                            <select className="required-field">
                              <option>Re-cooler</option>
                              <option>option1</option>
                              <option>option2</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td className="input-label">Re-cooling method:</td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                              data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields">
                            <select className="required-field">
                              <option>Dry</option>
                              <option>option1</option>
                              <option>option2</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td className="input-label">Product:</td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                              data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields">
                            <select className="required-field">
                              <option>eRec 20 | 58</option>
                              <option>option1</option>
                              <option>option2</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td className="input-label"> Number of units: </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Project number explanation/tip" data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="1 piece" className="required-field"/></td>
                        </tr>

                        <tr>
                          <td className="input-label"> Name: </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Project number explanation/tip" data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder=""/></td>
                        </tr>

                        <tr>
                          <td className="input-label"> Re-cooling capacity:</td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Project number explanation/tip" data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="58 kW" className="required-field"/></td>
                        </tr>

                        <tr>
                          <td className="input-label"> Temperature difference: </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Project number explanation/tip" data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="2 K" className="required-field"/></td>
                        </tr>

                        <tr>
                          <td className="input-label"> Primary volume
                            flow rate:
                          </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Project number explanation/tip" data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="" className="required-field"/></td>
                        </tr>

                        <tr>
                          <td className="input-label"> Secondary volume
                            flow rate:
                          </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Project number explanation/tip" data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="" className="required-field"/></td>
                        </tr>

                        <tr>
                          <td className="input-label">Electrical power
                            consumption:
                          </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Project number explanation/tip" data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="" className="required-field"/></td>
                        </tr>
                        <tr>
                          <td className="input-label">Available/provided
                            by customer:
                          </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                              data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields">
                            <select className="required-field">
                              <option>No</option>
                              <option>option1</option>
                              <option>option2</option>
                            </select>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div id="addrecooling-calculation-data" className="tab-pane fade">
                <div className="addecooling-calcu-div">
                  <div className="table-responsive">
                    <table className="table">
                      <tbody>
                        <tr>
                          <td className="input-label">Investment costs: </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Editor explanation/tip" data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder=""/> </td>
                        </tr>
                        <tr>
                          <td className="input-label">Discount:</td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Company explanation/tip" data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder=""/></td>
                        </tr>
                        <tr>
                          <td className="input-label"> Maintenance costs: </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content="Address explanation/tip" data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder=""/> </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



        );
    }
}

export default translate(AddChiller);
