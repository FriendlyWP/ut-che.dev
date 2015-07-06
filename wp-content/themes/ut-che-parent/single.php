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
             ?>
                <?php if ($thumb != '') { ?><img class="post-feature" src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" /><?php } ?>
                
    			<div class="entry">
                
                    <h1 class="entry-title"><?php the_title(); ?></h1>
    				
    				<?php the_content(); ?>
    
    				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
    				
    				<?php the_tags( 'Tags: ', ', ', ''); ?>
    			
    				<?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>
    
    			</div>
    			
    		</article>
    
    	<?php //comments_template(); ?>
    
    	<?php endwhile; endif; ?>
    
    </div><!-- #articles -->
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>