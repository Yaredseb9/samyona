<?php
/**
 * Medical Hospital Theme Customizer
 * @package Medical Hospital
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function medical_hospital_customize_register( $wp_customize ) {	

	class Medical_Hospital_WP_Customize_Range_Control extends WP_Customize_Control{
	    public $type = 'custom_range';
	    public function enqueue(){
	        wp_enqueue_script(
	            'cs-range-control',
	            false,
	            true
	        );
	    }
	    public function render_content(){?>
	        <label>
	            <?php if ( ! empty( $this->label )) : ?>
	                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	            <?php endif; ?>
	            <div class="cs-range-value"><?php echo esc_html($this->value()); ?></div>
	            <input data-input-type="range" type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
	            <?php if ( ! empty( $this->description )) : ?>
	                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
	            <?php endif; ?>
	        </label>
        <?php }
	}

	//add home page setting pannel
	$wp_customize->add_panel( 'medical_hospital_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'medical-hospital' ),
	    'description' => __( 'Description of what this panel does.', 'medical-hospital' ),
	) );

	// Add the Theme Color Option section.
	$wp_customize->add_section( 'medical_hospital_theme_color_option', array( 
		'panel' => 'medical_hospital_panel_id', 
		'title' => esc_html__( 'Global Color Settings', 'medical-hospital' ) 
	) );

  	$wp_customize->add_setting( 'medical_hospital_theme_color', array(
	    'default' => '#1776c6',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_theme_color', array(
  		'label' => 'Color Option',
	    'description' => __('One can change complete theme global color settings on just one click.', 'medical-hospital'),
	    'section' => 'medical_hospital_theme_color_option',
	    'settings' => 'medical_hospital_theme_color',
  	)));

    $medical_hospital_font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammersmith One' =>'Hammersmith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

	//Typography
	$wp_customize->add_section( 'medical_hospital_typography', array(
    	'title'      => __( 'Typography', 'medical-hospital' ),
		'priority'   => null,
		'panel' => 'medical_hospital_panel_id'
	) );
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'medical_hospital_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_paragraph_color', array(
		'label' => __('Paragraph Color', 'medical-hospital'),
		'section' => 'medical_hospital_typography',
		'settings' => 'medical_hospital_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('medical_hospital_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control(
	    'medical_hospital_paragraph_font_family', array(
	    'section'  => 'medical_hospital_typography',
	    'label'    => __( 'Paragraph Fonts','medical-hospital'),
	    'type'     => 'select',
	    'choices'  => $medical_hospital_font_array,
	));

	$wp_customize->add_setting('medical_hospital_paragraph_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','medical-hospital'),
		'section'	=> 'medical_hospital_typography',
		'setting'	=> 'medical_hospital_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'medical_hospital_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_atag_color', array(
		'label' => __('"a" Tag Color', 'medical-hospital'),
		'section' => 'medical_hospital_typography',
		'settings' => 'medical_hospital_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('medical_hospital_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control(
	    'medical_hospital_atag_font_family', array(
	    'section'  => 'medical_hospital_typography',
	    'label'    => __( '"a" Tag Fonts','medical-hospital'),
	    'type'     => 'select',
	    'choices'  => $medical_hospital_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'medical_hospital_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_li_color', array(
		'label' => __('"li" Tag Color', 'medical-hospital'),
		'section' => 'medical_hospital_typography',
		'settings' => 'medical_hospital_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('medical_hospital_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control(
	    'medical_hospital_li_font_family', array(
	    'section'  => 'medical_hospital_typography',
	    'label'    => __( '"li" Tag Fonts','medical-hospital'),
	    'type'     => 'select',
	    'choices'  => $medical_hospital_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'medical_hospital_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_h1_color', array(
		'label' => __('H1 Color', 'medical-hospital'),
		'section' => 'medical_hospital_typography',
		'settings' => 'medical_hospital_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('medical_hospital_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control(
	    'medical_hospital_h1_font_family', array(
	    'section'  => 'medical_hospital_typography',
	    'label'    => __( 'H1 Fonts','medical-hospital'),
	    'type'     => 'select',
	    'choices'  => $medical_hospital_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('medical_hospital_h1_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_h1_font_size',array(
		'label'	=> __('H1 Font Size','medical-hospital'),
		'section'	=> 'medical_hospital_typography',
		'setting'	=> 'medical_hospital_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'medical_hospital_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_h2_color', array(
		'label' => __('H2 Color', 'medical-hospital'),
		'section' => 'medical_hospital_typography',
		'settings' => 'medical_hospital_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('medical_hospital_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control(
	    'medical_hospital_h2_font_family', array(
	    'section'  => 'medical_hospital_typography',
	    'label'    => __( 'H2 Fonts','medical-hospital'),
	    'type'     => 'select',
	    'choices'  => $medical_hospital_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('medical_hospital_h2_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_h2_font_size',array(
		'label'	=> __('H2 Font Size','medical-hospital'),
		'section'	=> 'medical_hospital_typography',
		'setting'	=> 'medical_hospital_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'medical_hospital_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_h3_color', array(
		'label' => __('H3 Color', 'medical-hospital'),
		'section' => 'medical_hospital_typography',
		'settings' => 'medical_hospital_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('medical_hospital_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control(
	    'medical_hospital_h3_font_family', array(
	    'section'  => 'medical_hospital_typography',
	    'label'    => __( 'H3 Fonts','medical-hospital'),
	    'type'     => 'select',
	    'choices'  => $medical_hospital_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('medical_hospital_h3_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_h3_font_size',array(
		'label'	=> __('H3 Font Size','medical-hospital'),
		'section'	=> 'medical_hospital_typography',
		'setting'	=> 'medical_hospital_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'medical_hospital_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_h4_color', array(
		'label' => __('H4 Color', 'medical-hospital'),
		'section' => 'medical_hospital_typography',
		'settings' => 'medical_hospital_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('medical_hospital_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control(
	    'medical_hospital_h4_font_family', array(
	    'section'  => 'medical_hospital_typography',
	    'label'    => __( 'H4 Fonts','medical-hospital'),
	    'type'     => 'select',
	    'choices'  => $medical_hospital_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('medical_hospital_h4_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_h4_font_size',array(
		'label'	=> __('H4 Font Size','medical-hospital'),
		'section'	=> 'medical_hospital_typography',
		'setting'	=> 'medical_hospital_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'medical_hospital_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_h5_color', array(
		'label' => __('H5 Color', 'medical-hospital'),
		'section' => 'medical_hospital_typography',
		'settings' => 'medical_hospital_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('medical_hospital_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control(
	    'medical_hospital_h5_font_family', array(
	    'section'  => 'medical_hospital_typography',
	    'label'    => __( 'H5 Fonts','medical-hospital'),
	    'type'     => 'select',
	    'choices'  => $medical_hospital_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('medical_hospital_h5_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_h5_font_size',array(
		'label'	=> __('H5 Font Size','medical-hospital'),
		'section'	=> 'medical_hospital_typography',
		'setting'	=> 'medical_hospital_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'medical_hospital_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_h6_color', array(
		'label' => __('H6 Color', 'medical-hospital'),
		'section' => 'medical_hospital_typography',
		'settings' => 'medical_hospital_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('medical_hospital_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control(
	    'medical_hospital_h6_font_family', array(
	    'section'  => 'medical_hospital_typography',
	    'label'    => __( 'H6 Fonts','medical-hospital'),
	    'type'     => 'select',
	    'choices'  => $medical_hospital_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('medical_hospital_h6_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_h6_font_size',array(
		'label'	=> __('H6 Font Size','medical-hospital'),
		'section'	=> 'medical_hospital_typography',
		'setting'	=> 'medical_hospital_h6_font_size',
		'type'	=> 'text'
	));

    //Social Icons(topbar)
	$wp_customize->add_section('medical_hospital_social_media',array(
		'title'	=> __('Social Icon','medical-hospital'),
		'description'	=> __('Add Header Content here','medical-hospital'),
		'priority'	=> null,
		'panel' => 'medical_hospital_panel_id',
	));

	$wp_customize->add_setting('medical_hospital_facebook',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('medical_hospital_facebook',array(
		'label'	=> __('Add Facebook link','medical-hospital'),
		'section'	=> 'medical_hospital_social_media',
		'setting'	=> 'medical_hospital_facebook',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('medical_hospital_twitter',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('medical_hospital_twitter',array(
		'label'	=> __('Add Twitter link','medical-hospital'),
		'section'	=> 'medical_hospital_social_media',
		'setting'	=> 'medical_hospital_twitter',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('medical_hospital_tumblr',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('medical_hospital_tumblr',array(
		'label'	=> __('Add Tumblr link','medical-hospital'),
		'section'	=> 'medical_hospital_social_media',
		'setting'	=> 'medical_hospital_tumblr',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('medical_hospital_pintrest',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('medical_hospital_pintrest',array(
		'label'	=> __('Add Pintrest link','medical-hospital'),
		'section'	=> 'medical_hospital_social_media',
		'setting'	=> 'medical_hospital_pintrest',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('medical_hospital_insta',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('medical_hospital_insta',array(
		'label'	=> __('Add Instagram link','medical-hospital'),
		'section'	=> 'medical_hospital_social_media',
		'setting'	=> 'medical_hospital_insta',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('medical_hospital_linkdin',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('medical_hospital_linkdin',array(
		'label'	=> __('Add Linkdin link','medical-hospital'),
		'section'	=> 'medical_hospital_social_media',
		'setting'	=> 'medical_hospital_linkdin',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('medical_hospital_youtube',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('medical_hospital_youtube',array(
		'label'	=> __('Add Youtube link','medical-hospital'),
		'section'	=> 'medical_hospital_social_media',
		'setting'	=> 'medical_hospital_youtube',
		'type'	=> 'url'
	));

	//Topbar section
	$wp_customize->add_section('medical_hospital_topbar_icon',array(
		'title'	=> __('Topbar Section','medical-hospital'),
		'description'	=> __('Add Header Content here','medical-hospital'),
		'priority'	=> null,
		'panel' => 'medical_hospital_panel_id',
	));

	$wp_customize->add_setting('medical_hospital_top_header',array(
       'default' => true,
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_top_header',array(
       'type' => 'checkbox',
       'label' => __('Enable Top Header','medical-hospital'),
       'section' => 'medical_hospital_topbar_icon'
    ));

    $wp_customize->add_setting('medical_hospital_topbar_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('medical_hospital_topbar_padding',array(
		'label'	=> esc_html__('Topbar Padding','medical-hospital'),
		'section'=> 'medical_hospital_topbar_icon',
	));

    $wp_customize->add_setting('medical_hospital_top_topbar_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_top_topbar_padding',array(
		'description'	=> __('Top','medical-hospital'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'medical_hospital_topbar_icon',
		'type'=> 'number',
	));

	$wp_customize->add_setting('medical_hospital_bottom_topbar_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_bottom_topbar_padding',array(
		'description'	=> __('Bottom','medical-hospital'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'medical_hospital_topbar_icon',
		'type'=> 'number',
	));

    $wp_customize->add_setting('medical_hospital_sticky_header',array(
       'default' => '',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_sticky_header',array(
       'type' => 'checkbox',
       'label' => __('Stick header on Desktop','medical-hospital'),
       'section' => 'medical_hospital_topbar_icon'
    ));

    $wp_customize->add_setting('medical_hospital_sticky_header_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('medical_hospital_sticky_header_padding',array(
		'label'	=> esc_html__('Sticky Header Padding','medical-hospital'),
		'section'=> 'medical_hospital_topbar_icon',
		'type' => 'hidden',
	));

    $wp_customize->add_setting('medical_hospital_top_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_top_sticky_header_padding',array(
		'description'	=> __('Top','medical-hospital'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'medical_hospital_topbar_icon',
		'type'=> 'number'
	));

	$wp_customize->add_setting('medical_hospital_bottom_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_bottom_sticky_header_padding',array(
		'description'	=> __('Bottom','medical-hospital'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'medical_hospital_topbar_icon',
		'type'=> 'number'
	));

	$wp_customize->add_setting('medical_hospital_show_search',array(
       'default' => 'true',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_show_search',array(
       'type' => 'checkbox',
       'label' => __('Show/Hide Search','medical-hospital'),
       'section' => 'medical_hospital_topbar_icon'
    ));

    $wp_customize->add_setting('medical_hospital_search_placeholder',array(
       'default' => 'Search',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('medical_hospital_search_placeholder',array(
       'type' => 'text',
       'label' => __('Search Placeholder text','medical-hospital'),
       'section' => 'medical_hospital_topbar_icon'
    ));

	$wp_customize->add_setting('medical_hospital_time',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_time',array(
		'label'	=> __('Add Time','medical-hospital'),
		'section'	=> 'medical_hospital_topbar_icon',
		'setting'	=> 'medical_hospital_time',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('medical_hospital_time1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_time1',array(
		'label'	=> __('Add Time','medical-hospital'),
		'section'	=> 'medical_hospital_topbar_icon',
		'setting'	=> 'medical_hospital_time1',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('medical_hospital_phone',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_phone',array(
		'label'	=> __('Add Contact','medical-hospital'),
		'section'	=> 'medical_hospital_topbar_icon',
		'setting'	=> 'medical_hospital_phone',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('medical_hospital_phone1',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_phone1',array(
		'label'	=> __('Add Contact','medical-hospital'),
		'section'	=> 'medical_hospital_topbar_icon',
		'setting'	=> 'medical_hospital_phone1',
		'type'		=> 'text'
	));	

	$wp_customize->add_setting('medical_hospital_address',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('medical_hospital_address',array(
		'label'	=> __('Add Address','medical-hospital'),
		'section'	=> 'medical_hospital_topbar_icon',
		'setting'	=> 'medical_hospital_address',
		'type'		=> 'text'
	));	

	//home page slider
	$wp_customize->add_section( 'medical_hospital_slidersettings' , array(
    	'title'  => __( 'Slider Settings', 'medical-hospital' ),
		'priority'   => null,
		'panel' => 'medical_hospital_panel_id'
	) );

	$wp_customize->add_setting('medical_hospital_slider_hide',array(
       'default' => false,
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_slider_hide',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','medical-hospital'),
       'section' => 'medical_hospital_slidersettings'
    ));

    $wp_customize->add_setting('medical_hospital_slider_title',array(
        'default' => true,
        'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
	));
	$wp_customize->add_control('medical_hospital_slider_title',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Slider Title','medical-hospital'),
      	'section' => 'medical_hospital_slidersettings'
	));

	$wp_customize->add_setting('medical_hospital_slider_content',array(
        'default' => true,
        'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
	));
	$wp_customize->add_control('medical_hospital_slider_content',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Slider Content','medical-hospital'),
      	'section' => 'medical_hospital_slidersettings'
	));

	$wp_customize->add_setting('medical_hospital_slider_button',array(
        'default' => true,
        'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
	));
	$wp_customize->add_control('medical_hospital_slider_button',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Slider Button','medical-hospital'),
      	'section' => 'medical_hospital_slidersettings'
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'medical_hospital_slidersettings_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'medical_hospital_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'medical_hospital_slidersettings_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'medical-hospital' ),
			'section'  => 'medical_hospital_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting( 'medical_hospital_slider_speed', array(
		'default'              => 3000,
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	) );
	$wp_customize->add_control( 'medical_hospital_slider_speed', array(
		'label'       => esc_html__( 'Slider Speed','medical-hospital' ),
		'section'     => 'medical_hospital_slidersettings',
		'type'        => 'number',
		'settings'    => 'medical_hospital_slider_speed',
		'input_attrs' => array(
			'step'             => 500,
			'min'              => 500,
			'max'              => 5000,
		),
	) );

	//content Alignment
    $wp_customize->add_setting('medical_hospital_slider_alignment_option',array(
    'default' => __('Center Align','medical-hospital'),
        'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control('medical_hospital_slider_alignment_option',array(
        'type' => 'radio',
        'label' => __('Slider Content Alignment','medical-hospital'),
        'section' => 'medical_hospital_slidersettings',
        'choices' => array(
            'Center Align' => __('Center Align','medical-hospital'),
            'Left Align' => __('Left Align','medical-hospital'),
            'Right Align' => __('Right Align','medical-hospital'),
        ),
	) );

    //Slider excerpt
	$wp_customize->add_setting( 'medical_hospital_slider_excerpt_number', array(
		'default'              => 15,
		'sanitize_callback'    => 'medical_hospital_sanitize_float',
	) );
	$wp_customize->add_control( 'medical_hospital_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','medical-hospital' ),
		'section'     => 'medical_hospital_slidersettings',
		'type'        => 'number',
		'settings'    => 'medical_hospital_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('medical_hospital_slider_image_overlay',array(
        'default' => true,
        'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
	));
	$wp_customize->add_control('medical_hospital_slider_image_overlay',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Slider Image Overlay','medical-hospital'),
      	'section' => 'medical_hospital_slidersettings',
	));

	$wp_customize->add_setting( 'medical_hospital_slider_overlay_color', array(
	    'default' => '#000',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_slider_overlay_color', array(
	    'label' => __('Slider Overlay Color', 'medical-hospital'),
	    'section' => 'medical_hospital_slidersettings',
  	)));

	//Opacity
	$wp_customize->add_setting('medical_hospital_slider_opacity_color',array(
      'default'              => 0.7,
      'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control( 'medical_hospital_slider_opacity_color', array(
		'label'       => esc_html__( 'Slider Image Opacity','medical-hospital' ),
		'section'     => 'medical_hospital_slidersettings',
		'type'        => 'select',
		'settings'    => 'medical_hospital_slider_opacity_color',
		'choices' => array(
	      '0' =>  esc_attr('0','medical-hospital'),
	      '0.1' =>  esc_attr('0.1','medical-hospital'),
	      '0.2' =>  esc_attr('0.2','medical-hospital'),
	      '0.3' =>  esc_attr('0.3','medical-hospital'),
	      '0.4' =>  esc_attr('0.4','medical-hospital'),
	      '0.5' =>  esc_attr('0.5','medical-hospital'),
	      '0.6' =>  esc_attr('0.6','medical-hospital'),
	      '0.7' =>  esc_attr('0.7','medical-hospital'),
	      '0.8' =>  esc_attr('0.8','medical-hospital'),
	      '0.9' =>  esc_attr('0.9','medical-hospital')
		),
	));

	$wp_customize->add_setting( 'medical_hospital_slider_button_label', array(
		'default' => __('READ MORE','medical-hospital' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'medical_hospital_slider_button_label', array(
		'label' => esc_html__( 'Slider Button Label','medical-hospital' ),
		'section'     => 'medical_hospital_slidersettings',
		'type'        => 'text',
		'settings'    => 'medical_hospital_slider_button_label'
	) );

	//Service
	$wp_customize->add_section('medical_hospital_services',array(
		'title'	=> __('Services Section','medical-hospital'),
		'description'	=> __('Add Services sections below.','medical-hospital'),
		'panel' => 'medical_hospital_panel_id',
	));	
	
	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_post[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('medical_hospital_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'medical_hospital_sanitize_choices',
	));
	$wp_customize->add_control('medical_hospital_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display Latest Post','medical-hospital'),
		'section' => 'medical_hospital_services',
	));

	//About
	$wp_customize->add_section('medical_hospital_about1',array(
		'title'	=> __('About Section','medical-hospital'),
		'description'	=> __('Add About sections below.','medical-hospital'),
		'panel' => 'medical_hospital_panel_id',
	));

	$args = array('numberposts' => -1);
	$post_list = get_posts($args);
 	$i = 0;
	$pst[]='Select';  
	foreach($post_list as $post){
		$pst[$post->post_title] = $post->post_title;
	}

	$wp_customize->add_setting('medical_hospital_about_setting',array(
		'sanitize_callback' => 'medical_hospital_sanitize_choices',
	));

	$wp_customize->add_control('medical_hospital_about_setting',array(
		'type'    => 'select',
		'choices' => $pst,
		'label' => __('Select post','medical-hospital'),
		'section' => 'medical_hospital_about1',
	));

	//layout setting
	$wp_customize->add_section( 'medical_hospital_theme_layout', array(
    	'title'   => __( 'Blog Settings', 'medical-hospital' ),
		'priority'   => null,
		'panel' => 'medical_hospital_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('medical_hospital_layout',array(
        'default' => __( 'Right Sidebar', 'medical-hospital' ),
        'sanitize_callback' => 'medical_hospital_sanitize_choices'	        
    ));

	$wp_customize->add_control('medical_hospital_layout', array(
        'type' => 'radio',
        'section' => 'medical_hospital_theme_layout',
   		'label' => __('Blog Layout','medical-hospital'),
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','medical-hospital'),
            'Right Sidebar' => __('Right Sidebar','medical-hospital'),
            'One Column' => __('One Column','medical-hospital'),
            'Three Columns' => __('Three Columns','medical-hospital'),
            'Four Columns' => __('Four Columns','medical-hospital'),
            'Grid Layout' => __('Grid Layout','medical-hospital')
        ),
    ));

    $wp_customize->add_setting('medical_hospital_metafields_date',array(
       'default' => true,
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_metafields_date',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Date ','medical-hospital'),
       'section' => 'medical_hospital_theme_layout'
    ));

    $wp_customize->add_setting('medical_hospital_metafields_author',array(
       'default' => true,
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_metafields_author',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Author','medical-hospital'),
       'section' => 'medical_hospital_theme_layout'
    ));

    $wp_customize->add_setting('medical_hospital_metafields_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_metafields_comment',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Comments','medical-hospital'),
       'section' => 'medical_hospital_theme_layout'
    ));

    $wp_customize->add_setting('medical_hospital_post_navigation',array(
       'default' => 'true',
       'sanitize_callback' => 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_post_navigation',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Post Navigation','medical-hospital'),
       'section' => 'medical_hospital_theme_layout'
    ));

    $wp_customize->add_setting('medical_hospital_blog_post_content',array(
    	'default' => __('Excerpt Content','medical-hospital'),
        'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control('medical_hospital_blog_post_content',array(
        'type' => 'radio',
        'label' => __('Blog Post Content Type','medical-hospital'),
        'section' => 'medical_hospital_theme_layout',
        'choices' => array(
            'No Content' => __('No Content','medical-hospital'),
            'Full Content' => __('Full Content','medical-hospital'),
            'Excerpt Content' => __('Excerpt Content','medical-hospital'),
        ),
	) );

    $wp_customize->add_setting( 'medical_hospital_post_excerpt_number', array(
		'default'              => 20,
       'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	) );
	$wp_customize->add_control( 'medical_hospital_post_excerpt_number', array(
		'label'       => esc_html__( 'Blog Post Excerpt Number (Max 50)','medical-hospital' ),
		'section'     => 'medical_hospital_theme_layout',
		'type'        => 'number',
		'settings'    => 'medical_hospital_post_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
		'active_callback' => 'medical_hospital_excerpt_enabled'
	) );

	$wp_customize->add_setting( 'medical_hospital_button_excerpt_suffix', array(
		'default'   => '...',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'medical_hospital_button_excerpt_suffix', array(
		'label'       => esc_html__( 'Post Excerpt Suffix','medical-hospital' ),
		'section'     => 'medical_hospital_theme_layout',
		'type'        => 'text',
		'settings'    => 'medical_hospital_button_excerpt_suffix',
		'active_callback' => 'medical_hospital_excerpt_enabled'
	) );

	$wp_customize->add_setting( 'medical_hospital_feature_image_border_radius', array(
		'default'=> '0',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new Medical_Hospital_WP_Customize_Range_Control( $wp_customize, 'medical_hospital_feature_image_border_radius', array(
        'label'  => __('Featured Image Border Radius','medical-hospital'),
        'section'  => 'medical_hospital_theme_layout',
        'description' => __('Measurement is in pixel.','medical-hospital'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        ),
    )));

    $wp_customize->add_setting( 'medical_hospital_feature_image_shadow', array(
		'default'=> '0',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new Medical_Hospital_WP_Customize_Range_Control( $wp_customize, 'medical_hospital_feature_image_shadow', array(
        'label'  => __('Featured Image Shadow','medical-hospital'),
        'section'  => 'medical_hospital_theme_layout',
        'description' => __('Measurement is in pixel.','medical-hospital'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        ),
    )));

    $wp_customize->add_setting( 'medical_hospital_pagination_type', array(
        'default'			=> 'page-numbers',
        'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'medical_hospital_pagination_type', array(
        'section' => 'medical_hospital_theme_layout',
        'type' => 'select',
        'label' => __( 'Blog Pagination Style', 'medical-hospital' ),
        'choices'		=> array(
            'page-numbers'  => __( 'Number', 'medical-hospital' ),
            'next-prev' => __( 'Next/Prev', 'medical-hospital' ),
    )));

	$wp_customize->add_section( 'medical_hospital_single_post_settings', array(
		'title' => __( 'Single Post Options', 'medical-hospital' ),
		'panel' => 'medical_hospital_panel_id',
	));

	$wp_customize->add_setting('medical_hospital_single_post_date',array(
       'default' => 'true',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_single_post_date',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Date','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

    $wp_customize->add_setting('medical_hospital_single_post_author',array(
       'default' => 'true',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_single_post_author',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Author','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

    $wp_customize->add_setting('medical_hospital_single_post_comment_no',array(
       'default' => 'true',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_single_post_comment_no',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Comment Number','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

	$wp_customize->add_setting('medical_hospital_metafields_tags',array(
       'default' => 'true',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_metafields_tags',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Tags','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

    $wp_customize->add_setting('medical_hospital_single_post_image',array(
       'default' => 'true',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_single_post_image',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Featured Image','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

    $wp_customize->add_setting('medical_hospital_single_post_nav',array(
       'default' => 'true',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_single_post_nav',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Navigation','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

    $wp_customize->add_setting( 'medical_hospital_single_post_prev_nav_text', array(
		'default' => __('Previous','medical-hospital' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'medical_hospital_single_post_prev_nav_text', array(
		'label' => esc_html__( 'Single Post Previous Nav text','medical-hospital' ),
		'section'     => 'medical_hospital_single_post_settings',
		'type'        => 'text',
		'settings'    => 'medical_hospital_single_post_prev_nav_text'
	) );

	$wp_customize->add_setting( 'medical_hospital_single_post_next_nav_text', array(
		'default' => __('Next','medical-hospital' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'medical_hospital_single_post_next_nav_text', array(
		'label' => esc_html__( 'Single Post Next Nav text','medical-hospital' ),
		'section'     => 'medical_hospital_single_post_settings',
		'type'        => 'text',
		'settings'    => 'medical_hospital_single_post_next_nav_text'
	) );

    $wp_customize->add_setting('medical_hospital_single_post_comment',array(
       'default' => 'true',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_single_post_comment',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post comment','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

	$wp_customize->add_setting( 'medical_hospital_comment_width', array(
		'default'=> '100',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new medical_hospital_WP_Customize_Range_Control( $wp_customize, 'medical_hospital_comment_width', array(
        'label'  => __('Comment textarea width','medical-hospital'),
        'section'  => 'medical_hospital_single_post_settings',
        'description' => __('Measurement is in %.','medical-hospital'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 100,
        ),
    )));

    $wp_customize->add_setting('medical_hospital_comment_title',array(
       'default' => __('Leave a Reply','medical-hospital'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('medical_hospital_comment_title',array(
       'type' => 'text',
       'label' => __('Comment form Title','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

    $wp_customize->add_setting('medical_hospital_comment_submit_text',array(
       'default' => __('Post Comment','medical-hospital'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('medical_hospital_comment_submit_text',array(
       'type' => 'text',
       'label' => __('Comment Submit Button Label','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

	$wp_customize->add_setting('medical_hospital_related_posts',array(
       'default' => true,
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_related_posts',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Related Posts','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

    $wp_customize->add_setting('medical_hospital_related_posts_title',array(
       'default' => __('You May Also Like','medical-hospital'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('medical_hospital_related_posts_title',array(
       'type' => 'text',
       'label' => __('Related Posts Title','medical-hospital'),
       'section' => 'medical_hospital_single_post_settings'
    ));

    $wp_customize->add_setting( 'medical_hospital_related_post_count', array(
		'default' => 3,
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	) );
	$wp_customize->add_control( 'medical_hospital_related_post_count', array(
		'label' => esc_html__( 'Related Posts Count','medical-hospital' ),
		'section' => 'medical_hospital_single_post_settings',
		'type' => 'number',
		'settings' => 'medical_hospital_related_post_count',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 6,
		),
	) );

    $wp_customize->add_setting( 'medical_hospital_post_shown_by', array(
        'default' => 'categories',
        'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'medical_hospital_post_shown_by', array(
        'section' => 'medical_hospital_single_post_settings',
        'type' => 'radio',
        'label' => __( 'Related Posts must be shown:', 'medical-hospital' ),
        'choices'		=> array(
            'categories'  => __('By Categories', 'medical-hospital'),
            'tags' => __( 'By Tags', 'medical-hospital' ),
    )));

	// Button option
	$wp_customize->add_section( 'medical_hospital_button_options', array(
		'title' =>  __( 'Button Options', 'medical-hospital' ),
		'panel' => 'medical_hospital_panel_id',
	));

    $wp_customize->add_setting( 'medical_hospital_blog_button_text', array(
		'default'   => 'Read Full',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'medical_hospital_blog_button_text', array(
		'label'       => esc_html__( 'Blog Post Button Label','medical-hospital' ),
		'section'     => 'medical_hospital_button_options',
		'type'        => 'text',
		'settings'    => 'medical_hospital_blog_button_text'
	) );

	$wp_customize->add_setting('medical_hospital_button_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('medical_hospital_button_padding',array(
		'label'	=> esc_html__('Button Padding','medical-hospital'),
		'section'=> 'medical_hospital_button_options',
		'active_callback' => 'medical_hospital_button_enabled'
	));

	$wp_customize->add_setting('medical_hospital_top_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_top_button_padding',array(
		'label'	=> __('Top','medical-hospital'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'medical_hospital_button_options',
		'type'=> 'number',
		'active_callback' => 'medical_hospital_button_enabled'
	));

	$wp_customize->add_setting('medical_hospital_bottom_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_bottom_button_padding',array(
		'label'	=> __('Bottom','medical-hospital'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'medical_hospital_button_options',
		'type'=> 'number',
		'active_callback' => 'medical_hospital_button_enabled'
	));

	$wp_customize->add_setting('medical_hospital_left_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_left_button_padding',array(
		'label'	=> __('Left','medical-hospital'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'medical_hospital_button_options',
		'type'=> 'number',
		'active_callback' => 'medical_hospital_button_enabled'
	));

	$wp_customize->add_setting('medical_hospital_right_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_right_button_padding',array(
		'label'	=> __('Right','medical-hospital'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'medical_hospital_button_options',
		'type'=> 'number',
		'active_callback' => 'medical_hospital_button_enabled'
	));

	$wp_customize->add_setting( 'medical_hospital_button_border_radius', array(
		'default'=> 0,
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new Medical_Hospital_WP_Customize_Range_Control( $wp_customize, 'medical_hospital_button_border_radius', array(
            'label'  => __('Border Radius','medical-hospital'),
            'section'  => 'medical_hospital_button_options',
            'description' => __('Measurement is in pixel.','medical-hospital'),
            'input_attrs' => array(
                'min' => 0,
                'max' => 50,
            ),
			'active_callback' => 'medical_hospital_button_enabled'
    )));

    //Sidebar setting
	$wp_customize->add_section( 'medical_hospital_sidebar_options', array(
    	'title'   => __( 'Sidebar options', 'medical-hospital' ),
		'priority'   => null,
		'panel' => 'medical_hospital_panel_id'
	) );

	$wp_customize->add_setting('medical_hospital_single_page_layout',array(
        'default' => __( 'One Column', 'medical-hospital' ),
        'sanitize_callback' => 'medical_hospital_sanitize_choices'
    ));
	$wp_customize->add_control('medical_hospital_single_page_layout', array(
        'type' => 'select',
        'label' => __( 'Single Page Layout', 'medical-hospital' ),
        'section' => 'medical_hospital_sidebar_options',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','medical-hospital'),
            'Right Sidebar' => __('Right Sidebar','medical-hospital'),
            'One Column' => __('One Column','medical-hospital')
        ),
    ));

    $wp_customize->add_setting('medical_hospital_single_post_layout',array(
        'default' => __( 'Right Sidebar', 'medical-hospital' ),
        'sanitize_callback' => 'medical_hospital_sanitize_choices'
    ));
	$wp_customize->add_control('medical_hospital_single_post_layout', array(
        'type' => 'select',
        'label' => __( 'Single Post Layout', 'medical-hospital' ),
        'section' => 'medical_hospital_sidebar_options',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','medical-hospital'),
            'Right Sidebar' => __('Right Sidebar','medical-hospital'),
            'One Column' => __('One Column','medical-hospital')
        ),
    ));

    //Advance Options
	$wp_customize->add_section( 'medical_hospital_advance_options', array(
    	'title' => __( 'Advance Options', 'medical-hospital' ),
		'priority'   => null,
		'panel' => 'medical_hospital_panel_id'
	) );

	$wp_customize->add_setting('medical_hospital_preloader',array(
       'default' => 'true',
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_preloader',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Preloader','medical-hospital'),
       'section' => 'medical_hospital_advance_options'
    ));

    $wp_customize->add_setting( 'medical_hospital_preloader_color', array(
	    'default' => '#333333',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_preloader_color', array(
  		'label' => __('Preloader Color', 'medical-hospital'),
	    'section' => 'medical_hospital_advance_options',
	    'settings' => 'medical_hospital_preloader_color',
  	)));

  	$wp_customize->add_setting( 'medical_hospital_preloader_bg_color', array(
	    'default' => '#ffffff',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'medical_hospital_preloader_bg_color', array(
  		'label' => __('Preloader Background Color', 'medical-hospital'),
	    'section' => 'medical_hospital_advance_options',
	    'settings' => 'medical_hospital_preloader_bg_color',
  	)));

  	$wp_customize->add_setting('medical_hospital_preloader_type',array(
        'default' => __('Square','medical-hospital'),
        'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control('medical_hospital_preloader_type',array(
        'type' => 'radio',
        'label' => __('Preloader Type','medical-hospital'),
        'section' => 'medical_hospital_advance_options',
        'choices' => array(
            'Square' => __('Square','medical-hospital'),
            'Circle' => __('Circle','medical-hospital'),
        ),
	) );

	$wp_customize->add_setting('medical_hospital_theme_layout_options',array(
        'default' => __('Default Theme','medical-hospital'),
        'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control('medical_hospital_theme_layout_options',array(
        'type' => 'radio',
        'label' => __('Theme Layout','medical-hospital'),
        'section' => 'medical_hospital_advance_options',
        'choices' => array(
            'Default Theme' => __('Default Theme','medical-hospital'),
            'Container Theme' => __('Container Theme','medical-hospital'),
            'Box Container Theme' => __('Box Container Theme','medical-hospital'),
        ),
	) );

	//404 Page Option
	$wp_customize->add_section('medical_hospital_404_settings',array(
		'title'	=> __('404 Page & Search Result Settings','medical-hospital'),
		'priority'	=> null,
		'panel' => 'medical_hospital_panel_id',
	));

	$wp_customize->add_setting('medical_hospital_404_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('medical_hospital_404_title',array(
		'label'	=> __('404 Title','medical-hospital'),
		'section'	=> 'medical_hospital_404_settings',
		'type'		=> 'text'
	));	

	$wp_customize->add_setting('medical_hospital_404_button_label',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('medical_hospital_404_button_label',array(
		'label'	=> __('404 button Label','medical-hospital'),
		'section'	=> 'medical_hospital_404_settings',
		'type'		=> 'text'
	));	

	$wp_customize->add_setting('medical_hospital_search_result_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('medical_hospital_search_result_title',array(
		'label'	=> __('No Search Result Title','medical-hospital'),
		'section'	=> 'medical_hospital_404_settings',
		'type'		=> 'text'
	));	

	$wp_customize->add_setting('medical_hospital_search_result_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('medical_hospital_search_result_text',array(
		'label'	=> __('No Search Result Text','medical-hospital'),
		'section'	=> 'medical_hospital_404_settings',
		'type'		=> 'text'
	));	

	//Woocommerce Options
	$wp_customize->add_section('medical_hospital_woocommerce',array(
		'title'	=> __('WooCommerce Options','medical-hospital'),
		'panel' => 'medical_hospital_panel_id',
	));

	$wp_customize->add_setting('medical_hospital_shop_page_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_shop_page_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable Shop Page Sidebar','medical-hospital'),
       'section' => 'medical_hospital_woocommerce'
    ));

    $wp_customize->add_setting('medical_hospital_single_product_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_single_product_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable Single Product Page Sidebar','medical-hospital'),
       'section' => 'medical_hospital_woocommerce'
    ));

    $wp_customize->add_setting('medical_hospital_single_related_products',array(
       'default' => true,
       'sanitize_callback' => 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_single_related_products',array(
       'type' => 'checkbox',
       'label' => __('Enable Related Products','medical-hospital'),
       'section' => 'medical_hospital_woocommerce'
    ));

    $wp_customize->add_setting('medical_hospital_products_per_page',array(
		'default'=> '9',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_products_per_page',array(
		'label'	=> __('Products Per Page','medical-hospital'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'medical_hospital_woocommerce',
		'type'=> 'number',
	));

	$wp_customize->add_setting('medical_hospital_products_per_row',array(
		'default'=> '3',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('medical_hospital_products_per_row',array(
		'label'	=> __('Products Per Row','medical-hospital'),
		'choices' => array(
            '2' => '2',
			'3' => '3',
			'4' => '4',
        ),
		'section'=> 'medical_hospital_woocommerce',
		'type'=> 'select',
	));

	$wp_customize->add_setting('medical_hospital_product_border',array(
       'default' => true,
       'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
    ));
    $wp_customize->add_control('medical_hospital_product_border',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide product border','medical-hospital'),
       'section' => 'medical_hospital_woocommerce',
    ));

    $wp_customize->add_setting('medical_hospital_product_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('medical_hospital_product_padding',array(
		'label'	=> esc_html__('Product Padding','medical-hospital'),
		'section'=> 'medical_hospital_woocommerce',
	));

	$wp_customize->add_setting( 'medical_hospital_product_top_padding',array(
		'default' => 10,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_top_padding', array(
		'label' => esc_html__( 'Top','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('medical_hospital_product_bottom_padding',array(
		'default' => 10,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_bottom_padding', array(
		'label' => esc_html__( 'Bottom','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('medical_hospital_product_left_padding',array(
		'default' => 10,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_left_padding', array(
		'label' => esc_html__( 'Left','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'medical_hospital_product_right_padding',array(
		'default' => 10,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_right_padding', array(
		'label' => esc_html__( 'Right','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'medical_hospital_product_border_radius',array(
		'default' => '0',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( new Medical_Hospital_WP_Customize_Range_Control( $wp_customize, 'medical_hospital_product_border_radius', array(
        'label'  => __('Product Border Radius','medical-hospital'),
        'section'  => 'medical_hospital_woocommerce',
        'description' => __('Measurement is in pixel.','medical-hospital'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));

	$wp_customize->add_setting('medical_hospital_product_button_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('medical_hospital_product_button_padding',array(
		'label'	=> esc_html__('Product Button Padding','medical-hospital'),
		'section'=> 'medical_hospital_woocommerce',
	));

	$wp_customize->add_setting( 'medical_hospital_product_button_top_padding',array(
		'default' => 10,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_button_top_padding', array(
		'label' => esc_html__( 'Top','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('medical_hospital_product_button_bottom_padding',array(
		'default' => 10,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_button_bottom_padding', array(
		'label' => esc_html__( 'Bottom','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('medical_hospital_product_button_left_padding',array(
		'default' => 15,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_button_left_padding', array(
		'label' => esc_html__( 'Left','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'medical_hospital_product_button_right_padding',array(
		'default' => 15,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_button_right_padding', array(
		'label' => esc_html__( 'Right','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'medical_hospital_product_button_border_radius',array(
		'default' => '0',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( new Medical_Hospital_WP_Customize_Range_Control( $wp_customize, 'medical_hospital_product_button_border_radius', array(
        'label'  => __('Product Button Border Radius','medical-hospital'),
        'section'  => 'medical_hospital_woocommerce',
        'description' => __('Measurement is in pixel.','medical-hospital'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));

    $wp_customize->add_setting('medical_hospital_product_sale_position',array(
        'default' => __('Right','medical-hospital'),
        'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control('medical_hospital_product_sale_position',array(
        'type' => 'radio',
        'label' => __('Product Sale Position','medical-hospital'),
        'section' => 'medical_hospital_woocommerce',
        'choices' => array(
            'Left' => __('Left','medical-hospital'),
            'Right' => __('Right','medical-hospital'),
        ),
	) );

    $wp_customize->add_setting('medical_hospital_product_sale_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('medical_hospital_product_sale_padding',array(
		'label'	=> esc_html__('Product Sale Padding','medical-hospital'),
		'section'=> 'medical_hospital_woocommerce',
	));

	$wp_customize->add_setting( 'medical_hospital_product_sale_top_padding',array(
		'default' => 0,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_sale_top_padding', array(
		'label' => esc_html__( 'Top','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('medical_hospital_product_sale_bottom_padding',array(
		'default' => 0,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_sale_bottom_padding', array(
		'label' => esc_html__( 'Bottom','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('medical_hospital_product_sale_left_padding',array(
		'default' => 0,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_sale_left_padding', array(
		'label' => esc_html__( 'Left','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('medical_hospital_product_sale_right_padding',array(
		'default' => 0,
		'sanitize_callback' => 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_product_sale_right_padding', array(
		'label' => esc_html__( 'Right','medical-hospital' ),
		'type' => 'number',
		'section' => 'medical_hospital_woocommerce',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'medical_hospital_product_sale_border_radius',array(
		'default' => '50',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control( new Medical_Hospital_WP_Customize_Range_Control( $wp_customize, 'medical_hospital_product_sale_border_radius', array(
        'label'  => __('Product Sale Border Radius','medical-hospital'),
        'section'  => 'medical_hospital_woocommerce',
        'description' => __('Measurement is in pixel.','medical-hospital'),
        'input_attrs' => array(
            'min' => 0,
            'max' => 50,
        )
    )));

	//footer text
	$wp_customize->add_section('medical_hospital_footer_section',array(
		'title'	=> __('Footer Section','medical-hospital'),
		'panel' => 'medical_hospital_panel_id'
	));

	$wp_customize->add_setting('medical_hospital_hide_scroll',array(
        'default' => 'true',
        'sanitize_callback'	=> 'medical_hospital_sanitize_checkbox'
	));
	$wp_customize->add_control('medical_hospital_hide_scroll',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Back To Top','medical-hospital'),
      	'section' => 'medical_hospital_footer_section',
	));

	$wp_customize->add_setting('medical_hospital_back_to_top',array(
        'default' => __('Right','medical-hospital'),
        'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control('medical_hospital_back_to_top',array(
        'type' => 'radio',
        'label' => __('Back to Top Alignment','medical-hospital'),
        'section' => 'medical_hospital_footer_section',
        'choices' => array(
            'Left' => __('Left','medical-hospital'),
            'Right' => __('Right','medical-hospital'),
            'Center' => __('Center','medical-hospital'),
        ),
	) );

	$wp_customize->add_setting('medical_hospital_footer_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'medical_hospital_footer_bg_color', array(
		'label'    => __('Footer Background Color', 'medical-hospital'),
		'section'  => 'medical_hospital_footer_section',
	)));

	$wp_customize->add_setting('medical_hospital_footer_bg_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'medical_hospital_footer_bg_image',array(
        'label' => __('Footer Background Image','medical-hospital'),
        'section' => 'medical_hospital_footer_section'
	)));

	$wp_customize->add_setting('medical_hospital_footer_widget',array(
        'default'           => '4',
        'sanitize_callback' => 'medical_hospital_sanitize_choices',
    ));
    $wp_customize->add_control('medical_hospital_footer_widget',array(
        'type'        => 'radio',
        'label'       => __('No. of Footer columns', 'medical-hospital'),
        'section'     => 'medical_hospital_footer_section',
        'description' => __('Select the number of footer columns and add your widgets in the footer.', 'medical-hospital'),
        'choices' => array(
            '1'     => __('One column', 'medical-hospital'),
            '2'     => __('Two columns', 'medical-hospital'),
            '3'     => __('Three columns', 'medical-hospital'),
            '4'     => __('Four columns', 'medical-hospital')
        ),
    )); 

    $wp_customize->add_setting('medical_hospital_copyright_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('medical_hospital_copyright_padding',array(
		'label'	=> esc_html__('Copyright Padding','medical-hospital'),
		'section'=> 'medical_hospital_footer_section',
	));

    $wp_customize->add_setting('medical_hospital_top_copyright_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_top_copyright_padding',array(
		'description'	=> __('Top','medical-hospital'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'medical_hospital_footer_section',
		'type'=> 'number'
	));

	$wp_customize->add_setting('medical_hospital_bottom_copyright_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'medical_hospital_sanitize_float'
	));
	$wp_customize->add_control('medical_hospital_bottom_copyright_padding',array(
		'description'	=> __('Bottom','medical-hospital'),
		'input_attrs' => array(
            'step' => 1,
			'min' => 0,
			'max' => 50,
        ),
		'section'=> 'medical_hospital_footer_section',
		'type'=> 'number'
	));

	$wp_customize->add_setting('medical_hospital_copyright_alignment',array(
        'default' => 'center',
        'sanitize_callback' => 'medical_hospital_sanitize_choices'
	));
	$wp_customize->add_control('medical_hospital_copyright_alignment',array(
        'type' => 'radio',
        'label' => __('Copyright Alignment','medical-hospital'),
        'section' => 'medical_hospital_footer_section',
        'choices' => array(
            'left' => __('Left','medical-hospital'),
            'right' => __('Right','medical-hospital'),
            'center' => __('Center','medical-hospital'),
        ),
	) );

	$wp_customize->add_setting( 'medical_hospital_copyright_font_size', array(
		'default'=> '15',
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( new Medical_Hospital_WP_Customize_Range_Control( $wp_customize, 'medical_hospital_copyright_font_size', array(
            'label'  => __('Copyright Font Size','medical-hospital'),
            'section'  => 'medical_hospital_footer_section',
            'description' => __('Measurement is in pixel.','medical-hospital'),
            'input_attrs' => array(
                'min' => 0,
                'max' => 50,
            )
    )));
	
	$wp_customize->add_setting('medical_hospital_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('medical_hospital_text',array(
		'label'	=> __('Copyright Text','medical-hospital'),
		'description'	=> __('Add some text for footer like copyright etc.','medical-hospital'),
		'section'	=> 'medical_hospital_footer_section',
		'type'		=> 'text'
	));	
}
add_action( 'customize_register', 'medical_hospital_customize_register' );	

// logo resize
load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Medical_Hospital_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Medical_Hospital_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Medical_Hospital_Customize_Section_Pro(
			$manager,
			'example_1',
				array(
				'priority'   => 9,
				'title'    => esc_html__( 'Medical Hospital Pro', 'medical-hospital' ),
				'pro_text' => esc_html__( 'Go Pro', 'medical-hospital' ),
				'pro_url'  => esc_url('https://www.themesglance.com/themes/premium-medical-wordpress-theme/')					
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'medical-hospital-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'medical-hospital-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Medical_Hospital_Customize::get_instance();