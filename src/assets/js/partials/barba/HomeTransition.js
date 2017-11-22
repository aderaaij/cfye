import Barba from 'barba.js';
import { css, tween, easing, parallel } from 'popmotion';
import {
    getPosition,
    scrollIt, setTop,
    addBodyLoadingClass,
    removeBodyLoadingClass,
    getBackgroundImageUrl,
    loadHeroImage,
} from '../helpers';

const breakpoints = {
    tablet: 768,
    desktopSmall: 1024,
    desktop: 1200,
};

function sizeTablet() {
    return window.matchMedia(`(max-width: ${(breakpoints.desktopSmall - 1)}px)`).matches;
}

function sizeDesktopSmall() {
    return window.matchMedia(`(min-width: ${(breakpoints.desktopSmall)}px)`).matches
    && window.matchMedia(`(max-width: ${breakpoints.desktop}px)`).matches;
}

function sizeDesktop() {
    return window.matchMedia(`(min-width: ${(breakpoints.desktop)}px)`).matches;
}

function scrollToLocation(element) {
    const intElemScrollTop = document.body.scrollTop || document.documentElement.scrollTop;
    const elY = getPosition(element).y;
    if (elY === 0 && intElemScrollTop === 0) {
        return (elY + intElemScrollTop);
    }
    return (elY + intElemScrollTop) - 50;
}

function prepareHeader() {
    const header = document.querySelector('.m-siteHeader');
    header.classList.remove('headroom--unpinned');
    header.classList.add('headroom--autoscroll');
}

export default function homeTransition(element) {
    const HomeTransitionHero = Barba.BaseTransition.extend({
        start() {
            const elImageFrom = ((sizeDesktopSmall()) ? 50 : 55);
            const elImage = element.querySelector('.m-articleExcerptHero__imageWrap');
            const elContent = element.querySelector('.m-articleExcerptHero__content');
            const elContentRenderer = css(elContent);
            const elImageRenderer = css(elImage);
            const elRenderer = css(element);
            addBodyLoadingClass();
            this.heroHeight = tween({
                from: ((100 / 3) * 2),
                to: 100,
                duration: 600,
                ease: easing.anticipate,
                onUpdate: x => elRenderer.set('height', `calc(${x}vh - 50px)`),
            });
            this.heroContentAnim = tween({
                to: 100,
                duration: 600,
                ease: easing.anticipate,
                onUpdate: x => elContentRenderer.set('x', `${x}%`),
            });
            this.heroImageAnim = tween({
                from: elImageFrom,
                to: 100,
                duration: 600,
                ease: easing.anticipate,
                onUpdate: x => elImageRenderer.set('width', `${x}vw`),
            });
            this.heroImageOpacity = tween({
                from: 1,
                to: 0,
                duration: 300,
                ease: easing.anticipate,
                onUpdate: x => elImageRenderer.set('opacity', x),
            });

            Promise
                .all([this.newContainerLoading, this.fadeOut()])
                .then(this.fadeIn.bind(this));
        },
        fadeOut() {
            const deferred = Barba.Utils.deferred();
            prepareHeader();
            scrollIt(
                scrollToLocation(element), 300, 'easeOutQuad',
                () => {
                    if (sizeTablet()) {
                        this.heroHeight.setProps({
                            onComplete: () => deferred.resolve(),
                        });
                        this.heroHeight.start();
                    } else {
                        parallel([
                            this.heroImageAnim,
                            this.heroContentAnim,
                        ], {
                            onComplete: () => {
                                this.heroImageOpacity.start();
                                deferred.resolve();
                            },
                        }).start();
                    }
                },
            );

            return deferred.promise;
        },

        fadeIn() {
            const el = this.newContainer;
            el.style.visibility = 'visible';
            removeBodyLoadingClass();
            setTop();
            this.done();
        },
    });

    const HomeTransitionDefault = Barba.BaseTransition.extend({
        start() {
            addBodyLoadingClass();
            document.body.classList.add('is-loading--articleExcerpt');
            const heroImageEl = element.querySelector('.m-articleExcerpt__image');
            this.heroImageUrl = getBackgroundImageUrl(heroImageEl);
            this.oldContainerRenderer = css(this.oldContainer);
            this.oldContainerAnim = tween({
                from: 1,
                to: 0,
                duration: 300,
                ease: easing.easeOut,
                onUpdate: x => this.oldContainerRenderer.set('opacity', x),
            });

            Promise
                .all([this.newContainerLoading, this.fadeOut()])
                .then(this.fadeIn.bind(this));
        },
        fadeOut() {
            const deferred = Barba.Utils.deferred();
            prepareHeader();
            scrollIt(
                scrollToLocation(element), 300, 'linear',
                () => {
                    this.oldContainerAnim.setProps({
                        onComplete: () => {
                            setTimeout(() => {
                                deferred.resolve();
                            }, 200);
                        },
                    });
                    this.oldContainerAnim.start();
                },
            );

            return deferred.promise;
        },
        fadeIn() {
            const el = this.newContainer;
            const _this = this;
            const elRenderer = css(el);
            const heroImage = document.querySelector('.m-article__heroImage');
            heroImage.style.backgroundImage = `url(${this.heroImageUrl})`;

            const fadeIn = tween({
                from: 0,
                to: 1,
                duration: 300,
                ease: easing.easeIn,
                onUpdate: x => elRenderer.set('opacity', x),
                onStart: () => setTop(),
                onComplete: () => {
                    _this.done();
                    document.body.classList.remove('is-loading--articleExcerpt');
                    document.body.classList.remove('is-loading');
                },
            });
            fadeIn.start();
            loadHeroImage(heroImage);
        },
    });
    
    if (element && element.classList.contains('m-articleExcerptHero')) {
        return HomeTransitionHero;
    }
    return HomeTransitionDefault;
}
