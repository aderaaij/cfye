import Headroom from 'headroom.js';

const header = document.querySelector('.m-siteHeader');
const headroom = new Headroom(header, {
    offset: 60,
});
headroom.init();

// const observer = new IntersectionObserver((entry) => {
//     console.log
//     if (entry.intersectionRatio > 0) {
//         entry.target.classList.add('fancy');
//     } else {
//         entry.target.classList.remove('fancy');
//     }
// });
