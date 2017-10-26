import pWaitFor from 'p-wait-for';
import { mediaQueries } from './mediaQueries';

const defaultConfig = {
    rootMargin: '0px',
    threshold: 0,
    load(element) {
        if (element.tagName === 'IMG') {
            if (element.dataset.src) {
                element.src = element.dataset.src;
            }
            if (element.dataset.srcset) {
                element.srcset = element.dataset.srcset;
            }
        } else {
            switch (mediaQueries()) {
            case 'sizeTablet':
                element.style.backgroundImage = `url(${element.dataset.srcSmall})`;
                break;
            case 'sizeDesktopSmall':
                element.style.backgroundImage = `url(${element.dataset.srcMedium})`;
                break;
            case 'sizeDesktop':
                element.style.backgroundImage = `url(${element.dataset.src})`;
                break;
            }
        }
    },
};

function removeDataAtrributes(element) {
    element.removeAttribute('data-src');
    element.removeAttribute('data-srcset');
}

function imageOnLoad(element) {
    element.classList.add('b-loaded');
    element.parentNode.classList.add('is-loaded');
    element.dataset.loaded = true;
    removeDataAtrributes(element);
}

function markAsLoaded(element) {
    if (navigator.onLine) {
        if (element.dataset.srcset) {
            pWaitFor(() => {
                if (element.currentSrc !== '') {
                    return true;
                }
                return false;
            }).then(() => {
                const imgLoad = new Image();
                imgLoad.onload = () => {
                    imageOnLoad(element);
                };
                imgLoad.src = element.currentSrc;
            });
        } else {
            const imgLoad = new Image();
            imgLoad.onload = () => {
                imageOnLoad(element);                
            };
            imgLoad.src = element.dataset.src;
        }
    } else {
        imageOnLoad(element);
    }
}

const isLoaded = element => element.dataset.loaded === 'true';

const onIntersection = load => (entries, observer) => {
    entries.forEach((entry) => {
        if (entry.intersectionRatio > 0) {
            observer.unobserve(entry.target);
            load(entry.target);
            markAsLoaded(entry.target);
        }
    });
};

export default function (selector = '.lozad', options = {}) {
    const { rootMargin, threshold, load } = { ...defaultConfig, ...options };
    let observer;

    if (window.IntersectionObserver) {
        observer = new IntersectionObserver(onIntersection(load), {
            rootMargin,
            threshold,
        });
    }

    return {
        observe() {
            const elements = Array.from(document.querySelectorAll(selector));
            for (let i = 0; i < elements.length; i++) {
                if (isLoaded(elements[i])) {
                    continue;
                }
                if (observer) {
                    observer.observe(elements[i]);
                    continue;
                }
                load(elements[i]);
                markAsLoaded(elements[i]);
            }
        },
    };
}
