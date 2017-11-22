/*
 * Wrap images which contain `alignleft` and `alignright` classes
 * and are next to each other into a `m-entryCollection` div
 * for styling purposes.
 */
export default function wrapImages() {
    const postImages = Array.from(document.querySelectorAll('.wp-caption'));

    if (postImages.length) {
        postImages
            .filter(item => item.classList.contains('alignleft'))
            .forEach((item) => {
                const nextElement = item.nextElementSibling;
                if (
                    nextElement.classList.contains('alignright')
                    || nextElement.classList.contains('alignleft')
                ) {
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('m-entryCollection');
                    wrapper.innerHTML = item.outerHTML;
                    item.parentNode.insertBefore(wrapper, item);
                    wrapper.appendChild(nextElement);
                    item.remove();
                }
            });
    }
}
