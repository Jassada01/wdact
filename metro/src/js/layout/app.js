"use strict";

// Class definition
var KTApp = function() {
    var initPageLoader =  function() {
        // CSS3 Transitions only after page load(.page-loading class added to body tag and remove with JS on page load)
        KTUtil.removeClass(document.body, 'page-loading');
    }

    var initBootstrapTooltips = function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var options = {};

        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            if (tooltipTriggerEl.hasAttribute('data-bs-delay-hide')) {
                options['delay'] = {hide: tooltipTriggerEl.getAttribute('data-bs-delay-hide')};
            }

            return new bootstrap.Tooltip(tooltipTriggerEl, options);
        });
    }

    var initBootstrapPopovers = function() {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var options = {};

        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            if (popoverTriggerEl.hasAttribute('data-bs-delay-hide')) {
                options['delay'] = {hide: popoverTriggerEl.getAttribute('data-bs-delay-hide')};
            }

            return new bootstrap.Popover(popoverTriggerEl, options);
        });
    }

    var initScrollSpy = function() {
        var elements = [].slice.call(document.querySelectorAll('[data-bs-spy="scroll"]'));

        elements.map(function (element) {
            var sel = element.getAttribute('data-bs-target');
            var offset = element.hasAttribute('data-bs-target-offset') ?  parseInt(element.getAttribute('data-bs-target-offset')) : 0;

            KTUtil.on(document.body,  element.getAttribute('data-bs-target') + ' [href]', 'click', function(e) {
                e.preventDefault();

                var el = document.querySelector(this.getAttribute('href'));

                KTUtil.scrollTo(el, offset);
            });
            
            var scrollContent = document.querySelector(element.getAttribute('data-bs-target'));
            var scrollSpy = bootstrap.ScrollSpy.getInstance(scrollContent);
            if (scrollSpy) {
                scrollSpy.refresh();
            }
        });
    }

    var initButtons = function() {
        var buttonsGroup = [].slice.call(document.querySelectorAll('[data-kt-buttons="true"]'));

        buttonsGroup.map(function (group) {
            var selector = group.hasAttribute('data-kt-buttons-target') ? group.getAttribute('data-kt-buttons-target') : '.btn';

            // Toggle Handler
            KTUtil.on(group, selector, 'click', function(e) {
                var buttons = [].slice.call(group.querySelectorAll(selector + '.active'));

                buttons.map(function (button) {
                    button.classList.remove('active');
                });

                this.classList.add('active');
            });
        });
    }   

    var initCheck = function() {
        // Toggle Handler
        KTUtil.on(document.body,  '[data-kt-check="true"]', 'change', function(e) {
            var check = this;
            var targets = document.querySelectorAll(check.getAttribute('data-kt-check-target'));

            KTUtil.each(targets, function (target) {
                if (target.type == 'checkbox') {
                    target.checked = check.checked;
                } else {
                    target.classList.toggle('active');
                }                
            });
        });
    }

    var initSelect2 = function() {
        var elements = [].slice.call(document.querySelectorAll('[data-control="select2"], [data-kt-select2="true"]'));
       
        elements.map(function (element) {
            var options = {
                dir: document.body.getAttribute('direction')
            };

            if ( element.getAttribute('data-hide-search') == 'true') {
                options.minimumResultsForSearch = Infinity;
            }
            
            $(element).select2(options);
        });
    }

    var initAutosize = function() {
        var inputs = [].slice.call(document.querySelectorAll('[data-kt-autosize="true"]'));
       
        inputs.map(function (input) {
            autosize(input);
        });
    }

    var initCountUp = function() {
        var elements = [].slice.call(document.querySelectorAll('[data-kt-countup="true"]:not(.counted)'));

        elements.map(function (element) {
            if (KTUtil.isInViewport(element) && KTUtil.visible(element) ) {
                var options = {};

                var value = element.getAttribute('data-kt-countup-value');
                value = parseFloat(value.replace(/,/,''));

                if (element.hasAttribute('data-kt-countup-start-val')) {
                    options.startVal = parseFloat(element.getAttribute('data-kt-countup-start-val'));
                }

                if (element.hasAttribute('data-kt-countup-duration')) {
                    options.duration = parseInt(element.getAttribute('data-kt-countup-duration'));
                }

                if (element.hasAttribute('data-kt-countup-decimal-places')) {
                    options.decimalPlaces = parseInt(element.getAttribute('data-kt-countup-decimal-places'));
                }

                if (element.hasAttribute('data-kt-countup-prefix')) {
                    options.prefix = element.getAttribute('data-kt-countup-prefix');
                }

                if (element.hasAttribute('data-kt-countup-suffix')) {
                    options.suffix = element.getAttribute('data-kt-countup-suffix');
                }

                var count = new countUp.CountUp(element, value, options);

                count.start();
                
                element.classList.add('counted');
            }                
        });
    }

    var initCountUpTabs = function() {
        // Initial call
        initCountUp();

        // Window scroll event handler
        window.addEventListener('scroll', initCountUp);

        // Tabs shown event handler
        var tabs = [].slice.call(document.querySelectorAll('[data-kt-countup-tabs="true"][data-bs-toggle="tab"]'));
        tabs.map(function (tab) {
            tab.addEventListener('shown.bs.tab', initCountUp);
        });        
    }

    var initTinySliders = function() {
        // Init Slider
        var initSlider = function(el) {
            if (!el) {
                return;
            }

            const tnsOptions = {};

            // Convert string boolean
            const checkBool = function(val) {
                if (val === 'true') {
                    return true;
                }
                if (val === 'false') {
                    return false;
                }
                return val;
            };

            // get extra options via data attributes
            el.getAttributeNames().forEach(function(attrName) {
                // more options; https://github.com/ganlanyuan/tiny-slider#options
                if ((/^data-tns-.*/g).test(attrName)) {
                    let optionName = attrName.replace('data-tns-', '').toLowerCase().replace(/(?:[\s-])\w/g, function(match) {
                        return match.replace('-', '').toUpperCase();
                    });
                    
                    if (attrName === 'data-tns-responsive') {
                        // fix string with a valid json
                        const jsonStr = el.getAttribute(attrName).replace(/(\w+:)|(\w+ :)/g, function(matched) {
                            return '"' + matched.substring(0, matched.length - 1) + '":';
                        });
                        try {
                            // convert json string to object
                            tnsOptions[optionName] = JSON.parse(jsonStr);
                        }
                        catch (e) {
                        }
                    }
                    else {
                        tnsOptions[optionName] = checkBool(el.getAttribute(attrName));
                    }
                }
            });

            const opt = Object.assign({}, {
                container: el,
                slideBy: 'page',
                autoplay: true,
                autoplayButtonOutput: false,
            }, tnsOptions);

            if (el.closest('.tns')) {
                KTUtil.addClass(el.closest('.tns'), 'tns-initiazlied');
            }

            return tns(opt);
        }

        // Sliders
        const elements = Array.prototype.slice.call(document.querySelectorAll('[data-tns="true"]'), 0);

        if (!elements && elements.length === 0) {
            return;
        }

        elements.forEach(function(el) {
            initSlider(el);
        });
    }

    return {
        init: function() {
            this.initPageLoader();

            this.initBootstrapTooltips();
            
            this.initBootstrapPopovers();
            
            this.initScrollSpy();
            
            this.initButtons();
            
            this.initCheck();
            
            this.initSelect2();
            
            this.initCountUp();

            this.initCountUpTabs();

            this.initAutosize();

            this.initTinySliders();
        },

        initPageLoader: function() {
            initPageLoader();
        },

        initBootstrapTooltips: function() {
            initBootstrapTooltips();
        },

        initBootstrapPopovers: function() {
            initBootstrapPopovers();
        },

        initScrollSpy: function() {
            initScrollSpy();
        },

        initButtons: function() {
            initButtons();
        },

        initCheck: function() {
            initCheck();
        },

        initSelect2: function() {
            initSelect2();
        },

        initCountUp: function() {
            initCountUp();
        },

        initCountUpTabs: function() {
            initCountUpTabs();
        },

        initAutosize: function() {
            initAutosize();
        },

        initTinySliders: function() {
            initTinySliders();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTApp.init();
});

// On window load
window.addEventListener("load", function() {
	KTApp.initPageLoader();
});

// Webpack support
if (typeof module !== 'undefined' && typeof module.exports !== 'undefined') {
    module.exports = KTApp;
}