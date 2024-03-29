<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Genesis\Templates
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/genesis/
 */

add_action( 'genesis_after_header', 'genesis_do_search_title' );
/**
 * Echo the title with the search term.
 *
 * @since 1.9.0
 */
function genesis_do_search_title() {
    echo '<section class="inner-banner"><div class="wrap">';
	$title = sprintf( '<h1 class="entry-title">%s %s</h1>', apply_filters( 'genesis_search_title_text', __( 'Search Results for:', 'genesis' ) ), get_search_query() );

	echo apply_filters( 'genesis_search_title_output', $title ) . "\n";
    echo '</div></section>';
}

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 1 );

add_filter( 'genesis_post_info', 'remove_post_meta_home_page' );
function remove_post_meta_home_page($post_info) {
    if ( 'outlets' == get_post_type() ) {
        $post_info = '';
        return $post_info;
    } else {
        $post_info = '[post_date] by [post_author_posts_link] [post_comments] [post_edit]';
        return $post_info;
    }
}

add_action('genesis_entry_content', 'add_fields');
function add_fields() {
    if ( 'outlets' == get_post_type() ) {
        echo '<ul class="outlet-archive">';
            echo '<li><i class="fas fa-clock-o"></i>';
                echo get_field('time');
            echo '</li>';
           
            echo '<li><i class="fas fa-phone"></i>';
                echo get_field('phone');
            echo '</li>';
            echo '<li><i class="fas fa-map-marker"></i>';
                echo get_field('location');
            echo '</li>';
            echo '<li><i class="fas fa-tag"></i>';
        
            $custom_taxonomy = the_terms( $post->ID, 'outlet_category');
                                    
                if( $custom_taxonomy ) {
                    foreach ( $custom_taxonomy as $term ) {
                      echo $term->name;
                    }
                }
            echo '</li>';
        
        
        echo '</ul>';
    }
}

add_filter( 'genesis_link_post_title', 'unlink_post_title' );
function unlink_post_title() {
    if ( 'outlets' == get_post_type() ) {
        return false;
    }
}

genesis();
