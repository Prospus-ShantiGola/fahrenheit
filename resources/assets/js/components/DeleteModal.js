import React, { Component } from 'react';

export class DeleteModal extends Component {
    constructor(props){
        super(props);
        this.state = {role:'user'};
        this.acceptChange=this.acceptChange.bind(this);
      }
    acceptChange (eleM) {

        var modalFor= eleM.target.getAttribute('data-modalfor');
        var result={
            state:true,
            elementId:eleM.target.getAttribute('data-id'),
            modalFor:modalFor
        }
        this.props.onDeleteChillerSubmit(result);
        jQuery("#delete-modal").modal("hide");
     }
    render() {
        return (
            <div className="modal fade" tabIndex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id={this.props.id}>
            <div className="modal-dialog modal-dialog-centered">
              <div className="modal-content">
                <div className="modal-header">
                        <h4 className="modal-title" id="myModalLabel"><img src="public/images/fahrenheit_logo.png" alt="" /></h4>
                  <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div className="modal-body">
                        {this.props.bodyContent}
                </div>
                <div className="modal-footer">

                  <button type="submit" className="btn btn-default" title="Delete" data-id="" data-modalfor={this.props.modalfor} id="entry-id" onClick={(elem)=>this.acceptChange(elem)}>Yes</button>
                  <button type="button" className="btn btn-primary" id="modal-btn-no"  data-dismiss="modal">No</button>
                </div>
              </div>
            </div>
          </div>
        );
    }
}



