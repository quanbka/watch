<?php
/**
* Plugin Name: Romeo Shortcodes
* Plugin URI: http://elusivethemes.com/
* Description: A collection of shortcodes required for the theme.
* Version: 1.0
* Author: Elusivethemes
* Author URI: www.elusivethemes.com
* License:
*/

/* Visual Composer Elements*/

// Product Carousel
function productcarousel_func( $atts ) {
	 ob_start();
   extract( shortcode_atts( array(
		'romeo_cat_name' => '',
		'romeo_products_per_row' => '',
		'romeo_products_total' => '',
		'romeo_carousel_title' => '',
		'romeo_nav_style' => ''
   ), $atts ) );

	             $postsPerPage = $romeo_products_total;
							 $cat = $romeo_cat_name;
	             $args = array(
	                     'post_type' => 'product',
	                     'posts_per_page'  => $postsPerPage,
	                     'product_cat' => $cat
	             );

	             $loop = new WP_Query($args);
							 $totalpages = $loop->max_num_pages;
							 $cat_id = $cat;

							 ?>
							 	<div class="woocommerce woocommerce-page">
								<div class="et-carousel-title"><h5> <?php echo $romeo_carousel_title; ?> </h5></div>

							 	<ul class="products owl-carousel <?php echo $romeo_products_per_row; ?>items <?php echo $romeo_nav_style; ?>nav">

									<?php
									$output ='';
			            while ($loop->have_posts()) : $loop->the_post();
			         		?>
								 	<?php
									$output .= wc_get_template_part( 'content', 'product' );
		             	endwhile;
								 	?>
								 </ul>
							 </div><?php
		echo $output;
  	$myvariable = ob_get_clean();
		return $myvariable;
}
add_shortcode( 'productcarousel', 'productcarousel_func' );
add_action( 'vc_before_init', 'productcarousel_integrateWithVC' );

function productcarousel_integrateWithVC() {

	$categories_array = array();
	$categories = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC',  'parent' =>0));
	foreach( $categories as $category ){
		$categories_array[] = $category->slug;
	}

   vc_map( array(
      "name" => __("Product Carousel", 'romeo'),
      "base" => "productcarousel",
      "class" => "",
	  	"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
      "category" => __('Romeo Theme Elements', 'romeo'),
      "params" => array(

								array(
											 "type" => "textfield",
											 "holder" => "div",
											 "heading" => __("Title ", 'romeo'),
											 "admin_label" => true,
											 "param_name" => "romeo_carousel_title",
											 "value" => __("", 'romeo'),
											 "description" => __("Enter the carousel title.", 'romeo')
										),

								array(
												'param_name'    => 'romeo_cat_name',
												'type'          => 'dropdown',
												'value'         => $categories_array,
												'heading'       => __('Category', 'romeo'),
												'description'   => '',
												'holder'        => 'div',
												'class'         => '',
												"description" => __("Choose a category.", 'romeo')
											),

								array(
												"type"        => "dropdown",
												"heading"     => __("Number of products", 'romeo'),
												"param_name"  => "romeo_products_total",
												"admin_label" => true,
												"value"       => array(
																								'1'   => '1',
																								'2'   => '2',
																								'3'   => '3',
																								'4'   => '4',
																								'5'   => '5',
																								'6'   => '6',
																								'7'   => '7',
																								'8'   => '8',
																								'9'   => '9',
																								'10'   => '10',
																								'11'   => '11',
																								'12'   => '12',
																								'13'   => '13',
																								'14'   => '14',
																								'15'   => '15',
																								'16'   => '16'
																							),
												"std"         => " ",
												"description" => __("Total number of products to load into the carousel.")
												),

								array(
												"type"        => "dropdown",
												"heading"     => __("Number of products first visible", 'romeo'),
												"param_name"  => "romeo_products_per_row",
												"admin_label" => true,
												"value"       => array(
																								'1'   => '1',
																								'2'   => '2',
																								'3'   => '3',
																								'4'   => '4',
																								'5'   => '5'
																							),
												"std"         => " ",
												"description" => __("Number of products first visible.")
												),

								 array(
			                   "type"        => "dropdown",
			                   "heading"     => __("Nav Style", 'romeo'),
			                   "param_name"  => "romeo_nav_style",
			                   "admin_label" => true,
			                   "value"       => array(
			                                           'Dots'   => 'dots',
			                                           'Arrows'   => 'arrows'
			                                         ),
			                   "std"         => " ",
			                   "description" => __("Choose a naviagation style.")
			                   )
									 	)
			   ) );
}

