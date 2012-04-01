<?php get_header(); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <article>
            <header>
                <h1><?php the_title(); ?></h1>
            </header>
            <div class="content">

            <?php
              if (is_single() || is_page()) {  
                the_content();
              } else {
                the_excerpt();
              }
            ?>
            </div>
          </article>
      <?php endwhile; else: ?>
          <div id="not-found">
              <h1>Article Not Found</h1>
          </div>
    <?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
