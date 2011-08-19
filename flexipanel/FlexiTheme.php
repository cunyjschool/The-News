<?php
/**
 * FlexiTheme.php
 * FlexiPanel theme framework by FlexiThemes.com
*/

class FlexiTheme
{
    var $theme_name = false;
    var $options = array();
    var $admin_options = array();
    
    function FlexiTheme()
    {
        $this->_definitions();
        $this->_default_options();
    }
    
    /**
    * Initial Functions
    */
    
    function _definitions()
    {
        // Define FLEXIPANEL_DIR
        if(!defined('FLEXIPANEL_DIR')) {
            define('FLEXIPANEL_DIR', TEMPLATEPATH . '/flexipanel');
        }
        
        if(!defined('FLEXIPANEL_URL')) {
            define('FLEXIPANEL_URL',  get_bloginfo('template_directory') . '/flexipanel');
        }
        
        // Define FLEXIPANEL_PLUGINS_DIR
        if(!defined('FLEXIPANEL_PLUGINS_DIR')) {
            define('FLEXIPANEL_PLUGINS_DIR', TEMPLATEPATH . '/plugins');
        }
        
        if(!defined('FLEXIPANEL_PLUGINS_URL')) {
            define('FLEXIPANEL_PLUGINS_URL',  get_bloginfo('template_directory') . '/plugins');
        }
        
        // Define FLEXIPANEL_ADMIN_DIR
        if(!defined('FLEXIPANEL_ADMIN_DIR')) {
            define('FLEXIPANEL_ADMIN_DIR', FLEXIPANEL_DIR . '/admin');
        }
        
        if(!defined('FLEXIPANEL_ADMIN_URL')) {
            define('FLEXIPANEL_ADMIN_URL',  FLEXIPANEL_URL  . '/admin');
        }
    }
    
    function _default_options()
    {
        // Load Default Options
        require_once (FLEXIPANEL_DIR . '/includes/default-options.php');
        
        // Translation Options
        $this->options['translation'] = $translation;
        
        // General Options
        $this->options['general'] = $general;
        
        // Plugins
        $this->options['plugins'] = array();
        $this->options['plugins_options'] = array();
        
        // Widgets
        $this->options['widgets'] = $widgets;
        $this->options['widgets_options'] = array();
        
        //Menus
        $this->options['menus'] = $menus;
        
        // Post Elements
        $this->options['post_elements'] = $post_elements;
        
        // Load Default Admin Options
        if(is_admin()) {
            require_once (FLEXIPANEL_DIR . '/includes/default-admin-options.php');
        }
    }
    
    /**
    * Theme Functions
    */
    
    function option($name) 
    {
        echo $this->get_option($name);
    }
    
    function get_option($name) 
    {
        $return_option = '';
        if(isset($this->options['theme_options'][$name])) {
            if(is_array($this->options['theme_options'][$name])) {
                $return_option = $this->options['theme_options'][$name];
            } else {
                $return_option = stripslashes($this->options['theme_options'][$name]);
            }
        } 
        return $return_option;
    }
    
    function display($name, $array = false) 
    {
        if(!$array) {
            $option_enabled = strlen($this->get_option($name)) > 0 ? true : false;
            return $option_enabled;
        } else {
            $get_option = is_array($array) ? $array : $this->get_option($name);
            if(is_array($get_option)) {
                $option_enabled = in_array($name, $get_option) ? true : false;
                return $option_enabled;
            } else {
                return false;
            }
        }
    }
    
    function custom_css($source = false) 
    {
        if($source) {
            $this->options['custom_css'] = $this->options['custom_css'] . $source . "\n";
        }
        return;
    }
    
    function custom_js($source = false) 
    {
        if($source) {
            $this->options['custom_js'] = $this->options['custom_js'] . $source . "\n";
        }
        return;
    }
    
    function hook($tag, $arg = '')
    {
        do_action('flexithemes_' . $tag, $arg);
    }
    
    function add_hook($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        add_action( 'flexithemes_' . $tag, $function_to_add, $priority, $accepted_args );
    }
    
