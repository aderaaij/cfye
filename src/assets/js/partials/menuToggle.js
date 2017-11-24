export function menuToggle() {
    const button = document.querySelector('.m-navButton');
    const menu = document.querySelector('.m-siteMenu');
    const menuItems = Array.from(document.querySelectorAll('.m-siteMenu__nav li'));
    button.addEventListener('click', () => {
        document.body.classList.toggle('is-activeMenu');
        setTimeout(() => {
            menuItems.forEach((item, index) => {
                setTimeout(() => {
                    item.classList.toggle('is-active');
                }, index * 150);
            });
        }, 300);
    });

    menuItems.forEach((item) => {
        item.addEventListener('click', function () {
            item.classList.remove('is-current');
            this.classList.add('is-current');
        });
    });
}
