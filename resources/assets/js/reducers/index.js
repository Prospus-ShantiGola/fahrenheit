import { ADD_CHILLERS } from "../constants/action-types";
const initialState = {
  chillers: [],
  heatsources:[]
};
export const rootReducer = (state = initialState, action) => {
  switch (action.type) {
    case ADD_CHILLERS:
      state.chillers.push(action.payload);
      return state;
    default:
      return state;
  }
};
export default rootReducer;
