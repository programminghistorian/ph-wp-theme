<?php get_header(); ?>
<h1>Lessons</h1>
<ul class="lessons">
<?php wp_list_pages('post_type=lesson&title_li='); ?>
</ul>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

