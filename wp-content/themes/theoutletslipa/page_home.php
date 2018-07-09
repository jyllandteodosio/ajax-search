<?php

// Template Name: Home

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop', 'homepage_content');
function homepage_content() {
    get_template_part('template/section', 'banner');
    get_template_part('template/section', 'featuredpages');
    get_template_part('template/section', 'pitch');
    get_template_part('template/section', 'instagram');

}


genesis();