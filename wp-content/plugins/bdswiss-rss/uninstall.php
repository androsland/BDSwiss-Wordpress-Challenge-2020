<?php

/**
 * @package BDSwissRSS
 * @version 1.0.0
 */

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ){
  die;
}

$bdswissRSS = get_posts(
  array(
    'post_type' => 'bdswiss_rss',
    'numberposts' => -1
  )
);

foreach ($bdswissRSS as $rss) {
  wp_delete_post( $rss->ID, true );
}