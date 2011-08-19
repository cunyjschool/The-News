<?php global $theme; get_header(); ?>

    <div id="main">
    <?php $theme->hook('main_before'); ?>
    
        <div id="wrap-content">
        <?php $theme->hook('content_before'); ?>
        
            <div class="content">
            
                <h2 class="generic"><?php
                
                /* If this is a category archive */ 
               if (is_category()) { printf( __( 'Category: <span>%s</span>', 'flexithemes' ), single_cat_title( '', false ) ); 
                    $the_template_part = 'categories';
               
               /* If this is a tag archive */ 
               } elseif (is_tag()) { printf( __( 'Tag: <span>%s</span>', 'flexithemes' ), single_tag_title( '', false ) ); 
                    $the_template_part = 'tags';
                        
               /* If this is a daily archive */ 
               } elseif (is_day()) { printf( __( 'Daily Archives: <span>%s</span>', 'flexithemes' ), get_the_date() ); 
                    $the_template_part = 'day';
                
                /* If this is a monthly archive */ 
                } elseif (is_month()) { printf( __( 'Monthly Archives: <span>%s</span>', 'flexithemes' ), get_the_date('F Y') );
                    $the_template_part = 'month';
                  
                /* If this is a yearly archive */ 
                } elseif (is_year()) { printf( __( 'Yearly Archives: <span>%s</span>', 'flexithemes' ), get_the_date('Y') );
                    $the_template_part = 'year';
                
                /* If this is an author archive */ 
                } elseif (is_author()) { printf( __( 'Author Archives: <span>%s</span>', 'flexithemes' ),  get_the_author() );
                    $the_template_part = 'author';
                
                /* If this is a general archive */ 
                } else { _e( 'Blog Archives', 'flexithemes' ); $the_template_part = 'archive';} 
            ?></h2>
            
                <?php
                    $theme->options['template_part'] = $the_template_part;
                    get_template_part('loop', $the_template_part);
                ?> 
            </div><!-- .content -->
            
        <?php $theme->hook('content_after'); ?> 
        </div><!-- #wrap-content -->
        
        <?php get_sidebar(); ?> 
        
    <?php $theme->hook('main_after'); ?> 
    </div><!-- #main -->
        
<?php get_footer(); ?>