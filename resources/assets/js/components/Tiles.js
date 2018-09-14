import React from 'react';

export class Tiles extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            compressionChiller:[],
            generalInfo:[]
               };
    }

    render() {
        console.log("tiles",this.props.dataRecord);
        var priceFullList,pricelist,requiredMsg="";
        if(this.props.dataChange=="yes"){
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
                <div className="hover-list scrollbar-macosx">
                                       <div className="table-responsive">
                                          <table className="table">
                                           <tbody className="heatsourcesTableBody">
                                             <tr>
                                                <th>
                                                   Oven waste heat
                                                   <ul className="list-inline">
                                                      <li>120.30 kW
                                                      </li>
                                                      <li>	85°C </li>
                                                   </ul>
                                                </th>
                                                <td><span className="edit-option"><i className="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                                   <span className="delete-optionn"><i className="fa fa-trash-o" aria-hidden="true"></i></span>
                                                   <span  className="menu-bar-option drag-handler"><i className="fa fa-bars" aria-hidden="true"></i></span>
                                                </td>
                                             </tr>
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
