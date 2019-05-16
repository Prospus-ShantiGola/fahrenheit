import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Success extends Component {

    actionButton=(elem)=>{
       location.reload();

    }
    render() {
        return (
            <div className="modal" id="success-modal">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h4 className="modal-title" id="myModalLabel"><img src="public/images/fahrenheit_logo.png" alt="" /></h4>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div className="modal-body-content">
                            <p>Detais added successfully !!</p>
                        </div>
                        <div className="modal-footer">
                            <button type="submit" className="btn btn-default" title="Delete" data-id="" id="entry-id" onClick={(elem) => this.actionButton(elem)}>New project</button>
                            <button type="button" className="btn btn-primary" id="modal-btn-no" data-dismiss="modal" onClick={(elem) => this.actionButton(elem)}>Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}


