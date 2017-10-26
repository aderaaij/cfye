import Barba from 'barba.js';
import wrapImages from './wrapImages';
import headroom from './Header';
import LightboxSlider from './lightboxSlider';
import inView from './inView';
import lazyLoad from './lazyLoad';
import fadeTransition from './barba/FadeTransition';
import homeTransition from './barba/HomeTransition';
import { getParents } from './helpers';

let lastElementClicked;
let lastElementClickedParent;
let navElementClicked;

const pageSingle = document.querySelector('[data-namespace=single]');
const pageHome = document.querySelector('[data-namespace=home]');

if (pageSingle) {
    const heroImage = pageSingle.querySelector('.m-article__heroImage');
    const imageUrl = heroImage.getAttribute('data-src-large');
    const imgLoad = new Image();
    document.body.classList.remove('is-loading');
    imgLoad.onload = () => {
        heroImage.style.backgroundImage = `url(${imageUrl})`;
        document.body.classList.remove('is-loadingInit');
        document.body.classList.remove('is-loadingBar');
    };
    imgLoad.src = imageUrl;
} else {
    document.body.classList.remove('is-loadingInit');
}

Barba.Dispatcher.on('linkClicked', (el) => {
    lastElementClicked = el;
    lastElementClickedParent = getParents(lastElementClicked, 'article');
    navElementClicked = getParents(lastElementClicked, 'nav');
    document.body.classList.add('is-loadingBar');
});

document.addEventListener('DOMContentLoaded', () => {
    document.body.classList.remove('is-loadingBar');
    headroom.init();
    Barba.Pjax.getTransition = () => {
        let transitionObj = fadeTransition(lastElementClicked);
        if (lastElementClickedParent) {
            if (
                Barba.HistoryManager.prevStatus().namespace === 'home'
                && lastElementClickedParent[0]
            ) {
                transitionObj = homeTransition(lastElementClickedParent[0]);
            } else if (navElementClicked[0]) {
                return transitionObj;
            }
        }
        return transitionObj;
    };
    Barba.Pjax.start();
    Barba.Prefetch.init();
});

Barba.Dispatcher.on('initStateChange', () => {
    const lightbox = document.querySelector('.m-lightbox');
    if (lightbox) {
        lightbox.remove();
    }
});

Barba.Dispatcher.on('newPageReady', () => {
    const gallery = document.querySelector('.m-gallerySimple');
    if (gallery) {
        const lb = new LightboxSlider({
            selector: '.m-gallerySimple__link',
            lazyload: true,
        });
    }
    inView();
});

Barba.Dispatcher.on('transitionCompleted', (currentStatus, prevStatus, HTMLElementContainer, newPageRawHTML) => {
    // console.log(currentStatus, prevStatus, HTMLElementContainer, newPageRawHTML);
    wrapImages();
    const header = document.querySelector('.m-siteHeader');
    setTimeout(() => {
        header.classList.remove('headroom--autoscroll');
    }, 300);
    const observer = lazyLoad('img[data-src], .b-lazy', {
        threshold: 0.1,
        rootMargin: '100% 0%',
    });
    observer.observe();
});

// Prevent Barba.js from working on certain links
Barba.Pjax.originalPreventCheck = Barba.Pjax.preventCheck;
Barba.Pjax.preventCheck = (evt, element) => {
    if (!Barba.Pjax.originalPreventCheck(evt, element)) {
        return false;
    }
    // Prevent Barba.js on all links to /wp-admin/
    if (/.wp-admin/.test(element.href.toLowerCase())) {
        return false;
    }
    return true;
};
