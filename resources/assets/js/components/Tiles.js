import React from 'react';

import {DeleteModal} from './DeleteModal';
import {ErrorBoundary} from './ErrorBoundary';
import {DataList} from './data-list';

export class Tiles extends React.Component {

    constructor(props) {
        let sort;
        super(props);
        this.state = {
            compressionChillerData:[],
            compressionDataChange:false,
            generalData:[],
            generalDataChange:false,
            economicData:[],
            economicDataChange:false,
            heatSourceData:[],
            heatSourceDataChange:false,
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
                    generalDataChange:nextProps.dataChange
                  });
                  if(nextProps.dataRecord.generalformMode=="add"){
                    this.setState({
                        generalData: this.state.generalData.concat(nextProps.dataRecord)
                      })
                    }else{

                          this.state.generalData[0]= nextProps.dataRecord
                          this.forceUpdate()
                    }
                    break;
            case ECONOMIC_TITLE:
            this.setState({
                economicDataChange:nextProps.dataChange
            });
            if(nextProps.dataRecord.economicformMode=="add"){
                this.setState({
                    economicData: this.state.generalData.concat(nextProps.dataRecord)
                    })
                }else{

                        this.state.economicData[0]= nextProps.dataRecord
                        this.forceUpdate()
                }
                break;
            case HEAT_SOURCE_TITLE:
                this.setState({
                    heatSourceData:nextProps.dataRecord,
                    heatSourceDataChange:nextProps.dataChange
                });
                break
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
    editHeatRecord(elemKey){
        let dataObj=this.state.heatSourceData[elemKey];
        for (var key in dataObj) {
            if (dataObj.hasOwnProperty(key)) {
                //console.log($(this.props.modalId).find(key),this.props.modalId,key);
                $(this.props.modalId).find('#'+key).val(dataObj[key]);
            }
        }
        $(this.props.modalId).find('#heatsourceformMode').val("edit");
        $(this.props.modalId).find('#heatsourceformModeKey').val(elemKey);
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
    };

    render() {
        //console.log("render refresh",this.state.heatSourceData);
        projectData['generalData'] = this.state.generalData;
        projectData['economicData'] = this.state.economicData;
        const dragSet=false;
        var priceFullList,pricelist,requiredMsg="";
        if(this.props.required=="yes"){
            var requiredMsg=<h5 className="input-required">An input is required</h5>;
        }

        var deleteModal="";
        if(this.state.compressionDataChange==true && this.state.compressionChillerData.length!=0){
            var bodyContent="Are you sure you want to delete the chiller entry? Please confirm by clicking Yes.";
            var deleteModal= <DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} bodyContent={bodyContent} modalfor="compressionChiller" id="delete-modal"/>;
            var pricelist=(
                <ul className="price-listt">
                                    <li>
                                       <p>Cooling Capacity</p>
                                       <h3>100.0 kW</h3>
                                    </li>
                                    <li>
                                       <p>Number of Compressors</p>
                                       <h3>3</h3>
                                    </li>
                                    <li>
                                       <p>Temperature</p>
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
                                                <DataList chillerData={chillerData}/>
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
                                       <p>Heat Capacity</p>
                                       <h3>{heatSourceData[0].heat_capacity} kW</h3>
                                    </li>
                                    <li>
                                       <p>Available Heat</p>
                                       <h3>1,767,768 kWh/a</h3>
                                    </li>
                                    <li>
                                       <p>Temperature</p>
                                       <h3><img src="images/degree-icon.png" alt="" /> 84°C</h3>
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
                                                      <li>	85°C </li>
                                                   </ul>
                                                </th>
                                                <td><span className="edit-option" data-id={h}  data-toggle="modal" data-backdrop="false" data-target={this.props.modalId} ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={()=>this.editHeatRecord(h)}></i></span>
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
            var priceFullList= <p className="scrollbar-macosx">{this.props.hoverText}</p>;
        }
    }

