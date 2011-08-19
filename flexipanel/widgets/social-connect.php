<?php
/**
 * Widget: Flexi Social Connect
 * Author: FlexiThemes.com
 * Version: 2.0
 * Updated: September 23, 2010
*/

global $theme;

$flexi_social_connect_defaults = array(
    'rss' => 'true',
    'rss_title' => 'Subscribe to our RSS Feed',
    'rss_url' => $theme->rss_url(),
    'rss_image' => FLEXIPANEL_URL . '/images/social-connect-rss.png',
    'twitter' => 'true',
    'twitter_title' => 'Follow Us on Twitter',
    'twitter_url' => 'http://twitter.com/FlexiThemes',
    'twitter_image' => FLEXIPANEL_URL . '/images/social-connect-twitter.png',
    'facebook' => 'true',
    'facebook_title' => 'Be Our Fan on Facebook',
    'facebook_url' => 'http://facebook.com/FlexiThemes',
    'facebook_image' => FLEXIPANEL_URL . '/images/social-connect-facebook.png'
);

$theme->options['widgets_options']['social-connect'] = is_array($theme->options['widgets_options']['social-connect'])
    ? array_merge($flexi_social_connect_defaults, $theme->options['widgets_options']['social-connect'])
    : $flexi_social_connect_defaults;
        
add_action('widgets_init', create_function('', 'return register_widget("FlexiSocialConnect");'));

class FlexiSocialConnect extends WP_Widget 
{
    function FlexiSocialConnect() 
    {
        $widget_options = array('description' => __('Add links/buttons to your social network profiles.', 'flexithemes') );
        $control_options = array( 'width' => 400);
		$this->WP_Widget('flexi_social_connect', '&raquo; Flexi Social Connect', $widget_options, $control_options);
    }

    function widget($args, $instance)
    {
        extract( $args );
        
        if($instance['rss']) {
            ?>
            	<ul class="wrap-widget"><li class="flexi-social-connect">
                    <?php
                        if($instance['rss_image']) {
                            ?>
                                <a href="<?php echo strip_tags($instance['rss_url']); ?>" target="_blank"><img src="<?php echo strip_tags($instance['rss_image']); ?>" alt="<?php echo strip_tags($instance['rss_title']); ?>" title="<?php echo strip_tags($instance['rss_title']); ?>" /></a> 
                            <?php
                        }
                    ?>
                    <a href="<?php echo strip_tags($instance['rss_url']); ?>" target="_blank"><?php echo strip_tags($instance['rss_title']); ?></a>
                </li></ul>
            <?php
        }
        
        if($instance['twitter']) {
            ?>
                <ul class="wrap-widget"><li class="flexi-social-connect">
                    <?php
                        if($instance['twitter_image']) {
                            ?>
                                <a href="<?php echo strip_tags($instance['twitter_url']); ?>" target="_blank"><img src="<?php echo strip_tags($instance['twitter_image']); ?>" alt="<?php echo strip_tags($instance['twitter_title']); ?>" title="<?php echo strip_tags($instance['twitter_title']); ?>" /></a> 
                            <?php
                        }
                    ?>
                    <a href="<?php echo strip_tags($instance['twitter_url']); ?>" target="_blank"><?php echo strip_tags($instance['twitter_title']); ?></a>
                </li></ul>
            <?php
        }
        
        if($instance['facebook']) {
            ?>
                <ul class="wrap-widget"><li class="flexi-social-connect">
                    <?php
                        if($instance['facebook_image']) {
                            ?>
                                <a href="<?php echo strip_tags($instance['facebook_url']); ?>" target="_blank"><img src="<?php echo strip_tags($instance['facebook_image']); ?>" alt="<?php echo strip_tags($instance['facebook_title']); ?>" title="<?php echo strip_tags($instance['facebook_title']); ?>" /></a> 
                            <?php
                        }
                    ?>
                    <a href="<?php echo strip_tags($instance['facebook_url']); ?>" target="_blank"><?php echo strip_tags($instance['facebook_title']); ?></a>
                </li></ul>
            <?php
        }
        
        if($instance['custom']) {
            ?>
                <ul class="wrap-widget"><li class="flexi-social-connect">
                    <?php
                        if($instance['custom_image']) {
                            ?>
                                <a href="<?php echo strip_tags($instance['custom_url']); ?>" target="_blank"><img src="<?php echo strip_tags($instance['custom_image']); ?>" alt="<?php echo strip_tags($instance['custom_title']); ?>" title="<?php echo strip_tags($instance['custom_title']); ?>" /></a> 
                            <?php
                        }
                    ?>
                    <a href="<?php echo strip_tags($instance['custom_url']); ?>" target="_blank"><?php echo strip_tags($instance['custom_title']); ?></a>
                </li></ul>
            <?php
        }
    }

    function update($new_instance, $old_instance) 
    {				
    	$instance = $old_instance;
    	$instance['rss'] = strip_tags($new_instance['rss']);
        $instance['rss_title'] = strip_tags($new_instance['rss_title']);
        $instance['rss_url'] = strip_tags($new_instance['rss_url']);
        $instance['rss_image'] = strip_tags($new_instance['rss_image']);
        $instance['twitter'] = strip_tags($new_instance['twitter']);
        $instance['twitter_title'] = strip_tags($new_instance['twitter_title']);
        $instance['twitter_url'] = strip_tags($new_instance['twitter_url']);
        $instance['twitter_image'] = strip_tags($new_instance['twitter_image']);
        $instance['facebook'] = strip_tags($new_instance['facebook']);
        $instance['facebook_title'] = strip_tags($new_instance['facebook_title']);
        $instance['facebook_url'] = strip_tags($new_instance['facebook_url']);
        $instance['facebook_image'] = strip_tags($new_instance['facebook_image']);
        $instance['custom'] = strip_tags($new_instance['custom']);
        $instance['custom_title'] = strip_tags($new_instance['custom_title']);
        $instance['custom_url'] = strip_tags($new_instance['custom_url']);
        $instance['custom_image'] = strip_tags($new_instance['custom_image']);
        return $instance;
    }
    
