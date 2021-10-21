<?php
/**
 * Asset optimization table (basic view).
 *
 * @package Hummingbird
 *
 * @since 1.7.1
 *
 * @var \Hummingbird\Admin\Page $this
 *
 * @var int    $error_time_left  Time left before next scan is possible.
 * @var bool   $is_server_error  Server error status.
 * @var string $scripts_rows     Table rows for minified scripts.
 * @var array  $selector_filter  List of items to filter by.
 * @var array  $server_errors    List of server errors.
 * @var string $styles_rows      Table rows for minified styles.
 * @var string $others_rows      Table rows for files not hosted locally.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="wphb-minification-files">
	<div class="wphb-minification-files-header">
		<?php
		$this->view(
			'minification/common/header',
			array(
				'type' => 'advanced',
			)
		);
		?>

		<p><?php esc_html_e( 'Compress, inline, combine, defer or move your files and then publish your changes.', 'wphb' ); ?></p>
	</div>

	<?php
	if ( $is_server_error ) {
		$message = sprintf( /* translators: %d: Time left before another retry. */
			__( 'It seems that we are having problems in our servers. Asset optimization will be turned off for %d minutes', 'wphb' ),
			$error_time_left
		) . '<br>' . $server_errors[0]->get_error_message();
		$this->admin_notices->show_floating( $message, 'error' );
	}

	do_action( 'wphb_asset_optimization_notice' );
	?>

	<div class="sui-box sui-box-sticky">
		<div class="sui-actions-left">
			<a class="sui-button button-notice disabled" data-modal-open="bulk-update-modal" data-modal-open-focus="dialog-close-div" data-modal-mask="true" id="bulk-update" >
				<?php esc_html_e( 'Bulk Update', 'wphb' ); ?>
			</a>
			<input type="submit" id="wphb-publish-changes" class="sui-button sui-button-blue disabled" name="submit" value="<?php esc_attr_e( 'Publish Changes', 'wphb' ); ?>"/>
		</div>

		<div class="sui-actions-right">
			<a href="#wphb-box-minification-enqueued-files" class="sui-button-icon sui-button-outlined" id="wphb-minification-filter-button">
				<i class="sui-icon-filter sui-md sui-fw" aria-hidden="true"></i>
			</a>
		</div>
	</div>

	<div class="wphb-minification-filter sui-border-frame sui-hidden">
		<div class="wphb-minification-filter-block" id="wphb-minification-filter-block-search">
			<h3 class="wphb-block-title"><?php esc_html_e( 'Filter', 'wphb' ); ?></h3>

			<label for="wphb-secondary-filter" class="screen-reader-text"><?php esc_html_e( 'Filter plugin or theme', 'wphb' ); ?></label>
			<select name="wphb-secondary-filter" id="wphb-secondary-filter">
				<option value=""><?php esc_html_e( 'Choose Plugin or Theme', 'wphb' ); ?></option>
				<option value="other"><?php esc_html_e( 'Others', 'wphb' ); ?></option>
				<?php foreach ( $selector_filter as $secondary_filter ) : ?>
					<option value="<?php echo esc_attr( $secondary_filter ); ?>"><?php echo esc_html( $secondary_filter ); ?></option>
				<?php endforeach; ?>
			</select>

			<label for="wphb-s" class="screen-reader-text"><?php esc_html_e( 'Search by name or extension', 'wphb' ); ?></label>
			<input type="text" id="wphb-s" class="sui-form-control" name="s" placeholder="<?php esc_attr_e( 'Search by name or extension', 'wphb' ); ?>" autocomplete="off">
		</div>
	</div>

	<div class="wphb-minification-files-select">
		<label for="minification-bulk-file-css" class="screen-reader-text"><?php esc_html_e( 'Select all CSS files', 'wphb' ); ?></label>
		<label class="sui-checkbox">
			<input type="checkbox" id="minification-bulk-file-css" name="minification-bulk-files" class="wphb-minification-bulk-file-selector" data-type="CSS">
			<span aria-hidden="true"></span>
		</label>
		<h3><?php esc_html_e( 'CSS', 'wphb' ); ?></h3>
	</div>

	<div class="wphb-minification-files-table wphb-minification-files-advanced">
		<?php echo $styles_rows; ?>
	</div>

	<div class="wphb-minification-files-select">
		<label for="minification-bulk-file-js" class="screen-reader-text"><?php esc_html_e( 'Select all JavaScript files', 'wphb' ); ?></label>
		<label class="sui-checkbox">
			<input type="checkbox" id="minification-bulk-file-js" name="minification-bulk-files" class="wphb-minification-bulk-file-selector" data-type="JS">
			<span aria-hidden="true"></span>
		</label>
		<h3><?php esc_html_e( 'JavaScript', 'wphb' ); ?></h3>
	</div>

	<div class="wphb-minification-files-table wphb-minification-files-advanced">
		<?php echo $scripts_rows; ?>
	</div>

	<?php if ( '' !== $others_rows ) : ?>
		<div class="wphb-minification-files-select">
			<label for="minification-bulk-file-other" class="screen-reader-text"><?php esc_html_e( 'Select all Other files', 'wphb' ); ?></label>
			<label class="sui-checkbox">
				<input type="checkbox" id="minification-bulk-file-other" name="minification-bulk-files" class="wphb-minification-bulk-file-selector" data-type="OTHER">
				<span aria-hidden="true"></span>
			</label>
			<h3><?php esc_html_e( 'Other', 'wphb' ); ?></h3>
		</div>

		<div class="wphb-minification-files-table wphb-minification-files-advanced">
			<?php echo $others_rows; ?>
		</div>
	<?php endif; ?>
</div><!-- end wphb-minification-files -->

<?php wp_nonce_field( 'wphb-enqueued-files' ); ?>
<?php $this->modal( 'bulk-update' ); ?>
