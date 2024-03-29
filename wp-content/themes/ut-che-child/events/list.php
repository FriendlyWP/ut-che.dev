<?php
	global $sp_ecp;
	
	get_header();

	echo stripslashes(sp_get_option('spEventsBeforeHTML'));
?>
<?php get_header(); ?>
    
    <div id="articles">

<!--
	<div class="visual">

		<img src="<?php get_template_directory_uri(); ?>/images/visual-img.jpg" alt="" />

	</div>
-->

	<div class="calendar">
        
	<div id="tec-content" class="upcoming">
		<div id='tec-events-calendar-header' class="clearfix">
        <h2 class="page-title pagetitle"><?php 
            global $sp_ecp;
        	$current_cat = get_query_var('sp_events_cat');
        	if($current_cat){
        		$term_info = get_term_by('slug',$current_cat,$sp_ecp->get_event_taxonomy());
        		$cat_name =  $term_info->name;
                if ($cat_name == 'Upcoming Events') {
                    printf( __( '%s', 'Tweaked' ), $cat_name);    
                } else {
        		printf( __( 'Upcoming %s', 'Tweaked' ), $cat_name);
                }
        	} else {
        	   echo 'All Events';
        	}
        ?></h2>
		<!-- <span class='tec-calendar-buttons'>
			<a class='tec-button-on' href='<?php echo events_get_listview_link(); ?>'><?php _e('List View', $spEvents->pluginDomain)?></a>
			<a class='tec-button-off' href='<?php echo events_get_gridview_link(); ?>'><?php _e('Calendar', $spEvents->pluginDomain)?></a>
		</span>
 -->
		</div><!--#tec-events-calendar-header-->
		<?php
		global $wp_query;
		$tecCatObject = get_category( $wp_query->query_vars['cat'])
		?>
		<a class="ical" href="<?php echo home_url(); ?>/?ical=<?php echo $tecCatObject->slug; ?>"><?php _e('iCal Import', $spEvents->pluginDomain) ?></a>
		<div id="tec-events-loop" class="tec-events post-list clearfix">
            
		<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID() ?>" class="tec-event post clearfix<?php echo $alt ?>">
                <div style="clear:both;"></div>
                <div class="post-inner">
							    
							        <?php //if ( is_new_event_day() ) : ?>
					                   <!--
<h4 class="event-day"><?php echo the_event_start_date( null, false ); ?></h4>
-->
							        <?php //endif; ?>
						<?php 
						$curcat = cal_cur_category();
						the_title('<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '" class="' . $curcat . '" rel="bookmark">', '</a></h2>'); ?>
					<div class="event-info-container">
						<div class="entry-content tec-event-entry">
							<?php the_excerpt() ?>
						</div> <!-- End tec-event-entry -->
	
						<div class="tec-event-list-meta">
			              <table cellspacing="0">
			                  <tr>
			                    <td class="tec-event-meta-desc"><?php _e('Start:', $spEvents->pluginDomain) ?></td>
			                    <td class="tec-event-meta-value"><?php echo the_event_start_date(); ?></td>
			                  </tr>
			                  <?php if(the_event_start_date()!=the_event_end_date()) { ?>
			                  <tr>
			                    <td class="tec-event-meta-desc"><?php _e('End:', $spEvents->pluginDomain) ?></td>
			                    <td class="tec-event-meta-value"><?php echo the_event_end_date(); ?></td>
			                  </tr>
			                  <?php
			                  }
			                    $venue = the_event_venue();
			                    if ( !empty( $venue ) ) :
			                  ?>
			                  <tr>
			                    <td class="tec-event-meta-desc"><?php _e('Venue:', $spEvents->pluginDomain) ?></td>
			                    <td class="tec-event-meta-value"><?php echo $venue; ?></td>
			                  </tr>
			                  <?php endif; ?>
			                  <?php
			                    $phone = the_event_phone();
			                    if ( !empty( $phone ) ) :
			                  ?>
			                  <tr>
			                    <td class="tec-event-meta-desc"><?php _e('Phone:', $spEvents->pluginDomain) ?></td>
			                    <td class="tec-event-meta-value"><?php echo $phone; ?></td>
			                  </tr>
			                  <?php endif; ?>
			                  <?php if (tec_address_exists( $post->ID ) ) : ?>
			                  <tr>
								<td class="tec-event-meta-desc"><?php _e('Address:', $spEvents->pluginDomain); ?><br />
								<?php if( get_post_meta( $post->ID, '_EventShowMapLink', true ) == 'true' ) : ?>
									<?php $mapArgs = array("f"=>"q","source"=>"s_q","geocode"=>""); ?>
									
								<?php endif; ?></td>
								<td class="tec-event-meta-value"><?php tec_event_address( $post->ID ); ?><a class="gmap" href="<?php event_google_map_link( null, $mapArgs ); ?>" title="Click to view a Google Map" target="_blank"><?php _e('&raquo; Google Map', $spEvents->pluginDomain ); ?></a></td>
			                  </tr>
			                  <?php endif; ?>
			                  <?php
			                    $cost = the_event_cost();
			                    if ( !empty( $cost ) ) :
			                  ?>
		 		              <tr>
								<td class="tec-event-meta-desc"><?php _e('Cost:', $spEvents->pluginDomain) ?></td>
								<td class="tec-event-meta-value"><?php echo $cost; ?></td>
							 </tr>
			                  <?php endif; ?>
			              </table>
						</div>
					</div><!--end of event-info-container-->
                    
					<div style="clear:both;"></div>
                    </div><!-- .post-inner -->
				</div> <!-- End post -->
                
				<div class="tec-events-list content_footer"></div>
                
	<?php $alt = ( empty( $alt ) ) ? ' alt' : '';?>
		<?php endwhile; // posts ?>
		
            


		</div><!-- #tec-events-loop -->
		<div class="tec-nav" id="tec-nav-below">

			<div class="tec-nav-previous"><?php
			// Display Previous Page Navigation
			if( events_displaying_upcoming() && get_previous_posts_link( ) ) : ?>
				<?php previous_posts_link( '<span>&laquo; Older</span>' ); ?>
			<?php elseif( events_displaying_upcoming() && !get_previous_posts_link( ) ) : ?>
				<a href='<?php echo events_get_past_link(); ?>'><span><?php _e('&laquo; Older', $spEvents->pluginDomain ); ?></span></a>
			<?php elseif( events_displaying_past() && get_next_posts_link( ) ) : ?>
				<?php next_posts_link( '<span>&laquo; Older</span>' ); ?>
			<?php endif; ?>
			</div>

			<div class="tec-nav-next"><?php
			// Display Next Page Navigation
			if( events_displaying_upcoming() && get_next_posts_link( ) ) : ?>
				<?php next_posts_link( '<span>Newer &raquo;</span>' ); ?>
			<?php elseif( events_displaying_past() && get_previous_posts_link( ) ) : ?>
				<?php previous_posts_link( '<span>Newer &raquo;</span>' ); // a little confusing but in 'past view' to see newer events you want the previous page ?>
			<?php elseif( events_displaying_past() && !get_previous_posts_link( ) ) : ?>
				<a href='<?php echo events_get_upcoming_link(); ?>'><span><?php _e('Newer &raquo;', $spEvents->pluginDomain); ?></span></a>
			<?php endif; ?>
			</div>

		</div>

	</div>
</div><!-- .calendar -->

</div><!-- #articles -->


<?php get_sidebar(); ?>

<?php get_footer(); ?>