    function admin_option($menu, $submenu, $title, $name = false, $type = false, $value = '', $attributes = array())
    {
        if(is_admin()) {
            
            // Menu
            if(is_array($menu)) {
                $menu_title = isset($menu['0']) ? $menu['0'] : $menu;
                
                if($menu['1']) {
                    $this->admin_options[$menu_title]['icon'] = $menu['1'];
                }
                
                $menu_priority = isset($menu['2']) ? (int)$menu['2'] : false;
            } else {
                $menu_title = $menu;
                $menu_priority = false;
            }
            
            if(!isset($this->admin_options[$menu_title]['priority'])) {
                if(!$menu_priority) {
                    $this->options['admin_options_priorities']['priority'] += 10;
                    $menu_priority = $this->options['admin_options_priorities']['priority'];
                }
                $this->admin_options[$menu_title]['priority'] = $menu_priority;
            }
            
            
            // Submenu
            if(is_array($submenu)) {
                $submenu_title = isset($submenu['0']) ? $submenu['0'] : $submenu;
                
                if($submenu['1']) {
                    $this->admin_options[$menu_title]['content'][$submenu_title]['display'] = $submenu['1'];
                    if($submenu['1'] == 'link') {
                        $this->admin_options[$menu_title]['content'][$submenu_title]['link_title'] = $submenu_title;
                        $this->admin_options[$menu_title]['content'][$submenu_title]['link_url'] = $title;
                    }
                }
                
                $submenu_priority =  isset($submenu['2']) ? $submenu['2'] : false;
                
            } else {
                $submenu_title = $submenu;
                $submenu_priority = false;
            }
            
            if(!isset($this->admin_options[$menu_title]['content'][$submenu_title]['priority'])) {
                if(!$submenu_priority) {
                    $this->options['admin_options_priorities'][$menu_title]['priority'] += 10;
                    $submenu_priority = $this->options['admin_options_priorities'][$menu_title]['priority'];
                }
                $this->admin_options[$menu_title]['content'][$submenu_title]['priority'] = $submenu_priority;
            }
            
            // Elements
            
            if($name && $type) {
                $element_args['title'] = $title;
                $element_args['name'] = $name;
                $element_args['type'] = $type;
                $element_args['value'] = $value;

                $this->admin_options[$menu_title]['content'][$submenu_title]['content'][$element_args['name']]['content'] = $element_args + $attributes;
                
                if(!isset($this->admin_options[$menu_title]['content'][$submenu_title]['content'][$element_args['name']]['priority'])) {
                    $element_priority =  isset($attributes['priority']) ? $attributes['priority'] : false;
                    if(!$element_priority) {
                        $this->options['admin_options_priorities'][$menu_title][$submenu_title]['priority'] += 10;
                        $element_priority = $this->options['admin_options_priorities'][$menu_title][$submenu_title]['priority'];
                    }
                    $this->admin_options[$menu_title]['content'][$submenu_title]['content'][$element_args['name']]['priority'] = $element_priority;
                }
                
            }
        }
        return;
    }

    /**
    * Loading Functions
    */
        
    function load()
    {
        if(!$this->theme_name) {
            $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
            $this->theme_name = $theme_data['Name'];
        }
        
        $this->_load_translation();
        $this->_load_theme_options();
        $this->_load_widgets();
        $this->_load_plugins();
        $this->_load_menus();
        $this->_load_general_options();
        
        $this->hook('init');
        
        if(is_admin()) {
            include (FLEXIPANEL_ADMIN_DIR . '/FlexiPanel.php');
            new FlexiPanel();
        } 
    }
    
    function _load_translation()
    {
        if($this->options['translation']['enabled']) {
            load_theme_textdomain( 'flexithemes', $this->options['translation']['dir']);
        }
        return;
    }
    
    function _load_theme_options()
    {
        if(!isset($this->options['theme_options_field'])) {
            $this->options['theme_options_field'] = str_replace(' ', '_', strtolower( trim($this->theme_name) ) ) . '_theme_options';
        }
        
        $get_theme_options = get_option($this->options['theme_options_field']);
        $this->options['theme_options'] = $get_theme_options ? $get_theme_options : false; 
        return;
    }
    
    function _load_widgets()
    {
    	$widgets = $this->options['widgets'];
        foreach(array_keys($widgets) as $widget) {
            if(file_exists(FLEXIPANEL_DIR . '/widgets/' . $widget . '.php')) {
        	    include (FLEXIPANEL_DIR . '/widgets/' . $widget . '.php');
        	} elseif ( file_exists(FLEXIPANEL_DIR . '/widgets/' . $widget . '/' . $widget . '.php') ) {
        	   include (FLEXIPANEL_DIR . '/widgets/' . $widget . '/' . $widget . '.php');
        	}
        }
    }
    
