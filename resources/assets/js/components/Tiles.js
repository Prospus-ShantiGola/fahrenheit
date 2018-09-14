import React from 'react';

export class Tiles extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            compressionChillerData:[],
            compressionDataChange:false,
            generalInfo:[]
               };
        this.editRecord=this.editRecord.bind(this);
        this.deleteRecord=this.deleteRecord.bind(this);
        this.updateCompressionList=this.updateCompressionList.bind(this);
    }
    componentWillReceiveProps(nextProps){
        //console.log("componentWillReceiveProps",nextProps);
        this.setState({
            compressionDataChange: nextProps.dataChange
          });
        if(typeof nextProps.dataRecord!="undefined"){
        if(nextProps.dataRecord.chillerformMode=="add"){
        this.setState({
            compressionChillerData: this.state.compressionChillerData.concat(nextProps.dataRecord)
          })
        }else{

              this.state.compressionChillerData[nextProps.dataRecord.chillerformModeKey]= nextProps.dataRecord
              this.forceUpdate()
        }
          jQuery(".scrollbar-macosx").scrollbar();
          if(typeof $('.compressionTableBody')[0] !="undefined"){
            var that=this;

          Sortable.create(
              $('.compressionTableBody')[0],
              {
              animation: 150,
              scroll: true,
              handle: '.drag-handler',
              onEnd:function (/**Event*/evt) {
                  evt.oldIndex;  // element's old index within old parent
                  evt.newIndex;  // element's new index within new parent=
                  console.log(evt.oldIndex,evt.newIndex);
                  var clonedArr=that.state.compressionChillerData;
                  var tempKey=clonedArr[evt.oldIndex];
                  clonedArr[evt.oldIndex]=clonedArr[evt.newIndex];
                  clonedArr[evt.newIndex]=tempKey;
                  console.log(clonedArr);
                  that.setState({
                      compressionChillerData: clonedArr
                    })

              }
              }
              );
        }

        }


    }
    componentDidMount(){

        if(this.state.compressionChillerData.length==0)
        {
          this.setState({
              compressionDataChange: false
            });
        }

    }
    updateCompressionList(){
        console.log("sorting finish");
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
        this.setState({
            compressionChillerData: this.state.compressionChillerData.filter((_, i) => i !== eleM)
          });


        //console.log("deleteRecord",eleM)
    }

    render() {
        console.log("tiles",this.state.compressionChillerData," State ",this.state.compressionDataChange,this.props.title,this.props.hoverText);

        var priceFullList,pricelist,requiredMsg="";
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
                                       <h3><img src="images/degree-icon.png" alt="" /> {this.state.compressionChillerData[0].temperature}°C</h3>
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
                                       <h3><img src="images/degree-icon.png" alt="" /> 6°C</h3>
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
        if(this.props.required=="yes"){
            var requiredMsg=<h5 className="input-required">An input is required</h5>;
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
                </div>

        );
    }
}

Tiles.defaultProps = {
    title:'General Information',
    tileCls:'general-information data-box',
    required:"yes",
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

    }
  };
