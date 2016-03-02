<?php
/**
 * @package     SFP
 * @link        https://github.com/Code-snippets/
 * @copyright   Copyright (c) 2016, Sébastien Méric
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 * @author      Sébastien Méric <sebastien.meric@gmail.com>
 *
 * @wordpress-plugin
 * Plugin Name: Functionality plugin for sitename
 * Plugin URI:  https://github.com/Code-snippets/
 * Description: Adds funcionalities to this website regardless the theme actualy in use.
 * Version:     1.0
 * Author:      Sébastien Méric
 * Author URI:  http://www.sebastien-meric.com/
 * License:     GNU General Public License v2.0 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sfp-sitename
 * Domain Path: /languages/
 * 
 * TODO
 * Search/replace : SFP_Sitename, sfp_sitename, sfp-sitename
 * 
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Main class.
if ( ! class_exists( 'SFP_Sitename' ) ) {

	class SFP_Sitename {

		/**
		 * Instance of the class
		 *
		 * @since 1.0
		 * @var   Instance of SFP_Sitename class
		 */
		private static $instance;

		/**
		 * Main Instance
		 *
		 * Ensures that only one instance exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since     1.0
		 * @static
		 * @staticvar array $instance
		 * @return    Instance
		 */
		public static function instance() {
			if ( ! isset ( self::$instance ) && ! ( self::$instance instanceof SFP_Sitename ) ) {
				self::$instance = new self;
				self::$instance->setup_globals();
				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );
				self::$instance->includes();
				self::$instance->init = new SFP_Sitename_Init();
				self::$instance->setup_actions();
			}
			return self::$instance;
		}

		/**
		 * Globals
		 *
		 * @since  1.0
		 * @access private
		 * @return void
		 */
		private function setup_globals() {
			// Paths
			$this->file       = __FILE__;
			$this->basename   = apply_filters( 'sfp_sitename_plugin_basenname', plugin_basename( $this->file ) );
			$this->plugin_dir = apply_filters( 'sfp_sitename_plugin_dir_path',  plugin_dir_path( $this->file ) );
			$this->plugin_url = apply_filters( 'sfp_sitename_plugin_dir_url',   plugin_dir_url ( $this->file ) );
			$this->version    = $this->get_version();
		}

		/**
		 * Loads the plugin language files
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function load_textdomain() {
			// Set filter for plugin's languages directory
			$lang_dir = dirname( $this->basename ) . '/languages/';
			$lang_dir = apply_filters( 'sfp_sitename_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter
			$locale = apply_filters( 'plugin_locale',  get_locale(), 'sfp-sitename' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'sfp-sitename', $locale );

			// Setup paths to current locale file
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/sfp-sitename/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				load_textdomain( 'sfp-sitename', $mofile_global );
			}
			elseif ( file_exists( $mofile_local ) ) {
				load_textdomain( 'sfp-sitename', $mofile_local );
			}
			else {
				// Load the default language files
				load_plugin_textdomain( 'sfp-sitename', false, $lang_dir );
			}
		}

		/**
		 * Returns current plugin version.
		 * 
		 * @since  1.0
		 * @author Gary Jones
		 * @source https://code.garyjones.co.uk/get-wordpress-plugin-version
		 * @access private
		 * @return string Plugin version
		 */
		private function get_version() {
			if ( ! function_exists( 'get_plugins' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			}

			$plugin_data    = get_plugin_data( $this->file );
			$plugin_version = $plugin_data['Version'];

			return $plugin_version;
		}

		/**
		 * Throw error on object clone
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'sfp-sitename' ), '1.6' );
		}
		/**
		 * Disable unserializing of the class
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'sfp-sitename' ), '1.6' );
		}

		/**
		 * Load the required files
		 *
		 * TODO
		 * Add functionality classes and template functions here !
		 * 
		 * @since  1.0
		 * @access private
		 * @return void
		 */
		private function includes() {
			// Functionality classes
			require_once $this->plugin_dir . 'includes/class-sfp-functionality.php';

			// Init functionality classes
			require_once $this->plugin_dir . 'includes/class-sfp-init.php';

			// Template functions
			require_once $this->plugin_dir . 'includes/template-sfp-functions.php';
		}

		/**
		 * Setup the default hooks and actions
		 *
		 * @since  1.0
		 * @access private
		 * @return void
		 */
		private function setup_actions() {
			// actions
			//add_action( 'hook_name', array( $this, 'function_name' ), 10, 2 );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_styles' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_public_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

			// filters
			//add_filter( 'hook_name', array( $this, 'function_name' ) );

			// shortcodes
			//add_shortcode( 'shortcode_name', array( $this, 'function_name' ) );

			do_action( 'sfp_sitename_setup_actions' );
		}

		/**
		 * Register the stylesheets for the public-facing side of the site.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function enqueue_public_styles() {
			wp_enqueue_style( $this->basename . '-public', $this->plugin_url . 'assets/public/css/style.css', array(), $this->version, 'all' );
		}
		/**
		 * Register the JavaScript for the public-facing side of the site.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function enqueue_public_scripts() {
			wp_enqueue_script( $this->basename . '-public', $this->plugin_url . 'assets/public/js/scripts.js', array( 'jquery' ), $this->version, false );
		}

		/**
		 * Register the stylesheets for the admin area.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function enqueue_admin_styles() {
			wp_enqueue_style( $this->basename . '-admin', $this->plugin_url . 'assets/admin/css/style.css', array(), $this->version, 'all' );
		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function enqueue_admin_scripts() {
			wp_enqueue_script( $this->basename . '-admin', $this->plugin_url . 'assets/admin/js/scripts.js', array( 'jquery' ), $this->version, false );
		}

	}

	/**
	 * Get everything running !
	 *
	 * @since  1.0
	 * @return void
	 */
	function sfp_sitename() {
		return SFP_Sitename::instance();
	}
	sfp_sitename();
}

