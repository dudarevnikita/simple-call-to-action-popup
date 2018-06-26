<?php
/**
 * Template admin page
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">
    <h2><?php echo get_admin_page_title() ?></h2>

    <div class="wrap-block">
        <div class="settings-block">
            <h3><?php _e( 'This page in developing', 'simple-calltoaction-popup' ) ?></h3>
        </div>
        <div class="author-block">
            <div class="author">
                <span class="description"><?php _e( 'Author name:', 'simple-calltoaction-popup' ) ?></span> Nikita
                Dudarev
            </div>
            <div class="website">
                <span class="description"><?php _e( 'Site link:', 'simple-calltoaction-popup' ) ?></span> <a
                        href="https://dev-it.com.ua/"
                        target="_blank">https://dev-it.com.ua/</a>
            </div>
        </div>
    </div>
</div>