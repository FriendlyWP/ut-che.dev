<?php get_header(); ?>
    
    <div id="articles">

	   <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
             <?php
                // SET UP THUMBNAIL STUFF TO USE WITH POSTS
                if (function_exists('vp_get_thumb_url')) {
                    // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
                    $thumb=vp_get_thumb_url($post->post_content, 'post-feature', true); 
                }
                $excerpt = get_the_excerpt();
             ?>
			
    		<article class="post" id="post-<?php the_ID(); ?>">
            
                <?php if ($thumb != '') { ?><img class="post-feature" src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" /><?php } ?>

    			<div class="entry">
                
                    <h2 class="page-title"><?php the_title(); ?></h2>
    
    				<?php the_content(); ?>
    
    				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
    
    			</div>
    
    		</article>
    		
    		<?php //comments_template(); ?>

		<?php endwhile; endif; ?>
        
    </div><!-- #articles -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
