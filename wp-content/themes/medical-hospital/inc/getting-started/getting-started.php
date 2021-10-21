<?php
//about theme info
add_action( 'admin_menu', 'medical_hospital_gettingstarted' );
function medical_hospital_gettingstarted() {    	
	add_theme_page( esc_html__('Get Started', 'medical-hospital'), esc_html__('Get Started', 'medical-hospital'), 'edit_theme_options', 'medical_hospital_guide', 'medical_hospital_mostrar_guide');   
}
// Add a Custom CSS file to WP Admin Area
function medical_hospital_admin_theme_style() {
   wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/inc/getting-started/getting-started.css');
}
add_action('admin_enqueue_scripts', 'medical_hospital_admin_theme_style');
//guidline for about theme
function medical_hospital_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'medical-hospital' );
?>
<div class="wrapper-info">
	<div class="col-left">
		<div class="intro">
			<h3><?php esc_html_e( 'Welcome to Medical Hospital WordPress Theme', 'medical-hospital' ); ?></h3>
		</div>
		<div class="color_bg_blue">
			<p>Version: <?php echo esc_html($theme['Version']);?></p>
				<p class="intro_version"><?php esc_html_e( 'Congratulations! You are about to use the most easy to use and felxible WordPress theme.', 'medical-hospital' ); ?></p>
				<div class="blink">
					<h4><?php esc_html_e( 'Theme Created By Themesglance', 'medical-hospital' ); ?></h4>
				</div>
			<div class="intro-text"><img role="img" src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/themesglance-logo.png" alt="" /></div>
			<div class="coupon-code"><?php esc_html_e( 'Get', 'medical-hospital' ); ?> <span><?php esc_html_e( '20% off', 'medical-hospital' ); ?></span> <?php esc_html_e( 'on Premium Theme with the discount code: ', 'medical-hospital' ); ?> <span><?php esc_html_e( '" Get20 "', 'medical-hospital' ); ?></span></div>
		</div>
		<div class="started">
			<h3><?php esc_html_e( 'Lite Theme Info', 'medical-hospital' ); ?></h3>
			<p><?php esc_html_e( 'If you hail from the profession of medical science and want a theme that will help you serve better in your profession then Medical Hospital WordPress theme is perfect for you. This multipurpose medical theme is flexible to be used by Hospital, doctors, surgeons, general physicians, medical personnel, health centers, pharmacists, practitioners, clinics, hospitals etc. It can even be used by people involved in ambulance services. It can efficiently be used by a small clinic down the lane or a big multi-speciality hospital. Its minimal design and user-friendly interface is sure to make visitors adhere to it and spend quality time on your site. It has testimonial section to give a better insight of your work and service through your clients. It is fully responsive, translation ready with call to action (CTA) button. The Medical Hospital WordPress theme is built with clean and secure codes which reduces its load time and makes it a search engine optimized theme. You can share your useful content through social media icons embedded in it. This theme has an interactive yet simple design to give clients a soothing effect which is very necessary. Use this theme which is packed with stunning features and functionalities to show sincerity and dedication in your work.', 'medical-hospital')?>
			</p>
			<hr>
			<h3><?php esc_html_e( 'Help Docs', 'medical-hospital' ); ?></h3>
			<ul>
				<p><?php esc_html_e( 'Medical Hospital', 'medical-hospital' ); ?> <a href="<?php echo esc_url( MEDICAL_HOSPITAL_THEMESGLANCE_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'medical-hospital' ); ?></a></p>
			</ul>
			<hr>
			<h3><?php esc_html_e( 'Get started with Medical Hospital Theme', 'medical-hospital' ); ?></h3>
			<div class="col-left-inner"> 
				<img role="img" src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/free-screenshot.png" alt="" />
			</div>		
			<div class="col-right-inner">
				<p><?php esc_html_e( 'Go to', 'medical-hospital' ); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizer', 'medical-hospital' ); ?> </a> <?php esc_html_e( 'and start customizing your website', 'medical-hospital' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'Easily customizable ', 'medical-hospital' ); ?> </li>
					<li><?php esc_html_e( 'Absolutely free', 'medical-hospital' ); ?> </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-right">
		<div class="col-left-area">
			<h3><?php esc_html_e('Premium Theme Information', 'medical-hospital'); ?></h3>
			<hr>
		</div>
		<div class="centerbold">
			<img role="img" src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/responsive.png" alt="" />
			<hr class="firsthr">
			<a href="<?php echo esc_url( MEDICAL_HOSPITAL_THEMESGLANCE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'medical-hospital'); ?></a>
			<a href="<?php echo esc_url( MEDICAL_HOSPITAL_THEMESGLANCE_PRO_THEME_URL ); ?>"><?php esc_html_e('Buy Pro', 'medical-hospital'); ?></a>
			<a href="<?php echo esc_url( MEDICAL_HOSPITAL_THEMESGLANCE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'medical-hospital'); ?></a>
			<hr class="secondhr">
		</div>
		<h3><?php esc_html_e( 'PREMIUM THEME FEATURES', 'medical-hospital'); ?></h3>
		<ul>
		 	<li><?php esc_html_e( 'Advanced Slider with the text and CTA button for each slides', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Unlimited slides', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Doctor Posttype', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Success Stories Posttype', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Gallery Section', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Happy Clients Posttype', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Services Posttye', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Services listing with Shortcodes', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Happy Clients listing with Shortcodes', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Doctor listing with Shortcodes', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Success Stories listing with Shortcodes', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Partner listing with slider', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Recent Post Widget with thumbnails', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Contact Page template', 'medical-hospital'); ?></li>
		 	<li><?php esc_html_e( 'Blog full width, With Left and Right sidebar Template', 'medical-hospital'); ?></li>
		</ul>
	</div>
	<div class="service">
		<div class="col-lg-3 col-md-3">
			<h3><span class="dashicons dashicons-media-document"></span> <?php esc_html_e('Get Support', 'medical-hospital'); ?></h3>
			<ol>
				<li>
				<a href="<?php echo esc_url( MEDICAL_HOSPITAL_THEMESGLANCE_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'medical-hospital'); ?></a>
				</li>
			</ol>
		</div>
		<div class="col-lg-3 col-md-3">
			<h3><span class="dashicons dashicons-welcome-widgets-menus"></span> <?php esc_html_e('Getting Started', 'medical-hospital'); ?></h3>
			<ol>
				<li> <?php esc_html_e('Start', 'medical-hospital'); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'medical-hospital'); ?></a> <?php esc_html_e('your website.', 'medical-hospital'); ?></li>
			</ol>
		</div>
		<div class="col-lg-3 col-md-3">
			<h3><span class="dashicons dashicons-star-filled"></span> <?php esc_html_e('Rate This Theme', 'medical-hospital'); ?></h3>
			<ol>
				<li>
				<a href="<?php echo esc_url( MEDICAL_HOSPITAL_THEMESGLANCE_REVIEW ); ?>" target="_blank"><?php esc_html_e('Rate it here', 'medical-hospital'); ?></a>
				</li>
			</ol>
		</div>
		<div class="col-lg-3 col-md-3">
			<h3><span class="dashicons dashicons-editor-help"></span> <?php esc_html_e( 'Help Docs', 'medical-hospital' ); ?></h3>
			<ol>
				<li><?php esc_html_e( 'Medical Hospital Lite', 'medical-hospital' ); ?> <a href="<?php echo esc_url( MEDICAL_HOSPITAL_THEMESGLANCE_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'medical-hospital' ); ?></a></li>
			</ol>
		</div>
	</div>
</div>
<?php } ?>