import React, { Component } from 'react';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
const Header = {
    padding: "10px 20px",
    textAlign: "center",
    color: "red",
    fontSize: "14px"
  }
let selectedSource='Adsorption';

class AddChiller extends Component {

  constructor(props){
        super(props);
        this.state = {chillerInformation: '',role:'user',selectedSource:selectedSource};
        this.handleAddChillerSubmit = this.handleAddChillerSubmit.bind(this);
        this.changeState = this.changeState.bind(this);
      }


       componentDidMount(){
        jQuery(".help-toggle").unbind('click');
        jQuery(".help-toggle").click(function(){
            jQuery(".input-help-label").toggle();
        });
        var that=this;
        $('form.add-chiller-form input[required]').on('change invalid', function() {
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
           $('.close-modal-CoolingProfile').on('click', function (e) {
               if ($('.add-chiller-form').hasClass('form-edited')) {
                   // alert('eeee')
                   e.preventDefault();
                   $('#general-modal-confirm').modal('show');
               }
               else {
                   $('#add-chiller').modal('hide');
                   $('.add-chiller-form')[0].reset()
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




    handleAddChillerSubmit(event) {
    event.preventDefault();
    const that = this;

    var data=$('#heating-profile-form').serialize();


        fetch('adcalc/storeChillerInformation', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body:data
        })
         .then((a) => {return a.json();})
        .then(function (data) {
                            $(".add-chiller-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $(".add-chiller-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $(".add-chiller-form");
                                var data = that.getFormData($form);
                                //console.log(data);
                                that.setState({
                                    chillerInformation:data
                                })
                                that.changeState(that.state.chillerInformation);
                                GENERAL_FORM_STATUS=true;
                                $("#add-chiller").modal("hide");

                            }
        })
        .catch((err) => {console.log(err)})



  }
  changeState(chillerInformation){
    var result={
        chillerInformation:chillerInformation,
        state:true
    }
    CHANGE_FORM=true;
    this.props.onChillerSubmit(result);
  }

  getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }
    changeField(elem){
        //var selectedSource= (this.state.selectedSource=='CHP')?'hide':'';
        //console.log(elem.target.value);
        this.setState({
            selectedSource:elem.target.value
        });

    }

    render() {
        projectData['chillerInfo']=this.state.chillerInformation;


        return (
            <div className="modal modal_multi" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add-chiller">
            <form onSubmit={this.handleAddChillerSubmit} className="add-chiller-form" id="add-chiller-form">
                <div className="modal-content">
                    <div className="modal-heading">
                        <div className="left-head"> Add a Chiller</div>
                        <div className="right-head">
                            <ul className="list-inline">
                                <li><input className="save-changes-btn" onClick={this.handleCoolingSubmit} type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')} /></li>
                                <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-CoolingProfile" aria-label="Close" /></span></li>
                            </ul>
                        </div>
                    </div>
                    <div className="modal-body-content">
                        <ul id="tabsJustifiedd" className="nav nav-tabs">
                            <li className="nav-item"><a href="" data-target="#addchillar-technical-data" data-toggle="tab" className="nav-link small active">TECHNICAL
                  DATA</a></li>
                            <li className="nav-item"><a href="" data-target="#addchillar-calculation-data" data-toggle="tab" className="nav-link">CALCULATION
                  DATA</a></li>
                        </ul>
                        <div id="tabsJustifiedContentt" className="tab-content">
                            <div id="addchillar-technical-data" className="tab-pane fade  active show">
                                <div className="addachillar-div">
                                    <div className="table-responsive">
                                        <table className="table">
                                            <tbody>
                                                <tr>
                                                    <td className="input-label">Chiller type:</td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                        data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                                                        data-original-title="" title="">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields">
                                                        <select className="required-field" id="chiller_chiller_type" name="chiller_chiller_type" onChange={(elem) => this.changeField(elem)}>
                                                            <option value="Adsorption">Adsorption</option>
                                                            <option value="Compression">Compression</option>
                                                        </select>
                                                        <input type="hidden" placeholder="Chiller 1" id="addchillerformMode" name="addchillerformMode" value="add" />
                                                        <input type="hidden" placeholder="Chiller 1" id="addchillerformModeKey" name="addchillerformModeKey" value="" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td className="input-label">Adsorbent:</td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                        data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                                                        data-original-title="" title="">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields">
                                                        <select className="required-field" id="chiller_adsorbent" name="chiller_adsorbent">
                                                            <option>Silica gel</option>
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
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields">
                                                        <select className="required-field" id="chiller_product" name="chiller_product">
                                                            <option>eCoo 20 ST</option>
                                                            <option>option1</option>
                                                            <option>option2</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td className="input-label">Number of chillers:</td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                        data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                                                        data-original-title="" title="">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields">
                                                        <input type="text"  id="chiller_no_chiller" name="chiller_no_chiller" placeholder="1 piece" className="required-field"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td className="input-label">Product
                                                      interconnection:
                          </td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                        data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                                                        data-original-title="" title="">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields">
                                                        <select className="required-field"  id="chiller_product_inter" name="chiller_product_inter">
                                                            <option>2.00</option>
                                                            <option>option1</option>
                                                            <option>option2</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td className="input-label">Group interconnection:</td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                        data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                                                        data-original-title="" title="">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields">
                                                        <select className="required-field"  id="chiller_group_inter" name="chiller_group_inter">
                                                            <option>2.20</option>
                                                            <option>option1</option>
                                                            <option>option2</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td className="input-label">Function:</td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                        data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                                                        data-original-title="" title="">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields">
                                                        <select className="required-field"  id="chiller_function" name="chiller_function">
                                                            <option value="Peak load cover">Peak load cover</option>
                                                            <option value="Back up">Back up</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="addchillar-calculation-data" className="tab-pane fade">
                                <div className="addchillar-cal-data-div">
                                    <div className="table-responsive">
                                        <table className="table">
                                            <tbody>
                                                <tr>
                                                    <td className="input-label">Investment costs: </td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                        data-placement="bottom" data-content="Editor explanation/tip" data-original-title="" title="">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields"><input type="text" placeholder="€"   id="addchiller_investment_cost" name="addchiller_investment_cost"/> </td>
                                                </tr>
                                                <tr>
                                                    <td className="input-label">Discount:</td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                        data-placement="bottom" data-content="Company explanation/tip" data-original-title="" title="">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields"><input type="text" placeholder="%" id="addchiller_discount" name="addchiller_discount"/></td>
                                                </tr>
                                                <tr>
                                                    <td className="input-label"> Maintenance costs: </td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                        data-placement="bottom" data-content="Address explanation/tip" data-original-title="" title="">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields"><input type="text" placeholder="€/a" id="addchiller_maintenence" name="addchiller_maintenence"/> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>


        );
    }
}

export default translate(AddChiller);