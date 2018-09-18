import React, { Component } from 'react';

export class DeleteModal extends Component {
    constructor(props){
        super(props);
        this.state = {role:'user'};
        this.acceptChange=this.acceptChange.bind(this);
      }
    acceptChange (eleM) {
        var result={
            state:true,
            elementId:$("#delete-modal").find("#entry-id").attr('data-id')
        }
        console.log(eleM);
        this.props.onDeleteChillerSubmit(result);
        jQuery("#delete-modal").modal("hide");
     }
    render() {
        console.log(this.props)
        return (
            <div className="modal fade" tabIndex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id={this.props.id}>
            <div className="modal-dialog modal-dialog-centered">
              <div className="modal-content">
                <div className="modal-header">
                        <h4 className="modal-title" id="myModalLabel"><img src="public/images/fahrenheit_logo.png" alt="" /></h4>
                  <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div className="modal-body">
                        Are you sure you want to delete the chiller entry? Please confirm by clicking Yes.
                </div>
                <div className="modal-footer">

                  <button type="submit" className="btn btn-default" title="Delete" data-id="" id="entry-id" onClick={()=>this.acceptChange(this)}>Yes</button>
                  <button type="button" className="btn btn-primary" id="modal-btn-no"  data-dismiss="modal">No</button>
                </div>
              </div>
            </div>
          </div>
        );
    }
}



