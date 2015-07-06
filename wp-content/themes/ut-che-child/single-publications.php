<?php get_header(); ?>

    <div id="articles">
    
    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
            
                 <?php
                // SET UP THUMBNAIL STUFF TO USE WITH POSTS
                if (function_exists('vp_get_thumb_url')) {
                    // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
                    $thumb=vp_get_thumb_url($post->post_content, 'post-feature', true); 
                }

                    $article_title = get_post_meta( get_the_ID(), 'article_title', true );
                    $journal_link = get_post_meta( get_the_ID(), 'journal_link', true );
                    $authors = get_post_meta( get_the_ID(), 'authors', true );
                    $citation = get_post_meta( get_the_ID(), 'citation', true );
                    
             ?>
                <?php if ($thumb != '') { ?><img class="post-feature" src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" /><?php } ?>
                
    			<div class="entry">
                
                    <h1 class="entry-title"><?php if ($article_title) { echo apply_filters( 'the_content', html_entity_decode( $article_title, ENT_QUOTES, 'UTF-8' ) ); } else {the_title(); } ?></h1>
    				
    				<?php if ($authors) echo 'by ' . $authors; ?>

                                <?php if ($citation) echo apply_filters( 'the_content', html_entity_decode( $citation, ENT_QUOTES, 'UTF-8' ) ); ?>

                                <?php if ($journal_link) { ?><p><a class="lnk-more left" href="<?php echo $journal_link; ?>" target="_blank">Read the article</a></p><?php } ?>
    
    			</div>
    			
    		</article>
    
    	<?php //comments_template(); ?>
    
    	<?php endwhile; endif; ?>
    
    </div><!-- #articles -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>