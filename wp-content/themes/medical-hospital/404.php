<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package Medical Hospital
 */

get_header(); ?>

<div class="container">
    <main id="maincontent" role="main" class="page-content">
		<div class="notfound">
			<?php if(get_theme_mod('medical_hospital_404_title','404 Not Found')){ ?>
				<h1><?php echo esc_html( get_theme_mod('medical_hospital_404_title',__('404 Not Found', 'medical-hospital' )) ); ?></h1>
			<?php }?>
			<?php if(get_theme_mod('medical_hospital_404_button_label','Return to the home page')){ ?>
				<div class="read-moresec">
	        		<a href="<?php echo esc_url( home_url() ); ?>" class="button"><?php echo esc_html( get_theme_mod('medical_hospital_404_button_label',__('Return to the home page', 'medical-hospital' )) ); ?><span class="screen-reader-text"><?php esc_html_e('Return to the home page','medical-hospital'); ?></span></a>
				</div>
			<?php }?>
		</div>
		<div class="clearfix"></div>
    </main>
</div>
	
<?php get_footer(); ?>