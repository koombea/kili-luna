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
			register_nav_menus( array(
				'primary_navigation' => __( 'Primary Navigation', 'kili-luna' ),
			) );
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
		}

		/**
		 * Load the theme assets
		 *
		 * @return void
		 */
		public function load_assets() {
			wp_enqueue_style( 'theme-style', asset_path( 'styles/main.css' ), false, null );
			wp_enqueue_script( 'theme-scripts', asset_path( 'scripts/main.js' ), ['jquery'], null, true );
		}

	}
}

// Start the main class.
$kili_luna_class = new Kili_Luna();

// Autoload kili-luna custom post types.
foreach ( glob( __DIR__ . '/inc/cpt/*.php' ) as $module ) {
	if ( ! $modulepath = $module ) {
		trigger_error( sprintf( __( 'Error locating %s for inclusion', 'kili-luna' ), $module ), E_USER_ERROR );
	}
	require_once( $modulepath );
}
unset( $module, $filepath );