// Category Carousel
function categorycarousel_func( $atts ) {
	 ob_start();
   extract( shortcode_atts( array(
		'romeo_categories_per_row' => '',
		'romeo_carousel_title' => '',
		'romeo_nav_style' => ''
   ), $atts ) );

	 						$output ='';
	            ?>
							<div class="et-carousel-title cat"><h5> <?php echo $romeo_carousel_title; ?> </h5></div>
							<div class="category-carousel-wrapper">
							 <div class = "category-carousel owl-carousel  <?php echo $romeo_categories_per_row; ?>items <?php echo $romeo_nav_style; ?>nav">

								 	<?php
									$taxonomyName = "product_cat";
									$prod_categories = get_terms($taxonomyName, array(
										'orderby'=> 'name',
										'order' => 'ASC',
										'hide_empty' => 1
									));

									foreach( $prod_categories as $prod_cat ) :

										if ( $prod_cat->parent != 0 )
										continue;
										$cat_thumb_id = get_woocommerce_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
										$cat_thumb_url = wp_get_attachment_image( $cat_thumb_id, array('600', '600'));
										$term_link = get_term_link( $prod_cat, 'product_cat' );

										$output .= '<div class="category-carousel-item">';
										$output .= '<a href="'.$term_link.'">';
										$output .= $cat_thumb_url;
										$output .= '<div class="category-title">';
										$output .= $prod_cat->name;
										$output .= '</div>';
										$output .= '</a>';
										$output .= '</div>';

									endforeach;
										wp_reset_postdata();

									echo $output;
										?>

								</div>
							</div>

							 	<?php
  	$myvariable = ob_get_clean();
		return $myvariable;
}
add_shortcode( 'categorycarousel', 'categorycarousel_func' );
add_action( 'vc_before_init', 'categorycarousel_integrateWithVC' );

function categorycarousel_integrateWithVC() {
   vc_map( array(
      "name" => __("Category Carousel", 'romeo'),
      "base" => "categorycarousel",
      "class" => "",
	  	"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
      "category" => __('Romeo Theme Elements', 'romeo'),
      "params" => array(

								array(
											 "type" => "textfield",
											 "holder" => "div",
											 "heading" => __("Title ", 'romeo'),
											 "admin_label" => true,
											 "param_name" => "romeo_carousel_title",
											 "value" => __("", 'romeo'),
											 "description" => __("Enter the carousel title.", 'romeo')
										),

								array(
												"type"        => "dropdown",
												"heading"     => __("Number of categories first visible", 'romeo'),
												"param_name"  => "romeo_categories_per_row",
												"admin_label" => true,
												"value"       => array(
																								'1'   => '1',
																								'2'   => '2',
																								'3'   => '3',
																								'4'   => '4',
																								'5'   => '5'
																							),
												"std"         => " "
												),

								 array(
			                   "type"        => "dropdown",
			                   "heading"     => __("Nav Style", 'romeo'),
			                   "param_name"  => "romeo_nav_style",
			                   "admin_label" => true,
			                   "value"       => array(
			                                           'Dots'   => 'dots',
			                                           'Arrows'   => 'arrows'
			                                         ),
			                   "std"         => " ",
			                   "description" => __("Choose a naviagation style.")
			                   )
									 	)
			   ) );
}

// Blog Carousel
function blogcarousel_func( $atts ) {
	 ob_start();
   extract( shortcode_atts( array(
		'romeo_products_per_row' => '',
		'romeo_products_total' => '',
		'romeo_nav_style' => '',
		'romeo_carousel_title' => '',
		'category_name' => ''
   ), $atts ) );

	             $args = array(
	                     'post_type' => 'post',
											 'posts_per_page' => $romeo_products_total,
											 'category_name' => $category_name
	             );
	             $loop = new WP_Query($args);

							 ?>
							 <div class="et-carousel-title"><h5> <?php echo $romeo_carousel_title; ?> </h5></div>
							 	<div class="blog-carousel owl-carousel  <?php echo $romeo_products_per_row; ?>items <?php echo $romeo_nav_style; ?>nav">
									<?php
									$output ='';
			            while ($loop->have_posts()) : $loop->the_post();

									if ( has_post_thumbnail() ){
										$feat_image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->ID ), "thumbnail" );
									}
										$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		 							 	$time_string = sprintf( $time_string,
		 							 		esc_attr( get_the_date( 'c' ) ),
		 							 		esc_html( get_the_date() ),
		 							 		esc_attr( get_the_modified_date( 'c' ) ),
		 							 		esc_html( get_the_modified_date() )
		 							 	);

		 								$post_title = get_the_title();
										$post_ex = get_the_excerpt();
										$post_read_more = 'Read More';

										$output .= '<div class="blog-carousel-item">';
										$output .= '<a href="'.get_the_permalink().'"><div class="thumb-wrapper-outer">';
										$output .= '<div class="thumb-overlay"></div>';
										if ( has_post_thumbnail()){
											$output .= '<img src ="'.$feat_image[0].'" alt="">';
											}
										$output .= '</div></a>';
										$output .= '<div class="post-time">'.$time_string.'</div>';
										$output .= '<div class="post-title"><a href="'.get_the_permalink().'">'.$post_title.'</a></div>';
										$output .= '<div class="post-ex">'.$post_ex.'</div>';
										$output .= '<div class="post-read-more"><a class="read-more" href="'.get_the_permalink().'">'.$post_read_more.'</a></div>';
										$output .= '</div>';

		             	endwhile;
									wp_reset_postdata();

		echo $output;
		?>
		</div>
		<?php
  	$myvariable = ob_get_clean();
		return $myvariable;
}

