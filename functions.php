<?php


  define( 'THEME_VERSION', '5.0' );

  $min = 'false';

  if ($min == 'false') {
    define( 'MIN', '' );
  }else{
    define( 'MIN', '.min' );
  }



  define( 'INC', get_template_directory() . '/inc' );
  define( 'DIR', get_template_directory() . '/includes' );
  define( 'PARTS', get_template_directory() . '/parts' );


  // Redirect Login Page
  function redirect_login_page() {
      $login_url  = home_url( '/jjp-login.php' );
      $url = basename($_SERVER['REQUEST_URI']); // get requested URL
      isset( $_REQUEST['redirect_to'] ) ? ( $url   = "jjp-login.php" ): 0; // if users ssend request to wp-admin
      if( $url  == "jjp-login" && $_SERVER['REQUEST_METHOD'] == 'GET')  {
          wp_redirect( $login_url );
          exit;
      }
  }
  add_action('init','redirect_login_page');

  // Redirect Logout Page
  add_filter( 'logout_url', 'my_custom_logout_url', 10, 2 );
  function my_custom_logout_url( $logout_url, $redirect ) {
      $logout_url = home_url( '/jjp-login.php?action=logout' );
      $logout_url = wp_nonce_url( $logout_url, 'log-out' );
      return $logout_url;
  }

  add_action( 'wp_logout','my_custom_redirect_after_logout' );
  function my_custom_redirect_after_logout() {
      if ( ! is_admin() ) {
          wp_safe_redirect( home_url() );
          exit();
      }
  }


  if( !function_exists('redirect_404_to_homepage') ){
    add_action( 'template_redirect', 'redirect_404_to_homepage' );

    function redirect_404_to_homepage(){
       if(is_404()):
            wp_safe_redirect( home_url('/') );
            exit;
        endif;
    }
  }