    function form($instance) 
    {	
        global $theme;
		$instance = wp_parse_args( (array) $instance, $theme->options['widgets_options']['social-connect'] );
        
        ?>
        <div class="fp-widget">
            <div class="fp-widget-title">RSS Subscription</div>
            <table width="100%">
                <tr>
                    <td class="fp-widget-label" width="20%">Enabled?</td>
                    <td class="fp-widget-content" width="80%"><input type="checkbox" name="<?php echo $this->get_field_name('rss'); ?>" <?php checked('true', $instance['rss']); ?> value="true"  /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">Title</td>
                    <td class="fp-widget-content"><input type="text" class="widefat" name="<?php echo $this->get_field_name('rss_title'); ?>" value="<?php echo esc_attr($instance['rss_title']); ?>" /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">URL</td>
                    <td class="fp-widget-content"><input type="text" class="widefat" name="<?php echo $this->get_field_name('rss_url'); ?>" value="<?php echo esc_attr($instance['rss_url']); ?>" /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">Image</td>
                    <td class="fp-widget-content"><?php if($instance['rss_image']) {?><img src="<?php echo esc_attr($instance['rss_image']); ?>" /><?php }?> <input type="text" class="widefat" name="<?php echo $this->get_field_name('rss_image'); ?>" value="<?php echo esc_attr($instance['rss_image']); ?>" /></td>
                </tr>
            </table>
          </div>
          
          <div class="fp-widget">  
            <div class="fp-widget-title">Twitter</div>
            <table width="100%">
                <tr>
                    <td class="fp-widget-label" width="20%">Enabled?</td>
                    <td class="fp-widget-content" width="80%"><input type="checkbox" name="<?php echo $this->get_field_name('twitter'); ?>" <?php checked('true', $instance['twitter']); ?> value="true"  /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">Title</td>
                    <td class="fp-widget-content"><input type="text" class="widefat" name="<?php echo $this->get_field_name('twitter_title'); ?>" value="<?php echo esc_attr($instance['twitter_title']); ?>" /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">URL</td>
                    <td class="fp-widget-content"><input type="text" class="widefat" name="<?php echo $this->get_field_name('twitter_url'); ?>" value="<?php echo esc_attr($instance['twitter_url']); ?>" /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">Image</td>
                    <td class="fp-widget-content"><?php if($instance['twitter_image']) {?><img src="<?php echo esc_attr($instance['twitter_image']); ?>" /><?php }?> <input type="text" class="widefat" name="<?php echo $this->get_field_name('twitter_image'); ?>" value="<?php echo esc_attr($instance['twitter_image']); ?>" /></td>
                </tr>
            </table>
        </div>
        
        <div class="fp-widget">
            <div class="fp-widget-title">Facebook</div>
            <table width="100%">
                <tr>
                    <td class="fp-widget-label" width="20%">Enabled?</td>
                    <td class="fp-widget-content" width="80%"><input type="checkbox" name="<?php echo $this->get_field_name('facebook'); ?>" <?php checked('true', $instance['facebook']); ?> value="true"  /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">Title</td>
                    <td class="fp-widget-content"><input type="text" class="widefat" name="<?php echo $this->get_field_name('facebook_title'); ?>" value="<?php echo esc_attr($instance['facebook_title']); ?>" /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">URL</td>
                    <td class="fp-widget-content"><input type="text" class="widefat" name="<?php echo $this->get_field_name('facebook_url'); ?>" value="<?php echo esc_attr($instance['facebook_url']); ?>" /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">Image</td>
                    <td class="fp-widget-content"><?php if($instance['facebook_image']) {?><img src="<?php echo esc_attr($instance['facebook_image']); ?>" /><?php }?> <input type="text" class="widefat" name="<?php echo $this->get_field_name('facebook_image'); ?>" value="<?php echo esc_attr($instance['facebook_image']); ?>" /></td>
                </tr>
            </table>
        </div>
        
        <div class="fp-widget">
            <div class="fp-widget-title">Custom Network</div>
            <table width="100%">
                <tr>
                    <td class="fp-widget-label" width="20%">Enabled?</td>
                    <td class="fp-widget-content" width="80%"><input type="checkbox" name="<?php echo $this->get_field_name('custom'); ?>" <?php checked('true', $instance['custom']); ?> value="true"  /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">Title</td>
                    <td class="fp-widget-content"><input type="text" class="widefat" name="<?php echo $this->get_field_name('custom_title'); ?>" value="<?php echo esc_attr($instance['custom_title']); ?>" /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">URL</td>
                    <td class="fp-widget-content"><input type="text" class="widefat" name="<?php echo $this->get_field_name('custom_url'); ?>" value="<?php echo esc_attr($instance['custom_url']); ?>" /></td>
                </tr>
                
                <tr>
                    <td class="fp-widget-label">Image</td>
                    <td class="fp-widget-content"><?php if($instance['custom_image']) {?><img src="<?php echo esc_attr($instance['custom_image']); ?>" /><?php }?> <input type="text" class="widefat" name="<?php echo $this->get_field_name('custom_image'); ?>" value="<?php echo esc_attr($instance['custom_image']); ?>" /></td>
                </tr>
            </table>
        </div>
        <?php 
    }
} 
?>