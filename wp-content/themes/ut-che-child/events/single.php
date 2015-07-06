<?php //get_header(); ?>

    <div id="articles">

            <div class="entry">
                <h2 class="entry-title"><?php the_title() ?></h2>
                <?php if (tribe_get_end_date() > time()  ) { ?><small><?php  _e('This event has passed.', $tribe_ecp->pluginDomain) ?></small> <?php } ?>
				<div id="tec-event-meta">
					<dl>
						<dt><?php _e('WHEN:', $tribe_ecp->pluginDomain) ?></dt> 
							<dd><?php echo tribe_get_start_date(); ?>
						<?php if (tribe_get_start_date() !== tribe_get_end_date() ) { ?>
							<?php _e(' - ', $tribe_ecp->pluginDomain) ?><?php echo tribe_get_end_date();  ?>						
						<?php } ?>
                        </dd>
						<?php if ( tribe_get_cost() ) : ?>
							<dt><?php _e('Cost:', $tribe_ecp->pluginDomain) ?></dt>
							<dd><?php echo tribe_get_cost(); ?></dd>
						<?php endif; ?>
						<?php //tribe_meta_event_cats(); ?>
						<?php if ( tribe_get_organizer_link() ) : ?>
							<dt><?php _e('Organizer:', $tribe_ecp->pluginDomain) ?></dt>
							<dd><?php echo tribe_get_organizer_link(); ?></dd>
						<?php endif; ?>
						<?php if ( tribe_get_organizer_phone() ) : ?>
							<dt><?php _e('Phone:', $tribe_ecp->pluginDomain) ?></dt>
							<dd><?php echo tribe_get_organizer_phone(); ?></dd>
						<?php endif; ?>
						<?php if ( tribe_get_organizer_email() ) : ?>
							<dt><?php _e('Email:', $tribe_ecp->pluginDomain) ?></dt>
							<dd><?php echo tribe_get_organizer_email(); ?></dd>
						<?php endif; ?>
						<?php if ( tribe_is_recurring_event() ) : ?>
							<dt><?php _e('Schedule:', $tribe_ecp->pluginDomain) ?></dt>
							<dd><?php echo tribe_get_recurrence_text(); ?> (<a href='<?php tribe_all_occurences_link() ?>'>See all</a>)</dd>
						<?php endif; ?>
					</dl>
                    <?php if(tribe_get_venue() || tribe_get_phone() || tribe_address_exists( get_the_ID() )) { ?>
					<dl>
                        <dt>WHERE:</dt>
                        <dd>
						<?php if(tribe_get_venue()) : ?>
						<?php _e('', $tribe_ecp->pluginDomain) ?></dt> 
							<?php echo tribe_get_venue(get_the_ID(), true); ?>
                            <br />
						<?php endif; ?>
						<?php if(tribe_get_phone()) : ?>
						<?php _e('Phone:', $tribe_ecp->pluginDomain) ?> 
							<?php echo tribe_get_phone(); ?>
                            <br />
						<?php endif; ?>
						<?php if( tribe_address_exists( get_the_ID() ) ) : ?>
                        
							<?php _e('', $tribe_ecp->pluginDomain) ?>
							                           
							<?php tribe_the_full_address( get_the_ID() ); ?>
                            
                            <?php if( get_post_meta( get_the_ID(), '_EventShowMapLink', true ) == 'true' ) : ?>
								<a class="gmap" href="<?php tribe_the_map_link() ?>" title="<?php _e('Click to view a Google Map', $tribe_ecp->pluginDomain); ?>" target="_blank"><?php _e('Google Map', $tribe_ecp->pluginDomain ); ?></a>
							<?php endif; ?>
							</dd>
						<?php endif; ?>
					</dl>
                    <?php } ?>
				</div>

				<?php if( get_post_meta( get_the_ID(), '_EventShowMap', true ) == 'true' ) : ?>
					<?php if( tribe_address_exists( get_the_ID() ) ) tribe_the_embedded_map(); ?>
				<?php endif; ?>
				<div class="entry">
					
					<?php the_content() ?>	
					<?php if (function_exists('tribe_get_ticket_form')) { tribe_get_ticket_form(); } ?>		
				</div>
				<a class="ical single" href="<?php echo tribe_get_single_ical_link(); ?>"><?php _e('iCal Import', $tribe_ecp->pluginDomain); ?></a>
				<a href="<?php echo tribe_get_add_to_gcal_link() ?>" class="gcal-add" title="<?php _e('Add to Google Calendar', $tribe_ecp->pluginDomain); ?>"><?php _e('+ Google Calendar', $tribe_ecp->pluginDomain); ?></a>
				<div class="navlink previous"><?php tribe_previous_event_link();?></div>

				<div class="navlink next"><?php tribe_next_event_link();?></div>
				<div style="clear:both"></div>
        </div><!-- .entry -->
 </div><!-- #articles -->