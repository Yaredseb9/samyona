<?php
/**
 * Assets optimization (auto) settings.
 *
 * @package Hummingbird
 *
 * @since 2.6.0
 *
 * @var array  $enabled      List of enabled modules.
 * @var array  $exclusions   List of exclusions.
 * @var bool   $is_divi      If Divi theme is active.
 * @var string $type         Asset optimization type. Accepts: 'advanced', 'basic'.
 * @var string $view         Optimization view. Accepts: 'speedy' and 'basic'.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<p>
	<?php esc_html_e( 'The configurations will be applied to the enabled automatic optimization option.', 'wphb' ); ?>
</p>

<div class="sui-tabs sui-tabs-flushed">
	<div role="tablist" class="sui-tabs-menu">
		<button type="button" role="tab" id="<?php echo esc_attr( $view ); ?>-files-tab" class="sui-tab-item active" aria-controls="<?php echo esc_attr( $view ); ?>-files-tab-content" aria-selected="true">
			<?php esc_html_e( 'Files', 'wphb' ); ?>
		</button>

		<button type="button" role="tab" id="<?php echo esc_attr( $view ); ?>-presets-tab" class="sui-tab-item" aria-controls="<?php echo esc_attr( $view ); ?>-presets-tab-content" aria-selected="false" tabindex="-1">
			<?php esc_html_e( 'Presets', 'wphb' ); ?>
		</button>

		<button type="button" role="tab" id="<?php echo esc_attr( $view ); ?>-exclusions-tab" class="sui-tab-item" aria-controls="<?php echo esc_attr( $view ); ?>-exclusions-tab-content" aria-selected="false" tabindex="-1">
			<?php esc_html_e( 'Exclusions', 'wphb' ); ?>
		</button>
	</div>

	<div class="sui-tabs-content">
		<div role="tabpanel" tabindex="0" id="<?php echo esc_attr( $view ); ?>-files-tab-content" class="sui-tab-content active" aria-labelledby="<?php echo esc_attr( $view ); ?>-files-tab">
			<div class="sui-description">
				<?php esc_html_e( 'Choose which files you want to automatically optimize.', 'wphb' ); ?>
			</div>

			<div class="sui-form-field">
				<label for="wphb-ao-<?php echo esc_attr( $view ); ?>-css" class="sui-checkbox sui-checkbox-sm">
					<input type="checkbox" id="wphb-ao-<?php echo esc_attr( $view ); ?>-css" aria-labelledby="wphb-ao-<?php echo esc_attr( $view ); ?>-css-label" <?php checked( $enabled['styles'] ); ?>>
					<span aria-hidden="true"></span>
					<span id="wphb-ao-<?php echo esc_attr( $view ); ?>-css-label"><?php esc_html_e( 'CSS files', 'wphb' ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description">
					<?php esc_html_e( 'Hummingbird will minify your CSS files, generating a version that loads faster. It will remove unnecessary characters or lines of code from your file to make it more compact.', 'wphb' ); ?>
				</span>

				<label for="wphb-ao-<?php echo esc_attr( $view ); ?>-js" class="sui-checkbox sui-checkbox-sm">
					<input type="checkbox" id="wphb-ao-<?php echo esc_attr( $view ); ?>-js" aria-labelledby="wphb-ao-<?php echo esc_attr( $view ); ?>-js-label" <?php checked( $enabled['scripts'] ); ?>>
					<span aria-hidden="true"></span>
					<span id="wphb-ao-<?php echo esc_attr( $view ); ?>-js-label"><?php esc_html_e( 'JavaScript files', 'wphb' ); ?></span>
				</label>
				<span class="sui-description sui-checkbox-description">
					<?php esc_html_e( 'JavaScript minification is the process of removing whitespace and any code that is not necessary to create a smaller but valid code.', 'wphb' ); ?>
				</span>
			</div>
		</div>

		<div role="tabpanel" tabindex="0" id="<?php echo esc_attr( $view ); ?>-presets-tab-content" class="sui-tab-content sui-no-padding" aria-labelledby="<?php echo esc_attr( $view ); ?>-presets-tab" hidden>
			<div class="sui-description sui-margin">
				<?php esc_html_e( 'Use presets to optimize your theme and plugins automatically. No manual configuration needed.', 'wphb' ); ?>
			</div>

			<?php if ( $is_divi ) : ?>
				<table class="sui-table sui-table-flushed sui-margin-bottom">
					<thead>
					<tr>
						<th><?php esc_html_e( 'Available presets', 'wphb' ); ?></th>
						<th><?php esc_html_e( 'Status', 'wphb' ); ?></th>
						<th>&nbsp;</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td style="display: flex; align-items: center">
							<img class="sui-image" alt="" style="margin-right: 10px"
								src="<?php echo esc_url( WPHB_DIR_URL . 'admin/assets/image/divi.png' ); ?>"
								srcset="<?php echo esc_url( WPHB_DIR_URL . 'admin/assets/image/divi.png' ); ?> 1x, <?php echo esc_url( WPHB_DIR_URL . 'admin/assets/image/divi@2x.png' ); ?> 2x">
							<strong>Divi</strong>
						</td>
						<td>
							<span class="sui-tag sui-tag-blue sui-tag-sm"><?php esc_html_e( 'Coming Soon', 'wphb' ); ?></span>
						</td>
						<td>
							<small class="sui-no-margin-bottom"><?php esc_html_e( 'Enable the preset to auto-optimize this theme.', 'wphb' ); ?></small>
						</td>
					</tr>
					</tbody>
				</table>
			<?php endif; ?>

			<?php if ( ! apply_filters( 'wpmudev_branding_hide_branding', false ) ) : ?>
				<div class="sui-box-settings-row sui-upsell-row sui-margin-left sui-margin-right sui-padding-bottom">
					<img class="sui-image sui-upsell-image" style="width: 127px" alt=""
						src="<?php echo esc_url( WPHB_DIR_URL . 'admin/assets/image/hummingbird-upsell-minify.png' ); ?>"
						srcset="<?php echo esc_url( WPHB_DIR_URL . 'admin/assets/image/hummingbird-upsell-minify@2x.png' ); ?> 2x">
					<div class="sui-upsell-notice sui-margin-left">
						<p>
							<?php
							if ( $is_divi ) {
								esc_html_e( 'Preset for Divi coming soon! Hummingbird will automatically compress and optimize your Divi theme files with just a click. Not using Divi? Vote for the next preset you would like added.', 'wphb' );
							} else {
								esc_html_e( 'Presets coming soon! Hummingbird will automatically compress and optimize your theme and plugin files with just a click. You can vote for the next preset you would like added.', 'wphb' );
							}
							?>
							<br>
							<a href="https://forms.gle/7iwfSxTd21kn5pdT6" target="_blank" class="sui-button" style="margin-top: 10px; color: #fff">
								<?php esc_html_e( 'Vote for the next Preset', 'wphb' ); ?>
							</a>
						</p>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div role="tabpanel" tabindex="0" id="<?php echo esc_attr( $view ); ?>-exclusions-tab-content" class="sui-tab-content" aria-labelledby="<?php echo esc_attr( $view ); ?>-exclusions-tab" hidden>
			<div class="sui-description">
				<?php esc_html_e( "By default, we'll optimize all the CSS and JS files we can find. If you have specific files you want to leave as-is, list them here, and we'll exclude them.", 'wphb' ); ?>
			</div>

			<div class="sui-form-field">
				<label for="wphb-ao-<?php echo esc_attr( $view ); ?>-exclude" id="optimization-exclude-label" class="sui-label">
					<?php esc_html_e( 'File exclusions', 'wphb' ); ?>
				</label>

				<select
					id="wphb-ao-<?php echo esc_attr( $view ); ?>-exclude"
					name="excluded_items[]"
					class="sui-select sui-select-lg"
					data-placeholder="<?php esc_attr_e( 'Start typing the files to exclude...', 'wphb' ); ?>"
					aria-labelledby="optimization-exclude-label"
					aria-describedby="optimization-exclude-description"
					multiple="multiple"
				>
					<?php
					$collection = \Hummingbird\Core\Modules\Minify\Sources_Collector::get_collection();
					$types      = array( 'styles', 'scripts' );

					foreach ( $types as $asset_type ) {
						if ( ! isset( $collection[ $asset_type ] ) || 'false' === $enabled[ $asset_type ] ) {
							continue;
						}

						foreach ( $collection[ $asset_type ] as $element ) {
							$handle = isset( $element['handle'] ) ? $element['handle'] : false;
							$source = isset( $element['src'] ) ? basename( $element['src'] ) : false;

							if ( ! $handle || ! $source ) {
								continue;
							}

							echo '<option value="' . esc_attr( $handle ) . '" data-type="' . esc_attr( $asset_type ) . '" ' . selected( in_array( $handle, $exclusions[ $asset_type ], true ) ) . '>' . esc_html( $handle ) . ' (file - ' . esc_html( $source ) . ')</option>';
						}
					}
					?>
				</select>

				<span id="optimization-exclude-description" class="sui-description">
					<?php esc_html_e( 'Type the filename and click on the filename to add it to the list.', 'wphb' ); ?>
				</span>
			</div>
		</div>
	</div>
</div>
