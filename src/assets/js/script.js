import 'intersection-observer';
import './partials/Header';
import './partials/barbaConfig';
import { getSiblings } from './partials/helpers';


function articleFocus(e) {
    if (e.key === 'Tab') {
        const el = document.activeElement;
        const siblings = getSiblings(el.parentElement);
        siblings
            .filter(item => item.tagName === 'ARTICLE')
            .forEach((article) => {
                article.classList.add('is-inActive');
                el.parentElement.classList.remove('is-inActive');
            });
    }
}
window.addEventListener('keydown', (e) => {
    articleFocus(e);
});

window.addEventListener('keyup', (e) => {
    articleFocus(e);
});

if ('serviceWorker' in navigator) {
    // register the Service Worker, must be in the root directory to have site-wide scope...
    navigator.serviceWorker.register('/service-worker.js')
        .then((registration) => {
            // registration succeeded :-)
            // console.log('ServiceWorker registration succeeded, with this scope: ', registration.scope);
            // you may occasionally need to clear a service worker; this is the only way i've found to do that...
            // comment this out while not using it
            /* registration.unregister().then(function(boolean) {
              //  // if boolean = true, unregister is successful
                console.log('ServiceWorker unregistered');
            }); */
        }).catch((err) => {
            // registration failed :-(
            console.log('ServiceWorker registration failed: ', err);
        });
}
