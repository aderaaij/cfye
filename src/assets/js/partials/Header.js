import Headroom from 'headroom.js';

const header = document.querySelector('.m-siteHeader');
header.classList.add('is-active');

const headroom = new Headroom(header, {
    offset: 60,
});

export default headroom;