    function _load_plugins()
    {
    	$plugins = $this->options['plugins'];
        foreach($plugins as $plugin) {
            if(file_exists(FLEXIPANEL_PLUGINS_DIR . '/' . $plugin . '.php')) {
        	    include (FLEXIPANEL_PLUGINS_DIR . '/' . $plugin . '.php');
        	} elseif ( file_exists(FLEXIPANEL_PLUGINS_DIR . '/' . $plugin . '/' . $plugin . '.php') ) {
        	   include (FLEXIPANEL_PLUGINS_DIR . '/' . $plugin . '/' . $plugin . '.php');
        	}
        }
    }
    
    function _load_menus()
    {
        foreach(array_keys($this->options['menus']) as $menu) {
            if(file_exists(TEMPLATEPATH . '/' . $menu . '.php')) {
        	    include (TEMPLATEPATH . '/' . $menu . '.php');
        	} elseif ( file_exists(FLEXIPANEL_DIR . '/includes/' . $menu . '.php') ) {
        	   include (FLEXIPANEL_DIR . '/includes/' . $menu . '.php');
        	} 
        }
    }
    
    function _load_general_options()
    {
        if($this->options['general']['jquery']) {
            wp_enqueue_script('jquery');
        }
    	
        if($this->options['general']['featured_image']) {
            add_theme_support( 'post-thumbnails' );
        }
        
        if($this->options['general']['custom_background']) {
            add_custom_background();
        } 
        
        if($this->options['general']['clean_exerpts']) {
            add_filter('excerpt_more', create_function('', 'return "";') );
        }
        
        if($this->options['general']['hide_wp_version']) {
            add_filter('the_generator', create_function('', 'return "";') );
        }
        
        $this->add_hook('meta', array(&$this, '_styles'));
        
        add_action('wp_head', array(&$this, '_head_elements'));

        if($this->options['general']['automatic_feed']) {
            add_theme_support('automatic-feed-links');
        }
        
        $this->_apply_custom_colors();
        
        if($this->display('custom_css') || $this->options['custom_css']) {
            $this->add_hook('head', array(&$this, '_load_custom_css'), 100);
        }
        
        if($this->options['custom_js']) {
            $this->add_hook('html_after', array(&$this, '_load_custom_js'), 100);
        }
        
        if($this->display('head_code')) {
	        $this->add_hook('head', array(&$this, '_head_code'), 100);
	    }
	    
	    if($this->display('footer_code')) {
	        $this->add_hook('html_after', array(&$this, '_footer_code'), 100);
	    }
    }
    
    function _styles()
    {
        if($this->options['general']['css_reset']) {
            echo '<link rel="stylesheet" href="' . FLEXIPANEL_URL .'/css/reset.css" type="text/css" media="screen" />' . "\n";
        }
        
        if($this->options['general']['css_defaults']) {
            echo '<link rel="stylesheet" href="' . FLEXIPANEL_URL .'/css/defaults.css" type="text/css" media="screen" />' . "\n";
        }
        
        if($this->options['general']['css_ie']) {
            echo '<!--[if lt IE 8]><link rel="stylesheet" href="' . FLEXIPANEL_URL .'/css/ie.css" type="text/css" media="screen" /><![endif]-->' . "\n";
        }
        
        if($this->options['general']['css']) {
            echo '<link rel="stylesheet" href="' . get_stylesheet_uri() .'" type="text/css" media="screen" />' . "\n";
        }
    }
    
    function _head_elements()
    {
    	// Favicon
    	if($this->display('favicon')) {
    		echo '<link rel="shortcut icon" href="' . $this->get_option('favicon') . '" type="image/x-icon" />' . "\n";
    	}
    	
    	// RSS Feed
    	if($this->options['general']['meta_rss']) {
            echo '<link rel="alternate" type="application/rss+xml" title="' . get_bloginfo('name') . ' RSS Feed" href="' . $this->rss_url() . '" />' . "\n";
        }
        
        // Pingback URL
        if($this->options['general']['pingback_url']) {
            echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '" />' . "\n";
        }
    }
    
    function _apply_custom_colors()
    {
        require_once (FLEXIPANEL_DIR . '/includes/custom-colors.php');
        
        if($custom_colors) {
            $apply_custom_colors = "/* Custom Colors */\n\n";
            $apply_custom_colors .= $custom_colors;
            $apply_custom_colors .= "/* End Custom Colors */";
            $this->custom_css($apply_custom_colors);
        }
    }
    
