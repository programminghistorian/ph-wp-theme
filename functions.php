<?php

function ph_add_link_to_title($title) {
    global $post;

    if (!is_single() && !is_page()) {
        $title = '<a href="'
               . get_permalink()
               . '">'
               . $title
               . '</a>';
    }
    return $title;
}

add_filter('the_title', 'ph_add_link_to_title');