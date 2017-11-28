export function menuToggle() {
    const button = document.querySelector('.m-navButton');
    const menuItems = Array.from(document.querySelectorAll('.m-siteMenu__nav li'));

    function clickListener() {
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
    }

    function activateMenuItems() {
        menuItems.forEach((item) => {
            item.addEventListener('click', function () {
                item.classList.remove('is-current');
                this.classList.add('is-current');
            });
        });
    }

    if (button) clickListener();
    if (menuItems) activateMenuItems();
}
