import Barba from 'barba.js';
import getPosition, { scrollIt, getParents } from './helpers';
import wrapImages from './wrapImages';
import headroom from './Header';
import LightboxSlider from './lightboxSlider';
import inView from './inView';
import lazyLoad from './lazyLoad';

let lastElementClicked;
const FadeTransition = Barba.BaseTransition.extend({
    start() {
        this.linkClicked = lastElementClicked;
        Promise
            .all([this.newContainerLoading, this.fadeOut()])
            .then(this.fadeIn.bind(this));
    },
    fadeOut() {
        const deferred = Barba.Utils.deferred();
        const articleExcerpt = getParents(this.linkClicked, '.m-articleExcerpt');
        const header = document.querySelector('.m-siteHeader');
        if (articleExcerpt.length) {
            const elY = getPosition(articleExcerpt[0]).y;
            const intElemScrollTop = document.body.scrollTop || document.documentElement.scrollTop;
            header.classList.remove('headroom--unpinned');
            header.classList.add('headroom--autoscroll');
            scrollIt(
                (elY + intElemScrollTop) - 50,
                300,
                'easeOutQuad',
                () => {
                    this.oldContainer.style.opacity = 0;
                    setTimeout(() => {
                        deferred.resolve();
                    }, 300);
                },
            );
        } else {
            deferred.resolve();
        }
        return deferred.promise;
    },

    fadeIn() {
        const _this = this;
        const el = this.newContainer;
        el.style.opacity = 0;
        el.style.visibility = 'visible';
        setTimeout(() => {
            el.style.opacity = 1;
        }, 300);
        setTimeout(() => {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            _this.done();
        }, 300);
    },

    finish() {
        this.done();
    },
});

document.addEventListener('DOMContentLoaded', () => {    
    headroom.init();
    Barba.Pjax.getTransition = () => FadeTransition;
    Barba.Pjax.start();
    Barba.Prefetch.init();
});

Barba.Dispatcher.on('linkClicked', (el) => {
    lastElementClicked = el;
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
    console.log(currentStatus, prevStatus, HTMLElementContainer);
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

Barba.Pjax.originalPreventCheck = Barba.Pjax.preventCheck;

Barba.Pjax.preventCheck = (evt, element) => {
    if (!Barba.Pjax.originalPreventCheck(evt, element)) {
        return false;
    }

    if (/.wp-admin/.test(element.href.toLowerCase())) {
        return false;
    }
    return true;
};
