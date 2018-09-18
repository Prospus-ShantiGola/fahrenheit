import React from 'react';

import {DeleteModal} from './DeleteModal';

export class Tiles extends React.Component {

    constructor(props) {

        super(props);
        this.state = {
            compressionChillerData:[],
            compressionDataChange:false,
            generalData:[],
            generalDataChange:false
               };
        this.editRecord=this.editRecord.bind(this);
        this.deleteRecord=this.deleteRecord.bind(this);
        this.updateCompressionList=this.updateCompressionList.bind(this);
        this.handleChillerDeleteEntry=this.handleChillerDeleteEntry.bind(this);
    }
    componentWillReceiveProps(nextProps){
       // console.log("componentWillReceiveProps",nextProps);
        switch (nextProps.title) {
            case "Compression Chiller":
            this.setState({
                compressionDataChange: nextProps.dataChange
              });
                break;
            case GENERAL_TILE:
                this.setState({
                    generalDataChange:nextProps.dataChange
                  });



            default:
                break;
        }

        if(typeof nextProps.dataRecord!="undefined"){
        if(nextProps.dataRecord.chillerformMode=="add"){
        this.setState({
            compressionChillerData: this.state.compressionChillerData.concat(nextProps.dataRecord)
          })
        }else{

              this.state.compressionChillerData[nextProps.dataRecord.chillerformModeKey]= nextProps.dataRecord
              this.forceUpdate()
        }
        if(nextProps.dataRecord.generalformMode=="add"){
            this.setState({
                generalData: this.state.generalData.concat(nextProps.dataRecord)
              })
            }else{

                  this.state.generalData[0]= nextProps.dataRecord
                  this.forceUpdate()
            }



        }


    }
    componentDidUpdate(){
        var that=this;
        if(typeof $('.compressionTableBody')[0] !="undefined"){
            if(that.props.title==CHILLER_TITLE){
            Sortable.create(
                $('.compressionTableBody')[0],
                {
                animation: 150,
                scroll: true,
                handle: '.drag-handler',
                onEnd:function (/**Event*/evt) {
                    evt.oldIndex;  // element's old index within old parent
                    evt.newIndex;  // element's new index within new parent=
                    var clonedArr=that.state.compressionChillerData;
                    var tempKey=clonedArr[evt.oldIndex];
                    clonedArr[evt.oldIndex]=clonedArr[evt.newIndex];
                    clonedArr[evt.newIndex]=tempKey;
                    that.updateCompressionList(clonedArr);
                }
                }
                );
            }


        }
    }
    componentWillUnmount(){
        console.log("component unmount")
    }
    componentDidMount(){
        var that=this;


        if(this.state.compressionChillerData.length==0)
        {
          this.setState({
              compressionDataChange: false
            });
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


    }
    updateCompressionList(clonedArr){
       console.log("sorting finish",clonedArr);
       $('.compressionTableBody').unbind();
    //    this.setState({
    //     compressionChillerData: clonedArr
    //   });

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
    deleteRecord(eleM){
        $("#delete-modal").find("#entry-id").attr('data-id',eleM);
        $("#delete-modal").modal("show");
    }
    handleChillerDeleteEntry(result){
        //console.log(this.state.compressionChillerData);
       this.setState({
            compressionChillerData: this.state.compressionChillerData.filter((_, i) => i !== parseInt(result.elementId))
          });
    }

    render() {

        var priceFullList,pricelist,requiredMsg="";
        if(this.props.required=="yes"){
            var requiredMsg=<h5 className="input-required">An input is required</h5>;
        }
        if(this.props.multiple){
            var deleteModal=<DeleteModal onDeleteChillerSubmit={this.handleChillerDeleteEntry} id="delete-modal"/>
        }
        else{
            var deleteModal=""
        }
        if(this.state.compressionDataChange==true && this.state.compressionChillerData.length!=0){
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
                                       <h3><img src="public/images/degree-icon.png" alt="" /> {this.state.compressionChillerData[0].temperature}°C</h3>
                                    </li>
                </ul>
            );
            var priceFullList=(
                <div className="hover-list scrollbar-macosx">
                                       <div className="table-responsive">
                                          <table className="table">
                                           <tbody className="compressionTableBody">
                                           {this.state.compressionChillerData.map((data,i) => (
         <tr key={i}>
         <th>
         {data.chillername}
            <ul className="list-inline">
               <li>120.30 kW
               </li>
               <li>	{data.temperature}°C </li>
            </ul>
         </th>
         <td><span className="edit-option" data-id={i}  data-toggle="modal" data-backdrop="false" data-target={this.props.modalId} ><i className="fa fa-pencil-square-o" aria-hidden="true" onClick={()=>this.editRecord(i)}></i></span>
            <span className="delete-optionn" data-id={i} ><i className="fa fa-trash-o" aria-hidden="true" onClick={()=>this.deleteRecord(i)}></i></span>
            <span  className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span>
         </td>
      </tr>
        ))}


                                             </tbody>
                                          </table>
                                       </div>
            </div>
            );
        }
        else{
            var priceFullList= <p>{this.props.hoverText}</p>;
        }

        if(this.state.generalDataChange){
            var pricelist=(
                <ul class="price-listt">
                              <li>
                                 <p>Location</p>
                                 <h3>{this.state.generalData[0].location}</h3>
                              </li>
                           </ul>
            );
            var priceFullList=(<div class="hover-list">
                                 <div class="table-responsive">
                                    <table class="table">
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


        return (

                <div className={this.props.mainclass}>
                    <div className={this.props.tileCls}>
                        <h1>{this.props.title}</h1>
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
    multiple:false

  };
