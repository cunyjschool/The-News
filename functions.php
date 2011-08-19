<?php
/**
 * Require, initiate and load the flexi theme framework
 */
 
    require_once TEMPLATEPATH . '/flexipanel/FlexiTheme.php';
    $theme = new FlexiTheme();
    $theme->theme_name = 'TheNews';
    
    // Options
    $theme->options['plugins'] = array('featuredposts', 'topsearch');
    $theme->options['widgets_options']['posts']= array('display_author' => false, 'display_content' => false, 'display_read_more' => false, 'featured_image_width' => 60, 'featured_image_height' => 40);
    $theme->options['widgets_options']['search']['width'] = '220';
    $theme->options['widgets_options']['social-connect'] = array('rss_image'=> get_bloginfo('template_url') . '/images/rss.png', 'twitter_image'=> get_bloginfo('template_url') . '/images/twitter.png', 'facebook_image'=> get_bloginfo('template_url') . '/images/facebook.png' );
    $theme->options['plugins_options']['featuredposts'] = array('speed'=> '400', 'effect' => 'scrollLeft');
    $theme->options['menus']['menu-primary']['effect'] = 'slide';
    $theme->options['menus']['menu-secondary']['shadows'] = 'true';
    
    if(is_admin()) {
        $theme->admin_options['Ads']['content']['General Ads']['content']['header_banner']['content']['value'] = '<a href="http://flexithemes.com" target="_blank"><img src="http://flexithemes.com/wp-content/examples/blank468.gif" alt="Premium Themes" title="Premium Themes" /></a>';
        $theme->admin_options['Layout Options']['content']['Homepage']['content']['homepage_post_elemnts']['content']['value'] = array('date', 'featured_image', 'readmore', 'tags', 'categories');
    }
    
    // Load the theme framework
    $theme->load();
    
/**
 * Register the sidebar widget areas
 */
    register_sidebar(array(
        'name' => __('Primary Sidebar', 'flexithemes'),
        'id' => 'sidebar_primary_thenews',
        'description' => __('The primary sidebar widget area', 'flexithemes'),
        'before_widget' => '<ul class="wrap-widget"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => __('Secondary Sidebar', 'flexithemes'),
        'id' => 'sidebar_secondary_thenews',
        'description' => __('The secondary sidebar widget area', 'flexithemes'),
        'before_widget' => '<ul class="wrap-widget"><li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li></ul>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
?>