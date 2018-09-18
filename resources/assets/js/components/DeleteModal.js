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
            <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id={this.props.id}>
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><img src="public/images/fahrenheit_logo.png" alt="" /></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">
                        Are you sure you want to delete the chiller entry? Please confirm by clicking Yes.
                </div>
                <div class="modal-footer">

                  <button type="submit" class="btn btn-default" title="Delete" data-id="" id="entry-id" onClick={()=>this.acceptChange(this)}>Yes</button>
                  <button type="button" class="btn btn-primary" id="modal-btn-no"  data-dismiss="modal">No</button>
                </div>
              </div>
            </div>
          </div>
        );
    }
}



