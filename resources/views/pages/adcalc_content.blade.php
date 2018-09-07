
  <section class="breadcrumbs">
         <div class="container">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
               <li class="breadcrumb-item active" aria-current="page">Adcalc</li>
            </ol>
         </div>
      </section>
       <section class="adcalc-content">
         <div class="container">
            <div class="adcalc-inner-content">
               <!-- top icon --> 
               <div class="icon-area">
                  <div class="row">
                     <div class="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                        <ul class="list-inline left-icon-list">
                           <li><a href="#"><img src="{{ asset('images/icon_1.png') }}" alt="" /></a></li>
                           <li><a href="#"><img src="{{ asset('images/icon_2.png') }}" alt="" /></a></li>
                           <li><a href="#"><img src="{{ asset('images/icon_3.png') }}" alt="" /></a></li>
                        </ul>
                     </div>
                     <div class="col-12 col-sm-6 col-md-6 col-xl-6 col-lg-6">
                        <ul class="list-inline right-icon-list">
                           <li class=""><a href="#"><img src="{{ asset('images/icon_4.png') }}" alt="" /></a></li>
                           <li><a href="#"><img src="{{ asset('images/icon_5.png') }}" alt="" /></a></li>
                           <li><a href="#"><img src="{{ asset('images/icon_6.png') }}" alt="" /></a></li>
                            <li><div data-toggle="modal" data-target="#contact-form-modal"><img src="images/icon_7.png" alt="" /></div></li>
                           <li><div data-toggle="modal"  class = "login-modal"><img src="images/icon_8.png" alt="" /></div></li> 

                        </ul>
                     </div>
                  </div>
               </div>
               <!-- top icon end -->
               <div class="bootom-data-box">
                  <!--first row-->
                  <div class="row">
                     <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4" id= "tile-1">
                        <div class="general-information data-box">
                           <h1>General Information</h1>
                           <h5 class="input-required">An input is required</h5>
                           <div class="main-hover-box general-info-hover">
                              <h1>General Information</h1>
                              <div class="edit-icon myBtn_multi"><img src="{{ asset('images/edit-icon.png') }}" alt="" /></div>
                              <p>We need the location to get the specific weather data.</p>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="economic-data data-box">
                           <h1>Economic Data</h1>
                           <ul class="price-listt">
                              <li>
                                 <p>Electricity Price</p>
                                 <h3>0.1800 €/kWh</h3>
                              </li>
                           </ul>
                           <div class="main-hover-box economic-hover">
                              <h1>Economic Data</h1>
                              <div class="edit-icon myBtn_multi"><img src="{{ asset('images/edit-icon.png') }}" alt="" /></div>
                              <ul class="price-listt">
                                 <li>
                                    <p>Electricity Price</p>
                                    <h3>0.1800 €/kWh</h3>
                                 </li>
                                 <li>
                                    <p>Gas Price</p>
                                    <h3>0.035 €/kWh</h3>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <div class="options data-box">
                           <h1>Options</h1>
                           <ul class="price-listt">
                              <li>
                                 <p>Re-cooling Type</p>
                                 <h3>DRY</h3>
                              </li>
                              <li>
                                 <p>Free cooling</p>
                                 <h3>YES <span>(chilled water temperature)</span></h3>
                              </li>
                           </ul>
                           <div class="main-hover-box options-hover">
                              <h1>Options</h1>
                              <div class="edit-icon myBtn_multi"><img src="{{ asset('images/edit-icon.png') }}" alt="" /></div>
                              <ul class="price-listt">
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
                              <ul class="right-list-content">
                                 <li>
                                    <p>Free cooling</p>
                                    <h3>Yes <span>(chilled water temperature)</span></h3>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--first row end -->
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-12 col-lg-8 col-xl-8">
                        <div class="row">
                           <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                              <div class="heat-sources data-box">
                                 <h1>Heat Sources</h1>
                                 <div class="main-hover-box heat-sources-hover">
                                    <h1>Heat Sources</h1>
                                    <p>Define the available or planned heat sources so that the suggested Fahrenheit system would be suitable for those 
                                       sources.
                                    </p>
                                    <div class="add-icon myBtn_multi"><img src="{{ asset('images/add-icon.png') }}" alt="no-image" /></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                              <div class="heating-load-profiles data-box">
                                 <h1>Heating Load Profile</h1>
                                 <div class="main-hover-box heating-load-hover">
                                    <h1>Heating Load Profile</h1>
                                    <p>Choose one or more predefined heating load profiles and we will know how much heat will be available from your heat sources.
                                    <br>
                                       Are you planning a new heat source? Then we can calculate the profitability of the whole system!
                                    </p>
                                    <div class="add-icon myBtn_multi"><img src="{{ asset('images/add-icon.png') }}" alt="no-image" /></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                              <div class="compression-chillers data-box">
                                 <h1>Compression Chillers</h1>
                                 <div class="main-hover-box compression-chillers-hover">
                                    <h1>Compression Chillers</h1>
                                    <p>Do you already have an existing compression chiller or you are planning to install a new one? Define your chillers and we will compare our system with yours.</p>
                                    <div class="add-icon myBtn_multi"><img src="{{ asset('images/add-icon.png') }}" alt="no-image" /></div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                              <div class="cooling-load-profiles data-box">
                                 <h1>Cooling Load Profile</h1>
                                 <h5 class="input-required">An input is required</h5>
                                 <div class="main-hover-box cooling-load-hover">
                                    <h1>Cooling Load Profile</h1>
                                    <p>Define your cooling load profile and require cooling capacity so we can suggest a syatem for you!</p>
                                    <div class="add-icon myBtn_multi"><img src="{{ asset('images/add-icon.png') }}" alt="no-image" /></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 col-sm-12 col-12 col-lg-4 col-xl-4">
                        <div class="fahrenheit-system-box data-box">
                           <h1>Fahrenheit System</h1>
                           <h5 class="input-required">More inputs are required
                              to suggest a system
                           </h5>
                           <div class="main-hover-box fahrenheit-system-hover">
                              <h1>Fahrenheit System</h1>
                              <p>Please provide the required inputs so we can suggest a Fahrenheit system for you.</p>
                              <div class="add-icon myBtn_multi"><img src="{{ asset('images/add-icon.png') }}" alt="no-image" /></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>
         </div>
      </section>
     
 
      <!-- General Information Modal -->
      <div class="modal modal_multi">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head"> General Information</div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt="no-image" /></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt="" /></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustified" class="nav nav-tabs">
                  <li class="nav-item"><a href="" data-target="#project-data" data-toggle="tab" class="nav-link small active">PROJECT DATA</a></li>
                  <li class="nav-item"><a href="" data-target="#personal-data" data-toggle="tab" class="nav-link">PERSONAL DATA</a></li>
               </ul>
               <div id="tabsJustifiedContent" class="tab-content">
                  <div id="project-data" class="tab-pane fade  active show">
                     <div class="project-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> Project number:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="New Project"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Project name: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Test Project"></td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Location:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Location explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Halle/Saale" class="required-field"> <i class="fa fa-map-marker" aria-hidden="true"></i> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Customer:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="HabWarmWillKalt Gmbh "></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Contact:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Contact explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Mr. Inhaber"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Tel. Number:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Tel. number explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="0123 456"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Email:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Email explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="inhaber@gmbh.de"></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div id="personal-data" class="tab-pane fade">
                     <div class="personal-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label">Editor:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="HabWarmWillKalt Gmbh"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Company:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Gmbh"></td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Address:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Halle/Saale" class="required-field"> <i class="fa fa-map-marker" aria-hidden="true"></i> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Tel. Number:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Tel. number explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="0123 456"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Mobile:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Mobile explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Mr. Inhaber"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Email:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Email explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="inhaber@gmbh.de"></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- General Information Modal end --> 
      <!--  Economic data Modal -->
      <div class="modal modal_multi">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head"> Economic Data</div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt="" /></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt="" /></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustified1" class="nav nav-tabs">
                  <li class="nav-item"><a href="" data-target="#eco-general" data-toggle="tab" class="nav-link small active">GENERAL</a></li>
                  <li class="nav-item"><a href="" data-target="#eco-chp" data-toggle="tab" class="nav-link">CHP</a></li>
                  <li class="nav-item"><a href="" data-target="#eco-investment" data-toggle="tab" class="nav-link">INVESTMENTS</a></li>
                  <li class="nav-item"><a href="" data-target="#eco-maintenance" data-toggle="tab" class="nav-link">MAINTENANCE</a></li>
               </ul>
               <div id="tabsJustifiedContent1" class="tab-content">
                  <div id="eco-general" class="tab-pane fade  active show">
                     <div class="eco-general-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> Electricity price:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Electricity price explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="0.180 €/kWh"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Heat price:   </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Heat Price">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="0.000 €/kWh"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Electricity price increase:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Location explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="2.000 %/a"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Calculated interest rate:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Calculated interest rate explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="0.700 %/a"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Inflation rate:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Inflation rate explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="1.600 %/a"></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div id="eco-chp" class="tab-pane fade">
                     <div class="eco-chp-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> Own usage of electricity:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Electricity price explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="100%"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">KWK-subsidy for 
                                    electricity:    
                                 </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="KWK-subsidy for 
                                    electricity">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="2016"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Gas price:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Location explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="0.03500 €/kWh"></td>
                              </tr>
                              
                              <tr>
                                 <td colspan="3">
                                    <h3 class="inner-table-heading">FOR EXPERTS</h3>
                                 </td>
                              </tr>
                              <td class="input-label">Electricity sales price:</td>
                              <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Electricity sales price explanation/tip">
                                 <img src="{{ asset('images/help-red.png') }}" alt="" />
                                 </button>
                              </td>
                              <td class="input-fields"><input type="text" placeholder="0.03500 €/kWh"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Energiesteuer
                                    Rückerstattung:
                                 </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Inflation rate explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="0.00550 €/kWh"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">EEG-Umlage-Anteil:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="EEG-Umlage-Anteil explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="40%"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">EEG-Umlage-Kosten:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Inflation rate explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="0.06792 €/kWh"></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div id="eco-investment" class="tab-pane fade">
                     <div class="eco-investment-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> CHP in the basement:</td>
                                 <td class="input-fields"><input type="text" placeholder="78,250 €" class="icon-field">
                                    <i class="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                 </td>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-fields chp-base"><input type="text" placeholder="0%"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Chiller 1:</td>
                                 <td class="input-fields"><input type="text" placeholder="16,251 €" class="icon-field">
                                    <i class="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                 </td>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-fields chp-base"><input type="text" placeholder="0%"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Radiant cooling office:</td>
                                 <td class="input-fields"><input type="text" placeholder="8,550 €">
                                 </td>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-fields chp-base"><input type="text" placeholder="0%"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> eCoo 10X:</td>
                                 <td class="input-fields"><input type="text" placeholder="19,950 €">
                                 </td>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-fields chp-base"><input type="text" placeholder="5%"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">
                                    Project planning: 
                                    <div class="edit-divv"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                    <div class="delete-divv"> <i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="3,000 €">
                                 </td>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-fields chp-base"><input type="text" placeholder="2%"> </td>
                              </tr>
                              <tr class="add-new-row">
                                 <td class="input-label">
                                    Project planning: 
                                    <div class="edit-divv"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                    <div class="delete-divv"> <i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="3,000 €">
                                 </td>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-fields chp-base"><input type="text" placeholder="2%"> </td>
                              </tr>
                           </table>
                        </div>
                        <div class="new-row-addition">
                          <img src="{{ asset('images/plus-icon.png') }}"  alt="" />
                        </div>
                     </div>
                     <div class="caculator-divv">
                        <div class="calci-div"></div>
                     </div>
                  </div>
                  <div id="eco-maintenance" class="tab-pane fade">
                     <div class="eco-maintenance-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> CHP in the basement:</td>
                                 <td class="input-fields"><input type="text" placeholder="78,250 €" class="icon-field">
                                    <i class="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Chiller 1:</td>
                                 <td class="input-fields"><input type="text" placeholder="16,251 €" class="icon-field">
                                    <i class="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Radiant cooling office:</td>
                                 <td class="input-fields"><input type="text" placeholder="8,550 €">
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> eCoo 10X:</td>
                                 <td class="input-fields"><input type="text" placeholder="19,950 €">
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">
                                    Project planning: 
                                    <div class="edit-divv"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                    <div class="delete-divv"> <i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="3,000 €">
                                 </td>
                              </tr>
                              <tr class="add-new-row">
                                 <td class="input-label">
                                    Project planning: 
                                    <div class="edit-divv"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></div>
                                    <div class="delete-divv"> <i class="fa fa-trash-o" aria-hidden="true"></i></div>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="3,000 €">
                                 </td>
                              </tr>
                           </table>
                        </div>
                        <div class="new-row-addition">
                           <img src="{{ asset('images/plus-icon.png') }}"  alt="" />
                        </div>
                     </div>
                     <div class="caculator-divv">
                        <div class="calci-div"></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Economic data Modal end -->       
      <!-- option modal start-->
      <div class="modal modal_multi">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head"> Options</div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt="" /></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt="" /></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustified2" class="nav nav-tabs project-specifications">
                  <li class="nav-item"><a href="" data-target="#option-general" data-toggle="tab" class="nav-link small active">GENERAL</a></li>
                  <li class="nav-item"><a href="" data-target="#project-specification" data-toggle="tab" class="nav-link">PROJECT SPECIFICATIONS</a></li>
               </ul>
               <div id="tabsJustifiedContent2" class="tab-content">
                  <div id="option-general" class="tab-pane fade  active show">
                     <div class="option-general-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> Language:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <ul class="list-inline">
                                       <li><img src="{{ asset('images/germany-flag.png') }}" alt="" />
                                       <li>
                                       <li><img src="{{ asset('images/united-kingdom.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/poland-flag.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/italy.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/greece-flag.png') }}" alt="" /></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">BAFA 2018:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>Calculate</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Re-cooling Method:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>Dry</option>
                                       <option>dry1</option>
                                       <option>dry2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Re-cooling Temperature:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Contact explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="25 °C"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Free Cooling:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>Yes (chilled water temperature)</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Heat Sources:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>Utilize also for heating load profile</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Heat Supply:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>Priority for heating load profile</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Conventional heat source:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Location explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Boiler, 2x 100 kW"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Calculation method:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>Chilled water inlet temperature </option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Ambient temperature step:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>constant</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Heating load profile:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>1.0 K</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Cooling load profile:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>Capacity [kW]</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div id="project-specification" class="tab-pane fade">
                     <div class="personal-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label">Bus system:    </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder=""> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Controller:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder=""></td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Pressure drop in the piping:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="" > </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- option modal end-->   
      <!--  heat sources  modal start-->
      <div class="modal modal_multi">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head"> Heat Source</div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt="" /></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt="" /></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustified2" class="nav nav-tabs">
                  <li class="nav-item"><a href="" data-target="#technical-data" data-toggle="tab" class="nav-link small active">TECHNICAL DATA</a></li>
                  <li class="nav-item"><a href="" data-target="#calculation-data" data-toggle="tab" class="nav-link">CALCULATION DATA</a></li>
               </ul>
               <div id="tabsJustifiedContent2" class="tab-content">
                  <div id="technical-data" class="tab-pane fade  active show">
                     <div class="option-general-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> Name: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="CHP in the basement"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Type of heat source:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>CHP</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Drive temperature:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="85°C" class="required-field"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Heat capacity:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Contact explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="36 kw" class="required-field"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Electric capacity: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="18 kw"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Thermal efficiency:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="54.8 %"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">
                                    Electric efficiency:
                                 </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="34.5 %"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Manufacturer:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>EC-Power</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Type:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>XRGI 15</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Operation hours:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Location explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="4.000 h/a"><i class="fa fa-calculator myBtn_multi" aria-hidden="true" data-index="4"></i>
                                 
                                 
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> New installation:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Location explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select>
                                       <option>No</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                           </table>
                        </div>
                        <p class="additional-options">Additional options for economic calculations are available!</p>
                     </div>
                  </div>
                  <div id="calculation-data" class="tab-pane fade">
                     <div class="personal-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label">Investment costs:  </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="%"></td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Maintenance costs: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€/kWh" > </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- heat sources modal end--> 
     
      <!-- heating-load-profiles -->
      <div class="modal modal_multi">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head"> Heating Load Profile</div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt="" /></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt="" /></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustified2" class="nav nav-tabs">
                  <li class="nav-item"><a href="" data-target="#heating-technical-data" data-toggle="tab" class="nav-link small active">TECHNICAL DATA</a></li>
                  <li class="nav-item"><a href="" data-target="#heating-calculation-data" data-toggle="tab" class="nav-link">CALCULATION DATA</a></li>
               </ul>
               <div id="tabsJustifiedContent2" class="tab-content">
                  <div id="heating-technical-data" class="tab-pane fade  active show">
                     <div class="heating-load-general-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> Name: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Office South"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Profile Type:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>Office Space</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Max. heating load:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <ul class="list-inline">
                                       <li><input type="text" placeholder="52.2 kw" class="required-field"></li>
                                       <li> at </li>
                                       <li><input type="text" placeholder="-15" class="icon-field"><i class="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                       </li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Base load:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <ul class="list-inline">
                                       <li><input type="text" placeholder="8.0 kw" class="required-field"></li>
                                       <li>from </li>
                                       <li><input type="text" placeholder="°C" class="icon-field required-field"></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Zero load:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <ul class="list-inline">
                                       <li><input type="text" placeholder="0.0 kw" class="required-field">
                                       </li>
                                       <li>from</li>
                                       <li> <input type="text" placeholder="20 °C" class="icon-field required-field"><i class="fa fa-calculator dropdown-calci" aria-hidden="true"></i></li>
                                    </ul>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                     <div class="caculator-divv">
                      <div class="calci-div"></div>
                     </div>
                  </div>
                  <div id="heating-calculation-data" class="tab-pane fade">
                     <div class="personal-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label">Investment costs:  </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="%"></td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Maintenance costs: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€/a" > </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- heating-load profile modal end -->       
      <!-- Compression Chillers modal start -->
      <div class="modal modal_multi">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head">Compression Chillers</div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt="" /></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt="" /></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustified2" class="nav nav-tabs">
                  <li class="nav-item"><a href="" data-target="#compression-technical-data" data-toggle="tab" class="nav-link small active">TECHNICAL DATA</a></li>
                  <li class="nav-item"><a href="" data-target="#compression-calculation-data" data-toggle="tab" class="nav-link">CALCULATION DATA</a></li>
               </ul>
               <div id="tabsJustifiedContent2" class="tab-content">
                  <div id="compression-technical-data" class="tab-pane fade  active show">
                     <div class="heating-load-general-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> Name: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Chiller 1"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Refrigerant:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>R134a</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Manufacturer:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>unknown</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Compressor type:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>unknown</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Chilled water 
                                    temperature:
                                 </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="6 °C" >
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div id="compression-calculation-data" class="tab-pane fade">
                     <div class="personal-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label">Investment costs:  </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="%"></td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Maintenance costs: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€/a" > </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Compression Chillers modal end -->    
      <!-- cooling-load-profiles -->
      <div class="modal modal_multi">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head"> Cooling Load Profile</div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt="" /></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt="" /></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustified2" class="nav nav-tabs">
                  <li class="nav-item"><a href="" data-target="#cooling-technical-data" data-toggle="tab" class="nav-link small active">TECHNICAL DATA</a></li>
                  <li class="nav-item"><a href="" data-target="#cooling-calculation-data" data-toggle="tab" class="nav-link">CALCULATION DATA</a></li>
               </ul>
               <div id="tabsJustifiedContent2" class="tab-content">
                  <div id="cooling-technical-data" class="tab-pane fade  active show">
                     <div class="heating-load-general-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label"> Name: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="Radiant cooling office"></td>
                              </tr>
                              <tr>
                                 <td class="input-label">Profile Type:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>Office Space</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Chilled water 
                                    temperature: 
                                 </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="16°C" > </td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Chilled water inlet 
                                    temperature: 
                                 </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="19°C" > </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Max. cooling load:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <ul class="list-inline">
                                       <li><input type="text" placeholder="50.0 kW" class="required-field"></li>
                                       <li> at </li>
                                       <li><input type="text" placeholder="34°C" class="icon-field"><i class="fa fa-calculator dropdown-calci" aria-hidden="true"></i>
                                       </li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Base load:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <ul class="list-inline">
                                       <li><input type="text" placeholder="10.0 kW" class="required-field"></li>
                                       <li>from </li>
                                       <li><input type="text" placeholder="10°C" class="icon-field required-field"></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Zero load:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <ul class="list-inline">
                                       <li><input type="text" placeholder="0.0 kW">
                                       </li>
                                       <li>from</li>
                                       <li> <input type="text" placeholder="10 °C" class="icon-field "><i class="fa fa-calculator dropdown-calci" aria-hidden="true"></i></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Cooling hours:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <input type="text" placeholder="6,724 h" class="icon-field "><i class="fa fa-calculator myBtn_multi" aria-hidden="true"></i>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                     <div class="caculator-divv">
                      <div class="calci-div"></div>
                     </div>
                  </div>
                  <div id="cooling-calculation-data" class="tab-pane fade">
                     <div class="personal-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td class="input-label">Investment costs:  </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="%"></td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Maintenance costs: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                    <img src="{{ asset('images/help-red.png') }}" alt="" />
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€/a" > </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Cooling Load Profile modal end -->    
        
      <!-- fahrenhiet modal start -->
      <div class="modal modal_multi mainmodal">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head"> Fahrenheit System  </div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt="" /></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt="" /></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustifiedlast" class="nav nav-tabs">
                  <li class="nav-item"><img src="{{ asset('images/plus-icon.png') }}" class="myBtn_multi modal-openn" alt="" /> <a href="" data-target="#chillar" data-toggle="tab" class="nav-link small active"> Chiller</a></li>
                  <li class="nav-item"><img src="{{ asset('images/plus-icon.png') }}" class="myBtn_multi modal-openn" alt="" /> <a href="JavaScript:Void(0)" data-target="#recooling-system" data-toggle="tab" class="nav-link"> <span class="center-text">Re-cooling System</span> <img src="{{ asset('images/cacli-icon.png') }}" class="dropdown-calci" alt="caculator" /></a>
                   <div class="caculator-divv">
                        <div class="calci-div"></div>
                     </div>
                     </li>
                  
               </ul>
               <div id="tabsJustifiedContentlast" class="tab-content">
                  <div id="chillar" class="tab-pane fade  active show">
                     <div class="chiller-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tr>
                                 <td>
                                    <p>Adsorption chillers product group</p>
                                    <p>eCoo 20 ST   </p>
                                    <p>eCoo 20 ST</p>
                                 </td>
                                 <td>
                                    <p>2.20</p>
                                    <p>2.20</p>
                                    <p>2.20</p>
                                 </td>
                                 <td>
                                    <ul class="list-inline">
                                       <li><img src="{{ asset('images/edit-ico.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/del-icon.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/bar-icon.png') }}" alt="" /></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p>Compression chiller product group</p>
                                    <p> eWac 30 </p>
                                 </td>
                                 <td></td>
                                 <td>
                                    <ul class="list-inline">
                                      <li><img src="{{ asset('images/edit-ico.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/del-icon.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/bar-icon.png') }}" alt="" /></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p>Re-cooler product group</p>
                                    <p>eRec 20 | 58 </p>
                                 </td>
                                 <td></td>
                                 <td>
                                    <ul class="list-inline">
                                      <li><img src="{{ asset('images/edit-ico.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/del-icon.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/bar-icon.png') }}" alt="" /></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p>Re-cooler product group</p>
                                    <p>eRec 20 | 80</p>
                                 </td>
                                 <td></td>
                                 <td>
                                    <ul class="list-inline">
                                      <li><img src="{{ asset('images/edit-ico.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/del-icon.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/bar-icon.png') }}" alt="" /></li>
                                    </ul>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div id="recooling-system" class="tab-pane fade">
                     <div class="recooling-system-data-div">
                        <div class="table-responsive">
                           <table class="table">
                                   <tr>
                                 <td>
                                    <p>Adsorption chillers product group</p>
                                    <p>eCoo 20 ST   </p>
                                    <p>eCoo 20 ST</p>
                                 </td>
                                 <td>
                                    <p>2.20</p>
                                    <p>2.20</p>
                                    <p>2.20</p>
                                 </td>
                                 <td>
                                    <ul class="list-inline">
                                      <li><img src="{{ asset('images/edit-ico.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/del-icon.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/bar-icon.png') }}" alt="" /></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p>Compression chiller product group</p>
                                    <p> eWac 30 </p>
                                 </td>
                                 <td></td>
                                 <td>
                                    <ul class="list-inline">
                                     <li><img src="{{ asset('images/edit-ico.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/del-icon.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/bar-icon.png') }}" alt="" /></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p>Re-cooler product group</p>
                                    <p>eRec 20 | 58 </p>
                                 </td>
                                 <td></td>
                                 <td>
                                    <ul class="list-inline">
                                      <li><img src="{{ asset('images/edit-ico.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/del-icon.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/bar-icon.png') }}" alt="" /></li>
                                    </ul>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <p>Re-cooler product group</p>
                                    <p>eRec 20 | 80</p>
                                 </td>
                                 <td></td>
                                 <td>
                                    <ul class="list-inline">
                                      <li><img src="{{ asset('images/edit-ico.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/del-icon.png') }}" alt="" /></li>
                                       <li><img src="{{ asset('images/bar-icon.png') }}" alt="" /></li>
                                    </ul>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                    
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- fahrenhiet modal end -->
      <!--- calender popup for heat sources modal start-->
       <div class="modal modal_multi" id="calender-popup">
         <div class="modal-content">
         <div class="modal-heading">
               <div class="left-head"> Operation Hours</div>
               <div class="right-head">
                
                   <span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span>
                
               </div>
            </div>
         <div class="modal-body-content">
          <div class="calendar"></div>
          <div class="button-div">
           <a href="#">Apply hours for the whole year</a>
           <a href="#">Remove this month</a>
          </div>
          
         </div>
         </div>
         </div>
      <!-- calender popup for heat sources end --> 
       <!--- calender popup for cooling load profile modal start-->
       <div class="modal modal_multi" id="calender-popupp">
         <div class="modal-content">
         <div class="modal-heading">
               <div class="left-head"> Operation Hours</div>
               <div class="right-head">
                
                   <span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt="" /></span>
                
               </div>
            </div>
         <div class="modal-body-content">
          <div class="calendar"></div>
          <div class="button-div">
           <a href="#">Apply hours for the whole year</a>
           <a href="#">Remove this month</a>
          </div>
          
         </div>
         </div>
         </div>
      <!-- calender popup for cooling load profile  end --> 
      <!-- add a chiller modal start-->
      <div class="modal modal_multi">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head"> Add a Chiller</div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt=""></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt=""></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt=""></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustifiedd" class="nav nav-tabs">
                  <li class="nav-item"><a href="" data-target="#addchillar-technical-data" data-toggle="tab" class="nav-link small active">TECHNICAL DATA</a></li>
                  <li class="nav-item"><a href="" data-target="#addchillar-calculation-data" data-toggle="tab" class="nav-link">CALCULATION DATA</a></li>
               </ul>
               <div id="tabsJustifiedContentt" class="tab-content">
                  <div id="addchillar-technical-data" class="tab-pane fade  active show">
                     <div class="addachillar-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tbody>
                              <tr>
                                 <td class="input-label">Chiller type:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>Adsorption</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              
                              
                              <tr>
                                 <td class="input-label">Adsorbent:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>Silica gel</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Product:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>eCoo 20 ST</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Number of chillers:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>2 pieces</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Product 
