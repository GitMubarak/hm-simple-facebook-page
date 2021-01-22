<?php
/**
 * Plugin Name: 	Classic FB LikeBox
 * Plugin URI:		http://wordpress.org/plugins/hm-simple-facebook-page-plugin/
 * Description: 	This Classic FB LikeBox plugin will help you to display a FB likebox in your Widget/Sidebar/Footer area.
 * Version: 		1.4
 * Author: 			Hossni Mubarak
 * Author URI: 		http://www.hossnimubarak.com
 * License:         GPL-2.0+
 * License URI:		http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'WPINC' ) ) { die; }

define( 'HMSFP_PATH', plugin_dir_path( __FILE__ ) );
define( 'HMSFP_ASSETS', plugins_url( '/assets/', __FILE__ ) );
define( 'HMSFP_SLUG', plugin_basename( __FILE__ ) );
define( 'HMSFP_VERSION', '1.4' );
define( 'HMSFP_TEXT_DOMAIN', 'hm-simple-fb-page-plugin' );
define( 'HMSFP_CLS_PRFX', 'cls-classic-facebook-likebox' );

require_once HMSFP_PATH . 'inc/' . HMSFP_CLS_PRFX . '-master.php';
new HMSFP_Master();
?>