add_shortcode( 'blogcarousel', 'blogcarousel_func' );
add_action( 'vc_before_init', 'blogcarousel_integrateWithVC' );

function blogcarousel_integrateWithVC() {

	$categories_array = array();
	$categories = get_categories();
	foreach( $categories as $category ){
	  $categories_array[] = $category->slug;
	}

   vc_map( array(
      "name" => __("Blog Carousel", 'romeo'),
      "base" => "blogcarousel",
      "class" => "",
	  	"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
      "category" => __('Romeo Theme Elements', 'romeo'),
      "params" => array(

								array(
											 "type" => "textfield",
											 "holder" => "div",
											 "heading" => __("Title ", 'romeo'),
											 "admin_label" => true,
											 "param_name" => "romeo_carousel_title",
											 "value" => __("", 'romeo'),
											 "description" => __("Enter the carousel title.", 'romeo')
										),

								array(
											  'param_name'    => 'category_name',
											  'type'          => 'dropdown',
											  'value'         => $categories_array,
											  'heading'       => __('Select Category', 'romeo'),
											  'description'   => '',
											  'holder'        => 'div',
											  'class'         => ''
											),

								array(
												"type"        => "dropdown",
												"heading"     => __("Number of products in view", 'romeo'),
												"param_name"  => "romeo_products_per_row",
												"admin_label" => true,
												"value"       => array(
																								'1'   => '1',
																								'2'   => '2',
																								'3'   => '3',
																								'4'   => '4',
																								'5'   => '5'
																							),
												"description" => __("Number of products first visible.")
												),

								array(
												"type"        => "dropdown",
												"heading"     => __("Number of total products", 'romeo'),
												"param_name"  => "romeo_products_total",
												"admin_label" => true,
												"value"       => array(
																								'1'   => '1',
																								'2'   => '2',
																								'3'   => '3',
																								'4'   => '4',
																								'5'   => '5',
																								'6'   => '6',
																								'7'   => '7',
																								'8'   => '8',
																								'9'   => '9',
																								'10'   => '10',
																								'11'   => '11',
																								'12'   => '12'
																							),
												"description" => __("Number of products first visible.")
												),

								 array(
			                   "type"        => "dropdown",
			                   "heading"     => __("Nav Style", 'romeo'),
			                   "param_name"  => "romeo_nav_style",
			                   "admin_label" => true,
			                   "value"       => array(
			                                           'Dots'   => 'dots',
			                                           'Arrows'   => 'arrows'
			                                         ),
			                   "std"         => " ",
			                   "description" => __("Choose a naviagation style.")
			                   )
									 	)
			   ) );
}

// Testomonials Carousel
function testomonialcarousel_func( $atts ) {
	 ob_start();
   extract( shortcode_atts( array(
		'romeo_products_per_row' => '',
		'romeo_nav_style' => '',
		'css' => ''
   ), $atts ) );

	 $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'testomonialcarousel', $atts );

	             $postsPerPage = 16;
	             $args = array(
	                     'post_type' => 'testimonials',
	                     'posts_per_page' => $postsPerPage
	             );

	             $loop = new WP_Query($args);

							 ?>

							 	<div class="testimonials owl-carousel <?php echo $romeo_products_per_row; ?>items <?php echo $romeo_nav_style; ?>nav <?php echo $css_class; ?>">
									<?php
									$testimonials ='';
			            while ($loop->have_posts()) : $loop->the_post();
											$post_id = get_the_ID();
					            $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
					            $client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
					            $source = ( empty( $testimonial_data['source'] ) ) ? '' : '' . $testimonial_data['source'];
					            $link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
					            $cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $source . '</a>' : $source;
											$avatar = get_the_post_thumbnail( $post_id, array( 100, 100) );

					            $testimonials .= '<div class = "testimonial">';
					            $testimonials .= '<span class="quote">&ldquo;</span>';
					            $testimonials .= '<div class="testimonial-text">' . get_the_content() . '</div>';
											$testimonials .= '<span class="thumb">' . $avatar . '</span>';
					            $testimonials .= '<p class="testimonial-client-name">' . $client_name . '</p>';
											$testimonials .= '<p class="testimonial-client-site">' . $cite . '</p>';
					            $testimonials .= '</div>';

		             	endwhile;

		echo $testimonials;
		?>
		</div>
		<?php
  	$myvariable = ob_get_clean();
		return $myvariable;
}

function testomonialcarousel_integrateWithVC() {
   vc_map( array(
      "name" => __("Testomonial Carousel", 'romeo'),
      "base" => "testomonialcarousel",
      "class" => "",
	  	"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
      "category" => __('Romeo Theme Elements', 'romeo'),
      "params" => array(

								array(
												"type"        => "dropdown",
												"heading"     => __("Number in view", 'romeo'),
												"param_name"  => "romeo_products_per_row",
												"admin_label" => true,
												"value"       => array(
																								'1'   => '1',
																								'2'   => '2',
																								'3'   => '3',
																								'4'   => '4',
																								'5'   => '5'
																							),
												"std"         => " ",
												"description" => __("Number of testimonials first visible.")
												),

								 array(
			                   "type"        => "dropdown",
			                   "heading"     => __("Nav Style", 'romeo'),
			                   "param_name"  => "romeo_nav_style",
			                   "admin_label" => true,
			                   "value"       => array(
			                                           'Dots'   => 'dots',
			                                           'Arrows'   => 'arrows'
			                                         ),
			                   "std"         => " ",
			                   "description" => __("Choose a naviagation style.")
											 ),

							 array(
			  		             'type' => 'css_editor',
			  		             'heading' => __( 'Css', 'romeo' ),
			  		             'param_name' => 'css',
			  		             'group' => __( 'Design options', 'romeo' ),
			 							),
									 	)
			   ) );
}