interconnection:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>2.00</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Group interconnection:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>2.20</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Function:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>Peak load cover</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                             
                              
                             
                                 
                           
                           </tbody></table>
                        </div>
                       
                     </div>
                  </div>
                  <div id="addchillar-calculation-data" class="tab-pane fade">
                     <div class="addchillar-cal-data-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tbody><tr>
                                 <td class="input-label">Investment costs:  </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€"> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="%"></td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Maintenance costs: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="€/a"> </td>
                              </tr>
                           </tbody></table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- add a chillar modal end -->
      <!-- recooling system modal start -->
       <div class="modal modal_multi">
         <div class="modal-content">
            <div class="modal-heading">
               <div class="left-head">Add a Re-cooling System</div>
               <div class="right-head">
                  <ul class="list-inline">
                     <li class="help-toggle"><img src="{{ asset('images/help-icon.png') }}" alt=""></li>
                     <li><img src="{{ asset('images/verifie-icon.png') }}" alt=""></li>
                     <li><span class="close close_multi"><img src="{{ asset('images/cancle-icon.png') }}" alt=""></span></li>
                  </ul>
               </div>
            </div>
            <div class="modal-body-content">
               <ul id="tabsJustifieddd" class="nav nav-tabs">
                  <li class="nav-item"><a href="" data-target="#addrecooling-technical-data" data-toggle="tab" class="nav-link small active">TECHNICAL DATA</a></li>
                  <li class="nav-item"><a href="" data-target="#addrecooling-calculation-data" data-toggle="tab" class="nav-link">CALCULATION DATA</a></li>
               </ul>
               <div id="tabsJustifiedContenttt" class="tab-content">
                  <div id="addrecooling-technical-data" class="tab-pane fade  active show">
                     <div class="add-recooling-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tbody>
                              <tr>
                                 <td class="input-label">Components:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>Re-cooler</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Re-cooling method:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>Dry</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Product:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>eRec 20 | 58</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                              
                              
                              <tr>
                                 <td class="input-label"> Number of units:  </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="1 piece" class="required-field"></td>
                              </tr>
                            
                              <tr>
                                 <td class="input-label"> Name: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder=""></td>
                              </tr>
                          
                              <tr>
                                 <td class="input-label"> Re-cooling capacity:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="58 kW" class="required-field"></td>
                              </tr>
                            
                              <tr>
                                 <td class="input-label"> Temperature difference:   </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="2 K" class="required-field"></td>
                              </tr>
                            
                              <tr>
                                 <td class="input-label"> Primary volume 
