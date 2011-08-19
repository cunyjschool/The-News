<?php global $theme; ?>
        
        <div id="wrap-sidebar-primary">
        <?php $theme->hook('sidebars_before'); ?>
        
            <div id="sidebar-primary" class="sidebar widgetized">
            <?php $theme->hook('sidebar_primary_before'); ?>
            
                <?php
                    if(!dynamic_sidebar('sidebar_primary_thenews')) {
                        printf( __( 'The primary sidebar widget area. <a href="%s">Click here</a> to add some widgets now.', 'flexithemes' ), get_bloginfo('url') . '/wp-admin/widgets.php' );
                    }
                ?>
                
            <?php $theme->hook('sidebar_primary_after'); ?> 
            </div><!-- #sidebar-primary -->
            
        <?php $theme->hook('sidebars_after'); ?> 
        </div><!-- #wrap-sidebar-primary -->
        
        <div id="wrap-sidebar-secondary">
        <?php $theme->hook('sidebars_before'); ?>
        
            <div id="sidebar-secondary" class="sidebar widgetized">
            <?php $theme->hook('sidebar_secondary_before'); ?>
            
                <?php
                    if(!dynamic_sidebar('sidebar_secondary_thenews')) {
                        printf( __( 'The secondary sidebar widget area. <a href="%s">Click here</a> to add some widgets now.', 'flexithemes' ), get_bloginfo('url') . '/wp-admin/widgets.php' );
                    }
                ?>
                
            <?php $theme->hook('sidebar_secondary_after'); ?> 
            </div><!-- #sidebar-secondary -->
            
        <?php $theme->hook('sidebars_after'); ?> 
        </div><!-- #wrap-sidebar-secondary -->
        