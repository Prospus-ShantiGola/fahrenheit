import React, { Component } from 'react';
import { connect } from 'react-redux';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
import EconomicModalRow from './EconomicModalRow';

const CustomTable = {
    padding: "0px"
};
let investmentCounter,
    maintenenceCounter,
    chpCounter,
    generalCounter = 0;
const customFieldLabel = "Enter field label";
class EconomicModal extends Component {
    constructor(props) {
        super(props);
        this.displayData = [];
        this.state = {
            economicInformation: "",
            role: this.props.role,
            investmentCounter: 0,
            maintenenceCounter: 0,
            showdata: this.displayData,
            
            enableCalculator : false,
            investmentData : {},
        };

        this.handleSubmit = this.handleSubmit.bind(this);
        this.changeState = this.changeState.bind(this);
        this.myFunction = this.myFunction.bind(this);
        this.deleteInput = this.deleteInput.bind(this);
        this.cloneItem = this.cloneItem.bind(this);
        this.cloneGeneralItem = this.cloneGeneralItem.bind(this);
        this.cloneChpItem = this.cloneChpItem.bind(this);
        this.cloneMaintenenceItem = this.cloneMaintenenceItem.bind(this);
        
    }

    handleInvestmentData(evt) {
        if(evt.target){
            var key = evt.target.name;
            var value = evt.target.value;
            this.setState({
                investmentData : {...this.state.investmentData, [key] : value}
            },() => {
                if(this.state.investmentData.chp_basement && this.state.investmentData.discount_chp_basement){
                    this.setState({enableCalculator : true})
                }
            })
        }
    }

    calculateDiscount(e){
        if(this.state.investmentData.chp_basement && this.state.investmentData.discount_chp_basement){
            this.setState({enableCalculator : true})
            axios.post('http://localhost/fahrenheit/api/calculate-discount', {
                amount: this.state.investmentData.chp_basement,
                discount: this.state.investmentData.discount_chp_basement
              })
              .then(function (response) {
                alert(`Final Value : ${response.data}`);
              })
              .catch(function (error) {
                console.log(error);
              });
        }
    }


