<?php global $theme; get_header(); ?>

    <div id="main">
    <?php $theme->hook('main_before'); ?>
    
        <div id="wrap-content">
        <?php $theme->hook('content_before'); ?>
        
            <div class="content">
            <?php $theme->hook('loop_before'); ?>
                
                <?php
                    $theme->options['template_part'] = 'singlepost';
                    $get_post_elements =  $theme->get_option('singlepost_post_elemnts');
                    
                    if (have_posts()) while (have_posts()) : the_post();
                ?>

                <div class="wrap-post wrap-post-single">
                <?php $theme->hook('post_before'); ?>

                    <div <?php post_class('post clearfix'); ?> id="post-<?php the_ID(); ?>">
                    <?php $theme->hook('post'); ?>
                    
                        <?php if($theme->display('date', $get_post_elements))  { ?>
                        
                        <div class="postmeta-date">
                            <span class="meta_date"><?php the_time($theme->get_option('dateformat')); ?></span>
                        </div>
                        <?php } ?>
                        
                        <h2 class="title"><?php the_title(); ?></h2>
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
                                the_content(''); 
                                wp_link_pages( array( 'before' => '<p><strong>' . __( 'Pages:', 'flexithemes' ) . '</strong>', 'after' => '</p>' ) );
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
                        <?php } ?>
                        
                    </div>
                <?php $theme->hook('post_after'); ?> 
                </div><!-- Post ID <?php the_ID(); ?> -->
                
                <?php if($theme->display('next_previous_links', $get_post_elements))  { ?>
                        
                        <div class="navigation clearfix">
        					<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
        					<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
        				</div>
                <?php } ?>
                
                <?php 
                    if($theme->display('comments', $get_post_elements) && comments_open( get_the_ID() ))  {
                        comments_template('', true); 
                    }
                ?>
                <?php endwhile; ?>
                
            <?php $theme->hook('loop_after'); ?>
            </div><!-- .content -->
            
        <?php $theme->hook('content_after'); ?> 
        </div><!-- #wrap-content -->
        
        <?php get_sidebar(); ?> 
        
    <?php $theme->hook('main_after'); ?> 
    </div><!-- #main -->

<?php get_footer(); ?>