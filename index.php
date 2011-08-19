<?php global $theme; get_header(); ?>

    <div id="main">
    <?php $theme->hook('main_before'); ?>
    
        <div id="wrap-content">
        <?php $theme->hook('content_before'); ?>
        
            <div class="content">
                <?php
                    if(is_home()) {
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $build_homepage_query = array (
                		   'paged'=> $paged,
                		   'category__not_in' => $theme->get_option('homepage_exclude_categories'),
                           'posts_per_page' => $theme->get_option('homepage_posts_per_page')
                		);
                        query_posts($build_homepage_query);
                    }
                    
                    $theme->options['template_part'] = 'homepage';
                    get_template_part('loop', 'homepage');
                ?> 
            </div><!-- .content -->
            
        <?php $theme->hook('content_after'); ?> 
        </div><!-- #wrap-content -->
    
        <?php get_sidebar(); ?> 
    
    <?php $theme->hook('main_after'); ?> 
    </div><!-- #main -->

<?php get_footer(); ?>