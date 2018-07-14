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
//add_action( 'plugins_loaded', 'ajax_search_init' );
//
//function ajax_search_init() {
//    
//}

add_action( 'wp_enqueue_scripts', 'ajax_enqueue_scripts' );

function ajax_enqueue_scripts() {
    wp_enqueue_script( 'ajax-search', plugin_dir_url( __FILE__ ) . 'js/ajax.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}

// Setup custom routes
add_action( 'rest_api_init', 'register_routes' );

function register_routes() {
    register_rest_route( 'ajax-search/v1', '/shops/', array(
        array(
            'methods' => 'GET',
            'callback' => 'get_shops',
        )
    ) );
}

function get_shops( $request ) {
    // Get the paramaters from the request
    $params = $request->get_params();
    $search = isset($params[ 'search' ]) ? $params[ 'search' ] : '';
    $category = isset($params[ 'category' ]) ? $params[ 'category' ] : '';
    $page = isset($params[ 'page' ]) ? $params[ 'page' ] : 1;
    $type = isset($params[ 'type' ]) ? $params[ 'type' ] : '';
    
    $current_page = $page ? intval( $page ) : 1;
    
    $args = array(
        'orderby'           => 'title', 
        'posts_per_page'    => 10,
        'paged'             => $current_page,
        'post_type'         => 'outlets',
        'search_tax_query'  => true,
        's'                 => $search,
    );
    
    if( $category != 'All' && $type == 'shops' ) {
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'outlet_category',
                'field'     => 'name',
                'terms'     => $category,
            )
        );
    } else if ( $type == 'shops' ){
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'outlet_category',
                'field'     => 'slug',
                'terms'     => array ('food-drink'),
                'operator'  => 'NOT IN'
            )
        );
    } else if( $type == 'dine' ){
        $args['tax_query'] = array(
            array(
                'taxonomy'  => 'outlet_category',
                'field'     => 'slug',
                'terms'     => array ('food-drink')
            )
        );
    }
    
    $query = new WP_Query( $args ); 
    
    $data = array(
        'args'              => $args,
        'max_num_pages'		=> $query->max_num_pages,
        'total'				=> $query->found_posts,
        'posts_per_page'	=> 10,
        'current_page'		=> $current_page
    );
    
    $data['shops'] = [];
    
    if($query->have_posts()) {
    
        $count = 0;

        while($query->have_posts()) { 
            $query->the_post(); 
    
            // Get article classes
            $allClasses = get_post_class();
            $article_class = '';
    
            foreach ($allClasses as $class) { 
                $article_class .= $class . " "; 
            }
            
            if($count % 2){
                $article_class .= 'even';
            };
            
            // Get article id
            $article_id = 'post-' . get_the_ID();
            
            // Get thumb url
            if(has_post_thumbnail()) {
                $thumb_id = get_post_thumbnail_id(); 
                $thumb_src = wp_get_attachment_image_src($thumb_id,'featured-image', true); 
                
                $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true); 
                $thumb_alt = ( strlen($alt) > 0 ) ? $alt : get_the_title();
                
                $thumb_url = $thumb_src[0];
            }
            
            // Get status
            $status = get_field('status');
            
            // Get tags
            $custom_taxonomy = get_the_terms( get_the_ID(), 'outlet_category');
            $tags = array();
                                    
            if( $custom_taxonomy ) {
                foreach ( $custom_taxonomy as $term ) {
                    $tags[] = array(
                        'name' => $term->name,
                        'link' => get_term_link($term),
                    );
                }
            }

            $data['shops'][] = array(
                'article_classes'   => $article_class,
                'article_id'        => $article_id,
                'thumb_url'         => $thumb_url,
                'thumb_alt'         => $thumb_alt,
                'store_name'        => get_the_title(),
                'status'            => $status,
                'time'              => get_field('time'),
                'phone'             => get_field('phone'),
                'location'          => get_field('location'),
                'tags'              => $tags,
            );
        }

        wp_reset_postdata(); 
    }
    
    return new WP_REST_Response( $data, 200 );
}

class WP_Query_Taxonomy_Search {
    public function __construct() {
        add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
    }

    public function pre_get_posts( $q ) {
        if ( is_admin() ) return;

        $wp_query_search_tax_query = filter_var( 
            $q->get( 'search_tax_query' ), 
            FILTER_VALIDATE_BOOLEAN 
        );

        // WP_Query has 'tax_query', 's' and custom 'search_tax_query' argument passed
        if ( $wp_query_search_tax_query && $q->get( 'tax_query' ) && $q->get( 's' ) ) {
            add_filter( 'posts_groupby', array( $this, 'posts_groupby' ), 10, 1 );
        }
    }

    public function posts_groupby( $groupby ) {
        return '';
    }
}

new WP_Query_Taxonomy_Search();