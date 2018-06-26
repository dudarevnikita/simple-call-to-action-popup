;var POPUP_OBJ = POPUP_OBJ || {};

POPUP_OBJ.event = {
    copy_shortcode_element: jQuery('#view_shortcode .shortcode input'),
    copy_shortcode: function () {
        POPUP_OBJ.event.copy_shortcode_element.click(function () {
            console.log(jQuery(this));
            jQuery(this)[0].focus();
            jQuery(this).select();
            document.execCommand('copy');
        });
    },
    show_radio_value: function () {
        jQuery('#main_boxes .event-block .wrap-radio input[type="radio"]').click(function(){
            let value = jQuery(this).val();

            if (value == 'click') {
                jQuery('#main_boxes .event-block .wrap-radio .click-value').show();
                jQuery('#main_boxes .event-block .wrap-radio .once-value').hide();
            }

            if (value == 'once') {
                jQuery('#main_boxes .event-block .wrap-radio .once-value').show();
                jQuery('#main_boxes .event-block .wrap-radio .click-value').hide();
            }


        });
    }
}

jQuery(document).ready(function () {
    POPUP_OBJ.event.copy_shortcode();
    POPUP_OBJ.event.show_radio_value();
});