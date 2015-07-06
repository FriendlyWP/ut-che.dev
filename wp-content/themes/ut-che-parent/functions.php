<?php
	
	// Add RSS links to <head> section
	add_theme_support('automatic-feed-links');

add_action( 'wp_enqueue_scripts', 'my_theme_styles', 2 );
function my_theme_styles() {
  // wp_register_style( 'theme_stylesheet', get_stylesheet_uri(),'','','');
  wp_enqueue_style( 'theme_stylesheet', get_stylesheet_uri(),'','','');
}

add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_front_page_scripts' );
function mytheme_enqueue_front_page_scripts() {

   
       if( !is_admin() ) {
     // REGISTER AND ENQUEUE LOCAL FUNCTIONS.JS FILE 

          wp_register_script('modernizr', get_template_directory_uri() . '/_/js/modernizr-1.7.min.js',
             array('jquery'), '');
             
          wp_enqueue_script( 'modernizr');

           wp_register_script('my_functions', get_template_directory_uri() . '/_/js/functions.js',
             array('jquery'), '', true );
             
         wp_enqueue_script( 'my_functions' );
          $data = array( 'my_home_url' => __( home_url() ) );
          wp_localize_script( 'my_functions', 'my_home_object', $data );
          
          wp_register_script('prefixfree', get_template_directory_uri() . '/_/js/prefixfree.js', '', '', true);
             
          wp_enqueue_script( 'prefixfree');
        

          if (is_front_page() || is_home()) {
            // REGISTER AND ENQUEUE FLEXSLIDER JS AND CSS 

               wp_register_script( 'ticker_js', get_stylesheet_directory_uri() . '/js/ticker/li-scroller.js',array('jquery'), '', true);
               wp_enqueue_script( 'ticker_js' );

               wp_register_style( 'flexslider_css', get_template_directory_uri() . '/_/js/flexslider/flexslider.css','','','');
               wp_enqueue_style( 'flexslider_css');
               
              
               wp_register_script('flexslider', get_template_directory_uri() . '/_/js/flexslider/jquery.flexslider-min.js', array('jquery') );
               wp_enqueue_script( 'flexslider','','',true );
 
       } 
    } 

}

   
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }
    
    // add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.
    
    // Enable featured images
    add_theme_support( 'post-thumbnails');
    
    // Add featured image size for home feature
    add_image_size( 'home-feature', 1160, 300, true );
    add_image_size( 'post-feature', 882, 168, true );
    
    /**
     * Remove inline styles printed when the gallery shortcode is used.
     *
     * Galleries are styled by the theme in Twenty Ten's style.css. This is just
     * a simple filter call that tells WordPress to not use the default styles.
     *
     * @since Twenty Ten 1.2
     */
    add_filter( 'use_default_gallery_style', '__return_false' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
    
    // This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'html5reset' ),
        'footer' => __( 'Footer Navigation', 'html5reset' ),
	) );

// REMOVE THE EXTRA WIDTH ADDED TO WP-CAPTION
add_filter( 'img_caption_shortcode', 'wpse14305_img_caption', 10, 3 );
function wpse14305_img_caption( $empty_string, $attributes, $content ){
  extract(shortcode_atts(array(
    'id' => '',
    'align' => 'alignnone',
    'width' => '',
    'caption' => ''
  ), $attributes));
  if ( empty($caption) )
    return $content;
  if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
  return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">' . do_shortcode( $content ) . '<p class="wp-caption-text"><span>' . $caption . '</span></p></div>';
}

// REMOVE WIDGET TITLE IF IT BEGINS WITH EXCLAMATION POINT
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '!' )
		return;
	else 
		return ( $widget_title );
}

// Note that your theme must support post thumbnails for this function to work. 
// If you are getting an error try adding add_theme_support('post-thumbnails'); to your functions. php file 
// NOTE: If $feature is set to true, the image will only be returned if it is set as a featured image.
function vp_get_thumb_url($text, $size, $feature = false){
    global $post;
    $imageurl="";
    
    // Check to see which image is set as "Featured Image"
    $featuredimg = get_post_thumbnail_id($post->ID);
    // Get source for featured image
    $img_src = wp_get_attachment_image_src($featuredimg, $size);
    // Set $imageurl to Featured Image
    $imageurl=$img_src[0];
    
    if ($feature == false) {
    
    // If there is no "Featured Image" set, move on and get the first image attached to the post
    if (!$imageurl) {
        // Extract the thumbnail from the first attached imaged
        $allimages =get_children('post_type=attachment&post_mime_type=image&post_parent=' . $post->ID );
        
        foreach ($allimages as $img){
            $img_src = wp_get_attachment_image_src($img->ID, $size);
            break;
        }
        // Set $imageurl to first attached image
        $imageurl=$img_src[0];
    }
    
    // If there is no image attached to the post, look for anything that looks like an image and get that
    if (!$imageurl) {
        preg_match('/<\s*img [^\>]*src\s*=\s*[\""\']?([^\""\'>]*)/i' , $text, $matches);
        $imageurl=$matches[1];
    }
    
    // If there's no image attached or inserted in the post, look for a YouTube video
    if (!$imageurl){
        // look for traditional youtube.com url from address bar
        preg_match("/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/watch(\?v\=|\/v\/)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2);
        $youtubeurl = $matches2[0];
        $videokey = $matches2[3];
    if (!$youtubeurl) {
        // look for youtu.be 'embed' url
        preg_match("/([a-zA-Z0-9\-\_]+\.|)youtu\.be\/([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $text, $matches2);
        $youtubeurl = $matches2[0];
        $videokey = $matches2[2];
    }
    if ($youtubeurl)
        // Get the thumbnail YouTube automatically generates
        // '0' is the biggest version, use 1 2 or 3 for smaller versions
        $imageurl = "http://i.ytimg.com/vi/{$videokey}/0.jpg";
    }
    
    }
    
    // Spit out the image path
    return $imageurl;
}

// LIMIT WORDS IN EXCERPTS
function string_limit_words($string, $word_limit) {
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
add_filter('xmlrpc_enabled','__return_false');
add_action( 'xmlrpc_call', 'callback' );
function callback($method) {
  if ( $method === 'pingback.ping' ) {
        wp_die( 'No pingbacks', 'Pingback is disabled', array( 'response' => 403 ) );
    }
}

/* MENU SOCIAL ICONS */
add_filter( 'storm_social_icons_use_latest', '__return_true' );