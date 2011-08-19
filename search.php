<?php global $theme; get_header(); ?>

    <div id="main">
    <?php $theme->hook('main_before'); ?>
    
        <div id="wrap-content">
        <?php $theme->hook('content_before'); ?>
        
            <div class="content">
                
                <?php
                    if (have_posts()) { ?>
                        <h2 class="generic"><?php _e( 'Search Results for:', 'flexithemes' ); ?> <span><?php echo get_search_query(); ?></span></h2>
                        <?php
                            $theme->options['template_part'] = 'search';
                            get_template_part('loop', 'search');
                    }  else { ?>
                        <h2 class="generic"><?php _e( 'Nothing Found', 'flexithemes' ); ?></h2>
                        <div class="entry">
                            <p><?php printf( __( 'Sorry, but nothing matched your search criteria: %s. Please try again with some different keywords.', 'flexithemes' ), '<strong>' . get_search_query() . '</strong>' ); ?></p>
                        </div>
                        
                        <div id="wrap-search">
                            
                            <?php get_search_form(); ?>
                        
                        </div>
                        <?php
                    }
                ?> 
                
            </div><!-- .content -->
            
        <?php $theme->hook('content_after'); ?> 
        </div><!-- #wrap-content -->
    
        <?php get_sidebar(); ?> 
    
    <?php $theme->hook('main_after'); ?> 
    </div><!-- #main -->
    
<?php get_footer(); ?>