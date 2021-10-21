<?php
/**
 * Asset optimization auto configuration meta box header.
 *
 * @since 2.6.0
 * @package Hummingbird
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<h3 class="sui-box-title"><?php esc_html_e( 'Configurations', 'wphb' ); ?></h3>

<div class="sui-actions-right">
	<button type="button" class="sui-button sui-button-ghost" onclick="WPHB_Admin.minification.resetAutoSettings( this )" aria-live="polite">
		<span class="sui-button-text-default">
			<i class="sui-icon-undo" aria-hidden="true"></i>
			<?php esc_html_e( 'Reset settings', 'wphb' ); ?>
		</span>

		<span class="sui-button-text-onload">
			<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			<?php esc_html_e( 'Resetting settings', 'wphb' ); ?>
		</span>
	</button>
</div>
