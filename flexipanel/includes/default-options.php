<?php

    // Translation Options
    $translation = array(
        'enabled' => true,
        'dir' =>  TEMPLATEPATH . '/languages'
    );
    
    // General Options
    $general = array(
        'doctype' => '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        'profile_uri' => 'http://gmpg.org/xfn/11',
        'featured_image' => true,
        'custom_background' => true,
        'clean_exerpts' => true,
        'hide_wp_version' => true,
        'meta_rss' => true,
        'automatic_feed' => false,
        'pingback_url' => true,
        'jquery' => true,
        'css_reset' => true,
        'css_defaults' => true,
        'css_ie' => true,
        'css' => true
    );
    
    // Widgets
    $widgets = array(
        'ads' => 'Ads', 
        'banners-125' => '125x125 Banners', 
        'comments' => 'Comments', 
        'posts' => 'Posts', 
        'search' => 'Search', 
        'social-connect' => "Social Connect", 
        'social-share' => 'Social Share', 
        'tabs' => 'Tabs', 
        'text' => 'Tabs', 
        'tweets' => 'Tweets'
    );
    
    //Menus
     $menus = array(
        'menu-primary' => array(
            'active' => 'true',
            'hook' => 'header_before',
            'theme_location' => 'primary',
            'wrap_class' => 'wrap-menu-primary',
            'menu_class' => 'menus menu-primary',
            'superfish_class' => 'menu-primary',
            'fallback' => 'flexi_menu_primary_default',
            'depth' => '0',
            'effect' => 'fade',
            'speed' => '200',
            'delay' => '800',
            'arrows' => 'true',
            'shadows' => ''
        ), 
        
        'menu-secondary' => array(
            'active'=> 'true', 
            'hook' => 'header_after',
            'theme_location' => 'secondary',
            'wrap_class' => 'wrap-menu-secondary',
            'menu_class' => 'menus menu-secondary',
            'superfish_class' => 'menu-secondary',
            'fallback' => 'flexi_menu_secondary_default',
            'depth' => '0',
            'effect' => 'fade',
            'speed' => '200',
            'delay' => '800',
            'arrows' => 'true',
            'shadows' => ''
        )
    );
    
    // Post Elements
    $post_elements = array(
        'date' => 'Date',
        'author' => 'Author',
        'comments' => 'Comments number & link',
        'categories' => 'Categories list',
        'tags' => 'Tags list',
        'featured_image' => 'Featured Image',
        'readmore' => '"Read More" link/button',
        'edit_link' => 'Edit Link',
        'next_previous_links' => 'Links to next and previous posts'
    );

?>