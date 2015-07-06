<?php
	global $sp_ecp;
	get_header();
	echo stripslashes(sp_get_option('spEventsBeforeHTML'));
?>	
    <div id="content">
        
    
	<?php the_post(); global $post; ?>
    
			
				
				<?php include(tribe_get_current_template()) ?>
				
		<?php if(sp_get_option('showComments','no') == 'yes'){ comments_template();} ?>
	</div><!-- #content -->


        <?php get_sidebar(); ?>

          
<?php
	echo stripslashes(sp_get_option('spEventsAfterHTML'));
	get_footer();
?>