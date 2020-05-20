<?php
require get_template_directory() . '/inc/flone-code-base.php';

/**
 * flone functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package flone
 */
 
if ( ! function_exists( 'flone_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function flone_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on flone, use a find and replace
		 * to change 'flone' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'flone', get_template_directory() . '/languages' );


		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'flone' ),
			'extra-header-menu' => esc_html__( 'Extra header menu, It will show under user icon.', 'flone' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'flone_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( array( 'editor-style.css', flone_google_fonts_url() ) );

		// image sizes
		add_image_size( 'flone-270x345', 270, 345, true );
		add_image_size( 'flone-331x443', 331, 443, true );
		add_image_size( 'flone-370x443', 331, 443, true );
		add_image_size( 'flone-455x455', 455, 455, true );
	}
endif;
add_action( 'after_setup_theme', 'flone_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function flone_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'flone_content_width', 840 );
}
add_action( 'after_setup_theme', 'flone_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flone_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'flone' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'flone' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar ', 'flone' ),
		'id'            => 'sidebar-shop',
		'description'   => esc_html__( 'Add widgets here.', 'flone' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	// footer widgets
	$footer_columns = flone_get_option('footer_columns', '4');
	for($i = 1; $i <= $footer_columns; $i++){
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget '. $i, 'flone' ),
			'id'            => 'footer-'. $i,
			'description'   => esc_html__( 'Add widgets here.', 'flone' ),
			'before_widget' => '<div id="%1$s" class="footer-widget mb-30 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="footer-title"><h2 class="widget-title">',
			'after_title'   => '</h2></div>',
		) );
	}
}
add_action( 'widgets_init', 'flone_widgets_init' );

/**
 * Register google fonts.
 */

