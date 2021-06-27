<?php
/**
 * Plugin Name: 	FeedBook - Social Page Feeds Widget
 * Plugin URI:		http://wordpress.org/plugins/hm-simple-facebook-page-plugin/
 * Description: 	This Social Page Feeds Widget plugin will help you to display a FB likebox in your website's widget area.
 * Version: 		1.6
 * Author: 			Hossni Mubarak
 * Author URI: 		http://www.hossnimubarak.com
 * License:         GPL-2.0+
 * License URI:		http://www.gnu.org/licenses/gpl-2.0.txt
*/

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! defined('WPINC') ) die;

define( 'HMSFP_PATH', plugin_dir_path( __FILE__ ) );
define( 'HMSFP_ASSETS', plugins_url( '/assets/', __FILE__ ) );
define( 'HMSFP_LANG', plugins_url('/languages/', __FILE__));
define( 'HMSFP_SLUG', plugin_basename( __FILE__ ) );
define( 'HMSFP_VERSION', '1.6' );
define( 'HMSFP_TEXT_DOMAIN', 'hm-simple-facebook-page' );
define( 'HMSFP_CLS_PRFX', 'cls-hmsfp' );

require_once HMSFP_PATH . 'inc/' . HMSFP_CLS_PRFX . '-master.php';
new HMSFP_Master();

// Donate link to plugin description
function hmsfp_display_donation_link( $links, $file ) {

    if ( HMSFP_SLUG === $file ) {
        $row_meta = array(
          'hmsfp_donation'  => '<a href="' . esc_url( 'https://www.paypal.me/mhmrajib/' ) . '" target="_blank" aria-label="' . esc_attr__( 'Donate us', 'hm-simple-facebook-page' ) . '" style="color:green; font-weight: bold;">' . esc_html__( 'Donate us', 'hm-simple-facebook-page' ) . '</a>'
        );
 
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}
add_filter( 'plugin_row_meta', 'hmsfp_display_donation_link', 10, 2 );


function hmsfp_load_shortcode_view( $attr ) {
    $output = '';
    ob_start();

    if ( ! empty( $attr['page_name'] ) ) { 
        $page_name = $attr[ 'page_name' ]; 
    } else {
        $page_name = '';
        echo esc_html('Page name missing!', 'hm-simple-facebook-page');
    }

    if ( ! empty( $attr['tabs'] ) ) { 
        $data_tabs = $attr['tabs']; 
    } else {
        $data_tabs = 'none';
    }
    if ( $data_tabs === 'all' ) {
        $data_tabs2 = 'timeline, messages, events';
    } else {
        $data_tabs2 = $data_tabs;
    }

    if ( ! empty( $attr['height'] ) ) { 
        $hmsfp_height = $attr['height']; 
    } else {
        $hmsfp_height = 270;
    }

    if ( ! empty( $attr['hide_cover'] ) && 'true' === $attr['hide_cover'] ) { 
        $page_cover = $attr['hide_cover']; 
    } else {
        $page_cover = false;
    }
    ?>
    <div class="fb-page" data-height="<?php echo esc_attr( $hmsfp_height ); ?>" 
        data-href="https://www.facebook.com/<?php echo esc_attr( $page_name ); ?>/" 
        data-tabs="<?php echo $data_tabs2; ?>" 
        data-small-header="true" 
        data-adapt-container-width="true" 
        data-hide-cover="<?php echo esc_attr( $page_cover ); ?>" 
        data-show-facepile="true">
        <blockquote cite="https://www.facebook.com/<?php echo esc_attr( $page_name ); ?>/" class="fb-xfbml-parse-ignore">
            <a href="https://www.facebook.com/<?php echo esc_attr( $page_name ); ?>/"><?php echo esc_html( $page_name ); ?></a>
        </blockquote>
    </div>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <?php
    $output .= ob_get_clean();
    return $output;
}
add_shortcode('hm_feedbook', 'hmsfp_load_shortcode_view');
?>