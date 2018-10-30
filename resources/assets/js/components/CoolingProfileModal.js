import React from 'react';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
let selectedSource='Process heat';
const CustomTable = {
    padding: "0px"
};
class CoolingProfileModal extends React.Component {
    constructor(props){
        super(props);
        this.state = {CoolingProfile: '',selectedSource:selectedSource};
        this.handleCoolingSubmit = this.handleCoolingSubmit.bind(this);
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


          $('.close-modal-CoolingProfile').on('click', function (e) {

              const obj = this;
              // alert('Heat')

              if ($('#cooling-profile-form').hasClass('form-edited')) {
                  //alert('ccccccc')
                  e.preventDefault();

                  $('#compression-modal-confirm').modal('show');


              }
              else {
                  $("#cooling-profile").modal("hide");
                  $("#cooling-profile-form")[0].reset()
              }



          })



      }
      showAllHeatSourceErrorMessages() {
        var form = $("form.cooling-profile-form"),
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
    handleCoolingSubmitChange (CoolingProfile) {
        var result={
            CoolingProfile:CoolingProfile,
            state:true
        }

        CHANGE_FORM=true;
        this.props.onCoolingProfileSubmit(result);
     }
      handleCoolingSubmit(e){
        if (!this.showAllHeatSourceErrorMessages()) {
            return false;
        }
        const that = this;
        e.preventDefault();
        var data=$('#cooling-profile-form').serialize();
        //console.log(data);
        fetch('adcalc/storeCoolingProfileInformation', {
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
                            $("#cooling-profile-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $("#cooling-profile-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $("#cooling-profile-form");
                                var data = that.getFormData($form);
                                that.setState({
                                    CoolingProfile:data
                                })
                                that.handleCoolingSubmitChange(that.state.CoolingProfile);
                                $("#cooling-profile").modal("hide");

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
                  <li className="nav-item"><a href="" data-target="#cooling-technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('CoolingProfile.Tab.TechnicalData.Title')}</a></li>
                  <li className="nav-item"><a href="" data-target="#cooling-calculation-data" data-toggle="tab" className="nav-link">{this.props.t('CoolingProfile.Tab.CalculationData.Title')}</a></li>
         </ul>);
            var expertHtml=(
                <tr>
                <td className="nested-table"
                     colSpan="3"
                     style={CustomTable}>
                <table className="table">
                    <tbody><tr>
                                    <td className="input-label">Base load:</td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields">
                                       <ul className="list-inline">
                                          <li><input type="text" placeholder="10.0 kW" required pattern="\d*" className="required-field onlynumeric" name="cooling_base_load_to" id="cooling_base_load_to" /></li>
                                          <li>from </li>
                                          <li><input type="text" placeholder="10°C"  required pattern="\d*" className="icon-field required-field onlynumeric" name="cooling_base_load_from" id="cooling_base_load_from" /></li>
                                       </ul>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td className="input-label">Zero load:</td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields">
                                       <ul className="list-inline">
                                          <li><input type="text" placeholder="0.0 kW"  name="cooling_zero_load_from" id="cooling_zero_load_from"  />
                                          </li>
                                          <li>from</li>
                                          <li> <input type="text" placeholder="10 °C" className="icon-field " name="cooling_zero_load_to" id="cooling_zero_load_to" /><i className="fa fa-calculator dropdown-calci" aria-hidden="true"></i></li>
                                       </ul>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td className="input-label">Cooling hours:</td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields">
                                       <input type="text" placeholder="6,724 h" className="icon-field "  name="cooling_cooling_hours" id="cooling_cooling_hours"  /><i className="fa fa-calculator myBtn_multi" aria-hidden="true"></i>
                                    </td>
                                 </tr>
             </tbody>
                    </table>
                    </td>
                </tr>);
                var expertOption=(<option value='other'>Other</option>);
                var expertadditionalHtml=( <tr>
                    <td className="input-label"> Chilled water inlet
                       temperature:
                    </td>
                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Address explanation/tip">
                       <img src="public/images/help-red.png" alt="" />
                       </button>
                    </td>
                    <td className="input-fields"><input type="text" placeholder="19°C"  name="cooling_cooling_other" id="cooling_cooling_other"/> </td>
                 </tr>);

        }
        else{
            var expertRoleHtml=(
                <ul id="tabsJustifiedsingle" className="nav nav-tabs single-tab singletabbox">
                     <li className="nav-item"><a href="" data-target="#cooling-technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('CoolingProfile.Tab.TechnicalData.Title')}</a></li>
                     {expertRoleHtml}
                  </ul>
            );
            var expertHtml, expertOption,expertadditionalHtml="";
        }
        var conditionalHtml="";
        if(this.state.selectedSource=="Process cooling" || this.state.selectedSource=="other"){
            conditionalHtml=(<tr>
                <td className="input-label"> Chilled water
                   temperature:
                </td>
                <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Address explanation/tip">
                   <img src="public/images/help-red.png" alt="" />
                   </button>
                </td>
                <td className="input-fields"><input type="text" placeholder="16°C" name="cooling_chilled_water" id="cooling_chilled_water"/> </td>
             </tr>);
        }

        return (
            <div className="modal modal_multi" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="cooling-profile">
            <form  className="cooling-profile-form" id="cooling-profile-form">
            <div className="modal-content">
               <div className="modal-heading">
                  <div className="left-head"> Cooling Load Profile</div>
                  <div className="right-head">
                  <ul className="list-inline">
                     <li><input className="save-changes-btn" onClick={this.handleCoolingSubmit} type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')}/></li>
                    <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-CoolingProfile"  aria-label="Close"/></span></li>
                  </ul>
                  </div>
               </div>
               <div className="modal-body-content">
                 {expertRoleHtml}
                  <div id="tabsJustifiedContent2" className="tab-content">
                     <div id="cooling-technical-data" className="tab-pane fade  active show">
                        <div className="heating-load-general-div">
                           <div className="table-responsive">
                                            <table className="table">
                                                <tbody><tr>
                                                    <td className="input-label"> Name:	</td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Project number explanation/tip">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields"><input type="text" placeholder="Radiant cooling office" name="cooling_radiant_cooling_office" id="cooling_radiant_cooling_office" />
                                                        <input type="hidden" placeholder="Chiller 1" id="coolingprofileformMode" name="coolingprofileformMode" value="add" />
                                                        <input type="hidden" placeholder="Chiller 1" id="coolingprofileformModeKey" name="coolingprofileformModeKey" value="" /></td>
                                                </tr>
                                                    <tr>
                                                        <td className="input-label">Profile Type:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields">
                                                            <select className="required-field" onChange={(elem) => this.changeField(elem)} name="cooling_profile_type" id="cooling_profile_type">
                                                                <option value="Office Space">Office Space</option>
                                                                <option value="Process cooling">Process Cooling</option>
                                                                <option value="Hot Water Demand">Hot Water Demand</option>
                                                                {expertOption}
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    {conditionalHtml}
                                                    {expertadditionalHtml}
                                                    <tr>
                                                        <td className="input-label">Max. cooling load:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Customer explanation/tip">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields">
                                                            <ul className="list-inline">
                                                                <li><input type="text" required placeholder="50.0 kW" pattern="\d*" className="required-field onlynumeric" name="cooling_max_cooling_load" id="cooling_max_cooling_load" /></li>
                                                                <li> at </li>
                                                                <li><input type="text" placeholder="34°C" className="icon-field" name="cooling_max_cooling_load_at" id="cooling_max_cooling_load_at" /><i className="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
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
                     <div id="cooling-calculation-data" className="tab-pane fade">
                        <div className="personal-data-div">
                           <div className="table-responsive">
                                            <table className="table">
                                                <tbody><tr>
                                                    <td className="input-label">Investment costs:	</td>
                                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Editor explanation/tip">
                                                        <img src="public/images/help-red.png" alt="" />
                                                    </button>
                                                    </td>
                                                    <td className="input-fields"><input type="text" placeholder="€" name="cooling_investment_cost" id="cooling_investment_cost" /> </td>
                                                </tr>
                                                    <tr>
                                                        <td className="input-label">Discount:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Company explanation/tip">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields"><input type="text" placeholder="%" name="cooling_investment_discount" id="cooling_investment_discount" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label"> Maintenance costs: </td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Address explanation/tip">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields"><input type="text" placeholder="€/a" name="cooling_maintenance_cost" id="cooling_maintenance_cost" /> </td>
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

export default translate(CoolingProfileModal);