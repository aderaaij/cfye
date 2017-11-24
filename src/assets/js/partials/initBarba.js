import Barba from 'barba.js';
import wrapImages from './wrapImages';
import headroom from './Header';
import LightboxSlider from './lightboxSlider';
import inView from './inView';
import lazyLoad from './lazyLoad';
import { menuToggle } from './menuToggle';
import fadeTransition from './barba/FadeTransition';
import homeTransition from './barba/HomeTransition';
import { getParents } from './helpers';

export default function initBarba() {
    let lastElementClicked;
    let lastElementClickedParent;
    let navElementClicked;

    /**
     * The user click on a link elegible for PJAX.
     * Arguments: HTMLElement, MouseEvent
     */
    Barba.Dispatcher.on('linkClicked', (el) => {
        lastElementClicked = el;
        [lastElementClickedParent] = getParents(lastElementClicked, 'article');
        [navElementClicked] = getParents(lastElementClicked, 'nav');
        document.body.classList.add('is-loadingBar');
    });

    /**
     * Start doing stuff on document.load
     */
    document.addEventListener('DOMContentLoaded', () => {
        document.body.classList.remove('is-loadingBar');
        headroom.init();
        menuToggle();
        Barba.Pjax.getTransition = () => {
            let transitionObj = fadeTransition(lastElementClicked);
            if (lastElementClickedParent) {
                if (
                    Barba.HistoryManager.prevStatus().namespace === 'home'
                    && lastElementClickedParent
                ) {
                    transitionObj = homeTransition(lastElementClickedParent);
                } else if (navElementClicked) {
                    return transitionObj;
                }
            }
            return transitionObj;
        };
        Barba.Pjax.start();
        Barba.Prefetch.init();
    });

    /**
     * The link has just been changed.
     * Remove lightBox from DOM if present
     * Arguments: currentStatus
     */
    Barba.Dispatcher.on('initStateChange', () => {
        const lightbox = document.querySelector('.m-lightbox');
        if (lightbox) lightbox.remove();
    });

    /**
     * The new container has been loaded and injected in the wrapper.
     * Arguments: currentStatus, prevStatus, HTMLElementContainer, newPageRawHTML
     */
    Barba.Dispatcher.on('newPageReady', () => {
        const gallery = document.querySelector('.m-gallerySimple');
        if (gallery) {
            const lb = new LightboxSlider({
                selector: '.m-gallerySimple__link',
                lazyload: true,
            });
        }

        /**
         * Call the inview function to trigger animations for blockquotes and such
         */
        inView();
    });

    /**
     * The transition has just finished and the old Container has been
     * removed from the DOM.
     * Arguments: currentStatus[, prevStatus]
     */
    Barba.Dispatcher.on('transitionCompleted', () => {
        const header = document.querySelector('.m-siteHeader');
        wrapImages();
        
        setTimeout(() => {
            header.classList.remove('headroom--autoscroll');
        }, 300);
        const observer = lazyLoad('img[data-src], .b-lazy', {
            threshold: 0.1,
            rootMargin: '100% 0%',
        });
        observer.observe();
    });

    /**
     * Prevent Barba.js from acting on specified links
     * /wp-admin/
     * Help: http://barbajs.org/faq.html
     */
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
}
