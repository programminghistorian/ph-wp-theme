<?php get_header(); ?>
<h1>Lessons</h1>
<?php
global $wp_query;

$categories = get_categories(array('taxonomy' => 'lesson_topics'));

// This is ugly terrible.

foreach ($categories as $category) {
    echo '<section class="'.$category->slug.' category">';
    echo "<h2>".$category->name."</h2>";
    $args = array_merge( $wp_query->query_vars, array('post_parent' => 0, 'lesson_topics' => $category->slug));
    query_posts( $args );
    if ( have_posts() ):
      echo '<ul class="lessons">';
      while( have_posts() ) : the_post();
        echo '<li>';
        the_title();
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