    function _load_custom_css()
    {
        $this->custom_css($this->get_option('custom_css'));
        $return = "\n";
        $return .= '<style type="text/css">' . "\n";
        $return .= '<!--' . "\n";
        $return .= $this->options['custom_css'];
        $return .= '-->' . "\n";
        $return .= '</style>' . "\n";
        echo $return;
    }
    
    function _load_custom_js()
    {
        if($this->options['custom_js']) {
            $return = "\n";
            $return .= "<script type='text/javascript'>\n";
            $return .= '/* <![CDATA[ */' . "\n";
            $return .= 'jQuery.noConflict();' . "\n";
            $return .= $this->options['custom_js'];
            $return .= '/* ]]> */' . "\n";
            $return .= '</script>' . "\n";
            echo $return;
        }
    }
    
    function _head_code()
    {
        $this->option('head_code'); echo "\n";
    }
    
    function _footer_code()
    {
        $this->option('footer_code');  echo "\n";
    }
    
    /**
    * General Functions
    */
    
    function request ($var)
    {
        if (strlen($_REQUEST[$var]) > 0) {
            return preg_replace('/[^A-Za-z0-9-_]/', '', $_REQUEST[$var]);
        } else {
            return false;
        }
    }
    
    function meta_title()
    {
        if ( is_single() ) { 
			single_post_title(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) {
			bloginfo( 'name' );
			if( get_bloginfo( 'description' ) ) {
		      echo ' | ' ; bloginfo( 'description' ); $this->page_number();
			}
		} elseif ( is_page() ) {
			single_post_title( '' ); echo ' | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			printf( __( 'Search results for %s', 'flexithemes' ), '"'.get_search_query().'"' );  $this->page_number(); echo ' | '; bloginfo( 'name' );
		} elseif ( is_404() ) { 
			_e( 'Not Found', 'flexithemes' ); echo ' | '; bloginfo( 'name' );
		} else { 
			wp_title( '' ); echo ' | '; bloginfo( 'name' ); $this->page_number();
		}
    }
    
    function rss_url()
    {
        $the_rss_url = $this->display('rss_url') ? $this->get_option('rss_url') : get_bloginfo('rss2_url');
        return $the_rss_url;
    }
    
    function doctype()
    {
        echo $this->options['general']['doctype'];
    }
    
    function profile_uri()
    {
        echo $this->options['general']['profile_uri'];
    }
    
    function get_pages_array($query = '', $pages_array = array())
    {
    	$pages = get_pages($query); 
        
    	foreach ($pages as $page) {
    		$pages_array[$page->ID] = $page->post_title;
    	  }
    	return $pages_array;
    }
    
    function get_page_name($page_id)
    {
    	global $wpdb;
    	$page_name = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE ID = '".$page_id."' && post_type = 'page'");
    	return $page_name;
    }
    
    function get_page_id($page_name){
        global $wpdb;
        $the_page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $page_name . "' && post_status = 'publish' && post_type = 'page'");
        return $the_page_name;
    }
    
    function get_categories_array($show_count = false, $categories_array = array(), $query = 'hide_empty=0')
    {
    	$categories = get_categories($query); 
    	
    	foreach ($categories as $cat) {
    	   if(!$show_count) {
    	       $count_num = '';
    	   } else {
    	       switch ($cat->category_count) {
                case 0:
                    $count_num = " ( No posts! )";
                    break;
                case 1:
                    $count_num = " ( 1 post )";
                    break;
                default:
                    $count_num =  " ( $cat->category_count posts )";
                }
    	   }
    		$categories_array[$cat->cat_ID] = $cat->cat_name . $count_num;
    	  }
    	return $categories_array;
    }

    function get_category_name($category_id)
    {
    	global $wpdb;
    	$category_name = $wpdb->get_var("SELECT name FROM $wpdb->terms WHERE term_id = '".$category_id."'");
    	return $category_name;
    }
    
    
    function get_category_id($category_name)
    {
    	global $wpdb;
    	$category_id = $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE name = '" . addslashes($category_name) . "'");
    	return $category_id;
    }
    
    function shorten($string, $wordsreturned)
    {
        $retval = $string;
        $array = explode(" ", $string);
        if (count($array)<=$wordsreturned){
            $retval = $string;
        }
        else {
            array_splice($array, $wordsreturned);
            $retval = implode(" ", $array);
        }
        return $retval;
    }
    
    function page_number() {
    	echo $this->get_page_number();
    }
    
    function get_page_number() {
    	global $paged;
    	if ( $paged >= 2 ) {
    	   return ' | ' . sprintf( __( 'Page %s', 'flexithemes' ), $paged );
    	}
    }
}
?>