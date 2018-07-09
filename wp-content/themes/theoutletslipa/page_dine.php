<?php

//Template Name: Dine


remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_loop', 'shop_query');
function shop_query() {
    get_template_part('template/query', 'dine');
}

genesis();