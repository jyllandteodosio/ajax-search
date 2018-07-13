<?php
/**
 * Plugin Name:       The Outlets Lipa AJAX Search
 * Description:		  Site specific API and functionalities. 
 * Version:           1.2.2
 * Author:            Sample
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

/**
 * Initialize the plugin once loaded.
 */
add_action( 'plugins_loaded', __NAMESPACE__ . 'ajax_search_init' );

function ajax_search_init() {
}


// Setup custom routes
add_action( 'rest_api_init', function () {
    register_rest_route( 'ajax-search/v1', '/shops/ ', array(
    'methods' => 'GET',
    'callback' => 'get_shops',
    ) );
} );

function get_shops( $request ) {
    $data = array(
        'sample' => 'test'
    );
    
    return new WP_REST_Response( $data, 200 );
}