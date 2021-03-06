import { ADD_COOLING_PROFILE } from "../constants/action-types";

const initialState = {
  data : [],
};

const reducer = (state = initialState, action) => {
  switch (action.type) {
    case ADD_COOLING_PROFILE:
    	return {
    		...state, 
    		data : [...state.data, action.payload]
    	};
    default:
      return state;
  }
};

export default reducer;