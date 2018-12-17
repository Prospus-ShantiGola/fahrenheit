import { combineReducers } from 'redux';

import chillers from './chillers';
import heatSources from './heat-sources';
import heatingLoadingProfiles from './heating-profiles';
import coolingLoadingProfiles from './cooling-profiles';

export default combineReducers({
  chillers : chillers,
  heatSources : heatSources,
  heatingLoadingProfiles : heatingLoadingProfiles,
  coolingLoadingProfiles : coolingLoadingProfiles,
});
