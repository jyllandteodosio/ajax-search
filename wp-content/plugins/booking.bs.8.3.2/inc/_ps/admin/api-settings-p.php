<?php
/**
 * @version     1.0
 * @package     General Settings API - Saving different options
 * @category    Settings API
 * @author      wpdevelop
 *
 * @web-site    https://wpbookingcalendar.com/
 * @email       info@wpbookingcalendar.com 
 * @modified    2016-02-28
 * 
 * This is COMMERCIAL SCRIPT
 * We are do not guarantee correct work and support of Booking Calendar, if some file(s) was modified by someone else then wpdevelop.
 */

if ( ! defined( 'ABSPATH' ) ) exit;                                             // Exit if accessed directly


/**
	 * Booking resources Default and Count  - Settings ( Booking Listing ) page
 * 
 * @param array $fields 
 * @return array
 */
function wpbc_settings_booking_listing_br_default_count_p( $fields, $default_options_values ) {
    
    $field_options = array( 
                            '' => array(   
                                              'title' => __('All resources' ,'booking') 
                                            , 'attr'  => array ( 'class' => 'wpbc_parent_resource' , 'style' => 'border-bottom:1px solid #ccc;')         // Set bold!
                                        )
                          );    
    
    $bk_resources = wpbc_get_br_as_objects();  
    foreach ( $bk_resources as $br ) {
        
        if ( ! ( ( isset( $br->parent ) ) && ( $br->parent != 0 ) ) ) {         // Skip child booking resources
            
            $field_options[ $br->booking_type_id ] = array(   
                
                              'title' => $br->title
                            , 'attr' => array( 
                                                'class' => ( ( isset( $br->parent ) ) && ( $br->parent == 0 ) && ( isset( $br->count ) ) && ( $br->count > 1 ) ) 
                                                                ? 'wpbc_parent_resource' 
                                                                : ( ( ( isset( $br->parent ) ) && ( $br->parent != 0 ) ) 
                                                                                                                        ?  'wpbc_child_resource' 
                                                                                                                        : 'wpbc_single_resource'  
                                                                  )                                                                        
                                            ) 
                        );
        }
    }                    
    $fields['booking_default_booking_resource'] = array(   
                            'type'          => 'select'
                            , 'default'     => $default_options_values['booking_default_booking_resource']   //''            
                            , 'title'       => __('Default booking resource' ,'booking')
                            , 'description' => __('Select your default booking resource.' ,'booking')
                            , 'options'     => $field_options
                            , 'group'       => 'booking_listing'
                    );

    ////////////////////////////////////////////////////////////////////////////
    $field_options = array();
    foreach ( array( 5, 10, 20, 25, 50, 75, 100, 500 ) as $value ) {
        $field_options[ $value ] = $value;
    }
    $fields['booking_resourses_num_per_page'] = array(   
                            'type'          => 'select'
                            , 'default'     => $default_options_values['booking_resourses_num_per_page']   //'10'            
                            , 'title'       => __('Resources number per page', 'booking')
                            , 'description' => __('Select number of booking resources (single or parent) per page at Resource menu page' ,'booking')
                            , 'options'     => $field_options
                            , 'group'       => 'booking_listing'
                    );

    return $fields;
}
add_filter('wpbc_settings_booking_listing_br_default_count', 'wpbc_settings_booking_listing_br_default_count_p' ,10, 2);


/**
	 * Title in Timeline cells  - Settings ( Booking Listing ) page
 * 
 * @param array $fields 
 * @return array
 */
