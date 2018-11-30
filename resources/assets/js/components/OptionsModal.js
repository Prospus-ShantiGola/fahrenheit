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
        this.state = {optionInformation: '',role:'user'};
        this.handleOptionSubmit = this.handleOptionSubmit.bind(this);
        this.changeState = this.changeState.bind(this);
         //this.selectOptionLanguage = this.selectOptionLanguage.bind(this);
      }


       componentDidMount(){
        jQuery(".help-toggle").unbind('click');
        jQuery(".help-toggle").click(function(){
            jQuery(".input-help-label").toggle();
        });
        var that=this;
        $('form.option-information-form input[required]').on('change invalid', function() {
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
            jQuery('[data-toggle="popover"').each(function () {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (!jQuery(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    jQuery(this).popover('hide');
                }
            });
        });

        jQuery('.choose-language').on('click', function (e) {
          $('.choose-language').removeClass('selected-flag')
           var language_select = $(this).data('language');
           $(this).addClass('selected-flag');
            $(this).closest('ul').siblings('#option_language').val(language_select);

        });
           $('.close-modal-options').on('click', function (e) {
               if ($('.option-information-form').hasClass('form-edited')) {
                   // alert('eeee')
                   e.preventDefault();
                   $('#general-modal-confirm').modal('show');
               }
               else {
                   $('#profile-information').modal('hide');
                   $('.option-information-form')[0].reset()
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

        //  selectOptionLanguage() {
        //  var fe = $(this).attr('id');
        //  alert(fe+'__')
        //  console.log(jQuery(this))

        
        // }




          handleOptionSubmit(event) {
    event.preventDefault();
    const that = this;

       var location    = $(".option-information-form").find("input[name=location]").val();
       var address    = $(".option-information-form").find("input[name=address]").val();


        fetch('adcalc/storeProfileInformation', {
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
                            $(".option-information-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $(".option-information-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $(".option-information-form");
                                var data = that.getFormData($form);
                                //console.log(data);
                                that.setState({
                                    optionInformation:data
                                })
                                that.changeState(that.state.optionInformation);
                                GENERAL_FORM_STATUS=true;
                                $("#profile-information").modal("hide");

                            }
        })
        .catch((err) => {console.log(err)})



  }
  changeState(optionInformation){
    var result={
        optionInformation:optionInformation,
        state:true
    }
    CHANGE_FORM=true;
    this.props.onOptionSubmit(result);
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
        //projectData['optionData']=this.state.optionInformation;


        return (
            <div className="modal modal_multi"  role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="profile-information">
            <div className="modal-dialog ">
            <form  onSubmit={this.handleOptionSubmit} className = "option-information-form">
            <div className="modal-content">
              <div className="modal-heading">
                <div className="left-head"> {this.props.t('Options.Title')}</div>
                <div className="right-head">
                  <ul className="list-inline">
                  <li> <input className="save-changes-btn" type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')}/></li>
                   <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-options"  aria-label="Close"/></span></li>
                  </ul>
                </div>
              </div>
              <div className="modal-body-content">
                <ul id="tabsJustified2" className="nav nav-tabs project-specifications">
                  <li className="nav-item"><a href="" data-target="#option-general" data-toggle="tab" className="nav-link small active">{this.props.t('Options.Tab.GENERAL.Title')}</a></li>
                  <li className="nav-item"><a href="" data-target="#project-specification" data-toggle="tab" className="nav-link">{this.props.t('Options.Tab.ProjectSpecification.Title')}</a></li>
                </ul>
                <div id="tabsJustifiedContent2" className="tab-content">
                  <div id="option-general" className="tab-pane fade  active show">
                    <div className="option-general-div">
                      <div className="table-responsive">
                        <table className="table">
                          <tr>
                            <td className="input-label"> {this.props.t('Options.Tab.GENERAL.Language.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.Language.InfoTool')} >
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <ul className="list-inline">
                                <li data-language  = "de"  className  = "choose-language " ><img src="public/images/germany-flag.png" alt="" /></li>
                                <li  data-language = "en" className ="choose-language"><img src="public/images/united-kingdom.png" alt="" /></li>
                                <li className="disabled"><img src="public/images/poland-flag.png" alt="" /></li>
                                <li className="disabled"><img src="public/images/italy.png" alt="" /></li>
                                <li className="disabled"><img src="public/images/greece-flag.png" alt="" /></li>
                              </ul>
                              <input type = "hidden" value = "" name="option_language" id="option_language" />
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.Bafa.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.Bafa.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select name="profile_bafa" id="profile_bafa">
                                <option value="calculate">Calculate</option>
                                <option value="Do not calculate">Do not calculate</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.RecoolingMethod.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.RecoolingMethod.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select onChange={(elem) => this.changeField(elem)} name="profile_recooling" id="profile_recooling">
                                <option value="Dry">Dry</option>
                                <option value="With spray tool">With spray tool</option>
                                <option value="Adiabatic">Adiabatic</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Wet cooling tower">Wet cooling tower</option>
                                <option value="Other">Other </option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.RecoolingTemperature.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.RecoolingTemperature.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields withunit"><input type="text" placeholder="25" name="profile_recooling_temp" id="profile_recooling_temp" /><span>°C</span></td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.FreeCooling.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.FreeCooling.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select name="free_recooling" id="free_recooling">
                              <option value="No">No</option>
                                <option value="Yes (chilled water temperature)">Yes (chilled water temperature)</option>
                                <option value="Yes (cooling capacity)">Yes (cooling capacity)</option>
                                <option>option2</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.HeatSources.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.HeatSources.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select name="profile_heat_source" id="profile_heat_source">
                                <option value="Utilize also for heating load profile">Utilize also for heating load profile</option>
                                <option value="Ignore heating load profile">Ignore heating load profile</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.HeatSupply.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.HeatSupply.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select name="profile_heat_supply" id="profile_heat_supply">
                                <option value="Priority for heating load profile">Priority for heating load profile</option>
                                <option value="Priority for cooling load profile">Priority for cooling load profile</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label"> {this.props.t('Options.Tab.GENERAL.HeatSource.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.HeatSource.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields"><input type="text" placeholder="Boiler, 2x 100 kW" name="profile_conventional_heat" id="profile_conventional_heat"/></td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.CalculationMethod.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.CalculationMethod.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select name="profile_calculation_method" id="profile_calculation_method">
                                <option value="Chilled water inlet temperature constant">Chilled water inlet temperature constant</option>
                                <option value="Chilled water outlet temperature constant">Chilled water outlet temperature constant</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.AmbientTemperature.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.AmbientTemperature.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select name="profile_amb_tem" id="profile_amb_tem">
                                <option value="0.5">0.5 K</option>
                                <option value="1.0">1.0 k</option>
                                <option value="2.0">2.0 k</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.HeatingLoadProfile.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.HeatingLoadProfile.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select  name="profile_heating_load" id="profile_heating_load">
                              <option value="Capacity [kW]">Capacity [kW]</option>
                                <option value="Energy [kWh]">Energy [kWh]</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.GENERAL.CoolingLoadProfile.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.GENERAL.CoolingLoadProfile.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields">
                              <select  name="profile_cooling_load" id="profile_cooling_load">
                                <option value="Capacity [kW]">Capacity [kW]</option>
                                <option value="Energy [kWh]">Energy [kWh]</option>
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
                            <td className="input-label">{this.props.t('Options.Tab.ProjectSpecification.BusSystem.Title')}: </td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.ProjectSpecification.BusSystem.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields"><input type="text" placeholder="" name="bus_system" id="bus_system"/> </td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.ProjectSpecification.Controller.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.ProjectSpecification.Controller.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields"><input type="text" placeholder="" name="profile_controller" id="profile_controller"/></td>
                          </tr>
                          <tr>
                            <td className="input-label">{this.props.t('Options.Tab.ProjectSpecification.PressureDrop.Title')}:</td>
                            <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover"
                                data-placement="bottom" data-content={this.props.t('Options.Tab.ProjectSpecification.PressureDrop.InfoTool')}>
                                <img src="public/images/help-red.png" alt="" />
                              </button>
                            </td>
                            <td className="input-fields"><input type="text" placeholder="" name="pressure_drop" id="pressure_drop"/> </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </form>
            </div>
          </div>

        );
    }
}

export default translate(OptionsModal);
