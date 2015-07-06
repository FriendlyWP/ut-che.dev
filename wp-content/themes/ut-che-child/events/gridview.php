<?php
	global $sp_ecp;
	//get_header();
	echo stripslashes(sp_get_option('spEventsBeforeHTML'));
?>

<?php get_header(); ?>
    
    <div id="articles">

	<div class="calendar">

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

		<div id="tec-content" class="grid">
		<div id='tec-events-calendar-header' class="clearfix">
            <div class="sub-tec-events-calendar-headers">

			<span class='tec-month-nav'>
				<span class='tec-prev-month'>
					<a href='<?php echo sp_get_previous_month_link(); ?>'>
					<?php echo sp_get_previous_month_text(); ?>
					</a>
				</span>
                <div class="sel-hold">
				<?php sp_month_year_dropdowns( "tec-" ); ?>
                </div>
				<span class='tec-next-month'>
					<a href='<?php echo sp_get_next_month_link(); ?>'>				
					<?php echo sp_get_next_month_text(); ?> 
					</a>
				</span>
			</span>

			<span class='tec-calendar-buttons'> 
				
                <a class='tec-button-off' href='<?php echo sp_get_listview_link(); ?>'><?php _e('List View', $sp_ecp->pluginDomain)?></a>
				<a class='tec-button-on' href='<?php echo sp_get_gridview_link(); ?>'><?php _e('Calendar', $sp_ecp->pluginDomain)?></a>

			</span>
            
            </div><!-- .sub-tec-events-calendar-headers  -->

		</div><!-- tec-events-calendar-header -->
		<?php sp_calendar_grid(); // See the views/table.php template for customization ?>
		<a title="<?php esc_attr_e('iCal Import', $sp_ecp->pluginDomain) ?>" class="ical" href="<?php echo sp_get_ical_link(); ?>"><?php _e('iCal Import', $sp_ecp->pluginDomain) ?></a>

        </div><!-- #tec-content.grid -->
	</div><!-- .calendar -->
	
</div><!-- #articles -->
<div class="event-key">
		<div class="event-key-m">
			<div class="event-key-inner">
				<strong>Calendar Key</strong>
				<ul>
					<li class="blue"><a href="<?php echo get_bloginfo('siteurl')?>/calendar/category/events/">Events</a></li>
					<li class="orange"><a href="<?php echo get_bloginfo('siteurl')?>/calendar/category/seminars/">Seminars</a></li>
					<li class="green"><a href="<?php echo get_bloginfo('siteurl')?>/calendar/category/important-dates/">Important Dates</a></li>
				</ul>
			</div>
		</div>
		<div class="event-key-b"></div>
	</div><!-- .event-key -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

<?php
    echo stripslashes(sp_get_option('spEventsAfterHTML'));
	//get_footer();
?>