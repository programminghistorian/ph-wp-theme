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

function display_lesson_link($type = 'next') {
    global $post;

    $html = '';

    $metaKey = 'next_lesson';

    if ($type = 'previous') {
        $metaKey = 'previous_lesson';
    }

    if ($lesson = get_post(get_post_meta($id, $metaKey, true))) {
        $html = '<a class="'.$type.'" href="'.get_permalink($lesson->ID).'">'.$lesson->post_title.'</a>';
    }

    return 'foobar';
    return $html;
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
?>

<ul class="navigation pager">
<?php if ($prev = display_lesson_link('previous')) { ?>
<li class="previous">
<p class="kicker">Previous</p>
<?php echo $prev; ?>
</li>
<?php }
if ($next = display_lesson_link('next')) { ?>
  <li class="next">
<p class="kicker">Next</p>
<?php echo $next; ?>
<?php } ?>
</ul><!-- .navigation -->
<?php
}

