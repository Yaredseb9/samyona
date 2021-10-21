<?php
/**
 * Auto optimization box header.
 *
 * @since 2.6.0
 * @package Hummingbird
 *
 * @var string $type        Build for this type. Accepts: 'speedy' and 'basic'.
 * @var string $view        Selected optimization view. Accepts: 'speedy' and 'basic'.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="sui-box-header">
	<span class="wphb-ao-type-icon">
		<?php if ( 'speedy' === $type ) : ?>
			<i class="sui-icon-hummingbird" aria-hidden="true"></i>
		<?php else : ?>
			<i class="sui-icon-speed-optimize" aria-hidden="true"></i>
		<?php endif; ?>
	</span>
	<div class="wphb-ao-type-title">
		<?php if ( 'speedy' === $type ) : ?>
			<strong><?php esc_html_e( 'Speedy', 'wphb' ); ?></strong>
			<span class="sui-tag sui-tag-sm"><?php esc_html_e( 'Recommended', 'wphb' ); ?></span>
			<small><?php esc_html_e( 'Automatically optimize and compress all files.', 'wphb' ); ?></small>
		<?php else : ?>
			<strong><?php esc_html_e( 'Basic', 'wphb' ); ?></strong>
			<small><?php esc_html_e( 'Apply basic compression to all files.', 'wphb' ); ?></small>
		<?php endif; ?>
	</div>
	<div class="sui-actions-right">
		<label for="wphb-<?php echo esc_attr( $type ); ?>-toggle" class="sui-toggle">
			<input type="checkbox" data-type="<?php echo esc_attr( $type ); ?>" name="wphb-auto-toggle" id="wphb-<?php echo esc_attr( $type ); ?>-toggle" <?php checked( $view, $type ); ?>>
			<span class="sui-toggle-slider" aria-hidden="true"></span>
		</label>
	</div>
</div>
