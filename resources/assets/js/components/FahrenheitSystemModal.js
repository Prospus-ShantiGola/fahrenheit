import React from 'react';
import { translate } from 'react-multi-lang';
import AddChillerModal from './AddChillerModal';
import AddRecoolerModal from './AddRecoolerModal';
import axios from 'axios';
let selectedSource='Process heat';
const CustomTable = {
    padding: "0px",
    width:'100%'
};

class FahrenheitSystemModal extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            chillerStateChange:{
                chillerRecord:[],
                stateChange:false
            },
            recoolerStateChange:{
                recoolerRecord:[],
                stateChange:false
            },
            HeatingProfile: '',
            selectedSource:selectedSource,
        compressionArr:[],
        recoolerArr:[]
        };
        this.handleFahrenheitSubmit = this.handleFahrenheitSubmit.bind(this);
        this.handleHeatSubmitChange = this.handleHeatSubmitChange.bind(this);
        this.changeField = this.changeField.bind(this);
        this.handleChillerForm = this.handleChillerForm.bind(this);
        this.handleRecoolerForm = this.handleRecoolerForm.bind(this);
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
    handleRecoolerForm(result) {
        if (result.recoolerInformation.addrecoolerformMode == "add") {
            this.setState({
                recoolerStateChange: {
                    stateChange: result.state,
                    recoolerRecord: this.state.recoolerStateChange.recoolerRecord.concat(result.recoolerInformation)
                }
            });

        } else {
            this.state.recoolerStateChange.recoolerRecord[result.recoolerInformation.addrecoolerformModeKey] = result.recoolerInformation
            this.forceUpdate()
        }
    }
    handleChillerForm(result) {
        if (result.chillerInformation.addchillerformMode == "add") {
            this.setState({
                chillerStateChange: {
                    stateChange: result.state,
                    chillerRecord: this.state.chillerStateChange.chillerRecord.concat(result.chillerInformation)
                }
            });
            //store.dispatch( addChiller(result.chillerInformation) )
        } else {
            this.state.chillerStateChange.chillerRecord[result.chillerInformation.addchillerformModeKey] = result.chillerInformation
            this.forceUpdate()
        }
    }
    editHeatRecord(elemKey,modalID,data){
        let dataObj="";
        switch (modalID.hiddenmodekey) {
                case 'addchillerformModeKey':
                   dataObj=this.state.chillerStateChange.chillerRecord[elemKey];
                break;
                case 'addrecoolerformModeKey':
                dataObj=this.state.recoolerStateChange.recoolerRecord[elemKey];
                break;
            default:
               dataObj=this.state.chillerStateChange.chillerRecord[elemKey];
                break;
        }

        dataObj=Array(data);
        for (var key in data) {

                //console.log($('#'+modalID.modalID).find('#'+key),dataObj,key);
                $('#'+modalID.modalId).find('#'+key).val(data[key]);

        }
        $('#'+modalID.modalId).find('#'+modalID.hiddenmode).val("edit");
        $('#'+modalID.modalId).find('#'+modalID.hiddenmodekey).val(elemKey);
        //$(this.props.modalId).find
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
          $(".close-modal-fahrenheit").on("click", function(e) {
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

      showAllHearSourceErrorMessages() {
        var form = $("form.fahrenheit-system-form"),
            errorList = $("ul.errorMessages", form),
            errorFound = true;

        errorList.removeClass("hide");
        errorList.empty();
        return errorFound;
    }
      handleHeatSubmitChange (HeatingProfile) {
        var result={
            HeatingProfile:HeatingProfile,
            state:true
        }

        CHANGE_FORM=true;
        this.props.onfinalSubmit(result);
     }
     handleFahrenheitSubmit(e){
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

        $.map(unindexed_array, function(n){
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
    groupBy(xs, key) {
        if(xs.length==0) return [];
        return xs.reduce(function(rv, x) {
          (rv[x[key]] = rv[x[key]] || []).push(x);
          return rv;
        }, {});
    }
    callApi=() => {
        axios.get(`https://jsonplaceholder.typicode.com/users`)
            .then(res => {
                const persons = res.data;
                this.setState({ persons });
                console.log(persons);
            });
    }
    render() {
        var that=this;
        if(this.props.role=="expert"){
            var expertRoleHtml=(<ul id="tabsJustifieddouble" className="nav nav-tabs double-tab">
                  <li className="nav-item"><a href="" data-target="#heating-technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('HeatingProfile.Tab.TechnicalData.Title')}</a></li>
                  <li className="nav-item"><a href="" data-target="#heating-calculation-data" data-toggle="tab" className="nav-link">{this.props.t('HeatingProfile.Tab.CalculationData.Title')}</a></li>
         </ul>);

        }
        else{
            var expertRoleHtml=(
                <ul id="tabsJustifiedsingle" className="nav nav-tabs single-tab singletabbox">
                     <li className="nav-item"><a href="" data-target="#heating-technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('HeatingProfile.Tab.TechnicalData.Title')}</a></li>
                     {expertRoleHtml}
                  </ul>
            );
        }


        let addSorptionArray = this.state.chillerStateChange.chillerRecord.filter(function (el,index) {
            return el.chiller_chiller_type == "Adsorption"
        });
        let compressionArray = this.state.chillerStateChange.chillerRecord.filter(function (el,index) {
            return el.chiller_chiller_type == "Compression"
        });
        console.log(this.state.chillerStateChange.chillerRecord);
        console.log(addSorptionArray,compressionArray);
        let recoolerArray=[];
        recoolerArray.push(this.groupBy(this.state.recoolerStateChange.recoolerRecord,'recooler_product'));


        projectData['chillerInfo']=this.state.chillerStateChange.chillerRecord;
        projectData['recooling']=this.state.recoolerStateChange.recoolerRecord;
        var counter=addSorptionArray.length;
        var that=this;
        return (
            <div>

            <div className="modal modal_multi" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="fahrenheit-system">
            <form  className="fahrenheit-system-form" id="fahrenheit-system-form">
    <div className="modal-content">

      <div className="modal-heading">
        <div className="left-head"> {this.props.t('Fahrenheit.Title')} </div>
        <div className="right-head">
        <ul className="list-inline">
                     <li><input className="save-changes-btn" onClick={this.handleFahrenheitSubmit} type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')}/></li>
                    <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-fahrenheit"  aria-label="Close"/></span></li>
                  </ul>
        </div>
      </div>
      <div className="modal-body-content">
        <ul id="tabsJustifiedlast" className="nav nav-tabs">
          <li className="nav-item"><img src="public/images/plus-icon.png" className="myBtn_multi modal-openn" alt="" data-toggle="modal" data-backdrop="false" data-target="#add-chiller"/> <a href=""
              data-target="#chillar" data-toggle="tab" className="nav-link small active">{this.props.t('Fahrenheit.Tab.Chiller.Title')} </a></li>
          <li className="nav-item">
            <img src="public/images/plus-icon.png" className="myBtn_multi modal-openn" alt="" data-toggle="modal" data-backdrop="false" data-target="#add-recooler" />
            <a href="JavaScript:Void(0)" data-target="#chillar" data-toggle="tab" className="nav-link" > <span className="center-text">{this.props.t('Fahrenheit.Tab.Recooling.Title')}</span> <img src="public/images/cacli-icon.png" alt="caculator"  /></a>
            <div className="caculator-divv">
              <div className="calci-div" ></div>
            </div>
          </li>
        </ul>
                                <div id="tabsJustifiedContentlast" className="tab-content">
                                    <div id="chillar" className="tab-pane fade  active show">
                                        <div className="chiller-div">
                                            <div className="table-responsive">
                                                <table className="table">
                                                        <tbody></tbody>
                                                    {(() => {
                                                                if(addSorptionArray.length>0){
                                                                    return (
                                                                        <tr>
                                                                        <td>
                                                                            <p>{this.props.t('Fahrenheit.Tab.Chiller.AdsorptionProductGroup.Title')}</p>
                                                                        </td>
                                                                        <td>
                                                                            <p>2.20</p>
                                                                        </td>
                                                                        <td>

                                                                        </td>
                                                                    </tr>
                                                                    )
                                                                }
                                                            })()}
                                                    {addSorptionArray.map((data, h) => (
                                                        <tr key={h} data-id={h} data-edit='chillers'>

                                                            <td>
                                                                <p>{data.chiller_product}</p>
                                                            </td>
                                                            <td>
                                                                <p>{data.chiller_product_inter}</p>
                                                            </td>
                                                            <td>
                                                                <ul className="list-inline">
                                                                    <li><span className="edit-option" data-id={h} data-toggle="modal" data-backdrop="false" data-target="#add-chiller" ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={() => this.editHeatRecord(h, { hiddenmode: "addchillerformMode", hiddenmodekey: "addchillerformModeKey",modalId:"add-chiller" },data)}></i></span></li>
                                                                    <li> <span className="delete-optionn" data-id={h} ><i className="fa fa-trash-o" aria-hidden="true" data-modal="delete-heat-modal" onClick={(elem) => this.deleteRecord(h, elem)}></i></span></li>
                                                                    <li><span className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    ))}
                                                         {(() => {
                                                                if(compressionArray.length>0){
                                                                    return (
                                                                        <tr>
                                                                            <td>

                                                                                <p>{this.props.t('Fahrenheit.Tab.Chiller.CompressionChillerGroup.Title')}</p>

                                                                            </td>
                                                                            <td></td>
                                                                            <td>

                                                                            </td>
                                                                        </tr>
                                                                    )
                                                                }
                                                            })()}


                                                    {

                                                        compressionArray.map((data, h) => (

                                                        <tr key={h} data-id={h+1} data-edit='chillers'>

                                                            <td>
                                                                <p>{data.chiller_product}</p>
                                                            </td>
                                                            <td>
                                                                <p>{data.chiller_product_inter}</p>
                                                            </td>
                                                            <td>
                                                                <ul className="list-inline">
                                                                    <li><span className="edit-option" data-id={h} data-toggle="modal" data-backdrop="false" data-target="#add-chiller" ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={() => this.editHeatRecord(h+1, { hiddenmode: "addchillerformMode", hiddenmodekey: "addchillerformModeKey",modalId:"add-chiller"  },data)}></i></span></li>
                                                                    <li> <span className="delete-optionn" data-id={h} ><i className="fa fa-trash-o" aria-hidden="true" data-modal="delete-heat-modal" onClick={(elem) => this.deleteRecord(h, elem)}></i></span></li>
                                                                    <li><span className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    ))}
                                                    {recoolerArray.map((data) => (
                                                        Object.keys(data).map(function (template_name) {
                                                            return (
                                                                <tr key={template_name.id}>
                                                                    <td colSpan="3">

                                                              <table  style={CustomTable}>
                                                              <tbody></tbody>
                                                                <tr>
                                                                  <td>
                                                                  <p>{that.props.t('Fahrenheit.Tab.Chiller.RecoolerProductGroup.Title')}</p>
                                                                  </td>
                                                                  <td></td>
                                                        <td>

                                                        </td>
                                                                </tr>
                                                                    {

                                                                        data[template_name].map(function (item,h) {

                                                                        return (

                                                                            <tr key={item.id}>
                                                                            <td>

                                                                                <p>{item.recooler_product}</p>
                                                                            </td>
                                                                            <td></td>
                                                                            <td>
                                                                                    <ul className="list-inline">
                                                                                        <li><span className="edit-option" data-id={h} data-toggle="modal" data-backdrop="false" data-target="#add-recooler" ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={() => that.editHeatRecord(h, { hiddenmode: "addrecoolerformMode", hiddenmodekey: "addrecoolerformModeKey",modalId:"add-recooler"  })}></i></span></li>
                                                                                        <li> <span className="delete-optionn" data-id={h} ><i className="fa fa-trash-o" aria-hidden="true" data-modal="delete-heat-modal" onClick={(elem) => this.deleteRecord(h, elem)}></i></span></li>
                                                                                        <li><span className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span></li>
                                                                                    </ul>
                                                                            </td>
                                                                        </tr>
                                                                        );
                                                                    })}
                                                              </table>
                                                              </td>
                                                                </tr>
                                                            );
                                                          })

                                                    ))
                                                    }
                                                    {/* <tr>
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
                                                    </tr> */}
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
            <AddRecoolerModal onRecoolerSubmit={this.handleRecoolerForm}/>
     </div>
        );
    }
}

export default translate(FahrenheitSystemModal);
