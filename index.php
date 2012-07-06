<?php get_header(); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <article>
            <header>
                <?php if (!is_page()): ?>
                <p class="kicker"><?php echo the_time('F j, Y'); ?></p>
                <?php endif; ?>
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
            <?php if (is_single()): ?>
            <footer>
              <div class="author-info">
                <a class="author-picture" href="<?php echo get_the_author_meta('user_url'); ?>"><?php echo get_avatar(get_the_author_meta('ID'),120); ?></a>
                <p class="author-name">By <?php echo(get_the_author_meta('user_firstname') . ' ' . get_the_author_meta('user_lastname')); ?></p>
                <?php if ($description = get_the_author_meta('user_description')): ?>
                <div class="author-description"><?php echo wpautop($description); ?></div>
                <?php endif; ?>
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="all-posts">See all posts by <?php echo get_the_author_meta('user_firstname'); ?></a>
              </div>
            </footer>
            <?php endif; ?>
          </article>

        <?php if (is_single()): ?>
				<ul id="nav-below" class="navigation pager">
          <li class="previous">
          <p class="kicker">Previous</p>
          <?php previous_post_link(); ?></li>
          <li class="next">
          <p class="kicker">Next</p>
          <?php next_post_link(); ?></li>
        </ul><!-- #nav-below -->
        <?php endif; ?>

      <?php endwhile; ?>
<?php if (is_paged()): ?>
<nav id="pagination">
    <ul>
        <li id="older"><?php next_posts_link(__('&laquo;Older Entries')); ?></li>
        <li id="newer"><?php previous_posts_link(__('Newer Entries&raquo;')); ?></li>
    </ul>
</nav>
<?php endif; ?>
      <?php else: ?>
          <div id="not-found">
              <h1>Article Not Found</h1>
          </div>
    <?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
