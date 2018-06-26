<?php
/**
 * Template metabox
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
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
    </div>

</div>