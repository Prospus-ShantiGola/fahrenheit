import { ADD_HEAT_SOURCE } from "../constants/action-types";

const initialState = {
  data : [],
};

const reducer = (state = initialState, action) => {
  switch (action.type) {
    case ADD_HEAT_SOURCE:
    	return {
    		...state, 
    		data : [...state.data, action.payload]
    	};
    
    default:
      return state;
  }
};

export default reducer;