add_shortcode( 'testomonialcarousel', 'testomonialcarousel_func' );
add_action( 'vc_before_init', 'testomonialcarousel_integrateWithVC' );

// Split Heading
function splitheading_func( $atts ) {
	 ob_start();
   extract( shortcode_atts( array(
		'romeo_split_title' => '',
		'romeo_split_sub_title' => '',
		'romeo_split_description' => '',
		'romeo_heading_style' => '',
		'css' => ''
   ), $atts ) );
	 $output ='';
	 	 $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'splitheading', $atts );
		 $output .= '<div class = "split-heading ' . $css_class . ' ' . $romeo_heading_style . '">';
		 $output .= '<div class = "left">';
		 $output .= '<h2>' . $romeo_split_title . '</h2>';
		 $output .= '<p>' . $romeo_split_sub_title . '</p>';
		 $output .= '</div>';
		 $output .= '<div class = "right">';
		 $output .= '<p>' . $romeo_split_description . '</p>';
		 $output .= '</div>';
		 $output .= '</div>';

		echo $output;
  	$myvariable = ob_get_clean();
		return $myvariable;
}
add_shortcode( 'splitheading', 'splitheading_func' );
add_action( 'vc_before_init', 'splitheading_integrateWithVC' );

function splitheading_integrateWithVC() {
   vc_map( array(
      "name" => __("Styled Heading", 'romeo'),
      "base" => "splitheading",
      "class" => "",
	  	"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
      "category" => __('Romeo Theme Elements', 'romeo'),
      "params" => array(

				array(
							 "type" => "textfield",
							 "holder" => "div",
							 "class" => "",
							 "heading" => __("Title", 'romeo'),
							 "param_name" => "romeo_split_title",
							 "value" => __("", 'romeo'),
							 "description" => __("Enter the heading title.", 'romeo')
						 ),
				 array(
 							 "type" => "textfield",
 							 "holder" => "div",
 							 "class" => "",
 							 "heading" => __("Sub Title", 'romeo'),
 							 "param_name" => "romeo_split_sub_title",
 							 "value" => __("", 'romeo'),
 							 "description" => __("Enter the sub heading text.", 'romeo')
						 ),
				 array(
				 			 "type" => "textfield",
				 			 "holder" => "div",
				 			 "class" => "",
				 			 "heading" => __("Description", 'romeo'),
				 			 "param_name" => "romeo_split_description",
				 			 "value" => __("", 'romeo'),
				 			 "description" => __("Enter the description text.", 'romeo')
						 ),
				 array(
 		             'type' => 'css_editor',
 		             'heading' => __( 'Css', 'romeo' ),
 		             'param_name' => 'css',
 		             'group' => __( 'Design options', 'romeo' ),
							),
				 array(
								 "type"        => "dropdown",
								 "heading"     => __("Heading Style", 'romeo'),
								 "param_name"  => "romeo_heading_style",
								 "admin_label" => true,
								 "value"       => array(
																				 'Simple'   => 'simple',
																				 'Split'   => 'split',
																				 'Dotted'   => 'dotted',
																			 ),
								 "std"         => " ",
								 "description" => __("Choose a heading style.")
								 )
						)

			  ) );
			}

	// Handwriting
	function handwriting_func( $atts ) {
		 ob_start();
	   extract( shortcode_atts( array(
			'romeo_handwriting_title' => '',
			'romeo_handwriting_size' => '',
			'romeo_handwriting_align' => '',
			'css' => ''
	   ), $atts ) );
		 $output ='';
		 	 $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'handwriting', $atts );
			 $output .= '<div class = "romeo-handwriting ' . $css_class . '">';
			 $output .= '<div style = "text-align : ' . $romeo_handwriting_align . '; font-size : ' . $romeo_handwriting_size . ';">' . $romeo_handwriting_title . '</div>';
			 $output .= '</div>';

			echo $output;
	  	$myvariable = ob_get_clean();
			return $myvariable;
	}
	add_shortcode( 'handwriting', 'handwriting_func' );
	add_action( 'vc_before_init', 'handwriting_integrateWithVC' );

	function handwriting_integrateWithVC() {
	   vc_map( array(
	      "name" => __("Handwriting Element", 'romeo'),
	      "base" => "handwriting",
	      "class" => "",
		  	"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
	      "category" => __('Romeo Theme Elements', 'romeo'),
	      "params" => array(

					array(
								 "type" => "textfield",
								 "holder" => "div",
								 "class" => "",
								 "heading" => __("Title", 'romeo'),
								 "param_name" => "romeo_handwriting_title",
								 "value" => __("", 'romeo'),
								 "description" => __("Enter the text you want to use for the handwriting element.", 'romeo')
							 ),

					 array(
									 "type" => "textfield",
									 "holder" => "div",
									 "class" => "",
									 "heading" => __("Font size", 'romeo'),
									 "param_name" => "romeo_handwriting_size",
									 "value" => __("", 'romeo'),
									 "description" => __("Enter the font size. ( e.g 24px)", 'romeo')
								 ),

					 array(
									 "type"        => "dropdown",
									 "heading"     => __("Alignment", 'romeo'),
									 "param_name"  => "romeo_handwriting_align",
									 "admin_label" => true,
									 "value"       => array(
																					 'Left'   => 'left',
																					 'Center'   => 'center',
																					 'Right'   => 'right',
																				 ),
									 "std"         => " ",
									 "description" => __("Choose the alignment for the handwriting.")
								 ),

					 array(
	 		             'type' => 'css_editor',
	 		             'heading' => __( 'Css', 'romeo' ),
	 		             'param_name' => 'css',
	 		             'group' => __( 'Design options', 'romeo' ),
								),

								)
				  ) );
				}

	// Button
	function button_func( $atts ) {
		 ob_start();
		 extract( shortcode_atts( array(
			'romeo_button_text' => '',
			'romeo_button_link' => '',
			'romeo_button_style' => '',
			'css' => ''
		 ), $atts ) );
		 $output ='';
			 $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'button', $atts );

			 $output .= '<a class = "romeo-vc-button ' . $css_class . ' ' . $romeo_button_style . '" href="' . $romeo_button_link . '">';
			 $output .= $romeo_button_text;
			 $output .= '</a>';

			echo $output;
			$myvariable = ob_get_clean();
			return $myvariable;
	}
	add_shortcode( 'button', 'button_func' );
	add_action( 'vc_before_init', 'button_integrateWithVC' );

	function button_integrateWithVC() {
		 vc_map( array(
				"name" => __("Button / Link", 'romeo'),
				"base" => "button",
				"class" => "",
				"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
				"category" => __('Romeo Theme Elements', 'romeo'),
				"params" => array(

					array(
								 "type" => "textfield",
								 "holder" => "div",
								 "class" => "",
								 "heading" => __("Title", 'romeo'),
								 "param_name" => "romeo_button_text",
								 "value" => __("", 'romeo'),
								 "description" => __("Enter the text for the button / link.", 'romeo')
							 ),

					 array(
									 "type" => "textfield",
									 "holder" => "div",
									 "class" => "",
									 "heading" => __("Link", 'romeo'),
									 "param_name" => "romeo_button_link",
									 "value" => __("", 'romeo'),
									 "description" => __("Enter the link url. ( e.g http://mysite.com)", 'romeo')
								 ),

					 array(
 									"type"        => "dropdown",
 									"heading"     => __("Button Style", 'romeo'),
 									"param_name"  => "romeo_button_style",
 									"admin_label" => true,
 									"value"       => array(
 																					'Button'   => 'button',
 																					'Link'   => 'link',
 																				),
 									"std"         => " ",
 									"description" => __("Choose a button style.")
 								),

					 array(
									 'type' => 'css_editor',
									 'heading' => __( 'Css', 'romeo' ),
									 'param_name' => 'css',
									 'group' => __( 'Design options', 'romeo' ),
								),

								)
					) );
				}



	// Feature Box
	function featurebox_func( $atts ) {
		 ob_start();
	   extract( shortcode_atts( array(
			'romeo_featurebox_title' => '',
			'romeo_featurebox_description' => '',
			'romeo_featurebox_link' => '',
			'romeo_featurebox_image' => '',
			'romeo_featurebox_height' => '',
			'romeo_featurebox_style' => '',
			'css' => ''
	   ), $atts ));

		 	 $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'featurebox', $atts );
	 	 	 $img = wp_get_attachment_image_src( $romeo_featurebox_image );
			 $output ='';
			 $output ='';
			 $output .= '<a href = "' . $romeo_featurebox_link . ' ">';
			 $output .= '<div class="feature-box-wrapper-' . $romeo_featurebox_style . '">';
			 $output .= '<div class="feature-box-overlay"></div>';
			 $output .= '<div style ="height:' . $romeo_featurebox_height . ';" class = "feature-box ' . $css_class . ' ">';
			 if (!empty($img)) {
			 		$output .= '<img src= "' . $img[0] . '">';
					}
			 $output .= '</div>';
			 $output .= '<div class="feature-box-text">';
			 $output .= '<h1>' . $romeo_featurebox_title . '</h1>';
			 $output .= '<span class="sub-heading">' . $romeo_featurebox_description . '</span>';
			 $output .= '</div>';
			 $output .= '</div>';
			 $output .= '<div class="feature-box-bottom-text ' . $romeo_featurebox_style . '">';
			 $output .= '<h4>' . $romeo_featurebox_title . '</h4>';
			 $output .= '</div>';
			 $output .= '</a>';

			echo $output;
	  	$myvariable = ob_get_clean();
			return $myvariable;
	}
	add_shortcode( 'featurebox', 'featurebox_func' );
	add_action( 'vc_before_init', 'featurebox_integrateWithVC' );

	function featurebox_integrateWithVC() {
	   vc_map( array(
	      "name" => __("Feature Box", 'romeo'),
	      "base" => "featurebox",
	      "class" => "",
		  	"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
	      "category" => __('Romeo Theme Elements', 'romeo'),
	      "params" => array(

					array(
								 "type" => "textfield",
								 "holder" => "div",
								 "class" => "",
								 "heading" => __("Title", 'romeo'),
								 "param_name" => "romeo_featurebox_title",
								 "value" => __("", 'romeo'),
								 "description" => __("Enter the heading title.", 'romeo')
							 ),
					 array(
					 			 "type" => "textfield",
					 			 "holder" => "div",
					 			 "class" => "",
					 			 "heading" => __("Description", 'romeo'),
					 			 "param_name" => "romeo_featurebox_description",
					 			 "value" => __("", 'romeo'),
					 			 "description" => __("Enter the description text.", 'romeo')
							 ),

					 array(
					 			 "type" => "textfield",
					 			 "holder" => "div",
					 			 "class" => "",
					 			 "heading" => __("Link", 'romeo'),
					 			 "param_name" => "romeo_featurebox_link",
					 			 "value" => __("", 'romeo'),
					 			 "description" => __("Enter the url for the link ( include http:// ).", 'romeo')
							 ),
					 array(
					 			 "type" => "textfield",
					 			 "holder" => "div",
					 			 "class" => "",
					 			 "heading" => __("Height", 'romeo'),
					 			 "param_name" => "romeo_featurebox_height",
					 			 "value" => __("", 'romeo'),
					 			 "description" => __("Enter the height of the box ( e.g 500px ).", 'romeo')
							 ),

					 array(
					 				"type"        => "dropdown",
					 				"heading"     => __("Box Style", 'romeo'),
					 				"param_name"  => "romeo_featurebox_style",
					 				"admin_label" => true,
					 				"value"       => array(
					 																'Ken Burns'   => 'ken',
					 																'Dark Overlay'   => 'dark',
																					'Minimal'   => 'minimal',
					 															),
					 				"std"         => " ",
					 				"description" => __("Choose a style for the feature box.")
								),

						array(
				             'type' => 'css_editor',
				             'heading' => __( 'Css', 'romeo' ),
				             'param_name' => 'css',
				             'group' => __( 'Design options', 'romeo' ),
				         		)
									)
				  ) );
				}

