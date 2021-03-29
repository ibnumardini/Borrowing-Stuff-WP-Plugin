<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://ibnumardini.id
 * @since      1.0.0
 *
 * @package    Borrowing_Stuff
 * @subpackage Borrowing_Stuff/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Borrowing_Stuff
 * @subpackage Borrowing_Stuff/includes
 * @author     Ibnu Mardini <qodr.ibnumardini@gmail.com>
 */
class Borrowing_Stuff_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'borrowing-stuff',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
