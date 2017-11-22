import 'intersection-observer';
import barbaInit from './partials/barbaConfig';
import initViews from './partials/initViews';
import initServiceWorker from './partials/initServiceWorker';

initViews();
barbaInit();
initServiceWorker();
