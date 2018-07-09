<?php

//Template Name: Promos & Events


remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop', 'shop_query');
function shop_query() {
    get_template_part('template/query', 'promos');
}

genesis();