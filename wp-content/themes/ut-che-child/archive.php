<?php get_header(); ?>

    <div id="articles">

    		<?php if (have_posts()) : ?>
    
     			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    
    			<?php /* If this is a category archive */ if (is_category()) { ?>
    				<h2 class="pagetitle"><?php single_cat_title(); ?></h2>
    
    			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
    				<h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
    
    			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
    				<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
    
    			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
    				<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
    
    			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
    				<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
    
    			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
    				<h2 class="pagetitle">Author Archive</h2>
    
    			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    				<h2 class="pagetitle">Blog Archives</h2>
    			
    			<?php } ?>

    
    			<?php while (have_posts()) : the_post(); ?>
    			     <h2 class="entrytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
                        
                    <?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>

    				<article <?php post_class('clearfix') ?>>
    				
    						
    
    						<div class="entry clearfix">
                                <?php // Show featured image, or first image if no featured, or YouTube thumbnail
                                    if (function_exists('vp_get_thumb_url')) {
                                        // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
                                        $thumb=vp_get_thumb_url($post->post_content, 'thumbnail');
                                        if ($thumb!='') { ?>
                                            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><img class="alignleft" src="<?php echo $thumb; ?>" alt="<?php the_title_attribute(); ?>" /></a>
                                        <?php }
                                    } ?>
                                <?php the_excerpt(); ?>

                            </div>
    
    				</article>
    
    			<?php endwhile; ?>
    
    			<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>
    			
    	<?php else : ?>
    
    		<h2>Nothing found</h2>
    
    	<?php endif; ?>
    
    </div><!-- #articles -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
