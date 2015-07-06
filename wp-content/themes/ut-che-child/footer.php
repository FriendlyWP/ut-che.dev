              </div><!-- .wrap -->
        </div><!-- #content -->
        
        <footer id="footer" class="source-org vcard copyright">
            <div class="wrap">

              <?php if ( has_nav_menu( 'footer' ) ) { ?>
                  <?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'footer' ) ); ?>

              <?php } else { ?>

	           <ul class="social">
              <li><a class="nav-twitter" href="http://twitter.com/CockrellSchool">twitter</a></li>
              <li><a class="nav-facebook" href="http://www.facebook.com/CockrellSchool">facebook</a></li>
                      <li><a class="nav-youtube" href="http://www.youtube.com/CockrellSchool">youtube</a></li>
                      <li><a class="nav-linkedin" href="http://www.linkedin.com/groups?gid=804467">linkedin</a></li>
            </ul>
            <div class="foot-nav">
              <div class="hold">
                <ul>
                  <li><a href="/contact-us/">Contact Us</a></li>
                  <li><a href="/sitemap/">Site Map</a></li>
                  <li><a href="/calendar/">Calendars</a></li> 
                  <li><a href="http://www.utexas.edu/web-privacy-policy">Privacy Policy</a></li>
                  <li><a href="http://www.utexas.edu/web-accessibility-policy">UT Accessibility</a></li>
                  <li><a href="http://www.utexas.edu/">UT Austin Home</a></li>        
                </ul>
              </div>
            </div>
            <?php } ?>
            
            <div class="copyright">
              <p>&copy; <?php echo date('Y'); ?> <a target="_blank" href="http://www.engr.utexas.edu/">Cockrell School of Engineering</a></p>
              <p><a target="_blank" href="http://www.utexas.edu/">The University of Texas at Austin</a></p>
            </div>

            
            </div><!-- #wrap -->
		</footer><!-- #footer -->

	<?php wp_footer(); ?>
	
</body>

</html>