flow rate:  </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="" class="required-field"></td>
                              </tr>
                              
                              <tr>
                                 <td class="input-label"> Secondary volume 
flow rate:  </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="" class="required-field"></td>
                              </tr>
                            
                              <tr>
                                 <td class="input-label">Electrical power 
consumption:    </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder="" class="required-field"></td>
                              </tr>
                              <tr>
                              
                              
                                 <td class="input-label">Available/provided 
by customer:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project." data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields">
                                    <select class="required-field">
                                       <option>No</option>
                                       <option>option1</option>
                                       <option>option2</option>
                                    </select>
                                 </td>
                              </tr>
                             
                              
                           </tbody></table>
                        </div>
                       
                     </div>
                  </div>
                  <div id="addrecooling-calculation-data" class="tab-pane fade">
                     <div class="addecooling-calcu-div">
                        <div class="table-responsive">
                           <table class="table">
                              <tbody><tr>
                                 <td class="input-label">Investment costs:  </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder=""> </td>
                              </tr>
                              <tr>
                                 <td class="input-label">Discount:</td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder=""></td>
                              </tr>
                              <tr>
                                 <td class="input-label"> Maintenance costs: </td>
                                 <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip" data-original-title="" title="">
                                    <img src="{{ asset('images/help-red.png') }}" alt="">
                                    </button>
                                 </td>
                                 <td class="input-fields"><input type="text" placeholder=""> </td>
                              </tr>
                           </tbody></table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- recooling system modal end-->
      <!---contact us modal----->
        <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>



