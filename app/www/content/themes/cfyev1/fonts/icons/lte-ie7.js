/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'cfye-icons\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-CFYE_NEW' : '&#xe001;',
			'icon-menu' : '&#xe000;',
			'icon-menu-2' : '&#xe002;',
			'icon-facebook' : '&#xe003;',
			'icon-twitter' : '&#xe004;',
			'icon-soundcloud' : '&#xe005;',
			'icon-flickr' : '&#xe006;',
			'icon-vimeo' : '&#xe007;',
			'icon-youtube' : '&#xe008;',
			'icon-film' : '&#xe009;',
			'icon-linkedin' : '&#xe00a;',
			'icon-pinterest' : '&#xe00b;',
			'icon-tumblr' : '&#xe00c;',
			'icon-earth' : '&#xe00d;',
			'icon-location' : '&#xe00e;',
			'icon-location-2' : '&#xe00f;',
			'icon-user' : '&#xe010;',
			'icon-speaker' : '&#xf372;',
			'icon-play' : '&#xe011;',
			'icon-pause' : '&#xe012;',
			'icon-stop' : '&#xe013;',
			'icon-folder-open' : '&#xe014;',
			'icon-tags' : '&#xe015;',
			'icon-quotes-right' : '&#xe016;',
			'icon-quotes-right-2' : '&#xe017;',
			'icon-angle-left' : '&#xf104;',
			'icon-angle-right' : '&#xf105;',
			'icon-angle-up' : '&#xf106;',
			'icon-angle-down' : '&#xf107;',
			'icon-share' : '&#xe018;',
			'icon-camera' : '&#xe019;',
			'icon-expand' : '&#xe01a;',
			'icon-search' : '&#xe01b;',
			'icon-envelop' : '&#xe01c;',
			'icon-menu-3' : '&#xe01d;',
			'icon-megaphone' : '&#xe01e;',
			'icon-paint-format' : '&#xe01f;',
			'icon-pencil' : '&#xe020;',
			'icon-newspaper' : '&#xe021;',
			'icon-calendar' : '&#xe022;',
			'icon-google-plus' : '&#xe023;',
			'icon-eye' : '&#xe024;',
			'icon-book' : '&#xe025;',
			'icon-instagram' : '&#xe026;',
			'icon-radio-checked' : '&#xe027;',
			'icon-radio-unchecked' : '&#xe028;',
			'icon-batman' : '&#xf348;',
			'icon-paper-plane' : '&#xe029;',
			'icon-paypal' : '&#xe02a;',
			'icon-shoppingbag' : '&#xf273;',
			'icon-checkbox-checked' : '&#xe02b;',
			'icon-checkbox-unchecked' : '&#xe02c;',
			'icon-spinner' : '&#xe02d;',
			'icon-spinner-2' : '&#xe02e;',
			'icon-thumbs-up' : '&#xe02f;',
			'icon-new-tab' : '&#xe030;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};