<?php

function ph_add_link_to_title($title) {
    global $post;

    if (in_the_loop() && !is_singular()) {
      $title = '<a href="'.get_permalink().'" class="permalink" rel="bookmark">'.$title.'</a>';
    }

    return $title;
}

add_filter('the_title', 'ph_add_link_to_title');

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
