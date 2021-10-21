<?php
/**
 * Header part for both auto and manual AO.
 *
 * @since 2.6.0
 * @package Hummingbird
 *
 * @var string $type  Optimization type. Accepts: 'advanced' and 'basic'.
 */

?>

<p class="sui-margin-bottom">
	<?php esc_html_e( 'Optimizing your assets will compress and organize them in a way that improves page load times. You can choose to use our automated options, or manually configure each file yourself.', 'wphb' ); ?>
</p>

<div class="sui-actions" style="float: right">
	<small>
		<a href="#" id="wphb-<?php echo esc_attr( $type ); ?>-hdiw-link" data-modal-open="<?php echo 'advanced' === $type ? 'manual-ao-hdiw-modal-content' : 'automatic-ao-hdiw-modal-content'; ?>" data-modal-mask="true">
			<?php esc_html_e( 'How Does it Work?', 'wphb' ); ?>
		</a>
	</small>
</div>

<div class="sui-side-tabs">
	<div class="sui-tabs-menu">
		<label id="wphb-ao-auto-label" for="wphb-ao-auto" class="sui-tab-item <?php echo 'basic' === $type ? 'active' : ''; ?>">
			<input type="radio" name="asset_optimization_mode" value="auto" id="wphb-ao-auto" <?php checked( $type, 'basic' ); ?>>
			<?php esc_html_e( 'Automatic', 'wphb' ); ?>
		</label>
		<label id="wphb-ao-manual-label" for="wphb-ao-manual" class="sui-tab-item <?php echo 'advanced' === $type ? 'active' : ''; ?>">
			<input type="radio" name="asset_optimization_mode" value="manual" id="wphb-ao-manual" <?php checked( $type, 'advanced' ); ?>>
			<?php esc_html_e( 'Manual', 'wphb' ); ?>
		</label>
	</div>
</div>
