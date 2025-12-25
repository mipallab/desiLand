<?php
/**
 * DesiLan functions and definitions
 *
 * @package DesiLan
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Enqueue scripts and styles.
 */
// Customizer options
require get_template_directory() . '/inc/customizer.php';

function desilan_scripts() {
	wp_enqueue_style( 'desilan-style', get_stylesheet_uri() );
	
	// Enqueue Tailwind (CDN for now as per previous step) - usually better to enqueue properly or keep in header.php if just CDN. 
	// Since header.php has the CDN link hardcoded, we leave it there or move it here. 
	// For now, leaving as is in header.php to minimize disruption, but just noting it.
	wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
}
add_action( 'wp_enqueue_scripts', 'desilan_scripts' );

/**
 * Check for Elementor dependency.
 */
function desilan_check_elementor_dependency() {
	// Check if Elementor is installed and activated.
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'desilan_elementor_missing_notice' );
	}
}
add_action( 'after_setup_theme', 'desilan_check_elementor_dependency' );

/**
 * Admin notice for missing Elementor.
 */
function desilan_elementor_missing_notice() {
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}

	$message = sprintf(
		/* translators: 1: Theme Name, 2: Elementor */
		esc_html__( '"%1$s" requires %2$s to be installed and activated.', 'desilan' ),
		'<strong>' . esc_html__( 'DesiLan', 'desilan' ) . '</strong>',
		'<strong>' . esc_html__( 'Elementor', 'desilan' ) . '</strong>'
	);

	printf( '<div class="notice notice-warning is-dismissible"><p>%s</p></div>', $message ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function desilan_widgets_init() {
	// Footer Column 1
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 1', 'desilan' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here to replace the default Branding/Contact section.', 'desilan' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="font-display font-bold text-white mb-6 block text-sm">',
			'after_title'   => '</h4>',
		)
	);

	// Footer Column 2
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 2', 'desilan' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here to replace the default Explore section.', 'desilan' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="text-white font-medium mb-6 text-sm">',
			'after_title'   => '</h4>',
		)
	);

	// Footer Column 3
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 3', 'desilan' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here to replace the default Support section.', 'desilan' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="text-white font-medium mb-6 text-sm">',
			'after_title'   => '</h4>',
		)
	);

	// Footer Column 4
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 4', 'desilan' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here to replace the default Legal section.', 'desilan' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="text-white font-medium mb-6 text-sm">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'desilan_widgets_init' );


/**
 * Load Custom Widget
 */
require get_template_directory() . '/inc/widgets/class-desilan-icon-list-widget.php';
require get_template_directory() . '/inc/widgets/class-desilan-footer-heading-widget.php';

/**
 * Register custom widgets.
 */
function desilan_register_custom_widgets() {
    register_widget( 'DesiLan_Icon_Link_Widget' );
    register_widget( 'DesiLan_Footer_Heading_Widget' );
}
add_action( 'widgets_init', 'desilan_register_custom_widgets' );

/**
 * Enqueue Admin Scripts for Widgets
 */
function desilan_admin_enqueue_scripts() {
    wp_enqueue_media();
    wp_enqueue_script( 'desilan-admin-widget', get_template_directory_uri() . '/assets/js/admin-widget.js', array( 'jquery' ), '1.0', true );
}
add_action( 'admin_enqueue_scripts', 'desilan_admin_enqueue_scripts' );

/**
 * Custom Login Handler
 */
function desilan_handle_login() {
	if ( isset( $_POST['desilan_login_nonce'] ) && wp_verify_nonce( $_POST['desilan_login_nonce'], 'desilan_login_action' ) ) {
		
		$username = sanitize_text_field( $_POST['login_username'] );
		$password = $_POST['login_password'];
		$remember = isset( $_POST['remember_me'] ) ? true : false;

		$credentials = array(
			'user_login'    => $username,
			'user_password' => $password,
			'remember'      => $remember,
		);

		$user = wp_signon( $credentials, false );

		if ( is_wp_error( $user ) ) {
			wp_redirect( add_query_arg( 'login', 'failed', wp_get_referer() ) );
			exit;
		}

		// Redirect to home or referrer
		$redirect_to = home_url();
		if ( isset( $_GET['redirect_to'] ) ) {
			$redirect_to = esc_url_raw( $_GET['redirect_to'] );
		}
		wp_redirect( $redirect_to );
		exit;
	}
}
add_action( 'template_redirect', 'desilan_handle_login' );

/**
 * Custom Registration Handler
 */
function desilan_handle_registration() {
	if ( isset( $_POST['desilan_register_nonce'] ) && wp_verify_nonce( $_POST['desilan_register_nonce'], 'desilan_register_action' ) ) {
		
		$name     = sanitize_text_field( $_POST['register_name'] );
		$email    = sanitize_email( $_POST['register_email'] );
		$password = $_POST['register_password'];
		$confirm  = $_POST['register_confirm'];

		// Validation
		if ( $password !== $confirm ) {
			wp_redirect( add_query_arg( 'register', 'password_mismatch', wp_get_referer() ) );
			exit;
		}

		if ( ! is_email( $email ) ) {
			wp_redirect( add_query_arg( 'register', 'invalid_email', wp_get_referer() ) );
			exit;
		}

		if ( email_exists( $email ) ) {
			wp_redirect( add_query_arg( 'register', 'email_exists', wp_get_referer() ) );
			exit;
		}

		// Create username from email
		$username = sanitize_user( current( explode( '@', $email ) ), true );
		
		// Make username unique if it exists
		if ( username_exists( $username ) ) {
			$username = $username . wp_rand( 100, 999 );
		}

		// Create user
		$user_id = wp_create_user( $username, $password, $email );

		if ( is_wp_error( $user_id ) ) {
			wp_redirect( add_query_arg( 'register', 'failed', wp_get_referer() ) );
			exit;
		}

		// Update display name
		wp_update_user( array(
			'ID'           => $user_id,
			'display_name' => $name,
			'first_name'   => $name,
		) );

		// Auto login after registration
		wp_set_current_user( $user_id );
		wp_set_auth_cookie( $user_id );

		// Redirect to home
		wp_redirect( home_url() );
		exit;
	}
}
add_action( 'template_redirect', 'desilan_handle_registration' );

/**
 * Redirect wp-login.php to custom auth page
 */
function desilan_redirect_login_page() {
	$page_viewed = basename( $_SERVER['REQUEST_URI'] );

	if ( $page_viewed == 'wp-login.php' && $_SERVER['REQUEST_METHOD'] == 'GET' ) {
		// Get the auth page URL
		$auth_page = get_pages( array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'page-auth.php'
		) );

		if ( ! empty( $auth_page ) ) {
			$auth_url = get_permalink( $auth_page[0]->ID );
			wp_redirect( $auth_url );
			exit;
		}
	}
}
add_action( 'init', 'desilan_redirect_login_page' );

/**
 * Update header login/register URLs to use custom page
 */
function desilan_get_auth_page_url() {
	$auth_page = get_pages( array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => 'page-auth.php'
	) );

	if ( ! empty( $auth_page ) ) {
		return get_permalink( $auth_page[0]->ID );
	}

	return wp_login_url();
}

