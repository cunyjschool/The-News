<?php
    global $theme;
    $theme->hook('loop_before'); 
    
    $get_post_elements =  $theme->get_option($theme->options['template_part'] . '_post_elemnts');
    if (have_posts()) : while (have_posts()) : the_post();
?>

                <div class="wrap-post">
                <?php $theme->hook('post_before'); ?>

                    <div <?php post_class('post clearfix'); ?> id="post-<?php the_ID(); ?>">
                    <?php $theme->hook('post'); ?>
                        
                        <?php if($theme->display('date', $get_post_elements))  { ?>
                        
                        <div class="postmeta-date">
                            <span class="meta_date"><?php the_time($theme->get_option('dateformat')); ?></span>
                        </div>
                        <?php } ?>
                        
                        <h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'flexithemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        <?php if($theme->display('author', $get_post_elements) || $theme->display('comments', $get_post_elements) || $theme->display('edit_link', $get_post_elements))  { ?>
                        
                        <div class="postmeta-primary">

                            <?php if($theme->display('author',$get_post_elements)) { 
                                   ?> &nbsp; <span class="meta_author"><?php the_author(); ?></span><?php
                                }

                                if($theme->display('comments', $get_post_elements) && comments_open( get_the_ID() ))  {
                                    ?> &nbsp; <span class="meta_comments"><?php comments_popup_link( __( 'No comments', 'flexithemes' ), __( '1 Comment', 'flexithemes' ), __( '% Comments', 'flexithemes' ) ); ?></span><?php
                                }
                                
                                if($theme->display('edit_link', $get_post_elements))  {
                                    ?> &nbsp; <span class="meta_edit"><?php edit_post_link(); ?></span><?php
                                } ?> 
                        </div>
                        <?php } ?>
                        
                        <div class="entry clearfix">
                            
                            <?php
                                if($theme->options['general']['featured_image'] && $theme->display('featured_image', $get_post_elements) && has_post_thumbnail())  {
                                    the_post_thumbnail(
                                        array($theme->get_option($theme->options['template_part'] . '_featured_image_width'), $theme->get_option($theme->options['template_part'] . '_featured_image_height')),
                                        array("class" => $theme->get_option($theme->options['template_part'] . '_featured_image_position') . " featured_image")
                                    );
                                }
                            ?>
                            
                            <?php
                                if($theme->get_option($theme->options['template_part'] . '_content_display') == 'excerpts') {
                                    echo '<p>' . $theme->shorten(get_the_excerpt(),$theme->get_option($theme->options['template_part'] . '_excerpts_length')) . '</p>';
                                } else {
                                    the_content('');
                                }
                            ?>

                        </div>
                        <?php if($theme->display('categories', $get_post_elements) || $theme->display('tags', $get_post_elements))  { ?>

                        <div class="postmeta-secondary">
                            <?php if($theme->display('categories', $get_post_elements)) {
                                ?><span class="meta_categories"><?php _e( 'Posted in:', 'flexithemes' ); ?>  <?php the_category(', '); ?></span><?php
                            } if($theme->display('tags', $get_post_elements)) {
                                if(get_the_tags()) {
                                    ?> &nbsp; <span class="meta_tags"><?php the_tags(__( 'Tags:', 'flexithemes') . ' ', ', ', ''); ?></span><?php
                                }
                            }
                            ?> 
                        </div>
                        <?php }

                        if($theme->display('readmore', $get_post_elements))  { ?>
                        
                        <div class="wrap-readmore clearfix">
                            <a class="readmore" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'flexithemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $theme->option($theme->options['template_part'] . '_read_more'); ?></a>
                        </div>
                        <?php } ?>
                        
                    </div>
                <?php $theme->hook('post_after'); ?> 
                </div><!-- Post ID <?php the_ID(); ?> -->
                
    <?php endwhile; ?>
    <?php else : ?>

                <div class="postwrap">
                
                    <div class="post">
                    
                        <div class="entry">

                            <p><?php _e('No results were found for the requested archive. Perhaps searching will help find a related post.','flexithemes'); ?></p>
                        
                        </div>

                        <div id="wrap-search">
                            
                            <?php get_search_form(); ?>
                        
                        </div>
                        
                    </div>
                    
                </div>
    <?php endif; 
    
    if (  $wp_query->max_num_pages > 1 ) { ?>

                <div class="navigation clearfix">
                    
                    <?php
                        if(function_exists('wp_pagenavi')) {
                            wp_pagenavi();
                        } else {
                    ?><div class="alignleft"><?php next_posts_link( __( '<span>&laquo;</span> Older posts', 'flexithemes' ) );?></div>
                    <div class="alignright"><?php previous_posts_link( __( 'Newer posts <span>&raquo;</span>', 'flexithemes' ) );?></div><?php
                    } ?> 
                    
                </div><!-- .navigation .clearfix -->
    <?php  } 
    
    wp_reset_query(); 
	$theme->hook('loop_after');
?>