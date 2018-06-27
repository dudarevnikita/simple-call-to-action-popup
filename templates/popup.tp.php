<?php
/**
 * Template popup
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div id="simple-popup-<?php echo $id ?>" class="simple-popup-class hide popup-<?php echo $id . ' ' . $class ?>" data-event="<?php echo $event ?>" data-id="<?php echo $id ?>">
    <div class="simple-popup-wrap">
        <div class="close-wrap">
            <a href="#" class="close-button">
                <span></span>
            </a>
        </div>
        <div class="title" <?php echo $title_color ?>>
		    <?php echo $title ?>
        </div>
        <div class="content" <?php echo $content_color ?>>
		    <?php echo $content ?>
        </div>
    </div>
</div>