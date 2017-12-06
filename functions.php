<?php
/**
 * Sets the theme functions
 *
 * @package kili-luna
 */

// Load the parent theme.
include get_template_directory() . '/config/load.php';
// Autoload kili-luna Includes.
foreach ( glob( __DIR__ . '/inc/*.php' ) as $module ) {
	if ( ! $modulepath = $module ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'kili-luna' ), $module ), E_USER_ERROR );
	}
	require_once( $modulepath );
}
unset( $module, $filepath );

if( ! class_exists( 'Kili_Luna' ) ) {
	/**
	* Child theme main Class
	*/
	class Kili_Luna {
		/**
		 * Class constructor
		 */
		function __construct() {
			$this->theme_setup();
			$this->add_actions();
		}

		/**
		 * Theme setup
		 *
		 * @return void
		 */
		public function theme_setup() {
			global $kili_framework;
			register_nav_menus( array(
				'primary_navigation' => __( 'Primary Navigation', 'kili-luna' ),
			) );
			$kili_framework->dynamic_styles->set_base_styles( get_base_styles() );
			$kili_framework->render_pages();
		}

		/**
		 * Add actions to theme
		 *
		 * @return void
		 */
		public function add_actions() {
			if ( ! is_admin() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );
			}
			// add_action( 'after_setup_theme', array( $this, 'theme_translations' ) );
			// add_action( 'customize_register', array( $this, 'theme_customizer' ) );
		}

		/**
		 * Load the theme assets
		 *
		 * @return void
		 */
		public function load_assets() {
			global $kili_framework;
			wp_enqueue_style( 'theme-style', $kili_framework->asset_path( 'styles/main.css' ), false, null );
			wp_enqueue_style( 'theme-style-overwrite', $kili_framework->asset_path( 'styles/block-styles.css' ), array( 'theme-style' ) );
			wp_enqueue_script( 'theme-scripts', $kili_framework->asset_path( 'scripts/main.js' ), ['jquery'], null, true );
		}

		/**
		 * Add theme translations folder
		 *
		 * @return void
		 */
		public function theme_translations() {
			load_child_theme_textdomain( 'kili-luna', get_stylesheet_directory() . '/languages' );
		}

		/**
		 * Theme customizer
		 *
		 * @param object $wp_customize WordPress customizer object
		 * @return void
		 */
		public function theme_customizer( $wp_customize ) {
			// code
		}
	}
}

// Start the main class.
$kili_luna_class = new Kili_Luna();

function seo_dynamic_title() {
	echo bloginfo( 'name' ) . wp_title( ' | ', false, 'left' );
}

// Autoload kili-luna custom post types.
foreach ( glob( __DIR__ . '/inc/cpt/*.php' ) as $module ) {
	if ( ! $modulepath = $module ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'kili-luna' ), $module ), E_USER_ERROR );
	}
	require_once( $modulepath );
}
unset( $module, $filepath );
