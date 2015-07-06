<?php
// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
    'tools' => __( 'Resources Navigation', 'utchechild' ),
    'recent' => __( 'Recent Items Navigation', 'utchechild' )
) );

$before_widget = '<div class="widget %2$s">';
$after_widget = '</div>';
$before_title = '<h3>';
$after_title = '</h3>';
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'name' => 'Default Sidebar',
        'before_widget' => $before_widget,
        'after_widget' => $after_widget,
        'before_title' => $before_title,
        'after_title' => $after_title
    ));
    register_sidebar(array(
        'name' => 'Home Upcoming',
        'before_widget' => $before_widget,
        'after_widget' => $after_widget,
        'before_title' => $before_title,
        'after_title' => $after_title
    ));
}

// DETERMINE IF A PAGE IS A CHILD PAGE OF ANOTHER
function is_tree( $pid ) {      // $pid = The ID of the page we're looking for pages underneath
    global $post;               // load details about this page

    if ( is_page($pid) )
        return true;            // we're at the page or at a sub page

    $anc = get_post_ancestors( get_queried_object_id() );
    foreach ( $anc as $ancestor ) {
        if( is_page() && $ancestor == $pid ) {
            return true;
        }
    }

    return false;  // we arn't at the page, and the page is not an ancestor
}

// ADD SECOND FEATURED IMAGE
if (class_exists('MultiPostThumbnails')) {
            new MultiPostThumbnails(array(
            'label' => 'Home Page Featured Image',
            'id' => 'home-featured-image',
            'post_type' => 'post'
            )
        );
}

add_image_size('home-featured-image-thumb', 50, 50);


// ADD NEW CUSTOM IMAGE SIZE FOR HOME PAGE THUMBS
add_image_size( 'thumbnail_50x50', 50, 50, true );
add_image_size( 'thumbnail_80w', 80, 0 );

function display_highlights($_category_slug = 'research-highlights', $_count_posts = 5)
{
    $my_cat = get_category_by_slug($_category_slug);
    $highlights_query = new WP_Query('orderby=date&order=DESC&showposts='.$_count_posts.'&cat='.@$my_cat->term_id);
    if ($my_cat):
    ?>
        <div class="research-highlights">
            <h3><a href="<?php echo get_category_link($my_cat->term_id); ?>"><?php print $my_cat->name; ?></a></h3> 
    <?php
    if ($highlights_query->have_posts()):
        ?>
            <ul>
                <?php while ($highlights_query->have_posts()) :
                    $highlights_query->the_post();
                    global $post;
                    ?>
                    <li>
                        <div class="img">
                            <a href="<?php the_permalink(); ?>"><?php // Show featured image, or first image if no featured, or YouTube thumbnail
                                    if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('post', 'home-featured-image')) { MultiPostThumbnails::the_post_thumbnail('post', 'home-featured-image', NULL, 'home-featured-image-thumb'); 
                        } elseif (function_exists('vp_get_thumb_url')) { 
                                    $thumb=vp_get_thumb_url($post->post_content, 'thumbnail_50x50');  
                                        if ($thumb!='') { 
                                            ?>
                                        
                                        <img class="alignleft" src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" />
                                    <?php }
                                    }
                                ?>
                                <?php //the_post_thumbnail( 'thumbnail_50x50' ); ?><span class="shape"></span></a>
                        </div>
                        <div class="txt">
                            <p><a class="read-more-title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <a class="lnk-more" href="<?php echo get_category_link($my_cat->term_id); ?>">more</a>
    <?php else: ?> <p>There are no <?php print $my_cat->name; ?> at this time.</p><p>Please check back again soon.</p> 
    <?php
    endif; 
     ?>
        </div>
<?php else: ?> <div class="research-highlights"><h3><?php print $my_cat->name; ?></h3><p>The category name has been changed. Please change back to restore feed.</p></div>
<?php endif; 
}

