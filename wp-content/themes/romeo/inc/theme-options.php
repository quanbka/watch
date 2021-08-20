<?php

///// Setup the Theme Options

function romeo_customizer( $wp_customize ) {

	// Remove Unwanted Default Sections
	$wp_customize->remove_control("header_image");
	$wp_customize->remove_control("display_header_text");
	$wp_customize->remove_section("background_image");
	$wp_customize->remove_section("colors");


	////////// General Section

	$wp_customize->add_section(
			'general_section',
				array(
						'title' => esc_html__( 'Theme Settings', 'romeo' ),
						'description' => esc_html__( 'The themes general settings section.', 'romeo' ),
						'priority' => 1,
				)
	);

	$wp_customize->add_setting(
		'select_smoothscrolling',
			array(
					'default' => 'on',
					'sanitize_callback' => 'romeo_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'select_smoothscrolling',
			array(
			'label' => esc_html__( 'Smooth Scrolling Effect', 'romeo' ),
			'section' => 'general_section',
			'settings' => 'select_smoothscrolling',
			'type' => 'radio',
			'choices' => array(
				'on' => esc_html__( 'On', 'romeo' ),
				'off' => esc_html__( 'Off', 'romeo' ),
			),
		)
	);

	$wp_customize->add_setting(
  'accent_color',
	    array(
	        'default'     => '#dd2374',
					'sanitize_callback' => 'romeo_sanitize_text',
	    )
	);

	$wp_customize->add_control(
  new WP_Customize_Color_Control(
      $wp_customize,
      'accent_color',
      array(
          'label'      => esc_html__( 'Accent Color', 'romeo' ),
          'section'    => 'general_section',
          'settings'   => 'accent_color'
      )
    )
	);

	$wp_customize->add_setting(
  'spinner_color',
	    array(
	        'default'     => '#cbcaca',
					'sanitize_callback' => 'romeo_sanitize_text',
	    )
	);

	$wp_customize->add_control(
  new WP_Customize_Color_Control(
      $wp_customize,
      'spinner_color',
      array(
          'label'      => esc_html__( 'Preloader Spinner Color', 'romeo' ),
          'section'    => 'general_section',
          'settings'   => 'spinner_color'
      )
    )
	);

	$wp_customize->add_setting(
	    'romeo_logo',
	    	array(
	        	'sanitize_callback' => 'esc_url_raw',
	    	)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control( $wp_customize, 'romeo_logo',
			array(
				'label' => esc_html__( 'Logo', 'romeo' ),
				'section' => 'title_tagline',
				'settings' => 'romeo_logo',
			)
		)
	);

		$wp_customize->add_setting(
			'custom_css',
			array(
				'default'              => '',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'wp_filter_nohtml_kses',
				'sanitize_js_callback' => 'wp_filter_nohtml_kses'
			)
		);

		$wp_customize->add_control(
			'custom_css',
			array(
				'label'    => esc_html__( 'Custom CSS', 'romeo' ),
				'section'  => 'general_section',
				'settings' => 'custom_css',
				'type'     => 'textarea'
			)
		);


	////////// Header Section

		$wp_customize->add_section(
			'header_section',
				array(
						'title' => esc_html__( 'Header', 'romeo' ),
						'description' => esc_html__( 'Settings for the Header.', 'romeo' ),
						'priority' => 54,
				)
			);


				$wp_customize->add_setting(
					'top_text',
					array(
					'default' => '0',
					'sanitize_callback' => 'romeo_sanitize_text',
					)
				);


				$wp_customize->add_control(
					'top_text',
					array(
						'label' => esc_html__( 'Text for the top bar', 'romeo' ),
						'type' => 'text',
						'section' => 'header_section',
					)
				);

		$wp_customize->add_setting(
		  'move_logo_up',
		  array(
		    'default' => '0',
		    'sanitize_callback' => 'romeo_sanitize_text',
		  )
		);

		$wp_customize->add_control(
			'move_logo_up',
			array(
	  		'label' => esc_html__( 'Move Logo Up / Down ( e.g 20 or -20 )', 'romeo' ),
	  		'type' => 'text',
	  		'section' => 'header_section',
			)
		);

		$wp_customize->add_setting(
			'move_logo_left',
			array(
				'default' => '0',
				'sanitize_callback' => 'romeo_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'move_logo_left',
			array(
				'label' => esc_html__( 'Move Logo Left / Right ( e.g 20 or -20 )', 'romeo' ),
				'type' => 'text',
				'section' => 'header_section',
			)
		);

    $wp_customize->add_setting(
		'large_logo',
		array(
        'default' => '',
				'sanitize_callback' => 'esc_attr',
	   ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
		'large_logo',
		array(
        'label'    => esc_html__( 'Large Logo', 'romeo' ),
        'section'  => 'header_section',
        'settings' => 'large_logo',
    ) ) );

		$wp_customize->add_setting(
		'large_logo_white',
		array(
        'default' => '',
				'sanitize_callback' => 'esc_attr',
	   ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
		'large_logo_white',
		array(
        'label'    => esc_html__( 'Large Logo - Light version', 'romeo' ),
        'section'  => 'header_section',
        'settings' => 'large_logo_white',
    ) ) );

		$wp_customize->add_setting(
	        'romeo_header_top_color',
	        array(
	            'default'     => '#fff',
	            'sanitize_callback' => 'romeo_sanitize_text',
	        )
	    );

	    $wp_customize->add_control(
	        new WP_Customize_Color_Control(
	            $wp_customize,
	            'header_top_color',
	            array(
	                'label'      => esc_html__( 'Sticky Header Background Color', 'romeo' ),
	                'section'    => 'header_section',
	                'settings'   => 'romeo_header_top_color'
	            )
	        )
	    );

		////////// Footer Section

			$wp_customize->add_section(
				'footer_section',
					array(
							'title' => esc_html__( 'Footer', 'romeo' ),
							'description' => esc_html__( 'Settings for the Footer.', 'romeo' ),
							'priority' => 54,
					)
		);

		$wp_customize->add_setting(
			'select_fixedfooter',
				array(
						'default' => 'no',
						'sanitize_callback' => 'romeo_sanitize_text',
			)
		);

		$wp_customize->add_control(
			'select_fixedfooter',
				array(
				'label' => esc_html__( 'Stick the footer to the bottom of the screen ?', 'romeo' ),
				'section' => 'footer_section',
				'settings' => 'select_fixedfooter',
				'type' => 'radio',
				'choices' => array(
					'no' => esc_html__( 'No', 'romeo' ),
					'yes' => esc_html__( 'Yes', 'romeo' ),
				),
			)
		);

		$wp_customize->add_setting(
	        'romeo_footer_top_color',
	        array(
	            'default'     => '#1d1d1d',
	            'sanitize_callback' => 'romeo_sanitize_text',
	        )
	    );

	    $wp_customize->add_control(
	        new WP_Customize_Color_Control(
	            $wp_customize,
	            'footer_top_color',
	            array(
	                'label'      => esc_html__( 'Footer Top Row Background Color', 'romeo' ),
	                'section'    => 'footer_section',
	                'settings'   => 'romeo_footer_top_color'
	            )
	        )
	    );

				$wp_customize->add_setting(
			        'romeo_footer_bottom_color',
			        array(
			            'default'     => '#141414',
			            'sanitize_callback' => 'romeo_sanitize_text',
			        )
			    );

			    $wp_customize->add_control(
			        new WP_Customize_Color_Control(
			            $wp_customize,
			            'footer_bottom_color',
			            array(
			                'label'      => esc_html__( 'Footer Bottom Row Background Color', 'romeo' ),
			                'section'    => 'footer_section',
			                'settings'   => 'romeo_footer_bottom_color'
			            )
			        )
			    );


	////////// Blog Section

	$wp_customize->add_section(
			'blog_section',
				array(
						'title' => esc_html__( 'Blog Settings', 'romeo' ),
						'description' => esc_html__( 'The themes blog settings section.', 'romeo' ),
						'priority' => 56,
				)
	);

	$wp_customize->add_setting(
	    'select_blog_layout',
	    	array(
	        	'default' => 'right',
	        	'sanitize_callback' => 'romeo_sanitize_text',
	    	)
	);

	$wp_customize->add_control(
		'select_blog_layout',
			array(
				'label' => esc_html__( 'Blog Sidebar Position', 'romeo' ),
				'section' => 'blog_section',
				'settings' => 'select_blog_layout',
				'type' => 'radio',
				'choices' => array(
					'right' => esc_html__( 'Right', 'romeo' ),
					'none' => esc_html__( 'None', 'romeo' ),
					),
			)
	);

	////////// Shop Section

	$wp_customize->add_section(
			'shop_section',
				array(
						'title' => esc_html__( 'Shop Settings', 'romeo' ),
						'description' => esc_html__( 'The themes shop settings section.', 'romeo' ),
						'priority' => 57,
				)
	);

	$wp_customize->add_setting(
    'select_shop_layout',
    	array(
        	'default' => 'none',
        	'sanitize_callback' => 'romeo_sanitize_text',
    )
	);

	$wp_customize->add_control(
		'select_shop_layout',
			array(
				'label' => esc_html__( 'Shop Sidebar Position', 'romeo' ),
				'section' => 'shop_section',
				'settings' => 'select_shop_layout',
				'type' => 'radio',
				'choices' => array(
					'left' => esc_html__( 'Left', 'romeo' ),
					'right' => esc_html__( 'Right', 'romeo' ),
					'none' => esc_html__( 'None', 'romeo' ),
			),
		)
	);

	$wp_customize->add_setting(
	'shop_header_image',
	array(
			'default' => '',
			'sanitize_callback' => 'esc_attr',
	 ) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,
	'shop_header_image',
	array(
			'label'    => esc_html__( 'Shop Pages Header Background Image', 'romeo' ),
			'section'  => 'shop_section',
			'settings' => 'shop_header_image',
	) ) );

	$wp_customize->add_setting(
  'shop_header_text_color',
	    array(
	        'default'     => '#000',
					'sanitize_callback' => 'romeo_sanitize_text',
	    )
	);

	$wp_customize->add_control(
  new WP_Customize_Color_Control(
      $wp_customize,
      'shop_header_text_color',
      array(
          'label'      => esc_html__( 'Shop Pages Header Text Color', 'romeo' ),
          'section'    => 'shop_section',
          'settings'   => 'shop_header_text_color'
      )
    )
	);

}

add_action( 'customize_register', 'romeo_customizer' );

// Theme Option Functions
	function romeo_sanitize_text( $str ) {
		return sanitize_text_field( $str );
	}

	function romeo_sanitize_textarea( $text ) {
		return esc_textarea( $text );
	}

	function romeo_sanitize_number( $int ) {
		return absint( $int );
	}

	function romeo_sanitize_email( $email ) {
		if(is_email( $email )){
		    return $email;
		}else{
		    return '';
		}
	}

?>
