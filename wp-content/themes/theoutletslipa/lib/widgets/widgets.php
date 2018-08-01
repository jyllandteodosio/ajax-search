<?php


//* Register Widgets
add_action( 'widgets_init', 'register_custom_widget' );
function register_custom_widget() {
    
    // Register Widgets
    register_widget( 'widget_footer' ); // Need Help Widget
    
}

// Lucky Lulu - Need Help Widget 
class widget_footer extends WP_Widget {
 
    function __construct() {
        parent::__construct(
            'widget_footer', // Base ID of your widget
            __('The Outlets Lipa - Footer Details', 'theoutletslipa'), // Widget name will appear in UI
            array( 'description' => __( 'Displays Footer Details.', 'luckylulu' ), ) // Widget description
        );
    }
    
    // Creating widget front-end
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];        
            if ( ! empty( $title ) ) 
                echo '<h4 class="widgettitle widget-title">' . $title . '</h4>';
            
        ?>


        <?php if( have_rows('detail', 'widget_' . $args['widget_id']) ): ?>

            <ul class="detail-list">

            <?php while( have_rows('detail', 'widget_' . $args['widget_id']) ): the_row(); 
                    $link = get_sub_field('link', 'widget_' . $args['widget_id']);
                ?>

                <li class="detail">
                    <?php echo get_sub_field('icon', 'widget_' . $args['widget_id']); ?>
                    <?php if($link) { ?>
                        <a href="<?php echo $link; ?>" target="<?php if (get_sub_field('open_in_new_tab')) { ?>_blank<?php } ?>"> 
                            <span><?php echo get_sub_field('text', 'widget_' . $args['widget_id']); ?></span>
                        </a> 
                    <?php } else { ?>
                        <span><?php echo get_sub_field('text', 'widget_' . $args['widget_id']); ?></span>
                    <?php } ?>
                </li>

            <?php endwhile; ?>
            </ul>

        <?php endif; ?>




        <?php
        echo $args['after_widget'];
    }

    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'custom_widget' );
        }
        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php 
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}


