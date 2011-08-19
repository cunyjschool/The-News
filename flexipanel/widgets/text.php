<?php
/**
 * Widget: Flexi Text
 * Author: FlexiThemes.com
 * Version: 2.0
 * Updated: September 23, 2010
*/

add_action('widgets_init', create_function('', 'return register_widget("FlexiText");'));

class FlexiText extends WP_Widget 
{

    function FlexiText() 
    {
        $widget_options = array('description' => __('A simple text widget without applying the default widget css styling. You may use any text or html code here.', 'flexithemes') );
        $control_options = array( 'width' => 430);
		$this->WP_Widget('flexi_text', '&raquo; Flexi Text', $widget_options, $control_options);
    }

    function widget($args, $instance)
    {
        extract( $args );
        ?>
        <ul class="wrap-widget"><li class="flexi-text">
            <?php echo $instance['text']; ?>
        </li></ul>
        <?php
    }

    function update($new_instance, $old_instance) 
    {				
    	$instance = $old_instance;
        $instance['text'] = $new_instance['text'];
        return $instance;
    }
    
    function form($instance) 
    {	
        ?>
            <p>
                <textarea class="widefat"  cols="20" rows="16" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $instance['text']; ?></textarea>
            </p>
        <?php 
    }
} 
?>