import { ADD_CHILLER ,ADD_GENERAL } from "../constants/action-types";

const initialState = {
  data : [],
};

const reducer = (state = initialState, action) => {
  switch (action.type) {
    case ADD_CHILLER:
    	return {
    		...state, 
    		data : [...state.data, action.payload]
    	};
    
    default:
      return state;
  }
};

export default reducer;