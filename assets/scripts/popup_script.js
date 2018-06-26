;var POPUP_OBJ_FRONTEND = POPUP_OBJ_FRONTEND || {};

POPUP_OBJ_FRONTEND.event = {
    popup_element: jQuery('.simple-popup-class').data('id'),
    bootstrap: function () {
        this.show_popup();
        this.hide_popup();
        this.hover_button();
    },
    hide_popup: function () {
        jQuery('#simple-popup-' + POPUP_OBJ_FRONTEND.event.popup_element + ' a.close-button').click(function (e) {
            e.preventDefault();
            jQuery('#simple-popup-' + POPUP_OBJ_FRONTEND.event.popup_element).fadeOut(100);
            setTimeout(function () {
                jQuery('#simple-popup-' + POPUP_OBJ_FRONTEND.event.popup_element).addClass("hide");
            }, 150);
        });

        jQuery(window).on('click', function (e) {
            let target = e.target;
            if (jQuery(target).hasClass("simple-popup-class")) {
                jQuery('#simple-popup-' + POPUP_OBJ_FRONTEND.event.popup_element).fadeOut(100);
                setTimeout(function () {
                    jQuery('#simple-popup-' + POPUP_OBJ_FRONTEND.event.popup_element).addClass("hide");
                }, 150);
            }
        })
    },
    show_popup: function () {
        if (typeof show_seconds !== 'undefined') {
            setTimeout(function () {
                jQuery('#simple-popup-' + POPUP_OBJ_FRONTEND.event.popup_element)
                    .css("display", "flex")
                    .hide()
                    .fadeIn(300, function () {
                        jQuery(this).removeClass("hide")
                    });
            }, show_seconds)
        }

        if (typeof button_id !== 'undefined') {
            jQuery('a#' + button_id).click(function (e) {
                e.preventDefault();
                jQuery('#simple-popup-' + POPUP_OBJ_FRONTEND.event.popup_element)
                    .css("display", "flex")
                    .hide()
                    .fadeIn(300, function () {
                        jQuery(this).removeClass("hide")
                    });
            })
        }
    },
    hover_button: function () {
        jQuery('#simple-popup-' + POPUP_OBJ_FRONTEND.event.popup_element + ' a.close-button').hover(function () {
            jQuery(this).addClass("hover-class");
        }, function () {
            jQuery(this).removeClass("hover-class");
        });
    }
};


jQuery(document).ready(function () {
    POPUP_OBJ_FRONTEND.event.bootstrap();
});