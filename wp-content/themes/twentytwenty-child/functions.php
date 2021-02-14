<?php

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
function my_theme_enqueue_styles()
{
  wp_enqueue_style(
    'twentytwenty-child',
    get_stylesheet_uri()
  );
}
