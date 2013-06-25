<?php get_header(); ?>
<h1>Lessons</h1>
<?php

$categories = get_categories(array('taxonomy' => 'lesson_topics'));

// This is ugly terrible.

foreach ($categories as $category) {
    $categorySlug = $category->category_nicename;
    echo '<section class="'.$categorySlug.' category">';
    echo "<h2>".$category->name."</h2>";
    $args = array('lesson_topics' => $categorySlug, 'post_parent' => 0);
    query_posts( $args );
    if ( have_posts() ):
      echo '<ul class="lessons">';
      while( have_posts() ) : the_post();
        echo '<li>';
        echo '<a href="'.get_permalink().'">';
        the_title();
        echo '</a>';
        $html = wp_list_pages('echo=0&post_type=lesson&title_li=&child_of='.get_the_ID());
        if ($html) {
          echo '<ul>';
          echo $html;
          echo '</ul>';
        }
        echo '</li>';
      endwhile;
      echo '</ul>';
    endif;
    echo '</section>';
}

wp_reset_query();
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>