// Mailchimp Box
function mailchimpbox_func( $atts ) {
	 ob_start();
	 extract( shortcode_atts( array(
		'romeo_mailchimpbox_title' => '',
		'romeo_mailchimpbox_description' => '',
		'romeo_mailchimpbox_image' => '',
		'romeo_mailchimpbox_formid' => '',
		'romeo_mailchimpbox_height' => '',
		'romeo_mailchimpbox_style' => '',
		'css' => ''
	 ), $atts ));

		 $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'mailchimpbox', $atts );
		 $img = wp_get_attachment_image_src( $romeo_mailchimpbox_image );
		 $output ='';
		 $output ='';
		 $output .= '<div class="mailchimp-box-wrapper-' . $romeo_mailchimpbox_style . '">';
		 $output .= '<div class="mailchimp-box-overlay"></div>';
		 $output .= '<div style ="height:' . $romeo_mailchimpbox_height . ';" class = "mailchimp-box ' . $css_class . ' ">';
		 if (!empty($img)) {
				$output .= '<img src= "' . $img[0] . '">';
				}
		 $output .= '</div>';
		 $output .= '<div class="mailchimp-box-text">';
		 $output .= '<h1>' . $romeo_mailchimpbox_title . '</h1>';
		 $output .= '<hr class="mailchimp-linebreak">';
		 $output .= '<span class="sub-heading"><p>' . $romeo_mailchimpbox_description . '</p></span>';
		 $output .= do_shortcode( '[mc4wp_form id="' . $romeo_mailchimpbox_formid . '"]' );
		 $output .= '</div>';
		 $output .= '</div>';


		echo $output;
		$myvariable = ob_get_clean();
		return $myvariable;
}
add_shortcode( 'mailchimpbox', 'mailchimpbox_func' );
add_action( 'vc_before_init', 'mailchimpbox_integrateWithVC' );

