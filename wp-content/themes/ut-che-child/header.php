<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head id="che-utexas-edu" data-template-set="html5-reset-wordpress-theme" profile="http://gmpg.org/xfn/11">

	<meta charset="<?php bloginfo('charset'); ?>">
	
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php wp_title(); ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>

    <a accesskey="S" href="#content" class="skip">Skip Navigation</a>

		<header id="header">
            <div class="wrap">
                <div class="parents"><a target="_blank" class="cockrell-school" href="http://www.engr.utexas.edu/"><img src="<?php echo get_template_directory_uri(); ?>/_/images/cse-logo.png" alt="Cockrell School of Engineering" title="Cockrell School of Engineering" /></a><a href="http://www.utexas.edu/" target="_blank" class="ut-austin"><img src="<?php echo get_template_directory_uri(); ?>/_/images/ut-texas-logo.png" alt="The University of Texas at Austin" title="The University of Texas at Austin" /></a></div>
                <div class="main-head clearfix"><a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/_/images/che-logo-new.png" alt="McKetta Department of Chemical Engineering" title="McKetta Department of Chemical Engineering" /></a><div class="search">
                    <form action="<?php echo home_url(); ?>" id="searchform" method="get">
                        <div>
                            <label for="s" class="screen-reader-text">Search:</label>
                            <span class="input"><input type="search" id="s" name="s" value="Search" /></span>
                            <input type="submit" value="Search" id="searchsubmit" />
                        </div>
                    </form>
                </div><!-- .search --></div>
                
                <div id="access" class="clearfix"><?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?><a class="lnk-bb-login" target="_blank" href="https://courses.utexas.edu/webapps/login/">blackboard login</a></div><!-- .nav -->
            </div><!-- #wrap -->
		</header>

        <div id="content">
            <div class="clearfix wrap">
