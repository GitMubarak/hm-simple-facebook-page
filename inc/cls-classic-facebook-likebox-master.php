<?php
/**
 * Our main plugin class
*/
class HMSFP_Master {

	public function __construct() {
		$this->hmsfp_load_dependencies();
		$this->hmsfp_trigger_widget_hooks();
	}
	
	/**
	 * Loading Required Dependencies
	*/
	private function hmsfp_load_dependencies() {

		require_once HMSFP_PATH . 'widget/' . HMSFP_CLS_PRFX .'-widget.php';
		
	}
	
	/**
	 * Loading The Widget
	*/
	private function hmsfp_trigger_widget_hooks() {

		new Hmsfp_Widget();
		add_action( 'widgets_init', function(){ register_widget( 'Hmsfp_Widget' ); });
		add_action( 'wp_enqueue_scripts', array($this, 'hmsfp_front_assets' ));
	}

	function hmsfp_front_assets(){
		wp_enqueue_style('hmsfp-front-style', HMSFP_ASSETS . 'css/hmsfp-front-style.css', array(), HMSFP_VERSION, FALSE );
	}
}
