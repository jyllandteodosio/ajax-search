<?php

// Template Name: Contact

add_action('genesis_sidebar', 'contact_sidebar');
function contact_sidebar() {
    get_template_part('template/sidebar', 'contact');
}

genesis();