<?php
/**
 * Assets optimization (auto).
 *
 * @package Hummingbird
 *
 * @since 2.6.0
 *
 * @var string $type        Asset optimization type. Accepts: 'advanced', 'basic'.
 * @var string $view        Optimization view. Accepts: 'speedy' and 'basic'.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$this->view( 'minification/common/header', compact( 'type' ) );

?>

<div class="wphb-minification-files">
	<div class="sui-box <?php echo 'speedy' === $view ? '' : 'wphb-close-section'; ?>" id="wphb-speedy-ao-box">
		<?php
		$this->view(
			'minification/common/box-header',
			array(
				'type' => 'speedy',
				'view' => $view,
			)
		);
		?>
	</div>

	<div class="sui-box <?php echo 'basic' === $view ? '' : 'wphb-close-section'; ?>" id="wphb-basic-ao-box">
		<?php
		$this->view(
			'minification/common/box-header',
			array(
				'type' => 'basic',
				'view' => $view,
			)
		);
		?>
	</div>
</div>
