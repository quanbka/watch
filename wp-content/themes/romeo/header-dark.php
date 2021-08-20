<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <!-- Start of Header -->
  <header class="site-header starter dark">

    <div class="header-row top">

      <div class="header-block left">
        <div class="et-currency-block">
            <?php echo do_shortcode( '[woocommerce_currency_switcher_link_list]' ); ?>
        </div>
      </div>

      <div class="header-block right">

        <div class="search-box">
            <div class="search-button"><i class="fa fa-search"></i></div>
        </div>

        <?php if ( class_exists( 'WooCommerce' ) ) { ?>
        <div class="cart-box">
            <span><?php echo esc_html__( 'Cart', 'romeo'); ?></span>
            <span class="cart-counter">
              <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_html__( 'View your shopping cart', 'romeo' ); ?>">
                <?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'romeo' ), WC()->cart->get_cart_contents_count() ); ?>
              </a>
            </span>
        </div>
        <?php }

          include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
              if ( function_exists( 'alg_wc_wish_list' ) ) {
              $page_id = Alg_WC_Wish_List_Page::get_wish_list_page_id();
              $url = get_permalink($page_id);
              ?>
              <a href="<?php echo esc_url($url); ?>">
              <div class="wishlist-box">
                  <span><?php echo esc_html__( 'Wishlist', 'romeo'); ?></span>
                  <span class="cart-contents">
                    <?php echo do_shortcode('[alg_wc_wl_counter]'); ?>
                  </span>
              </div>
            </a>
        <?php } ?>

        <div class="header-menu-right">
          <?php wp_nav_menu( array( 'theme_location' => 'secondary-menu' ) ); ?>
        </div>

      </div>


      <div class="clearfix"></div>

      <div class="header-row bottom">

        <div class="header-block">
            <?php
          if ( get_theme_mod( 'large_logo_white' ) ) :
                ?><a href ="<?php echo esc_url(home_url('/')); ?>"><?php
                echo '<img alt="logo" src="' . esc_url( get_theme_mod( 'large_logo_white' ) ) . '">';
                ?></a><?php
            else:
              ?><a href ="<?php echo esc_url(home_url('/')); ?>"><?php
                echo '<div class="site-title-center">'. get_bloginfo('name').'</div>';
                ?></a><?php
            endif;
            ?>
        </div>

        <div class="header-block">

          <div class="header-menu-left">
            <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
          </div>

        </div>
      </div>

    </div>

  </header>

  <!-- Start of Sticky Header -->
  <header class="site-header hidden">

    <div class="header-row top stuck">
      <div class="header-block left">
        <div class="site-logo">
          <?php romeo_display_logo();?>
        </div>
        <div class="header-menu-left stuck">
          <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
        </div>
      </div>

      <div class="header-block right">

        <div class="search-box">
            <div class="search-button"><i class="fa fa-search"></i></div>
        </div>

        <?php if ( class_exists( 'WooCommerce' ) ) { ?>
        <div class="cart-box">
            <span><?php echo esc_html__( 'Cart', 'romeo'); ?></span>
            <span class="cart-counter">
              <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_html__( 'View your shopping cart', 'romeo' ); ?>">
                <?php echo sprintf ( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'romeo' ), WC()->cart->get_cart_contents_count() ); ?>
              </a>
            </span>
        </div>
        <?php }
              if ( function_exists( 'alg_wc_wish_list' ) ) {
              $page_id = Alg_WC_Wish_List_Page::get_wish_list_page_id();
              $url = get_permalink($page_id);
              ?>
              <a href="<?php echo esc_url($url); ?>">
              <div class="wishlist-box">
                  <span><?php echo esc_html__( 'Wishlist', 'romeo'); ?></span>
                  <span class="cart-contents">
                    <?php echo do_shortcode('[alg_wc_wl_counter]'); ?>
                  </span>
              </div>
            </a>
        <?php } ?>

        <div class="header-menu-right">
          <?php wp_nav_menu( array( 'theme_location' => 'secondary-menu' ) ); ?>
        </div>
      </div>
    </div>

  </header>

  <div class="site-logo-mob">
    <span class="img-center"></span>
    <?php romeo_display_logo();?>
  </div>

  <div class="menu-box-mob">
      <div class="menu-icon"></div>
  </div>

  <!-- Start of Slide Out Cart -->
  <?php if ( class_exists( 'WooCommerce' ) ) { ?>
    <div class="cart-sidebar-dark-overlay hidden"></div>
      <div class="cart-sidebar hidden">

          <div class="cart-sidebar-inner">
              <h3><?php esc_html_e( 'Shopping Cart', 'romeo' ); ?></h3>
                  <?php woocommerce_mini_cart(); ?>
          </div>
          <div class="closeicon small hidden"></div>
      </div>
  <?php } ?>

  <!-- Start of Main Container -->
  <div class="container down">

    <!-- Start of Preloader -->
    <div class="preloader">
      <section class="mod model-3">
        <div class="spinner"></div>
      </section>
    </div>

        <!-- Start of Mobile Menu -->
        <div class="mobile-menu menu-overlay hidden">
        <div class="scroller">
          <div class="closeicon small">
          </div>
          <h2><?php echo esc_html__( 'Menu', 'romeo'); ?></h2>
          <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu' ) ); ?>
        </div>
        </div>

        <!-- Start of Mini Cart -->
        <?php if ( class_exists( 'WooCommerce' ) ) { ?>
        <div class="mini-cart-container hidden">
            <?php woocommerce_mini_cart(); ?>
        </div>
        <?php } ?>

        <!-- Start of Search Overlay -->
        <div class="search-menu search-overlay hidden">
          <div class="search-overlay-inner">
            <?php get_search_form(); ?>
            <div class="closeicon"></div>
          </div>
        </div>
