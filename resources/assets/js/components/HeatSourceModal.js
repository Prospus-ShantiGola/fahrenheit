import React from 'react';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
let selectedSource='Process heat';
const CustomTable = {
    padding: "0px"
};
class HeatSourceModal extends React.Component {
    constructor(props){
        super(props);
        this.state = {heatSource: '',selectedSource:selectedSource};
        this.handleHeatSubmit = this.handleHeatSubmit.bind(this);
        this.changeField = this.changeField.bind(this);
      }

    myCustomFunction(elem) {
        if (typeof elem.currentTarget == "undefined") return false;
        var customInputId = elem.currentTarget.getAttribute("data-id");

        var customInput = document.getElementById(customInputId);
        //console.log("input",customInput);
        if (customInput.contentEditable == "true") {
            customInput.contentEditable = "false";
            elem.target.classList.add("fa-pencil-square-o");
            elem.target.classList.remove("fa-check");
            customInput.classList.remove("editable");
        } else {
            customInput.contentEditable = "true";
            elem.target.classList.add("fa-check");
            elem.target.classList.remove("fa-pencil-square-o");
            customInput.classList.add("editable");
        }
    }
      componentDidMount(){
        jQuery(".help-toggle").unbind('click');
        jQuery(".help-toggle").click(function(){
            jQuery(".input-help-label").toggle();
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
        // $(document).on('hide.bs.modal','#compression-Heat', function () {
        //         $("#compression-Heat-form")[0].reset()
        //             //Do stuff here
        //         });


          $('.close-modal-heatsource').on('click', function (e) {

              const obj = this;
              // alert('Heat')

              if ($('#heat-source-form').hasClass('form-edited')) {
                  //alert('ccccccc')
                  e.preventDefault();

                  $('#compression-modal-confirm').modal('show');


              }
              else {
                  $("#heat-source").modal("hide");
                  $("#heat-source-form")[0].reset()
              }



          })



      }
      showAllHearSourceErrorMessages() {
        var form = $("form.heat-source-form"),
            errorList = $("ul.errorMessages", form),
            errorFound = true;

        errorList.removeClass("hide");
        errorList.empty();
        // Find all invalid fields within the form.
        var invalidFields = form.find(":invalid").each(function(index, node) {
            // Find the field's corresponding label
            var label = $("#" + node.id)
                    .parent("td")
                    .prev(),
                tabId = $("#" + node.id)
                    .parents("div.tab-pane")
                    .attr("id"),
                // Opera incorrectly does not fill the validationMessage property.
                message = node.validationMessage || "Invalid value.";
            var tabTitle = $("a[data-target='#" + tabId + "']").text();

            if (label.hasClass("input-help-label")) {
                label = label.prev("td.input-label");
            }
            var fieldLabel = label.text();
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
      handleHeatSubmitChange (heatSource) {
        var result={
            heatSource:heatSource,
            state:true
        }

        CHANGE_FORM=true;
        this.props.onHeatSubmit(result);
     }
      handleHeatSubmit(e){
        if (!this.showAllHearSourceErrorMessages()) {
            return false;
        }
        const that = this;
        e.preventDefault();
        var data=$('#heat-source-form').serialize();
        //console.log(data);
        fetch('adcalc/storeHeatSourceInformation', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: data
        })
        .then((a) => {return a.json();})
        .then(function (data) {
                            $("#heat-source-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $("#heat-source-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $("#heat-source-form");
                                var data = that.getFormData($form);
                                that.setState({
                                    heatSource:data
                                })
                                that.handleHeatSubmitChange(that.state.heatSource);
                                $("#heat-source").modal("hide");

                            }
        })
        .catch((err) => {console.log(err)})
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
        if(this.props.role=="expert"){
            var expertRoleHtml=(<ul id="tabsJustifieddouble" className="nav nav-tabs double-tab">
                  <li className="nav-item"><a href="" data-target="#technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('HeatSource.Tab.TechnicalData.Title')}</a></li>
                  <li className="nav-item"><a href="" data-target="#calculation-data" data-toggle="tab" className="nav-link">{this.props.t('HeatSource.Tab.CalculationData.Title')}</a></li>
         </ul>);
        }
        else{
            var expertRoleHtml=(
                <ul id="tabsJustifiedsingle" className="nav nav-tabs single-tab singletabbox">
                     <li className="nav-item"><a href="" data-target="#technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('HeatSource.Tab.TechnicalData.Title')}</a></li>
                     {expertRoleHtml}
                  </ul>
            );
        }

        if((this.state.selectedSource=="Process heat" ||  this.state.selectedSource=="District heat" || this.state.selectedSource=="other") || this.props.role=="expert"){
           var conditionalHeatField=(
               <tr>
                   <td className="nested-table"
                        colSpan="3"
                        style={CustomTable}>
                   <table className="table">
                       <tbody>
                           <tr>
                               <td className="input-label">{this.props.t('HeatSource.Tab.TechnicalData.DriveTemperature.Title')}:</td>
                               <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                   <img src="public/images/help-red.png" alt="" />
                               </button>
                               </td>
                               <td className="input-fields withunit"><input type="text" required="required" placeholder="85" pattern="\d*" className="required-field onlynumeric" name="drive_temp" id="drive_temp" /><span>°C</span></td>
                           </tr>
                           <tr>
                               <td className="input-label">{this.props.t('HeatSource.Tab.TechnicalData.HeatCapacity.Title')}:</td>
                               <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Contact explanation/tip">
                                   <img src="public/images/help-red.png" alt="" />
                               </button>
                               </td>
                               <td className="input-fields withunit"><input type="text" required="required" placeholder="36" pattern="\d*" className="required-field onlynumeric" name="heat_capacity" id="heat_capacity" /><span>kw</span></td>
                           </tr>
                       </tbody>
                   </table>
                   </td>
               </tr>
           );
        }
        if(this.state.selectedSource=="CHP plant" || this.props.role=="expert"){
            var conditionalCHPField=(
                <tr>
                    <td className="nested-table"
                         colSpan="3"
                         style={CustomTable}>
                    <table className="table">
                        <tbody>
                        <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.TechnicalData.ElectricCapacity.Title')}: </td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields withunit"><input type="text" placeholder="18" name="electricity_capacity" id="electricity_capacity"/><span>kw</span></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.TechnicalData.ThermalEfficiency.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields withunit"><input type="text" placeholder="54.8" name="thermal_efficienty" id="thermal_efficienty" /><span>%</span></td>
                              </tr>
                              <tr>
                                 <td className="input-label">
                                 {this.props.t('HeatSource.Tab.TechnicalData.ElectricEfficiency.Title')}:
                                 </td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields withunit"><input type="text" placeholder="34.5" name="electricity_efficienty" id="electricity_efficienty"/><span>%</span></td>
                              </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
            );
         }
         if(this.state.selectedSource=="CHP plant" || this.state.selectedSource=="Air compressor"){
            var conditionalCHPAddField=(
                <tr>
                    <td className="nested-table"
                         colSpan="3"
                         style={CustomTable}>
                    <table className="table">
                        <tbody>
                        <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.TechnicalData.ManufacturerText.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields">
                                    <select className="required-field" name="heat_manufacturer" id="heat_manufacturer">
                                       <option value="EC-Power">EC-Power</option>
                                       <option value="option1">option1</option>
                                       <option value="option2">option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.TechnicalData.TypeText.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields">
                                    <select className="required-field" name="heat_manufacturer_type" id="heat_manufacturer_type">
                                       <option value="XRGI 15">XRGI 15</option>
                                       <option value="option1">option1</option>
                                       <option value="option2">option2</option>
                                    </select>
                                 </td>
                              </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
            );
         }
         if(this.state.selectedSource=="CHP plant" || this.state.selectedSource=="District heat"){
            var additionalOption=(<p className="additional-options">{this.props.t('AdditionalMessage')}</p>);
         }
         if(this.state.selectedSource=="Air compressor"){
            var conditionalAirField=(
                <tr>
                    <td className="nested-table"
                         colSpan="3"
                         style={CustomTable}>
                    <table className="table">
                        <tbody>
                        <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.TechnicalData.OperationHours.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Location explanation/tip" data-original-title="" title="">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields withunit"><input type="text" placeholder="4.000" name="operation_hours" id="operation_hours"/><span>h/a</span>

                                 </td>
                              </tr>
                        </tbody>
                    </table>
                    </td>
                </tr>
            );
         }

        return (
            <div className="modal modal_multi"  role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="heat-source">
            <form  className="heat-source-form" id="heat-source-form">
         <div className="modal-content">
            <div className="modal-heading">
               <div className="left-head"> {this.props.t('HeatSource.Title')}</div>
               <div className="right-head">
                  <ul className="list-inline">
                     <li><input className="save-changes-btn" onClick={this.handleHeatSubmit} type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')}/></li>
                    <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close close-modal-heatsource"  aria-label="Close"/></span></li>
                  </ul>
               </div>
            </div>
            <div className="modal-body-content">
               {expertRoleHtml}
               <div id="tabsJustifiedContent2" className="tab-content">
                  <div id="technical-data" className="tab-pane fade  active show">
                     <div className="option-general-div">
                        <div className="table-responsive">
                           <table className="table">
                           <tbody>
                              <tr>
                                 <td className="input-label"> {this.props.t('HeatSource.Tab.TechnicalData.Name.Title')}:	</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content={this.props.t('HeatSource.Tab.TechnicalData.Name.Placeholder')} >
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name="heat_name" id="heat_name" placeholder="CHP in the basement" />
                                 <input type="hidden" placeholder="Chiller 1" id="heatsourceformMode"   name="heatsourceformMode" value="add" />
                                    <input type="hidden" placeholder="Chiller 1" id="heatsourceformModeKey"   name="heatsourceformModeKey" value="" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.TechnicalData.TypeOfHeatSource.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields">
                                    <select className="required-field" name="heat_type" id="heat_type" required="required" onChange={(elem)=>this.changeField(elem)} >
                                       <option value="Process heat"> Process heat</option>
                                       <option value="CHP plant">CHP plant</option>
                                       <option value="Air compressor">Air compressor</option>
                                       <option value="District heat">District heat</option>
                                       <option value="Solar thermal">Solar thermal</option>
                                       <option value="other">other</option>
                                    </select>
                                 </td>
                              </tr>
                              {conditionalHeatField}
                              {conditionalCHPField}
                              {conditionalCHPAddField}
                              {conditionalAirField}
                              <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.TechnicalData.NewInstallation.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Location explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields">
                                    <select  name="new_installation" id="new_installation">
                                       <option value="No">No</option>
                                       <option value="option1">option1</option>
                                       <option value="option2">option2</option>
                                    </select>
                                 </td>
                              </tr>
                              </tbody>
                           </table>
                        </div>
                        {additionalOption}
                     </div>
                  </div>
                  <div id="calculation-data" className="tab-pane fade">
                     <div className="personal-data-div">
                        <div className="table-responsive">
                           <table className="table">
                           <tbody>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.CalculationData.InvestmentCosts.Title')}:	</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Editor explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="€" name="heat_investment_cost" id="heat_investment_cost" /> </td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.CalculationData.Discount.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Company explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="%"  name="heat_investment_discount" id="heat_investment_discount"  /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatSource.Tab.CalculationData.MaintenanceCosts.Title')}: </td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Address explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="€/kWh" name="heat_maintenance_cost" id="heat_maintenance_cost" /> </td>
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

export default translate(HeatSourceModal);
