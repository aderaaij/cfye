import { getSiblings } from './helpers';

export default function articleFocus() {
    function articleFocusListener(e) {
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

    window.addEventListener('keydown', e => articleFocusListener(e));
    window.addEventListener('keyup', e => articleFocusListener(e));
}
