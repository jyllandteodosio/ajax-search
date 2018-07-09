<?php

// Template Name: Aboitiz Pitch

add_action('genesis_loop', 'location_content');
function location_content() {
    get_template_part('template/content', 'booking');
}

genesis();