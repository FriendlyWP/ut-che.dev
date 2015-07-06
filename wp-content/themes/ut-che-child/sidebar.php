<?php

/**
 * @author Michelle McGinnis
 * @copyright 2011
 */

?>

<div id="sidebar">
    <?php if (function_exists('simple_section_nav')) { ?>
    <div class="widget simple-section-nav">
        <?php if (is_tree(239)) { 
                simple_section_nav('before_widget=&after_widget=&before_title=<h2>&after_title=</h2>&sort_by=title'); 
        } else {
                simple_section_nav('before_widget=&after_widget=&before_title=<h2>&after_title=</h2>&sort_by=menu_order'); 
        }?>
    </div><!-- .simple-section-nav -->
    <?php } ?>
    <div class="side-nav-hold">
                
                <h2>New in ChE</h2>
                <ul class="events-sidebar">
                    <?php wp_nav_menu( array(  'theme_location' => 'recent' ) ); ?>
                </ul>
                
                <h2>Resources</h2>
                <ul class="bord-orange">
                <?php wp_nav_menu( array(  'theme_location' => 'tools' ) ); ?>
                </ul>    

    </div>
</div>