function flone_google_fonts_url() {
	$font_url = '';
	
	/*
	Translators: If there are characters in your language that are not supported
	by chosen font(s), translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'flone' ) ) {
	    $font_url = add_query_arg( 'family', urlencode( 'Poppins:300,400,500,600,700,800,900|Cormorant Garamond:300i,400,400i,500,500i,600,600i,700&subset=latin,latin-ext' ), "//fonts.googleapis.com/css" );
	}
	return $font_url;
}



/**
 * Enqueue scripts and styles.
 */
function flone_scripts() {

	// Load Google fonts
	wp_enqueue_style( 'flone-google-fonts', flone_google_fonts_url() );
	
	// Load Bootstrap file
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '4.0.0' );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '', true );

	// load pixeden icons
	wp_enqueue_style( 'pe-icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css', array(), null );

	// load fontawesome icons
	$elementor_version = get_option( 'elementor_version' );
	if(version_compare($elementor_version, '2.6.0', '<')){
		wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesomee.min.css', array(), '4.5.0' );
	} else {
		wp_enqueue_style('elementor-icons-shared-0');
		wp_enqueue_style('elementor-icons-fa-solid');
		wp_enqueue_style('elementor-icons-fa-regular');
		wp_enqueue_style('elementor-icons-fa-brands');
	}


	// load animate css
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.5.2' );

	// Load Magnific popup files
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.min.css', array(), '1.1.0' );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array('jquery'), '1.1.0', true );

	// Load Owl Carousel files
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '2.2.1' );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), '2.2.1', false );

	// Load Meanenu files
	wp_enqueue_style( 'meanmenu', get_template_directory_uri() . '/assets/css/meanmenu.css', array(), '2.0.8');
	wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/assets/js/meanmenu.js', array('jquery'), '2.0.8', true );

	// load jquery js
	wp_enqueue_script( 'jquery');

	// load jquery ui files
	wp_enqueue_style( 'jquery-ui', get_template_directory_uri() . '/assets/css/jquery-ui.css', array(), '1.11.4');
	wp_enqueue_script( 'jquery-ui-slider');
	wp_enqueue_script( 'jquery-ui-widget');
	wp_enqueue_script( 'jquery-ui-button');

	// Load Slick slider files
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.min.css', array(), '1.8.1' );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), '1.8.1', true );

	// Load Slinky nav files
	wp_enqueue_style( 'slinky', get_template_directory_uri() . '/assets/css/slinky.css', array(), '1.0.0' );
	wp_enqueue_script( 'slinky', get_template_directory_uri() . '/assets/js/slinky.min.js', array('jquery'), '1.0.0', true );

	// Load theme main css
	wp_enqueue_style( 'flone-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0' );

	// Load gutenberg blocks css
	wp_enqueue_style( 'flone-blocks', get_template_directory_uri() . '/assets/css/blocks.css', array(), '1.0.0' );

	// Load responsive css
	wp_enqueue_style( 'flone-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0.0' );

	// Load theme style
	wp_enqueue_style( 'flone-style', get_stylesheet_uri() );

	// Load countdown js
	wp_enqueue_script( 'jquery-countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.min.js', array('jquery'), '2.1.0', true );

	// Load waypoints js
	wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array('jquery'), '4.0.1', true );

	// Load coutnerup js
	wp_enqueue_script( 'jquery-counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), '1.0', true );

	// Load back to top js
	if( flone_get_option('enable_backto_top', '1') == '1' ){
		wp_enqueue_script( 'jquery-scrollUp', get_template_directory_uri() . '/assets/js/jquery.scrollUp.min.js', array('jquery'), '2.4.1', true );
	}

	// Load elevatezoom js
	wp_enqueue_script( 'jquery-elevatezoom', get_template_directory_uri() . '/assets/js/jquery.elevatezoom.min.js', array('jquery'), '3.0.8', true );

	// Load scroll reval js
	wp_enqueue_script( 'scrollreveal', get_template_directory_uri() . '/assets/js/Scrollreveal.min.js', array('jquery'), null, true );

	// Load images loaded js
	wp_enqueue_script( 'imagesloaded' );

	// Load isotope js
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array('imagesloaded'), '3.0.3', true );

	// Load sticky sidebar js
	wp_enqueue_script( 'jquery-sticky-sidebar', get_template_directory_uri() . '/assets/js/jquery.sticky-sidebar.min.js', array('jquery'), '3.3.0', true );

	// Load theme main js
	wp_enqueue_script( 'flone-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true );

	// Load nagivation js
	wp_enqueue_script( 'flone-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true );
	wp_enqueue_script( 'flone-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// localization of this theme
	$flone_localize_vars = array();
	$flone_localize_vars['ajaxurl'] = esc_url( admin_url( 'admin-ajax.php') );

	wp_localize_script( "flone-main", "flone_localize_vars", $flone_localize_vars );
}
add_action( 'wp_enqueue_scripts', 'flone_scripts' );

/**
 * Enqueue styles for the block-based editor.
 */
function flone_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'flone-block-editor-style', get_template_directory_uri() . '/assets/css/editor-blocks.css', array(), '1.0.0' );

	// Add custom fonts.
	wp_enqueue_style( 'flone-fonts', flone_google_fonts_url() );
}
add_action( 'enqueue_block_editor_assets', 'flone_block_editor_styles' );


/**
 * Enqueue admin scripts and styles.
 */