<div class="modal" id="contact-form-modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
  
        <div class="modal-heading">
               <div class="left-head">Contact Fahrenheit</div>
               <div class="right-head">
                
                    <span class="close" data-dismiss="modal"><img src="images/cancle-icon.png" alt=""></span>
                
               </div>
            </div>
      <!-- Modal body -->
      <div class="modal-body-content">
       <div class="table-responsive">
                           <table class="table">
                              <form id = "fahrenheit-contact" class = "fahrenheit-contact" >
                                 <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <tbody><tr>
                                       <td class="input-label"> Name:</td>
                                      
                                       <td class="input-fields "><input type="text" name = "full_name" placeholder="Enter your name"   minlength="1" maxlength="25" required="true" class="required-field full_name"> </td>
                                    </tr>
                                    <tr>
                                       <td class="input-label"> Company:   </td>
                                     
                                       <td class="input-fields"><input type="text" name= "company_type" placeholder="Enter your company name" minlength="1" maxlength="25" class="company_type" ></td>
                                    </tr>
                                    <tr>
                                       <td class="input-label"> Tel. Number:</td>
                                     
                                       <td class="input-fields"><input type="text" name= "contact_number" placeholder="Enter your contact number" minlength="1" maxlength="25"  required="true" class="required-field contact_number"></td>
                                    </tr>
                                    <tr>
                                       <td class="input-label">Email:</td>
                                     
                                       <td class="input-fields"><input type="text" name= "email_address" placeholder="Enter your email address"  minlength="1" maxlength="25"  required="true" class="required-field email_address"></td>
                                    </tr>
                                    <tr>
                                       <td class="input-label text-area-label">Message:</td>
                                      
                                       <td class="input-fields textarea-place"><textarea name= "message" class = "message"></textarea></td>
                                    </tr>
                                    <tr>
                                     <td colspan="2" class="form-submitbtn"><button type="submit" class="btn submit-contact-form" >Submit</button></td>
                                    </tr>
                                 </tbody>
                           </form>
                        </table>
                        </div>
      </div>

    </div>
  </div>
