import Barba from 'barba.js';

export default function fadeTransition(elementClicked) {
    const FadeTransition = Barba.BaseTransition.extend({
        start() {
            Promise
                .all([this.newContainerLoading, this.fadeOut()])
                .then(this.fadeIn.bind(this));
        },
        fadeOut() {
            const deferred = Barba.Utils.deferred();
            deferred.resolve();
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
    return FadeTransition;
}
