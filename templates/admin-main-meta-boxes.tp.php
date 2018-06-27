<?php
/**
 * Template metabox
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//$custom = get_post_custom( $post->ID );
//$header_color = ( isset( $custom['header_color'][0] ) ) ? $custom['header_color'][0] : '';
?>
<div class="wrap">
    <div class="title-block wrap-block">
        <div class="title">
			<?php _e( 'Title popup', 'simple-calltoaction-popup' ) ?>
        </div>
        <input type="text" name="title" value="<?php echo $title ?>">
    </div>

    <div class="content-block wrap-block">
        <div class="title">
			<?php _e( 'Content popup', 'simple-calltoaction-popup' ) ?>
        </div>
        <textarea name="content" id="content-textarea" cols="30" rows="10"><?php echo $content ?></textarea>
    </div>

    <div class="event-block wrap-block">
        <div class="title">
			<?php _e( 'Select event', 'simple-calltoaction-popup' ) ?>
        </div>
        <div class="wrap-radio">
			<?php foreach ( $radio_buttons as $element => $values ): ?>
                <div class="radio-block">
                    <input type="radio" name="event"
                           value="<?php echo $element ?>" <?php echo $values['checked'] ?>> <?php echo $values['text'] ?>
                    <div class="radio-value <?php echo $element ?>-value" <?php echo $values['style'] ?>>
						<?php foreach ( $values['inputs'] as $index => $value ): ?>
							<?php echo $value['text'] . ' ' . $value['input'] ?>
						<?php endforeach; ?>
                    </div>
                </div>
			<?php endforeach; ?>
        </div>
        <div class="wrap-color">
            <div class="title">
				<?php _e( 'Select color for title', 'simple-calltoaction-popup' ) ?>
            </div>
            <input class="color-value-title" id="color_title" type="text" name="title_color"
                   value="<?php echo $color_picker['title_color'] ?>"/>
        </div>
        <div class="wrap-color">
            <div class="title">
				<?php _e( 'Select color for content', 'simple-calltoaction-popup' ) ?>
            </div>
            <input class="color-value-description" id="content_color" type="text" name="content_color"
                   value="<?php echo $color_picker['content_color'] ?>"/>
        </div>
    </div>

</div>