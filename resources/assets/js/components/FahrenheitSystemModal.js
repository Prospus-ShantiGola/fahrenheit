import React from 'react';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
import AddChillerModal from './AddChillerModal';
import AddRecoolerModal from './AddRecoolerModal';
let selectedSource='Process heat';
const CustomTable = {
    padding: "0px"
};
class FahrenheitSystemModal extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            chillerStateChange:{
                chillerRecord:[],
                stateChange:false
            },
            HeatingProfile: '',
            selectedSource:selectedSource};
        this.handleHeatSubmit = this.handleHeatSubmit.bind(this);
        this.changeField = this.changeField.bind(this);
        this.handleChillerForm = this.handleChillerForm.bind(this);
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
    handleChillerForm (result)  {


        if(result.chillerInformation.addchillerformMode=="add"){
            this.setState({chillerStateChange:{
                stateChange:result.state,
                chillerRecord:this.state.chillerStateChange.chillerRecord.concat(result.chillerInformation)
                }
});
        }else{
            this.state.chillerStateChange.chillerRecord[result.chillerInformation.addchillerformModeKey]= result.chillerInformation
            this.forceUpdate()
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


          $(".fahrenheit-system").on("click", function(e) {
              const obj = this;
              // alert('Heat')

              if ($("#fahrenheit-system-form").hasClass("form-edited")) {
                  //alert('ccccccc')
                  e.preventDefault();

                  $("#compression-modal-confirm").modal("show");
              } else {
                  $("#fahrenheit-system").modal("hide");
                  $("#fahrenheit-system-form")[0].reset();
              }
          });



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
        var form = $("form.fahrenheit-system-form"),
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
        var data=$('#fahrenheit-system-form').serialize();
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
                            $("#fahrenheit-system-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $("#fahrenheit-system-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $("#fahrenheit-system-form");
                                var data = that.getFormData($form);
                                that.setState({
                                    HeatingProfile:data
                                })
                                that.handleHeatSubmitChange(that.state.HeatingProfile);
                                $("#fahrenheit-system").modal("hide");

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
                      <li><input type="text" placeholder="8.0 kw" pattern="\d*"  required="required" className="required-field onlynumeric" name="base_load_power" id="base_load_power"  /></li>
                      <li>{this.props.t('HeatingProfile.Tab.TechnicalData.From.Title')} </li>
                      <li><input type="text" placeholder="°C" pattern="\d*"  required="required" className="icon-field required-field onlynumeric" name="base_load_temp" id="base_load_temp"  /></li>
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
                      <li><input type="text" placeholder="0.0 kw" pattern="\d*"  required="required" className="required-field" name="zero_load_power" id="zero_load_power"  />
                      </li>
                      <li>{this.props.t('HeatingProfile.Tab.TechnicalData.From.Title')}</li>
                      <li> <input type="text" placeholder="20 °C" pattern="\d*"  className="icon-field onlynumeric" name="zero_load_temp" id="zero_load_temp" /></li>
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


        let addSorptionArray = this.state.chillerStateChange.chillerRecord.filter(function (el) {
            return el.chiller_chiller_type == "Adsorption"
        });
        let compressionArray = this.state.chillerStateChange.chillerRecord.filter(function (el) {
            return el.chiller_chiller_type == "Compression"
        });



        return (
            <div>
            <div className="modal modal_multi" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="fahrenheit-system">
            <form  className="fahrenheit-system-form" id="fahrenheit-system-form">
    <div className="modal-content">
      <div className="modal-heading">
        <div className="left-head"> Fahrenheit System </div>
        <div className="right-head">
        <ul className="list-inline">
                     <li><input className="save-changes-btn" onClick={this.handleCoolingSubmit} type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')}/></li>
                    <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-CoolingProfile"  aria-label="Close"/></span></li>
                  </ul>
        </div>
      </div>
      <div className="modal-body-content">
        <ul id="tabsJustifiedlast" className="nav nav-tabs">
          <li className="nav-item"><img src="public/images/plus-icon.png" className="myBtn_multi modal-openn" alt="" data-toggle="modal" data-backdrop="false" data-target="#add-chiller"/> <a href=""
              data-target="#chillar" data-toggle="tab" className="nav-link small active"> Chiller</a></li>
          <li className="nav-item">
            <img src="public/images/plus-icon.png" className="myBtn_multi modal-openn" alt="" data-toggle="modal" data-backdrop="false" data-target="#add-recooler" /> <a href="JavaScript:Void(0)"
              data-target="#recooling-system" data-toggle="tab" className="nav-link"> <span className="center-text">Re-cooling
                System</span> <img src="public/images/cacli-icon.png" className="dropdown-calci disabled" alt="caculator" /></a>
            <div className="caculator-divv">
              <div className="calci-div"></div>
            </div>
          </li>
        </ul>
        <div id="tabsJustifiedContentlast" className="tab-content">
          <div id="chillar" className="tab-pane fade  active show">
            <div className="chiller-div">
              <div className="table-responsive">
                <table className="table">
                  <tr>
                    <td>
                      <p>Adsorption chillers product group</p>
                      <p>eCoo 20 ST </p>
                      <p>eCoo 20 ST</p>
                    </td>
                    <td>
                      <p>2.20</p>
                      <p>2.20</p>
                      <p>2.20</p>
                    </td>
                    <td>
                      <ul className="list-inline">
                        <li><img src="public/images/edit-ico.png" alt="" /></li>
                        <li><img src="public/images/del-icon.png" alt="" /></li>
                        <li><img src="public/images/bar-icon.png" alt="" /></li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>Compression chiller product group</p>
                      <p> eWac 30 </p>
                    </td>
                    <td></td>
                    <td>
                      <ul className="list-inline">
                        <li><img src="public/images/edit-ico.png" alt="" /></li>
                        <li><img src="public/images/del-icon.png" alt="" /></li>
                        <li><img src="public/images/bar-icon.png" alt="" /></li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>Re-cooler product group</p>
                      <p>eRec 20 | 58 </p>
                    </td>
                    <td></td>
                    <td>
                      <ul className="list-inline">
                        <li><img src="public/images/edit-ico.png" alt="" /></li>
                        <li><img src="public/images/del-icon.png" alt="" /></li>
                        <li><img src="public/images/bar-icon.png" alt="" /></li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>Re-cooler product group</p>
                      <p>eRec 20 | 80</p>
                    </td>
                    <td></td>
                    <td>
                      <ul className="list-inline">
                        <li><img src="public/images/edit-ico.png" alt="" /></li>
                        <li><img src="public/images/del-icon.png" alt="" /></li>
                        <li><img src="public/images/bar-icon.png" alt="" /></li>
                      </ul>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div id="recooling-system" className="tab-pane fade">
            <div className="recooling-system-data-div">
              <div className="table-responsive">
                <table className="table">
                  <tr>
                    <td>
                      <p>Adsorption chillers product group</p>
                      <p>eCoo 20 ST </p>
                      <p>eCoo 20 ST</p>
                    </td>
                    <td>
                      <p>2.20</p>
                      <p>2.20</p>
                      <p>2.20</p>
                    </td>
                    <td>
                      <ul className="list-inline">
                        <li><img src="public/images/edit-ico.png" alt="" /></li>
                        <li><img src="public/images/del-icon.png" alt="" /></li>
                        <li><img src="public/images/bar-icon.png" alt="" /></li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>Compression chiller product group</p>
                      <p> eWac 30 </p>
                    </td>
                    <td></td>
                    <td>
                      <ul className="list-inline">
                        <li><img src="public/images/edit-ico.png" alt="" /></li>
                        <li><img src="public/images/del-icon.png" alt="" /></li>
                        <li><img src="public/images/bar-icon.png" alt="" /></li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>Re-cooler product group</p>
                      <p>eRec 20 | 58 </p>
                    </td>
                    <td></td>
                    <td>
                      <ul className="list-inline">
                        <li><img src="public/images/edit-ico.png" alt="" /></li>
                        <li><img src="public/images/del-icon.png" alt="" /></li>
                        <li><img src="public/images/bar-icon.png" alt="" /></li>
                      </ul>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>Re-cooler product group</p>
                      <p>eRec 20 | 80</p>
                    </td>
                    <td></td>
                    <td>
                      <ul className="list-inline">
                        <li><img src="public/images/edit-ico.png" alt="" /></li>
                        <li><img src="public/images/del-icon.png" alt="" /></li>
                        <li><img src="public/images/bar-icon.png" alt="" /></li>
                      </ul>
                    </td>
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
            <AddChillerModal  onChillerSubmit={this.handleChillerForm}/>
            <AddRecoolerModal />
     </div>
        );
    }
}

export default translate(FahrenheitSystemModal);
