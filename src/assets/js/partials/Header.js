import Headroom from 'headroom.js';

const header = document.querySelector('.m-siteHeader');
const headroom = new Headroom(header, {
    offset: 60,
});
headroom.init();
