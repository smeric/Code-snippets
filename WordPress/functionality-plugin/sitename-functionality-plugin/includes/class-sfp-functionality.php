<?php
/**
 * Functionality name
 * 
 * @package    SFP
 * @subpackage SFP/includes
 * @copyright  Copyright (c) 2016, Sébastien Méric
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0
 * @author     Sébastien Méric <sebastien.meric@gmail.com>
 * 
 * TODO
 * Add to class-sfp-init.php
 *     $sfp_sitename_functionality = new SFP_Sitename_Functionality();
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Main class.
if ( ! class_exists( 'SFP_Sitename_Functionality' ) ) {

	class SFP_Sitename_Functionality {

		/**
		 * Initialize the class
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function __construct() {
			// actions
			//add_action( 'hook_name', array( $this, 'function_name' ), 10, 2 );

			// filters
			//add_filter( 'hook_name', array( $this, 'function_name' ) );

			// shortcodes
			//add_shortcode( 'shortcode_name', array( $this, 'function_name' ) );
		}

		/**
		 * Any function...
		 *
		 * @since  1.0
		 * @access public
		 * @param  int    $int    Integer
		 * @param  string $string String
		 * @param  array  $array  Array
		 * @return void
		 */
		public function function_name( $int, $string, $array ) {
			// Do whatever...
		}

	}

}
