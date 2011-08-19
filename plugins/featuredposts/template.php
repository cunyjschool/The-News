<div class="featuredposts">
    <?php
        if($this->theme->display('featuredposts_label')) { ?>
            <h2 class="fp-label"><?php $this->theme->option('featuredposts_label'); ?></h2>
    <?php }?>
    
    <div class="fp-slides">

            <?php
                $featuredposts_source = $this->theme->get_option('featuredposts_source');
                $featuredposts_moreoptions = $this->theme->get_option('featuredposts_moreoptions');
                
                $featuredposts_query = false;
            
                if($featuredposts_source == 'category') {
                    if($this->theme->display('featuredposts_source_category')) {
                        $featuredposts_query = 'posts_per_page=' . $this->theme->get_option('featuredposts_source_category_num') . '&cat=' . $this->theme->get_option('featuredposts_source_category');
                    } 
                } elseif($featuredposts_source == 'posts') {
                    if($this->theme->display('featuredposts_source_posts')) {
                        $featuredposts_query = array('post__in'=> explode(',', trim($this->theme->get_option('featuredposts_source_posts'))), 'post_type'=>'post');
                    } 
                } elseif($featuredposts_source == 'pages') {
                    if($this->theme->display('featuredposts_source_pages')) {
                        $featuredposts_query = array('post__in'=> explode(',', trim($this->theme->get_option('featuredposts_source_pages'))), 'post_type'=>'page');
                    } 
                }
                
                if($featuredposts_query) {
                    $featuredposts_excerpt_length = $this->theme->get_option('featuredposts_excerpt_length');
                    query_posts($featuredposts_query);
                    if (have_posts()) : while (have_posts()) : the_post(); 
                    ?>
            		  <div class="fp-post">
                            <?php 
                                if($this->theme->display('thumbnail', $featuredposts_moreoptions) && has_post_thumbnail() ) {
                                    the_post_thumbnail('large', array('class' => 'fp-thumbnail'));
                                }
                            
                                if( $this->theme->display('post_title', $featuredposts_moreoptions) || $this->theme->display('post_excerpt', $featuredposts_moreoptions)) {
                                    ?>
                                    <div class="fp-content<?php if(!$this->theme->display('post_title', $featuredposts_moreoptions)) { echo ' fp-content-no-title'; } if(!$this->theme->display('post_excerpt', $featuredposts_moreoptions)) { echo ' fp-content-no-excerpt'; } ?>">
                                        <?php 
                                            if( $this->theme->display('post_title', $featuredposts_moreoptions) ) { ?>
                                                <h3 class="fp-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'flexithemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3><?php 
                                            }
                                            
                                            if( $this->theme->display('post_excerpt', $featuredposts_moreoptions) ) { ?>
                                                <p>
                                                    <?php echo $this->theme->shorten(get_the_excerpt(),$featuredposts_excerpt_length); ?> 
                                                    <?php
                                                        if( $this->theme->display('featuredposts_readmore') ) { ?>
                                                            <a class="fp-more" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'flexithemes' ), the_title_attribute( 'echo=0' ) ); ?>"><?php $this->theme->option('featuredposts_readmore'); ?></a>
                                                    <?php } ?>
                                                </p>
                                            <?php } ?>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
            		<?php
                    endwhile;
                    else : 
                    $featuredposts_query = false;
                    endif;
                    wp_reset_query();
                } 
                
                if(!$featuredposts_query) {
                    for($i = 1; $i <=5; $i++) { ?>
                        <div class="fp-post">
                        
                            <img class="fp-thumbnail" src="<?php echo $this->url; ?>/default-slides/<?php echo $i; ?>.jpg" alt="This is default featured post <?php echo $i; ?> title" title="This is default featured post <?php echo $i; ?> title" />
                            
                            <div class="fp-content">
                                <h3 class="fp-title"><a href="#">This is default featured post <?php echo $i; ?> title</a></h3>
                                <p>
                                    To set your featured posts, please go to your theme options page in wp-admin. You can also disable the featured posts slideshow from certain parts of your site if you don't wish to display them.
                                    <a class="fp-more" href="#fp-more">More &raquo;</a>
                                </p>
                            </div>
                            
                        </div>
                	<?php }
                }
            ?>
    </div>
    
    <?php
        if($this->theme->display('pager', $featuredposts_moreoptions) || $this->theme->display('next_prev', $featuredposts_moreoptions) ) { ?>
        
            <div class="fp-nav clearfix">
                <?php if($this->theme->display('pager', $featuredposts_moreoptions)) { ?><span class="fp-pager"></span><?php } ?>
                
                <?php if($this->theme->display('next_prev', $featuredposts_moreoptions)) { ?>
                    <a href="#fp-next" class="fp-next"></a>
                    <a href="#fp-prev" class="fp-prev"></a>
                <?php } ?>
            </div>
            
         <?php }
    ?>
    
</div>