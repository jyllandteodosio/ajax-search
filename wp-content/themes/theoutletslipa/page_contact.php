<?php

// Template Name: Contact

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop', 'contact_content');
function contact_content() {
    echo '<div class="wrap">';
        get_template_part('template/content', 'contact');
        get_template_part('template/sidebar', 'contact');
    echo '</div>';
}

add_action('genesis_sidebar', 'contact_sidebar');
function contact_sidebar() {
}



genesis();