function mailchimpbox_integrateWithVC() {
	 vc_map( array(
			"name" => __("Mailchimp Box", 'romeo'),
			"base" => "mailchimpbox",
			"class" => "",
			"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
			"category" => __('Romeo Theme Elements', 'romeo'),
			"params" => array(

				array(
							 "type" => "textfield",
							 "holder" => "div",
							 "class" => "",
							 "heading" => __("Title", 'romeo'),
							 "param_name" => "romeo_mailchimpbox_title",
							 "value" => __("", 'romeo'),
							 "description" => __("Enter the heading title.", 'romeo')
						 ),
				 array(
							 "type" => "textfield",
							 "holder" => "div",
							 "class" => "",
							 "heading" => __("Description", 'romeo'),
							 "param_name" => "romeo_mailchimpbox_description",
							 "value" => __("", 'romeo'),
							 "description" => __("Enter the description text.", 'romeo')
						 ),
				 array(
				 			"type" => "textfield",
				 			"holder" => "div",
				 			"class" => "",
				 			"heading" => __("Form ID", 'romeo'),
				 			"param_name" => "romeo_mailchimpbox_formid",
				 			"value" => __("", 'romeo'),
				 			"description" => __("Enter the id of the mailchimp form you want to use.", 'romeo')
				 		),
				 array(
							 "type" => "textfield",
							 "holder" => "div",
							 "class" => "",
							 "heading" => __("Height", 'romeo'),
							 "param_name" => "romeo_mailchimpbox_height",
							 "value" => __("", 'romeo'),
							 "description" => __("Enter the height of the box ( e.g 500px ).", 'romeo')
						 ),

				 array(
								"type"        => "dropdown",
								"heading"     => __("Box Style", 'romeo'),
								"param_name"  => "romeo_mailchimpbox_style",
								"admin_label" => true,
								"value"       => array(
																				'Light Content'   => 'light',
																				'Dark Content'   => 'dark',
																			),
								"std"         => " ",
								"description" => __("Choose a style for the mailchimp box.")
							),

					array(
									 'type' => 'css_editor',
									 'heading' => __( 'Css', 'romeo' ),
									 'param_name' => 'css',
									 'group' => __( 'Design options', 'romeo' ),
									)
								)
				) );
			}


