import 'intersection-observer';
import initBarba from './partials/initBarba';
import initViews from './partials/initViews';
import initServiceWorker from './partials/initServiceWorker';

/**
 * 👁️ Each page has loading animations that trigger only on first direct load
 * (so not with ajax)
 */
initViews();

/**
 * 🔥 Barba.js initialisation, used to ajaxify our theme
 * url: http://barbajs.org/
 */
initBarba();

/**
 * 👷🏽‍♀️Initialize a serviceworker
 */
initServiceWorker();