        if(this.state.generalDataChange){
            var pricelist=(
                <ul className="price-listt">
                 <li>
                                 <p>Project Name</p>
                                 <h3 className="textUpper">{this.state.generalData[0].project_name}</h3>
                              </li>
                              <li>
                                 <p>Editor</p>
                                 <h3 className="textUpper">{this.state.generalData[0].editor}</h3>
                              </li>
                              <li>
                                 <p>Location</p>
                                 <h3 className="textUpper">{this.state.generalData[0].location}</h3>
                              </li>
                           </ul>

            );
            var priceFullList=(<div className="hover-list">
                                 <div className="table-responsive">

                                    <table className="table">
                                    <tbody>
                                       <tr>
                                          <th>Project name:</th>
                                          <td>{this.state.generalData[0].project_name}</td>
                                       </tr>
                                       <tr>
                                          <th>Project number:</th>
                                          <td>{this.state.generalData[0].project_number}</td>
                                       </tr>
                                       <tr>
                                          <th>Editor: </th>
                                          <td>{this.state.generalData[0].editor}</td>
                                       </tr>
                                       <tr>
                                          <th>Location:</th>
                                          <td>{this.state.generalData[0].location}</td>
                                       </tr>
                                       <tr>
                                          <th>Contact person: </th>
                                          <td>{this.state.generalData[0].customer}</td>
                                       </tr>
                                       <tr>
                                          <th>Tel. Number:</th>
                                          <td>{this.state.generalData[0].phone_number}</td>
                                       </tr>
                                       <tr>
                                          <th>Email:</th>
                                          <td>{this.state.generalData[0].email_address}</td>
                                       </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>);
        var requiredMsg="";
        }
        if(this.props.priceList=="yes"){
            var pricelist=(
                <ul className="price-listt">
                                    <li>
                                       <p>Cooling Capacity</p>
                                       <h3>100.0 kW</h3>
                                    </li>
                                    <li>
                                       <p>Number of Compressors</p>
                                       <h3>3</h3>
                                    </li>
                                    <li>
                                       <p>Temperature</p>
                                       <h3><img src="public/images/degree-icon.png" alt="" /> 6°C</h3>
                                    </li>
                </ul>
            );
            var priceFullList=(
                <ul className="price-listt">
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
            );

        }

        if(this.props.title==ECONOMIC_TITLE){

            var pricelist=(

                <ul className="price-listt">
                              <li>
                                 <p>Electricity Price</p>
                                 <h3>0.1800 €/kWh</h3>
                              </li>
                           </ul>

                        );
            var priceFullList=(<ul className="price-listt">
            <li>
               <p>Electricity Price</p>
               <h3>0.1800 €/kWh</h3>
            </li>
            <li>
               <p>Gas Price</p>
               <h3>0.035 €/kWh</h3>
            </li>
         </ul>);
            if(this.state.economicDataChange){

                var pricelist=(

                               <ul className="price-listt plnewblock">
                               <li className="pdtnam">
                                  <p>Electricity Price</p>
                                  <h3>{this.state.economicData[0].electric_price}<br/>
                                  €/kWh</h3>
                               </li>
                               <li className="pdtnum">
                               <p>own usage of Electricity</p>
                                  <h3>{this.state.economicData[0].own_usage_of_electricity}%</h3>
                               </li>
                               <div className="clrs"></div>
                                <li className="pdtnam">
                                  <p>Gas Price</p>
                                  <h3>{this.state.economicData[0].gas_price}<br/>
                                  €/kWh</h3>
                               </li>
                                <li className="pdtnum">
                               <p>KWK-Subsidy for <br/>electricity</p>
                                  <h3>{this.state.economicData[0].subsidy_for_electricity}</h3>
                               </li>
                            </ul>

                );
                var priceFullList=(<div className="hover-list">
                                     <div className="table-responsive">

                                        <table className="table">
                                        <tbody>
                                        <tr>
                                          <th>Electricity price:</th>
                                          <td>{this.state.economicData[0].electric_price} €/kWh</td>
                                       </tr>
                                       <tr>
                                          <th>Gas price:</th>
                                          <td>{this.state.economicData[0].gas_price} €/kWh</td>
                                       </tr>
                                       <tr>
                                          <th>Own usage of electricity: </th>
                                          <td>{this.state.economicData[0].own_usage_of_electricity}%</td>
                                       </tr>
                                       <tr>
                                          <th>KWK-subsidy for electricity </th>
                                          <td>{this.state.economicData[0].subsidy_for_electricity}</td>
                                       </tr>
                                           </tbody>
                                        </table>
                                     </div>
                                  </div>);
            var requiredMsg="";
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
                            <h1>{this.props.title}</h1>
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

Tiles.defaultProps = {
    title:'General Information',
    tileCls:'general-information data-box',
    required:"no",
    edit:'yes',
    editCls:'edit-icon myBtn_multi',
    editIcon:'images/edit-icon.png',
    add:'no',
    hoverText:'We need the location to get the specific weather data.',
    mainClass:'col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4',
    hoverCls:'main-hover-box general-info-hover',
    priceLst:'no',
    priceData:{

    },
    rightpriceList:'no',
    rightpriceListeData:{

    },
    multiple:false,
    dataRecord:[]

  };
