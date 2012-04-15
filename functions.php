<?php

function ph_add_link_to_title($title) {
    global $post;

    if (in_the_loop() && !is_singular()) {
      $title = '<a href="'.get_permalink().'" rel="bookmark">'.$title.'</a>';
    }

    return $title;
}

add_filter('the_title', 'ph_add_link_to_title');
