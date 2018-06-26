<?php
/**
 * Template metabox
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="submitbox" id="submitpost">

    <div id="minor-publishing">
        <div style="display:none;">
            <p class="submit">
                <input type="submit" name="save" id="save" class="button" value="Save">
            </p>
        </div>

        <div id="misc-publishing-actions">
            <div class="misc-pub-section curtime misc-pub-curtime">
                <span id="timestamp">
                    <?php
                    $date = date_i18n( __( 'M j, Y @ H:i' ), strtotime( $post->post_date ) );
                    printf( __( 'Published on: %s', 'simple-calltoaction-popup' ), '<b>' . $date . '</b>' );
                    ?>
                </span>
            </div>
        </div>

        <div class="clear"></div>
    </div>

    <div id="major-publishing-actions">
        <div id="publishing-action">
            <span class="spinner"></span>
            <input name="original_publish" type="hidden" id="original_publish" value="Publish">
            <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Publish">
        </div>
        <div class="clear"></div>
    </div>
</div>