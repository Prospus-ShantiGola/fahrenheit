import React from 'react';

import {DeleteModal} from './DeleteModal';
import {ErrorBoundary} from './ErrorBoundary';
import { translate } from 'react-multi-lang';

const hideEle={
    visibility:"hidden"
}
class Tiles extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            compressionChillerData:[],
            compressionDataChange:false,
            generalData:[],
            generalDataChange:false,
            optionData:[],
            optionDataChange:false,
            economicData:[],
            economicDataChange:false,
            heatSourceData:[],
            heatSourceDataChange:false,
            heatingProfileData:[],
            heatingProfileDataChange:false,
            coolingProfileData:[],
            coolingProfileDataChange:false,
            fahrenheitData:[],
            fahrenheitDataChange:this.props.datachanged,
               };
        this.editRecord=this.editRecord.bind(this);
        this.editHeatRecord=this.editHeatRecord.bind(this);
        this.deleteRecord=this.deleteRecord.bind(this);
        this.updateCompressionList=this.updateCompressionList.bind(this);
        this.updateHeatSourceList=this.updateHeatSourceList.bind(this);
        this.handleChillerDeleteEntry=this.handleChillerDeleteEntry.bind(this);
        this.handleHeatSourceDeleteEntry=this.handleHeatSourceDeleteEntry.bind(this);
        this.arrayMove=this.arrayMove.bind(this);
    }
    componentWillReceiveProps(nextProps){

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
                if (nextProps.dataRecord.generalformMode == "add") {
                    this.setState({
                        generalData: this.state.generalData.concat(nextProps.dataRecord)
                    })
                } else {

                    this.state.generalData[0] = nextProps.dataRecord
                    this.forceUpdate()
                }
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
    componentDidUpdate(){

    }
    componentWillUnmount(){
       // console.log("component unmount")
    }
    componentDidMount(){



        var that=this;

        if(that.props.title==HEAT_SOURCE_TITLE){
      //  log(`isClamped: ${this.linesEllipsis.isClamped()} when page didMount`)
    //    console.log("Lineellipses",this.linesEllipsis.state.clamped);
    //    console.log("Lineellipses state",this.linesEllipsis);

        }

        if(this.state.compressionChillerData.length==0)
        {
          this.setState({
              compressionDataChange: false
            });
        }
        else{
            jQuery(".scrollbar-macosx").scrollbar();
        }
        if(this.state.heatSourceData.length==0)
        {

          this.setState({
              heatSourceDataChange: false
            });
        }
        else{
            jQuery(".scrollbar-macosx").scrollbar();
        }
        if(this.state.heatingProfileData.length==0)
        {
          this.setState({
            heatingProfileDataChange: false
            });
        }
        else{
            jQuery(".scrollbar-macosx").scrollbar();
        }
        if(this.state.coolingProfileData.length==0)
        {
          this.setState({
            coolingProfileDataChange: false
            });
        }
        else{
            jQuery(".scrollbar-macosx").scrollbar();
        }
        $(document).on('show.bs.modal','#general-information', function () {
            if(that.props.title==GENERAL_TILE){
                var dataObj=that.state.generalData[0];
                if(typeof dataObj !='undefined'){

                for (var key in dataObj) {
                    if (dataObj.hasOwnProperty(key)) {
                        //console.log($(this.props.modalId).find(key),this.props.modalId,key);

                        $(that.props.modalId).find('#'+key).val(dataObj[key]);
                    }
                }
                $(that.props.modalId).find('#generalformMode').val("edit");
                 }
                }
                //Do stuff here
            });
            $(document).on('show.bs.modal','#economic-information', function () {
                if(that.props.title==ECONOMIC_TITLE){
                    $( "ul.errorMessages" ).addClass('hide');
                    var dataObj=that.state.economicData[0];
                    if(NO_CUSTOM_FIELD >0 ){
                        if($("#FinancialItem_"+(NO_CUSTOM_FIELD-1)).next('tr').length>0){
                            $("#FinancialItem_"+(NO_CUSTOM_FIELD-1)).nextAll('tr').not('.clone').remove();
                        }
                    }else{
                        $("#FinancialItem_0").nextAll('tr').not('.clone').remove();
                    }
                    if(NO_CUSTOM_FIELD_MAINTENENCE >0 ){
                        if($("#MaintenenceItem_"+(NO_CUSTOM_FIELD_MAINTENENCE-1)).next('tr').length>0){
                            $("#MaintenenceItem_"+(NO_CUSTOM_FIELD_MAINTENENCE-1)).nextAll('tr').not('.clone').remove();
                        }
                    }else{
                        $("#MaintenenceItem_0").nextAll('tr').not('.clone').remove();
                    }
                    if(NO_CUSTOM_FIELD_GENERAL >0 ){
                        if($("#generalItem_"+(NO_CUSTOM_FIELD_GENERAL-1)).next('tr').length>0){
                            $("#generalItem_"+(NO_CUSTOM_FIELD_GENERAL-1)).nextAll('tr').not('.clone').remove();
                        }
                    }else{
                        $("#generalItem_").nextAll('tr').not('.clone').remove();
                    }
                    if(NO_CUSTOM_FIELD_CHP >0 ){
                        if($("#chpItem_"+(NO_CUSTOM_FIELD_CHP-1)).next('tr').length>0){
                            $("#chpItem_"+(NO_CUSTOM_FIELD_CHP-1)).nextAll('tr').not('.clone').remove();
                        }
                    }else{
                        $("#chpTable tr.multiple").remove();
                    }

                    if(typeof dataObj !='undefined'){

                    for (var key in dataObj) {
                        if (dataObj.hasOwnProperty(key)) {
                            //console.log($(this.props.modalId).find(key),this.props.modalId,key);
                            if(key.indexOf("[]") != -1)  continue;
                            $(that.props.modalId).find('#'+key).val(dataObj[key]);
                        }
                    }
                    $(that.props.modalId).find('#economicformMode').val("edit");

                     }
                    }
                    //Do stuff here
                });


    }
    updateCompressionList(clonedArr){
       //console.log("sorting finish",clonedArr);
       this.setState({
        compressionChillerData: clonedArr
      });

    }
    updateHeatSourceList(clonedArr){
        //console.log("sorting finish",clonedArr);
        this.setState({
         heatSourceData: clonedArr
       });

     }
    editRecord(elemKey){
        let dataObj=this.state.compressionChillerData[elemKey];
        for (var key in dataObj) {
            if (dataObj.hasOwnProperty(key)) {
                //console.log($(this.props.modalId).find(key),this.props.modalId,key);
                $(this.props.modalId).find('#'+key).val(dataObj[key]);
            }
        }
        $(this.props.modalId).find('#chillerformMode').val("edit");
        $(this.props.modalId).find('#chillerformModeKey').val(elemKey);
        //$(this.props.modalId).find
    }
    editHeatRecord(elemKey,modalID){
        let dataObj="";
        switch (elemKey) {
            case 'heatsourceformModeKey':
                   dataObj=this.state.heatSourceData[elemKey];
                break;
                case 'heatingprofileformModeKey':
                dataObj=this.state.heatingProfileData[elemKey];
                break;
                case 'coolingprofileformModeKey':
                dataObj=this.state.coolingProfileData[elemKey];
                break;

            default:
               dataObj=this.state.heatSourceData[elemKey];
                break;
        }


        for (var key in dataObj) {
            if (dataObj.hasOwnProperty(key)) {
                //console.log($(this.props.modalId).find(key),this.props.modalId,key);
                $(this.props.modalId).find('#'+key).val(dataObj[key]);
            }
        }
        $(this.props.modalId).find('#'+modalID.hiddenmode).val("edit");
        $(this.props.modalId).find('#'+modalID.hiddenmodekey).val(elemKey);
        //$(this.props.modalId).find
    }
    deleteRecord(eleId,eleM){
        var modalId=eleM.target.getAttribute('data-modal');
        $("#"+modalId).find("#entry-id").attr('data-id',eleId);
        $("#"+modalId).modal("show");
    }
    handleChillerDeleteEntry(result){
        //console.log(result);
        if(result.modalFor =="compressionChiller"){
        var clonedArrDelete = this.state.compressionChillerData; // make a separate copy of the array
        clonedArrDelete.splice(result.elementId, 1);
        this.setState({compressionChillerData: clonedArrDelete});
        }
        else{
        var clonedArrDelete = this.state.heatSourceData; // make a separate copy of the array
        clonedArrDelete.splice(result.elementId, 1);
        this.setState({heatSourceData: clonedArrDelete});
        }
    }

    handleHeatSourceDeleteEntry(result){
        var clonedArrDelete = this.state.compressionChillerData; // make a separate copy of the array
        clonedArrDelete.splice(result.elementId, 1);
        this.setState({compressionChillerData: clonedArrDelete});

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
        projectData['generalData'] = this.state.generalData;   //use to store the object to save the data
        projectData['economicData'] = this.state.economicData; //use to store the object to save the data
        var priceFullList,pricelist,requiredMsg="";
        if(this.props.required=="yes"){
            var requiredMsg=<h5 className="input-required">{this.props.t('InputRequired')}</h5>;
        }

        var deleteModal="";
        if(this.state.compressionDataChange==true && this.state.compressionChillerData.length!=0){
            var bodyContent="Are you sure you want to delete the chiller entry? Please confirm by clicking Yes.";
            var deleteModal= <DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} bodyContent={bodyContent} modalfor="compressionChiller" id="delete-modal"/>;
            var pricelist=(
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
                                       <h3><img src='public/images/degree-icon.png' alt='' /> {(this.state.compressionChillerData[0].temperature!="") ? this.state.compressionChillerData[0].temperature+"°C": ""}</h3>
                                    </li>
                </ul>
            );
            let chillerData=this.state.compressionChillerData;

            var priceFullList=(

                <div>

                <div className="hover-list scrollbar-macosx">
                                       <div className="table-responsive">
                                          <table className="table">
                                           <tbody className="compressionTableBody">
                                           {chillerData.map((data,i) => (

<tr key={i} data-id={i}>
<th>
{data.chillername}
   <ul className="list-inline" key={i}>
      <li >120.30 kW
      </li>
      <li>	{(data.temperature!="")? data.temperature+'°C':"" } </li>
   </ul>
</th>
<td><span className="edit-option" data-id={i}  data-toggle="modal" data-backdrop="false" data-target={this.props.modalId} ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={()=>this.editRecord(i)}></i></span>
   <span className="delete-optionn" data-id={i} ><i className="fa fa-trash-o" aria-hidden="true" data-modal="delete-modal" onClick={(elem)=>this.deleteRecord(i,elem)}></i></span>
   <span  className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span>
</td>
</tr>))}
                                             </tbody>
                                          </table>
                                       </div>
            </div>
            </div>
            );

            var that=this;
            if(typeof $('.compressionTableBody')[0] !="undefined"){
                jQuery(".compression-chillers-hover .scrollbar-macosx").scrollbar();

                if(that.props.title==CHILLER_TITLE){

                    this.sort=Sortable.create(
                        $('.compressionTableBody')[0],
                        {
                        animation: 150,
                        scroll: true,
                        sort: true,
                        dataIdAttr: 'data-id',
                        handle: '.drag-handler',
                        onEnd:function (/**Event*/evt) {
                            evt.oldIndex;  // element's old index within old parent
                            evt.newIndex;  // element's new index within new parent
                        },
                        onUpdate: function (/**Event*/evt) {
                            // same properties as onEnd
                            evt.oldIndex;  // element's old index within old parent
                            evt.newIndex;  // element's new index within new parent

                            var clonedArr=that.state.compressionChillerData;
                            clonedArr=that.arrayMove(clonedArr,evt.oldIndex,evt.newIndex);
                            that.updateCompressionList(clonedArr);
                        }
                        }
                        );
                       var order = this.sort.toArray();
                       this.sort.sort(order.sort());

                    }
        }
        }
        else{
            var priceFullList= <p className="scrollbar-macosx">{this.props.hoverText}</p>;
        }
        if(this.props.title==HEAT_SOURCE_TITLE){
        if(this.state.heatSourceDataChange==true && this.state.heatSourceData.length!=0){
            let heatSourceData=this.state.heatSourceData;
            var pricelist=(
                <ul className="price-listt scrollbar-macosx">
                                    <li>
                                       <p>{this.props.t('Tiles.HeatSource.HeatCapacity')}</p>
                                       <h3>{heatSourceData[0].heat_capacity} kW</h3>
                                    </li>
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

            var bodyContent="Are you sure you want to delete the heat entry? Please confirm by clicking Yes.";
            var deleteModal=<DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} bodyContent={bodyContent} modalfor="heatSource" id="delete-heat-modal"/>;
            var priceFullList=(
                <div>

                <div className="hover-list scrollbar-macosx">
                                       <div className="table-responsive">
                                          <table className="table">
                                           <tbody className="heatsourcesTableBody">
{heatSourceData.map((data,h) => (
                                           <tr key={h} data-id={h}>
                                                <th>
                                                   {data.heat_name}
                                                   <ul className="list-inline">
                                                      <li>{data.heat_capacity} kW
                                                      </li>
                                                      <li>85°C </li>
                                                   </ul>
                                                </th>
                                                <td><span className="edit-option" data-id={h}  data-toggle="modal" data-backdrop="false" data-target={this.props.modalId} ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={()=>this.editHeatRecord(h,{hiddenmode:"heatsourceformMode",hiddenmodekey:"heatsourceformModeKey"})}></i></span>
            <span className="delete-optionn" data-id={h} ><i className="fa fa-trash-o" aria-hidden="true" data-modal="delete-heat-modal" onClick={(elem)=>this.deleteRecord(h,elem)}></i></span>
            <span  className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span>
         </td>
                                             </tr>
 ))}
                                             </tbody>
                                          </table>
                                       </div>
                                    </div>
            </div>
            );

            var that=this;
            if(typeof $('.heatsourcesTableBody')[0] !="undefined"){
                jQuery(".heat-sources-hover .scrollbar-macosx").scrollbar();

                if(that.props.title==HEAT_SOURCE_TITLE){

                    this.sort=Sortable.create(
                        $('.heatsourcesTableBody')[0],
                        {
                        animation: 150,
                        scroll: true,
                        sort: true,
                        dataIdAttr: 'data-id',
                        handle: '.drag-handler',
                        onEnd:function (/**Event*/evt) {
                            evt.oldIndex;  // element's old index within old parent
                            evt.newIndex;  // element's new index within new parent
                        },
                        onUpdate: function (/**Event*/evt) {
                            // same properties as onEnd
                            evt.oldIndex;  // element's old index within old parent
                            evt.newIndex;  // element's new index within new parent

                            var clonedArr=that.state.heatSourceData;
                            clonedArr=that.arrayMove(clonedArr,evt.oldIndex,evt.newIndex);
                            that.updateHeatSourceList(clonedArr);
                        }
                        }
                        );
                       var order = this.sort.toArray();
                       this.sort.sort(order.sort());

                    }
        }
        }
        else{
            var priceFullList= <p>
           {this.props.hoverText}</p>;
        }
    }

        if (this.props.title == HEAT_LOAD_PROFILE_TITLE) {
            if (this.state.heatingProfileDataChange == true && this.state.heatingProfileData.length != 0) {
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
                var deleteModal = <DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} bodyContent={bodyContent} modalfor="heatSource" id="delete-heat-modal" />;
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
            if (this.state.coolingProfileDataChange == true && this.state.coolingProfileData.length != 0) {
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
                var deleteModal = <DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} bodyContent={bodyContent} modalfor="heatSource" id="delete-heat-modal" />;
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
                                                        <li>{data.cooling_cooling_other}°C
                                                      </li>
                                                        <li>	{data.cooling_cooling_hours} h</li>
                                                        <li>{data.cooling_base_load_to} kW</li>
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
                var priceFullList = <p className="scrollbar-macosx">{this.props.hoverText}</p>;
            }
        }
        if(this.props.title == GENERAL_TILE){
            if (this.state.generalDataChange) {
                var pricelist = (

                    <ul className="price-listt plnewblock">
                        <li className="pdtnam">
                            <p>{this.props.t('General.Tab.Project.ProjectName.Title')}</p>
                            <h3 className="textUpper">{this.state.generalData[0].project_name}</h3>
                        </li>
                        <li className="pdtnum">
                            <p>{this.props.t('General.Tab.Project.ProjectNumber.Title')}</p>
                            <h3 className="textUpper">{this.state.generalData[0].project_number}</h3>
                        </li>
                        <div className="clrs"></div>
                        <li>
                            <p>{this.props.t('General.Tab.Personal.PersonalEditor.Title')}</p>
                            <h3 className="textUpper">{this.state.generalData[0].editor}</h3>
                        </li>
                        <li>
                            <p>{this.props.t('General.Tab.Project.ProjectLocation.Title')}</p>
                            <h3 className="textUpper">{this.state.generalData[0].location}</h3>
                        </li>
                    </ul>

                );
                var priceFullList = (<div className="hover-list">
                    <div className="table-responsive">

                        <table className="table">
                            <tbody>
                                <tr>
                                    <th>{this.props.t('General.Tab.Project.ProjectName.Title')}:</th>
                                    <td>{this.state.generalData[0].project_name}</td>
                                </tr>
                                <tr>
                                    <th>{this.props.t('General.Tab.Project.ProjectNumber.Title')}:</th>
                                    <td>{this.state.generalData[0].project_number}</td>
                                </tr>
                                <tr>
                                    <th>{this.props.t('General.Tab.Personal.PersonalEditor.Title')}: </th>
                                    <td>{this.state.generalData[0].editor}</td>
                                </tr>
                                <tr>
                                    <th>{this.props.t('General.Tab.Project.ProjectLocation.Title')}:</th>
                                    <td>{this.state.generalData[0].location}</td>
                                </tr>
                                <tr>
                                    <th>{this.props.t('General.Tab.Project.ProjectContact.Title')}: </th>
                                    <td>{this.state.generalData[0].customer}</td>
                                </tr>
                                <tr>
                                    <th>{this.props.t('General.Tab.Project.ProjectPhone.Title')}:</th>
                                    <td>{this.state.generalData[0].phone_number}</td>
                                </tr>
                                <tr>
                                    <th>{this.props.t('General.Tab.Project.ProjectEmail.Title')}:</th>
                                    <td>{this.state.generalData[0].email_address}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>);
                var requiredMsg = "";
            }
        }
        if(this.props.title == OPTION_TILE){
            if (this.state.optionDataChange) {
                var pricelist = (


                    <ul className="price-listt plnewblock">
                    <li className="pdtnam">
                      <p>Language</p>
                      <h3 className="textUpper">ENGLISH</h3>
                    </li>

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
                var priceFullList = (<div class="hover-list">
                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th>Language: </th>
                      <td>English</td>
                    </tr>
                    <tr>
                      <th>BAFA 2018: </th>
                      <td>{this.state.optionData[0].profile_bafa}</td>
                    </tr>
                    <tr>
                      <th>Re-cooling type: </th>
                      <td>{this.state.optionData[0].profile_recooling}</td>
                    </tr>
                    <tr>
                      <th>Free cooling: </th>
                      <td>{this.state.optionData[0].free_recooling}
                        (chilled water temperature)
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

                var pricelist = (

                    <ul className="price-listt plnewblock">
                        <li className="pdtnam">
                            <p>{this.props.t('Economic.Tab.General.ElectricityPrice.Title')}</p>
                            <h3>{this.state.economicData[0].electric_price}<br />
                                €/kWh</h3>
                        </li>
                        <li className="pdtnum">
                            <p>{this.props.t('Economic.Tab.CHP.OwnUsageOfElectricity.Title')}</p>
                            <h3>{this.state.economicData[0].own_usage_of_electricity}%</h3>
                        </li>
                        <div className="clrs"></div>
                        <li className="pdtnam">
                            <p>{this.props.t('Economic.Tab.CHP.GasPrice.Title')}</p>
                            <h3>{this.state.economicData[0].gas_price}<br />
                                €/kWh</h3>
                        </li>
                        <li className="pdtnum">
                            <p>{this.props.t('Economic.Tab.CHP.KWKEubsidyForElectricity.Title')}</p>
                            <h3>{this.state.economicData[0].subsidy_for_electricity}</h3>
                        </li>
                    </ul>

                );
                var priceFullList = (<div className="hover-list">
                    <div className="table-responsive">

                        <table className="table">
                            <tbody>
                                <tr>
                                    <th>{this.props.t('Economic.Tab.General.ElectricityPrice.Title')}:</th>
                                    <td>{this.state.economicData[0].electric_price} €/kWh</td>
                                </tr>
                                <tr>
                                    <th>{this.props.t('Economic.Tab.CHP.GasPrice.Title')}:</th>
                                    <td>{this.state.economicData[0].gas_price} €/kWh</td>
                                </tr>
                                <tr>
                                    <th>{this.props.t('Economic.Tab.CHP.OwnUsageOfElectricity.Title')}: </th>
                                    <td>{this.state.economicData[0].own_usage_of_electricity}%</td>
                                </tr>
                                <tr>
                                    <th>{this.props.t('Economic.Tab.CHP.KWKEubsidyForElectricity.Title')}</th>
                                    <td>{this.state.economicData[0].subsidy_for_electricity}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>);
                var requiredMsg = "";
            }
        }
        if (this.props.title == FAHRENHEIT_SYSTEM) {

            if (this.state.fahrenheitDataChange) {

                var pricelist = (

                    <ul className="price-listt">
                        <li>
                            <p>Recommended System</p>
                            <h3>eCoo 20</h3>
                        </li>
                        <li>
                            <p>Cooling demand coverage</p>
                            <h3>83%</h3>
                        </li>
                        <li>
                            <p>Adsorption electricity costs</p>
                            <h3>8,252 €/a</h3>
                        </li>
                        <li className="paybkprd">
                            <p>Payback period</p>
                            <h3>2.8 a</h3>
                        </li>

                        <li>
                            <p>Payback after 10 a</p>
                            <h3>16,536 €</h3>
                        </li>
                        <li style={hideEle}>
                            <p>Payback period</p>
                            <h3>2.8 a</h3>
                        </li>
                        <li style={hideEle}>
                            <p>Payback period</p>
                            <h3>2.8 a</h3>
                        </li>
                        <li style={hideEle}>
                            <p>Payback period</p>
                            <h3>2.8 a</h3>
                        </li>

                    </ul>

                );
                var priceFullList = (<div className="hover-list">
                    <div className="recommendedsystem">
                        <h3>Recommended system</h3>
                        <table className="table">
                            <tr>
                                <td className="radio-input-select"><label className="radio-container">
                                    <input type="radio" checked="checked" name="radio" />
                                    <span className="checkmark"></span>
                                </label>
                                </td>
                                <td>eCoo 20</td>
                                <td>2.80 a</td>
                                <td>16,536 €</td>
                                <td className="edit-optionss"><span className="copy-option new-system"><img src="public/images/option1.png"
                                    alt="" /></span>
                                    <span className="open-pdf-option"><img src="public/images/eye-option.png" alt="" /></span>
                                    <span className="open-calculator-option dropdown-calci"><img src="public/images/option3.png" alt="" /></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div className="other-suggested-system">
                        <h3>Other suggested systems</h3>
                        <table className="table">
                            <tr>
                                <td className="radio-input-select"><label className="radio-container">
                                    <input type="radio" checked="" name="radio" />
                                    <span className="checkmark"></span>
                                </label>
                                </td>
                                <td>eCoo 10 ST* </td>
                                <td>2.40 a</td>
                                <td>10,153 €</td>
                                <td className="edit-optionss"><span className="copy-option"><img src="public/images/option1.png" alt="" /></span>
                                    <span className="open-pdf-option"><img src="public/images/eye-option.png" alt="" /></span>
                                    <span className="open-calculator-option dropdown-calci"><img src="public/images/option3.png" alt="" /></span>
                                </td>
                            </tr>
                            <tr>
                                <td className="radio-input-select"><label className="radio-container">
                                    <input type="radio" checked="" name="radio" />
                                    <span className="checkmark"></span>
                                </label>
                                </td>
                                <td>eCoo 10X*</td>
                                <td>2.30 a</td>
                                <td>11,335 €</td>
                                <td className="edit-optionss"><span className="copy-option"><img src="public/images/option1.png" alt="" /></span>
                                    <span className="open-pdf-option"><img src="public/images/eye-option.png" alt="" /></span>
                                    <span className="open-calculator-option dropdown-calci"><img src="public/images/option3.png" alt="" /></span>
                                </td>
                            </tr>
                            <tr>
                                <td className="radio-input-select"><label className="radio-container">
                                    <input type="radio" checked="" name="radio" />
                                    <span className="checkmark"></span>
                                </label>
                                </td>
                                <td>eCoo 20*</td>
                                <td>2.23 a</td>
                                <td>12,583 €</td>
                                <td className="edit-optionss"><span className="copy-option"><img src="public/images/option1.png" alt="" /></span>
                                    <span className="open-pdf-option"><img src="public/images/eye-option.png" alt="" /></span>
                                    <span className="open-calculator-option dropdown-calci"><img src="public/images/option3.png" alt="" /></span>
                                </td>
                            </tr>
                            <tr>
                                <td className="radio-input-select"><label className="radio-container">
                                    <input type="radio" checked="" name="radio" />
                                    <span className="checkmark"></span>
                                </label>
                                </td>
                                <td>eCoo 20 ST*</td>
                                <td>2.76 a</td>
                                <td>15,985 €</td>
                                <td className="edit-optionss"><span className="copy-option"><img src="public/images/option1.png" alt="" /></span>
                                    <span className="open-pdf-option"><img src="public/images/eye-option.png" alt="" /></span>
                                    <span className="open-calculator-option dropdown-calci"><img src="public/images/option3.png" alt="" /></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div className="manual-sysytemm">
                        <h3>Manual System</h3>
                        <table className="table">
                            <tr>
                                <td className="radio-input-select"><label className="radio-container">
                                    <input type="radio" checked="" name="radio" />
                                    <span className="checkmark"></span>
                                </label>
                                </td>
                                <td>eCoo 10 ST* </td>
                                <td>2.40 a</td>
                                <td>10,153 €</td>
                                <td className="edit-optionss"><span className="copy-option"><img src="public/images/option1.png" alt="" /></span>
                                    <span className="open-pdf-option"><img src="public/images/eye-option.png" alt="" /></span>
                                    <span className="open-calculator-option dropdown-calci"><img src="public/images/option3.png" alt="" /></span>
                                </td>
                            </tr>
                            <tr className="clone-system">
                                <td className="radio-input-select"><label className="radio-container">
                                    <input type="radio" checked="" name="radio" />
                                    <span className="checkmark"></span>
                                </label>
                                </td>
                                <td>eCoo 10 ST* </td>
                                <td>2.40 a</td>
                                <td>10,153 €</td>
                                <td className="edit-optionss"><span className="copy-option"><img src="public/images/option1.png" alt="" /></span>
                                    <span className="open-pdf-option"><img src="public/images/eye-option.png" alt="" /></span>
                                    <span className="open-calculator-option dropdown-calci"><img src="public/images/option3.png" alt="" /></span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <h6 className="note-textt">* Values are estimated. For a detailed calculation, click on the calculator.</h6>
                    <div className="caculator-divv">
                        <div className="calci-div"></div>
                    </div>

                </div>);
                var requiredMsg = "";
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
