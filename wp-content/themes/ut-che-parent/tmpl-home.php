<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>
    
    <div id="articles">
    
        <script type="text/javascript" language="javascript">
                    jQuery(document).ready(function($) {
                        $('.flexslider').flexslider({
                          animation: "slide",
                          slideshowSpeed: 16000,
                          controlsContainer: ".flex-container"
                    });
                });
                </script>
        <?php query_posts(array('category_name' => 'home-feature', 'posts_per_page' => 5 )) ?>
        
        <div class="flexslider">
            <ul class="slides">
            <?php while ( have_posts() ) : the_post(); ?>
            <?php $excerpt = get_the_excerpt(); ?>
                <?php
                // SET UP THUMBNAIL STUFF TO USE WITH POSTS
                if (function_exists('vp_get_thumb_url')) {
                    // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
                    $thumb=vp_get_thumb_url($post->post_content, 'home-feature'); 
                }
                ?>
                <li>
                    <div class="copy">
                        <div class="text">
                        <h2><?php the_title(); ?></h2>
                        
                        <?php echo string_limit_words($excerpt,25); ?>&nbsp;&hellip;&nbsp;<a class="readmorelink" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">&raquo;&nbsp;Read more</a>
                        </div><!-- .text -->
                    </div><!-- .copy -->
                    <div class="img">
                        <?php if ($thumb!='') { ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><img src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" /></a>
                        <?php } ?>
                    </div><!-- .img -->
                </li>
            <?php endwhile;

            // Reset Query
            wp_reset_query();
            ?>
            </ul><!-- .slider -->
        </div><!-- .flexslider -->
        
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
