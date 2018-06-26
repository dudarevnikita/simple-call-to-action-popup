<?php
/**
 * Template shortcode view
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="wrap">

    <div class="shortcode">
		<?php if ( $post->post_status == 'publish' ): ?>
            <input type="text" value="<?php echo '[simple_popup id=&quot;' . $post->ID . '&quot;]' ?>" readonly>
		<?php else: ?>
            <input type="text" value="" readonly>
		<?php endif; ?>
    </div>
</div>
