<?php
/**
 * Main init class
 * 
 * @package    SFP
 * @subpackage SFP/includes
 * @copyright  Copyright (c) 2016, Sébastien Méric
 * @license    http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      1.0
 * @author     Sébastien Méric <sebastien.meric@gmail.com>
 * 
 * TODO
 * Replace SFP_Sitename, SFP_Sitename_Functionality, sfp_sitename_functionality
 * Add any other functionality classes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Main class.
if ( ! class_exists( 'SFP_Sitename_Init' ) ) {

	class SFP_Sitename_Init {

		/**
		 * Initialize the class
		 *
		 * @since  1.0
		 * @access public
		 * @return void
		 */
		public function __construct() {
			$sfp_sitename_functionality = new SFP_Sitename_Functionality();
		}

	}

}
