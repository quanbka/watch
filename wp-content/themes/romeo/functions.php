<?php
// Romeo Theme Functions File

// Include Files
require_once get_template_directory().'/inc/template-tags.php';
require_once get_template_directory().'/inc/theme-options.php';
require_once get_template_directory().'/inc/class-tgm-plugin-activation.php';

// Theme Setup Stage 1

if ( ! function_exists( 'romeo_setup' ) ) :

	function romeo_setup() {

		// Make theme available for translation
		load_theme_textdomain( 'romeo', get_template_directory() . '/languages' );

		// Add required theme supports
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'custom-header' );

		// Add editor style
		add_editor_style( get_stylesheet_uri() );

	}

endif;
add_action( 'after_setup_theme', 'romeo_setup' );

// Theme Setup Stage 2

	// Set Content Width
	function romeo_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'romeo_content_width', 1600 );
	}
	add_action( 'after_setup_theme', 'romeo_content_width', 0 );

	// Register Widgets
	function romeo_widgets_init() {

		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'romeo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Default Sidebar', 'romeo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Shop', 'romeo' ),
			'id'            => 'shop',
			'description'   => esc_html__( 'Shop Sidebar', 'romeo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 1', 'romeo' ),
			'id'            => 'footer-area-1',
			'description'   => esc_html__( 'Footer Area 1', 'romeo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Area 2', 'romeo' ),
			'id'            => 'footer-area-2',
			'description'   => esc_html__( 'Footer Area 2', 'romeo' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
				'name'          => esc_html__( 'Footer Area 3', 'romeo' ),
				'id'            => 'footer-area-3',
				'description'   => esc_html__( 'Footer Area 3', 'romeo' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'name'          => esc_html__( 'Footer Area 4', 'romeo' ),
				'id'            => 'footer-area-4',
				'description'   => esc_html__( 'Footer Area 4', 'romeo' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

		register_sidebar( array(
				'name'          => esc_html__( 'Footer Area 5', 'romeo' ),
				'id'            => 'footer-area-5',
				'description'   => esc_html__( 'Footer Area 5', 'romeo' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
					'name'          => esc_html__( 'Footer Area 6', 'romeo' ),
					'id'            => 'footer-area-6',
					'description'   => esc_html__( 'Footer Area 6', 'romeo' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				) );

				register_sidebar( array(
					'name'          => esc_html__( 'Footer Area 7', 'romeo' ),
					'id'            => 'footer-area-7',
					'description'   => esc_html__( 'Footer Area 7', 'romeo' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				) );
	}

	add_action( 'widgets_init', 'romeo_widgets_init' );

	// Register Menus
	function romeo_register_menus() {
		  register_nav_menu( 'main-menu', esc_html__( 'Main Menu', 'romeo' ) );
			register_nav_menu( 'secondary-menu', esc_html__( 'Secondary Menu', 'romeo' ) );
			register_nav_menu( 'mobile-menu', esc_html__( 'Mobile Menu', 'romeo' ) );
		}
	add_action( 'after_setup_theme', 'romeo_register_menus' );

	// Enqueue JS & CSS
	function romeo_scripts() {

		wp_enqueue_style( 'romeo-reset', get_template_directory_uri() . '/css/reset.css' );
		wp_enqueue_style( 'romeo-master', get_template_directory_uri() . '/css/master.css' );
		wp_enqueue_style( 'romeo-ie', get_template_directory_uri() . '/css/ie.css' );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css' );
		wp_enqueue_style( 'owl-carousel-default', get_template_directory_uri() . '/css/owl.theme.default.min.css' );
		wp_enqueue_style( 'romeo-icon-font', get_template_directory_uri() . '/css/fonts.css' );
		wp_enqueue_style( 'romeo-theme', get_template_directory_uri() . '/css/theme.css' );
		wp_enqueue_style( 'romeo-fonts', romeo_fonts_url(), array(), null );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), false );


		if ( get_theme_mod( 'select_header_layout' ) == '1') {
			wp_enqueue_style( 'romeo-header-trans', get_template_directory_uri() . '/css/layouts/header-trans.css', array(), false  );
		} else if ( get_theme_mod( 'select_header_layout' ) == '2') {
			wp_enqueue_style( 'romeo-header-classic', get_template_directory_uri() . '/css/layouts/header-classic.css', array(), false  );
		} else {
			wp_enqueue_style( 'romeo-header-classic', get_template_directory_uri() . '/css/layouts/header-classic.css', array(), false  );
		}

		if ( get_theme_mod( 'select_blog_layout' ) == 'left') {
			wp_enqueue_style( 'romeo-left-sidebar', get_template_directory_uri() . '/css/layouts/left-sidebar.css' );
		} else if ( get_theme_mod( 'select_blog_layout' ) == 'right') {
			wp_enqueue_style( 'romeo-right-sidebar', get_template_directory_uri() . '/css/layouts/right-sidebar.css' );
		} else if ( get_theme_mod( 'select_blog_layout' ) == 'none') {
			wp_enqueue_style( 'romeo-no-sidebar', get_template_directory_uri() . '/css/layouts/no-sidebar.css' );
		} else {
			wp_enqueue_style( 'romeo-right-sidebar', get_template_directory_uri() . '/css/layouts/right-sidebar.css' );
		}

		if ( get_theme_mod( 'select_shop_layout' ) == 'left') {
			wp_enqueue_style( 'romeo-shop-left-sidebar', get_template_directory_uri() . '/css/layouts/shop-left-sidebar.css' );
		} else if ( get_theme_mod( 'select_shop_layout' ) == 'right') {
			wp_enqueue_style( 'romeo-shop-right-sidebar', get_template_directory_uri() . '/css/layouts/shop-right-sidebar.css' );
		} else if ( get_theme_mod( 'select_shop_layout' ) == 'none') {
			wp_enqueue_style( 'romeo-shop-no-sidebar', get_template_directory_uri() . '/css/layouts/shop-no-sidebar.css' );
		} else {
			wp_enqueue_style( 'romeo-shop-no-sidebar', get_template_directory_uri() . '/css/layouts/shop-no-sidebar.css' );
		}

		if ( get_theme_mod( 'select_smoothscrolling' ) == 'on') {
			wp_enqueue_script( 'romeo-smooth-scrolling', get_template_directory_uri() . '/js/smoothscrolling.js', array(), '', true );
		}

		wp_enqueue_script( 'waypoint', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), '', true);
		wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '', true);
		wp_enqueue_script( 'owl-navigation', get_template_directory_uri() . '/js/owl.navigation.js', array('jquery'), '', true);
		wp_enqueue_script( 'owl-autoplay', get_template_directory_uri() . '/js/owl.autoplay.js', array('jquery'), '', true);
		wp_enqueue_script( 'owl-animate', get_template_directory_uri() . '/js/owl.animate.js', array('jquery'), '', true);
		wp_enqueue_script( 'romeo-theme-scripts', get_template_directory_uri() . '/js/theme.js', array('waypoint'), '', true );

		wp_enqueue_script( 'romeo-ajax', get_template_directory_uri() . '/js/ajax.js', array('jquery'), '', true );
		wp_localize_script( 'romeo-ajax', 'romeo_ajax_obj', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'romeo_scripts' );

	// Add CSS Styling from Theme Options
	function romeo_add_styles() {
	    wp_enqueue_style(
	        'romeo-custom-styles',
	        get_template_directory_uri() . '/css/theme.css'
	    );

			$header_top_color = get_theme_mod( 'romeo_header_top_color' );
			$footer_top_color = get_theme_mod( 'romeo_footer_top_color' );
			$accent_color = get_theme_mod( 'accent_color' );
			$footer_bottom_color = get_theme_mod( 'romeo_footer_bottom_color' );
			$move_logo_up = get_theme_mod( 'move_logo_up' );
			$move_logo_left = get_theme_mod( 'move_logo_left' );
			$shop_header_background = get_theme_mod( 'shop_header_image' );
			$spinner_color = get_theme_mod( 'spinner_color' );
			$shop_header_text_color = get_theme_mod( 'shop_header_text_color' );
			$extra_css = get_theme_mod( 'custom_css' );

			$custom_css = "

			.site-header .cart-contents,
			.alg-wc-wl-btn.remove i.fa:first-child,
			.owl-nav .owl-next:hover,
			.owl-nav .owl-prev:hover,
			.woocommerce ul.products li.product .price ins,
			.testimonial .quote,
			.related.products > h2:after,
			.split-heading.dotted h2:after,
			.woocommerce .star-rating span::before,
			.closeicon:hover:after {
				color: {$accent_color}!important;
			}

			.model-3 .spinner {
				background: {$spinner_color}!important;
			}

			.woocommerce-page .page-title {
				color: {$shop_header_text_color}!important;
			}

			.ares .tp-bullet:hover,
			.ares .tp-bullet.selected,
			.owl-dots .owl-dot.active span,
			.owl-dots .owl-dot:hover span,
			hr.mailchimp-linebreak {
				background: {$accent_color}!important;
			}

			.header-row.top.stuck {
				background: {$header_top_color}!important;
			}

			.footer-row.top {
				background: {$footer_top_color}!important;
			}

			.footer-row.bottom {
				background: {$footer_bottom_color}!important;
			}

			.site-logo, .widget_elusive_logo_widget {
				position:relative;
				top: {$move_logo_up}px!important;
				left: {$move_logo_left}px!important;
			}

			.woocommerce-page .page-title{
			  background-image: url({$shop_header_background});
			}

			";

			$custom_css .= "{$extra_css}";

			wp_add_inline_style( 'romeo-custom-styles', $custom_css );
	}
	add_action( 'wp_enqueue_scripts', 'romeo_add_styles' );

	// Style the Customizer
	function romeo_customizer_styles() { ?>
		<style>
			#customize-theme-controls .customize-control {
				margin-bottom:30px;
			}
		</style>
		<?php

	}
	add_action( 'customize_controls_print_styles', 'romeo_customizer_styles', 999 );

	// Add Woocommerce Support
	if ( class_exists( 'WooCommerce' ) ) {
		function romeo_woocommerce_support() {
	    	add_theme_support( 'woocommerce' );
				add_theme_support( 'wc-product-gallery-lightbox' );
				add_theme_support( 'wc-product-gallery-slider' );
		}
		add_action( 'after_setup_theme', 'romeo_woocommerce_support' );
	}

	// Change number or products per row
	add_filter('loop_shop_columns', 'loop_columns');
	if (!function_exists('loop_columns')) {
		function loop_columns() {
			return 3;
		}
	}

	add_filter( 'woocommerce_output_related_products_args', 'romeo_change_number_related_products' );

	function romeo_change_number_related_products( $args ) {

	 $args['posts_per_page'] = 3; // # of related products
	 $args['columns'] = 3; // # of columns per row
	 return $args;
	}

	// Edit Empty Cart Page
	add_action( 'woocommerce_cart_is_empty', 'romeo_add_content_empty_cart', 0 );
		function romeo_add_content_empty_cart() {
			echo '<div class="empty-cart-heading-handwriting">';
			echo 'Wait!';
			echo '</div>';
	}

	// Move Woo Parts
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 30 );

	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', -30 );

	//* Customize [...] in WordPress excerpts
	function romeo_read_more_custom_excerpt( $text ) {
	   if ( strpos( $text, '[&hellip;]') ) {
	      $excerpt = str_replace( '[&hellip;]', '...', $text );
	   } else {
	      $excerpt = $text . '...';
	   }
	   return $excerpt;
	}
	add_filter( 'the_excerpt', 'romeo_read_more_custom_excerpt' );

	// Add woo body class if needed
	function romeo_woo_body_class( $c ) {
  global $post;
  if( isset($post->post_content) && has_shortcode( $post->post_content, 'productgrid' ) ) {
      $c[] = 'woocommerce';
  }
  return $c;
	}
	add_filter( 'body_class', 'romeo_woo_body_class' );

	// Setup TGM Plugin Recommendations
	function romeo_register_required_plugins() {

	    $plugins = array(

			array(
        'name'          => esc_html__('Visual Composer', 'romeo' ),
        'slug'          => 'js_composer',
        'source'        => 'http://themes.eovo.uk/plugins/js_composer.zip',
        'required'          => true,
        'force_activation'      => false,
        'force_deactivation'    => false,
    	),

			array(
        'name'          => esc_html__('Revolution Slider', 'romeo' ),
        'slug'          => 'revslider',
        'source'        => 'http://themes.eovo.uk/plugins/revslider.zip',
        'required'          => false,
        'force_activation'      => false,
        'force_deactivation'    => false,
    	),

			array(
        'name'          => esc_html__('Romeo Shortcodes', 'romeo' ),
        'slug'          => 'romeo-shortcodes',
        'source'        => 'http://themes.eovo.uk/plugins/romeo-shortcodes.zip',
        'required'          => false,
        'force_activation'      => false,
        'force_deactivation'    => false,
    	),

			array(
				'name'          => esc_html__( 'Wishlist', 'romeo'),
				'slug'          => 'wish-list-for-woocommerce',
				'required'          => false,
			),

			array(
        'name'          => esc_html__( 'Woocommerce', 'romeo'),
        'slug'          => 'woocommerce',
        'required'          => false,
    	),

			array(
				'name'      => esc_html__( 'One Click Demo Import', 'romeo'),
				'slug'      => 'one-click-demo-import',
				'required'  => false,
			),

			array(
				'name'      => esc_html__( 'Easy Google Fonts', 'romeo'),
				'slug'      => 'easy-google-fonts',
				'required'  => false,
			),

			array(
				'name'      => esc_html__( 'Contact Form 7', 'romeo'),
				'slug'      => 'contact-form-7',
				'required'  => false,
			),

			array(
				'name'      => esc_html__( 'Simple Social Icons', 'romeo'),
				'slug'      => 'simple-social-icons',
				'required'  => false,
			),

			array(
				'name'      => esc_html__( 'Currency Switcher', 'romeo'),
				'slug'      => 'currency-switcher-woocommerce',
				'required'  => false,
			),

			array(
				'name'      => esc_html__( 'YITH Quickview', 'romeo'),
				'slug'      => 'yith-woocommerce-quick-view',
				'required'  => false,
			),

			array(
				'name'      => esc_html__( 'Mailchimp', 'romeo'),
				'slug'      => 'mailchimp-for-wp',
				'required'  => false,
			),

		);

	    $theme_text_domain = 'romeo';

	    $config = array(
	        'default_path' => '',
	        'menu'         => 'tgmpa-install-plugins',
	        'has_notices'  => true,
	        'dismissable'  => true,
	        'dismiss_msg'  => '',
	        'is_automatic' => true,
	        'message'      => '',
	        'strings'      => array(
	            'page_title'                      => esc_html__( 'Install Required Plugins', 'romeo' ),
	            'menu_title'                      => esc_html__( 'Install Plugins', 'romeo' ),
	            'installing'                      => esc_html__( 'Installing Plugin: %s', 'romeo' ), // %s = plugin name.
	            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'romeo' ),
	            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'romeo'  ), // %1$s = plugin name(s).
	            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'romeo'  ), // %1$s = plugin name(s).
	            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'romeo'  ), // %1$s = plugin name(s).
	            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'romeo'  ), // %1$s = plugin name(s).
	            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'romeo'  ), // %1$s = plugin name(s).
	            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'romeo'  ), // %1$s = plugin name(s).
	            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'romeo'  ), // %1$s = plugin name(s).
	            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'romeo'  ), // %1$s = plugin name(s).
	            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'romeo'  ),
	            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'romeo'  ),
	            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'romeo' ),
	            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'romeo' ),
	            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'romeo' ), // %s = dashboard link.
	            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
	        )
	    );

	    tgmpa( $plugins, $config );
	}

	add_action( 'tgmpa_register', 'romeo_register_required_plugins' );

		// Update Header Cart Count & Mini Cart
		add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
		function woocommerce_header_add_to_cart_fragment( $fragments ) {
		    ob_start();
		    ?>
				<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'romeo' ); ?>">
				  <?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'romeo'  ), WC()->cart->get_cart_contents_count() ); ?>
				</a>
		    <?php

		    $fragments['a.cart-contents'] = ob_get_clean();

		    return $fragments;
		}

		add_filter( 'woocommerce_add_to_cart_fragments', function($fragments) {
	    ob_start();
	    ?>
	    <div class="cart-sidebar-inner">
	        <?php woocommerce_mini_cart(); ?>
	    </div>
	    <?php $fragments['div.cart-sidebar-inner'] = ob_get_clean();
	    return $fragments;
		});





		// Modify Woo Breadcrumb
		add_filter( 'woocommerce_breadcrumb_defaults', 'romeo_change_breadcrumb_delimiter' );
		function romeo_change_breadcrumb_delimiter( $defaults ) {
			// Change the breadcrumb delimeter
			$defaults['delimiter'] = ' <div class="crumb"> &#47; </div>';
			return $defaults;
		}

		//AJAX
		function romeo_ajax_request() {

			if ( isset($_REQUEST) ) {

				$cat = $_REQUEST['cat'];
				if ($cat == 'All'){$cat = '';}

				 $params = array(
								 'posts_per_page' => 6,
								 'post_type' => 'product',
								 'product_cat' => $cat
				 );
				 $wc_query = new WP_Query($params);
				 $totalpages = $wc_query->max_num_pages;

				 ?>
				 <?php if ($wc_query->have_posts()) : ?>
				<div class="et-product-grid-wrapper">
				 <ul class="products" data-totalpages="<?php echo esc_html($totalpages); ?>">

				 <?php while ($wc_query->have_posts()) :
												 $wc_query->the_post();  ?>

												 <?php wc_get_template_part( 'content', 'product' ); ?>

				 <?php endwhile; ?>
				 </ul>
				 <?php if ($totalpages > 1){?>
				 	<div class="et-load-more" data-category="<?php echo esc_html($cat);?>" data-pager="1">
				 		<span><?php echo esc_html__( 'Load More', 'romeo'); ?></span>
			 		</div>
				<?php } ?>

			 </div>
				 <?php wp_reset_postdata();  ?>
				 <?php else:  ?>
				 <p>
							<?php echo esc_html__( 'No Products', 'romeo'); ?>
				 </p>
				 <?php endif;

			 die();
		}}

		add_action( 'wp_ajax_romeo_ajax_request', 'romeo_ajax_request' );
		add_action( 'wp_ajax_nopriv_romeo_ajax_request', 'romeo_ajax_request' );

		function more_post_ajax(){

				$cat = $_REQUEST['cat'];
				$page = $_REQUEST['page'];
				$ppp = $_REQUEST['ppp'];
				$totalpages = $_REQUEST['total'];

				if ($cat == 'All'){$cat = '';}

		    $args = array(
		        'post_type' => 'product',
		        'posts_per_page' => $ppp,
		        'product_cat' => $cat,
		        'paged'    => $page
		    );

		    $loop = new WP_Query($args);
		    $out = '';

				?>

				<ul class="products" data-totalpages="<?php echo esc_html($totalpages); ?>">

				<?php
		    if ($loop -> have_posts()) :
					while ($loop -> have_posts()) : $loop -> the_post();
		        $out .= wc_get_template_part( 'content', 'product' );
		    	endwhile;
					?>
				</ul>

				<?php if ($totalpages != $page){?>
				 <div class="et-load-more" data-total ="<?php echo esc_html($totalpages);?>" data-category="<?php echo esc_html($cat);?>" data-pager="<?php echo esc_html($page);?>">
					 <span><?php echo esc_html__( 'Load More', 'romeo'); ?></span>
				 </div>
				<?php } ?>

			<?php
		    endif;
		    wp_reset_postdata();
		    die();
		}

		add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
		add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

		// Add Google Fonts
		function romeo_fonts_url() {
		    $font_url = '';

		    if ( 'off' !== _x( 'on', 'Google font: on or off', 'romeo' ) ) {
		        $font_url = add_query_arg( 'family', urlencode( 'Poppins:300,600|Open Sans:400,600,700|Lato:100,300,Regular,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
		    }
		    return $font_url;
		}

		function romeo_font_scripts() {
		    wp_enqueue_style( 'romeo-fonts', romeo_fonts_url(), array(), '1.0.0' );
		}
		add_action( 'wp_enqueue_scripts', 'romeo_font_scripts' );

		// One Click Demo Settings
		function romeo_ocdi_import_files() {
		  return array(
		    array(
		      'import_file_name'             => esc_html__('Demo Import 1','romeo'),
		      'local_import_file'            => trailingslashit( get_template_directory() ) . 'ocdi/demo-content.xml',
					'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'ocdi/widgets.wie',
		    ),
		  );
		}
		add_filter( 'pt-ocdi/import_files', 'romeo_ocdi_import_files' );

		// Assign Demo Menus to Locations, Set Homepage and Install Demo Sliders
		if ( ! function_exists( 'romeo_after_import' ) ) :
				function romeo_after_import( $selected_import ) {

				        //Set Menu
				        $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
				        $secondary_menu = get_term_by('name', 'Secondary Menu', 'nav_menu');
								$mobile_menu = get_term_by('name', 'Mobile Menu', 'nav_menu');
				        set_theme_mod( 'nav_menu_locations' , array(
				              'main-menu' => $main_menu->term_id,
				              'secondary-menu' => $secondary_menu->term_id,
											'mobile-menu' => $mobile_menu->term_id
				             )
				        );

								 //Set Front page
					       $page = get_page_by_title( 'Mars');
					       if ( isset( $page->ID ) ) {
					        update_option( 'page_on_front', $page->ID );
					        update_option( 'show_on_front', 'page' );
					       }

								 //Import Sliders
					       if ( class_exists( 'RevSlider' ) ) {
					           $slider_array = array(
					              get_template_directory()."/plugins/demo-sliders/home.tar",
												get_template_directory()."/plugins/demo-sliders/standard-slider-vivid.tar",
												get_template_directory()."/plugins/demo-sliders/tall-fixed.tar",
					              get_template_directory()."/plugins/demo-sliders/standard-slider.tar"
					              );

					           $slider = new RevSlider();

					           foreach($slider_array as $filepath){
					             $slider->importSliderFromPost(true,true,$filepath);
					           }

					           echo ' Slider processed';
					      }
				}

				add_action( 'pt-ocdi/after_import', 'romeo_after_import' );
				endif;

				// Set Woocommerce Image Sizes
				function romeo_woocommerce_image_dimensions() {
					global $pagenow;

					if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
						return;
					}
				  $catalog = array(
						'width' 	=> '600',	// px
						'height'	=> '600',	// px
						'crop'		=> 1 		// true
					);
					$single = array(
						'width' 	=> '900',	// px
						'height'	=> '1300',	// px
						'crop'		=> 1 		// true
					);
					$thumbnail = array(
						'width' 	=> '180',	// px
						'height'	=> '180',	// px
						'crop'		=> 1 		// false
					);
					// Image sizes
					update_option( 'shop_catalog_image_size', $catalog );
					update_option( 'shop_single_image_size', $single );
					update_option( 'shop_thumbnail_image_size', $thumbnail );
				}
				add_action( 'after_switch_theme', 'romeo_woocommerce_image_dimensions', 1 );

?>