function flone_admin_scripts() {
	wp_enqueue_media();
	wp_enqueue_script( 'flone-admin', get_template_directory_uri() . '/assets/js/flone-admin.js', array('jquery'), '', true );
	wp_enqueue_style( 'flone-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), '1.0.0');
}
add_action( 'admin_enqueue_scripts', 'flone_admin_scripts' );

/**
 * load  helper functions
 */
require get_template_directory() . '/inc/helper-functions.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Load TGM plugins
 */
require get_template_directory() . '/inc/libs/tgm-plugin/init.php';

/**
 * Load theme options
 */
if(class_exists('ReduxFrameworkPlugin')){
	require get_template_directory() . '/inc/theme-option-init.php';
}

/**
 * Load demo importer
 */
require get_template_directory() . '/inc/demo-importer.php';


/**
* Dynamic Style
*/
function flone_inline_css() {
	$custom_css = array();

	$primary_color = flone_get_option('primary_color');
	$secondary_color = flone_get_option('secondary_color');
	$menu_default_color = flone_get_option('menu_default_color');
	$sticky_menu_default_color = flone_get_option('sticky_menu_default_color');
	$link_color = flone_get_option('link_color');
	$link_hover_color = flone_get_option('link_hover_color');
	$site_padding = flone_get_option('site_padding');
	$site_content_pt = flone_get_option('site_content_pt');
	$site_content_pb = flone_get_option('site_content_pb');
	$footer_icon_color = flone_get_option('footer_icon_color');


	// custom header bg
	if(function_exists('get_header_image') && get_header_image()){
		$header_image = get_header_image();

		$custom_css[] = ".breadcrumb-area{
			background-image:url($header_image);
			background-size:cover;
			background-position:center center;
		}";
	}
	

	if($primary_color){
		$custom_css[] = "
		   #scrollUp,
		   .product-wrap .product-img .product-action > div,
		   .main-menu nav ul li ul.sub-menu li a::before,
		   .main-menu nav ul li ul.mega-menu > li ul li:hover a::before,
		   .header-right-wrap .same-style.header-search .search-content form .button-search,
		   .woocommerce span.onsale,
		   .btn-hover a::after,
		   .single_add_to_cart_button::after,
		   .entry-content a.readmore,
		   .widget-area .tagcloud a:hover,
		   .woocommerce nav.woocommerce-pagination ul.page-numbers li .page-numbers.current,
		   .pagination ul.page-numbers li .page-numbers.current,
		   .entry-content .page-links .post-page-numbers.current,
		   .woocommerce nav.woocommerce-pagination ul.page-numbers li a:hover,
		   .pagination ul.page-numbers li a:hover,
		   .entry-content .page-links .post-page-numbers:hover,
		   .comment-form .form-submit input[type=\"submit\"],
		   .woocommerce nav.woocommerce-pagination ul.page-numbers li a.prev:hover,
		   .woocommerce nav.woocommerce-pagination ul.page-numbers li a.next:hover,
		   .btn-hover a::after,
		   .single_add_to_cart_button::after,
		   .btn--1:hover,
		   .woocommerce a.button:hover,
		   .contact-form .contact-form-style .btn--1:hover,
		   .has-post-thumbnail .post_category a:hover,
		   .post-password-form input[type=\"submit\"]:hover,
		   .cart-shiping-update-wrapper .cart-shiping-update>a:hover,
		   .woocommerce .cart .actions .button:hover,
		   .cart-shiping-update-wrapper .cart-clear>button:hover,
		   .cart-shiping-update-wrapper .cart-clear>a:hover,
		   .woocommerce #respond input#submit:hover,
		   .woocommerce a.button:hover,
		   .woocommerce button.button:hover,
		   .woocommerce input.button:hover,
		   .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
		   .woocommerce a.button.alt:hover,
		   .shop-list-wrap .shop-list-content .shop-list-btn a.wc-forward:hover,
		   .order-button-payment input,
		   .woocommerce #payment #place_order,
		   .woocommerce-page #payment #place_order,
		   .widget_calendar tbody td#today,
		   .entry-content .wp-block-file .wp-block-file__button:hover,
		   .blog-wrap .blog-img span.purple,
		   .woo-variation-swatches-stylesheet-enabled.woo-variation-swatches-style-squared .variable-items-wrapper .variable-item.button-variable-item:hover,
		   .woocommerce-noreviews,
		   p.no-comments,
		   .woocommerce #review_form #respond .form-submit input:hover,
		   .woocommerce-widget-layered-nav ul li:hover span,
		   .flone-preloader span,
		   .slinky-theme-default .back::before,
		   .sidebar-menu nav ul li ul.sub-menu li a::before,
		   .product-wrap-2 .product-img .product-action-2 a,
		   .main-menu nav ul li ul.mega-menu>li ul li a::before,
		   .sidebar-menu nav ul li ul.mega-menu>li ul li a::before,
		   .nav-style-2.owl-carousel>.owl-nav div:hover,
		   .product-wrap-3 .product-content-3-wrap .product-content-3 .product-action-3 a,
		   .nav-style-3.owl-carousel>.owl-nav div:hover,
		   .product-wrap-5 .product-action-4{
		            background-color: {$primary_color};
		    }";

	    // primary color for text
	    $custom_css[] = "
	        .main-menu nav ul li:hover a,
	        .entry-title a:hover,
	        article .post-meta .post-author::before,
	        .main-menu nav ul li ul.sub-menu li a:hover,
	        .main-menu nav ul li ul.mega-menu > li ul li a:hover,
	        .header-right-wrap .same-style:hover > a,
	        .header-right-wrap .same-style .account-dropdown ul li a:hover,
	        article .post-meta a:hover,
	        article .post-meta .posted-on::before,
	        article .post-meta .post-category:before,
	        .widget-area a:hover,
	        .entry-content a,
	        .comment-content a,
	        .woocommerce-message::before,
	        .woocommerce nav.woocommerce-pagination ul.page-numbers li a,
	        .pagination ul.page-numbers li a,
	        .entry-content .page-links .post-page-numbers,
	        .entry-footer a:hover,
	        .comment-form .logged-in-as a:hover,
	        .woocommerce nav.woocommerce-pagination ul.page-numbers li a.prev,
	        .woocommerce nav.woocommerce-pagination ul.page-numbers li a.next,
	        .shop-list-wrap .shop-list-content h3 a:hover,
	        .breadcrumb-content ul li a:hover,
	        .woocommerce .cart-table-content table tbody>tr td.product-name a:hover,
	        .pro-sidebar-search-form button:hover,
	        .woocommerce-info::before,
	        .woocommerce .your-order-table table tr.order-total td span,
	        .header-right-wrap .same-style.cart-wrap:hover > button,
	        .woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover,
	        .woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
	        .product .entry-summary .pro-details-social ul li a:hover,
	        .product .entry-summary .product_meta a:hover,
	        .modal-dialog .modal-header .close:hover,
	        .header-right-wrap .same-style.cart-wrap .shopping-cart-content ul li .shopping-cart-delete a,
	        .footer_style_2 .footer-widget.widget_nav_menu ul li a:hover,
	        .footer-widget .subscribe-form input[type=\"submit\"]:hover,
	        .nav-style-1.owl-carousel .owl-nav div:hover,
	        p.stars:hover a::before,
	        .sidebar-menu nav ul li:hover a,
	        .clickable-mainmenu .clickable-menu-style ul li a:hover,
	        .clickable-menu a:hover,
	        .sidebar-menu nav ul li ul.sub-menu li a:hover,
	        .single-banner .banner-content a:hover,
	        .sidebar-menu nav ul li ul.mega-menu>li ul li a:hover,
	        .header-hm-7.stick .clickable-menu a:hover,
	        .clickable-mainmenu .clickable-mainmenu-icon button:hover,
			.main-menu nav ul li ul.mega-menu>li ul li a::after,
			#primary-menu .menu-item-has-children:hover::after,
			.mean-container .mean-nav ul li a:hover,
	        .widget-area li.current-cat a,.header-right-wrap.header-right-wrap-white .same-style.cart-wrap>button span.count-style,.header_style_4 .main-menu.menu-white nav ul li:hover>a,.flone_header_4 #primary-menu .menu-item-has-children:hover::after,.header-right-wrap.header-right-wrap-white .same-style>a:hover,.header-right-wrap.header-right-wrap-white .same-style.cart-wrap>button:hover,.filter-active a:hover{
	                color: {$primary_color};
	        }";

	    // primary color for border
	    $custom_css[] = "
	        .btn-hover a:hover,
	        .single_add_to_cart_button:hover,
	        blockquote,
	        .shop-list-wrap .shop-list-content .shop-list-btn a:hover,
	        .woocommerce-info,
	        .woocommerce-message,
	        .wp-block-quote:not(.is-large):not(.is-style-large),
	        .footer-widget .subscribe-form input[type=\"submit\"]:hover,
	        .widget-area .tagcloud a:hover,
	        .slider-content-2 .slider-btn a:hover,
	        .single-banner .banner-content a:hover,
	        .slider-content-3 .slider-btn a:hover,
	        .slider-content-7 .slider-btn-9 a:hover,
	        .lds-ripple div:nth-child(1), .lds-ripple div:nth-child(2),
	        .single-slider .slider-content .slider-btn a:hover{
	                border-color: {$primary_color};
	        }";
	}


	if($secondary_color){
		 // bg color
	    $custom_css[] = "
	        .blog-wrap .blog-img span.pink,
	        .woocommerce span.onsale.pink,
	        .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
	        .product-wrap-2 .product-img .product-action-2 a:hover,
	        .product-wrap-3 .product-content-3-wrap .product-content-3 .product-action-3 a:hover,
	        .product-wrap .product-img .product-action>div:hover,.btn-hover a::after,.quickview .single_add_to_cart_button::after,
	        .product-wrap-5 .product-action-4 .pro-same-action a:hover{
	                background-color: {$secondary_color};
	        }";

	   	// color
	    $custom_css[] = "
	        .shop-top-bar .shop-tab li a.active,
	        .woocommerce .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item.chosen a::before,
	        .product-wrap-5 .yith-wcwl-wishlistexistsbrowse.show a i{
	            color: {$secondary_color};
	        }";

	    // border color
        $custom_css[] = "
         .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.shop-list-wrap .shop-list-content .shop-list-btn a:hover{
             border-color: {$secondary_color};
         }";
	}

	//Menu Color
	if($menu_default_color){
	   	// color
	    $custom_css[] = "
	        .main-menu nav ul li>a, #primary-menu .menu-item-has-children::after,.sidebar-menu nav ul li a,.home-sidebar-left .sidebar-copyright p,.header-right-wrap .same-style>a,.header-right-wrap .same-style.cart-wrap button,.flone_header_4 .main-menu.menu-white nav > ul > li>a, .flone_header_4 #primary-menu .menu-item-has-children::after,.header-right-wrap.header-right-wrap-white .same-style>a,.header-right-wrap.header-right-wrap-white .same-style.cart-wrap>button{
	            color: {$menu_default_color};
	        }";
	    // border color
        $custom_css[] = "
         .mean-container a.meanmenu-reveal{
             border-color: {$menu_default_color};
         }";
		 // bg color
	    $custom_css[] = "
	        .mean-container a.meanmenu-reveal span,.header-right-wrap.header-right-wrap-white .same-style.cart-wrap>button span.count-style{
	                background: {$menu_default_color};
	        }";
	}

	//Sticky Menu Color
	if($sticky_menu_default_color){
	   	// color
	    $custom_css[] = "
	        .stick .main-menu nav ul li>a, .stick #primary-menu .menu-item-has-children::after,.stick .header-right-wrap .same-style>a,.stick .header-right-wrap .same-style.cart-wrap button,.stick .mean-container a.meanmenu-reveal{
	            color: {$sticky_menu_default_color};
	        }";
	    // border color
        $custom_css[] = "
         .stick .mean-container a.meanmenu-reveal{
             border-color: {$sticky_menu_default_color};
         }";
		 // bg color
	    $custom_css[] = "
	        .stick .mean-container a.meanmenu-reveal span{
	                background: {$sticky_menu_default_color};
	        }";
	}

	// link color
	 if($link_color){
	     $custom_css[] = "
	        a{
	            color: {$link_color};
	        }";
	 }

	// link hover color
	if($link_hover_color){
	    $custom_css[] = "
	        a:hover,
	        .widget-area a:hover,
	        article .post-meta a:hover,
	        .entry-title a:hover,
	        .main-menu nav ul li:hover a,
	        .single-sidebar-blog .sidebar-blog-content span a:hover,
	        .product-wrap .product-content a:hover h2,
	        .product .entry-summary .pro-details-social ul li a:hover,
	        .product .entry-summary .product_meta a:hover{
	           color: {$link_hover_color};
	        }";
	}

	// site padding
	if( $site_padding ){
		 $custom_css[] = ".site{padding: {$site_padding }px}";
	}

	// site content padding
	if($site_content_pt && $site_content_pt['padding-top']){
		 $custom_css[] = ".site-content{padding-top: {$site_content_pt['padding-top']}}";
	}
	if($site_content_pb && $site_content_pb['padding-bottom']){
		 $custom_css[] = ".site-content{padding-bottom: {$site_content_pb['padding-bottom']}}";
	}

	// disable product image zoom
	if( !flone_get_option('enable_image_zoom', '1') ){
		$custom_css[] = ".single-product .zoomContainer{display:none}";
	}

	// footer icon color
	if( $footer_icon_color ){
		$custom_css[] = ".footer-top .footer-social ul li::before{background-color:$footer_icon_color}";
		$custom_css[] = ".footer-top .footer-social ul li a, .footer-top .footer-social ul li a i{color:$footer_icon_color}";
	}

    wp_add_inline_style( 'flone-style', implode('', $custom_css) );
}
add_action( 'wp_enqueue_scripts', 'flone_inline_css' );

class FloneWooCommerce {
	public $plugin_file=__FILE__;
	public $responseObj;
	public $licenseMessage;
	public $showMessage=false;
	public $slug="flone";
	function __construct() {
		// main admin menu
		add_action( 'admin_menu', [$this,'main_admin_menu']);

		

		add_action( 'admin_print_styles', [ $this, 'SetAdminStyle' ] );
		$licenseKey=get_option("FloneWooCommerce_lic_Key","");
		$liceEmail=get_option( "FloneWooCommerce_lic_email","");
		if(FloneWooCommerceBase::CheckWPPlugin($licenseKey,$liceEmail,$this->licenseMessage,$this->responseObj,dirname(__FILE__)."/style.css")){
			add_action( 'admin_menu', [$this,'ActiveAdminMenu']);
			add_action( 'admin_post_FloneWooCommerce_el_deactivate_license', [ $this, 'action_deactivate_license' ] );
			//$this->licenselMessage=$this->mess;

		}else{
			if(!empty($licenseKey) && !empty($this->licenseMessage)){
				$this->showMessage=true;
			}
			update_option("FloneWooCommerce_lic_Key","") || add_option("FloneWooCommerce_lic_Key","");
			add_action( 'admin_post_FloneWooCommerce_el_activate_license', [ $this, 'action_activate_license' ] );
			add_action( 'admin_menu', [$this,'InactiveMenu']);

			add_action( 'admin_head', array( $this, 'dismiss' ) );
			add_action( 'switch_theme', array( $this, 'update_dismiss' ) );
			add_action( 'admin_notices', [ $this, 'flone_license_notice'] );
			add_filter( 'admin_body_class',  [ $this, 'modify_admin_body_class'] );
		}
    }

    public function dismiss() {
    	if ( isset( $_GET['flone-dismiss'] ) && check_admin_referer( 'flone-dismiss-' . get_current_user_id() ) ) {
    		update_user_meta( get_current_user_id(), 'flone_dismissed_notice_id', 1 );
    	}
    }

    public function update_dismiss() {
    	delete_metadata( 'user', null, 'flone_dismissed_notice_id', null, true );
    }

    function flone_license_notice() {
    	if( get_user_meta( get_current_user_id(), 'flone_dismissed_notice_id', true ) ){
    		return;
    	}

    	$button = sprintf('<a href="%1s" class="button button-primary">%2s</a>',
    		admin_url( 'admin.php?page='.$this->slug),
    		__('Activate License', 'flone')
    	);
        ?>
        <div class="notice flone-notice notice-warning">
        	<strong><?php echo esc_html__('Welcome to Flone!', 'flone'); ?></strong>
    		<p><?php echo esc_html__( 'Please activate your license/purchase code to get automatic theme updates.', 'flone' ); ?></p>
    		<div><?php echo wp_kses_post( $button ); ?></div>
    		<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'flone-dismiss', 'dismiss_admin_notices' ), 'flone-dismiss-' . get_current_user_id() ) ); ?>">
    			<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
    		</a>
        </div>
        <?php
    }

    function main_admin_menu(){
    	add_menu_page (  esc_html__("Flone WooCommerce", "flone"), esc_html__("Flone WP", 'flone'), 'activate_plugins', $this->slug, [$this,"option_page"], " dashicons-admin-generic ", 85);
    }

    function option_page(){
    	return '';
    }

	function SetAdminStyle() {
		wp_register_style( "FloneWooCommerceLic", get_theme_file_uri("lic_style.css"),10);
		wp_enqueue_style( "FloneWooCommerceLic" );
	}
	function ActiveAdminMenu(){
		add_submenu_page (  "flone", esc_html__("FloneWooCommerce", "flone"), esc_html__("Flone License", 'flone'), 'activate_plugins', $this->slug, [$this,"Activated"]);
		
	}
	function InactiveMenu() {
		add_submenu_page (  "flone", esc_html__("FloneWooCommerce", "flone"), esc_html__("Flone License", 'flone'), 'activate_plugins', $this->slug,  [$this,"LicenseForm"]);
		
	}
	function action_activate_license(){
		check_admin_referer( 'el-license' );
		$licenseKey=!empty($_POST['el_license_key'])?$_POST['el_license_key']:"";
		$licenseEmail=!empty($_POST['el_license_email'])?$_POST['el_license_email']:"";
		update_option("FloneWooCommerce_lic_Key",$licenseKey) || add_option("FloneWooCommerce_lic_Key",$licenseKey);
		update_option("FloneWooCommerce_lic_email",$licenseEmail) || add_option("FloneWooCommerce_lic_email",$licenseEmail);
		wp_safe_redirect(admin_url( 'admin.php?page='.$this->slug));
	}
	function action_deactivate_license() {
		check_admin_referer( 'el-license' );
		if(FloneWooCommerceBase::RemoveLicenseKey(__FILE__,$message)){
			update_option("FloneWooCommerce_lic_Key","") || add_option("FloneWooCommerce_lic_Key","");
		}
    	    wp_safe_redirect(admin_url( 'admin.php?page='.$this->slug));
        }
	function Activated(){
		?>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="FloneWooCommerce_el_deactivate_license"/>
            <div class="el-license-container">
                <h3 class="el-license-title"><i class="dashicons-before dashicons-star-filled"></i> <?php echo esc_html__("Flone WooCommerce Theme License Info", "flone"); ?></h3>
                <hr>
                <ul class="el-license-info">
                    <li>
                        <div>
                            <span class="el-license-info-title"><?php echo esc_html__("Status", "flone"); ?></span>
							
							<?php if ( $this->responseObj->is_valid ) : ?>
                                <span class="el-license-valid"><?php echo esc_html__("Valid", "flone"); ?></span>
							<?php else : ?>
                                <span class="el-license-valid"><?php echo esc_html__("Invalid", "flone"); ?></span>
							<?php endif; ?>
                        </div>
                    </li>

                    <li>
                        <div>
                            <span class="el-license-info-title"><?php echo esc_html__("License Type", "flone"); ?></span>
							<?php echo $this->responseObj->license_title; ?>
                        </div>
                    </li>

                    <li>
                        <div>
                            <span class="el-license-info-title"><?php echo esc_html__("License Expired on", "flone"); ?></span>
							<?php echo $this->responseObj->expire_date; ?>
                        </div>
                    </li>

                    <li>
                        <div>
                            <span class="el-license-info-title"><?php echo esc_html__("Support Expired on", "flone"); ?></span>
							<?php echo $this->responseObj->support_end; ?>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="el-license-info-title"><?php echo esc_html__("Your License Key", "flone"); ?></span>
                            <span class="el-license-key"><?php echo esc_attr( substr($this->responseObj->license_key,0,9)."XXXXXXXX-XXXXXXXX".substr($this->responseObj->license_key,-9) ); ?></span>
                        </div>
                    </li>
                </ul>
                <div class="el-license-active-btn">
					<?php wp_nonce_field( 'el-license' ); ?>
					<?php submit_button('Deactivate'); ?>
                </div>
            </div>
        </form>
		<?php
	}
	
	function LicenseForm() {
		?>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
            <input type="hidden" name="action" value="FloneWooCommerce_el_activate_license"/>
            <div class="el-license-container">
                <h3 class="el-license-title"><i class="dashicons-before dashicons-star-filled"></i> <?php echo esc_html__("Flone WooCommerce Theme Licensing", "flone"); ?></h3>
                <hr>
				<?php
					if(!empty($this->showMessage) && !empty($this->licenseMessage)){
						?>
                        <div class="notice notice-error is-dismissible">
                            <p><?php echo ($this->licenseMessage); ?></p>
                        </div>
						<?php
					}
				?>
                <div class="el-license-field">
                    <label for="el_license_key"><?php echo esc_html__("Purchase Code / License Key", "flone"); ?></label>
                    <input type="text" class="regular-text code" name="el_license_key" size="50" placeholder="xxxxxxxx-xxxxxxxx-xxxxxxxx-xxxxxxxx" required="required">
                </div>
                <div class="el-license-field">
                    <label for="el_license_key"><?php echo esc_html__("Email Address", "flone"); ?></label>
                    <?php
                        $purchaseEmail   = get_option( "FloneWooCommerce_lic_email", get_bloginfo( 'admin_email' ));
                    ?>
                    <input type="text" class="regular-text code" name="el_license_email" size="50" value="<?php echo $purchaseEmail; ?>" placeholder="" required="required">
                    <div><small><?php echo esc_html__("We will send update news of this product by this email address, don't worry, we hate spam", "flone"); ?></small></div>
                </div>
                <div class="el-license-active-btn">
					<?php wp_nonce_field( 'el-license' ); ?>
					<?php submit_button('Activate'); ?>
                </div>
            </div>
        </form>
		<?php
	}

	function modify_admin_body_class( $classes ) {
		$classes .= 'flone_license_deactive';
	    return $classes;
	}
}

new FloneWooCommerce();