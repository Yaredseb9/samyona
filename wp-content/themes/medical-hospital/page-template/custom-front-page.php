<?php
/**
 * Template Name: Custom home page
 */

get_header(); ?>

<main id="maincontent" role="main">
  <?php do_action('medical_hospital_above_contact_section'); ?>
  <section id="contact-us">
    <div class="container"> 
      <div class="row">   
        <div class="col-lg-4 col-md-4">
          <?php if( get_theme_mod( 'medical_hospital_time','' ) != '') { ?>
            <div class="row">
              <div class="col-lg-2 col-md-2">
                <i class="far fa-clock"></i>
              </div>
              <div class="col-lg-10 col-md-10">
                <p class="diff-lay"><?php echo esc_html( get_theme_mod('medical_hospital_time','') ); ?></p>
                <p><?php echo esc_html( get_theme_mod('medical_hospital_time1','') ); ?></p>
              </div>
            </div>
          <?php }?>
        </div>
        <div class="col-lg-4 col-md-4">
          <?php if( get_theme_mod( 'medical_hospital_phone','' ) != '') { ?>
            <div class="row">
              <div class="col-lg-2 col-md-2">
                <i class="fas fa-phone-volume"></i>
              </div>
              <div class="col-lg-10 col-md-10">
                <p class="diff-lay"><?php echo esc_html( get_theme_mod('medical_hospital_phone','') ); ?></p>
                <p><?php echo esc_html( get_theme_mod('medical_hospital_phone1','') ); ?></p>
              </div>
            </div>
          <?php }?>
        </div>   
        <div class="col-lg-4 col-md-4">
          <?php if( get_theme_mod( 'medical_hospital_address','' ) != '') { ?>
            <div class="row">
              <div class="col-lg-2 col-md-2">
                <i class="fas fa-map-marker-alt"></i>
              </div>
              <div class="col-lg-10 col-md-10">
                <p><?php echo esc_html( get_theme_mod('medical_hospital_address','') ); ?></p>
              </div>
            </div>
          <?php }?>
        </div>
      </div>
    </div>
  </section>

  <?php do_action('medical_hospital_above_slider_section'); ?>

  <?php if( get_theme_mod( 'medical_hospital_slider_hide') != '') { ?>
    <section id="slider">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="<?php echo esc_attr(get_theme_mod('medical_hospital_slider_speed',3000)); ?>"> 
        <?php $medical_hospital_content_pages = array();
          for ( $count = 1; $count <= 4; $count++ ) {
            $mod = intval( get_theme_mod( 'medical_hospital_slidersettings_page' . $count ));
            if ( 'page-none-selected' != $mod ) {
              $medical_hospital_content_pages[] = $mod;
            }
          }
          if( !empty($medical_hospital_content_pages) ) :
          $args = array(
              'post_type' => 'page',
              'post__in' => $medical_hospital_content_pages,
              'orderby' => 'post__in'
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>     
        <div class="carousel-inner" role="listbox">
          <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <?php the_post_thumbnail(); ?>
            <div class="carousel-caption">
              <div class="inner_carousel">
                <?php if ( get_theme_mod('medical_hospital_slider_title',true) != '' ) {?>
                  <h1><?php the_title(); ?></h1>
                <?php }?>
                <?php if ( get_theme_mod('medical_hospital_slider_content',true) != '' ) {?>
                  <p><?php $excerpt = get_the_excerpt(); echo esc_html( medical_hospital_string_limit_words( $excerpt, esc_attr(get_theme_mod('medical_hospital_slider_excerpt_number','15')))); ?></p>
                <?php }?>
                <?php if ( get_theme_mod('medical_hospital_slider_button_label','READ MORE') != '' && get_theme_mod('medical_hospital_slider_button',true) != '') {?>
                  <div class ="readbutton">
                    <a href="<?php the_permalink(); ?>"> <?php echo esc_html( get_theme_mod('medical_hospital_slider_button_label',__('READ MORE','medical-hospital')) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('medical_hospital_slider_button_label',__('READ MORE','medical-hospital')) ); ?></span></a>
                  </div>
                <?php }?>
              </div>
            </div>
          </div>
          <?php $i++; endwhile; 
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Previous', 'medical-hospital' ); ?></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
          <span class="screen-reader-text"><?php esc_html_e( 'Next', 'medical-hospital' ); ?></span>
        </a>
      </div>  
      <div class="clearfix"></div>
    </section> 
  <?php }?>

  <?php do_action('medical_hospital_below_slider_section'); ?>

  <?php if( get_theme_mod( 'medical_hospital_services') != '') { ?>
    <div class="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 offset-lg-1 offset-md-1 col-md-10 top-service row">
            <?php 
            $medical_hospital_catData = get_theme_mod('medical_hospital_services');
            if($medical_hospital_catData){
              $page_query = new WP_Query(array( 'category_name' => esc_html( $medical_hospital_catData ,'medical-hospital')));?>
              <?php while( $page_query->have_posts() ) : $page_query->the_post(); ?>
                  <div class="col-lg-3 col-md-6 main-service-box">
                    <div class="service-box">
                      <div class="abt-img-box"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?></div>
                      <strong><?php the_title(); ?></strong>
                      <a href="<?php the_permalink(); ?>"><i class="fas fa-arrow-right"></i><span class="screen-reader-text"><?php esc_html_e( 'READ MORE', 'medical-hospital' ); ?></span></a>
                    </div>
                  </div>
              <?php endwhile;
              wp_reset_postdata();
            }
            ?>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  <?php }?>

  <?php do_action('medical_hospital_below_service_section'); ?>

  <?php if( get_theme_mod( 'medical_hospital_services') != '') { ?>
    <section class="about">
      <div class="container">
        <?php
        $medical_hospital_postData1 =  get_theme_mod('medical_hospital_about_setting');
        if($medical_hospital_postData1){
          $args = array( 'name' => esc_html($medical_hospital_postData1 ,'medical-hospital'));
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
              <div class="row m-0">
                <div class="col-lg-8 col-md-8">
                  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></a></h2>
                  <div class="images_border">
                    <img role="img" src="<?php echo esc_url( get_theme_mod('',get_template_directory_uri().'/images/border-image.png') ); ?>" alt="<?php esc_attr_e( 'Border Image', 'medical-hospital' ); ?>">
                  </div>
                  <div class="textbox">
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>"><?php esc_html_e('FIND OUT MORE','medical-hospital'); ?><span class="screen-reader-text"><?php esc_html_e( 'FIND OUT MORE', 'medical-hospital' ); ?></span></a>
                  </div>
                </div> 
                <div class="col-lg-4 col-md-4">
                  <div class="abt-image">
                    <?php the_post_thumbnail(); ?>             
                  </div>
                </div>   
              </div>                
            <?php endwhile; 
            wp_reset_postdata();?>
          <?php else : ?>
            <div class="no-postfound"></div>
          <?php
        endif; }?>
      </div>
    </section>
  <?php }?>

  <?php do_action('medical_hospital_after_about_section'); ?>

  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>

<?php get_footer(); ?>