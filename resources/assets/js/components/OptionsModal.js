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
            <div className="modal modal_multi"  role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="profile-information">
            <div className="modal-content">
              <div className="modal-heading">
                <div className="left-head"> Options</div>
                <div className="right-head">
                  <ul className="list-inline">
                    <li className="help-toggle"><img src="public/images/help-icon.png" alt="" /></li>
                    <li><img src="public/images/verifie-icon.png" alt="" /></li>
                    <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" /></span></li>
                  </ul>
                </div>
              </div>
              <div className="modal-body-content">
                <ul id="tabsJustified2" className="nav nav-tabs project-specifications">
                  <li className="nav-item"><a href="" data-target="#option-general" data-toggle="tab" className="nav-link small active">GENERAL</a></li>
                  <li className="nav-item"><a href="" data-target="#project-specification" data-toggle="tab" className="nav-link">PROJECT
                      SPECIFICATIONS</a></li>
                </ul>
                <div id="tabsJustifiedContent2" className="tab-content">
                  <div id="option-general" className="tab-pane fade  active show">
                    <div className="option-general-div">
                      <div className="table-responsive">
                        <table className="table">
                          <tr>
                            <td className="input-label"> Language:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Project number explanation/tip" >
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <ul className="list-inline">
                                <li><img src="public/images/germany-flag.png" alt="" /></li>
                                <li><img src="public/images/united-kingdom.png" alt="" /></li>
                                <li><img src="public/images/poland-flag.png" alt="" /></li>
                                <li><img src="public/images/italy.png" alt="" /></li>
                                <li><img src="public/images/greece-flag.png" alt="" /></li>
                              </ul>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">BAFA 2018:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select>
                                <option>Calculate</option>
                                <option>option1</option>
                                <option>option2</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">Re-cooling Method:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Customer explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select>
                                <option>Dry</option>
                                <option>dry1</option>
                                <option>dry2</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">Re-cooling Temperature:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Contact explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields"><input type="text" placeholder="25 °C" /></td>
                          </tr>
                          <tr>
                            <td className="input-label">Free Cooling:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Customer explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select>
                                <option>Yes (chilled water temperature)</option>
                                <option>option1</option>
                                <option>option2</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">Heat Sources:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Customer explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select>
                                <option>Utilize also for heating load profile</option>
                                <option>option1</option>
                                <option>option2</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">Heat Supply:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Customer explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select>
                                <option>Priority for heating load profile</option>
                                <option>option1</option>
                                <option>option2</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label"> Conventional heat source:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Location explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields"><input type="text" placeholder="Boiler, 2x 100 kW"/></td>
                          </tr>
                          <tr>
                            <td className="input-label">Calculation method:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Customer explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select>
                                <option>Chilled water inlet temperature </option>
                                <option>option1</option>
                                <option>option2</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">Ambient temperature step:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Customer explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select>
                                <option>constant</option>
                                <option>option1</option>
                                <option>option2</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">Heating load profile:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Customer explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select>
                                <option>1.0 K</option>
                                <option>option1</option>
                                <option>option2</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">Cooling load profile:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Customer explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select>
                                <option>Capacity [kW]</option>
                                <option>option1</option>
                                <option>option2</option>
                              </select>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div id="project-specification" className="tab-pane fade">
                    <div className="personal-data-div">
                      <div className="table-responsive">
                        <table className="table">
                          <tr>
                            <td className="input-label">Bus system: </td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Editor explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields"><input type="text" placeholder=""/> </td>
                          </tr>
                          <tr>
                            <td className="input-label">Controller:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Company explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields"><input type="text" placeholder=""/></td>
                          </tr>
                          <tr>
                            <td className="input-label"> Pressure drop in the piping:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"
                                data-placement="bottom" data-content="Address explanation/tip">
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields"><input type="text" placeholder=""/> </td>
                          </tr>
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

export default translate(OptionsModal);
