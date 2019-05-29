import React from 'react';

import { DeleteModal } from './DeleteModal';
import { ErrorBoundary } from './ErrorBoundary';
import { translate } from 'react-multi-lang';
import InputRange from 'react-input-range';
const WAIT_INTERVAL = 1000
const hideEle = {
    visibility: "hidden"
}
const tdBorder = {
    borderTop: "0px"
}
class Tiles extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            errorMsg: "",
            totalHours: 0,
            cityData: [],
            outdoortemp: {
                max: 0,
                min: 0,

            },
            outdoortempvalue: 2,
            drivetemp: 55,
            chilledwatertemp: 12,
            coolingType: "Office Space",
            coolingLoad: '',
            compressionChillerData: [],
            compressionDataChange: false,
            generalData: {
                location: 'munich'
            },
            generalDataChange: false,
            optionData: [],
            optionDataChange: false,
            economicData: [],
            economicDataChange: false,
            heatSourceData: [],
            heatSourceDataChange: false,
            heatingProfileData: [],
            heatingProfileDataChange: false,
            coolingProfileData: [],
            coolingProfileDataChange: false,
            fahrenheitData: [],
            fahrenheitDataChange: this.props.datachanged,
        };
        this.timer = null
        this.editRecord = this.editRecord.bind(this);
        this.editHeatRecord = this.editHeatRecord.bind(this);
        this.deleteRecord = this.deleteRecord.bind(this);
        this.updateCompressionList = this.updateCompressionList.bind(this);
        this.updateHeatSourceList = this.updateHeatSourceList.bind(this);
        this.handleChillerDeleteEntry = this.handleChillerDeleteEntry.bind(this);
        this.handleHeatSourceDeleteEntry = this.handleHeatSourceDeleteEntry.bind(this);
        this.arrayMove = this.arrayMove.bind(this);
        this.setCoolingTileValues = this.setCoolingTileValues.bind(this)
    }
    componentWillReceiveProps(nextProps) {

        switch (nextProps.title) {
            case CHILLER_TITLE:
                this.setState({
                    compressionChillerData: nextProps.dataRecord,
                    compressionDataChange: nextProps.dataChange
                });

                break;
            case GENERAL_TILE:
                this.setState({
                    generalDataChange: nextProps.dataChange
                });
                this.state.generalData[0] = nextProps.dataRecord
                this.forceUpdate()

                break;
            case OPTION_TILE:
                this.setState({
                    optionDataChange: nextProps.dataChange
                });

                this.state.optionData[0] = nextProps.dataRecord
                this.forceUpdate();
                break;
            case ECONOMIC_TITLE:
                this.setState({
                    economicDataChange: nextProps.dataChange
                });
                if (nextProps.dataRecord.economicformMode == "add") {
                    this.setState({
                        economicData: this.state.generalData.concat(nextProps.dataRecord)
                    })
                } else {

                    this.state.economicData[0] = nextProps.dataRecord
                    this.forceUpdate()
                }
                break;
            case HEAT_SOURCE_TITLE:
                this.setState({
                    heatSourceData: nextProps.dataRecord,
                    heatSourceDataChange: nextProps.dataChange
                });
                break;
            case HEAT_LOAD_PROFILE_TITLE:
                this.setState({
                    heatingProfileData: nextProps.dataRecord,
                    heatingProfileDataChange: nextProps.dataChange
                });
                break;
            case COOLING_LOAD_PROFILE_TITLE:
                this.setState({
                    coolingProfileData: nextProps.dataRecord,
                    coolingProfileDataChange: nextProps.dataChange
                });
                break;
            case FAHRENHEIT_SYSTEM:
                this.setState({
                    fahrenheitData: nextProps.dataRecord,
                    fahrenheitDataChange: nextProps.dataChange
                });
                break;
            default:
                break;
        }
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

            //console.log(lat, lng);
            // initialize(lat, lng);
            // //Drawing map on the basis of latitude and longitude.
            // getMapInfo(lat, lng,place)
        });
    }
    validateCoolingLoad() {
        if (this.state.coolingLoad == "") {
            this.setState({
                errorMsg: "Please enter Max. Cooling Load"
            })
            return false
        }
        else {
            this.setState({
                errorMsg: ""
            })
        }
    }
    setTempState(value) {
        this.setState({ outdoortempvalue: value })
        var result = {
            min: value,
            max: this.state.outdoortemp.max
        }
        this.props.onGeneralDatachange(result)
        this.validateCoolingLoad()
    }
    setHeatState(value) {
        this.setState({ drivetemp: value })
        this.props.onHeatSourcechange(value)
        this.validateCoolingLoad()
    }
    setCoolingState(value) {
        CHANGE_FORM = true;
        this.setState({ chilledwatertemp: value })
        this.setCoolingTileValues()
    }
    setCoolingTileValues() {

        this.validateCoolingLoad()
        var result = {
            coolingLoad: this.state.coolingLoad,
            coolingType: this.state.coolingType,
            chilledwatertemp: this.state.chilledwatertemp
        }
        this.props.coolingloadDatachange(result)
        clearTimeout(this.timer)
    }
    selectTemp(value) {

        var port = 3000;
        var that = this;
        var locationName = value.target.value
        CHANGE_FORM = true;
        axios.defaults.baseURL = location.protocol + '//' + location.hostname + ':' + port;

        axios.get('/location_data/' + locationName + '.json')
            .then((response) => {
                var maxVal = that.getVal(response.data, 'temprature');

                that.setState({
                    outdoortemp: {
                        max: maxVal.max,
                        min: maxVal.min
                    },
                    cityData: response.data,
                    generalData: { location: locationName }
                })

                that.props.onGeneralDatachange(this.state.outdoortemp)
            })
            .catch((error) => { response.json(error) })
    }
    componentDidUpdate() {

    }
    componentWillUnmount() {
        // console.log("component unmount")
    }
    setTemp(arr, prop, value) {
        var total = 0
        for (var i = 0; i < arr.length; i++) {
            if (arr[i]['temprature'] > value)
                total = total + arr[i][prop];
        }
        this.setState({
            totalHours: total,
            generalDataChange: true,
            location: value
        })
    }
    getVal(arr, prop) {
        var max;
        var min;
        for (var i = 0; i < arr.length; i++) {
            if (!max || arr[i][prop] > max[prop])
                max = arr[i];
            if (!min || arr[i][prop] < min[prop])
                min = arr[i];
        }
        var returnVal = {
            max: max.temprature,
            min: min.temprature
        }
        return returnVal;
    }
    getCoolingLoadProfile() {
        var bodyFormData = new FormData();
        bodyFormData.set({
            coolingType: this.state.coolingType,
            coolingLoad: this.state.coolingLoad,
            chilledwatertemp: this.state.chilledwatertemp
        });
        axios({
            method: 'post',
            url: '/controller/method',
            data: bodyFormData,
            config: { headers: { 'Content-Type': 'multipart/form-data' } }
        })
            .then(function (response) {
                //handle success
                console.log(response);
            })
            .catch(function (response) {
                //handle error
                console.log(response);
            });
    }
    updateState(elem) {
        if (/^\d+$/.test(elem.target.value)) {
            if (elem.target.attributes[1].value == 'cooling_profile_type') {
                this.setState({
                    coolingType: elem.target.value
                })
            }
            else {
                this.setState({
                    coolingLoad: elem.target.value
                })
            }
            this.timer = setTimeout(this.setCoolingTileValues, WAIT_INTERVAL)
          }
       
    }
    componentDidMount() {

        var that = this;

        if (that.props.title == HEAT_SOURCE_TITLE) {
            //  log(`isClamped: ${this.linesEllipsis.isClamped()} when page didMount`)
            //    console.log("Lineellipses",this.linesEllipsis.state.clamped);
            //    console.log("Lineellipses state",this.linesEllipsis);

        }
        if (that.props.title == GENERAL_TILE) {
            var port = 3000;
            axios.defaults.baseURL = location.protocol + '//' + location.hostname + ':' + port;

            axios.get('/location_data/munich.json')
                .then((response) => {
                    var maxVal = that.getVal(response.data, 'temprature');

                    this.setState({
                        outdoortemp: {
                            max: maxVal.max,
                            min: maxVal.min
                        },
                        outdoortempvalue: maxVal.min,
                        cityData: response.data
                    })
                    that.setTemp(response.data, 'hours', maxVal.min)
                    that.props.onGeneralDatachange(this.state.outdoortemp)
                })
                .catch((error) => { response.json(error) })
            // this.setTemp(this.state.cityData,'hours',value)
        }

        if (this.state.compressionChillerData.length == 0) {
            this.setState({
                compressionDataChange: false
            });
        }
        else {
            jQuery(".scrollbar-macosx").scrollbar();
        }
        if (this.state.heatSourceData.length == 0) {

            this.setState({
                heatSourceDataChange: false
            });
        }
        else {
            jQuery(".scrollbar-macosx").scrollbar();
        }
        if (this.state.heatingProfileData.length == 0) {
            this.setState({
                heatingProfileDataChange: false
            });
        }
        else {
            jQuery(".scrollbar-macosx").scrollbar();
        }
        if (this.state.coolingProfileData.length == 0) {
            this.setState({
                coolingProfileDataChange: false
            });
        }
        else {
            jQuery(".scrollbar-macosx").scrollbar();
        }


        // if(this.state.generalData.length==0)
        // {

        //   this.setState({
        //       generalDataChange: false
        //     });
        // }
        // else{
        //     // alert('AAAA')
        //     jQuery(".scrollbar-macosx").scrollbar();
        // }
        $(document).on('show.bs.modal', '#general-information', function () {
            if (that.props.title == GENERAL_TILE) {
                var dataObj = that.state.generalData[0];
                if (typeof dataObj != 'undefined') {

                    for (var key in dataObj) {
                        if (dataObj.hasOwnProperty(key)) {
                            //console.log($(this.props.modalId).find(key),this.props.modalId,key);

                            $(that.props.modalId).find('#' + key).val(dataObj[key]);
                        }
                    }
                    $(that.props.modalId).find('#generalformMode').val("edit");
                }
            }
            //Do stuff here
        });
        $(document).on('show.bs.modal', '#economic-information', function () {
            if (that.props.title == ECONOMIC_TITLE) {
                $("ul.errorMessages").addClass('hide');
                var dataObj = that.state.economicData[0];
                if (NO_CUSTOM_FIELD > 0) {
                    if ($("#FinancialItem_" + (NO_CUSTOM_FIELD - 1)).next('tr').length > 0) {
                        $("#FinancialItem_" + (NO_CUSTOM_FIELD - 1)).nextAll('tr').not('.clone').remove();
                    }
                } else {
                    $("#FinancialItem_0").nextAll('tr').not('.clone').remove();
                }
                if (NO_CUSTOM_FIELD_MAINTENENCE > 0) {
                    if ($("#MaintenenceItem_" + (NO_CUSTOM_FIELD_MAINTENENCE - 1)).next('tr').length > 0) {
                        $("#MaintenenceItem_" + (NO_CUSTOM_FIELD_MAINTENENCE - 1)).nextAll('tr').not('.clone').remove();
                    }
                } else {
                    $("#MaintenenceItem_0").nextAll('tr').not('.clone').remove();
                }
                if (NO_CUSTOM_FIELD_GENERAL > 0) {
                    if ($("#generalItem_" + (NO_CUSTOM_FIELD_GENERAL - 1)).next('tr').length > 0) {
                        $("#generalItem_" + (NO_CUSTOM_FIELD_GENERAL - 1)).nextAll('tr').not('.clone').remove();
                    }
                } else {
                    $("#generalItem_").nextAll('tr').not('.clone').remove();
                }
                if (NO_CUSTOM_FIELD_CHP > 0) {
                    if ($("#chpItem_" + (NO_CUSTOM_FIELD_CHP - 1)).next('tr').length > 0) {
                        $("#chpItem_" + (NO_CUSTOM_FIELD_CHP - 1)).nextAll('tr').not('.clone').remove();
                    }
                } else {
                    $("#chpTable tr.multiple").remove();
                }

                if (typeof dataObj != 'undefined') {

                    for (var key in dataObj) {
                        if (dataObj.hasOwnProperty(key)) {
                            //console.log($(this.props.modalId).find(key),this.props.modalId,key);
                            if (key.indexOf("[]") != -1) continue;
                            $(that.props.modalId).find('#' + key).val(dataObj[key]);
                        }
                    }
                    $(that.props.modalId).find('#economicformMode').val("edit");

                }
            }
            //Do stuff here
        });


    }
    updateCompressionList(clonedArr) {
        //console.log("sorting finish",clonedArr);
        this.setState({
            compressionChillerData: clonedArr
        });

    }
    updateHeatSourceList(clonedArr) {
        //console.log("sorting finish",clonedArr);
        this.setState({
            heatSourceData: clonedArr
        });

    }
    editRecord(elemKey) {
        let dataObj = this.state.compressionChillerData[elemKey];
        for (var key in dataObj) {
            if (dataObj.hasOwnProperty(key)) {
                //console.log($(this.props.modalId).find(key),this.props.modalId,key);
                $(this.props.modalId).find('#' + key).val(dataObj[key]);
            }
        }
        $(this.props.modalId).find('#chillerformMode').val("edit");
        $(this.props.modalId).find('#chillerformModeKey').val(elemKey);
        //$(this.props.modalId).find
    }
    editHeatRecord(elemKey, modalID) {
        let dataObj = "";
        let elemModal = modalID.hiddenmodekey;
        switch (elemModal) {
            case 'heatsourceformModeKey':
                dataObj = this.state.heatSourceData[elemKey];
                break;
            case 'heatingprofileformModeKey':
                dataObj = this.state.heatingProfileData[elemKey];
                break;
            case 'coolingprofileformModeKey':
                dataObj = this.state.coolingProfileData[elemKey];
                break;
            default:
                dataObj = this.state.heatSourceData[elemKey];
                break;
        }


        for (var key in dataObj) {
            if (dataObj.hasOwnProperty(key)) {
                //console.log($(this.props.modalId).find(key),this.props.modalId,key);
                $(this.props.modalId).find('#' + key).val(dataObj[key]);
            }
        }
        $(this.props.modalId).find('#' + modalID.hiddenmode).val("edit");
        $(this.props.modalId).find('#' + modalID.hiddenmodekey).val(elemKey);
        //$(this.props.modalId).find
    }
    deleteRecord(eleId, eleM) {
        var modalId = eleM.target.getAttribute('data-modal');
        $("#" + modalId).find("#entry-id").attr('data-id', eleId);
        $("#" + modalId).modal("show");
    }
    onSubmit(event) {
        event.preventDefault();

        // custom form handling here
    }
    handleChillerDeleteEntry(result) {
        //console.log(result);
        if (result.modalFor == "compressionChiller") {
            var clonedArrDelete = this.state.compressionChillerData; // make a separate copy of the array
            clonedArrDelete.splice(result.elementId, 1);
            this.setState({ compressionChillerData: clonedArrDelete });
        }
        else if (result.modalFor == "coolingloadprofile") {
            var clonedArrDelete = this.state.coolingProfileData; // make a separate copy of the array
            clonedArrDelete.splice(result.elementId, 1);
            this.setState({ coolingProfileData: clonedArrDelete });
        }
        else if (result.modalFor == "heatingprofile") {
            var clonedArrDelete = this.state.heatingProfileData; // make a separate copy of the array
            clonedArrDelete.splice(result.elementId, 1);
            this.setState({ heatingProfileData: clonedArrDelete });
        }
        else {
            var clonedArrDelete = this.state.heatSourceData; // make a separate copy of the array
            clonedArrDelete.splice(result.elementId, 1);
            this.setState({ heatSourceData: clonedArrDelete });
        }
    }

    handleHeatSourceDeleteEntry(result) {
        var clonedArrDelete = this.state.compressionChillerData; // make a separate copy of the array
        clonedArrDelete.splice(result.elementId, 1);
        this.setState({ compressionChillerData: clonedArrDelete });

    }
    arrayMove(arr, old_index, new_index) {
        if (new_index >= arr.length) {
            var k = new_index - arr.length + 1;
            while (k--) {
                arr.push(undefined);
            }
        }
        arr.splice(new_index, 0, arr.splice(old_index, 1)[0]);
        return arr; // for testing
    }

    render() {

        //console.log("render refresh",this.state.heatSourceData);
        //this.props.store.dispatch("ADD_GENERAL")

        //projectData['generalData'] = this.state.generalData;   //use to store the object to save the data
        //projectData['economicData'] = this.state.economicData; //use to store the object to save the data
        //projectData['option']=this.state.optionData;
        //projectData['heatsource']=this.state.heatSourceData;
        //projectData['heatingprofile']=this.state.heatingProfileData;
        //projectData['chiller']=this.state.coolingProfileData;
        //projectData['coompressionchiller']=this.state.compressionChillerData;
        //projectData['fahrenheit']=this.state.fahrenheitData;
        var priceFullList, pricelist, requiredMsg = "";
        if (this.props.required == "yes") {
            var requiredMsg = <h5 className="input-required">{this.props.t('InputRequired')}</h5>;
            if (this.props.title == FAHRENHEIT_SYSTEM) {
                var requiredMsg = <h5 className="input-required">{this.props.t('Fahrenheit.InputRequired')}</h5>;
            }
        }

        var deleteModal = "";
        if (this.props.title == CHILLER_TITLE) {
            if (this.state.compressionDataChange == true && this.state.compressionChillerData.length != 0) {
                var bodyContent = "Are you sure you want to delete the chiller entry? Please confirm by clicking Yes.";
                var deleteModal = <DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} bodyContent={bodyContent} modalfor="compressionChiller" id="delete-modal" />;
                var pricelist = (
                    <ul className="price-listt">
                        <li>
                            <p>{this.props.t('Tiles.CompressionChiller.HoverCoolingTitle')}</p>
                            <h3>100.0 kW</h3>
                        </li>
                        <li>
                            <p>{this.props.t('Tiles.CompressionChiller.NumberofCompressor')}</p>
                            <h3>3</h3>
                        </li>

                        {(() => {
                            if (this.state.compressionChillerData[0].temperature != "") {
                                return (
                                    <li>
                                        <p>{this.props.t('Tiles.CompressionChiller.Temperature')}</p>
                                        <h3><img src='public/images/degree-icon.png' alt='' /> {(this.state.compressionChillerData[0].temperature != "") ? this.state.compressionChillerData[0].temperature + "°C" : ""}</h3>
                                    </li>
                                )
                            }
                        })()}



                    </ul>
                );
                let chillerData = this.state.compressionChillerData;
                projectData['coompressionchiller'] = this.state.compressionChillerData;

                var priceFullList = (

                    <div>

                        <div className="hover-list scrollbar-macosx">
                            <div className="table-responsive">
                                <table className="table">
                                    <tbody className="compressionTableBody">
                                        {chillerData.map((data, i) => (

                                            <tr key={i} data-id={i}>
                                                <th>
                                                    {data.chillername}
                                                    <ul className="list-inline" key={i}>
                                                        <li >120.30 kW
      </li>
                                                        <li>	{(data.temperature != "") ? data.temperature + '°C' : ""} </li>
                                                    </ul>
                                                </th>
                                                <td><span className="edit-option" data-id={i} data-toggle="modal" data-backdrop="false" data-target={this.props.modalId} ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={() => this.editRecord(i)}></i></span>
                                                    <span className="delete-optionn" data-id={i} ><i className="fa fa-trash-o" aria-hidden="true" data-modal="delete-modal" onClick={(elem) => this.deleteRecord(i, elem)}></i></span>
                                                    <span className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span>
                                                </td>
                                            </tr>))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                );

                var that = this;
                if (typeof $('.compressionTableBody')[0] != "undefined") {
                    jQuery(".compression-chillers-hover .scrollbar-macosx").scrollbar();

                    if (that.props.title == CHILLER_TITLE) {

                        this.sort = Sortable.create(
                            $('.compressionTableBody')[0],
                            {
                                animation: 150,
                                scroll: true,
                                sort: true,
                                dataIdAttr: 'data-id',
                                handle: '.drag-handler',
                                onEnd: function (/**Event*/evt) {
                                    evt.oldIndex;  // element's old index within old parent
                                    evt.newIndex;  // element's new index within new parent
                                },
                                onUpdate: function (/**Event*/evt) {
                                    // same properties as onEnd
                                    evt.oldIndex;  // element's old index within old parent
                                    evt.newIndex;  // element's new index within new parent

                                    var clonedArr = that.state.compressionChillerData;
                                    clonedArr = that.arrayMove(clonedArr, evt.oldIndex, evt.newIndex);
                                    that.updateCompressionList(clonedArr);
                                }
                            }
                        );
                        var order = this.sort.toArray();
                        this.sort.sort(order.sort());

                    }
                }
            }
            else {
                var priceFullList = <p className="scrollbar-macosx">{this.props.hoverText}</p>;
            }
        }
        if (this.props.title == HEAT_SOURCE_TITLE) {
            var heatForm = (
                <form>
                    <table className="table">

                        <tr>
                            <td className="input-label" style={tdBorder}>{this.props.t('HeatSource.Tab.TechnicalData.DriveTemperature.Title')}:</td>
                            <td className="input-fields" style={tdBorder}><InputRange
                                maxValue={90}
                                minValue={55}
                                value={this.state.drivetemp}
                                onChange={value => this.setHeatState(value)} /></td>
                        </tr>
                    </table>
                </form>
            )
            if (this.state.heatSourceDataChange == true && this.state.heatSourceData.length != 0) {
                projectData['heatsource'] = this.state.heatSourceData;
                let heatSourceData = this.state.heatSourceData;
                var pricelist = (
                    <ul className="price-listt scrollbar-macosx">

                        {(() => {
                            if (heatSourceData[0].heat_capacity != "") {
                                return (
                                    <li>
                                        <p>{this.props.t('Tiles.HeatSource.HeatCapacity')}</p>
                                        <h3>{heatSourceData[0].heat_capacity} kW</h3>
                                    </li>
                                )
                            }
                        })()}



                        <li>
                            <p>{this.props.t('Tiles.HeatSource.AvailableHeat')}</p>
                            <h3>1,767,768 kWh/a</h3>
                        </li>
                        <li>
                            <p>{this.props.t('Tiles.HeatSource.Temperature')}</p>
                            <h3><img src="public/images/degree-icon.png" alt="" /> 84°C</h3>
                        </li>
                    </ul>
                );

                var bodyContent = "Are you sure you want to delete the heat entry? Please confirm by clicking Yes.";
                var deleteModal = <DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} bodyContent={bodyContent} modalfor="heatSource" id="delete-heat-modal" />;
                var priceFullList = (
                    <div>

                        <div className="hover-list scrollbar-macosx">
                            <div className="table-responsive">
                                <table className="table">
                                    <tbody className="heatsourcesTableBody">
                                        {heatSourceData.map((data, h) => (
                                            <tr key={h} data-id={h}>
                                                <th>
                                                    {data.heat_name}
                                                    <ul className="list-inline">

                                                        {(() => {
                                                            if (data.heat_capacity != "") {
                                                                return (
                                                                    <li>{data.heat_capacity} kW
                                                      </li>
                                                                )
                                                            }
                                                        })()}

                                                        <li>85°C </li>
                                                    </ul>
                                                </th>
                                                <td><span className="edit-option" data-id={h} data-toggle="modal" data-backdrop="false" data-target={this.props.modalId} ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={() => this.editHeatRecord(h, { hiddenmode: "heatsourceformMode", hiddenmodekey: "heatsourceformModeKey" })}></i></span>
                                                    <span className="delete-optionn" data-id={h} ><i className="fa fa-trash-o" aria-hidden="true" data-modal="delete-heat-modal" onClick={(elem) => this.deleteRecord(h, elem)}></i></span>
                                                    <span className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                );

                var that = this;
                if (typeof $('.heatsourcesTableBody')[0] != "undefined") {
                    jQuery(".heat-sources-hover .scrollbar-macosx").scrollbar();

                    if (that.props.title == HEAT_SOURCE_TITLE) {

                        this.sort = Sortable.create(
                            $('.heatsourcesTableBody')[0],
                            {
                                animation: 150,
                                scroll: true,
                                sort: true,
                                dataIdAttr: 'data-id',
                                handle: '.drag-handler',
                                onEnd: function (/**Event*/evt) {
                                    evt.oldIndex;  // element's old index within old parent
                                    evt.newIndex;  // element's new index within new parent
                                },
                                onUpdate: function (/**Event*/evt) {
                                    // same properties as onEnd
                                    evt.oldIndex;  // element's old index within old parent
                                    evt.newIndex;  // element's new index within new parent

                                    var clonedArr = that.state.heatSourceData;
                                    clonedArr = that.arrayMove(clonedArr, evt.oldIndex, evt.newIndex);
                                    that.updateHeatSourceList(clonedArr);
                                }
                            }
                        );
                        var order = this.sort.toArray();
                        this.sort.sort(order.sort());

                    }
                }
            }
            else {
                var priceFullList = <p>
                    {heatForm}</p>;
            }
        }

        if (this.props.title == HEAT_LOAD_PROFILE_TITLE) {
            if (this.state.heatingProfileDataChange == true && this.state.heatingProfileData.length != 0) {
                projectData['heatingprofile'] = this.state.heatingProfileData;
                let heatingProfileData = this.state.heatingProfileData;
                var pricelist = (
                    <ul className="price-listt scrollbar-macosx">
                        <li>
                            <p>{this.props.t('HeatingProfile.HeatingDemand.Title')}</p>
                            <h3>464,068 kWh/a</h3>
                        </li>
                        <li>
                            <p>{this.props.t('HeatingProfile.UnusedHeat.Title')}</p>
                            <h3>1,303,700 kWh/a</h3>
                        </li>
                    </ul>
                );

                var bodyContent = "Are you sure you want to delete the heat entry? Please confirm by clicking Yes.";
                var deleteModal = <DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} bodyContent={bodyContent} modalfor="heatingprofile" id="delete-heat-modal" />;
                var priceFullList = (
                    <div>

                        <div className="hover-list scrollbar-macosx">
                            <div className="table-responsive">
                                <table className="table">
                                    <tbody className="heatingloadprofileTableBody">
                                        {heatingProfileData.map((data, h) => (
                                            <tr key={h} data-id={h}>
                                                <th>
                                                    {data.profile_name}
                                                    <ul className="list-inline">
                                                        <li> {data.profile_type}
                                                        </li>
                                                        <li>41.5 kW</li>
                                                    </ul>
                                                </th>
                                                <td><span className="edit-option" data-id={h} data-toggle="modal" data-backdrop="false" data-target={this.props.modalId} ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={() => this.editHeatRecord(h, { hiddenmode: "heatingprofileformMode", hiddenmodekey: "heatingprofileformModeKey" })}></i></span>
                                                    <span className="delete-optionn" data-id={h} ><i className="fa fa-trash-o" aria-hidden="true" data-modal="delete-heat-modal" onClick={(elem) => this.deleteRecord(h, elem)}></i></span>
                                                    <span className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                );

                var that = this;
                if (typeof $('.heatingloadprofileTableBody')[0] != "undefined") {
                    jQuery(".heating-load-hover .scrollbar-macosx").scrollbar();

                    if (that.props.title == HEAT_LOAD_PROFILE_TITLE) {

                        this.sort = Sortable.create(
                            $('.heatingloadprofileTableBody')[0],
                            {
                                animation: 150,
                                scroll: true,
                                sort: true,
                                dataIdAttr: 'data-id',
                                handle: '.drag-handler',
                                onEnd: function (/**Event*/evt) {
                                    evt.oldIndex;  // element's old index within old parent
                                    evt.newIndex;  // element's new index within new parent
                                },
                                onUpdate: function (/**Event*/evt) {
                                    // same properties as onEnd
                                    evt.oldIndex;  // element's old index within old parent
                                    evt.newIndex;  // element's new index within new parent

                                    var clonedArr = that.state.heatingProfileData;
                                    clonedArr = that.arrayMove(clonedArr, evt.oldIndex, evt.newIndex);
                                    that.updateHeatSourceList(clonedArr);
                                }
                            }
                        );
                        var order = this.sort.toArray();
                        this.sort.sort(order.sort());

                    }
                }
            }
            else {
                var priceFullList = <p className="scrollbar-macosx">{this.props.hoverText}</p>;
            }
        }
        if (this.props.title == COOLING_LOAD_PROFILE_TITLE) {
            var coolingLoadForm = (
                <form onSubmit={this.onSubmit}>
                    <table className="table">
                        <tr>
                            <td className="input-label" style={tdBorder}>{this.props.t('CoolingProfile.Tab.TechnicalData.ProfileType.Title')}:</td>
                            <td className="input-fields" style={tdBorder}>
                                <select className="required-field" data-method="cooling_profile_type" onChange={(elem) => this.updateState(elem)} name="cooling_profile_type" id="cooling_profile_type">
                                    <option value="Office Space">Office Space</option>
                                    <option value="Process cooling">Process Cooling</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td className="input-label" style={tdBorder}>{this.props.t('CoolingProfile.Tab.TechnicalData.MaxCoolingLoad.Title')}:</td>
                            <td className="input-fields" style={tdBorder}>
                                <ul className="list-inline">
                                    <li className="withunit"><input type="text" data-method="cooling_max_cooling_load" required placeholder="50.0" pattern="\d*" className="required-field onlynumeric" name="cooling_max_cooling_load" value={this.state.coolingLoad} id="cooling_max_cooling_load" onChange={(elem) => this.updateState(elem)} /><span>kW</span></li>

                                </ul>
                                <span className="errorMessages">{this.state.errorMsg}</span>
                            </td>
                        </tr>
                        <tr>
                            <td className="input-label" style={tdBorder}>{this.props.t('CoolingProfile.Tab.TechnicalData.ChilledWaterTemperature.Title')}:</td>
                            <td className="input-fields" style={tdBorder}><InputRange
                                maxValue={20}
                                minValue={12}
                                value={this.state.chilledwatertemp}
                                onChange={value => this.setCoolingState(value)} /></td>
                        </tr>
                    </table>
                </form>

            )
            COOLING_FORM_STATUS = (this.state.coolingProfileData.length == 0) ? false : true; //use to validate the form.
            if (this.state.coolingProfileDataChange == true && this.state.coolingProfileData.length != 0) {
                projectData['chiller'] = this.state.coolingProfileData;
                let coolingProfileData = this.state.coolingProfileData;
                var pricelist = (
                    <ul className="price-listt scrollbar-macosx">
                        <li>
                            <p>Cooling Demand</p>
                            <h3>468,168 kWa/a</h3>
                        </li>
                        <li>
                            <p>Comoression Electricity Cost</p>
                            <h3>33,708 €/a</h3>
                        </li>



                        <li>
                            <p>Temperature</p>
                            <h3><img src="public/images/degree-icon.png" alt="" /> {coolingProfileData[0].cooling_base_load_to}°C</h3>
                        </li>


                    </ul>
                );

                var bodyContent = "Are you sure you want to delete the heat entry? Please confirm by clicking Yes.";
                var deleteModal = <DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} bodyContent={bodyContent} modalfor="coolingloadprofile" id="delete-heat-modal" />;
                var priceFullList = (
                    <div>

                        <div className="hover-list scrollbar-macosx">
                            <div className="table-responsive">
                                <table className="table">
                                    <tbody className="coolingloadprofileTableBody">
                                        {coolingProfileData.map((data, h) => (
                                            <tr key={h} data-id={h}>
                                                <th>


                                                    {data.cooling_radiant_cooling_office}

                                                    <ul className="list-inline">
                                                        <li>


                                                            {data.cooling_cooling_other}°C

                                                      </li>
                                                        <li>   {data.cooling_cooling_hours} h	</li>
                                                        <li> {data.cooling_base_load_to} kW </li>
                                                    </ul>
                                                </th>
                                                <td><span className="edit-option" data-id={h} data-toggle="modal" data-backdrop="false" data-target={this.props.modalId} ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={() => this.editHeatRecord(h, { hiddenmode: "coolingprofileformMode", hiddenmodekey: "coolingprofileformModeKey" })}></i></span>
                                                    <span className="delete-optionn" data-id={h} ><i className="fa fa-trash-o" aria-hidden="true" data-modal="delete-heat-modal" onClick={(elem) => this.deleteRecord(h, elem)}></i></span>
                                                    <span className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                );
                var requiredMsg = "";

                var that = this;
                if (typeof $('.coolingloadprofileTableBody')[0] != "undefined") {
                    jQuery(".cooling-load-hover .scrollbar-macosx").scrollbar();

                    if (that.props.title == COOLING_LOAD_PROFILE_TITLE) {

                        this.sort = Sortable.create(
                            $('.coolingloadprofileTableBody')[0],
                            {
                                animation: 150,
                                scroll: true,
                                sort: true,
                                dataIdAttr: 'data-id',
                                handle: '.drag-handler',
                                onEnd: function (/**Event*/evt) {
                                    evt.oldIndex;  // element's old index within old parent
                                    evt.newIndex;  // element's new index within new parent
                                },
                                onUpdate: function (/**Event*/evt) {
                                    // same properties as onEnd
                                    evt.oldIndex;  // element's old index within old parent
                                    evt.newIndex;  // element's new index within new parent

                                    var clonedArr = that.state.coolingProfileData;
                                    clonedArr = that.arrayMove(clonedArr, evt.oldIndex, evt.newIndex);
                                    that.updateHeatSourceList(clonedArr);
                                }
                            }
                        );
                        var order = this.sort.toArray();
                        this.sort.sort(order.sort());

                    }
                }
            }
            else {
                var priceFullList = <p className="scrollbar-macosx">{coolingLoadForm}</p>;
            }

        }
        if (this.props.title == GENERAL_TILE) {
            var generalForm = (
                <form>
                    <table className="table">
                        <tr>
                            <td className="input-label" style={tdBorder}>{this.props.t('General.Tab.Personal.PersonalAddress.Title')}:</td>

                            <td className="input-fields" style={tdBorder} onChange={value => this.selectTemp(value)} >
                                <select>
                                    <option value="munich">munich</option>
                                    <option value="accra">accra</option>
                                    <option value="dubai">dubai</option>
                                    <option value="losagelos">losagelos</option>
                                    <option value="madrid">madrid</option>
                                    <option value="melbourne">melbourne</option>
                                    <option value="meuchen">meuchen</option>
                                    <option value="rio">rio</option>
                                    <option value="seuol">seuol</option>
                                    <option value="singapore">singapore</option>
                                    <option value="warzawa">warzawa</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td className="input-label" style={tdBorder}>{this.props.t('General.Tab.Project.ProjectTemp.Title')}:</td>
                            <td className="input-fields" style={tdBorder}><InputRange
                                maxValue={this.state.outdoortemp.max}
                                minValue={this.state.outdoortemp.min}
                                value={this.state.outdoortempvalue}
                                onChange={value => this.setTempState(value)} /></td>
                        </tr>
                        <tr><td className="input-label" style={tdBorder} colSpan="2">On {this.state.totalHours} hours per year, it's warmer than {this.state.outdoortempvalue}°C.</td></tr>
                    </table>
                </form>
            )
            if (this.state.generalDataChange) {
                projectData['generalData'] = this.state.generalData;
                store.dispatch(addGeneralData(this.state.generalData))
                var pricelist = (
                    <ul className="price-listt plnewblock scrollbar-macosx">
                        <div className="clrs"></div>
                        <li>
                            <p>{this.props.t('General.Tab.Project.ProjectLocation.Title')}</p>
                            <h3 className="textUpper">{this.state.generalData.location}</h3>
                        </li>
                    </ul>
                );
                var priceFullList = generalForm
                //     jQuery(".general-information .scrollbar-macosx").scrollbar();
                var requiredMsg = "";
            }
            else {

                var priceFullList = <p className="scrollbar-macosx">{generalForm}</p>;
            }

        }
        if (this.props.title == OPTION_TILE) {
            var pricelist = (
                <ul className="price-listt">
                    <li>
                        <p>Re-cooling Type</p>
                        <h3>DRY</h3>
                    </li>
                    <li>
                        <p>Free cooling</p>
                        <h3>YES <span>(chilled water temperature)</span></h3>
                    </li>
                </ul>

            );
            var priceFullList = (<div><ul className="price-listt">
                <li>
                    <p>Language</p>
                    <h3>English</h3>
                </li>
                <li>
                    <p>BAFA 2018</p>
                    <h3>Calculate</h3>
                </li>
                <li>
                    <p>Re-cooling Type</p>
                    <h3>Dry</h3>
                </li>
            </ul>
                <ul className="right-list-content">
                    <li>
                        <p>Free cooling</p>
                        <h3>Yes <span>(chilled water temperature)</span></h3>
                    </li>
                </ul></div>);
            if (this.state.optionDataChange) {
                projectData['option'] = this.state.optionData;
                var pricelist = (
                    <ul className="price-listt plnewblock">



                        {(() => {
                            if (this.state.optionData[0].option_language != "") {

                                if (this.state.optionData[0].option_language == "en") {
                                    return (
                                        <li className="pdtnam">
                                            <p>Language</p>
                                            <h3 className="textUpper">ENGLISH</h3>
                                        </li>

                                    )
                                }
                                else {
                                    return (
                                        <li className="pdtnam">
                                            <p>Language</p>
                                            <h3 className="textUpper">GERMAN</h3>
                                        </li>

                                    )

                                }

                            }
                        })()}


                        <li className="pdtnum">
                            <p>BAFA 2018</p>
                            <h3 className="textUpper">{this.state.optionData[0].profile_bafa}</h3>
                        </li>
                        <div className="clrs"></div>
                        <li>
                            <p>Re-cooling Type</p>
                            <h3 className="textUpper">{this.state.optionData[0].profile_recooling}</h3>
                        </li>

                        <li>
                            <p>Free cooling</p>
                            <h3 className="textUpper">{this.state.optionData[0].free_recooling}</h3>
                        </li>
                    </ul>

                );
                var priceFullList = (<div className="hover-list">
                    <div className="table-responsive">
                        <table className="table">



                            {(() => {
                                if (this.state.optionData[0].option_language != "") {

                                    if (this.state.optionData[0].option_language == "en") {
                                        return (
                                            <tr>
                                                <th>Language: </th>
                                                <td>English</td></tr>

                                        )
                                    }
                                    else {
                                        return (
                                            <tr>
                                                <th>Language: </th>
                                                <td>German</td></tr>

                                        )

                                    }

                                }
                            })()}

                            {(() => {
                                if (this.state.optionData[0].profile_bafa != "") {
                                    return (
                                        <tr>
                                            <th>BAFA 2018: </th>
                                            <td>{this.state.optionData[0].profile_bafa}</td>
                                        </tr>
                                    )
                                }
                            })()}




                            <tr>
                                <th>Re-cooling type: </th>
                                <td>{this.state.optionData[0].profile_recooling}</td>
                            </tr>
                            <tr>
                                <th>Free cooling: </th>
                                <td>{this.state.optionData[0].free_recooling}

                                </td>
                            </tr>
                        </table>
                    </div>
                </div>);
                var requiredMsg = "";
            }
        }

        if (this.props.priceList == "yes") {
            var pricelist = (
                <ul className="price-listt">
                    <li>
                        <p>{this.props.t('Tiles.CompressionChiller.HoverCoolingTitle')}</p>
                        <h3>100.0 kW</h3>
                    </li>
                    <li>
                        <p>{this.props.t('Tiles.CompressionChiller.NumberofCompressor')}</p>
                        <h3>3</h3>
                    </li>
                    <li>
                        <p>{this.props.t('Tiles.CompressionChiller.Temperature')}</p>
                        <h3><img src="public/images/degree-icon.png" alt="" /> 6°C</h3>
                    </li>
                </ul>
            );
            var priceFullList = (
                <ul className="price-listt">
                    <li>
                        <p>{this.props.t('Tiles.Options.Language')}</p>
                        <h3>English</h3>
                    </li>
                    <li>
                        <p>BAFA 2018</p>
                        <h3>Calculate</h3>
                    </li>
                    <li>
                        <p>{this.props.t('Tiles.Options.ReCoolingType')}</p>
                        <h3>Dry</h3>
                    </li>
                </ul>
            );
        }

        if (this.props.title == ECONOMIC_TITLE) {

            var pricelist = (

                <ul className="price-listt">
                    <li>
                        <p>{this.props.t('Economic.Tab.General.ElectricityPrice.Title')}</p>
                        <h3>0.1800 €/kWh</h3>
                    </li>
                </ul>

            );
            var priceFullList = (<ul className="price-listt">
                <li>
                    <p>{this.props.t('Economic.Tab.General.ElectricityPrice.Title')}</p>
                    <h3>0.1800 €/kWh</h3>
                </li>
                <li>
                    <p>{this.props.t('Economic.Tab.CHP.GasPrice.Title')}</p>
                    <h3>0.035 €/kWh</h3>
                </li>
            </ul>);
            if (this.state.economicDataChange) {
                projectData['economicData'] = this.state.economicData;
                var pricelist = (

                    <ul className="price-listt plnewblock">


                        {(() => {
                            if (this.state.economicData[0].electric_price != "") {
                                return (
                                    <li className="pdtnam">
                                        <p>{this.props.t('Economic.Tab.General.ElectricityPrice.Title')}</p>
                                        <h3>{this.state.economicData[0].electric_price}<br />
                                            €/kWh</h3>
                                    </li>

                                )
                            }
                        })()}


                        {(() => {
                            if (this.state.economicData[0].own_usage_of_electricity != "") {
                                return (
                                    <li className="pdtnum">
                                        <p>{this.props.t('Economic.Tab.CHP.OwnUsageOfElectricity.Title')}</p>
                                        <h3>{this.state.economicData[0].own_usage_of_electricity}%</h3>
                                    </li>

                                )
                            }
                        })()}


                        <div className="clrs"></div>

                        {(() => {
                            if (this.state.economicData[0].gas_price != "") {
                                return (
                                    <li className="pdtnam">
                                        <p>{this.props.t('Economic.Tab.CHP.GasPrice.Title')}</p>
                                        <h3>{this.state.economicData[0].gas_price}<br />
                                            €/kWh</h3>
                                    </li>

                                )
                            }
                        })()}

                        {(() => {
                            if (this.state.economicData[0].subsidy_for_electricity != "") {
                                return (
                                    <li className="pdtnum">
                                        <p>{this.props.t('Economic.Tab.CHP.KWKEubsidyForElectricity.Title')}</p>
                                        <h3>{this.state.economicData[0].subsidy_for_electricity}</h3>
                                    </li>

                                )
                            }
                        })()}




                    </ul>

                );
                var priceFullList = (<div className="hover-list">
                    <div className="table-responsive">

                        <table className="table">
                            <tbody>

                                {(() => {
                                    if (this.state.economicData[0].electric_price != "") {
                                        return (
                                            <tr>
                                                <th>{this.props.t('Economic.Tab.General.ElectricityPrice.Title')}:</th>
                                                <td>{this.state.economicData[0].electric_price} €/kWh</td>
                                            </tr>
                                        )
                                    }
                                })()}

                                {(() => {
                                    if (this.state.economicData[0].gas_price != "") {
                                        return (
                                            <tr>
                                                <th>{this.props.t('Economic.Tab.CHP.GasPrice.Title')}:</th>
                                                <td>{this.state.economicData[0].gas_price} €/kWh</td>
                                            </tr>
                                        )
                                    }
                                })()}

                                {(() => {
                                    if (this.state.economicData[0].own_usage_of_electricity != "") {
                                        return (
                                            <tr>
                                                <th>{this.props.t('Economic.Tab.CHP.OwnUsageOfElectricity.Title')}: </th>
                                                <td>{this.state.economicData[0].own_usage_of_electricity}%</td>
                                            </tr>
                                        )
                                    }
                                })()}

                                {(() => {
                                    if (this.state.economicData[0].subsidy_for_electricity != "") {
                                        return (
                                            <tr>
                                                <th>{this.props.t('Economic.Tab.CHP.KWKEubsidyForElectricity.Title')}</th>
                                                <td>{this.state.economicData[0].subsidy_for_electricity}</td>
                                            </tr>
                                        )
                                    }
                                })()}




                            </tbody>
                        </table>
                    </div>
                </div>);
                var requiredMsg = "";
            }
        }
        if (this.props.title == FAHRENHEIT_SYSTEM) {

            if (this.state.fahrenheitDataChange) {
                projectData = this.props.dataRecord;
                var pricelist = (
                    <ul className="price-listt">
                        <li>
                            <p>Tn_MtLn:</p>
                            <h3>{projectData.Tn_min}</h3>
                        </li>
                        <li>
                            <p>Tmt_out</p>
                            <h3>{projectData.Tmt_out}</h3>
                        </li>
                        <li>
                            <p>Qth_Lt</p>
                            <h3>{projectData.Qth_Lt}</h3>
                        </li>
                        <li className="paybkprd">
                            <p>COP</p>
                            <h3>{projectData.COP}</h3>
                        </li>

                    </ul>

                );
                var priceFullList = (
                    <ul className="price-listt">
                        <li>
                            <p>Tn_MtLn:</p>
                            <h3> 32.14c</h3>
                        </li>
                        <li>
                            <p>Tmt_out</p>
                            <h3>34.67C</h3>
                        </li>
                        <li>
                            <p>Qth_Lt</p>
                            <h3>15.00 KW</h3>
                        </li>
                        <li className="paybkprd">
                            <p>COP</p>
                            <h3>0.288</h3>
                        </li>

                    </ul>
                );
                var requiredMsg = "";
            }
            else {
                var priceFullList = <p className="scrollbar-macosx">{this.props.hoverText}</p>;
            }
        }


        return (
            <ErrorBoundary>
                <div className={this.props.mainclass} >
                    <div className={this.props.tileCls}>
                        <h1>{this.props.header}</h1>
                        {requiredMsg}
                        {pricelist}
                        <div className={this.props.hoverCls}>
                            <h1>{this.props.header}</h1>
                            <div className={this.props.editCls}><img src={this.props.editIcon} alt="" data-toggle="modal" data-backdrop="false" data-target={this.props.modalId} /></div>
                            {priceFullList}
                        </div>
                    </div>
                    {deleteModal}
                </div>
            </ErrorBoundary>
        );
    }
}
export default translate(Tiles);

// Tiles.defaultProps = translate({
//     title:GENERAL_TILE,
//     header:t('Tiles.General.Title'),
//     tileCls:'general-information data-box',
//     required:"no",
//     edit:'yes',
//     editCls:'edit-icon myBtn_multi',
//     editIcon:'images/edit-icon.png',
//     add:'no',
//     hoverText:this.props.t('Tiles.General.hoverText'),
//     mainClass:'col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4',
//     hoverCls:'main-hover-box general-info-hover',
//     priceLst:'no',
//     priceData:{

//     },
//     rightpriceList:'no',
//     rightpriceListeData:{

//     },
//     multiple:false,
//     dataRecord:[]

//   });