    myFunction(elem) {
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
    deleteInput(elem) {
        var customTr = elem.currentTarget.getAttribute("data-id");
        var customInput = document.getElementById(customTr);
        customInput.remove();
    }
    cloneItem(fieldName1,fieldName2) {
        $("#investmentTable tbody").append(
            $("#investmentTable tbody tr.clone").clone()
        );
        $("#investmentTable tbody tr:last")
            .not("clone")
            .removeClass("clone")
            .addClass("multiple");
            $("#investmentTable tbody tr:last").not("clone").find('input[type="text"]:first').attr('name',fieldName1);
            $("#investmentTable tbody tr:last").not("clone").find('input[type="text"]:last').attr('name',fieldName2);
        this.bindEvents();
    }

    cloneGeneralItem() {

        var trHtml =
            '<tr id="generalcustom_"> <td class="input-label"><div class="form-row align-items-center"><div class="col"><span id="customGeneral_1" contentEditable="false" suppressContentEditableWarning={true}>' +
            customFieldLabel +
            '</span>:</div><div class="col-auto"><div class="edit-divv"><i class="fa fa-pencil-square-o" aria-hidden="true" data-id="custom"></i></div><div class="delete-divv"> <i class="fa fa-trash-o" aria-hidden="true" data-id="custom" ></i></div></div></div> </td><td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Inflation rate explanation/tip"><img src="public/images/help-red.png" alt="" /></button></td><td class="input-fields withunit"><input type="text" pattern="\\d*" class="onlynumeric" placeholder="0.06792" name="eeg_apportion_costs[]" id="eeg_apportion_costs"/><span>€/kWh</span></td></tr>';
        $("#generalTable tbody:eq(0)").append(trHtml);
        $("#generalTable tbody tr:last")
            .not("clone")
            .removeClass("clone")
            .addClass("multiple");
        this.bindEvents();
    }
    cloneChpItem() {
        var trHtml =
            '<tr id="chpcustom_"> <td class="input-label"><div class="form-row align-items-center"><div class="col"><span id="customChp_1" contentEditable="false" suppressContentEditableWarning={true}>' +
            customFieldLabel +
            '</span>:</div><div class="col-auto"><div class="edit-divv"><i class="fa fa-pencil-square-o" aria-hidden="true" data-id="custom"></i></div><div class="delete-divv"> <i class="fa fa-trash-o" aria-hidden="true" data-id="custom" ></i></div></div></div> </td><td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Inflation rate explanation/tip"><img src="public/images/help-red.png" alt="" /></button></td><td class="input-fields withunit"><input type="text" pattern="\\d*" class="onlynumeric" placeholder="0.06792" name="eeg_chp_apportion_costs[]" id="eeg_apportion_costs"/><span>€/kWh</span></td></tr>';

        $("#chpTable tbody:eq(0)").append(trHtml);
        $("#chpTable tbody tr:last")
            .not("clone")
            .removeClass("clone")
            .addClass("multiple");
        this.bindEvents();
    }
    cloneMaintenenceItem(fieldName) {
        $("#maintenenceTable tbody").append(
            $("#maintenenceTable tbody tr.clone").clone()
        );
        $("#maintenenceTable tbody tr:last")
            .not("clone")
            .removeClass("clone")
            .addClass("multiple");
        $("#maintenenceTable tbody tr:last").not("clone").find('input[type="text"]').attr('name',fieldName);
        this.bindEvents();
    }

    bindEvents() {
        var that = this;
        $("#investmentTable tr.multiple").each(function(i) {
            $(this).attr("id", "FinancialItem_" + i);
            var spaninput = $(this).find("span");
            var editinput = $(this).find(".edit-divv i");
            var deleteinput = $(this).find(".delete-divv i");
            var inputField = $(this).find("input.price");
            var discountField = $(this).find("input.discount");
            editinput.unbind("click");
            editinput.bind("click", function(event) {
                that.myFunction(event);
            });
            spaninput.eq(0).attr("id", "custominput_" + i);
            var editStatus =
                spaninput.eq(0).attr("contentEditable") == "true"
                    ? "true"
                    : "false";
            //console.log(editStatus);
            spaninput.eq(0).attr("contentEditable", editStatus);
            editinput.eq(0).attr("data-id", "custominput_" + i);
            deleteinput.eq(0).attr("data-id", "FinancialItem_" + i);
            inputField.eq(0).attr("id", "custominputprice_" + i);
            discountField.eq(0).attr("id", "custominputdiscount_" + i);
            deleteinput.unbind("click");
            deleteinput.bind("click", function(event) {
                that.deleteInput(event);
            });
        });
        //console.log("maintenence tab",$(this))
        $("#maintenenceTable tr.multiple").each(function(i) {
            //console.log("maintenence tab",$(this))
            $(this).attr("id", "MaintenenceItem_" + i);
            var spaninput = $(this).find("span");
            var editinput = $(this).find(".edit-divv i");
            var deleteinput = $(this).find(".delete-divv i");
            var inputField = $(this).find("input");
            editinput.unbind("click");
            editinput.bind("click", function(event) {
                that.myFunction(event);
            });
            spaninput.eq(0).attr("id", "customMaintenenceInput_" + i);
            var editStatus =
                spaninput.eq(0).attr("contentEditable") == "true"
                    ? "true"
                    : "false";
            // console.log(editStatus);
            spaninput.eq(0).attr("contentEditable", editStatus);
            editinput.eq(0).attr("data-id", "customMaintenenceInput_" + i);
            deleteinput.eq(0).attr("data-id", "MaintenenceItem_" + i);
            inputField.eq(0).attr("id", "MaintenenceIteminput_" + i);
            deleteinput.unbind("click");
            deleteinput.bind("click", function(event) {
                that.deleteInput(event);
            });
        });
        $("#chpTable tr.multiple").each(function(i) {
            // console.log("chp tab",$(this))
            $(this).attr("id", "chpItem_" + i);
            var spaninput = $(this).find("span");
            var editinput = $(this).find(".edit-divv i");
            var deleteinput = $(this).find(".delete-divv i");
            var inputField = $(this).find("input");
            editinput.unbind("click");
            editinput.bind("click", function(event) {
                that.myFunction(event);
            });
            spaninput.eq(0).attr("id", "customchpInput_" + i);
            var editStatus =
                spaninput.eq(0).attr("contentEditable") == "true"
                    ? "true"
                    : "false";
            //console.log(editStatus);
            spaninput.eq(0).attr("contentEditable", editStatus);
            editinput.eq(0).attr("data-id", "customchpInput_" + i);
            deleteinput.eq(0).attr("data-id", "chpItem_" + i);
            inputField.eq(0).attr("id", "chpIteminput_" + i);
            deleteinput.unbind("click");
            deleteinput.bind("click", function(event) {
                that.deleteInput(event);
            });
        });
        $("#generalTable tr.multiple").each(function(i) {
            ///console.log("chp tab",$(this))
            $(this).attr("id", "generalItem_" + i);
            var spaninput = $(this).find("span");
            var editinput = $(this).find(".edit-divv i");
            var deleteinput = $(this).find(".delete-divv i");
            var inputField = $(this).find("input");
            editinput.unbind("click");
            editinput.bind("click", function(event) {
                that.myFunction(event);
            });
            spaninput.eq(0).attr("id", "customchpInput_" + i);
            var editStatus =
                spaninput.eq(0).attr("contentEditable") == "true"
                    ? "true"
                    : "false";
            ///console.log(editStatus);
            spaninput.eq(0).attr("contentEditable", editStatus);
            editinput.eq(0).attr("data-id", "customchpInput_" + i);
            deleteinput.eq(0).attr("data-id", "generalItem_" + i);
            inputField.eq(0).attr("id", "chpIteminput_" + i);
            deleteinput.unbind("click");
            deleteinput.bind("click", function(event) {
                that.deleteInput(event);
            });
        });
    }

    componentDidMount() {
        var that = this;
        this.bindEvents();

        var input = document.getElementsByClassName("onlynumeric");
        for (let i = 0; i < input.length; i++) {
            input[i].addEventListener(
                "invalid",
                function(e) {
                    if (this.validity.valueMissing) {
                        e.target.setCustomValidity("Please provide value");
                    } else if (!this.validity.valid) {
                        e.target.setCustomValidity(
                            "Please enter only numeric value"
                        );
                    }
                    // to avoid the 'sticky' invlaid problem when resuming typing after getting a custom invalid message
                    this.addEventListener("input", function(e) {
                        e.target.setCustomValidity("");
                    });
                },
                false
            );
        }

        jQuery(".help-toggle").unbind("click");
        jQuery(".help-toggle").click(function() {
            jQuery(".input-help-label").toggle();
        });
        jQuery("body").on("click", function(e) {
            jQuery('[data-toggle="popover"]').each(function() {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (
                    !jQuery(this).is(e.target) &&
                    $(this).has(e.target).length === 0 &&
                    $(".popover").has(e.target).length === 0
                ) {
                    jQuery(this).popover("hide");
                }
            });
        });
        $("#economic-information").on("shown.bs.modal", function() {
            $("#economic-information .nav-tabs li:eq(0) a").tab("show");
        });
        $(".close-modal-economic").on("click", function(e) {
            if ($(".economic-information-form").hasClass("form-edited")) {
                // alert('eeee')
                e.preventDefault();
                $("#economic-modal-confirm").modal("show");
            } else {
                that.hideModal();
                if (
                    $(".economic-information-form #economicformMode").val() ==
                    "add"
                ) {
                    $(".economic-information-form")[0].reset();
                }
            }
        });
        //Do stuff here
    }

    hideModal() {
        $("#economic-information").removeClass("in");
        $(".modal-backdrop").remove();
        $("#economic-information").hide();
    }

    showAllErrorMessages() {
        var form = $("form.economic-information-form"),
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
            errorList
                .show()
                .append(
                    "<li>Please enter only numeric value in '" +
                        fieldLabel +
                        "' field of " +
                        tabTitle +
                        " tab</li>"
                );
            errorFound = false;
        });
        return errorFound;
    }
    handleSubmit(event) {
        if (!this.showAllErrorMessages()) {
            return false;
        }
        event.preventDefault();
        const that = this;

        var location = $(".economic-information-form")
            .find("input[name=location]")
            .val();
        var address = $(".economic-information-form")
            .find("input[name=address]")
            .val();

        fetch("adcalc/storeEconomicInformation", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                Accept: "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                location: location,
                address: address
            })
        })
            .then(a => {
                return a.json();
            })
            .then(function(data) {
                $(".economic-information-form")
                    .find(".invalid-feedback")
                    .hide();
                jQuery.each(data.errors, function(key, value) {
                    $(".economic-information-form")
                        .find("#" + value)
                        .siblings(".invalid-feedback")
                        .show();
                });

                if (typeof data.errors == "undefined") {
                    var $form = $(".economic-information-form");
                    var data = that.getFormData($form);
                    //console.log(data);
                    investmentCounter = $("#investmentTable tbody tr.multiple")
                        .length;
                    maintenenceCounter = $(
                        "#maintenenceTable tbody tr.multiple"
                    ).length;
                    chpCounter = $("#chpTable tbody tr.multiple").length;

                    NO_CUSTOM_FIELD = investmentCounter;
                    NO_CUSTOM_FIELD_MAINTENENCE = maintenenceCounter;
                    NO_CUSTOM_FIELD_CHP = chpCounter;
                    NO_CUSTOM_FIELD_GENERAL = generalCounter;
                    that.setState({
                        economicInformation: data,
                        investmentCounter: investmentCounter
                    });
                    that.changeState(that.state.economicInformation);
                    that.hideModal();
                    $(".economic-information-form").removeClass("form-edited");
                    $(".economic-information-form #economicformMode").val(
                        "edit"
                    );
                }
            })
            .catch(err => {
                console.log(err);
            });
    }
    changeState(economicInformation) {
        var result = {
            economicInformation: economicInformation,
            state: true
        };
        CHANGE_FORM = true;
        this.props.onEconomicSubmit(result);
    }

    getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i) {
            if(n["name"].indexOf('[]')!='-1'){
                if( indexed_array[n["name"]] === undefined ) {
                    indexed_array[n["name"]]=Array();
                }
                let arrayVal=Array();
                $("input[name='"+n["name"]+"']").parents('tr').each(function(){

                    arrayVal.push($(this).find('span:first').text());
                })
               let newObj={
                    'fieldname':arrayVal,
                    'value':n["value"]
                }
                indexed_array[n["name"]].push(newObj);
            }else{
                indexed_array[n["name"]] = n["value"];
            }
        });
        console.log("index arrray",indexed_array);
        return indexed_array;
    }

    render() {
        console.log(this.props.chillers,'Chiller in echo');
        projectData['economicData']=this.state.economicInformation;

        var expertFields = "";
        if (this.state.role == "expert") {
            var expertFields = (
                <tr>
                    <td
                        className="nested-table"
                        colSpan="3"
                        style={CustomTable}
                    >
                        <table className="table">
                            <tbody>
                                <tr>
                                    <td className="input-label">
                                    {this.props.t('Economic.Tab.General.HeatPrice.Title')}:
                                    </td>
                                    <td className="input-help-label">
                                        <button
                                            type="button"
                                            className=""
                                            data-container="body"
                                            data-toggle="popover"
                                            data-placement="bottom"
                                            data-trigger="hover"
                                            data-content={this.props.t('Economic.Tab.General.HeatPrice.InfoTool')}
                                        >
                                            <img
                                                src="public/images/help-red.png"
                                                alt=""
                                            />
                                        </button>
                                    </td>
                                    <td className="input-fields withunit">
                                        <input
                                            type="text"
                                            pattern="\d*"
                                            className="onlynumeric"
                                            placeholder="0.000"
                                            name="heat_price"
                                            id="heat_price"
                                        />
                                        <span>€/kWh</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="input-label">
                                    {this.props.t('Economic.Tab.General.ElectricityPriceIncrease.Title')}:
                                    </td>
                                    <td className="input-help-label">
                                        <button
                                            type="button"
                                            className=""
                                            data-container="body"
                                            data-toggle="popover"
                                            data-placement="bottom"
                                            data-trigger="hover"
                                            data-content= {this.props.t('Economic.Tab.General.ElectricityPriceIncrease.Infotool')}
                                        >
                                            <img
                                                src="public/images/help-red.png"
                                                alt=""
                                            />
                                        </button>
                                    </td>
                                    <td className="input-fields withunit">
                                        <input
                                            type="text"
                                            pattern="\d*"
                                            className="onlynumeric"
                                            placeholder="2.000"
                                            name="electric_price_increased"
                                            id="electric_price_increased"
                                        />
                                        <span>%/a</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="input-label">
                                    {this.props.t('Economic.Tab.General.CalculatedInterestRate.Title')}:
                                    </td>
                                    <td className="input-help-label">
                                        <button
                                            type="button"
                                            className=""
                                            data-container="body"
                                            data-toggle="popover"
                                            data-placement="bottom"
                                            data-trigger="hover"
                                            data-content={this.props.t('Economic.Tab.General.CalculatedInterestRate.InfoTool')}
                                        >
                                            <img
                                                src="public/images/help-red.png"
                                                alt=""
                                            />
                                        </button>
                                    </td>
                                    <td className="input-fields withunit">
                                        <input
                                            type="text"
                                            pattern="\d*"
                                            className="onlynumeric"
                                            placeholder="0.700"
                                            name="calculated_interest_rate"
                                            id="calculated_interest_rate"
                                        />
                                        <span>%/a</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="input-label">
                                    {this.props.t('Economic.Tab.General.InflationRate.Title')}:
                                    </td>
                                    <td className="input-help-label">
                                        <button
                                            type="button"
                                            className=""
                                            data-container="body"
                                            data-toggle="popover"
                                            data-placement="bottom"
                                            data-trigger="hover"
                                            data-content={this.props.t('Economic.Tab.General.InflationRate.Title')}
                                        >
                                            <img
                                                src="public/images/help-red.png"
                                                alt=""
                                            />
                                        </button>
                                    </td>
                                    <td className="input-fields withunit">
                                        <input
                                            type="text"
                                            pattern="\d*"
                                            className="onlynumeric"
                                            placeholder="1.600"
                                            name="inflation_rate"
                                            id="inflation_rate"
                                        />
                                        <span>%/a</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            );
            var expertTabs = (
                <ul id="tabsJustified1" className="nav nav-tabs">
                    <li className="nav-item">
                        <a
                            href=""
                            data-target="#eco-general"
                            data-toggle="tab"
                            className="nav-link small active"
                        >
                            {this.props.t('Economic.Tab.General.Title')}
                        </a>
                    </li>
                    <li className="nav-item">
                        <a
                            href=""
                            data-target="#eco-chp"
                            data-toggle="tab"
                            className="nav-link"
                        >
                           {this.props.t('Economic.Tab.CHP.Title')}
                        </a>
                    </li>
                    <li className="nav-item">
                        <a
                            href=""
                            data-target="#eco-investment"
                            data-toggle="tab"
                            className="nav-link"
                        >
                            {this.props.t('Economic.Tab.Investments.Title')}
                        </a>
                    </li>
                    <li className="nav-item">
                        <a
                            href=""
                            data-target="#eco-maintenance"
                            data-toggle="tab"
                            className="nav-link"
                        >
                            {this.props.t('Economic.Tab.Maintenence.Title')}
                        </a>
                    </li>
                </ul>
            );

            var expertOptionGeneral = (
                <div
                    className="new-row-addition"
                    onClick={e => this.cloneGeneralItem()}
                >
                    <img src="public/images/plus-icon.png" alt="" />
                </div>
            );
            var expertOptionCHP = (
                <div
                    className="new-row-addition"
                    onClick={e => this.cloneChpItem()}
                >
                    <img src="public/images/plus-icon.png" alt="" />
                </div>
            );
            var expertOptionInvestment = (
                <div
                    className="new-row-addition"
                    onClick={e => this.cloneItem('planning[]','planning_discount[]')}
                >
                    <img src="public/images/plus-icon.png" alt="" />
                </div>
            );
            var expertOptionMaintenence = (
                <div
                    className="new-row-addition"
                    onClick={e => this.cloneMaintenenceItem('planning_maintenence[]')}
                >
                    <img src="public/images/plus-icon.png" alt="" />
                </div>
            );

            var expertChp = (
                <tr>
                    <td
                        className="nested-table"
                        colSpan="5"
                        style={CustomTable}
                    >
                        <table className="table">
                            <tbody>
                                <tr className="expertsbox">
                                    <td colSpan="3">
                                        <h3 className="inner-table-heading">
                                        {this.props.t('Economic.Tab.CHP.FOREXPERTS.Title')}
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="input-label">
                                    {this.props.t('Economic.Tab.CHP.ElectricitySalesPrice.Title')}:
                                    </td>
                                    <td className="input-help-label">
                                        <button
                                            type="button"
                                            className=""
                                            data-container="body"
                                            data-toggle="popover"
                                            data-placement="bottom"
                                            data-trigger="hover"
                                            data-content= {this.props.t('Economic.Tab.CHP.ElectricitySalesPrice.InfoTool')}
                                        >
                                            <img
                                                src="public/images/help-red.png"
                                                alt=""
                                            />
                                        </button>
                                    </td>
                                    <td className="input-fields withunit">
                                        <input
                                            type="text"
                                            placeholder="0.03500"
                                            pattern="\d*"
                                            className="onlynumeric"
                                            name="electricity_sales_price"
                                            id="electricity_sales_price"
                                        />
                                        <span>€/kWh</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="input-label">
                                    {this.props.t('Economic.Tab.CHP.EnergyTaxRefund.Title')}:
                                    </td>
                                    <td className="input-help-label">
                                        <button
                                            type="button"
                                            className=""
                                            data-container="body"
                                            data-toggle="popover"
                                            data-placement="bottom"
                                            data-trigger="hover"
                                            data-content={this.props.t('Economic.Tab.CHP.EnergyTaxRefund.InfoTool')}
                                        >
                                            <img
                                                src="public/images/help-red.png"
                                                alt=""
                                            />
                                        </button>
                                    </td>
                                    <td className="input-fields withunit">
                                        <input
                                            type="text"
                                            pattern="\d*"
                                            className="onlynumeric"
                                            placeholder="0.00550"
                                            name="energy_tax_refund"
                                            id="energy_tax_refund"
                                        />
                                        <span>€/kWh</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="input-label">
                                    {this.props.t('Economic.Tab.CHP.EEGAllocationPortion.Title')}:
                                    </td>
                                    <td className="input-help-label">
                                        <button
                                            type="button"
                                            className=""
                                            data-container="body"
                                            data-toggle="popover"
                                            data-placement="bottom"
                                            data-trigger="hover"
                                            data-content= {this.props.t('Economic.Tab.CHP.EEGAllocationPortion.InfoTool')}
                                        >
                                            <img
                                                src="public/images/help-red.png"
                                                alt=""
                                            />
                                        </button>
                                    </td>
                                    <td className="input-fields withunit">
                                        <input
                                            type="text"
                                            placeholder="40"
                                            pattern="\d*"
                                            className="onlynumeric"
                                            name="eeg_allocation_portion"
                                            id="eeg_allocation_portion"
                                        />
                                        <span>%</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td className="input-label">
                                    {this.props.t('Economic.Tab.CHP.EEGApportionmentCosts.Title')}:
                                    </td>
                                    <td className="input-help-label">
                                        <button
                                            type="button"
                                            className=""
                                            data-container="body"
                                            data-toggle="popover"
                                            data-placement="bottom"
                                            data-trigger="hover"
                                            data-content={this.props.t('Economic.Tab.CHP.EEGApportionmentCosts.InfoTool')}
                                        >
                                            <img
                                                src="public/images/help-red.png"
                                                alt=""
                                            />
                                        </button>
                                    </td>
                                    <td className="input-fields withunit">
                                        <input
                                            type="text"
                                            pattern="\d*"
                                            className="onlynumeric"
                                            placeholder="0.06792"
                                            name="eeg_apportion_costs"
                                            id="eeg_apportion_costs"
                                        />
                                        <span>€/kWh</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            );
        } else {
            var expertTabs = (
                <ul
                    id="tabsJustifieddouble"
                    className="nav nav-tabs double-tab"
                >
                    <li className="nav-item">
                        <a
                            href=""
                            data-target="#eco-general"
                            data-toggle="tab"
                            className="nav-link small active"
                        >
                            {this.props.t('Economic.Tab.General.Title')}
                        </a>
                    </li>
                    <li className="nav-item">
                        <a
                            href=""
                            data-target="#eco-chp"
                            data-toggle="tab"
                            className="nav-link"
                        >
                            {this.props.t('Economic.Tab.CHP.Title')}
                        </a>
                    </li>
                </ul>
            );
        }
        let rows = [];
        return (
            <div
                className="modal "
                role="dialog"
                aria-labelledby="mySmallModalLabel"
                aria-hidden="true"
                id="economic-information"
            >
                <form className="economic-information-form">
                    <div className="modal-content">
                        <div className="modal-heading">
                            <div className="left-head">{this.props.t('Economic.Title')}</div>
                            <div className="right-head">
                                <ul className="list-inline">
                                    <li>
                                        <input
                                            className="save-changes-btn"
                                            type="button"
                                            alt="Submit"
                                            onClick={this.handleSubmit}
                                            value={this.props.t('SaveButton')}
                                            title={this.props.t('SaveButton')}
                                        />
                                    </li>
                                    <li>
                                        <span className="close close_multi">
                                            <img
                                                src="public/images/cancle-icon.png"
                                                alt=""
                                                className="close-modal-economic"
                                                aria-label="Close"
                                            />
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div className="modal-body-content">
                            {expertTabs}
                            <div
                                id="tabsJustifiedContent1"
                                className="tab-content"
                            >
                                <div
                                    id="eco-general"
                                    className="tab-pane fade  active show"
                                >
                                    <div className="eco-general-data-div">
                                        <div className="table-responsive">
                                            <table
                                                className="table"
                                                id="generalTable"
                                            >
                                                <tbody>
                                                    <tr>
                                                        <td className="input-label">
                                                            {this.props.t('Economic.Tab.General.ElectricityPrice.Title')}:
                                                        </td>
                                                        <td className="input-help-label">
                                                            <button
                                                                type="button"
                                                                className=""
                                                                data-container="body"
                                                                data-toggle="popover"
                                                                data-placement="bottom"
                                                                data-trigger="hover"
                                                                data-content={this.props.t('Economic.Tab.General.ElectricityPrice.InfoTool')}
                                                            >
                                                                <img
                                                                    src="public/images/help-red.png"
                                                                    alt=""
                                                                />
                                                            </button>
                                                        </td>
                                                        <td className="input-fields withunit">
                                                            <input
                                                                type="text"
                                                                pattern="\d+(\.\d{0,5})?"
                                                                className="onlynumeric"
                                                                placeholder="0.180"
                                                                name="electric_price"
                                                                id="electric_price"
                                                                defaultValue="0.1800"
                                                            />
                                                            <span>€/kWh</span>
                                                            <input
                                                                type="hidden"
                                                                placeholder="Chiller 1"
                                                                id="economicformMode"
                                                                name="economicformMode"
                                                                value="add"
                                                            />
                                                        </td>
                                                    </tr>

                                                    {expertFields}
                                                </tbody>
                                            </table>
                                        </div>
                                        {expertOptionGeneral}
                                    </div>
                                </div>
                                <div id="eco-chp" className="tab-pane fade">
                                    <div className="eco-chp-data-div">
                                        <div className="table-responsive">
                                            <table
                                                className="table"
                                                id="chpTable"
                                            >
                                                <tbody>
                                                    <tr>
                                                        <td className="input-label">
                                                        {this.props.t('Economic.Tab.CHP.OwnUsageOfElectricity.Title')}:
                                                        </td>
                                                        <td className="input-help-label">
                                                            <button
                                                                type="button"
                                                                className=""
                                                                data-container="body"
                                                                data-toggle="popover"
                                                                data-placement="bottom"
                                                                data-trigger="hover"
                                                                data-content= {this.props.t('Economic.Tab.CHP.OwnUsageOfElectricity.InfoTool')}
                                                            >
                                                                <img
                                                                    src="public/images/help-red.png"
                                                                    alt=""
                                                                />
                                                            </button>
                                                        </td>
                                                        <td className="input-fields withunit">
                                                            <input
                                                                type="text"
                                                                pattern="\d*"
                                                                placeholder="100"
                                                                name="own_usage_of_electricity"
                                                                id="own_usage_of_electricity"
                                                            />
                                                            <span>%</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">
                                                        {this.props.t('Economic.Tab.CHP.KWKEubsidyForElectricity.Title')}:
                                                        </td>
                                                        <td className="input-help-label">
                                                            <button
                                                                type="button"
                                                                className=""
                                                                data-container="body"
                                                                data-toggle="popover"
                                                                data-placement="bottom"
                                                                data-trigger="hover"
                                                                data-content= {this.props.t('Economic.Tab.CHP.KWKEubsidyForElectricity.InfoTool')}
                                                            >
                                                                <img
                                                                    src="public/images/help-red.png"
                                                                    alt=""
                                                                />
                                                            </button>
                                                        </td>
                                                        <td className="input-fields ">
                                                            <input
                                                                type="text"
                                                                pattern="\d*"
                                                                className="onlynumeric"
                                                                placeholder="2016"
                                                                name="subsidy_for_electricity"
                                                                id="subsidy_for_electricity"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">
                                                        {this.props.t('Economic.Tab.CHP.GasPrice.Title')}:
                                                        </td>
                                                        <td className="input-help-label">
                                                            <button
                                                                type="button"
                                                                className=""
                                                                data-container="body"
                                                                data-toggle="popover"
                                                                data-placement="bottom"
                                                                data-trigger="hover"
                                                                data-content= {this.props.t('Economic.Tab.CHP.GasPrice.InfoTool')}
                                                            >
                                                                <img
                                                                    src="public/images/help-red.png"
                                                                    alt=""
                                                                />
                                                            </button>
                                                        </td>
                                                        <td className="input-fields withunit">
                                                            <input
                                                                type="text"
                                                                pattern="\d+(\.\d{0,5})?"
                                                                className="onlynumeric"
                                                                placeholder="0.03500"
                                                                name="gas_price"
                                                                id="gas_price"
                                                                defaultValue="0.035"
                                                            />
                                                            <span>€/kWh</span>
                                                        </td>
                                                    </tr>

                                                    {expertChp}
                                                </tbody>
                                            </table>
                                        </div>
                                        {expertOptionCHP}
                                    </div>
                                </div>
                                <div
                                    id="eco-investment"
                                    className="tab-pane fade"
                                >
                                    <div className="eco-investment-div">
                                        <div
                                            className="table-responsive"
                                            id="investmentTable"
                                        >
                                            <table className="table">
                                                <tbody>
                                                    {
                                                        this.props.chillers.data && this.props.chillers.data.map((chiller,index) => {
                                                            return <EconomicModalRow row={chiller} nameField={''}>
                                                                <tr key={index}>
                                                                    <td className="input-label">
                                                                    {chiller.chillername ? chiller.chillername : `Heat Source ${index+1}`}
                                                                    </td>
                                                                    <td className="input-fields symbmain">
                                                                        <input
                                                                            type="text"
                                                                            placeholder="100"
                                                                            pattern="\d*"
                                                                            className="icon-field onlynumeric"
                                                                            name={`chiller_${index}`}
                                                                            id={`chiller_${index}`}
                                                                            defaultValue={100}
                                                                            onChange={(e) => this.handleInvestmentData(e)}
                                                                        />
                                                                        <span className="pricesymbol">
                                                                            €
                                                                        </span>
                                                                        <i
                                                                            className={`fa fa-calculator dropdown-calci_test ${this.state.enableCalculator ? '' : 'disabled'}`}
                                                                            aria-hidden="true"
                                                                            /*onClick={(e) => this.calculateDiscount(e)}*/
                                                                        />
                                                                    </td>
                                                                    <td className="input-label">
                                                                        {this.props.t('DiscountText')}:
                                                                    </td>
                                                                    <td className="input-fields chp-base withunit">
                                                                        <input
                                                                            type="text"
                                                                            pattern="\d*"
                                                                            className="onlynumeric"
                                                                            placeholder="0"
                                                                            name={`chiller_discount_${index}`}
                                                                            id={`chiller_discount_${index}`}
                                                                            onChange={(e) => this.handleInvestmentData(e)}
                                                                        />
                                                                        <span>%</span>
                                                                    </td>
                                                                </tr>
                                                            </EconomicModalRow>                                                         
                                                        })
                                                    }
                                                    {/* Heat Sources */} 

                                                    {
                                                        this.props.heatSources.data && this.props.heatSources.data.map((heatSource,index) => {
                                                            return <tr key={index}>
                                                                <td className="input-label">
                                                                {heatSource.heat_name ? heatSource.heat_name : `Heat Source ${index+1}`}
                                                                </td>
                                                                <td className="input-fields symbmain">
                                                                    <input
                                                                        type="text"
                                                                        placeholder="100"
                                                                        pattern="\d*"
                                                                        className="icon-field onlynumeric"
                                                                        name={`chiller_${index}`}
                                                                        id={`chiller_${index}`}
                                                                        defaultValue={100}
                                                                        onChange={(e) => this.handleInvestmentData(e)}
                                                                    />
                                                                    <span className="pricesymbol">
                                                                        €
                                                                    </span>
                                                                    <i
                                                                        className={`fa fa-calculator dropdown-calci_test ${this.state.enableCalculator ? '' : 'disabled'}`}
                                                                        aria-hidden="true"
                                                                        /*onClick={(e) => this.calculateDiscount(e)}*/
                                                                    />
                                                                </td>
                                                                <td className="input-label">
                                                                    {this.props.t('DiscountText')}:
                                                                </td>
                                                                <td className="input-fields chp-base withunit">
                                                                    <input
                                                                        type="text"
                                                                        pattern="\d*"
                                                                        className="onlynumeric"
                                                                        placeholder="0"
                                                                        name={`chiller_discount_${index}`}
                                                                        id={`chiller_discount_${index}`}
                                                                        onChange={(e) => this.handleInvestmentData(e)}
                                                                    />
                                                                    <span>%</span>
                                                                </td>
                                                            </tr>
                                                        
                                                        })
                                                    }
                                                    {
                                                        this.props.heatingLoadingProfiles.data && this.props.heatingLoadingProfiles.data.map((heatingProfile,index) => {
                                                            return <tr key={index}>
                                                                <td className="input-label">
                                                                {heatingProfile.profile_name ? heatingProfile.profile_name : `Heating Loading ${index+1}`}
                                                                </td>
                                                                <td className="input-fields symbmain">
                                                                    <input
                                                                        type="text"
                                                                        placeholder="100"
                                                                        pattern="\d*"
                                                                        className="icon-field onlynumeric"
                                                                        name={`chiller_${index}`}
                                                                        id={`chiller_${index}`}
                                                                        defaultValue={100}
                                                                        onChange={(e) => this.handleInvestmentData(e)}
                                                                    />
                                                                    <span className="pricesymbol">
                                                                        €
                                                                    </span>
                                                                    <i
                                                                        className={`fa fa-calculator dropdown-calci_test ${this.state.enableCalculator ? '' : 'disabled'}`}
                                                                        aria-hidden="true"
                                                                        /*onClick={(e) => this.calculateDiscount(e)}*/
                                                                    />
                                                                </td>
                                                                <td className="input-label">
                                                                    {this.props.t('DiscountText')}:
                                                                </td>
                                                                <td className="input-fields chp-base withunit">
                                                                    <input
                                                                        type="text"
                                                                        pattern="\d*"
                                                                        className="onlynumeric"
                                                                        placeholder="0"
                                                                        name={`chiller_discount_${index}`}
                                                                        id={`chiller_discount_${index}`}
                                                                        onChange={(e) => this.handleInvestmentData(e)}
                                                                    />
                                                                    <span>%</span>
                                                                </td>
                                                            </tr>
                                                        
                                                        })
                                                    }{
                                                        this.props.coolingLoadingProfiles.data && this.props.coolingLoadingProfiles.data.map((coolingProfile,index) => {
                                                            return <tr key={index}>
                                                                <td className="input-label">
                                                                {coolingProfile.heat_name ? coolingProfile.heat_name : `Cooling Loading ${index+1}`}
                                                                </td>
                                                                <td className="input-fields symbmain">
                                                                    <input
                                                                        type="text"
                                                                        placeholder="100"
                                                                        pattern="\d*"
                                                                        className="icon-field onlynumeric"
                                                                        name={`chiller_${index}`}
                                                                        id={`chiller_${index}`}
                                                                        defaultValue={100}
                                                                        onChange={(e) => this.handleInvestmentData(e)}
                                                                    />
                                                                    <span className="pricesymbol">
                                                                        €
                                                                    </span>
                                                                    <i
                                                                        className={`fa fa-calculator dropdown-calci_test ${this.state.enableCalculator ? '' : 'disabled'}`}
                                                                        aria-hidden="true"
                                                                        /*onClick={(e) => this.calculateDiscount(e)}*/
                                                                    />
                                                                </td>
                                                                <td className="input-label">
                                                                    {this.props.t('DiscountText')}:
                                                                </td>
                                                                <td className="input-fields chp-base withunit">
                                                                    <input
                                                                        type="text"
                                                                        pattern="\d*"
                                                                        className="onlynumeric"
                                                                        placeholder="0"
                                                                        name={`chiller_discount_${index}`}
                                                                        id={`chiller_discount_${index}`}
                                                                        onChange={(e) => this.handleInvestmentData(e)}
                                                                    />
                                                                    <span>%</span>
                                                                </td>
                                                            </tr>
                                                        
                                                        })
                                                    }

                                                   {/* <tr>
                                                        <td className="input-label">
                                                        {this.props.t('Economic.Tab.Investments.eCoo10X.Title')}:
                                                        </td>
                                                        <td className="input-fields symbmain">
                                                            <input
                                                                type="text"
                                                                placeholder="19,950"
                                                                pattern="\d*"
                                                                className="onlynumeric"
                                                                name="ecoo"
                                                                id="ecoo"
                                                            />
                                                            <span className="pricesymbol">
                                                                €
                                                            </span>
                                                        </td>
                                                        <td className="input-label">
                                                            {this.props.t('DiscountText')}:
                                                        </td>
                                                        <td className="input-fields chp-base withunit">
                                                            <input
                                                                type="text"
                                                                placeholder="5"
                                                                pattern="\d*"
                                                                className="onlynumeric"
                                                                name="ecoo_discount"
                                                                id="ecoo_discount"
                                                            />
                                                            <span>%</span>
                                                        </td>
                                                    </tr>*/}
                                                    <tr
                                                        id="custom_1"
                                                        className="multiple"
                                                    >
                                                        <td className="input-label">
                                                            <div className="form-row align-items-center">
                                                                <div className="col">
                                                                    <span
                                                                        id="custominput_1"
                                                                        contentEditable="false"
                                                                        suppressContentEditableWarning={
                                                                            true
                                                                        }
                                                                    >
                                                                        {
                                                                            customFieldLabel
                                                                        }
                                                                    </span>
                                                                    :
                                                                </div>
                                                                <div className="col-auto">
                                                                    <div className="edit-divv">
                                                                        <i
                                                                            className="fa fa-pencil-square-o"
                                                                            aria-hidden="true"
                                                                            data-id="custominput_1"
                                                                        />
                                                                    </div>
                                                                    <div className="delete-divv">

                                                                        <i
                                                                            className="fa fa-trash-o"
                                                                            aria-hidden="true"
                                                                            data-id="custom_1"
                                                                        />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td className="input-fields symbmain">
                                                            <input
                                                                type="text"
                                                                placeholder="3,000"
                                                                pattern="\d*"
                                                                className="onlynumeric"
                                                                name="planning[]"
                                                                id="planning_1"
                                                            />
                                                            <span className="pricesymbol">
                                                                €
                                                            </span>
                                                        </td>
                                                        <td className="input-label">
                                                            {this.props.t('DiscountText')}:
                                                        </td>
                                                        <td className="input-fields chp-base withunit">
                                                            <input
                                                                type="text"
                                                                placeholder="2%"
                                                                pattern="\d*"
                                                                className="onlynumeric"
                                                                name="planning_discount[]"
                                                                id="planning_discount_1"
                                                            />
                                                            <span>%</span>
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        id="custom_1"
                                                        className="clone"
                                                    >
                                                        <td className="input-label">
                                                            <div className="form-row align-items-center">
                                                                <div className="col">
                                                                    <span
                                                                        id="custominputt_1"
                                                                        contentEditable="false"
                                                                        suppressContentEditableWarning={
                                                                            true
                                                                        }
                                                                    >
                                                                        {
                                                                            customFieldLabel
                                                                        }
                                                                    </span>
                                                                    :
                                                                </div>
                                                                <div className="col-auto">
                                                                    <div className="edit-divv">
                                                                        <i
                                                                            className="fa fa-pencil-square-o"
                                                                            aria-hidden="true"
                                                                            data-id="custominputt_1"
                                                                        />
                                                                    </div>
                                                                    <div className="delete-divv">

                                                                        <i
                                                                            className="fa fa-trash-o"
                                                                            aria-hidden="true"
                                                                            data-id="custom_1"
                                                                        />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td className="input-fields symbmain">
                                                            <input
                                                                type="text"
                                                                placeholder="3,000"
                                                                pattern="\d*"
                                                                className="onlynumeric price"
                                                                id="planning_x"
                                                            />
                                                            <span className="pricesymbol">
                                                                €
                                                            </span>
                                                        </td>
                                                        <td className="input-label">
                                                            {this.props.t('DiscountText')}:
                                                        </td>
                                                        <td className="input-fields chp-base withunit">
                                                            <input
                                                                type="text"
                                                                placeholder="2"
                                                                pattern="\d*"
                                                                className="onlynumeric discount"
                                                                id="planning_discount_x"
                                                            />
                                                            <span>%</span>
                                                        </td>
                                                    </tr>
                                                    {rows}
                                                </tbody>
                                            </table>
                                        </div>
                                        {expertOptionInvestment}
                                    </div>
                                    <div className="caculator-divv">
                                        <div className="calci-div" />
                                    </div>
                                </div>
                                <div
                                    id="eco-maintenance"
                                    className="tab-pane fade"
                                >
                                    <div className="eco-maintenance-div">
                                        <div
                                            className="table-responsive"
                                            id="maintenenceTable"
                                        >
                                            <table className="table">
                                                <tbody>
                                                    <tr>
                                                        <td className="input-label">

                                                            {this.props.t('Economic.Tab.Maintenence.CHPInTheBasement.Title')}:
                                                        </td>
                                                        <td className="input-fields withunit">
                                                            <input
                                                                type="text"
                                                                placeholder="78,250"
                                                                pattern="\d*"
                                                                className="icon-field onlynumeric"
                                                                name="chp_basement_maintenence"
                                                                id="chp_basement_maintenence"
                                                            />
                                                            <span>€</span>
                                                            <i
                                                                className="fa fa-calculator dropdown-calci disabled"
                                                                aria-hidden="true"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">
                                                        {this.props.t('Economic.Tab.Maintenence.Chiller1.Title')}:
                                                        </td>
                                                        <td className="input-fields withunit">
                                                            <input
                                                                type="text"
                                                                placeholder="16,251"
                                                                pattern="\d*"
                                                                className="icon-field onlynumeric"
                                                                name="chiller_maintenence"
                                                                id="chiller_maintenence"
                                                            />
                                                            <span>€</span>
                                                            <i
                                                                className="fa fa-calculator dropdown-calci disabled"
                                                                aria-hidden="true"
                                                            />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">
                                                        {this.props.t('Economic.Tab.Maintenence.RadiantCoolingOffice.Title')}:
                                                        </td>
                                                        <td className="input-fields withunit">
                                                            <input
                                                                type="text"
                                                                placeholder="8,550"
                                                                pattern="\d*"
                                                                className="onlynumeric"
                                                                name="radiant_maintenence"
                                                                id="radiant_maintenence"
                                                            />
                                                            <span>€</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">
                                                        {this.props.t('Economic.Tab.Maintenence.eCoo10X.Title')}:
                                                        </td>
                                                        <td className="input-fields withunit">
                                                            <input
                                                                type="text"
                                                                placeholder="19,950"
                                                                pattern="\d*"
                                                                className="onlynumeric"
                                                                name="ecoo_maintenence"
                                                                id="ecoo_maintenence"
                                                            />
                                                            <span>€</span>
                                                        </td>
                                                    </tr>
                                                    <tr
                                                        id="customMaintenence_1"
                                                        className="multiple"
                                                    >
                                                        <td className="input-label">
                                                            <div className="form-row align-items-center">
                                                                <div className="col">
                                                                    <span
                                                                        id="customMaintenenceInput_1"
                                                                        contentEditable="false"
                                                                        suppressContentEditableWarning={
                                                                            true
                                                                        }
                                                                    >
                                                                        {
                                                                            customFieldLabel
                                                                        }
                                                                    </span>
                                                                    :
                                                                </div>
                                                                <div className="col-auto">
                                                                    <div className="edit-divv">
                                                                        <i
                                                                            className="fa fa-pencil-square-o"
                                                                            aria-hidden="true"
                                                                            data-id="customMaintenenceInput_1"
                                                                        />
                                                                    </div>
                                                                    <div className="delete-divv">

                                                                        <i
                                                                            className="fa fa-trash-o"
                                                                            aria-hidden="true"
                                                                            data-id="customMaintenence_1"
                                                                        />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td className="input-fields withunit">
                                                            <input
                                                                type="text"
                                                                placeholder="3,000"
                                                                pattern="\d*"
                                                                className="onlynumeric"
                                                                name="planning_maintenence[]"
                                                                id="planning_maintenence_1"
                                                            />
                                                            <span>€</span>
                                                        </td>
                                                    </tr>

                                                    <tr
                                                        id="customMaint"
                                                        className="clone"
                                                    >
                                                        <td className="input-label">
                                                            <div className="form-row align-items-center">
                                                                <div className="col">
                                                                    <span
                                                                        id="customMaintenence_1"
                                                                        contentEditable="false"
                                                                        suppressContentEditableWarning={
                                                                            true
                                                                        }
                                                                    >
                                                                        {
                                                                            customFieldLabel
                                                                        }
                                                                    </span>
                                                                    :
                                                                </div>
                                                                <div className="col-auto">
                                                                    <div className="edit-divv">
                                                                        <i
                                                                            className="fa fa-pencil-square-o"
                                                                            aria-hidden="true"
                                                                            data-id="custom"
                                                                        />
                                                                    </div>
                                                                    <div className="delete-divv">

                                                                        <i
                                                                            className="fa fa-trash-o"
                                                                            aria-hidden="true"
                                                                            data-id="custom"
                                                                        />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td className="input-fields withunit">
                                                            <input
                                                                type="text"
                                                                placeholder="3,000"
                                                                pattern="\d*"
                                                                className="onlynumeric"
                                                                id="planningMaint"
                                                            />
                                                            <span>€</span>
                                                        </td>
                                                    </tr>
                                                    {rows}
                                                </tbody>
                                            </table>
                                        </div>
                                        {expertOptionMaintenence}
                                    </div>
                                    <div className="caculator-divv">
                                        <div className="calci-div" />
                                    </div>
                                </div>
                                <ul className="errorMessages hide">
                                {this.props.t('ErrorMessage')}
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        );
    }
}

const mapStates = state => { 
    return {
        chillers : state.chillers,
        heatSources : state.heatSources,
        heatingLoadingProfiles : state.heatingLoadingProfiles,
        coolingLoadingProfiles : state.coolingLoadingProfiles,
    }
}

EconomicModal = connect(mapStates)(EconomicModal);

export default translate(EconomicModal);
