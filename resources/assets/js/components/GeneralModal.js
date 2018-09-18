import React from 'react';

export class GeneralModal extends React.Component {

  constructor(props){
        super(props);
        this.state = {generalInformation: '',role:'user'};
        this.handleSubmit = this.handleSubmit.bind(this);
        this.changeState = this.changeState.bind(this);
      }


       componentDidMount(){
        jQuery(".help-toggle").unbind('click');
        jQuery(".help-toggle").click(function(){
            jQuery(".input-help-label").toggle();
        });
        jQuery('body').on('click', function (e) {
            jQuery('[data-toggle="popover"]').each(function () {
                //the 'is' for buttons that trigger popups
                //the 'has' for icons within a button that triggers a popup
                if (!jQuery(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    jQuery(this).popover('hide');
                }
            });
        });
        $('.close-modal-general').on('click',function (e) {

          const obj = this;
   

               if ($('.general-information-form').hasClass('form-edited')) {
                  // alert('eeee')
                 e.preventDefault();
    
                $('#general-modal-confirm').modal('show');
             
       
                }
                else
                {
                 $('#general-information').modal('hide');
                 $('.general-information-form')[0].reset()
                }

              

          })
               //Do stuff here
          }


   


handleSubmit(event) {
    event.preventDefault();
    const that = this;

       var location    = $(".general-information-form").find("input[name=location]").val();
       var address    = $(".general-information-form").find("input[name=address]").val();


        fetch('/adcalc/storeGeneralInformation', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                     location: location,
                     address: address

                })
        })
         .then((a) => {return a.json();})
        .then(function (data) {
                            $(".general-information-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $(".general-information-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $(".general-information-form");
                                var data = that.getFormData($form);
                                console.log(data);
                                that.setState({
                                    generalInformation:data
                                })
                                that.changeState(that.state.generalInformation);
                                $("#general-information").modal("hide");

                            }
        })
        .catch((err) => {console.log(err)})



  }
  changeState(generalInformation){
    var result={
        generalInformation:generalInformation,
        state:true
    }
    this.props.onGeneralSubmit(result);
  }

  getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }


    render() {

        return (
            <div className="modal " role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="general-information">
            <form  onSubmit={this.handleSubmit} className = "general-information-form">
           <div className="modal-content">
            <div className="modal-heading">
               <div className="left-head"> General Information</div>
               <div className="right-head">
                  <ul className="list-inline">

                     <li className="help-toggle"><img src="public/images/help-icon.png" alt="no-image" /></li>
                     <li> <input type="image" src="public/images/verifie-icon.png" alt="Submit"/></li>
                      <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-general"  aria-label="Close"/></span></li>

                  </ul>
               </div>
            </div>
            <div className="modal-body-content">
               <ul id="tabsJustified" className="nav nav-tabs">
                  <li className="nav-item"><a href="" data-target="#project-data" data-toggle="tab" className="nav-link small active">PROJECT DATA</a></li>
                  <li className="nav-item"><a href="" data-target="#personal-data" data-toggle="tab" className="nav-link">PERSONAL DATA</a></li>
               </ul>
               <div id="tabsJustifiedContent" className="tab-content">
                  <div id="project-data" className="tab-pane fade  active show">
                     <div className="project-data-div">
                        <div className="table-responsive">
                           <table className="table">
                                   <tbody>
                              <tr>
                                 <td className="input-label"> Project number:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="New Project" name = "project_number" id = "project_number" /> </td>
                              </tr>
                              <tr>
                                 <td className="input-label"> Project name: </td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="Test Project" name = "project_name" id = "project_name" />
                                 <input type="hidden" placeholder="Chiller 1" id="generalformMode"   name="generalformMode" value="add" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label"> Location:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Location explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="Halle/Saale" className="required-field" name = "location" id = "location" /> <i className="fa fa-map-marker" aria-hidden="true"></i>

                                 <span className="invalid-feedback" role="alert">
                                             <strong>Required field</strong>
                                       </span>
                                       </td>
                              </tr>
                              <tr>
                                 <td className="input-label">Customer:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name = "customer" id = "customer" placeholder="HabWarmWillKalt Gmbh "/></td>
                              </tr>
                              <tr>
                                 <td className="input-label">Contact:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Contact explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name = "contact" id = "contact" placeholder="Mr. Inhaber" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">Tel. Number:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Tel. number explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name = "phone_number" id = "phone_number" placeholder="0123 456" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">Email:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Email explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text"  name = "email_address" id = "email_address" placeholder="inhaber@gmbh.de" /></td>
                              </tr>
                                      </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div id="personal-data" className="tab-pane fade">
                     <div className="personal-data-div">
                        <div className="table-responsive">
                           <table className="table">
                                   <tbody>
                              <tr>
                                 <td className="input-label">Editor:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name ="editor" id ="editor" placeholder="HabWarmWillKalt Gmbh" /> </td>
                              </tr>
                              <tr>
                                 <td className="input-label">Company:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name = "company" id = "company" placeholder="Gmbh" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label"> Address:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text"  name = "address" id = "address" placeholder="Halle/Saale" className="required-field" /> <i className="fa fa-map-marker" aria-hidden="true"></i>
                                 <span className="invalid-feedback" role="alert">
                                             <strong>Required field</strong>
                                       </span>

                                 </td>
                              </tr>
                              <tr>
                                 <td className="input-label">Tel. Number:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Tel. number explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name = "personal_phone_number" id = "personal_phone_number" placeholder="0123 456" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">Mobile:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Mobile explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" name = "mobile_number" id = "mobile_number" placeholder="Mr. Inhaber" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">Email:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Email explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text"  name = "personal_email_address" id = "personal_email_address" placeholder="inhaber@gmbh.de" /></td>
                              </tr>
                                      </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
            </form>
         </div>

        );
    }
}


