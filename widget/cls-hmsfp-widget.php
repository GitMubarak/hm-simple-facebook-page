<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
* FeedBook Widget Master
*/
class Hmsfp_Widget extends WP_Widget {
	
	/**
	* Register widget
	*/
	function __construct() {
        parent::__construct(
            'hm-classic-facebook-likebox',
            __('FeedBook - Social Page Feeds Widget'),
            array( 'description' => __( 'Display Your FaceBook Page', HMSFP_TEXT_DOMAIN), ),
        );
    }
	
	/**
	* Front-end display of widget.
	*
	* @see WP_Widget::widget()
	*
	* @param array $args Widget arguments.
	* @param array $instance Saved values from database.
	*/
	function widget( $args, $instance ) {

		echo $args['before_widget'];
		
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		if ( ! empty( $instance['page_name'] ) ) { $page_name = $instance[ 'page_name' ]; }
		if ( ! empty( $instance['data_tabs'] ) ) { $data_tabs = $instance[ 'data_tabs' ]; }
		if ( $data_tabs === 'all' ) {
			$data_tabs2 = 'timeline, messages, events';
		} else {
			$data_tabs2 = $data_tabs;
		}
		if ( ! empty( $instance['hmsfp_height'] ) ) { $hmsfp_height = $instance[ 'hmsfp_height' ]; }
		if ( ! empty( $instance['page_cover'] ) ) { $page_cover = $instance[ 'page_cover' ]; }
		?>
		<div class="fb-page" data-href="https://www.facebook.com/hmplugin/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/hmplugin/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/hmplugin/">HM Plugin</a></blockquote></div>
		<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fhmplugin%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
		<?php
		echo $args['after_widget'];
	}
	
	/**
	* Back-end widget form.
	*
	* @see WP_Widget::form()
	*
	* @param array $instance Previously saved values from database.
	*/
	function form( $instance ) {

		$instance 		= wp_parse_args( (array) $instance, array( 'title' => 'Connect With Us', 'page_name' => 'hossnimubarak', 'page_cover' => 'false', 'data_tabs' => 'timeline', 'hmsfp_height' => 70 ) );
        $title 			= $instance['title'];
        $page_name 		= $instance['page_name'];
		$page_cover 	= $instance['page_cover'];
        $data_tabs		= $instance['data_tabs'];
        $hmsfp_height 	= $instance['hmsfp_height'];
        ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">Title: 
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('page_name'); ?>">Facebook Page: 
                    <input class="widefat" id="<?php echo $this->get_field_id('page_name'); ?>" name="<?php echo $this->get_field_name('page_name'); ?>" type="text" value="<?php echo esc_attr( $page_name ); ?>" />
                </label>
            </p>
			<p>
                <label for="<?php echo $this->get_field_id('page_name'); ?>">Page Cover:
                    &nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="<?php echo $this->get_field_id('page_cover'); ?>" name="<?php echo $this->get_field_name('page_cover'); ?>" value="false" <?php if($page_cover == 'false') echo 'checked'; ?> />
					Yes
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" id="<?php echo $this->get_field_id('page_cover'); ?>" name="<?php echo $this->get_field_name('page_cover'); ?>" value="true" <?php if($page_cover == 'true') echo 'checked'; ?> />
					No
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tweets'); ?>">Data Tabs*:
					<select class="widefat" id="<?php echo $this->get_field_id('data_tabs'); ?>" name="<?php echo $this->get_field_name('data_tabs'); ?>">
						<option value="none" <?php if($data_tabs=='none') echo 'selected'; ?>>None</option>
						<option value="timeline" <?php if($data_tabs=='timeline') echo 'selected'; ?>>Timeline</option>
						<option value="events" <?php if($data_tabs=='events') echo 'selected'; ?>>Events</option>
						<option value="messages" <?php if($data_tabs=='messages') echo 'selected'; ?>>Messages</option>
						<option value="all" <?php if($data_tabs=='all') echo 'selected'; ?>>All</option>
					</select>
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('hmsfp_height'); ?>">Height*:
                    <input class="widefat" id="<?php echo $this->get_field_id('hmsfp_height'); ?>" name="<?php echo $this->get_field_name('hmsfp_height'); ?>" type="number" value="<?php echo esc_attr($hmsfp_height); ?>" />
                </label>
            </p>
            <p><small>*Min. is 70px</small></p>
			<p style="margin-bottom: 1px! important;">
				<a href="https://hossnimubarak.com" target="_blank" class="button button-primary">Get Support</a>
				<a href='https://www.paypal.me/mhmrajib' class="button button-primary" target="_blank">Donate</a>
				<a href='https://wordpress.org/support/plugin/hm-simple-facebook-page/reviews/#new-post' class="button button-primary" target="_blank">Rate Us!</a>
			</p>
			<br>
		<?php
	}
	
	/*
	* Sanitize widget form values as they are saved.
	*
	* @see WP_Widget::update()
	*
	* @param array $new_instance Values just sent to be saved.
	* @param array $old_instance Previously saved values from database.
	*
	* @return array Updated safe values to be saved.
	*/
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['page_name'] = strip_tags($new_instance['page_name']);

        if(is_numeric($new_instance['tweets'])) {
            $instance['tweets'] = $new_instance['tweets'];
        }

        if(is_numeric($new_instance['hmsfp_height'])) {
            $instance['hmsfp_height'] = ( ! empty( $new_instance['hmsfp_height'] )) ? strip_tags( $new_instance['hmsfp_height'] ) : 70;
			$instance['hmsfp_height'] = ( ( $new_instance['hmsfp_height'] )>70) ? strip_tags( $new_instance['hmsfp_height'] ) : 70;
        }
		
		$instance['data_tabs'] = ( ! empty( $new_instance['data_tabs'] )) ? strip_tags( $new_instance['data_tabs'] ) : '';
		$instance['page_cover'] = ( ! empty( $new_instance['page_cover'] )) ? strip_tags( $new_instance['page_cover'] ) : 'false';

        return $instance;
	}
}
?>