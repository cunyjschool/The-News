<?php

    $custom_colors = '';
    
    // Text Colors
    if($this->display('default_text_color')) {
        $custom_colors .= "body { color: #" . $this->get_option('default_text_color') ."; }\n";
        $custom_colors .= "h1,h2,h3,h4,h5,h6 { color: #" . $this->get_option('default_text_color') ."; }\n";
    }
    
    if($this->display('post_title_color')) {
        $custom_colors .= ".title { color: #" . $this->get_option('post_title_color') ."; }\n";
    }
    
    if($this->display('post_body_color')) {
        $custom_colors .= ".entry { color: #" . $this->get_option('post_body_color') ."; }\n";
    }
    
    if($this->display('post_meta_primary_color')) {
        $custom_colors .= ".postmeta-primary { color: #" . $this->get_option('post_meta_primary_color') ."; }\n";
    }
    
    if($this->display('post_meta_secondary_color')) {
        $custom_colors .= ".postmeta-secondary { color: #" . $this->get_option('post_meta_secondary_color') ."; }\n";
    }
    
    if($this->display('sidebar_text_color')) {
        $custom_colors .= ".sidebar { color: #" . $this->get_option('sidebar_text_color') ."; }\n";
    }
    
    if($this->display('widget_title_text_color')) {
        $custom_colors .= "h3.widget-title, h3.widget-title a, h3.widget-title a:hover { color: #" . $this->get_option('widget_title_text_color') ."; }\n";
    }
    
    if($this->display('footer_copyright_text_color')) {
        $custom_colors .= "#copyrights { color: #" . $this->get_option('footer_copyright_text_color') ."; }\n";
    }
    
    if($this->display('footer_credits_text_color')) {
        $custom_colors .= "#credits { color: #" . $this->get_option('footer_credits_text_color') ."; }\n";
    }
    
    // Links Colors
    if($this->display('main_links_color')) {
        $custom_colors .= "a { color: #" . $this->get_option('main_links_color') ."; }\n";
    }
    
    if($this->display('main_links_hover_color')) {
        $custom_colors .= "a:hover { color: #" . $this->get_option('main_links_hover_color') ."; }\n";
    }
    
    if($this->display('site_title_link_color')) {
        $custom_colors .= "#site-title a { color: #" . $this->get_option('site_title_link_color') ."; }\n";
    }
    
    if($this->display('site_title_link_color_hover')) {
        $custom_colors .= "#site-title a:hover { color: #" . $this->get_option('site_title_link_color_hover') ."; }\n";
    }
    
    if($this->display('post_title_link')) {
        $custom_colors .= ".title a { color: #" . $this->get_option('post_title_link') ."; }\n";
    }
    
    if($this->display('post_title_link_hover')) {
        $custom_colors .= ".title a:hover { color: #" . $this->get_option('post_title_link_hover') ."; }\n";
    }
    
    if($this->display('readmore_link')) {
        $custom_colors .= "a.readmore { color: #" . $this->get_option('readmore_link') ."; }\n";
    }
    
    if($this->display('readmore_link_hover')) {
        $custom_colors .= "a.readmore:hover { color: #" . $this->get_option('readmore_link_hover') ."; }\n";
    }
    
    if($this->display('widget_links')) {
        $custom_colors .= ".widget a { color: #" . $this->get_option('widget_links') ."; }\n";
    }
    
    if($this->display('widget_links_hover')) {
        $custom_colors .= ".widget a:hover { color: #" . $this->get_option('widget_links_hover') ."; }\n";
    }
    
    if($this->display('footer_copyrights_links')) {
        $custom_colors .= "#copyrights a { color: #" . $this->get_option('footer_copyrights_links') ."; }\n";
    }
    
    if($this->display('footer_copyrights_links_hover')) {
        $custom_colors .= "#copyrights a:hover { color: #" . $this->get_option('footer_copyrights_links_hover') ."; }\n";
    }
    
    if($this->display('footer_credits_links')) {
        $custom_colors .= "#credits a { color: #" . $this->get_option('footer_credits_links') ."; }\n";
    }
    
    if($this->display('footer_credits_links_hover')) {
        $custom_colors .= "#credits a:hover { color: #" . $this->get_option('footer_credits_links_hover') ."; }\n";
    }
    
    // Layout Backgrounds
    if($this->display('body_background_color')) {
        $custom_colors .= "body { background-color: #" . $this->get_option('body_background_color') ."; }\n";
    }
    
    if($this->display('wrapper_background_color')) {
        $custom_colors .= "#wrapper { background-color: #" . $this->get_option('wrapper_background_color') ."; }\n";
    }
    
    if($this->display('header_background_color')) {
        $custom_colors .= "#header { background-color: #" . $this->get_option('header_background_color') ."; }\n";
    }
    
    if($this->display('main_content_background_color')) {
        $custom_colors .= "#main { background-color: #" . $this->get_option('main_content_background_color') ."; }\n";
    }
    
    if($this->display('sidebar_background_color')) {
        $custom_colors .= ".sidebar { background-color: #" . $this->get_option('sidebar_background_color') ."; }\n";
    }
    
    if($this->display('footer_background_color')) {
        $custom_colors .= "#footer { background-color: #" . $this->get_option('footer_background_color') ."; }\n";
    }
    
    if($this->display('posts_background_color')) {
        $custom_colors .= ".wrap-post { background-color: #" . $this->get_option('posts_background_color') ."; }\n";
    }
    
    if($this->display('thumbnails_background_color')) {
        $custom_colors .= ".post_thumbnail { background-color: #" . $this->get_option('thumbnails_background_color') ."; }\n";
    }
    
    if($this->display('thumbnails_border_color')) {
        $custom_colors .= ".post_thumbnail { border-color: #" . $this->get_option('thumbnails_border_color') .";\n}\n";
    }
?>