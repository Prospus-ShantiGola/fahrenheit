import React, { Component } from 'react';


export class DataList extends Component{


    render(){
        return(this.props.chillerData.map((data,i) => (

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
         </tr>
           )))
    }

}

