import React from 'react';
const CustomTable = {
    padding: "0px"
  }
export class EconomicModal extends React.Component {

  constructor(props){
        super(props);
        this.state = {economicInformation: '',role:this.props.role};
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
        $('.close-modal-economic').on('click',function (e) {

          const obj = this;


               if ($('.economic-information-form').hasClass('form-edited')) {
                  // alert('eeee')
                 e.preventDefault();

                $('#economic-modal-confirm').modal('show');


                }
                else
                {
                 $('#economic-information').modal('hide');
                 if($('.economic-information-form #economicformMode').val()=="add"){
                 $('.economic-information-form')[0].reset()
                 }
                }



          })
               //Do stuff here
          }





handleSubmit(event) {
    event.preventDefault();
    const that = this;

       var location    = $(".economic-information-form").find("input[name=location]").val();
       var address    = $(".economic-information-form").find("input[name=address]").val();


        fetch('adcalc/storeEconomicInformation', {
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
                            $(".economic-information-form").find('.invalid-feedback').hide();
                            jQuery.each(data.errors, function(key, value){
                                $(".economic-information-form").find('#'+value).siblings('.invalid-feedback').show();
                            });

                            if(typeof data.errors=="undefined"){
                                var $form = $(".economic-information-form");
                                var data = that.getFormData($form);
                                console.log(data);
                                that.setState({
                                    economicInformation:data
                                })
                                that.changeState(that.state.economicInformation);
                                $("#economic-information").modal("hide");
                                $('.economic-information-form').removeClass('form-edited');

                            }
        })
        .catch((err) => {console.log(err)})



  }
  changeState(economicInformation){
    var result={
        economicInformation:economicInformation,
        state:true
    }
    CHANGE_FORM=true;
    this.props.onEconomicSubmit(result);
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
        if(this.state.role=="expert"){
            var expertFields=(
                <tr><td className="nested-table" colSpan="3" style={CustomTable}>
                    <table className="table"><tr>
                                 <td className="input-label">Electricity price increase:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Location explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="2.000 %/a"  name="electric_price_increased" id="electric_price_increased"/></td>
                              </tr>
                              <tr>
                                 <td className="input-label">Calculated interest rate:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Calculated interest rate explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="0.700 %/a" name="calculated_interest_rate" id="calculated_interest_rate" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">Inflation rate:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Inflation rate explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="1.600 %/a" name="inflation_rate" id="inflation_rate"/></td>
                              </tr></table>
                </td>
                </tr>
            );
            var expertTabs=(<ul id="tabsJustified1" className="nav nav-tabs">
            <li className="nav-item"><a href="" data-target="#eco-general" data-toggle="tab" className="nav-link small active">GENERAL</a></li>
            <li className="nav-item"><a href="" data-target="#eco-chp" data-toggle="tab" className="nav-link">CHP</a></li>
            <li className="nav-item"><a href="" data-target="#eco-investment" data-toggle="tab" className="nav-link">INVESTMENTS</a></li>
            <li className="nav-item"><a href="" data-target="#eco-maintenance" data-toggle="tab" className="nav-link">MAINTENANCE</a></li>
         </ul>);

         var expertOption=( <div className="new-row-addition">
         <img src="public/images/plus-icon.png"  alt="" />
       </div>);


       var expertChp=(<tr><td className="nested-table" colSpan="5" style={CustomTable}><table className="table">
           <tbody>
           <tr>
        <td colSpan="3">
           <h3 className="inner-table-heading">FOR EXPERTS</h3>
        </td>
     </tr>
     <tr>
     <td className="input-label">Electricity sales price:</td>
     <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Electricity sales price explanation/tip">
        <img src="public/images/help-red.png" alt="" />
        </button>
     </td>
     <td className="input-fields"><input type="text" placeholder="0.03500 €/kWh" name="electricity_sales_price" id="electricity_sales_price"/></td>
     </tr>
     <tr>
        <td className="input-label">Energy tax refund:
        </td>
        <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Inflation rate explanation/tip">
           <img src="public/images/help-red.png" alt="" />
           </button>
        </td>
        <td className="input-fields"><input type="text" placeholder="0.00550 €/kWh" name="energy_tax_refund" id="energy_tax_refund" /></td>
     </tr>
     <tr>
        <td className="input-label">EEG allocation portion:</td>
        <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="EEG-Umlage-Anteil explanation/tip">
           <img src="public/images/help-red.png" alt="" />
           </button>
        </td>
        <td className="input-fields"><input type="text" placeholder="40%" name="eeg_allocation_portion" id="eeg_allocation_portion" /></td>
     </tr>
     <tr>
        <td className="input-label">EEG apportionment costs:</td>
        <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Inflation rate explanation/tip">
           <img src="public/images/help-red.png" alt="" />
           </button>
        </td>
        <td className="input-fields"><input type="text" placeholder="0.06792 €/kWh" name="eeg_apportion_costs" id="eeg_apportion_costs"/></td>
     </tr>
           </tbody>
           </table></td></tr> );
        }else{
            var expertTabs=(<ul id="tabsJustified1" className="nav nav-tabs">
            <li className="nav-item"><a href="" data-target="#eco-general" data-toggle="tab" className="nav-link small active">GENERAL</a></li>
            <li className="nav-item"><a href="" data-target="#eco-chp" data-toggle="tab" className="nav-link">CHP</a></li>
         </ul>);
        }
        return (
    <div className="modal modal_multi" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="economic-information">
    <form onSubmit={this.handleSubmit} className = "economic-information-form">
         <div className="modal-content">
            <div className="modal-heading">
               <div className="left-head"> Economic Data</div>
               <div className="right-head">
                  <ul className="list-inline">
                  <li> <input className="save-changes-btn" type="submit" alt="Submit" value="Save Changes" title="Save Changes"/></li>
                  <li><span className="close close_multi"><img src="public/images/cancle-icon.png" alt="" className="close-modal-economic"  aria-label="Close"/></span></li>
                  </ul>
               </div>
            </div>
            <div className="modal-body-content">
               {expertTabs}
               <div id="tabsJustifiedContent1" className="tab-content">

                  <div id="eco-general" className="tab-pane fade  active show">
                     <div className="eco-general-data-div">
                        <div className="table-responsive">
                           <table className="table">
                           <tbody>
                              <tr>
                                 <td className="input-label"> Electricity price:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Electricity price explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="0.180 €/kWh" name="electric_price" id="electric_price" />
                                 <input type="hidden" placeholder="Chiller 1" id="economicformMode"   name="economicformMode" value="add" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label"> Heat price:	</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Heat Price">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="0.000 €/kWh" name="heat_price" id="heat_price" /></td>
                              </tr>
                              {expertFields}
                              </tbody>
                           </table>
                        </div>
                       {expertOption}
                     </div>
                  </div>
                  <div id="eco-chp" className="tab-pane fade">
                     <div className="eco-chp-data-div">
                        <div className="table-responsive">
                           <table className="table">
                           <tbody>
                              <tr>
                                 <td className="input-label"> Own usage of electricity:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Electricity price explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="100%" name="own_usage_of_electricity" id="own_usage_of_electricity"/> </td>
                              </tr>
                              <tr>
                                 <td className="input-label">KWK-subsidy for
                                    electricity:
                                 </td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="KWK-subsidy for
                                    electricity">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="2016" name="subsidy_for_electricity" id="subsidy_for_electricity" /></td>
                              </tr>
                              <tr>
                                 <td className="input-label">Gas price:</td>
                                 <td className="input-help-label"><button type="button" className="" data-container="body" data-toggle="popover" data-placement="bottom" data-trigger="hover" data-content="Location explanation/tip">
                                    <img src="public/images/help-red.png" alt="" />
                                    </button>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="0.03500 €/kWh"  name="gas_price" id="gas_price"/></td>
                              </tr>

                             {expertChp}
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div id="eco-investment" className="tab-pane fade">
                     <div className="eco-investment-div">
                        <div className="table-responsive">
                           <table className="table">
                           <tbody>
                              <tr>
                                 <td className="input-label"> CHP in the basement:</td>
                                 <td className="input-fields"><input type="text" placeholder="78,250 €" className="icon-field"  name="chp_basement" id="chp_basement"/>
                                    <i className="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                 </td>
                                 <td className="input-label">Discount:</td>
                                 <td className="input-fields chp-base"><input type="text" placeholder="0%"  name="discount_chp_basement" id="discount_chp_basement"/> </td>
                              </tr>
                              <tr>
                                 <td className="input-label"> Chiller 1:</td>
                                 <td className="input-fields"><input type="text" placeholder="16,251 €" className="icon-field"  name="chiller" id="chiller"/>
                                    <i className="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                 </td>
                                 <td className="input-label">Discount:</td>
                                 <td className="input-fields chp-base"><input type="text" placeholder="0%"  name="chiller_discount" id="chiller_discount" /> </td>
                              </tr>
                              <tr>
                                 <td className="input-label"> Radiant cooling office:</td>
                                 <td className="input-fields"><input type="text" placeholder="8,550 €" name="radiant_cooling_office" id="radiant_cooling_office" />
                                 </td>
                                 <td className="input-label">Discount:</td>
                                 <td className="input-fields chp-base"><input type="text" placeholder="0%" name="radiant_discount" id="radiant_discount"/> </td>
                              </tr>
                              <tr>
                                 <td className="input-label"> eCoo 10X:</td>
                                 <td className="input-fields"><input type="text" placeholder="19,950 €"  name="ecoo" id="ecoo" />
                                 </td>
                                 <td className="input-label">Discount:</td>
                                 <td className="input-fields chp-base"><input type="text" placeholder="5%" name="ecoo_discount" id="ecoo_discount" /> </td>
                              </tr>
                              <tr>
                                 <td className="input-label">
                                    Project planning:
                                    <div className="edit-divv"><i className="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                    <div className="delete-divv"> <i className="fa fa-trash-o" aria-hidden="true"></i></div>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="3,000 €" name="planning_1" id="planning_1" />
                                 </td>
                                 <td className="input-label">Discount:</td>
                                 <td className="input-fields chp-base"><input type="text" placeholder="2%" name="planning_discount_1" id="planning_discount_1" /> </td>
                              </tr>
                              <tr className="add-new-row">
                                 <td className="input-label">
                                    Project planning:
                                    <div className="edit-divv"><i className="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                    <div className="delete-divv"> <i className="fa fa-trash-o" aria-hidden="true"></i></div>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="3,000 €" name="planning_2" id="planning_2" />
                                 </td>
                                 <td className="input-label">Discount:</td>
                                 <td className="input-fields chp-base"><input type="text" placeholder="2%" name="planning_discount_2" id="planning_discount_2"/> </td>
                              </tr>
                              </tbody>
                           </table>
                        </div>
                        <div className="new-row-addition">
                          <img src="public/images/plus-icon.png"  alt="" />
                        </div>
                     </div>
                     <div className="caculator-divv">
                        <div className="calci-div"></div>
                     </div>
                  </div>
                  <div id="eco-maintenance" className="tab-pane fade">
                     <div className="eco-maintenance-div">
                        <div className="table-responsive">
                           <table className="table">
                           <tbody>
                              <tr>
                                 <td className="input-label"> CHP in the basement:</td>
                                 <td className="input-fields"><input type="text" placeholder="78,250 €" className="icon-field" name="chp_basement_maintenence" id="chp_basement_maintenence"/>
                                    <i className="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                 </td>
                              </tr>
                              <tr>
                                 <td className="input-label"> Chiller 1:</td>
                                 <td className="input-fields"><input type="text" placeholder="16,251 €" className="icon-field"  name="chiller_maintenence" id="chiller_maintenence"/>
                                    <i className="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                 </td>
                              </tr>
                              <tr>
                                 <td className="input-label"> Radiant cooling office:</td>
                                 <td className="input-fields"><input type="text" placeholder="8,550 €"   name="radiant_maintenence" id="radiant_maintenence"/>
                                 </td>
                              </tr>
                              <tr>
                                 <td className="input-label"> eCoo 10X:</td>
                                 <td className="input-fields"><input type="text" placeholder="19,950 €"   name="ecoo_maintenence" id="ecoo_maintenence"/>
                                 </td>
                              </tr>
                              <tr>
                                 <td className="input-label">
                                    Project planning:
                                    <div className="edit-divv"><i className="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                    <div className="delete-divv"> <i className="fa fa-trash-o" aria-hidden="true"></i></div>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="3,000 €" name="planning_maintenence_1" id="planning_maintenence_1" />
                                 </td>
                              </tr>
                              <tr className="add-new-row">
                                 <td className="input-label">
                                    Project planning:
                                    <div className="edit-divv"><i className="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                    <div className="delete-divv"> <i className="fa fa-trash-o" aria-hidden="true"></i></div>
                                 </td>
                                 <td className="input-fields"><input type="text" placeholder="3,000 €" name="planning_maintenence_2" id="planning_maintenence_2"/>
                                 </td>
                              </tr>
                              </tbody>
                           </table>
                        </div>
                        <div className="new-row-addition">
                           <img src="public/images/plus-icon.png"  alt="" />
                        </div>
                     </div>
                     <div className="caculator-divv">
                        <div className="calci-div"></div>
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


