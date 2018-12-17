import { createStore } from "redux";
import Reducers from "../reducers/index";
let store = createStore(
	Reducers,
	window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
);
export default store;
