import React, { Component } from 'react';
import {Tiles} from './Tiles';
import {ChillerModal} from './ChillerModal';
import {GeneralModal} from './GeneralModal';
import {EconomicModal} from './EconomicModal';
import {HeatSourceModal} from './HeatSourceModal';

export default class Adcalc extends Component {
    constructor(props) {
        super(props);
        this.state = {
            economicStateChange: {
                stateChange:false,
                economicRecord:[]
            },
            OptionsStateChange: {
                stateChange:false
            },
            heatSourceStateChange: {
                stateChange:false,
                heatSourceRecord:[]
            },
            HeatingLoadProfileStateChange: {
                stateChange:false
            },
            generalStateChange: {
                stateChange:false,
                generalRecord:[]
            },
            compressionChilerStateChange:{
                stateChange:false,
                content:"Do you already have an existing compression chiller or you are planning to install a new one? Define your chillers and we will compare our system with yours.",
                chillerRecord:[]
            }
            ,
            logged_in_role:LOGGED_IN_ROLE
        };
        this.handleChillerForm = this.handleChillerForm.bind(this);
        this.handleGeneralForm = this.handleGeneralForm.bind(this);
        this.handleEconomicForm = this.handleEconomicForm.bind(this);
        this.handleHeatForm = this.handleHeatForm.bind(this);

    }
    handleChillerForm (result)  {

        if (result.compressionChiller.chillerformMode == "add") {
            this.setState({
                compressionChilerStateChange: {
                    stateChange: result.state,
                    chillerRecord: this.state.compressionChilerStateChange.chillerRecord.concat(result.compressionChiller)
                }
            });
        } else {

            this.state.compressionChilerStateChange.chillerRecord[result.compressionChiller.chillerformModeKey] = result.compressionChiller
            this.forceUpdate()

        }
    }
    handleHeatForm (result)  {
        if(result.heatSource.heatsourceformMode=="add"){
            this.setState({heatSourceStateChange:{
                stateChange:result.state,
                heatSourceRecord:this.state.heatSourceStateChange.heatSourceRecord.concat(result.heatSource)
                }
});
        }else{
            this.state.heatSourceStateChange.heatSourceRecord[result.heatSource.heatsourceformModeKey]= result.heatSource
            this.forceUpdate()
        }


    }
    handleGeneralForm (result)  {
        this.setState({generalStateChange:{
                                            generalRecord:result.generalInformation,
                                            stateChange:result.state
                                          }
        });
    }
    handleEconomicForm (result)  {
        this.setState({economicStateChange:{
                                            economicRecord:result.economicInformation,
                                            stateChange:result.state
                                          }
        });
    }