function wpbc_settings_booking_listing_timeline_title_in_day_p( $fields, $default_options_values ) {
    
    $fields['booking_default_title_in_day_for_calendar_view_mode'] = array(  
                            'type'          => 'text'
                            , 'default'     => $default_options_values['booking_default_title_in_day_for_calendar_view_mode']   //'[id]:[name]'
                            , 'title'         => __('Booking title' ,'booking') . ' (' . __('admin panel', 'booking') . ')'
                            , 'description'   => sprintf(__('Type %sdefault title of bookings%s in calendar view mode at Booking Listing page (You can use the shortcodes from the bottom form of Settings Fields page).' ,'booking'),'<b>','</b>')
                            , 'group'       => 'booking_listing'
                            , 'css'         => 'width:100%;'
                            , 'placeholder' => '[id]:[name]'
        );    


	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//FixIn: 8.1.3.31
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $fields['booking_calendar_overview_start_time_prefix'] = array( 'type' => 'pure_html', 'group' => 'booking_listing'
                                , 'html'        => '<tr valign="top" class="wpbc_tr_set_gen_booking_calendar_overview_start_time">
                                                        <th scope="row">
                                                            <label class="wpbc-form-selectbox" for="set_gen_booking_calendar_overview_start_time">'
                                                            .   wp_kses_post(  __('Start / End time for Calendar Overview' ,'booking') )
                                                            . '</label>
                                                        </th>
                                                        <td><fieldset>'
                        );

    //  Start time
    $fields['booking_calendar_overview_start_time_label'] = array(
                                'type'    => 'pure_html'
                                , 'group' => 'booking_listing'
                                , 'html'  => WPBC_Settings_API::label_static( 'set_gen_booking_calendar_overview_start_time'
                                                                            , array(   'title'=> __('Start Time', 'booking'), 'label_css' => 'margin: 0.25em 0 !important;vertical-align: middle;' ) )
        );
    $field_options = range(0, 23);
    $fields['booking_calendar_overview_start_time'] = array(
                                'type'          => 'select'
                                , 'default'     => $default_options_values['booking_calendar_overview_start_time']   //'1'
                                , 'title'       => __('Start Time', 'booking')
                                , 'description' => ''
                                , 'options'     => $field_options
                                , 'group'       => 'booking_listing'
                                , 'tr_class'    => ''
                                , 'css'         => 'margin-right:20px'
                                , 'only_field'  => true
                        );
    //  End time
    $fields['booking_calendar_overview_end_time_label'] = array(
                                  'type'  => 'pure_html'
                                , 'group' => 'booking_listing'
                                , 'html'  => WPBC_Settings_API::label_static( 'set_gen_booking_calendar_overview_end_time'
                                                                            , array(   'title'=> __('End Time', 'booking'), 'label_css' => 'margin: 0.25em 0 !important;vertical-align: middle;' ) )
        );
    $field_options = array_combine( range(24, 1, -1), range(24, 1, -1) );
    $fields['booking_calendar_overview_end_time'] = array(
                                'type'          => 'select'
                                , 'default'     => $default_options_values['booking_calendar_overview_end_time']   //'30'
                                , 'title'       => __('End Time', 'booking')
                                , 'description' => ''
                                , 'options'     => $field_options
                                , 'group'       => 'booking_listing'
                                , 'tr_class'    => ''
                                , 'only_field'  => true
                        );

    $fields['booking_calendar_overview_start_time_sufix'] = array(
                                'type'          => 'pure_html'
                                , 'group'       => 'booking_listing'
                                , 'html'        => '          <p class="description">'
                                                                . sprintf(__('Select start and end time showing for Calendar Overview in %sDay%s view mode' ,'booking'),'<b>','</b>')
                                                        . '   </p>
                                                           </fieldset>
                                                        </td>
                                                    </tr>'
                        );

	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
    $field_options = range(0, 23);
    $fields['booking_calendar_overview_start_time'] = array(
                            'type'          => 'select'
                            , 'default'     => $default_options_values['booking_calendar_overview_start_time']   //'10'
                            , 'title'       => __('Start Time for aalendar Overview', 'booking')
                            , 'description' => __('Select number of booking resources (single or parent) per page at Resource menu page' ,'booking')
                            , 'options'     => $field_options
                            , 'group'       => 'booking_listing'
                    );

    $field_options = array_combine( range(24, 1, -1), range(24, 1, -1) );
    $fields['booking_calendar_overview_end_time'] = array(
                            'type'          => 'select'
                            , 'default'     => $default_options_values['booking_calendar_overview_end_time']   //'10'
                            , 'title'       => __('End Time for aalendar Overview', 'booking')
                            , 'description' => __('Select number of booking resources (single or parent) per page at Resource menu page' ,'booking')
                            , 'options'     => $field_options
                            , 'group'       => 'booking_listing'
                    );
*/
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    $fields['booking_default_title_in_day_for_timeline_front_end'] = array(  
                            'type'          => 'text'
                            , 'default'     => $default_options_values['booking_default_title_in_day_for_timeline_front_end']   //'[id]:[name]'
                            , 'title'         => __('Booking title' ,'booking') . ' (' . __('TimeLine', 'booking') . ')'
                            , 'description'   => sprintf(__('Type %sdefault title of bookings%s in %stimeline at front-end side%s. You can use the shortcodes from the bottom form of Settings Fields page.' ,'booking'),'<b>','</b>','<b>','</b>')
                            , 'group'       => 'booking_listing'
                            , 'css'         => 'width:100%;'
                            , 'placeholder' => '[id]:[name]'
        );    
    $fields['booking_is_show_popover_in_timeline_front_end'] = array(   
                            'type'          => 'checkbox'
                            , 'default'     => $default_options_values['booking_is_show_popover_in_timeline_front_end']   //'Off'            
                            , 'title'       =>  __('Booking details in popover' ,'booking')
                            , 'label'       => sprintf(__('Check this box if you want to %sshow popover with booking details%s in timeline at %sfront-end%s side.' ,'booking'),'<b>','</b>','<b>','</b>' )
                            , 'group'       => 'booking_listing'
        );         
    //  Divider  ///////////////////////////////////////////////////////////////       
    $fields['hr_booking_listing_after_is_show_popover_in_timeline_front_end'] = array( 'type' => 'hr', 'group' => 'booking_listing' );
 
    return $fields;    
}
add_filter('wpbc_settings_booking_listing_timeline_title_in_day', 'wpbc_settings_booking_listing_timeline_title_in_day_p' ,10, 2);


/**
	 * CSV Data Separator  - Settings ( Booking Listing ) page
 * 
 * @param array $fields 
 * @return array
 */
