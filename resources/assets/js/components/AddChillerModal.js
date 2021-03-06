import React, { Component } from 'react';
import { translate, setLanguage, getLanguage } from 'react-multi-lang';
const Header = {
    padding: "10px 20px",
    textAlign: "center",
    color: "red",
    fontSize: "14px"
}
let selectedSource = 'Adsorption';
let formmode = "add";
let formkey = 0;

class AddChiller extends Component {

    constructor(props) {
        super(props);
        this.state = {
            chillerInformation: '',
            role: 'user',
            selectedSource: selectedSource,
            formMode: formmode,
            formKey: formkey,
            adsorbents: [],
            chillerProducts: [],
            oprating_modes: [],
            integrated_system_sepration: [],
            integrated_cwu: [],
            product_intercons : [],
        };
        this.handleAddChillerSubmit = this.handleAddChillerSubmit.bind(this);
        this.changeState = this.changeState.bind(this);
        this.getAdsorbentData = this.getAdsorbentData.bind(this);
    }

    getChillerProducts(typeId) {
        let url = '/get-chiller-products/' + typeId;

        axios.get(url)
            .then((response) => {
                if (response.data) {
                    console.log('chiller products data', response.data)
                    this.setState({ chillerProducts: response.data })
                }
            })
            .catch((error) => {
                console.log(error);
            });

    }

    getAdsorbentData() {
        let url = '/get-chiller-adsorbent-types';

        axios.get(url)
            .then((response) => {
                if (response.data) {
                    console.log('adsorbent data', response.data)
                    this.setState({ adsorbents: response.data })
                }
            })
            .catch((error) => {
                console.log(error);
            });

    }

    getChillerOpratingModes() {
        let url = '/get-chiller-oprating-modes';

        axios.get(url)
            .then((response) => {
                if (response.data) {
                    console.log('oprating_modes data', response.data)
                    this.setState({ oprating_modes: response.data })
                }
            })
            .catch((error) => {
                console.log(error);
            });

    }
    getChillerIntegratedSepSystem(productId) {
        let url = `/get-chiller-integrated-system-sepration/${productId}`;

        axios.get(url)
            .then((response) => {
                if (response.data) {
                    console.log('integrated_system_sepration data', response.data)
                    this.setState({ integrated_system_sepration: response.data })
                }
            })
            .catch((error) => {
                console.log(error);
            });

    }

    getChillerIntegratedCWU(productId) {
        let url = `/get-chiller-integrated-cwu/${productId}`;

        axios.get(url)
            .then((response) => {
                if (response.data) {
                    console.log('integrated_cwu data', response.data)
                    this.setState({ integrated_cwu: response.data })
                }
            })
            .catch((error) => {
                console.log(error);
            });

    }
    
    getChillerProductIntercons() {
        let url = '/get-chiller-product-intercons';

        axios.get(url)
            .then((response) => {
                if (response.data) {
                    console.log('product_intercons data', response.data)
                    this.setState({ product_intercons : response.data })
                }
            })
            .catch((error) => {
                console.log(error);
            });

    }

    jQueryStuff() {
        jQuery(".help-toggle").unbind('click');
        jQuery(".help-toggle").click(function () {
            jQuery(".input-help-label").toggle();
        });
        var that = this;
        $('form.add-chiller-form input[required]').on('change invalid', function () {
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
    }



    componentDidMount() {
        this.getAdsorbentData();
        this.getChillerOpratingModes();
        this.getChillerProductIntercons();


        this.jQueryStuff();

    }
    showAllHeatSourceErrorMessages() {
        var form = $("form.add-chiller-form"),
            errorList = $("ul.errorMessages", form),
            errorFound = true;

        errorList.removeClass("hide");
        errorList.empty();
        // Find all invalid fields within the form.
        var invalidFields = form.find(":invalid").each(function (index, node) {
            // Find the field's corresponding label
            var fieldLabel = $("#" + node.id).parents('td.input-fields').siblings('td.input-label').text(),
                tabId = $("#" + node.id)
                    .parents("div.tab-pane")
                    .attr("id"),
                // Opera incorrectly does not fill the validationMessage property.
                message = node.validationMessage || "Invalid value.";
            var tabTitle = $("a[data-target='#" + tabId + "']").text();

            fieldLabel = fieldLabel.replace(":", "");
            var errorStr = "";
            errorStr = (message == "Please provide value" || message == "Please fill out this field.") ? "Please provide value" : "Please enter only numeric value";
            errorList
                .show()
                .append(
                    "<li>" + errorStr + " in '" +
                    fieldLabel +
                    "' field of " +
                    tabTitle +
                    " tab</li>"
                );
            errorFound = false;
        });
        return errorFound;
    }
    initializeAutocomplete(elem) {
        var input = document.getElementById(elem.target.id);
        // var options = {
        //   types: ['(regions)'],
        //   componentRestrictions: {country: "IN"}
        // };
        var options = {}

        var autocomplete = new google.maps.places.Autocomplete(input, options);

        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var placeId = place.place_id;
            // to set city name, using the locality param
            var componentForm = {
                locality: 'short_name',
            };

            console.log(lat, lng);
            // initialize(lat, lng);
            // //Drawing map on the basis of latitude and longitude.
            // getMapInfo(lat, lng,place)
        });
    }




