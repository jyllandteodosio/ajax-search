<?php

// Template Name: Aboitiz Pitch
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop', 'location_content');
function location_content() {
    echo '<div class="wrap">';
        get_template_part('template/content', 'pitch');
        get_template_part('template/content', 'booking');
    echo '</div>';
}

genesis();