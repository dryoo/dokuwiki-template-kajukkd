! function(a) {
    "use strict";

    function b() {
        var a, b = document.createElement("fakeelement"),
            c = {
                transition: "transitionend",
                OTransition: "oTransitionEnd",
                MozTransition: "transitionend",
                WebkitTransition: "webkitTransitionEnd"
            }

        ;
        for (a in c)
            if (void 0 !== b.style[a]) return c[a]
    }

    function c(b) {
        var c = 0,
            d = 0;
        if (!b) var b = a.event;
        return b.pageX || b.pageY ? (c = b.pageX, d = b.pageY) : (b.clientX || b.clientY) && (c = b.clientX + document.body.scrollLeft + document.documentElement.scrollLeft, d = b.clientY + document.body.scrollTop + document.documentElement.scrollTop), {
            x: c,
            y: d
        }
    }

    function d(b) {
        var c = b.getBoundingClientRect(),
            d = document.body,
            e = document.documentElement,
            f = a.pageYOffset || e.scrollTop || d.scrollTop,
            g = a.pageXOffset || e.scrollLeft || d.scrollLeft,
            h = e.clientTop || d.clientTop || 0,
            i = e.clientLeft || d.clientLeft || 0,
            j = c.top + f - h,
            k = c.left + g - i;
        return {
            x: Math.round(k),
            y: Math.round(j)
        }
    }

    class e {
        constructor() {
            this.body = document.body, this.dokuwiki__site = document.querySelector("#dokuwiki__site"), this.toggle = document.querySelector("#mm-menu-toggle"), this.menu = document.querySelector("#mm-menu"), this.menuItems = this.menu.querySelectorAll("li"), this.menuItemLinks = this.menu.querySelectorAll("a"), this.menuPosition = "off", this.mask = document.createElement("div"), this.mask.className = "mm-menu-mask", document.body.appendChild(this.mask), this._init();
        }
        _init() {
            this._initToggleEvents(), this._initItemTransitions(), this._initTouchEffect(), this._initMaskEvents();
        }
        _initToggleEvents() {
            var a = this;
            this.toggle.addEventListener("click", function() {
                "off" == a.menuPosition ? a._toggleMenuOn() : a._toggleMenuOff();
            });
        }
        _toggleMenuOn() {
            var a = this;
            this.body.classList.add("mm-menu-open"), this.dokuwiki__site.classList.add("mm-menu-open"), this.toggle.classList.add("active"), this.menu.classList.add("active");
            for (var b = 0; b < a.menuItems.length; b++) {
                var c = a.menuItems[b];
                ! function(a) {
                    a.classList.add("in-view");
                }(c);
            }
            this.mask.classList.add("active"), this.menuPosition = "on";
        }
        _toggleMenuOff() {
            var a = this;
            this.body.classList.remove("mm-menu-open"), this.dokuwiki__site.classList.remove("mm-menu-open"), this.toggle.classList.remove("active"), this.menu.classList.remove("active");
            for (var b = 0; b < a.menuItems.length; b++) {
                var c = a.menuItems[b];
                ! function(a) {
                    a.classList.remove("in-view");
                }(c);
            }
            this.mask.classList.remove("active"), this.menuPosition = "off";
        }
        _initItemTransitions() {
            for (var a = this.menuItems.length, b = 0; a > b; b++) {
                var c = b + 1,
                    d = this.menuItems[b];
                this._itemTransitionHandler(d, c);
            }
        }
        _itemTransitionHandler(a, b) {
            a.classList.add("item-" + b);
        }
        _initTouchEffect() {
            for (var a = this.menuItemLinks.length, b = 0; a > b; b++) {
                var c = this.menuItemLinks[b];
                this._touchEffectHandler(c);
            }
        }
        _touchEffectHandler(a) {
            /*  var b = a.offsetWidth,
                  e = a.offsetHeight,
                  g = 2 * Math.max(b, e),
                  h = document.createElement("span");
              h.className = "mm-menu__link--touch-effect", h.style.width = g + "px", h.style.height = g + "px", a.insertBefore(h, a.firstChild), a.addEventListener("click", function(a) {
                  var b = c(a).x - d(this).x,
                      e = c(a).y - d(this).y;
                  h.style.top = e + "px", h.style.left = b + "px", h.style.marginTop = -(g / 2) + "px", h.style.marginLeft = -(g / 2) + "px", h.classList.add("animating");
              }), h.addEventListener(f, function() {
                  this.classList.remove("animating");
              }); */
        }
        _initMaskEvents() {
            var a = this;
            this.mask.addEventListener("click", function(b) {
                b.preventDefault(), "on" == a.menuPosition ? a._toggleMenuOff() : !1;
            });
        }
    }
    var f = b();
    a.Menu = e
}
(window);


var menu = new Menu;

/***
 * 
 * Auto - Hide top menu
 * 
 */
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if ((prevScrollpos > currentScrollPos) || (window.pageYOffset <= 0)) {
        document.getElementById("dokuwiki__header").style.top = "0";
    } else {
        document.getElementById("dokuwiki__header").style.top = "-50px";
    }
    prevScrollpos = currentScrollPos;
}
;

/**
 *  We handle several device classes based on browser width.
 *
 *  - desktop:   > __tablet_width__ (as set in style.ini)
 *  - mobile:
 *    - tablet   <= __tablet_width__
 *    - phone    <= __phone_width__
 */

var device_class = ''; // not yet known
var device_classes = 'desktop mobile tablet phone';

function tpl_dokuwiki_mobile() {

    // the z-index in mobile.css is (mis-)used purely for detecting the screen mode here
    var screen_mode = jQuery('#screen__mode').css('z-index') + '';

    // determine our device pattern
    // TODO: consider moving into dokuwiki core
    switch (screen_mode) {
        case '1':
            if (device_class.match(/tablet/)) return;
            device_class = 'mobile tablet';
            break;
        case '2':
            if (device_class.match(/phone/)) return;
            device_class = 'mobile phone';
            break;
        default:
            if (device_class == 'desktop') return;
            device_class = 'desktop';
    }

    jQuery('html').removeClass(device_classes).addClass(device_class);

    // handle some layout changes based on change in device
    var $handle = jQuery('#dokuwiki__aside h3.toggle');
    var $toc = jQuery('#dw__toc h3');

    if (device_class == 'desktop') {
        // reset for desktop mode
        if ($handle.length) {
            $handle[0].setState(1);
            $handle.hide();
        }
        if ($toc.length) {
            $toc[0].setState(1);
        }
    }
    if (device_class.match(/mobile/)) {
        // toc and sidebar hiding
        if ($handle.length) {
            $handle.show();
            $handle[0].setState(-1);
        }
        if ($toc.length) {
            $toc[0].setState(-1);
        }
    }
}

jQuery(function() {
    var resizeTimer;
    dw_page.makeToggle('#dokuwiki__aside h3.toggle', '#dokuwiki__aside div.content');

    tpl_dokuwiki_mobile();
    jQuery(window).on('resize',
        function() {
            if (resizeTimer) clearTimeout(resizeTimer);
            resizeTimer = setTimeout(tpl_dokuwiki_mobile, 200);
        }
    );



    // blur when clicked
    jQuery('#dokuwiki__pagetools div.tools>ul>li>a').on('click', function() {
        this.blur();
    });
});