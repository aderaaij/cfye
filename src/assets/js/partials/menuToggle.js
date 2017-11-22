import { action, spring, value, styler, tween, physics, easing, parallel } from 'popmotion';
// import timeline from 'popmotion-timeline';
// import { percent } from 'style-value-types';

const siteMenu = document.querySelector('.m-siteMenu');
const navButton = document.querySelector('.m-navButton');
const siteMenuRenderer = styler(siteMenu);

siteMenuRenderer.set({
    y: '-50%',
    rotateX: 20,
    perspective: 1000,
});

const positionTween = tween({
    from: { y: -50, opacity: 0, rotateX: 20 },
    to: { y: 0, opacity: 1, rotateX: 0 },
    duration: 600,
    ease: easing.anticipate,
});

console.log(siteMenuRenderer);

export default function menuToggle() {
    function toggle() {
        siteMenu.classList.toggle('is-active');
        document.body.classList.toggle('is-activeMenu');
        if (!document.body.classList.contains('is-activeMenu')) {
            // document.body.classList.add('is-activeMenu');
            positionTween.start({
                complete: () => console.log('w00t'),
                update: (values) => {
                    siteMenuRenderer.set('opacity', values.opacity);
                    siteMenuRenderer.set('y', `${values.y}%`);
                    siteMenuRenderer.set('rotateX', values.rotateX);
                },
            }).reverse();
        }
        console.log(positionTween.start())

        positionTween.start({
            complete: () => console.log('bla'),
            update: (values) => {
                siteMenuRenderer.set('opacity', values.opacity);
                siteMenuRenderer.set('y', `${values.y}%`);
                siteMenuRenderer.set('rotateX', values.rotateX);
            },
        });
    }
    if (navButton) {
        navButton.addEventListener('click', toggle, false);
    }
}
