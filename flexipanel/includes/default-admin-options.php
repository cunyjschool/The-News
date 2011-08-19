<?php
/**
 * Setting the default admin theme options and menus
*/

    /*********************************************
     * General Options
     *********************************************
    */

        // General Settings
        $this->admin_option(array('General Options', FLEXIPANEL_ADMIN_URL . '/images/icon-general.png'), 'General Options', 
            'Logo Image', 'logo', 
            'imageupload', get_bloginfo('template_directory') . "/images/logo.png", 
            array('help' => "Enter the full url to your logo image. Leave it blank if you don't want to use a logo image.")
        );
        
        $this->admin_option('General Options', 'General Options', 
            'Favicon', 'favicon', 
            'imageupload', get_bloginfo('template_directory') . "/images/favicon.png", 
            array('help' => "Enter the full url to your favicon file. Leave it blank if you don't want to use a favicon.")
        );
        
        $this->admin_option('General Options', 'General Options', 
            'Posts Date Format', 'dateformat', 
            'text', 'F d, Y', 
            array('help' => 'Please, check <a href="http://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">this reference</a> for more details.', 'display'=>'extended')
        );
        
        // Integration
        $this->admin_option('General Options', 'Integration', 
            'RSS Feed URL', 'rss_url', 
            'text', '', 
            array('help' => 'Enter your custom RSS Feed URL, Feedburner or other.')
        );
        
        $this->admin_option('General Options', 'Integration', 
            'Custom CSS', 'custom_css', 
            'textarea', '', 
            array('help' => 'Any code you add here will appear in the head section of every page of your site. Add only the css code without &lt;style&gt;&lt;/style&gt; style blocks. They are auto added.', 'style'=>'height: 180px;')
        );
        
        $this->admin_option('General Options', 'Integration', 
            'Head Code', 'head_code', 
            'textarea', '', 
            array('help' => 'Any code you add here will appear in the head section, just before &lt;/head&gt; of every page of your site.', 'style'=>'height: 180px;')
        );
        
        $this->admin_option('General Options', 'Integration', 
            'Footer Code', 'footer_code', 
            'textarea', '', 
            array('help' => 'Any code you add here will appear just before &lt;/body&gt; tag of every page of your site.', 'style'=>'height: 180px;')
        );
    
    
    /*********************************************
     * Layout Options
     *********************************************
    */

        // Homepage
        $this->admin_option(array('Layout Options', FLEXIPANEL_ADMIN_URL . '/images/icon-layout.png'), 'Homepage', 
            'Posts per page', 'homepage_posts_per_page', 
            'text', 0, 
            array('help' => 'Posts per page displayed in homepage. If <strong>0</strong> the WordPress default is used.', 'display' => 'extended-top', 'style'=>'width: 80px;')
        );
        
        $homepage_post_elements = $this->options['post_elements'];
        unset($homepage_post_elements['next_previous_links']);
        $this->admin_option('Layout Options','Homepage', 
            'Post Elements', 'homepage_post_elemnts', 
            'checkboxes', array('date', 'author', 'comments', 'featured_image', 'readmore', 'tags', 'categories'), 
            array('options'=>$homepage_post_elements, 'help' => 'Choose which elements to display within homepage posts.', 'display'=>'extended-top')
        );
        
        $this->admin_option('Layout Options','Homepage', 
            'Featured Image Options', 'homepage_featured_image_settings', 
            'content', 'The featured image should be enabled first from the <strong>post elements</strong> options above.'
        );
        
        $this->admin_option('Layout Options','Homepage', 
            'Image Width', 'homepage_featured_image_width', 
            'text', '200', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Homepage', 
            'Image Height', 'homepage_featured_image_height', 
            'text', '160', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Homepage', 
            'Image Position', 'homepage_featured_image_position', 
            'radio', 'alignleft', 
            array('options'=>array('alignleft' => 'Left', 'alignright'=> 'Right', 'aligncenter'=>'Center') , 'display'=>'inline')
        );
            
        
        $this->admin_option('Layout Options','Homepage', 
            'Post Content Display', 'homepage_content_display', 
            'radio', 'full', 
            array('options'=>array('full' => 'Full Content', 'excerpts'=> 'Excerpts'))
        );
        
        $this->admin_option('Layout Options','Homepage', 
            'Excerpts Length', 'homepage_excerpts_length', 
            'text', '40', 
            array('help'=> 'If "Excerpts" is selected from the <strong>Post Content Display</strong> options above', 'display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' words')
        );
        
        $this->admin_option('Layout Options','Homepage', 
            '"Read More" Text', 'homepage_read_more', 
            'text', 'Read More', 
            array('display'=>'inline')
        );
        
        $this->admin_option('Layout Options','Homepage', 
            'Exclude Posts From Categories', 'homepage_exclude_categories', 
            'checkboxes', '', 
            array('help'=>'The posts from the cheked categories will not be displayed in homepage.', 'options'=>$this->get_categories_array(), 'display'=>'extended-top')
        );
        
        // Single Post
        $singlepost_post_meta_elements = $this->options['post_elements'];
        unset($singlepost_post_meta_elements['readmore']);
        $this->admin_option('Layout Options', 'Single Post', 
            'Post Elements', 'singlepost_post_elemnts', 
            'checkboxes', array('date', 'author', 'comments', 'featured_image', 'tags', 'categories'), 
            array('options'=>$singlepost_post_meta_elements, 'help' => 'Choose which elements to display within single post.', 'display'=>'extended-top')
        );
        
        $this->admin_option('Layout Options','Single Post', 
            'Comments Enabled?', 'singlepost_comments', 
            'checkbox', 'true', 
            array('help' => '<b>Note:</b> Comments can also be enabled or disabled from <a href="options-discussion.php">Discussion Settings</a> or per post basis when creating new posts in your dashboard.', 'display' => 'extended')
        );
        
        $this->admin_option('Layout Options','Single Post', 
            'Featured Image Options', 'singlepost_featured_image_settings', 
            'content', 'The featured image should be enabled first from the <strong>post elements</strong> options above.'
        );
        
        $this->admin_option('Layout Options','Single Post', 
            'Image Width', 'singlepost_featured_image_width', 
            'text', '300', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Single Post', 
            'Image Height', 'singlepost_featured_image_height', 
            'text', '225', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Single Post', 
            'Image Position', 'singlepost_featured_image_position', 
            'radio', 'alignleft', 
            array('options'=>array('alignleft' => 'Left', 'alignright'=> 'Right', 'aligncenter'=>'Center') , 'display'=>'inline')
        );
        
        // Pages
        $pages_post_meta_elements = $this->options['post_elements'];
        unset($pages_post_meta_elements['date']);
        unset($pages_post_meta_elements['author']);
        unset($pages_post_meta_elements['comments']);
        unset($pages_post_meta_elements['tags']);
        unset($pages_post_meta_elements['categories']);
        unset($pages_post_meta_elements['readmore']);
        unset($pages_post_meta_elements['next_previous_links']);
        $this->admin_option('Layout Options', 'Pages', 
            'Post Elements', 'pages_post_elemnts', 
            'checkboxes', array('featured_image'), 
            array('options'=>$pages_post_meta_elements, 'help' => 'Choose which elements to display within pages.', 'display'=>'extended-top')
        );
        
        $this->admin_option('Layout Options','Pages', 
            'Comments Enabled?', 'pages_comments', 
            'checkbox', 'true', 
            array('help' => '<b>Note:</b> Comments can also be enabled or disabled from <a href="options-discussion.php">Discussion Settings</a> or per page basis when creating new page in your dashboard.', 'display' => 'extended')
        );
        
         $this->admin_option('Layout Options','Pages', 
            'Featured Image Options', 'pages_featured_image_settings', 
            'content', 'The featured image should be enabled first from the <strong>post elements</strong> options above.'
        );
        
        $this->admin_option('Layout Options','Pages', 
            'Image Width', 'pages_featured_image_width', 
            'text', '300', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Pages', 
            'Image Height', 'pages_featured_image_height', 
            'text', '225', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Pages', 
            'Image Position', 'pages_featured_image_position', 
            'radio', 'alignleft', 
            array('options'=>array('alignleft' => 'Left', 'alignright'=> 'Right', 'aligncenter'=>'Center') , 'display'=>'inline')
        );
        
        // Category Pages
        $categories_post_elements = $this->options['post_elements'];
        unset($categories_post_elements['next_previous_links']);
        $this->admin_option('Layout Options', 'Category Pages', 
            'Post Elements', 'categories_post_elemnts', 
            'checkboxes', array('date', 'author', 'comments', 'featured_image', 'tags', 'categories', 'readmore'), 
            array('options'=>$categories_post_elements, 'help' => 'Choose which elements to display within posts.', 'display'=>'extended-top')
        );
        
        $this->admin_option('Layout Options','Category Pages', 
            'Featured Image Options', 'categories_featured_image_settings', 
            'content', 'The featured image should be enabled first from the <strong>post elements</strong> options above.'
        );
        
        $this->admin_option('Layout Options','Category Pages', 
            'Image Width', 'categories_featured_image_width', 
            'text', '200', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Category Pages', 
            'Image Height', 'categories_featured_image_height', 
            'text', '160', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Category Pages', 
            'Image Position', 'categories_featured_image_position', 
            'radio', 'alignleft', 
            array('options'=>array('alignleft' => 'Left', 'alignright'=> 'Right', 'aligncenter'=>'Center') , 'display'=>'inline')
        );
        
        $this->admin_option('Layout Options','Category Pages', 
            'Post Content Display', 'categories_content_display', 
            'radio', 'excerpts', 
            array('options'=>array('full' => 'Full Content', 'excerpts'=> 'Excerpts'))
        );
        
        $this->admin_option('Layout Options','Category Pages', 
            'Excerpts Length', 'categories_excerpts_length', 
            'text', '40', 
            array('help'=> 'If "Excerpts" is selected from the <strong>Post Content Display</strong> options above', 'display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' words')
        );
        
        $this->admin_option('Layout Options','Category Pages', 
            '"Read More" Text', 'categories_read_more', 
            'text', 'Read More', 
            array('display'=>'inline')
        );
        
        // Tag Pages
        $tags_post_elements = $this->options['post_elements'];
        unset($tags_post_elements['next_previous_links']);
        $this->admin_option('Layout Options', 'Tag Pages',
            'Post Elements', 'tags_post_elemnts', 
            'checkboxes', array('date', 'author', 'comments', 'featured_image', 'tags', 'categories', 'readmore'), 
            array('options'=>$tags_post_elements, 'help' => 'Choose which elements to display within posts.', 'display'=>'extended-top')
        );
        
        $this->admin_option('Layout Options','Tag Pages', 
            'Featured Image Options', 'tags_featured_image_settings', 
            'content', 'The featured image should be enabled first from the <strong>post elements</strong> options above.'
        );
        
        $this->admin_option('Layout Options','Tag Pages', 
            'Image Width', 'tags_featured_image_width', 
            'text', '200', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Tag Pages', 
            'Image Height', 'tags_featured_image_height', 
            'text', '160', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Tag Pages', 
            'Image Position', 'tags_featured_image_position', 
            'radio', 'alignleft', 
            array('options'=>array('alignleft' => 'Left', 'alignright'=> 'Right', 'aligncenter'=>'Center') , 'display'=>'inline')
        );
        
        $this->admin_option('Layout Options','Tag Pages', 
            'Post Content Display', 'tags_content_display', 
            'radio', 'excerpts', 
            array('options'=>array('full' => 'Full Content', 'excerpts'=> 'Excerpts'))
        );
        
        $this->admin_option('Layout Options','Tag Pages', 
            'Excerpts Length', 'tags_excerpts_length', 
            'text', '40', 
            array('help'=> 'If "Excerpts" is selected from the <strong>Post Content Display</strong> options above', 'display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' words')
        );
        
        $this->admin_option('Layout Options','Tag Pages', 
            '"Read More" Text', 'tags_read_more', 
            'text', 'Read More', 
            array('display'=>'inline')
        );
        
        // Archive Pages
        $archives_post_elements = $this->options['post_elements'];
        unset($archives_post_elements['next_previous_links']);
        $this->admin_option('Layout Options', 'Archive Pages', 
            'Post Elements', 'archives_post_elemnts', 
            'checkboxes', array('date', 'author', 'comments', 'featured_image', 'tags', 'categories', 'readmore'), 
            array('options'=>$archives_post_elements, 'help' => 'Choose which elements to display within posts.', 'display'=>'extended-top')
        );
        
        $this->admin_option('Layout Options','Archive Pages', 
            'Featured Image Options', 'archives_featured_image_settings', 
            'content', 'The featured image should be enabled first from the <strong>post elements</strong> options above.'
        );
        
        $this->admin_option('Layout Options','Archive Pages', 
            'Image Width', 'archives_featured_image_width', 
            'text', '200', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Archive Pages', 
            'Image Height', 'archives_featured_image_height', 
            'text', '160', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Archive Pages', 
            'Image Position', 'archives_featured_image_position', 
            'radio', 'alignleft', 
            array('options'=>array('alignleft' => 'Left', 'alignright'=> 'Right', 'aligncenter'=>'Center') , 'display'=>'inline')
        );
        
        $this->admin_option('Layout Options','Archive Pages', 
            'Post Content Display', 'archives_content_display', 
            'radio', 'excerpts', 
            array('options'=>array('full' => 'Full Content', 'excerpts'=> 'Excerpts'))
        );
        
        $this->admin_option('Layout Options','Archive Pages', 
            'Excerpts Length', 'archives_excerpts_length', 
            'text', '40', 
            array('help'=> 'If "Excerpts" is selected from the <strong>Post Content Display</strong> options above', 'display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' words')
        );
        
        $this->admin_option('Layout Options','Archive Pages', 
            '"Read More" Text', 'archives_read_more', 
            'text', 'Read More', 
            array('display'=>'inline')
        );
        
        // Search Results Page
        $search_post_elements = $this->options['post_elements'];
        unset($search_post_elements['next_previous_links']);
        $this->admin_option('Layout Options', 'Search Results Page', 
            'Post Elements', 'search_post_elemnts', 
            'checkboxes', array('date', 'author', 'comments', 'featured_image', 'readmore'), 
            array('options'=>$search_post_elements, 'help' => 'Choose which elements to display within posts.', 'display'=>'extended-top')
        );
        
        $this->admin_option('Layout Options','Search Results Page', 
            'Featured Image Options', 'search_featured_image_settings', 
            'content', 'The featured image should be enabled first from the <strong>post elements</strong> options above.'
        );
        
        $this->admin_option('Layout Options','Search Results Page', 
            'Image Width', 'search_featured_image_width', 
            'text', '200', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Search Results Page', 
            'Image Height', 'search_featured_image_height', 
            'text', '160', 
            array('display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' px.')
        );
        
        $this->admin_option('Layout Options','Search Results Page', 
            'Image Position', 'search_featured_image_position', 
            'radio', 'alignleft', 
            array('options'=>array('alignleft' => 'Left', 'alignright'=> 'Right', 'aligncenter'=>'Center') , 'display'=>'inline')
        );
        
        $this->admin_option('Layout Options','Search Results Page', 
            'Post Content Display', 'search_content_display', 
            'radio', 'excerpts', 
            array('options'=>array('full' => 'Full Content', 'excerpts'=> 'Excerpts'))
        );
        
        $this->admin_option('Layout Options','Search Results Page', 
            'Excerpts Length', 'search_excerpts_length', 
            'text', '40', 
            array('help'=> 'If "Excerpts" is selected from the <strong>Post Content Display</strong> options above', 'display'=>'inline', 'style'=>'width: 100px;', 'suffix'=>' words')
        );
        
        $this->admin_option('Layout Options','Search Results Page', 
            '"Read More" Text', 'search_read_more', 
            'text', 'Read More', 
            array('display'=>'inline')
        );
        
        // Footer
        $this->admin_option('Layout Options', 'Footer', 
            'Custom Footer Text', 'footer_custom_text', 
            'textarea', '', 
            array('help' => 'Add your custom footer text. Will override the default theme generated text.', 'display'=>'extended-top', 'style'=>'height: 140px;')
        );
        
        $this->admin_option('Layout Options', 'Footer', 
            'FlexiThemes Credits', 'footer_credits', 
            'checkbox', 'true', 
            array('help' => 'Show backlink credits to FlexiThemes.com', 'display'=>'extended')
        );
        
        $this->admin_option('Layout Options', 'Footer', 
            'FlexiThemes Affiliate Program', 'footer_affiliate_id', 
            'text', '', 
            array('help' => 'Enter your FlexiThemes affiliate ID and it will be added automaticaly to your footer credit links. <br />Get your affiliate ID <a href="http://flexithemes.com/wp-admin/admin.php?page=FlexiAffiliates" target="_blank">from here</a>.', 'display'=>'extended')
        );
       
       $this->admin_option('Layout Options', 'Footer', 
            'WordPress Credits', 'wordpress_credits', 
            'checkbox', 'true', 
            array('help' => 'Show the "Powered by WordPress" link')
        );
  
        
    /*********************************************
     * Colors
     *********************************************
    */
    
        // Text Colors
        $this->admin_option(array('Colors', FLEXIPANEL_ADMIN_URL . '/images/icon-colors.png'), 'Text Colors', 
            'Text Colors', 'layout_colors_info', 
            'content', ''
        );
        
        $this->admin_option('Colors', 'Text Colors', 
            'Default Text Color', 'default_text_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Text Colors', 
            'Post Title', 'post_title_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Text Colors', 
            'Post Body', 'post_body_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Text Colors', 
            'Post Meta Primary', 'post_meta_primary_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Text Colors', 
            'Post Meta Secondary', 'post_meta_secondary_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Text Colors', 
            'Sidebar', 'sidebar_text_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Text Colors', 
            'Widget Title', 'widget_title_text_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Text Colors', 
            'Footer Copyrights', 'footer_copyright_text_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Text Colors', 
            'Footer Credits', 'footer_credits_text_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        // Link Colors
        $this->admin_option('Colors', 'Link Colors', 
            'Main Links', 'main_links_info', 
            'content', ''
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Main Links', 'main_links_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
         $this->admin_option('Colors', 'Link Colors', 
            'Main Links Hover', 'main_links_hover_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Site Title', 'site_title_color_info', 
            'content', '', 
            array('help'=>'If no logo image is used', 'display'=>'extended-top')
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Site Title', 'site_title_link_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
         $this->admin_option('Colors', 'Link Colors', 
            'Site Title Hover', 'site_title_link_color_hover', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Post Title', 'post_title_link_info', 
            'content', ''
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Post Title', 'post_title_link', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
         $this->admin_option('Colors', 'Link Colors', 
            'Post Title Hover', 'post_title_link_hover', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Read More', 'read_more_link_info', 
            'content', ''
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Read More', 'readmore_link', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
         $this->admin_option('Colors', 'Link Colors', 
            'Read More Hover', 'readmore_link_hover', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Widget Links', 'widget_links_info', 
            'content', ''
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Widget Links', 'widget_links', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
         $this->admin_option('Colors', 'Link Colors', 
            'Widget Links Hover', 'widget_links_hover', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Footer', 'footer_color_info', 
            'content', ''
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Footer Copyrights', 'footer_copyrights_links', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
         $this->admin_option('Colors', 'Link Colors', 
            'Footer Copyrights Hover', 'footer_copyrights_links_hover', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Link Colors', 
            'Footer Credits', 'footer_credits_links', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
         $this->admin_option('Colors', 'Link Colors', 
            'Footer Credits Hover', 'footer_credits_links_hover', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        
        // Layout Backgrounds
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Layout Colors', 'layout_colors_info', 
            'content', ''
        );
        
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Body Background', 'body_background_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Wapper Background', 'wrapper_background_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Header Background', 'header_background_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Main/Content Area Background', 'main_content_background_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Sidebar Background', 'sidebar_background_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Footer Background', 'footer_background_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Posts Background', 'posts_background_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Thumbnails Background', 'thumbnails_background_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
        
        $this->admin_option('Colors', 'Layout Backgrounds', 
            'Thumbnails Border', 'thumbnails_border_color', 
            'colorpicker', '', 
            array('display' => 'inline')
        );
    
   /*********************************************
     * Ads
     *********************************************
    */

    // Header Banner
    $this->admin_option(array('Ads', FLEXIPANEL_ADMIN_URL . '/images/icon-a.png'), 'General Ads', 
        'Header Banner', 'header_banner', 
        'textarea', '<a href="http://flexithemes.com" target="_blank"><img src="http://flexithemes.com/wp-content/examples/flexi468.gif" alt="Premium Themes" title="Premium Themes" /></a>', 
        array('help' => 'Enter your 468x60 px. ad code. You may use any html code here, including your 468x60 px Adsense code.', 'style'=>'height: 120px;')
    ); 
    
    /*********************************************
     * Manage Options
     *********************************************
    */

    // Reset Options
    $this->admin_option(array('Manage Options', FLEXIPANEL_ADMIN_URL . '/images/icon-options.png'), 'Export Options', 
        'Export FlexiPanel Options', 'export_options', 
        'content', '
        <div style="margin:20px 0;"><a class="button" onclick="flexipanel_ajax(\'act=admin_options&do=export\', \'admin_options_export\',\'true\');" >Generate Export Code Now</a></div>
        <div id="admin_options_export"></div>', 
        array('help' => "You can easily transfer current theme's options to another. <br />1. Generate an export code by clicking the button below.<br /> 2. Copy the generated code and paste it to \"Import Options\" textarea of your other theme.", 'display'=>'extended-top')
    );
    
    $this->admin_option('Manage Options', 'Import Options', 
        'Import FlexiPanel Options', 'import_options', 
        'content', '
        <div style="margin-bottom:40px;"><textarea class="fp-textarea" style="height:300px" name="import_admin_options"></textarea></div>
        <div id="fp_import_options" style="margin-bottom:40px; display:none;"></div>
        <div style="margin-bottom:40px;"><a class="button-primary fp-button-red" onclick="flexipanel_form(\'admin_options&do=import\', \'fpForm\',\'fp_import_options\',\'true\');" >Import Options Now</a></div>', 
        array('help' => 'Transfer options from anoher theme. Paste here the code you copied from the "Export Options" textarea.<br/><span style="color:red;"><strong>Note:</strong> All the previous saved settings will be lost!</span>', 'display'=>'extended-top')
    );
    
    $this->admin_option('Manage Options', 'Reset Options', 
        'Reset FlexiPanel Options', 'reset_options', 
        'content', '
        <div id="fp_reset_options" style="margin-bottom:40px; display:none;"></div>
        <div style="margin-bottom:40px;"><a class="button-primary fp-button-red" onclick="if (confirm(\'All the saved settings will be lost! Do you really want to continue?\')) { flexipanel_form(\'admin_options&do=reset\', \'fpForm\',\'fp_reset_options\',\'true\'); } return false;">Reset Options Now</a></div>', 
        array('help' => 'Reset the theme options to default values. <span style="color:red;"><strong>Note:</strong> All the previous saved settings will be lost!</span>', 'display'=>'extended-top')
    );
    
    
    /*********************************************
     * Support
     *********************************************
    */

    // FAQ
    $this->admin_option(array('Support', FLEXIPANEL_ADMIN_URL . '/images/icon-support.png'), array('FAQ', 'link'), 
        'http://flexithemes.com/support/faq/'
    );
    
    // Documentation
    $this->admin_option('Support', array('Documentation', 'link'), 
        'http://flexithemes.com/support/documentation/'
    );
    
    // Support Forums
    $this->admin_option('Support', array('Support Forums', 'link'), 
        'http://flexithemes.com/forum/'
    );
    
    // Download Themes
    $this->admin_option('Support', array('Download Themes', 'link'), 
        'http://flexithemes.com/themes/'
    );
?>