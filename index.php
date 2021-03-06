<?php get_header(); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      <?php
      $authors = get_post_meta( $post->ID , 'author(s)' , true );
      $technical_reviewer = get_post_meta( $post->ID , 'technical_reviewer' , true );
      $literary_reviewer = get_post_meta( $post->ID , 'literary_reviwer' , true );
      $markup_editor = get_post_meta($post->ID, 'markup_editor', true);
      ?>
          <article>
            <header>
                <?php if (!is_page()): ?>
                <p class="kicker"><?php echo the_time('F j, Y'); ?></p>
                <?php endif; ?>

                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <?php if ($authors): ?>
                <p class="byline">By <?php echo $authors; ?></p>
                <?php elseif (is_single()): ?>
                <p class="byline">By <?php echo get_the_author_meta('user_firstname') . ' ' . get_the_author_meta('user_lastname'); ?></p>
                <?php endif; ?>

                <?php if ($technical_reviewer || $literary_reviewer || $markup_editor): ?>
                  <ul class="credits">

                    <?php if ($technical_reviewer) : ?>
                    <li class="technical-reviewer">Technical Reviewer: <?php echo $technical_reviewer; ?></li>
                    <?php endif; ?>

                    <?php if ($literary_reviewer) : ?>
                    <li class="literary-reviewer">Literary Reviewer: <?php echo $literary_reviewer; ?>
                    <?php endif; ?>

                    <?php if ($markup_editor) : ?>
                    <li class="markup_editor">Markup Editor: <?php echo $markup_editor; ?>
                    <?php endif; ?>

                  </ul>
                <?php endif; ?>
            </header>
            <div class="content">

            <?php
              if (is_single() || is_page()) {  
                the_content();
              } else {
                the_excerpt();
              }
            ?>

            <?php if (get_post_type() == 'lesson'): ?>
              <footer>
                  <?php if ($authors_bio = get_post_meta($post->ID, 'authors_bio', true)): ?>
                        <div class="author-info">
                          <p class="author-name">About <?php echo $authors; ?></p>
                           <div class="author-description"><?php echo wpautop($authors_bio); ?></div>
                        </div>
                  <?php endif; ?>
              </footer>
            <?php comments_template(); ?>

            <?php endif; ?>

            </div>


            <?php if (is_single() && get_post_type() != 'lesson'): ?>
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
        <?php if (get_post_type() == 'lesson'): ?>
        <?php ph_lesson_pager(); ?>
        <?php elseif (is_single()): ?>
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
