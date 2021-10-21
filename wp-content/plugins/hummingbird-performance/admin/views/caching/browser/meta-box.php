<?php
/**
 * Browser caching meta box.
 *
 * @package Hummingbird
 *
 * @var bool   $htaccess_issue           Problems writing htaccess file.
 * @var array  $results                  Current report.
 * @var int    $issues                   Number of issues.
 * @var array  $human_results            Current report in readable format.
 * @var array  $recommended              Recommended values.
 * @var string $cf_notice                CloudFlare notification.
 * @var bool   $show_cf_notice           Show the notice.
 * @var bool   $cf_server                Are a CloudFlare server.
 * @var bool   $cf_active                CloudFlare active.
 * @var array  $caching_type_tooltips    Caching types array if browser caching is enabled.
 */

use Hummingbird\Core\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="<?php echo $show_cf_notice ? 'sui-box-body' : ''; ?>">
	<p><?php esc_html_e( "Store temporary data on your visitors' devices so that they don’t have to download assets twice if they don’t have to. This results in a much faster second time round page load speed.", 'wphb' ); ?></p>

	<?php
	if ( $htaccess_issue ) {
		$this->admin_notices->show_inline(
			esc_html__( 'Browser Caching is not working properly:', 'wphb' ),
			'error',
			'<ul><li>- ' . esc_html__( 'Your server may not have the "expires" module enabled (mod_expires for Apache, ngx_http_headers_module for NGINX)', 'wphb' ) . '</li>' .
			'<li>- ' . esc_html__( 'Another plugin may be interfering with the configuration', 'wphb' ) . '</li></ul>',
			sprintf( /* translators: %s: Support link */
				__( 'If re-checking and restarting does not resolve, please check with your host or <a href="%s" target="_blank">open a support ticket with us</a>.', 'wphb' ),
				esc_url( Utils::get_link( 'support' ) )
			)
		);
	}

	if ( $issues ) {
		$this->admin_notices->show_inline(
			sprintf( /* translators: %s: Number of issues */
				__( '%s of your cache types don’t meet the recommended expiry period of 1 year. Configure browser caching <a href="#" id="configure-link">here</a>.', 'wphb' ),
				absint( $issues )
			),
			'warning'
		);
	} else {
		$this->admin_notices->show_inline( esc_html__( 'All of your cache types meet the recommended expiry period of 1 year. Great work!', 'wphb' ) );
	}
	?>

	<div class="wphb-border-frame">
		<div class="table-header">
			<div class="wphb-caching-summary-heading-type">
				<?php esc_html_e( 'File type', 'wphb' ); ?>
			</div>
			<div class="wphb-caching-summary-heading-expiry">
				<?php esc_html_e( 'Recommended expiry', 'wphb' ); ?>
			</div>
			<div class="wphb-caching-summary-heading-status">
				<?php esc_html_e( 'Current expiry', 'wphb' ); ?>
			</div>
		</div>
		<?php
		foreach ( $human_results as $cache_type => $result ) :
			$expiry_tooltip = sprintf(
				/* translators: %s: Recommended expiration value */
				__( 'The recommended value for this file type is at least %s.', 'wphb' ),
				esc_html( $recommended[ $cache_type ]['label'] )
			);

			$cache_status   = __( 'Disabled', 'wphb' );
			$status_color   = 'warning';
			$status_tooltip = __( 'Caching is disabled', 'wphb' );

			if ( $result ) {
				if ( $recommended[ $cache_type ]['value'] <= $results[ $cache_type ] ) {
					$cache_status   = $result;
					$status_color   = 'success';
					$status_tooltip = __( 'Caching is enabled', 'wphb' );
				} else {
					$cache_status   = $result;
					$status_color   = 'warning';
					$status_tooltip = __( "Caching is enabled but you aren't using our recommended value", 'wphb' );
				}
			}

			if ( $cf_active ) {
				$cf_tooltip        = $expiry_tooltip;
				$cf_recommended    = $recommended[ $cache_type ]['label'];
				$cf_status_color   = $status_color;
				$cf_status_tooltip = $status_tooltip;
				$cf_status         = $cache_status;
			}
			?>
			<div class="table-row">
				<div class="wphb-caching-summary-item-type">
					<span class="wphb-filename-extension wphb-filename-extension-<?php echo esc_attr( $cache_type ); ?>" data-tooltip="<?php echo esc_attr( $caching_type_tooltips[ $cache_type ] ); ?>" >
						<?php
						switch ( $cache_type ) {
							case 'javascript':
								$label = 'JavaScript';
								echo 'js';
								break;
							case 'images':
								$label = 'Images';
								echo 'img';
								break;
							case 'css':
								$label = 'CSS';
								echo esc_html( $cache_type );
								break;
							case 'media':
								$label = 'Media';
								echo esc_html( $cache_type );
								break;
							default:
								$label = esc_html( $cache_type );
								echo esc_html( $cache_type );
								break;
						}
						?>
					</span>
					<?php echo esc_html( $label ); ?>
				</div>
				<div class="wphb-caching-summary-item-expiry">
					<span class="sui-tag sui-tag-disabled sui-tooltip sui-tooltip-constrained" data-tooltip="<?php echo esc_attr( $expiry_tooltip ); ?>">
						<?php echo esc_html( $recommended[ $cache_type ]['label'] ); ?>
					</span>
				</div>
				<div class="wphb-caching-summary-item-status">
					<span id="wphb-caching-expiry-<?php echo esc_attr( $cache_type ); ?>" class="sui-tag sui-tag-<?php echo esc_attr( $status_color ); ?>  sui-tooltip sui-tooltip-constrained" data-tooltip="<?php echo esc_attr( $status_tooltip ); ?>">
						<?php echo esc_html( $cache_status ); ?>
					</span>
				</div>
			</div>
			<?php
		endforeach;

		if ( $cf_active && isset( $caching_type_tooltips['cloudflare'] ) ) :
			?>
			<div class="table-row">
				<div class="wphb-caching-summary-item-type">
					<span class="wphb-filename-extension wphb-filename-extension-other sui-tooltip sui-tooltip-constrained" data-tooltip="<?php echo esc_attr( $caching_type_tooltips['cloudflare'] ); ?>">oth</span>
					<?php esc_html_e( 'Cloudflare', 'wphb' ); ?>
				</div>
				<div class="wphb-caching-summary-item-expiry">
					<span class="sui-tag sui-tag-disabled sui-tooltip sui-tooltip-constrained" data-tooltip="<?php echo esc_attr( $cf_tooltip ); ?>">
						<?php echo esc_html( $cf_recommended ); ?>
					</span>
				</div>
				<div class="wphb-caching-summary-item-status">
					<span class="sui-tag sui-tag-<?php echo esc_attr( $cf_status_color ); ?> sui-tooltip sui-tooltip-constrained" data-tooltip="<?php echo esc_attr( $cf_status_tooltip ); ?>">
						<?php echo esc_html( $cf_status ); ?>
					</span>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php if ( $show_cf_notice ) : ?>
	<div class="sui-box-settings-row sui-upsell-row cf-dash-notice sui-no-padding-top">
		<?php if ( ! apply_filters( 'wpmudev_branding_hide_branding', false ) ) : ?>
			<img class="sui-image sui-upsell-image" alt="<?php esc_attr_e( 'Connect your account to Cloudflare', 'wphb' ); ?>"
				src="<?php echo esc_url( WPHB_DIR_URL . 'admin/assets/image/graphic-hb-cf-sell.png' ); ?>"
				srcset="<?php echo esc_url( WPHB_DIR_URL . 'admin/assets/image/graphic-hb-cf-sell.png' ); ?> 1x, <?php echo esc_url( WPHB_DIR_URL . 'admin/assets/image/graphic-hb-cf-sell@2x.png' ); ?> 2x">
		<?php endif; ?>
		<?php
		$message = sprintf( /* translators: %s: notice text, */
			esc_html__( '%s Connect your account to control your settings via Hummingbird.', 'wphb' ),
			esc_html( $cf_notice )
		);

		if ( ! $cf_server ) {
			$message .= ' ';
			$message .= esc_html__( 'CloudFlare is a Content Delivery Network (CDN) that sends traffic through its global network to automatically optimize the delivery of your site so your visitors can browse your site at top speeds. There is a free plan and we recommend using it.', 'wphb' );
		}

		$buttons  = apply_filters( 'wpmudev_branding_hide_branding', false ) ? '' : '<span>';
		$buttons .= sprintf( /* translators: %1$s - opening tags, %2$s - closing tags */
			esc_html__( '%1$sConnect%2$s', 'wphb' ),
			'<a href="#" class="sui-button sui-button-ghost sui-button-icon-left connect-cloudflare-link"><i class="sui-icon-plus-circle" aria-hidden="true"></i>',
			'</a>'
		);

		if ( ! apply_filters( 'wpmudev_branding_hide_branding', false ) ) {
			$buttons .= sprintf( /* translators: %1$s - opening tags, %2$s - closing tags */
				esc_html__( '%1$sLearn More%2$s', 'wphb' ),
				'<a href="https://premium.wpmudev.org/blog/cloudflare-review/" target="_blank">',
				'</a>'
			);
		}
		$buttons .= apply_filters( 'wpmudev_branding_hide_branding', false ) ? '' : '</span>';

		$this->admin_notices->show_inline(
			$message,
			apply_filters( 'wpmudev_branding_hide_branding', false ) ? 'grey' : 'sui-upsell-notice',
			$buttons
		);
		?>
	</div>
<?php endif; ?>
