<?php
/**
 * @package Medical Hospital
 * @subpackage medical-hospital
 * Setup the WordPress core custom header feature.
 *
 * @uses medical_hospital_header_style()
*/

function medical_hospital_custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'medical_hospital_custom_header_args', array(
		'default-text-color'     => 'fff',
		'header-text' 			 =>	false,
		'width'                  => 1600,
		'height'                 => 400,
		'wp-head-callback'       => 'medical_hospital_header_style',
	) ) );

}

add_action( 'after_setup_theme', 'medical_hospital_custom_header_setup' );

if ( ! function_exists( 'medical_hospital_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see medical_hospital_custom_header_setup().
 */
add_action( 'wp_enqueue_scripts', 'medical_hospital_header_style' );
function medical_hospital_header_style() {
	//Check if user has defined any header image.
	if ( get_header_image() ) :
	$medical_hospital_custom_css = "
        #header{
			background-image:url('".esc_url(get_header_image())."');
			background-position: center top;
		}";
	   	wp_add_inline_style( 'medical-hospital-basic-style', $medical_hospital_custom_css );
	endif;
}
endif; //medical_hospital_header_style