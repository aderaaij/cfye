const breakpoints = {
    tablet: 768,
    desktopSmall: 1024,
    desktop: 1200,
};

function sizeTablet() {
    return window.matchMedia(`(max-width: ${(breakpoints.desktopSmall - 1)}px)`).matches;
}

function sizeDesktopSmall() {
    return window.matchMedia(`(min-width: ${(breakpoints.desktopSmall)}px)`).matches
    && window.matchMedia(`(max-width: ${breakpoints.desktop}px)`).matches;
}

export function sizeDesktop() {
    return window.matchMedia(`(min-width: ${(breakpoints.desktop)}px)`).matches;
}

export function mediaQueries() {
    if (window.matchMedia(`(max-width: ${(breakpoints.desktopSmall - 1)}px)`).matches) {
        return 'sizeTablet';
    } else if (
        window.matchMedia(`(min-width: ${(breakpoints.desktopSmall)}px)`).matches
        && window.matchMedia(`(max-width: ${breakpoints.desktop}px)`).matches
    ) {
        return 'sizeDesktopSmall';
    } else if (window.matchMedia(`(min-width: ${(breakpoints.desktop)}px)`).matches) {
        return 'sizeDesktop';
    }
    return 'sizeMobile';
}
