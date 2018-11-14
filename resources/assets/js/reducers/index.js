import { ADD_CHILLERS,ADD_GENERAL } from "../constants/action-types";
const initialState = {
  chillers: [],
  heatsources:[],
  generalData:[],
  economicData:[]
};
export const rootReducer = (state = initialState, action) => {
  switch (action.type) {
    case ADD_CHILLERS:
      state.chillers.push(action.payload);
      return state;
    case ADD_GENERAL:
      state.generalData.push(action.payload);
      return state;
    default:
      return state;
  }
};
