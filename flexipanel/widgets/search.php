<?php
/**
 * Widget: Flexi Search
 * Author: FlexiThemes.com
 * Version: 2.0
 * Updated: September 23, 2010
*/

global $theme;
$flexi_search_defaults = array(
    'margin' => '0 0 0 0',
    'width' => '250'
);

$theme->options['widgets_options']['search'] = is_array($theme->options['widgets_options']['search'])
    ? array_merge($flexi_search_defaults, $theme->options['widgets_options']['search'])
    : $flexi_search_defaults;
    
add_action('widgets_init', create_function('', 'return register_widget("FlexiSearch");'));

class FlexiSearch extends WP_Widget 
{
    function FlexiSearch() 
    {
        $widget_options = array('description' => __('A simple and clean search form widget without default widget css styling.', 'flexithemes') );
        $control_options = array( 'width' => 340);
		$this->WP_Widget('flexi_search', '&raquo; Flexi Search', $widget_options,$control_options);
    }

    function widget($args, $instance)
    {
        extract( $args );
        $current_search_id = $this->get_field_id('width');
        
        if($instance['margin'] || $instance['width']) {
            ?>
            <style type="text/css">
                <!--
                <?php if($instance['margin']) {?>
                    #<?php echo $current_search_id; ?> {
                	   margin: <?php echo trim(esc_attr($instance['margin'])); ?>;
                    }<?php
                } 
                
                if($instance['width']) {?>
                    #<?php echo $current_search_id; ?> #s {
                	   width: <?php echo trim(esc_attr($instance['width'])); ?>px;
                    }<?php
                } 
                ?>
                -->
            </style>
            <?php
        }
        ?>
       <ul class="wrap-widget"><li id="<?php echo $current_search_id; ?>">
            <?php get_search_form(); ?>
        </li></ul>
     <?php
    }

    function update($new_instance, $old_instance) 
    {				
    	$instance = $old_instance;
        $instance['margin'] = strip_tags($new_instance['margin']);
        $instance['width'] = strip_tags($new_instance['width']);
        return $instance;
    }
    
    function form($instance) 
    {	
        global $theme;
		$instance = wp_parse_args( (array) $instance, $theme->options['widgets_options']['search'] );
        
        ?>
        <div class="fp-widget">
            <table width="100%">
                <tr>
                    <td class="fp-widget-label" width="40%"><label for="<?php echo $this->get_field_id('margin'); ?>">Search Form Margins:</label></td>
                    <td class="fp-widget-content" width="60%"><input style="width: 140px;" id="<?php echo $this->get_field_id('margin'); ?>" name="<?php echo $this->get_field_name('margin'); ?>" type="text" value="<?php echo esc_attr($instance['margin']); ?>" /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label"><label for="<?php echo $this->get_field_id('width'); ?>">Search Filed Width:</label></td>
                    <td class="fp-widget-content"><input style="width: 140px;" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr($instance['width']); ?>" /> px.</td>
                </tr>
                
            </table>
        </div>
        <?php 
    }
} 
?>