//   function hide_admin_bar_from_front_end(){
//     if (is_blog_admin()) {
//       return true;
//     }
//     return false;
//   }
//   add_filter( 'show_admin_bar', 'hide_admin_bar_from_front_end' );


  /**
   * Removes some menus by page.
   */
  function wpdocs_remove_menus(){
    //remove_menu_page( 'wpcf7' );                //Contact Fom *

    //remove_menu_page( 'options-general.php' );
    //remove_menu_page( 'tools.php' );
  }
  add_action( 'admin_menu', 'wpdocs_remove_menus' );


  // add_action( 'admin_init', 'wpse_136058_debug_admin_menu' );
  // function wpse_136058_debug_admin_menu() {
  //     echo '<pre>' . print_r( $GLOBALS[ 'menu' ], TRUE) . '</pre>';
  // }


  // Themes Functions
  include( INC . '/template-functions.php' );



  /**
   * Registers a widget area.
   */
  function jjp_themes_widgets_init() {
  	register_sidebar( array(
  		'name'          => __( 'Top Banner', 'jjp_themes' ),
  		'id'            => 'top_banner',
  		'container' 		=> false,
  		'before_widget' => '',
  		'after_widget' => ''
  	) );

    register_sidebar( array(
      'name'          => __( 'Sidebar Left 1', 'jjp_themes' ),
      'id'            => 'sidebar_left_1',
      'container' 		=> false,
      'before_widget' => '',
      'after_widget' => ''
    ) );
  }
  add_action( 'widgets_init', 'jjp_themes_widgets_init' );


  /**
   * Style Login
   */
  function my_custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/css/style-login.css" />';
  }
  add_action('login_head', 'my_custom_login');


  /**
   * Register Menu
   */
  register_nav_menus(
    array(
      'main_menu' => __( 'Main Menu', 'jjp_themes' ),
      'footer_menu_1' => __( 'Footer Menu 1', 'jjp_themes' ),
      'footer_menu_2' => __( 'Footer Menu 2', 'jjp_themes' )
    )
  );




  /**
   * Script
   */
  function jjp_themes_scripts() {

  	wp_enqueue_script( 'js-min', get_template_directory_uri() . '/js/jquery.min.js', array(), THEME_VERSION);
  	wp_enqueue_script( 'js-lozad', get_template_directory_uri() . '/js/lozad.min.js', array(), THEME_VERSION);
  	wp_enqueue_script( 'js-plugins', get_template_directory_uri() . '/js/plugins.min.js', array(), THEME_VERSION);
  	wp_enqueue_script( 'js-isotope', get_template_directory_uri() . '/js/isotope.pkgd.js', array(), THEME_VERSION);

  	wp_enqueue_script( 'js-scripts', get_template_directory_uri() . '/js/scripts'.MIN.'.js', array(), THEME_VERSION);

    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), THEME_VERSION );
	wp_enqueue_style( 'css-plugins', get_template_directory_uri() . '/css/plugins.css', array(), THEME_VERSION );
	wp_enqueue_style( 'css-style', get_template_directory_uri() . '/css/main'.MIN.'.css', array(), THEME_VERSION );
  }

  add_action( 'wp_enqueue_scripts', 'jjp_themes_scripts' );



  // SEO
  include( INC . '/hooks/hook-seo.php' );


  // Pagination
  include( INC . '/hooks/hook-pagination.php' );


  // Breadcrumbs
  include( INC . '/hooks/hook-breadcrumbs.php' );


  // Count Views
  include( INC . '/hooks/hook-count-views.php' );


  // Avatar
  include( INC . '/hooks/hook-avatar.php' );





  //Time
  // function get_the_time_lang_ID( $the_time ) {
  //     $days = array(
  //     'Sunday' => 'Minggu'
  //     , 'Monday' => 'Senin'
  //     , 'Tuesday' => 'Selasa'
  //     , 'Wednesday' => 'Rabu'
  //     , 'Thursday' => 'Kamis'
  //     , 'Friday' => 'Jumat'
  //     , 'Saturday' => 'Sabtu'
  //     );

  //     $months = array(
  //     'January' => 'Januari'
  //     , 'February' => 'Februari'
  //     , 'March' => 'Maret'
  //     , 'April' => 'April'
  //     , 'May' => 'Mei'
  //     , 'June' => 'Juni'
  //     , 'July' => 'Juli'
  //     , 'August' => 'Agustus'
  //     , 'September' => 'September'
  //     , 'October' => 'Oktober'
  //     , 'November' => 'November'
  //     , 'December' => 'Desember'
  //     );

  //     $the_time = str_replace( array_keys( $days ), array_values( $days ), $the_time );
  //     $the_time = str_replace( array_keys( $months ), array_values( $months ), $the_time );

  //     return $the_time;
  // }
  // add_filter( 'get_the_time' , 'get_the_time_lang_ID' );




  add_filter( 'nav_menu_link_attributes', function ( $atts, $item, $args ) {
      if(!is_front_page() && !is_home() ){
          if ( 'anchor-nav' === $item->classes[0] ) {
              $atts['href'] = esc_url(home_url()) . $item->url;
          }
      }
      return $atts;
  }, 10, 3 );


  add_filter('wpcf7_autop_or_not', '__return_false');
  
  
  
        function wpse10691_alter_query( $query ){
            if ( $query->is_main_query() && ( $query->is_home() || $query->is_search() || $query->is_archive() )  )
            {
                $query->set( 'orderby', 'date' );
                $query->set( 'post_status', 'publish' );
                $query->set( 'order', 'ASC' );
            }
        }
        add_action( 'pre_get_posts', 'wpse10691_alter_query' );


  //Minify HTML
  include( INC . '/hooks/hook-minify.php' );


  include( PARTS . '/custom-post/professionals.php' );
  include( PARTS . '/custom-post/testimonials.php' );

  include( PARTS . '/meta/meta-page-head.php' );
  
  include( PARTS . '/meta/meta-page-homepage.php' );
  include( PARTS . '/meta/meta-professionals.php' );
  include( PARTS . '/meta/meta-page-practice_areas.php' );
  include( PARTS . '/meta/meta-page-testimonials-h.php' );
  include( PARTS . '/meta/meta-testimonials.php' );
  include( PARTS . '/meta/meta-our-firm.php' );



  include( PARTS . '/ajax/news.php' );

  // Admin meta
  include( DIR . '/themes-options.php' );

?>
