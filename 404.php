<?php global $theme; get_header(); ?>

    <div id="main">
    <?php $theme->hook('main_before'); ?>
    
        <div id="wrap-content">
        <?php $theme->hook('content_before'); ?>
        
            <div class="content">
            
                <h2 class="generic"><?php _e('Error 404','flexithemes'); ?></h2>
                
                <div class="entry">
                
                    <?php _e('The page you requested could not be found.','flexithemes'); ?>
                    
                </div>
                
                <div id="wrap-search">
                            
                    <?php get_search_form(); ?>
                
                </div>
                
            </div><!-- .content -->
            
        <?php $theme->hook('content_after'); ?> 
        </div><!-- #wrap-content -->
        
        <?php get_sidebar(); ?> 
        
    <?php $theme->hook('main_after'); ?> 
    </div><!-- #main -->
        
<?php get_footer(); ?>