<?php
/**
 * Plugin: Top Search
 * Author: FlexiThemes.com
 * Version: 1.0
 * Updated: Sep 27, 2010
*/

     // Admin Options
    $this->admin_option('General Options', 'General Options', 
        'Top Right Search Box', 'topsearch', 
        'checkbox', 'true', 
        array('help' => 'Display the search box at the top right position. ', 'display'=>'extended')
    );

  if($this->display('topsearch')) {
        
        $this->add_hook('menu_primary_before',  'flexi_top_search_before');
        function flexi_top_search_before()
        {
            echo '<div class="clearfix">';
        }
        
        $this->add_hook('menu_primary_after',  'flexi_top_search');
        function flexi_top_search()
        {
            ?>
                <div class="topsearch">
                    <?php get_search_form(); ?>
                </div><!-- .topsearch -->
                </div>
            <?php
        }
        
        $this->custom_css(".wrap-menu-primary { float: left; width: 680px; }");
  }
?>