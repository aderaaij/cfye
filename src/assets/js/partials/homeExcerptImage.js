import { mediaQueries } from './mediaQueries';

export default function homeExcerptImage() {
    const article = document.querySelector('.m-articleExcerptHero');
    if (article) {
        const image = article.querySelector('.m-articleExcerptHero__image');
        const imageUrlLarge = image.getAttribute('data-src-large');
        const imageUrlMedium = image.getAttribute('data-src-medium');

        if (mediaQueries() === 'sizeTablet') {
            image.style.backgroundImage = `url(${imageUrlMedium})`;
        } else if (mediaQueries() === 'sizeDesktopSmall') {
            image.style.backgroundImage = `url(${imageUrlMedium})`;
        } else if (mediaQueries() === 'sizeDesktop') {
            image.style.backgroundImage = `url(${imageUrlLarge})`;
        }
    }
}