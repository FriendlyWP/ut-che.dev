<?php get_header(); ?>

    <div id="articles">

    		<?php if (have_posts()) : ?>
    
     			<h2 class="pagetitle">Publications</h2>

    
    			<?php while (have_posts()) : the_post(); ?>
    			     
                        
                    <?php 
                    $article_title = get_post_meta( get_the_ID(), 'article_title', true );
                    $journal_link = get_post_meta( get_the_ID(), 'journal_link', true );
                    $authors = get_post_meta( get_the_ID(), 'authors', true );
                    $citation = get_post_meta( get_the_ID(), 'citation', true );
                    ?>
                            

    				<article <?php post_class('clearfix') ?>>
    				
    						<div class="entry clearfix"><h3 class="entrytitle" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php if ($article_title) { echo apply_filters( 'the_content', html_entity_decode( $article_title, ENT_QUOTES, 'UTF-8' ) ); } else {the_title(); } ?></a></h3>
    
    						
                                 <?php if ($authors) echo 'by ' . $authors; ?>

                                <?php if ($citation) echo apply_filters( 'the_content', html_entity_decode( $citation, ENT_QUOTES, 'UTF-8' ) ); ?>

                                <?php if ($journal_link) { ?><p><a class="lnk-more left" href="<?php echo $journal_link; ?>" target="_blank">Read the article</a></p><?php } ?>
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
