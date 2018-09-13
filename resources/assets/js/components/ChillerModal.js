import React from 'react';

export class ChillerModal extends React.Component {


    constructor(props){
        super(props);
        this.state = {compressionChiler: '',role:'user'};
        this.handleSubmit = this.handleSubmit.bind(this);


      }
      componentDidMount(){
        jQuery(".help-toggle").click(function(){
            jQuery(".input-help-label").toggle();
        });
      }
      handleLangChange () {
        this.props.onSelectLanguage("yes");
     }
      handleSubmit(e){
        const that = this;
        e.preventDefault();
        var refrigerant    = $("#compression-chiller-form").find("select[name=refrigerant]").val();
        var manufacturer    = $("#compression-chiller-form").find("select[name=manufacturer]").val();
        var compressor = $("#compression-chiller-form").find("select[name=compressor]").val();

        fetch('/adcalc/storeCompressionChiller', {
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
                                that.setState({
                                    compressionChiler:$('#compression-chiller-form').serializeArray()
                                })
                                that.handleLangChange();
                                compressionChiller.push($('#compression-chiller-form').serializeArray());
                                $("#compression-chiller").modal("hide");

                            }
        })
        .catch((err) => {console.log(err)})
      }

    render() {
        if(this.state.role=="expert"){
            var expertRoleHtml=<li class="nav-item"><a href="" data-target="#compression-calculation-data" data-toggle="tab" class="nav-link">CALCULATION DATA</a></li>;
        }

        return (
            <div class="modal " role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="compression-chiller">
            <form  onSubmit={this.handleSubmit}>
            <div class="modal-content">
               <div class="modal-heading">
                  <div class="left-head">Compression Chillers</div>
                  <div class="right-head">
                     <ul class="list-inline">
                        <li class="help-toggle"><img src="images/help-icon.png" alt="" /></li>
                        <li>
                         <input type="image" src="images/verifie-icon.png" alt="Submit" /></li>
                        <li><span class="close close_multi"><img src="images/cancle-icon.png" alt="" class="close" data-dismiss="modal" aria-label="Close"/></span></li>
                     </ul>
                  </div>
               </div>
               <div class="modal-body-content">
                  <ul id="tabsJustified2" class="nav nav-tabs">
                     <li class="nav-item"><a href="" data-target="#compression-technical-data" data-toggle="tab" class="nav-link small active">TECHNICAL DATA</a></li>
                     {expertRoleHtml}
                  </ul>
                  <div id="tabsJustifiedContent2" class="tab-content">
                     <div id="compression-technical-data" class="tab-pane fade  active show">
                        <div class="heating-load-general-div">
                           <div class="table-responsive">
                               <form action="" id="compression-chiller-form">
                                     <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}" />
                              <table class="table">
                                 <tr>
                                    <td class="input-label"> Name:	</td>
                                    <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Project number explanation/tip">
                                       <img src="images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td class="input-fields"><input type="text" placeholder="Chiller 1" /></td>
                                 </tr>
                                 <tr>
                                    <td class="input-label">Refrigerant:</td>
                                    <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                       <img src="images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td class="input-fields">
                                       <select required="required" id="refrigerant" name="refrigerant" class="required-field">
                                         <option value="">Select Refrigerant</option>
                                          <option value="R134a">R134a</option>
                                          <option value="option1">option1</option>
                                          <option value="option2">option2</option>
                                       </select>
                                       <span class="invalid-feedback" role="alert">
                                             <strong>Required field</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="input-label">Manufacturer:</td>
                                    <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                       <img src="images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td class="input-fields">
                                       <select required="required"  id="manufacturer" name="manufacturer" class="required-field">
                                          <option value="">Select Manufacturer</option>
                                          <option value="unknown">unknown</option>
                                          <option value="option1">option1</option>
                                          <option value="option2">option2</option>
                                       </select>
                                       <span class="invalid-feedback" role="alert">
                                             <strong>Required field</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="input-label">Compressor type:</td>
                                    <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Here you can enter your name, so it can appear in the report and we can contact you when we have questions about your project.">
                                       <img src="images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td class="input-fields">
                                       <select required="required"  id="compressor" name="compressor" class="required-field">
                                          <option value="">Select Compressor type</option>
                                          <option value="unknown">unknown</option>
                                          <option value="option1">option1</option>
                                          <option value="option2">option2</option>
                                       </select>
                                       <span class="invalid-feedback" role="alert">
                                             <strong>Required field</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="input-label">Chilled water
                                       temperature:
                                    </td>
                                    <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Customer explanation/tip">
                                       <img src="images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td class="input-fields"><input type="text" placeholder="6 °C" /></td>
                                 </tr>
                              </table>
                             </form>
                           </div>
                        </div>
                     </div>

                     <div id="compression-calculation-data" class="tab-pane fade expert">
                        <div class="personal-data-div">
                           <div class="table-responsive">
                              <table class="table">
                                 <tr>
                                    <td class="input-label">Investment costs:	</td>
                                    <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Editor explanation/tip">
                                       <img src="images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td class="input-fields"><input type="text" placeholder="€" /> </td>
                                 </tr>
                                 <tr>
                                    <td class="input-label">Discount:</td>
                                    <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Company explanation/tip">
                                       <img src="images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td class="input-fields"><input type="text" placeholder="%" /></td>
                                 </tr>
                                 <tr>
                                    <td class="input-label"> Maintenance costs: </td>
                                    <td class="input-help-label"><button type="button" class="" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Address explanation/tip">
                                       <img src="images/help-red.png" alt="" />
                                       </button>
                                    </td>
                                    <td class="input-fields"><input type="text" placeholder="€/a" /> </td>
                                 </tr>
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


