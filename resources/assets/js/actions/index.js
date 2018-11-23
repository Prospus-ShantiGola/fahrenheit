import { ADD_GENERAL,ADD_ECONOMIC,ADD_OPTION,ADD_HEATSOURCE, ADD_HEATINGPROFILE,ADD_COMPRESSIONCHILLER,ADD_COOLINGPROFILE,ADD_FAHRENHEIT} from "../constants/action-types";
export const addGeneralData = data => ({ type: ADD_GENERAL, payload: data });
export const addEconomicData = data => ({ type: ADD_ECONOMIC, payload: data });
export const addOptionData = data => ({ type: ADD_OPTION, payload: data });
export const addHeatSourceData = data => ({ type: ADD_HEATSOURCE, payload: data });
export const addHeatingProfileData = data => ({ type: ADD_HEATINGPROFILE, payload: data });
export const addCompressionChillerData = data => ({ type: ADD_COMPRESSIONCHILLER, payload: data });
export const addCoolingProfileData = data => ({ type: ADD_COOLINGPROFILE, payload: data });
export const addFahrenheitData = data => ({ type: ADD_FAHRENHEIT, payload: data });
