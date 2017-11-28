const pageSingle = document.querySelector('[data-namespace=single]');
const pageHome = document.querySelector('[data-namespace=home]');

/**
 * Toggle classes and load image of a single page
 */
function initPageSingle() {
    const heroImage = pageSingle.querySelector('.m-article__heroImage');
    
    if (heroImage) {
        const imageUrl = heroImage.getAttribute('data-src-large');
        const imgLoad = new Image();
        document.body.classList.remove('is-loading');
        imgLoad.onload = () => {
            heroImage.style.backgroundImage = `url(${imageUrl})`;
            document.body.classList.remove('is-loadingInit');
            document.body.classList.remove('is-loadingBar');
        };
        imgLoad.src = imageUrl;
    }
}

/**
 * Toggle classes for a default page
 */
function initPageDefault() {
    document.body.classList.remove('is-loadingInit');
}

export default function initViews() {
    if (pageSingle) {
        initPageSingle();
    } else {
        initPageDefault();
    }
}
