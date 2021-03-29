<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://ibnumardini.id
 * @since             1.0.0
 * @package           Borrowing_Stuff
 *
 * @wordpress-plugin
 * Plugin Name:       Borrowing Stuff
 * Plugin URI:        https://borrowing-stuff.com
 * Description:       This is used for management Borrowing Stuff, light and very easy.
 * Version:           1.0.0
 * Author:            Ibnu Mardini
 * Author URI:        https://ibnumardini.id
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       borrowing-stuff
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('BORROWING_STUFF_VERSION', '1.0.0');
define('BORROWING_STUFF_PLUGIN_URL', plugin_dir_url(__FILE__));
define('BORROWING_STUFF_PLUGIN_PATH', plugin_dir_path(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-borrowing-stuff-activator.php
 */
function activate_borrowing_stuff()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-borrowing-stuff-activator.php';
    $activator = new Borrowing_Stuff_Activator();
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-borrowing-stuff-deactivator.php
 */
function deactivate_borrowing_stuff()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-borrowing-stuff-deactivator.php';
	require_once plugin_dir_path(__FILE__) . 'includes/class-borrowing-stuff-activator.php';
	
    $activator = new Borrowing_Stuff_Activator();
    $deactivator = new Borrowing_Stuff_Deactivator($activator);
	$deactivator->deactivate();
}

register_activation_hook(__FILE__, 'activate_borrowing_stuff');
register_deactivation_hook(__FILE__, 'deactivate_borrowing_stuff');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-borrowing-stuff.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_borrowing_stuff()
{

    $plugin = new Borrowing_Stuff();
    $plugin->run();

}
run_borrowing_stuff();
