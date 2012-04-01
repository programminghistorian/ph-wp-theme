<?php
/**
 * Template Name: Home Page
 *
 * A custom page template for the home page.
 */
get_header(); ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article>
    <header>
        <h1><?php the_title(); ?></h1>
    </header>
    <div class="content">
    <?php the_content(); ?>
    </div>
  </article>
  <?php endwhile; else: ?>
  <div id="not-found">
    <h1>Article Not Found</h1>
  </div>
  <?php endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