function display_research_highlights($_category_slug = 'research-highlights', $_count_posts = 5)
{
    $cat = get_category_by_slug($_category_slug);
    $research_query = new WP_Query('orderby=date&order=DESC&showposts='.$_count_posts.'&cat='.@$cat->term_id);
    if ($cat):
    ?>
        <div class="research-highlights">
            <h3><a href="<?php echo get_category_link($cat->term_id); ?>"><?php print $cat->name; ?></a></h3>   
    <?php
    if ($research_query->have_posts()):
        ?>
            <ul>
                <?php while ($research_query->have_posts()) :
                    $research_query->the_post();
                    global $post;
                    ?>
                    <li>
                        <div class="img">
                            <a href="<?php the_permalink(); ?>"><?php // Show featured image, or first image if no featured, or YouTube thumbnail
                                    if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('post', 'home-featured-image')) { MultiPostThumbnails::the_post_thumbnail('post', 'home-featured-image', NULL, 'home-featured-image-thumb'); 
                        } elseif (function_exists('vp_get_thumb_url')) { 
                                    $thumb=vp_get_thumb_url($post->post_content, 'thumbnail_50x50');  
                                        if ($thumb!='') { 
                                            ?>
                                        
                                        <img class="alignleft" src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" />
                                    <?php }
                                    }
                                ?>
                                <?php //the_post_thumbnail( 'thumbnail_50x50' ); ?><span class="shape"></span></a>
                        </div>
                        <div class="txt">
                            <p><a class="read-more-title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <a class="lnk-more" href="<?php echo get_category_link($cat->term_id); ?>">more</a>
    <?php else: ?> <p>There are no Research Highlights at this time.</p><p>Please check back again soon.</p> 
    <?php
    endif; 
     ?>
        </div>
<?php else: ?> <div class="research-highlights"><h3><a href="">RESEARCH HIGHLIGHTS</a></h3><p>The category name has been changed. Please change back to restore feed.</p></div>
<?php endif; 
}

function display_recent_awards($_category_slug = 'recent-awards', $_count_posts = 3)
{
    $cat = get_category_by_slug($_category_slug);
    $awards_query = new WP_Query('orderby=date&order=DESC&showposts='.$_count_posts.'&cat='.@$cat->term_id);
    if ($cat):
    ?>
        <div class="recent-awards">
            <h3><a href="<?php echo get_category_link($cat->term_id); ?>"><?php print $cat->name; ?></a></h3>
    <?php
    if ($awards_query->have_posts()):
        ?>
            <ul>
                <?php
                while ($awards_query->have_posts()) :
                    $awards_query->the_post();
                    global $post;
                    ?>
                    <li>
                        <div class="img">
                            
                        <a href="<?php the_permalink(); ?>"><?php // Show featured image, or first image if no featured, or YouTube thumbnail
                                    if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('post', 'home-featured-image')) { MultiPostThumbnails::the_post_thumbnail('post', 'home-featured-image', NULL, 'home-featured-image-thumb'); 
                        } elseif (function_exists('vp_get_thumb_url')) { 
                                    $thumb=vp_get_thumb_url($post->post_content, 'thumbnail_50x50');  
                                        if ($thumb!='') { 
                                            ?>
                                        
                                        <img class="alignleft" src="<?php echo $thumb; ?>" alt="<?php get_the_title(); ?>" />
                                    <?php }
                                    }
                                ?>
                                <?php //the_post_thumbnail( 'thumbnail_50x50' ); ?><span class="shape"></span></a>
                        </div>
                        <div class="txt">
                            <p><a class="read-more-title-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <a class="lnk-more" href="<?php echo get_category_link($cat->term_id); ?>">more</a>
    <?php else: ?> <p>There are no Recent Awards at this time.</p><p>Please check back again soon.</p> 
    <?php
    endif; 
     ?>
        </div>
<?php else: ?> <div class="recent-awards"><h3><a href="">RECENT AWARDS</a></h3><p>The category name has been changed. Please change back to restore feed.</p></div>
<?php endif; 
}




function cal_cur_category() {
    $catag = '';
    foreach((get_the_category()) as $category) { $categ .= 'cat_' . $category->cat_name . ' ';}
    return $categ;
}
?>