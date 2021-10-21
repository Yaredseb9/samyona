<?php
/**
 * The template for displaying search forms in Medical Hospital
 * @package Medical Hospital
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'medical-hospital' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( get_theme_mod('medical_hospital_search_placeholder', __('Search', 'medical-hospital')) ); ?>" value="<?php the_search_query(); ?>" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'medical-hospital' ); ?>">
</form>