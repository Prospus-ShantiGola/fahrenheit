import React, { Component } from 'react';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
const Header = {
    padding: "10px 20px",
    textAlign: "center",
    color: "red",
    fontSize: "14px"
  }
  let selectedSource='Re-cooler';

class AddRecooler extends Component {

  constructor(props){
        super(props);
        this.state = {recoolerInformation: '',role:'user',selectedSource:selectedSource};
        this.handleAddRecoolerSubmit = this.handleAddRecoolerSubmit.bind(this);
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




    handleAddRecoolerSubmit(event) {
        if (!this.showAllHeatSourceErrorMessages()) {
            return false;
        }
        event.preventDefault();
        const that = this;

        var data = $('#add-chiller-form').serialize();
        fetch('adcalc/storeRecoolerInformation', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: data
        })
            .then((a) => { return a.json(); })
            .then(function (data) {
                $(".general-information-form").find('.invalid-feedback').hide();
                jQuery.each(data.errors, function (key, value) {
                    $(".general-information-form").find('#' + value).siblings('.invalid-feedback').show();
                });

                if (typeof data.errors == "undefined") {
                    var $form = $(".add-recooler-form");
                    var data = that.getFormData($form);
                    //console.log(data);
                    that.setState({
                        recoolerInformation: data
                    })
                    that.changeState(that.state.recoolerInformation);
                    GENERAL_FORM_STATUS = true;
                    $("#add-recooler").modal("hide");

                }
            })
            .catch((err) => { console.log(err) })



    }
  changeState(recoolerInformation){
    var result={
        recoolerInformation:recoolerInformation,
        state:true
    }
    CHANGE_FORM=true;
    this.props.onRecoolerSubmit(result);
  }

  getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }
    showAllHeatSourceErrorMessages() {
        var form = $("form.add-recooler-form"),
            errorList = $("ul.errorMessages", form),
            errorFound = true;

        errorList.removeClass("hide");
        errorList.empty();
        // Find all invalid fields within the form.
        var invalidFields = form.find(":invalid").each(function(index, node) {
            // Find the field's corresponding label
            var fieldLabel = $("#" + node.id).parents('td.input-fields').siblings('td.input-label').text(),
                tabId = $("#" + node.id)
                    .parents("div.tab-pane")
                    .attr("id"),
                // Opera incorrectly does not fill the validationMessage property.
                message = node.validationMessage || "Invalid value.";
            var tabTitle = $("a[data-target='#" + tabId + "']").text();

            fieldLabel = fieldLabel.replace(":", "");
            var errorStr="";
            errorStr= (message=="Please provide value" || message=="Please fill out this field.") ? "Please provide value" : "Please enter only numeric value";
            errorList
                .show()
                .append(
                    "<li>"+errorStr+" in '" +
                        fieldLabel +
                        "' field of " +
                        tabTitle +
                        " tab</li>"
                );
            errorFound = false;
        });
        return errorFound;
    }
    changeField(elem){
        //var selectedSource= (this.state.selectedSource=='CHP')?'hide':'';
        //console.log(elem.target.value);
        this.setState({
            selectedSource:elem.target.value
        });

    }


    render() {
        projectData['recooling']=this.state.recoolerInformation;
        let recoolingHtml,primaryHtml="";
        if(this.state.selectedSource=="Re-cooler"){
           recoolingHtml=(<tr>
            <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.RecoolingMethod.Title')}:</td>
            <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.RecoolingMethod.InfoTool')}
                data-original-title="" title="">
                <img src="public/images/help-red.png" alt=""/>
              </button>
            </td>
            <td className="input-fields">
              <select className="required-field" name="recooler_method" id="recooler_method">
                <option value="Dry">Dry</option>
                <option value="With spray tool">With spray tool</option>
              </select>
            </td>
          </tr>);
        }
        if(this.state.selectedSource=="Circuit separation"){
            primaryHtml=(<tr>
                <td className="input-label"> {this.props.t('Fahrenheit.Tab.Recooling.PrimaryVolumeFlowRate.Title')}:
                </td>
                <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                    data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.PrimaryVolumeFlowRate.InfoTool')} data-original-title=""
                    title="">
                    <img src="public/images/help-red.png" alt=""/>
                  </button>
                </td>
                <td className="input-fields"><input type="text" placeholder={this.props.t('Fahrenheit.Tab.Recooling.PrimaryVolumeFlowRate.Placeholder')} required  pattern="\d*"  className="required-field onlynumeric" name="recooler_prim_volume" id="recooler_prim_volume"/></td>
              </tr>);
         }

        return (
            <div className="modal modal_multi" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add-recooler">
<form className="add-recooler-form" id="add-recooler-form">
        <div className="modal-content">
          <div className="modal-heading">
            <div className="left-head">{this.props.t('Fahrenheit.Tab.Recooling.AddReCoolingSystem.Title')}</div>
            <div className="right-head">
                            <ul className="list-inline">
                                <li><input className="save-changes-btn" onClick={this.handleAddRecoolerSubmit} type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')} /></li>
                                <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-ReCoolingProfile" aria-label="Close" /></span></li>
                            </ul>
            </div>
          </div>
          <div className="modal-body-content">
            <ul id="tabsJustifieddd" className="nav nav-tabs">
              <li className="nav-item"><a href="" data-target="#addrecooling-technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.Title')}</a></li>
              <li className="nav-item"><a href="" data-target="#addrecooling-calculation-data" data-toggle="tab" className="nav-link">{this.props.t('Fahrenheit.Tab.Chiller.TAB.CalculationData.Title')}</a></li>
            </ul>
            <div id="tabsJustifiedContenttt" className="tab-content">
              <div id="addrecooling-technical-data" className="tab-pane fade  active show">
                <div className="add-recooling-div">
                  <div className="table-responsive">
                    <table className="table">
                      <tbody>
                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.Components.Title')}:</td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.Components.InfoTool')}
                              data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields">
                            <select className="required-field" name="recooler_component" id="recooler_component"  onChange={(elem) => this.changeField(elem)}>
                              <option value="Re-cooler">Re-cooler</option>
                              <option value="Circuit separation">{this.props.t('Fahrenheit.Tab.Recooling.CircuitSeparation.Title')}</option>
                            </select>
                            <input type="hidden" placeholder="Chiller 1" id="addrecoolerformMode" name="addrecoolerformMode" value="add" />
                            <input type="hidden" placeholder="Chiller 1" id="addrecoolerformModeKey" name="addrecoolerformModeKey" value="" />
                          </td>
                        </tr>
                        {recoolingHtml}
                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.Product.Title')}:</td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.Product.InfoTool')}
                              data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields">
                            <select className="required-field"  name="recooler_product" id="recooler_product">
                              <option value="eRec 20 | 58">eRec 20 | 58</option>
                              <option value="eRec 20 | 50">eRec 20 | 50</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.NumberOfUnits.Title')}: </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.NumberOfUnits.InfoTool')} data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder={this.props.t('Fahrenheit.Tab.Recooling.NumberOfUnits.Placeholder')}  required  pattern="\d*" className="required-field onlynumeric" name="recooler_units" id="recooler_units"/></td>
                        </tr>

                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.Name.Title')}: </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.Name.InfoTool')} data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder={this.props.t('Fahrenheit.Tab.Recooling.Name.Placeholder')} name="recooler_name" id="recooler_name"/></td>
                        </tr>

                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.ReCoolingCapacity.Title')} :</td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.ReCoolingCapacity.InfoTool')} data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="58 kW" required  pattern="\d*"  className="required-field onlynumeric" name="recooler_capacity" id="recooler_capacity"/></td>
                        </tr>

                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.TemperatureDifference.Title')} : </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.TemperatureDifference.InfoTool')} data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="2 K" required  pattern="\d*"  className="required-field onlynumeric" name="recooler_temp_diff" id="recooler_temp_diff"/></td>
                        </tr>

                        {primaryHtml}

                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.SecondaryVolumeFlowRate.Title')}:
                          </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.SecondaryVolumeFlowRate.InfoTool')} data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="" required  pattern="\d*"  className="required-field onlynumeric" name="recooler_sec_volume" id="recooler_sec_volume"/></td>
                        </tr>

                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.ElectricalPowerConsumption.Title')}:
                          </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.ElectricalPowerConsumption.InfoTool')} data-original-title=""
                              title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="" required  pattern="\d*"  className="required-field onlynumeric" name="recooler_elec_consumption" id="recooler_elec_consumption"/></td>
                        </tr>
                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.AvailableByCustomer.Title')}:
                          </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.AvailableByCustomer.InfoTool')}
                              data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields">
                            <select className="required-field" name="recooler_available" id="recooler_available">
                              <option value="No">No</option>
                              <option  value="Yes">Yes</option>
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
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.InvestmentCosts.Title')}: </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.InvestmentCosts.InfoTool')} data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text"  placeholder="€"  name="recooler_inv_cost" id="recooler_inv_cost"/> </td>
                        </tr>
                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.Discount.Title')}:</td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.Discount.InfoTool')} data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text" placeholder="%"  name="recooler_discount" id="recooler_discount"/></td>
                        </tr>
                        <tr>
                          <td className="input-label">{this.props.t('Fahrenheit.Tab.Recooling.MaintenanceCosts.Title')} : </td>
                          <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                              data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Recooling.MaintenanceCosts.InfoTool')} data-original-title="" title="">
                              <img src="public/images/help-red.png" alt=""/>
                            </button>
                          </td>
                          <td className="input-fields"><input type="text"  placeholder="€/a"   name="recooler_maint_cost" id="recooler_maint_cost"/> </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <ul className="errorMessages hide">
            {this.props.t('ErrorMessage')}
                                </ul>
        </div>
        </form>
      </div>



        );
    }
}

export default translate(AddRecooler);
