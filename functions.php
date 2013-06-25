<?php

register_nav_menu( 'footer_additional', __( 'Main Menu' ) );

function ph_list_lessons() {

  $html = '';

  if ($lessons = get_page_by_title('Lessons') ) {
    $html = '<div class="lessons">'
          . '<ul>'
          . wp_list_pages('child_of='.$lessons->ID.'&echo=0&title_li=')
          . '</ul>'
          . '</div>';
  }

  return $html;

}

function ph_lesson_content($content) {
    global $post;

    if ($post->post_title == 'Lessons') {
        $content = '<div class="lessons-list">'.ph_display_page_children($post).'</div>';
    }

    return $content;
}

add_filter('the_content', 'ph_lesson_content');

/**
 * Filters page content to display a list of page children.
 */
function ph_display_page_children($post)
{

    $html = '';
    if ($post) {
        $args = array(
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_parent' => $post->ID,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'nopaging' => true,
        );

        query_posts($args);

        if (have_posts()) {
            $html = '<ul class="page-children ph-page-children">';
                while (have_posts()) {
                the_post();
                $html .= '<li>'.get_the_title().' · '.get_the_excerpt().'</li>';
            }
            $html .= '</ul>';
        }

        wp_reset_query();
    }

    return $html;
}
add_action( 'init', 'ph_add_page_excerpt' );

function ph_add_page_excerpt() {
  add_post_type_support( 'page', 'excerpt' );
}

function is_lesson() {
  global $post;

  // Get the Lesson page by title. If we change the title of the Lessons page,
  // we'll need to change this query.
  $lessonPage = get_page_by_title('Lessons');

  if (in_array($lessonPage->ID, get_post_ancestors($post->ID))) {
    return true;
  }

  return false;
}

function get_previous_lesson($id) {
  $args = array(
    'post_type' => 'page',
    'meta_key' => 'link_to_next_lesson',
    'meta_value' => $id
  );

    $previousLessons = new WP_Query($args);

    while ($previousLessons->have_posts()) {
      $previousLessons->next_post();
      $array[] = $previousLessons->post->ID;
    }

    return $array[0];
}

function get_next_lesson($id) {
    return get_post_meta($id, 'link_to_next_lesson', true);
}

add_action('init', 'ph_create_post_type');

function ph_create_post_type() {

    $labels = array(
        'name' => 'Lessons',
        'singular_name' => 'Lesson'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'rewrite' => array(
            'with_front' => false,
            'slug' => 'lessons'
        ),
        'supports' => array('title', 'editor', 'author', 'custom-fields', 'page-attributes', 'comments', 'excerpt')
    );
    register_post_type('lesson', $args);

}


add_action('init', 'ph_create_lesson_taxonomies', 0);

function ph_create_lesson_taxonomies() {

    $topicsArgs = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Lesson Topics',
            'singular_name' => 'Lesson Topic'
        )
    );

    register_taxonomy('lesson_topics', array('lesson'), $topicsArgs);
}

function ph_rewrite_flush() {
    flush_rewrite_rules();
}

add_action( 'after_switch_theme', 'ph_rewrite_flush' );

function ph_lesson_pager() {
  global $post;
$posts = get_pages("post_type=lesson&post_status=published&sort_column=menu_order");
$pages = get_page_hierarchy($posts);
$pages = array_keys($pages);

$current = array_search($post->ID, $pages);
$prevId = $pages[$current - 1];
$nextId = $pages[$current + 1];

?>

<ul class="navigation pager">
<?php if (!empty($prevId)) { ?>
<li class="previous">
<p class="kicker">Previous</p>
<a href="<?php echo get_permalink($prevId); ?>"><?php echo get_the_title($prevId); ?></a>
</li>
<?php }
if (!empty($nextId)) { ?>
  <li class="next">
<p class="kicker">Next</p>
<a href="<?php echo get_permalink($nextId); ?>"><?php echo get_the_title($nextId); ?></a></li>
<?php } ?>
</ul><!-- .navigation -->
<?php
}
