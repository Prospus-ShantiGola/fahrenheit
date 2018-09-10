import React from 'react';

export class Tiles extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
        };
    }

    render() {
        var priceFullList,pricelist,requiredMsg="";

        if(this.props.priceList=="yes"){
            var pricelist=(
                <ul className="price-listt">
                    <li>
                        <p>Re-cooling Type</p>
                        <h3>DRY</h3>
                    </li>
                    <li>
                        <p>Free cooling</p>
                        <h3>YES <span>(chilled water temperature)</span></h3>
                    </li>
                </ul>
            );
            var priceFullList=(
                <ul className="price-listt">
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
            );
        }
        if(this.props.rightpriceList=="yes"){
            var rightList=(
                <ul className="right-list-content">
                <li>
                   <p>Free cooling</p>
                   <h3>Yes <span>(chilled water temperature)</span></h3>
                </li>
             </ul>
            );
        }
        if(this.props.required=="yes"){
            var requiredMsg=<h5 class="input-required">An input is required</h5>;
        }

        return (


<div className={this.props.mainclass}>
<div className={this.props.tileCls}>
   <h1>{this.props.title}</h1>
   {requiredMsg}
   {pricelist}
   <div className={this.props.hoverCls}>
      <h1>{this.props.title}</h1>
      <div className={this.props.editCls}><img src={this.props.editIcon} alt="" /></div>
      <p>{this.props.hoverText}</p>
      {priceFullList}
      {rightList}
   </div>
</div>
</div>



        );
    }
}

Tiles.defaultProps = {
    title:'General Information',
    tileCls:'general-information data-box',
    required:"yes",
    edit:'yes',
    editCls:'edit-icon myBtn_multi',
    editIcon:'images/edit-icon.png',
    add:'no',
    hoverText:'We need the location to get the specific weather data.',
    mainClass:'col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4',
    hoverCls:'main-hover-box general-info-hover',
    priceLst:'no',
    priceData:{

    },
    rightpriceList:'no',
    rightpriceListeData:{

    }
  };
