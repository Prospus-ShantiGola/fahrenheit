import React from 'react';

export class ChillerModal extends React.Component {


    constructor(props){
        super(props);
        this.state = {compressionChiler: ''};
        this.handleSubmit = this.handleSubmit.bind(this);
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
        // $(document).on('hide.bs.modal','#compression-chiller', function () {
        //         $("#compression-chiller-form")[0].reset()
        //             //Do stuff here
        //         });


         $('.close-modal-compression').on('click',function (e) {

          const obj = this;
         // alert('chiller')

               if ($('#compression-chiller-form').hasClass('form-edited')) {
                   //alert('ccccccc')
                 e.preventDefault();

                $('#compression-modal-confirm').modal('show');


                }
                else
                {
                  $("#compression-chiller").modal("hide");
                 $("#compression-chiller-form")[0].reset()
                }



          })



      }
      handleLangChange (compressionChiler) {
        var result={
            compressionChiller:compressionChiler,
            state:true
        }
        this.props.onChillerSubmit(result);
     }
      handleSubmit(e){
        const that = this;
        e.preventDefault();
        var refrigerant    = $("#compression-chiller-form").find("select[name=refrigerant]").val();
        var manufacturer    = $("#compression-chiller-form").find("select[name=manufacturer]").val();
        var compressor = $("#compression-chiller-form").find("select[name=compressor]").val();

        fetch('adcalc/storeCompressionChiller', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    refrigerant: refrigerant,
                    manufacturer: manufacturer,
                    compressor: compressor,
                })
        })
        .then((a) => {return a.json();})
        .then(function (data) {
                            $("#compression-chiller-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $("#compression-chiller-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $("#compression-chiller-form");
                                var data = that.getFormData($form);
                                that.setState({
                                    compressionChiler:data
                                })
                                that.handleLangChange(that.state.compressionChiler);
                                $("#compression-chiller").modal("hide");

                            }
        })
        .catch((err) => {console.log(err)})
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
        if(this.props.role=="expert"){
            var expertRoleHtml=<li className="nav-item"><a href="" data-target="#compression-calculation-data" data-toggle="tab" className="nav-link">CALCULATION DATA</a></li>;
        }

        return (
            <div className="modal " role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="compression-chiller">

            <form  onSubmit={this.handleSubmit} id="compression-chiller-form">

            <div className="modal-content">
               <div className="modal-heading">
                  <div className="left-head">Compression Chillers</div>
                  <div className="right-head">
                     <ul className="list-inline">
                        <li >

                        <input className="save-changes-btn" type="submit" alt="Submit" value="Save Changes" /></li>
                        <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close close-modal-compression "  aria-label="Close"/></span></li>

                     </ul>
                  </div>
               </div>
               <div className="modal-body-content">
                  <ul id="tabsJustified2" className="nav nav-tabs">
                     <li className="nav-item"><a href="" data-target="#compression-technical-data" data-toggle="tab" className="nav-link small active">TECHNICAL DATA</a></li>
                     {expertRoleHtml}
                  </ul>
                  <div id="tabsJustifiedContent2" className="tab-content">
                     <div id="compression-technical-data" className="tab-pane fade  active show">
                        <div className="heating-load-general-div">
                           <div className="table-responsive">
                              <table className="table">
                              <tbody>
                                 <tr>
                                    <td className="input-label"> Name:  </td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip" data-trigger="hover">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields"><input type="text" placeholder="Chiller 1" id="chillername"   name="chillername"  />
                                    <input type="hidden" placeholder="Chiller 1" id="chillerformMode"   name="chillerformMode" value="add" />
                                    <input type="hidden" placeholder="Chiller 1" id="chillerformModeKey"   name="chillerformModeKey" value="" />
                                    </td>
                                 </tr>
                                 <tr>
                                    <td className="input-label">Refrigerant:</td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-trigger="hover">
                                       <img src="public/images/help-red.png" alt=""  />
                                       </button>
                                    </td>
                                    <td className="input-fields">
                                       <select required="required" id="refrigerant" name="refrigerant" className="required-field">
                                         <option value="">Select Refrigerant</option>
                                          <option value="R134a">R134a</option>
                                          <option value="option1">option1</option>
                                          <option value="option2">option2</option>
                                       </select>
                                       <span className="invalid-feedback" role="alert">
                                             <strong>Required field</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td className="input-label">Manufacturer:</td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-trigger="hover">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields">
                                       <select required="required"  id="manufacturer" name="manufacturer" className="required-field">
                                          <option value="">Select Manufacturer</option>
                                          <option value="unknown">unknown</option>
                                          <option value="option1">option1</option>
                                          <option value="option2">option2</option>
                                       </select>
                                       <span className="invalid-feedback" role="alert">
                                             <strong>Required field</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td className="input-label">Compressor type:</td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-trigger="hover">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields">
                                       <select required="required"  id="compressor" name="compressor" className="required-field">
                                          <option value="">Select Compressor type</option>
                                          <option value="unknown">unknown</option>
                                          <option value="option1">option1</option>
                                          <option value="option2">option2</option>
                                       </select>
                                       <span className="invalid-feedback" role="alert">
                                             <strong>Required field</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td className="input-label">Chilled water
                                       temperature:
                                    </td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip" data-trigger="hover">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields"><input type="text"  id="temperature" placeholder="6 °C" name="temperature"/></td>
                                 </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>

                     <div id="compression-calculation-data" className="tab-pane fade expert">
                        <div className="personal-data-div">
                           <div className="table-responsive">
                              <table className="table">
                              <tbody>
                                 <tr>
                                    <td className="input-label">Investment costs: </td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip" data-trigger="hover">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields"><input type="text" placeholder="€" name="investment_cost" id="investment_cost"/> </td>
                                 </tr>
                                 <tr>
                                    <td className="input-label">Discount:</td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip" data-trigger="hover">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields"><input type="text" placeholder="%"  name="discount" id="discount" /></td>
                                 </tr>
                                 <tr>
                                    <td className="input-label"> Maintenance costs: </td>
                                    <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip" data-trigger="hover">
                                       <img src="public/images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td className="input-fields"><input type="text" placeholder="€/a"  name="maintenence_costs" id="maintenence_costs" /> </td>
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