// Call to Action Box
function calltoaction_func( $atts ) {
	 ob_start();
   extract( shortcode_atts( array(
		'romeo_calltoaction_handwriting_header' => '',
		'romeo_calltoaction_title' => '',
		'romeo_calltoaction_description' => '',
		'romeo_calltoaction_link' => '',
		'romeo_calltoaction_button' => '',
		'romeo_calltoaction_style' => '',
		'css' => ''
   ), $atts ));

	 	$output ='';
	 	 $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'featurebox', $atts );
		 $output .= '<div class = "' . $romeo_calltoaction_style . ' calltoaction-box stagger ' . $css_class . ' ">';
		 $output .= '<div class = "left">';
		 if ($romeo_calltoaction_handwriting_header !=''){
		 		$output .= '<div class ="handwriting-header">' . $romeo_calltoaction_handwriting_header . '</div>';
	 		}
		 $output .= '<h1>' . $romeo_calltoaction_title . '</h1>';
		 $output .= '<p>' . $romeo_calltoaction_description . '</p>';
		 $output .= '</div>';
		 $output .= '<div class = "right">';
		 $output .= '<a href = "' . $romeo_calltoaction_link . ' ">';
		 $output .= $romeo_calltoaction_button;
		 $output .= '</a>';
		 $output .= '</div>';
		 $output .= '</div>';
		 $output .= '</a>';

		echo $output;
  	$myvariable = ob_get_clean();
		return $myvariable;
}
add_shortcode( 'calltoaction', 'calltoaction_func' );
add_action( 'vc_before_init', 'calltoaction_integrateWithVC' );

