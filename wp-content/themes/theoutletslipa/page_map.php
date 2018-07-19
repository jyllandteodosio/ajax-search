<?php

// Template Name: Mall Map

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop', 'map_content');
function map_content() {
    echo '<div class="wrap">';
        get_template_part('template/content', 'zoning');
    echo '</div>';
}

genesis();