<?php

function ph_add_link_to_title($title) {
    global $post;

    if (in_the_loop() && !is_singular()) {
      $title = '<a href="'.get_permalink().'" rel="bookmark">'.$title.'</a>';
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
        $content = ph_display_page_children($post);
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
                $html .= '<li><a href="'.get_permalink(get_the_ID()).'" class="permalink">'.get_the_title().'</a> – '.get_the_excerpt().'</li>';
            }
            $html .= '</ul>';
        }

        wp_reset_query();
    }

    return $html;
}
