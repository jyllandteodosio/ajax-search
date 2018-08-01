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

// This file handles single entries, but only exists for the sake of child theme forward compatibility.

add_filter( 'genesis_post_info', 'remove_post_info_exclude_news_category' );
function remove_post_info_exclude_news_category($post_info) {
    if (!get_field('author')) { 
        $post_info = '[post_date] by ' . get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
        return $post_info;
    } else {
        $post_info = '[post_date] by ' . get_field('author');
        return $post_info;
    }
}

genesis();