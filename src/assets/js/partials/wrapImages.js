export default function wrapImages() {
    const postImages = Array.from(document.querySelectorAll('.wp-caption'));
    postImages.forEach((image) => {
        const nextElement = image.nextElementSibling;
        if (image.classList.contains('alignleft')) {
            if (
                nextElement.classList.contains('alignright')
                || nextElement.classList.contains('alignleft')
            ) {
                const wrapper = document.createElement('div');
                wrapper.classList.add('m-contentCollection');
                wrapper.innerHTML = image.outerHTML;
                image.parentNode.insertBefore(wrapper, image);
                wrapper.appendChild(nextElement);
                // nextElement.remove();
                image.remove();
            }
        }
    });
}
