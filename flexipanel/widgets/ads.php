<?php
/**
 * Widget: Flexi Ads
 * Author: FlexiThemes.com
 * Version: 2.0
 * Updated: September 23, 2010
*/

add_action('widgets_init', create_function('', 'return register_widget("FlexiAds");'));

class FlexiAds extends WP_Widget 
{

    function FlexiAds() 
    {
        $widget_options = array('description' => __('A simple widget for displaying ads without applying the default widget css styling.', 'flexithemes') );
        $control_options = array( 'width' => 430);
		$this->WP_Widget('flexi_ads', '&raquo; Flexi Ads', $widget_options,$control_options);
    }

    function widget($args, $instance)
    {
        extract( $args );
        ?>
        <ul class="wrap-widget"><li class="flexi-ads">
            <?php echo $instance['ad']; ?>
        </li></ul>
        <?php
    }

    function update($new_instance, $old_instance) 
    {				
    	$instance = $old_instance;
        $instance['ad'] = $new_instance['ad'];
        return $instance;
    }
    
    function form($instance) 
    {	
        ?>
            <p>
                <textarea class="widefat"  cols="20" rows="16" id="<?php echo $this->get_field_id('ad'); ?>" name="<?php echo $this->get_field_name('ad'); ?>"><?php echo $instance['ad']; ?></textarea>
            </p>
        <?php 
    }
} 
?>