function wpbc_settings_booking_listing_csv_separator_p( $fields, $default_options_values ) {
    
   //  Divider  ///////////////////////////////////////////////////////////////       
    $fields['hr_booking_listing_before_csv_export_separator'] = array( 'type' => 'hr', 'group' => 'booking_listing' );
    
     $field_options = array(
                              ';' => '; - ' . __( 'semicolon', 'booking' )
                            , ',' => ', - ' . __( 'comma', 'booking' )
                        );       
    $fields['booking_csv_export_separator'] = array(  
                                'type'          => 'select'
                                , 'default'     => $default_options_values['booking_csv_export_separator']   //';'            
                                , 'title'       => __('CSV data separator', 'booking')
                                , 'description' => sprintf(__('Select separator of data for export bookings to CSV.' ,'booking'),'<b>','</b>')
                                , 'options'     => $field_options
                                , 'group'       => 'booking_listing'
                        );
   //  Divider  ///////////////////////////////////////////////////////////////       
    $fields['hr_booking_listing_after_csv_export_separator'] = array( 'type' => 'hr', 'group' => 'booking_listing' );
  
    return $fields;    
}
add_filter('wpbc_settings_booking_listing_csv_separator', 'wpbc_settings_booking_listing_csv_separator_p' ,10, 2);



/**
	 * Show / Hide some options  - Booking > Settings General page
 *
 * @param array $fields
 * @return array
 */
function wpbc_settings_booking_show_hide_options_p( $fields, $default_options_values ) {

	//FixIn: 8.1.3.32
	$fields['booking_listing_show_notes'] = array(
                            'type'          => 'checkbox'
                            , 'default'     => $default_options_values['booking_listing_show_notes']         //'On'
                            , 'title'       => __('Show / hide notes' ,'booking')
                            , 'label'       => __('Check this box if you want to open notes section by default in Booking Listing page.' ,'booking')
                            , 'description' => ''
                            , 'group'       => 'booking_listing'
    );

    return $fields;
}
add_filter('wpbc_settings_booking_show_hide_options', 'wpbc_settings_booking_show_hide_options_p' ,10, 2);


/**
	 * URL to edit bookings & HASH  - Settings ( Advanced ) page
 * 
 * @param array $fields 
 * @return array
 */
function wpbc_settings_edit_url_hash_p( $fields, $default_options_values ) {
    
   //  Divider  ///////////////////////////////////////////////////////////////       
    $fields['hr_url_bookings_edit_by_visitors'] = array( 'type' => 'hr', 'group' => 'advanced' );
    
    $fields['booking_url_bookings_edit_by_visitors'] = array(  
                            'type'          => 'text'
                            , 'default'     => $default_options_values['booking_url_bookings_edit_by_visitors']   //site_url() . '/booking/edit/'
                            , 'title'         => __('URL to edit bookings' ,'booking')
                            , 'description'   => sprintf( __('Type URL for %svisitors%s to edit bookings. You must insert %s shortcode into this page.' ,'booking'),'<b>','</b>', '<code>[bookingedit]</code>')
                                                 . ' '
                                                 . sprintf(__('Please read more info about configuration of this parameter %shere%s' ,'booking'),'<a href="https://wpbookingcalendar.com/faq/configure-editing-cancel-payment-bookings-for-visitors/" target="_blank">','</a>')
                            , 'group'       => 'advanced'
                            , 'css'         => 'width:100%;'
                            , 'placeholder' => site_url() . '/' . 'booking-edit/'
        );    

    //FixIn: 8.1.3.5.1
    $fields['booking_url_bookings_listing_by_customer'] = array(
                            'type'          => 'text'
                            , 'default'     => $default_options_values['booking_url_bookings_listing_by_customer']   //site_url() . '/booking/edit/'
                            , 'title'         => __('URL of page for customer bookings listing' ,'booking')
                            , 'description'   => sprintf( __('Type URL for %svisitors%s to view own bookings. You must insert %s shortcode into this page.' ,'booking'),'<b>','</b>', '<code>[bookingcustomerlisting]</code>')
                                                 . ' '
                                                 . sprintf(__('Please read more info about configuration of this parameter %shere%s' ,'booking'),'<a href="https://wpbookingcalendar.com/faq/configure-customer-bookings-listing/" target="_blank">','</a>')
                            , 'group'       => 'advanced'
                            , 'css'         => 'width:100%;'
                            , 'placeholder' => site_url() . '/' . 'bookings-listing/'
        );

    $fields['booking_is_change_hash_after_approvement'] = array(   
                            'type'          => 'checkbox'
                            , 'default'     => $default_options_values['booking_is_change_hash_after_approvement']   //'Off'            
                            , 'title'       => __('Change hash after the booking is approved' ,'booking')
                            , 'label'       => __('Check this box if you want to change the booking hash after approval. When checked, visitor will not be able to edit or cancel the booking.' ,'booking')
                            , 'description' => ''
                            , 'group'       => 'advanced'
        );       

    return $fields;    
}
add_filter('wpbc_settings_edit_url_hash', 'wpbc_settings_edit_url_hash_p' ,10, 2);