import React from 'react';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
let selectedSource='Process heat';
const CustomTable = {
    padding: "0px"
};
class HeatingProfileModal extends React.Component {
    constructor(props){
        super(props);
        this.state = {HeatingProfile: '',selectedSource:selectedSource};
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


          $('.close-modal-HeatingProfile').on('click', function (e) {

              const obj = this;
              // alert('Heat')

              if ($('#heating-profile-form').hasClass('form-edited')) {
                  //alert('ccccccc')
                  e.preventDefault();

                  $('#compression-modal-confirm').modal('show');


              }
              else {
                  $("#heating-profile").modal("hide");
                  $("#heating-profile-form")[0].reset()
              }



          })



      }
       handleLangChange (HeatingProfile) {
        var result={
            HeatingLoadProfile:HeatingProfile,
            state:true
        }

        CHANGE_FORM=true;
        this.props.onChillerSubmit(result);
     }
      showAllHearSourceErrorMessages() {
        var form = $("form.heating-profile-form"),
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
      handleHeatSubmitChange (HeatingProfile) {
        var result={
            HeatingProfile:HeatingProfile,
            state:true
        }

        CHANGE_FORM=true;
        this.props.onHeatProfileSubmit(result);
     }
      handleHeatSubmit(e){
        if (!this.showAllHearSourceErrorMessages()) {
            return false;
        }
        const that = this;
        e.preventDefault();
        var data=$('#heating-profile-form').serialize();
        //console.log(data);
        fetch('adcalc/storeHeatingProfileInformation', {
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
                            $("#heating-profile-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $("#heating-profile-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $("#heating-profile-form");
                                var data = that.getFormData($form);
                                that.setState({
                                    HeatingProfile:data
                                })
                                if ($("#heating-profile-form #heatingprofileformMode").val() =="add") {
                                    $("#heating-profile-form")[0].reset();
                                }
                                that.handleHeatSubmitChange(that.state.HeatingProfile);

                                $("#heating-profile").modal("hide");

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
                  <li className="nav-item"><a href="" data-target="#heating-technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('HeatingProfile.Tab.TechnicalData.Title')}</a></li>
                  <li className="nav-item"><a href="" data-target="#heating-calculation-data" data-toggle="tab" className="nav-link">{this.props.t('HeatingProfile.Tab.CalculationData.Title')}</a></li>
         </ul>);
            var expertHtml=(
                <tr>
                <td className="nested-table"
                     colSpan="3"
                     style={CustomTable}>
                <table className="table">
                    <tbody>
            <tr>
                <td className="input-label">{this.props.t('HeatingProfile.Tab.TechnicalData.BaseLoad.Title')}:</td>
                <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover" data-placement="bottom" data-content={this.props.t('HeatingProfile.Tab.TechnicalData.BaseLoad.InfoTool')}>
                   <img src="public/images/help-red.png" alt="" />
                   </button>
                </td>
                <td className="input-fields">
                   <ul className="list-inline">
                      <li className="withunit"><input type="text" placeholder="8.0" pattern="\d*"  required="required" className="required-field onlynumeric" name="base_load_power" id="base_load_power" /><span>kw</span></li>
                      <li>{this.props.t('HeatingProfile.Tab.TechnicalData.From.Title')} </li>
                      <li className="withunit" ><input type="text" placeholder="0" pattern="\d*"  required="required" className="icon-field required-field onlynumeric" name="base_load_temp" id="base_load_temp"  /><span>°C</span></li>
                   </ul>
                </td>
             </tr>
             <tr>
                <td className="input-label">{this.props.t('HeatingProfile.Tab.TechnicalData.ZeroLoad.Title')}:</td>
                <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover" data-placement="bottom" data-content={this.props.t('HeatingProfile.Tab.TechnicalData.ZeroLoad.InfoTool')}>
                   <img src="public/images/help-red.png" alt="" />
                   </button>
                </td>
                <td className="input-fields">
                   <ul className="list-inline">
                      <li className="withunit"><input type="text" placeholder="0.0" pattern="\d*"  required="required" className="required-field" name="zero_load_power" id="zero_load_power"  />
                      <span>kw</span></li>
                      <li>{this.props.t('HeatingProfile.Tab.TechnicalData.From.Title')}</li>
                      <li className="withunit"> <input type="text" placeholder="20" pattern="\d*"  className="icon-field onlynumeric" name="zero_load_temp" id="zero_load_temp" /><span>°C</span></li>
                   </ul>
                </td>
             </tr>
             </tbody>
                    </table>
                    </td>
                </tr>);

        }
        else{
            var expertRoleHtml=(
                <ul id="tabsJustifiedsingle" className="nav nav-tabs single-tab singletabbox">
                     <li className="nav-item"><a href="" data-target="#heating-technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('HeatingProfile.Tab.TechnicalData.Title')}</a></li>
                     {expertRoleHtml}
                  </ul>
            );
            var expertHtml="";
        }



        return (
            <div className="modal modal_multi" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="heating-profile">
            <form  className="heating-profile-form" id="heating-profile-form">
         <div className="modal-content">
            <div className="modal-heading">
               <div className="left-head"> {this.props.t('HeatingProfile.Title')} </div>
               <div className="right-head">
               <ul className="list-inline">
                     <li><input className="save-changes-btn" onClick={this.handleHeatSubmit}  ref={btn => { this.btn = btn; }} type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')}/></li>
                    <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close close-modal-HeatingProfile"  aria-label="Close"/></span></li>
                  </ul>
               </div>
            </div>
            <div className="modal-body-content">
            {expertRoleHtml}
               <div id="tabsJustifiedContent2" className="tab-content">
                  <div id="heating-technical-data" className="tab-pane fade  active show">
                     <div className="heating-load-general-div">
                        <div className="table-responsive">
                           <table className="table">
                           <tbody>
                              <tr>
                                 <td className="input-label"> {this.props.t('HeatingProfile.Tab.TechnicalData.Name.Title')}:	</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover" data-placement="bottom" data-content="Project number explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder={this.props.t('HeatingProfile.Tab.TechnicalData.Name.Placeholder')}  name="profile_name" id="profile_name"/>
                                 <input type="hidden" placeholder="Chiller 1" id="heatingprofileformMode"   name="heatingprofileformMode" value="add" />
                                 <input type="hidden" placeholder="Chiller 1" id="heatingprofileformModeKey"   name="heatingprofileformModeKey" value="" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatingProfile.Tab.TechnicalData.ProfileType.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover" data-placement="bottom" data-content= {this.props.t('HeatingProfile.Tab.TechnicalData.ProfileType.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields">
                                    <select className="required-field" name="profile_type" id="profile_type">
                                       <option value="Office Space">Office Space</option>
                                       <option value="Process heating">Process heating</option>
                                       <option value="Hot Water Demand">Hot Water Demand</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatingProfile.Tab.TechnicalData.MaxHeatingLoad.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover" data-placement="bottom" data-content={this.props.t('HeatingProfile.Tab.TechnicalData.MaxHeatingLoad.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields ">
                                    <ul className="list-inline">
                                       <li className="withunit"><input type="text" placeholder="52.2 " pattern="\d*" className="required-field onlynumeric" required="required" name="max_heat_load_power" id="max_heat_load_power" /><span>kw</span></li>
                                       <li> {this.props.t('HeatingProfile.Tab.TechnicalData.At.Title')} </li>
                                       <li><input type="text" placeholder="-15"  pattern="\d*" className="icon-field onlynumeric"  name="max_heat_load_temp" id="max_heat_load_temp"  />
                                       </li>
                                    </ul>
                                 </td>
                              </tr>
                              {expertHtml}
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div className="caculator-divv">
                        <div className="calci-div"></div>
                     </div>
                  </div>
                  <div id="heating-calculation-data" className="tab-pane fade">
                     <div className="personal-data-div">
                        <div className="table-responsive">
                           <table className="table">
                           <tbody>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatingProfile.Tab.CalculationData.InvestmentCosts.Title')}:	</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover" data-placement="bottom" data-content={this.props.t('HeatingProfile.Tab.CalculationData.InvestmentCosts.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields withunit"><input type="text" placeholder="0"  name="hp_investment_cost" id="hp_investment_cost" /> <span>€</span></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatingProfile.Tab.CalculationData.Discount.Title')}:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover" data-placement="bottom" data-content={this.props.t('HeatingProfile.Tab.CalculationData.Discount.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields withunit"><input type="text" placeholder="0" name="hp_discount" id="hp_discount" /><span>%</span></td>
                              </tr>
                              <tr>
                                 <td className="input-label">{this.props.t('HeatingProfile.Tab.CalculationData.MaintenanceCosts.Title')}: </td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover"  data-trigger="hover" data-placement="bottom" data-content={this.props.t('HeatingProfile.Tab.CalculationData.MaintenanceCosts.InfoTool')}>
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields withunit"><input type="text" placeholder="0" name="maintenance_cost" id="maintenance_cost" /> <span>€/a</span></td>
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

export default translate(HeatingProfileModal);