    render() {
        console.log("adcalc render");
        projectData['chillerData'] = this.state.compressionChilerStateChange.chillerRecord;
        projectData['heatSourceData'] = this.state.heatSourceStateChange.heatSourceRecord;

        const tiles={
            general:{
                title: GENERAL_TILE,
                tileCls:'general-information data-box',
                required:"yes",
                edit:'yes',
                editCls:'edit-icon myBtn_multi',
                editIcon:'public/images/edit-icon.png',
                add:'no',
                hoverText:'We need the location to get the specific weather data.',
                mainClass:'col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4',
                hoverCls:'main-hover-box general-info-hover',
                priceLst:'no',
                priceData:{

                },
                rightpriceList:'no',
                rightpriceListeData:{

                },
                modalId:'#general-information'
            },
            Economic:{
                title:ECONOMIC_TITLE,
                tileCls:'economic-data data-box',
                required:"no",
                edit:'yes',
                editCls:'edit-icon myBtn_multi',
                editIcon:'public/images/edit-icon.png',
                add:'no',
                hoverText:'We need the location to get the specific weather data.',
                mainClass:'col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4',
                hoverCls:'main-hover-box economic-hover',
                priceLst:'no',
                priceData:{

                },
                rightpriceList:'no',
                rightpriceListeData:{

                },
                modalId:'#economic-information'
            },
            Options:{
                title:'Options',
                tileCls:'options data-box',
                required:"no",
                edit:'yes',
                editCls:'edit-icon myBtn_multi',
                editIcon:'public/images/edit-icon.png',
                add:'no',
                hoverText:'We need the location to get the specific weather data.',
                mainClass:'col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 disableCard',
                hoverCls:'main-hover-box options-hover',
                priceLst:'no',
                priceData:{

                },
                rightpriceList:'no',
                rightpriceListeData:{

                },
                modalId:'#compression-chiller'
            },
            HeatSource:{
                title:HEAT_SOURCE_TITLE,
                tileCls:'heat-sources data-box',
                required:"no",
                edit:'yes',
                editCls:'add-icon myBtn_multi',
                editIcon:'public/images/add-icon.png',
                add:'no',
                hoverText:'Define the available or planned heat sources so that the suggested Fahrenheit system would be suitable for those sources.',
                mainClass:'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6',
                hoverCls:'main-hover-box heat-sources-hover',
                priceLst:'no',
                priceData:{

                },
                rightpriceList:'no',
                rightpriceListeData:{

                },
                modalId:'#heat-source',
                multiple:true
            },
            HeatingLoadProfile:{
                title:'Heating Load Profile',
                tileCls:'heating-load-profiles data-box',
                required:"no",
                edit:'yes',
                editCls:'add-icon myBtn_multi',
                editIcon:'public/images/add-icon.png',
                add:'no',
                hoverText:'Choose one or more predefined heating load profiles and we will know how much heat will be available from your heat sources.<br />Are you planning a new heat source? Then we can calculate the profitability of the whole system!',
                mainClass:'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 disableCard',
                hoverCls:'main-hover-box heating-load-hover',
                priceLst:'no',
                priceData:{

                },
                rightpriceList:'no',
                rightpriceListeData:{

                },
                modalId:'#compression-chiller'
            },
            CompressionChiller:{
                title:CHILLER_TITLE,
                tileCls:'compression-chillers data-box',
                required:"no",
                edit:'yes',
                editCls:'add-icon myBtn_multi',
                editIcon:'public/images/add-icon.png',
                add:'no',
                hoverText:'Do you already have an existing compression chiller or you are planning to install a new one? Define your chillers and we will compare our system with yours.',
                mainClass:'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6',
                hoverCls:'main-hover-box compression-chillers-hover',
                priceLst:'no',
                priceData:{

                },
                rightpriceList:'no',
                rightpriceListeData:{

                },
                modalId:'#compression-chiller',
                multiple:true
            },
            CoolingLoadProfile:{
                title:'Cooling Load Profile',
                tileCls:'cooling-load-profiles data-box',
                required:"yes",
                edit:'yes',
                editCls:'add-icon myBtn_multi',
                editIcon:'public/images/add-icon.png',
                add:'no',
                hoverText:'Define your cooling load profile and require cooling capacity so we can suggest a syatem for you!',
                mainClass:'col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 disableCard',
                hoverCls:'main-hover-box cooling-load-hover',
                priceLst:'no',
                priceData:{

                },
                rightpriceList:'no',
                rightpriceListeData:{

                },
                modalId:'#compression-chiller'
            },
            FahrenheitSystem:{
                title:'Fahrenheit System',
                tileCls:'fahrenheit-system-box data-box',
                required:"no",
                edit:'yes',
                editCls:'add-icon myBtn_multi',
                editIcon:'public/images/add-icon.png',
                add:'no',
                hoverText:'Please provide the required inputs so we can suggest a Fahrenheit system for you.',
                mainClass:'col-md-12 col-sm-12 col-12 col-lg-4 col-xl-4 disableCard',
                hoverCls:'main-hover-box fahrenheit-system-hover',
                priceLst:'no',
                priceData:{

                },
                rightpriceList:'no',
                rightpriceListeData:{

                },
                modalId:'#compression-chiller'
            }

        }

        return (

            <div className="bootom-data-box">
                 <div className="row" >

                <Tiles
                title={tiles.general.title}
                required={tiles.general.required}
                edit={tiles.edit}
                mainclass={tiles.general.mainClass}
                tileCls={tiles.general.tileCls}
                required= {tiles.general.required}
                edit={tiles.general.edit}
                editCls={tiles.general.editCls}
                editIcon={tiles.general.editIcon}
                add={tiles.general.add}
                hoverText={tiles.general.hoverText}
                hoverCls={tiles.general.hoverCls}
                priceLst={tiles.general.priceLst}
                priceData={tiles.general.priceData}
                rightpriceList={tiles.general.rightpriceList}
                rightpriceListeData={tiles.general.rightpriceListeData}
                modalId={tiles.general.modalId}
                dataChange={this.state.generalStateChange.stateChange}
                dataRecord={this.state.generalStateChange.generalRecord}/>
                <Tiles
                title={tiles.Economic.title}
                required={tiles.Economic.required}
                edit={tiles.Economic.edit}
                mainclass={tiles.Economic.mainClass}
                tileCls={tiles.Economic.tileCls} required= {tiles.Economic.required}
                edit={tiles.Economic.edit}
                editCls={tiles.Economic.editCls}
                editIcon={tiles.Economic.editIcon}
                add={tiles.Economic.add}
                hoverText={tiles.Economic.hoverText}
                hoverCls={tiles.Economic.hoverCls}
                priceLst={tiles.Economic.priceLst}
                priceData={tiles.Economic.priceData}
                rightpriceList={tiles.Economic.rightpriceList}
                rightpriceListeData={tiles.Economic.rightpriceListeData}
                modalId={tiles.Economic.modalId}
                dataChange={this.state.economicStateChange.stateChange}
                dataRecord={this.state.economicStateChange.economicRecord} />
                <Tiles
                title={tiles.Options.title}
                required={tiles.Options.required}
                edit={tiles.Options.edit}
                mainclass={tiles.Options.mainClass}
                tileCls={tiles.Options.tileCls} required= {tiles.Options.required}
                edit={tiles.Options.edit}
                editCls={tiles.Options.editCls}
                editIcon={tiles.Options.editIcon}
                add={tiles.Options.add}
                hoverText={tiles.Options.hoverText}
                hoverCls={tiles.Options.hoverCls}
                priceLst={tiles.Options.priceLst}
                priceData={tiles.Options.priceData}
                rightpriceList={tiles.Options.rightpriceList}
                rightpriceListeData={tiles.Options.rightpriceListeData}
                modalId={tiles.general.modalId}
                dataChange={this.state.HeatSourceStateChange}/>
                 </div>
                 <div className="row">
                    <div className="col-md-12 col-sm-12 col-12 col-lg-8 col-xl-8">
                       <div className="row">
                        <Tiles  title={tiles.HeatSource.title}
                        required={tiles.HeatSource.required}
                        edit={tiles.HeatSource.edit}
                        mainclass={tiles.HeatSource.mainClass}
                        tileCls={tiles.HeatSource.tileCls} required= {tiles.HeatSource.required}
                        edit={tiles.HeatSource.edit}
                        editCls={tiles.HeatSource.editCls}
                        editIcon={tiles.HeatSource.editIcon}
                        add={tiles.HeatSource.add}
                        hoverText={tiles.HeatSource.hoverText}
                        hoverCls={tiles.HeatSource.hoverCls}
                        priceLst={tiles.HeatSource.priceLst}
                        priceData={tiles.HeatSource.priceData}
                        rightpriceList={tiles.HeatSource.rightpriceList}
                        rightpriceListeData={tiles.HeatSource.rightpriceListeData}
                        modalId={tiles.HeatSource.modalId}
                        dataChange={this.state.heatSourceStateChange.stateChange}
                        dataRecord={this.state.heatSourceStateChange.heatSourceRecord}
                        multiple={tiles.HeatSource.multiple}/>

                        <Tiles  title={tiles.HeatingLoadProfile.title}
                        required={tiles.HeatingLoadProfile.required}
                        edit={tiles.HeatingLoadProfile.edit}
                        mainclass={tiles.HeatingLoadProfile.mainClass}
                        tileCls={tiles.HeatingLoadProfile.tileCls} required= {tiles.HeatingLoadProfile.required}
                        edit={tiles.HeatingLoadProfile.edit}
                        editCls={tiles.HeatingLoadProfile.editCls}
                        editIcon={tiles.HeatingLoadProfile.editIcon}
                        add={tiles.HeatingLoadProfile.add}
                        hoverText={tiles.HeatingLoadProfile.hoverText}
                        hoverCls={tiles.HeatingLoadProfile.hoverCls}
                        priceLst={tiles.HeatingLoadProfile.priceLst}
                        priceData={tiles.HeatingLoadProfile.priceData}
                        rightpriceList={tiles.HeatingLoadProfile.rightpriceList}
                        rightpriceListeData={tiles.HeatingLoadProfile.rightpriceListeData}
                        modalId={tiles.general.modalId} />
                       </div>
                       <div className="row">
                        <Tiles  title={tiles.CompressionChiller.title}
                        required={tiles.CompressionChiller.required}
                        edit={tiles.CompressionChiller.edit}
                        mainclass={tiles.CompressionChiller.mainClass}
                        tileCls={tiles.CompressionChiller.tileCls} required= {tiles.CompressionChiller.required}
                        edit={tiles.CompressionChiller.edit}
                        editCls={tiles.CompressionChiller.editCls}
                        editIcon={tiles.CompressionChiller.editIcon}
                        add={tiles.CompressionChiller.add}
                        hoverText={tiles.CompressionChiller.hoverText}
                        hoverCls={tiles.CompressionChiller.hoverCls}
                        priceLst={tiles.CompressionChiller.priceLst}
                        priceData={tiles.CompressionChiller.priceData}
                        rightpriceList={tiles.CompressionChiller.rightpriceList}
                        rightpriceListeData={tiles.CompressionChiller.rightpriceListeData}
                        modalId={tiles.CompressionChiller.modalId}
                        dataChange={this.state.compressionChilerStateChange.stateChange}
                        dataRecord={this.state.compressionChilerStateChange.chillerRecord}
                        multiple={tiles.CompressionChiller.multiple} />

                        <Tiles  title={tiles.CoolingLoadProfile.title}
                        required={tiles.CoolingLoadProfile.required}
                        edit={tiles.CoolingLoadProfile.edit}
                        mainclass={tiles.CoolingLoadProfile.mainClass}
                        tileCls={tiles.CoolingLoadProfile.tileCls} required= {tiles.CoolingLoadProfile.required}
                        edit={tiles.CoolingLoadProfile.edit}
                        editCls={tiles.CoolingLoadProfile.editCls}
                        editIcon={tiles.CoolingLoadProfile.editIcon}
                        add={tiles.CoolingLoadProfile.add}
                        hoverText={tiles.CoolingLoadProfile.hoverText}
                        hoverCls={tiles.CoolingLoadProfile.hoverCls}
                        priceLst={tiles.CoolingLoadProfile.priceLst}
                        priceData={tiles.CoolingLoadProfile.priceData}
                        rightpriceList={tiles.CoolingLoadProfile.rightpriceList}
                        rightpriceListeData={tiles.CoolingLoadProfile.rightpriceListeData}
                        modalId={tiles.general.modalId}
                        dataChange={this.state.HeatSourceStateChange}/>
                       </div>
                    </div>
                    <Tiles  title={tiles.FahrenheitSystem.title}
                required={tiles.FahrenheitSystem.required}
                edit={tiles.FahrenheitSystem.edit}
                mainclass={tiles.FahrenheitSystem.mainClass}
                tileCls={tiles.FahrenheitSystem.tileCls} required= {tiles.FahrenheitSystem.required}
                edit={tiles.FahrenheitSystem.edit}
                editCls={tiles.FahrenheitSystem.editCls}
                editIcon={tiles.FahrenheitSystem.editIcon}
                add={tiles.FahrenheitSystem.add}
                hoverText={tiles.FahrenheitSystem.hoverText}
                hoverCls={tiles.FahrenheitSystem.hoverCls}
                priceLst={tiles.FahrenheitSystem.priceLst}
                priceData={tiles.FahrenheitSystem.priceData}
                rightpriceList={tiles.FahrenheitSystem.rightpriceList}
                rightpriceListeData={tiles.FahrenheitSystem.rightpriceListeData}
                modalId={tiles.general.modalId}
                dataChange={this.state.HeatSourceStateChange}/>
                 </div>
                 <ChillerModal role={this.props.role} onChillerSubmit={this.handleChillerForm} />
                 <GeneralModal role={this.props.role} onGeneralSubmit={this.handleGeneralForm} />
                 <EconomicModal role={this.props.role} onEconomicSubmit={this.handleEconomicForm} />
                 <HeatSourceModal role={this.props.role} onHeatSubmit={this.handleHeatForm} />


              </div>
        );
    }
}
