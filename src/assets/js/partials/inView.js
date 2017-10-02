const inView = function () {
    const options = {
        rootMargin: '50px',
        threshold: 1.0,
    };

    const callback = function (event) {
        console.log(event[0]);
        if (event[0].intersectionRect.bottom > 0) {
            console.log('test');
            event[0].target.classList.add('is-active');
        }
    };

    const quotes = Array.from(document.querySelectorAll('blockquote'));
    quotes.forEach((quote) => {
        const observer = new IntersectionObserver(callback, options);
        observer.observe(quote);
    });
};

export default inView;