function calltoaction_integrateWithVC() {
   vc_map( array(
      "name" => __("Call to Action", 'romeo'),
      "base" => "calltoaction",
      "class" => "",
	  	"icon" => get_template_directory_uri() . "/assets/romeo-icon.png",
      "category" => __('Romeo Theme Elements', 'romeo'),
      "params" => array(

				array(
							 "type" => "textfield",
							 "holder" => "div",
							 "class" => "",
							 "heading" => __("Title", 'romeo'),
							 "param_name" => "romeo_calltoaction_handwriting_header",
							 "value" => __("", 'romeo'),
							 "description" => __("Enter the text for the handwriting header. Leave blank for none.", 'romeo')
						 ),
				array(
							 "type" => "textfield",
							 "holder" => "div",
							 "class" => "",
							 "heading" => __("Title", 'romeo'),
							 "param_name" => "romeo_calltoaction_title",
							 "value" => __("", 'romeo'),
							 "description" => __("Enter the box title.", 'romeo')
						 ),
				 array(
				 			 "type" => "textfield",
				 			 "holder" => "div",
				 			 "class" => "",
				 			 "heading" => __("Description", 'romeo'),
				 			 "param_name" => "romeo_calltoaction_description",
				 			 "value" => __("", 'romeo'),
				 			 "description" => __("Enter the box description.", 'romeo')
						 ),

				 array(
				 			 "type" => "textfield",
				 			 "holder" => "div",
				 			 "class" => "",
				 			 "heading" => __("Button Text", 'romeo'),
				 			 "param_name" => "romeo_calltoaction_button",
				 			 "value" => __("", 'romeo'),
				 			 "description" => __("Enter the button text", 'romeo')
						 ),

				 array(
				 			 "type" => "textfield",
				 			 "holder" => "div",
				 			 "class" => "",
				 			 "heading" => __("Link", 'romeo'),
				 			 "param_name" => "romeo_calltoaction_link",
				 			 "value" => __("", 'romeo'),
				 			 "description" => __("Enter the url for the button ( include http:// ).", 'romeo')
						 ),

				 array(
				 				"type"        => "dropdown",
				 				"heading"     => __("Box Style", 'romeo'),
				 				"param_name"  => "romeo_calltoaction_style",
				 				"admin_label" => true,
				 				"value"       => array(
				 																'Standard'   => 'standard',
				 																'Centered'   => 'centered',
				 															),
				 				"std"         => " ",
				 				"description" => __("Choose a style for the box.")
							),
					array(
			             'type' => 'css_editor',
			             'heading' => __( 'Css', 'romeo' ),
			             'param_name' => 'css',
			             'group' => __( 'Design options', 'romeo' ),
			         		)
							)
			  ) );
			}

			// Testomonials Custom Post
			add_action( 'init', 'romeo_testimonials_post_type' );
			function romeo_testimonials_post_type() {
					$labels = array(
							'name' => esc_html__( 'Testimonials', 'romeo' ),
							'singular_name' => esc_html__( 'Testimonial', 'romeo' ),
							'add_new' => esc_html__( 'Add New', 'romeo' ),
							'add_new_item' => esc_html__( 'Add New Testimonial', 'romeo' ),
							'edit_item' => esc_html__( 'Edit Testimonial', 'romeo' ),
							'new_item' => esc_html__( 'New Testimonial', 'romeo' ),
							'view_item' => esc_html__( 'View Testimonial', 'romeo' ),
							'search_items' => esc_html__( 'Search Testimonials', 'romeo' ),
							'not_found' =>  esc_html__( 'No Testimonials found', 'romeo' ),
							'not_found_in_trash' => esc_html__( 'No Testimonials in the trash', 'romeo' ),
							'parent_item_colon' => '',
					);

					register_post_type( 'testimonials', array(
							'labels' => $labels,
							'public' => true,
							'publicly_queryable' => true,
							'show_ui' => true,
							'exclude_from_search' => true,
							'query_var' => true,
							'rewrite' => true,
							'capability_type' => 'post',
							'has_archive' => true,
							'hierarchical' => false,
							'menu_position' => 10,
							'supports' => array( 'editor', 'thumbnail' ),
							'register_meta_box_cb' => 'romeo_testimonials_meta_boxes', // Callback function for custom metaboxes
					) );
			}

// Testomials Setup
function romeo_testimonials_meta_boxes() {
	add_meta_box( 'romeo_testimonials_form', 'Testimonial Details', 'romeo_testimonials_form', 'testimonials', 'normal', 'high' );
}

function romeo_testimonials_form() {
		$post_id = get_the_ID();
		$testimonial_data = get_post_meta( $post_id, '_testimonial', true );
		$client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
		$source = ( empty( $testimonial_data['source'] ) ) ? '' : $testimonial_data['source'];
		$link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
		wp_nonce_field( 'testimonials', 'testimonials' );
		?>
		<p>
				<label><?php echo esc_html__('Clients Name (optional)', 'romeo' ); ?></label><br />
				<input type="text" value="<?php echo $client_name; ?>" name="testimonial[client_name]" size="40" />
		</p>
		<p>
				<label><?php echo esc_html__('Business Name (optional)', 'romeo' ); ?></label><br />
				<input type="text" value="<?php echo $source; ?>" name="testimonial[source]" size="40" />
		</p>
		<p>
				<label><?php echo esc_html__('Link (optional)', 'romeo' ); ?></label><br />
				<input type="text" value="<?php echo $link; ?>" name="testimonial[link]" size="40" />
		</p>
		<?php
}

add_action( 'save_post', 'romeo_testimonials_save_post' );
function romeo_testimonials_save_post( $post_id ) {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
				return;

		if ( ! empty( $_POST['testimonials'] ) && ! wp_verify_nonce( $_POST['testimonials'], 'testimonials' ) )
				return;

		if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) )
						return;
		} else {
				if ( ! current_user_can( 'edit_post', $post_id ) )
						return;
		}

		if ( ! wp_is_post_revision( $post_id ) && 'testimonials' == get_post_type( $post_id ) ) {
				remove_action( 'save_post', 'romeo_testimonials_save_post' );

				wp_update_post( array(
						'ID' => $post_id,
						'post_title' => esc_html__( 'Testimonial - ', 'romeo' ) . $post_id
				) );

				add_action( 'save_post', 'romeo_testimonials_save_post' );
		}

		if ( ! empty( $_POST['testimonial'] ) ) {
				$testimonial_data['client_name'] = ( empty( $_POST['testimonial']['client_name'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['client_name'] );
				$testimonial_data['source'] = ( empty( $_POST['testimonial']['source'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['source'] );
				$testimonial_data['link'] = ( empty( $_POST['testimonial']['link'] ) ) ? '' : esc_url( $_POST['testimonial']['link'] );

				update_post_meta( $post_id, '_testimonial', $testimonial_data );
		} else {
				delete_post_meta( $post_id, '_testimonial' );
		}
}
?>
