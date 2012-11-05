</div>
<footer role="contentinfo">
<?php wp_nav_menu( array( 'theme_location' => 'footer_additional', 'depth' => 1, 'container_class' => 'additional', 'menu_class' => 'additional'  ) ); ?>
<p><em><?php bloginfo('name'); ?></em> released under the <a href="http://creativecommons.org/licenses/by/2.0/" rel="license">CC-BY</a> license.</p>

  <p id="logos"><a href="http://niche-canada.org/" id="niche"><img src="<?php echo get_template_directory_uri(); ?>/images/niche.jpg" title="NiCHE"></a> <a href="http://chnm.gmu.edu" id="rrchnm"><img src="<?php echo get_template_directory_uri(); ?>/images/rrchnm.png"></a></p>
</footer>
<?php wp_footer(); ?>
</body>
</html>
