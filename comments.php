<?php global $theme; ?>

    <?php if ( post_password_required() ) { ?>
        <p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'flexithemes' ); ?></p>
    <?php return; } ?>
    
    <?php if ( have_comments() ) { ?>
        <div id="comments">
            <?php $theme->hook('comments_before'); ?>
            
            <h3 id="comments-title"><?php
        	printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'flexithemes' ),
        	number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
        	?></h3>
            
            <ol class="commentlist">
    		  <?php wp_list_comments(); ?>
            </ol>
            
            <?php if ( get_comment_pages_count() > 1 ) { ?>
    			<div class="navigation clearfix">
    				<div class="alignleft"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'flexithemes' ) ); ?></div>
    				<div class="alignright"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'flexithemes' ) ); ?></div>
    			</div><!-- .navigation .clearfix -->
            <?php } ?>
            
            <?php $theme->hook('comments_after'); ?>
        </div><!-- #comments -->
    <?php } ?>

<?php $theme->hook('comment_form_before'); ?>
<?php comment_form(); ?>
<?php $theme->hook('comment_form_after'); ?>