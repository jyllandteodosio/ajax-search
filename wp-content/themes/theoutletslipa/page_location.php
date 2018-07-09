<?php

// Template Name: How to get there

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop', 'location_content');
function location_content() {
    get_template_part('template/content', 'location');
}

add_action('genesis_sidebar', 'contact_sidebar');
function contact_sidebar() {
    get_template_part('template/sidebar', 'map');
}

genesis();