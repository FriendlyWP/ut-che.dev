<?php
/*
Template Name: Home Page Template
*/
?><?php get_header(); ?>
    <div class="hold clearfix">
        <div class="side-nav-hold">
            <h2>Resources</h2>
            <ul class="bord-orange">
            <?php wp_nav_menu( array(  'theme_location' => 'tools' ) ); ?>
            </ul>
        </div><!-- .side-nav-hold -->
                
        <script type="text/javascript" language="javascript">
            jQuery(document).ready(function($) {
                $('.flexslider').flexslider({
                  animation: "slide",
                  slideshowSpeed: 16000,
                  controlsContainer: ".flex-container"
                });


                $("ul#js-news").liScroll({travelocity: .05});
                $(".at-a-glance").css("visibility", "visible");
                $(".flexslider").css("visibility", "visible");
        });
        </script>
        <?php query_posts(array('category_name' => 'gallery', 'posts_per_page' => 10, 'order' => 'DESC')) ?>
        
        <div class="flexslider">
            <ul class="slides">
            <?php while ( have_posts() ) : the_post(); ?>
            <?php $excerpt = get_the_excerpt(); ?>
                <?php
                // SET UP THUMBNAIL STUFF TO USE WITH POSTS
                if (function_exists('vp_get_thumb_url')) {
                    // Set the desired image size. Swap out 'thumbnail' for 'medium', 'large', or custom size
                    $thumb=vp_get_thumb_url($post->post_content, 'gallery-image'); 
                }
                ?>
                <li>
                    <div class="img">
                        <?php if ($thumb!='') { ?>
                            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><img src="<?php echo $thumb; ?>" alt="<?php echo the_title_attribute( 'echo=0' ); ?>" /></a>
                        <?php } ?>
                    </div><!-- .img -->
                    <div class="fade">
                        <div class="copy">
                            <div class="text">
                            <h2><?php the_title(); ?></h2>
                            
                            <p><?php echo string_limit_words($excerpt,30); ?><br /><a class="readmorelink" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">&raquo;&nbsp;Read more</a></p>
                            </div><!-- .text -->
                        </div><!-- .copy -->
                    </div>
                </li>
            <?php endwhile;

            // Reset Query
            wp_reset_query();
            ?>
            </ul><!-- .slider -->
        </div><!-- .flexslider -->
    </div><!-- .hold.clearfix -->
<div class="blocks">
    <?php
                    // DISPLAY AT A GLANCE KUDOS
                   $args = array (
                    'post_type'              => 'at-a-glance',
                    'post_status'            => 'publish',
                    'orderby'                => 'rand',
                    'posts_per_page'         => '10',
                    );
                        // The Query
                    $aag_query = new WP_Query( $args );

                    // The Loop
                    if ( $aag_query->have_posts() ) {
                        echo '<div class="at-a-glance"><h4>Did you know?</h4><ul id="js-news" class="js-hidden">';
                        while ( $aag_query->have_posts() ) {
                            $aag_query->the_post();

                            echo '<li class="news-item"><span>' . get_the_title() . '</span></li>';
                            
                        }
                        echo '</ul></div>';
                    } else {
                        // no posts found
                    }

                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>


           
            <div class="features">
                    
                
                <?php display_highlights('research-highlights', 5); ?>
                
                <?php display_highlights('recent-awards', 5); ?>
                
                <?php 
                    // DISPLAY PUBLICATIONS
                   $args = array (
                    'post_type'              => 'publications',
                    'post_status'            => 'publish',
                    'orderby'                => 'rand',
                    'posts_per_page'         => '5',
                    );
                        // The Query
                    $pubs_query = new WP_Query( $args );

                    // The Loop
                    if ( $pubs_query->have_posts() ) {
                        echo '<div class="research-highlights full-width"><ul>';
                        echo '<h3><a href="/publications">Recent Publications</a></h3>';
                        while ( $pubs_query->have_posts() ) {
                            $pubs_query->the_post();
                            //$journal_link = get_post_meta( get_the_ID(), 'journal_link', true );

                            echo '<li><a class="read-more-title-link" href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                            
                        }
                        echo '</ul><a class="lnk-more" href="/publications">more</a></div>';
                    } else {
                        // no posts found
                    }

                    // Restore original Post Data
                    wp_reset_postdata();
                    ?>
        </div><!-- .features -->
</div><!-- .blocks -->

<div class="features side">
        <?php
            // DISPLAY FACULTY
                   $args = array (
                    'post_type'              => 'faculty',
                    'post_status'            => 'publish',
                    'orderby'                => 'rand',
                    'posts_per_page'         => '1',
                    );
                        // The Query
                    $faculty_query = new WP_Query( $args );

                    // The Loop
                    if ( $pubs_query->have_posts() ) {
                        echo '<div class="research-highlights fac"><ul>';
                        echo '<h3><a href="/faculty-staff/faculty-directory/">Meet our Faculty</a></h3><span>';
                        while ( $faculty_query->have_posts() ) {
                            $faculty_query->the_post();
                            $fac_last_name = get_post_meta( get_the_ID(), 'fac_last_name', true );
                            $fac_role = get_post_meta( get_the_ID(), 'fac_role', true );
                            $fac_field = get_post_meta( get_the_ID(), 'fac_field', true );
                            $fac_interests = get_post_meta( get_the_ID(), 'fac_interests', true );
                            $link_to_profile_page = get_post_meta( get_the_ID(), 'link_to_profile_page', true );
                            $fac_thumb = get_the_post_thumbnail($faculty_query->get_queried_object_id(), 'thumbnail_80w');
                            if ( has_post_thumbnail()) {
                               $fac_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($faculty_query->get_queried_object_id()), 'thumbnail_80w'); 
                             }

                            if ( $link_to_profile_page ) {
                                $link = $link_to_profile_page;
                            } else {
                                $link = $fac_thumb[0];
                            }

                            echo '<a href="' . $link . '" title="' . the_title_attribute('echo=0') . '" class="alignleft">' . get_the_post_thumbnail($post->ID, 'thumbnail_80w') . '</a><h5>' . get_the_title() . '</h5><p>' . $fac_role . ' ' . $fac_last_name . ' works in ' . $fac_field . ' with specific interests in ' . $fac_interests . '.</p></span></ul><a class="lnk-more" href="/faculty-staff/faculty-directory/">Visit our faculty directory</a></div>';
                            
                        }
                       
                    } else {
                        // no posts found
                    }

                    // Restore original Post Data
                    wp_reset_postdata();
        ?>
            <div class="upcoming-events">
          <?php dynamic_sidebar( 'Home Upcoming' ) ?>
          </div><!-- .upcoming-events -->
</div><!-- .features.side -->
         
           
                    
    
<?php get_footer(); ?>
