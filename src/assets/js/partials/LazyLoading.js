import Blazy from 'blazy';

const bLazy = new Blazy({
    success(ele) {
        ele.parentNode.classList.add('is-loaded');
        // Image has loaded
        // Do your business here
    },
    breakpoints: [{
        width: 500, // max-width
        src: 'data-src-small',
    },
    {
        width: 768, // max-width
        src: 'data-src-medium',
    }],
});

export default bLazy;