</div>
      <!-- contact us modal end -->



 <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Login</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                    </div>
                    <div class="modal-body">
                        <form id="login-form" method="post" onsubmit="return LoginUser()" role="form" style="display: block;">
                            @csrf


                            <div class="form-group row">

                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>


                                        <span class="invalid-feedback invalid-login hide" role="alert">
                                            <strong></strong>
                                        </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="contact-us-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><img src="{{ asset('images/fahrenheit_logo.png') }}" alt=""></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        </div>
        <div class="modal-body ">
               
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" id="modal-btn-si" data-dismiss="modal">Ok</button>

        </div>
      </div>
    </div>
</div>      

        <script type="text/javascript">
            function LoginUser()
            {
                var token    = $("input[name=_token]").val();
                var email    = $("input[name=email]").val();
                var password = $("input[name=password]").val();
                var data = {
                    _token:token,
                    email:email,
                    password:password
                };
                // Ajax Post
                $.ajax({
                    type: "post",
                    url: "/users/loginUser",
                    data: data,
                    cache: false,
                    success: function (data)
                    {
                        console.log('login request sent !');
                        console.log('status: ' +data.status);
                        console.log('message: ' +data.message);
                        if(data.status=="success"){
                            window.location.href="/user_reports";
                        }
                        else{
                            $("input[name=email]").addClass('is-invalid');
                            $(".invalid-login strong").removeClass('hide').text(data.message);
                        }
                    },
                    error: function (data){
                        alert('Fail to run Login..');
                    }
                });
                return false;
            }


              jQuery(document).ready(function() {

               $('.fahrenheit-contact').on('submit',function(e){
                  // alert('dsa')

                   e.preventDefault();

                  //stopPropagation();
             
                var form_data = $('.fahrenheit-contact').serialize();
           
                var data = {
                 
                    form_data:form_data
                   
                   
                };
                // Ajax Post
                $.ajax({
                       method: "post",
                       headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
                    url: "/pages/submitContactForm",
                    data: data,
                    cache: false,
                    success: function (data)
                    {
                     $('#contact-form-modal').modal('hide');  
                       if(data=='success')
                       {

                           $('#contact-us-modal').modal('show');
                           $('#contact-us-modal .modal-body').html('show');

                       }
                    },
                    error: function (data){
                      //  alert('Fail to run Login..');
                    }
                });
               });


      $('.login-modal').on('click',function(e){
         if (loggedIn)
         {
           window.location = "/user_reports"
         }

         else
         {
           $('#loginModal').modal('show');
         }
   })

            });

          


            //# sourceURL=user.js
        </script>     