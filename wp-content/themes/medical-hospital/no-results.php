<?php
/**
 * The template part for displaying a message that posts cannot be found.
 * @package Medical Hospital
 */
?>

<header role="banner">
	<h2 class="entry-title"><?php esc_html_e( 'Nothing Found', 'medical-hospital' ); ?></h2>
</header>
<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.', 'medical-hospital' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php elseif ( is_search() ) : ?>
		<p><?php echo esc_html( get_theme_mod('medical_hospital_search_result_text',__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'medical-hospital' )) ); ?></p><br />
			<?php get_search_form(); ?>
	<?php else : ?>
	<p><?php esc_html_e( 'Dont worry it happens to the best of us.', 'medical-hospital' ); ?></p><br />
	<div class="read-moresec">
		<a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right"><?php esc_html_e( 'Return to the home page', 'medical-hospital' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Return to the home page', 'medical-hospital' ); ?></span></a>
	</div>
<?php endif; ?>