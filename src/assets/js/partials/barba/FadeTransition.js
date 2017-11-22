import Barba from 'barba.js';
import { css, tween, easing } from 'popmotion';
import {
    setTop,
    addBodyLoadingClass,
    removeBodyLoadingClass,
    loadHeroImage,
} from '../helpers';

export default function fadeTransition() {
    const FadeTransition = Barba.BaseTransition.extend({
        start() {
            addBodyLoadingClass();
            this.oldContainerRenderer = css(this.oldContainer);
            this.oldContainerAnim = tween({
                from: 1,
                to: 0,
                duration: 300,
                ease: easing.linear,
                onUpdate: x => this.oldContainerRenderer.set('opacity', x),
            });

            Promise
                .all([this.newContainerLoading, this.fadeOut()])
                .then(this.fadeIn.bind(this));
        },
        fadeOut() {
            const deferred = Barba.Utils.deferred();
            this.oldContainerAnim.setProps({
                onComplete: () => {
                    setTimeout(() => {
                        deferred.resolve();
                    }, 200);
                },
            });
            this.oldContainerAnim.start();

            return deferred.promise;
        },
        fadeIn() {
            const el = this.newContainer;
            const _this = this;
            const elRenderer = css(el);
            const heroImage = document.querySelector('.m-article__heroImage');

            tween({
                from: 0,
                to: 1,
                duration: 300,
                ease: easing.linear,
                onUpdate: x => elRenderer.set('opacity', x),
                onStart: () => setTop(),
                onComplete: () => {
                    _this.done();
                    removeBodyLoadingClass();
                },
            }).start();

            if (heroImage) loadHeroImage(heroImage);
        },
    });
    return FadeTransition;
}