    handleAddChillerSubmit(event) {
        if (!this.showAllHeatSourceErrorMessages()) {
            return false;
        }
        event.preventDefault();
        const that = this;

        var data = $('#add-chiller-form').serialize();


        fetch('adcalc/storeChillerInformation', {
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
                $(".add-chiller-form").find('.invalid-feedback').hide();
                jQuery.each(data.errors, function (key, value) {
                    $(".add-chiller-form").find('#' + value).siblings('.invalid-feedback').show();
                });

                if (typeof data.errors == "undefined") {
                    var $form = $(".add-chiller-form");
                    var data = that.getFormData($form);
                    //console.log(data);
                    that.setState({
                        chillerInformation: data
                    })
                    that.changeState(that.state.chillerInformation);
                    GENERAL_FORM_STATUS = true;
                    $("#add-chiller").modal("hide");

                }
            })
            .catch((err) => { console.log(err) })



    }
    changeState(chillerInformation) {
        var result = {
            chillerInformation: chillerInformation,
            state: true
        }
        CHANGE_FORM = true;
        this.props.onChillerSubmit(result);
    }

    getFormData($form) {
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function (n, i) {
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }
    changeField(elem) {
        //var selectedSource= (this.state.selectedSource=='CHP')?'hide':'';
        //console.log(elem.target.value);
        this.setState({
            selectedSource: elem.target.value,
            formMode: this.addchillerformMode.value,
            formKey: this.addchillerformModeKey.value
        });

    }

    handleAdsorbentChange(e) {
        if (e.target.value) {
            this.getChillerProducts(e.target.value)
        }
    }

    handleProductChange(e){
        if(e.target.value){
            this.getChillerIntegratedSepSystem(e.target.value);
            this.getChillerIntegratedCWU(e.target.value);
        }
    }

    render() {
        var adsorbentHtml, productHtml = "";
        if (this.state.selectedSource == "Adsorption") {
            adsorbentHtml = (<tr>
                <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.Adsorbent.Title')}:</td>
                <td className="input-help-label">
                    <button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                        data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.Adsorbent.InfoTool')}
                        data-original-title="" title="">
                        <img src="public/images/help-red.png" alt="" />
                    </button>
                </td>
                <td className="input-fields">
                    <select className="required-field" id="chiller_adsorbent" name="chiller_adsorbent" onChange={(e) => this.handleAdsorbentChange(e)}>
                        <option value=''>Select adsorbent</option>
                        {
                            this.state.adsorbents && this.state.adsorbents.map((adsorbent) => {
                                return <option
                                    key={adsorbent.chiller_adsorbent_types_id}
                                    value={adsorbent.chiller_adsorbent_types_id}>
                                    {adsorbent.chiller_adsorbent_type}
                                </option>
                            })
                        }
                    </select>
                </td>
            </tr>);
            productHtml = (
                <tr>
                    <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.ProductInterconnection.Title')}:
                        </td>
                    <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                        data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.ProductInterconnection.InfoTool')}
                        data-original-title="" title="">
                        <img src="public/images/help-red.png" alt="" />
                    </button>
                    </td>
                    <td className="input-fields">
                        <select className="required-field" id="chiller_product_inter" name="chiller_product_inter">
                            {
                                this.state.product_intercons && this.state.product_intercons.map((productIntercon) => {
                                    return <option
                                        key={productIntercon.chiller_product_intercons_id}
                                        value={productIntercon.chiller_product_intercons_id}>
                                        {productIntercon.chiller_product_intercons}
                                    </option>
                                })
                            }
                        </select>
                    </td>
                </tr>

            );
        }
        let functionHtml = "";
        if (this.state.selectedSource == "Compression") {
            functionHtml = (<tr>
                <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.Function.Title')}:</td>
                <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                    data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.Function.InfoTool')}
                    data-original-title="" title="">
                    <img src="public/images/help-red.png" alt="" />
                </button>
                </td>
                <td className="input-fields">
                    <select className="required-field" id="chiller_function" name="chiller_function">
                        <option value="Peak load cover">Peak load cover</option>
                        <option value="Back up">Back up</option>
                    </select>
                </td>
            </tr>);
        }

        return (
            <div className="modal modal_multi" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="add-chiller">
                <form className="add-chiller-form" id="add-chiller-form">
                    <div className="modal-content">
                        <div className="modal-heading">
                            <div className="left-head"> {this.props.t('Fahrenheit.Tab.Chiller.AddChiller.Title')}</div>
                            <div className="right-head">
                                <ul className="list-inline">
                                    <li><input className="save-changes-btn" onClick={this.handleAddChillerSubmit} type="submit" alt="Submit" value={this.props.t('SaveButton')} title={this.props.t('SaveButton')} /></li>
                                    <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-CoolingProfile" aria-label="Close" /></span></li>
                                </ul>
                            </div>
                        </div>
                        <div className="modal-body-content">
                            <ul id="tabsJustifiedd" className="nav nav-tabs">
                                <li className="nav-item"><a href="" data-target="#addchillar-technical-data" data-toggle="tab" className="nav-link small active">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.Title')}</a></li>
                                <li className="nav-item"><a href="" data-target="#addchillar-calculation-data" data-toggle="tab" className="nav-link">{this.props.t('Fahrenheit.Tab.Chiller.TAB.CalculationData.Title')}</a></li>
                            </ul>
                            <div id="tabsJustifiedContentt" className="tab-content">
                                <div id="addchillar-technical-data" className="tab-pane fade  active show">
                                    <div className="addachillar-div">
                                        <div className="table-responsive">
                                            <table className="table">
                                                <tbody>
                                                    <tr>
                                                        <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.ChillerType.Title')}:</td>
                                                        <td className="input-help-label">
                                                            <button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                                data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.ChillerType.InfoTool')}
                                                                data-original-title="" title="">
                                                                <img src="public/images/help-red.png" alt="" />
                                                            </button>
                                                        </td>
                                                        <td className="input-fields">
                                                            <select className="required-field" id="chiller_chiller_type" name="chiller_chiller_type" onChange={(elem) => this.changeField(elem)}>
                                                                <option value="Adsorption">Adsorption</option>
                                                                <option value="Compression">Compression</option>
                                                            </select>
                                                            <input type="hidden" placeholder="Chiller 1" ref={addchillerformMode => { this.addchillerformMode = addchillerformMode; }} id="addchillerformMode" name="addchillerformMode" value={this.state.formMode} />
                                                            <input type="hidden" placeholder="Chiller 1" ref={addchillerformModeKey => { this.addchillerformModeKey = addchillerformModeKey; }} id="addchillerformModeKey" name="addchillerformModeKey" value={this.state.formKey} />
                                                        </td>
                                                    </tr>
                                                    {adsorbentHtml}
                                                    <tr>
                                                        <td className="input-label">Product:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                            data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project."
                                                            data-original-title="" title="">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields">
                                                            <select className="required-field" id="chiller_product" name="chiller_product" onChange={(e) => this.handleProductChange(e)}>
                                                                <option value=''>Select product</option>
                                                                {
                                                                    this.state.chillerProducts && this.state.chillerProducts.map((product) => {
                                                                        return <option
                                                                            key={product.id}
                                                                            value={product.id}>
                                                                            {product.product_name}
                                                                        </option>
                                                                    })
                                                                }
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.OperatingMode.Title')}:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                            data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.ChillerType.InfoTool')}
                                                            data-original-title="" title="">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields">
                                                            <select className="required-field" id="oprating_modes" name="oprating_modes">
                                                                {
                                                                    this.state.oprating_modes && this.state.oprating_modes.map((opratingMode) => {
                                                                        return <option
                                                                            key={opratingMode.chiller_operating_modes_id}
                                                                            value={opratingMode.chiller_operating_modes_id}>
                                                                            {opratingMode.chiller_operating_mode_type}
                                                                        </option>
                                                                    })
                                                                }
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.IntegratedSystemSepration.Title')}:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                            data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.ChillerType.InfoTool')}
                                                            data-original-title="" title="">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields">
                                                            <select className="required-field" id="integrated_system_sepration" name="integrated_system_sepration">
                                                                <option value=''>Select System Sepration</option>
                                                                {
                                                                    this.state.integrated_system_sepration && this.state.integrated_system_sepration.map((intSysSep) => {
                                                                        return <option
                                                                            key={intSysSep.chiller_int_sys_separations_id}
                                                                            value={intSysSep.chiller_int_sys_separations_id}>
                                                                            {intSysSep.chiller_int_sys_separations_type}
                                                                        </option>
                                                                    })
                                                                }
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.IntegratedColdWaterUnit.Title')}:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                            data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.ChillerType.InfoTool')}
                                                            data-original-title="" title="">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields">
                                                            <select className="required-field" id="integrated_cwu" name="integrated_cwu">
                                                                <option value=''>Select CWU</option>
                                                                {
                                                                    this.state.integrated_cwu && this.state.integrated_cwu.map((intCwu) => {
                                                                        return <option
                                                                            key={intCwu.chiller_int_cold_water_units_id}
                                                                            value={intCwu.chiller_int_cold_water_units_id}>
                                                                            {intCwu.chiller_int_cold_water_units_type}
                                                                        </option>
                                                                    })
                                                                }
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.NumberOfChillers.Title')}:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                            data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.NumberOfChillers.InfoTool')}
                                                            data-original-title="" title="">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields">
                                                            <input type="number" id="chiller_no_chiller" required pattern="\d*" name="chiller_no_chiller" placeholder={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.NumberOfChillers.Placeholder')} className="required-field onlynumeric" />
                                                        </td>
                                                    </tr>
                                                    {productHtml}
                                                    <tr>
                                                        <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.GroupInterconnection.Title')}:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                            data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.GroupInterconnection.InfoTool')}
                                                            data-original-title="" title="">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields">
                                                            <select className="required-field" id="chiller_group_inter" name="chiller_group_inter">
                                                                <option>2.20</option>
                                                                <option>option1</option>
                                                                <option>option2</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    {functionHtml}
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
                                                        <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.InvestmentCosts.Title')}: </td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                            data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.InvestmentCosts.InfoTool')} data-original-title="" title="">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields withunit"><input type="text" placeholder="0" id="addchiller_investment_cost" name="addchiller_investment_cost" /><span>{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.InvestmentCosts.Placeholder')} </span> </td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.Discount.Title')}:</td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                            data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.Discount.InfoTool')} data-original-title="" title="">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields withunit"><input type="text" placeholder="0" id="addchiller_discount" name="addchiller_discount" /><span>{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.Discount.Placeholder')}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td className="input-label">{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.MaintenanceCosts.Title')} : </td>
                                                        <td className="input-help-label"><button type="button" className="" data-container="body" data-trigger="hover" data-toggle="popover"
                                                            data-placement="bottom" data-content={this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.MaintenanceCosts.InfoTool')} data-original-title="" title="">
                                                            <img src="public/images/help-red.png" alt="" />
                                                        </button>
                                                        </td>
                                                        <td className="input-fields withunit"><input type="text" placeholder="0" id="addchiller_maintenence" name="addchiller_maintenence" /><span>{this.props.t('Fahrenheit.Tab.Chiller.TAB.TechnicalData.MaintenanceCosts.Placeholder')}</span> </td>
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

export default translate(AddChiller);
