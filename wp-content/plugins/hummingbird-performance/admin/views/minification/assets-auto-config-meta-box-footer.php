<?php
/**
 * Asset optimization auto configuration meta box footer.
 *
 * @since 2.6.0
 * @package Hummingbird
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="sui-actions-right">
	<button type="button" class="sui-button sui-button-blue" onclick="WPHB_Admin.minification.saveAutoSettings( this )" aria-live="polite">
		<span class="sui-button-text-default">
			<?php esc_html_e( 'Publish changes', 'wphb' ); ?>
		</span>

		<span class="sui-button-text-onload">
			<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			<?php esc_html_e( 'Saving settings', 'wphb' ); ?>
		</span>
	</button>
</div>
