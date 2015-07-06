<?php get_header(); ?>

    <div id="articles">
    
    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
            
                
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