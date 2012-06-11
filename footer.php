</div>
<footer role="contentinfo">
<?php echo ph_list_lessons(); ?>
<?php wp_nav_menu( array( 'theme_location' => 'footer_additional', 'depth' => 1, 'container_class' => 'additional', 'menu_class' => 'additional'  ) ); ?>

</footer>
<?php wp_footer(); ?>
</body>
</html>
