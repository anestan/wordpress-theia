<?php
	
/*
Plugin Name: Snappy List Builder
Plugin URI: http://wordpressplugincourse.com/plugins/snappy-list-builder
Description: The ultimate email list building plugin for WordPress. Capture new subscribers. Reward subscribers with a custom download upon opt-in. Build unlimited lists. Import and export subscribers easily with .csv
Version: 1.0.1.7
Author: Joel Funk @ Made Snappy
Author URI: https://madesnappy.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: snappy-list-builder
*/


/* !0. TABLE OF CONTENTS */

/*
	
	1. HOOKS
		1.1 - registers all our custom shortcodes
		1.2 - register custom admin column headers
		1.3 - register custom admin column data
		1.4 - register ajax actions
		1.5 - load external files to public website
		1.6 - Advanced Custom Fields Settings
		1.7 - register our custom menus
		1.8 - load external files in WordPress admin
		1.9 - register plugin options
		1.10 - register activate/deactivate/uninstall functions
		1.11 - trigger reward downloads
		1.12 - admin notices
	
	2. SHORTCODES
		2.1 - slb_register_shortcodes()
		2.2 - slb_form_shortcode()
		2.3 - slb_manage_subscriptions_shortcode()
		2.4 - slb_confirm_subscriptions_shortcode()
		
	3. FILTERS
		3.1 - slb_subscriber_column_headers()
		3.2 - slb_subscriber_column_data()
		3.2.2 - slb_register_custom_admin_titles()
		3.2.3 - slb_custom_admin_titles()
		3.3 - slb_list_column_headers()
		3.4 - slb_list_column_data()
		3.5 - slb_admin_menus()
		
	4. EXTERNAL SCRIPTS
		4.1 - Include ACF
		4.2 - slb_public_scripts()
		
	5. ACTIONS
		5.1 - slb_save_subscription()
		5.2 - slb_save_subscriber()
		5.3 - slb_add_subscription()
		5.4 - slb_unsubscribe()
		5.5 - slb_remove_subscription()
		5.6 - slb_send_subscriber_email()
		5.7 - slb_confirm_subscription()
		5.8 - slb_create_plugin_tables()
		5.9 - slb_activate_plugin()
		5.10 - slb_add_reward_link()
		5.11 - slb_trigger_reward_download()
		5.12 - slb_update_reward_link_download()
		5.13 - slb_trigger_reward_download()
		5.14 - slb_download_subscribers_csv()
		5.15 - slb_parse_import_csv()
		5.16 - slb_import_subscribers()
		5.17 - slb_check_wp_version()
		5.18 - slb_uninstall_plugin()
		5.19 - slb_remove_plugin_tables()
		5.20 - slb_remove_post_data()
		5.21 - slb_remove_options()
		
		
	6. HELPERS
		6.1 - slb_subscriber_has_subscription()
		6.2 - slb_get_subscriber_id()
		6.3 - slb_get_subscritions()
		6.4 - slb_return_json()
		6.5 - slb_get_acf_key()
		6.6 - slb_get_subscriber_data()
		6.7 - slb_get_page_select()
		6.8 - slb_get_default_options()
		6.9 - slb_get_option()
		6.10 - slb_get_current_options()
		6.11 - slb_get_manage_susbcriptions_html()
		6.12 - slb_get_email_template()
		6.13 - slb_validate_list()
		6.14 - slb_validate_subscriber()
		6.15 - slb_get_manage_susbcriptions_link()
		6.16 - slb_get_querystring_start()
		6.17 - slb_get_optin_link()
		6.18 - slb_get_message_html()
		6.19 - slb_get_list_reward()
		6.20 - slb_get_reward_link()
		6.21 - slb_generate_reward_uid()
		6.22 - slb_get_reward()
		6.23 - slb_get_list_subscribers()
		6.24 - slb_get_list_subscribers_count()
		6.25 - slb_get_export_link()
		6.26 - slb_csv_to_array()
		6.27 - slb_get_admin_notice()
		6.28 - slb_get_options_settings()
		
	7. CUSTOM POST TYPES
		7.1 - subscribers
		7.2 - lists
	
	8. ADMIN PAGES
		8.1 - slb_dashboard_admin_page()
		8.2 - slb_import_admin_page()
		8.3 - slb_options_admin_page()
	
	9. SETTINGS
		9.1 - slb_register_options()
		
	10. MISC.

*/




/* !1. HOOKS */

// 1.1
// hint: registers all our custom shortcodes on init
add_action('init', 'slb_register_shortcodes');

// 1.2
// hint: register custom admin column headers
add_filter('manage_edit-slb_subscriber_columns','slb_subscriber_column_headers');
add_filter('manage_edit-slb_list_columns','slb_list_column_headers');

// 1.3
// hint: register custom admin column data
add_filter('manage_slb_subscriber_posts_custom_column','slb_subscriber_column_data',1,2);
add_filter('manage_slb_list_posts_custom_column','slb_list_column_data',1,2);
add_action(
    'admin_head-edit.php',
    'slb_register_custom_admin_titles'
);

// 1.4
// hint: register ajax actions
add_action('wp_ajax_nopriv_slb_save_subscription', 'slb_save_subscription'); // regular website visitor
add_action('wp_ajax_slb_save_subscription', 'slb_save_subscription'); // admin user
add_action('wp_ajax_nopriv_slb_unsubscribe', 'slb_unsubscribe'); // regular website visitor
add_action('wp_ajax_slb_unsubscribe', 'slb_unsubscribe'); // admin user
add_action('wp_ajax_slb_download_subscribers_csv', 'slb_download_subscribers_csv'); // admin users
add_action('wp_ajax_slb_parse_import_csv', 'slb_parse_import_csv'); // admin users
add_action('wp_ajax_slb_import_subscribers', 'slb_import_subscribers'); // admin users

// 1.5
// load external files to public website
add_action('wp_enqueue_scripts', 'slb_public_scripts');

// 1.6 ACF Settings
// 1.6.1 customize ACF path
add_filter('acf/settings/path', 'slb_acf_settings_path');
// 1.6.2. customize ACF dir
add_filter('acf/settings/dir', 'slb_acf_settings_dir');
add_action('acf/init', 'slb_acf_init');
// 1.6.3. Hide ACF field group menu item
if( !class_exists('ACF') ):
 	DEFINE('ACF_LITE',true);
 	add_filter('acf/settings/show_admin', '__return_false');
	include_once( plugin_dir_path( __FILE__ ) .'lib/advanced-custom-fields/acf.php' );
endif;


// 1.7 
// hint: register our custom menus
add_action('admin_menu', 'slb_admin_menus');

// 1.8
// hint: load external files in WordPress admin
add_action('admin_enqueue_scripts', 'slb_admin_scripts');

// 1.9
// register plugin options
add_action('admin_init', 'slb_register_options');

// 1.10
// register activate/deactivate/uninstall functions
register_activation_hook( __FILE__, 'slb_activate_plugin' );
add_action( 'admin_notices', 'slb_check_wp_version' );
register_uninstall_hook( __FILE__, 'slb_uninstall_plugin' );

// 1.11
// trigger reward downloads
add_action('wp', 'slb_trigger_reward_download');



/* !2. SHORTCODES */

// 2.1
// hint: registers all our custom shortcodes
function slb_register_shortcodes() {
	
	add_shortcode('slb_form', 'slb_form_shortcode');
	add_shortcode('slb_manage_subscriptions', 'slb_manage_subscriptions_shortcode');
	add_shortcode('slb_confirm_subscription','slb_confirm_subscription_shortcode');
	add_shortcode('slb_download_reward','slb_download_reward_shortcode');
	
}

// 2.2
// hint: returns a html string for a email capture form
function slb_form_shortcode( $args, $content="") {
	
	// get the list id
	$list_id = 0;
	if( isset($args['id']) ) $list_id = (int)$args['id'];
	
	// title
	$title = '';
	if( isset($args['title']) ) $title = (string)$args['title'];
	
	// setup our output variable - the form html 
	$output = '
	
		<div class="slb">
		
			<form id="slb_register_form" name="slb_form" class="slb-form" 
			action="/wp-admin/admin-ajax.php?action=slb_save_subscription" method="post">
			
				<input type="hidden" name="slb_list" value="'. $list_id .'"> 
				
				'. wp_nonce_field( 'slb-register-subscription_'.$list_id, '_wpnonce', true, false );
				
				
				if( strlen($title) ):
				
					$output .= '<h3 class="slb-title">'. $title .'</h3>';
				
				endif;
			
				$output .='<p class="slb-input-container">
				
					<label>Your Name</label><br />
					<input type="text" name="slb_fname" placeholder="First Name" />
					<input type="text" name="slb_lname" placeholder="Last Name" />
				
				</p>
				
				<p class="slb-input-container">
				
					<label>Your Email</label><br />
					<input type="email" name="slb_email" placeholder="ex. you@email.com" />
				
				</p>';
				
				// including content in our form html if content is passed into the function
				if( strlen($content) ):
				
					$output .= '<div class="slb-content">'. wpautop($content) .'</div>';
				
				endif;
				
				// get reward
				$reward = slb_get_list_reward( $list_id );
				
				// IF reward exists
				if( $reward !== false ):
				
					// include message about reward
					$output .='
						<div class="slb-content slb-reward-message">
							<p>Get a FREE DOWNLOAD of <strong>'. $reward['title'] .'</strong> when you join this list!</strong></p>
						</div>
					';
				
				endif;
				
				// completing our form html
				$output .= '<p class="slb-input-container">
				
					<input type="submit" name="slb_submit" value="Sign Me Up!" />
				
				</p>
			
			</form>
		
		</div>
	
	';
	
	// return our results/html
	return $output;
	
}

// 2.3
// hint: displays a form for managing the users list subscriptions
// example: [slb_manage_subscriptions]
function slb_manage_subscriptions_shortcode( $args, $content="" ) {
	
	// setup our return string
	$output = '<div class="slb slb-manage-subscriptions">';
	
	try {
		
		// get the email address from the URL
		$email = ( isset( $_GET['email'] ) ) ? esc_attr( $_GET['email'] ) : '';
		
		// get the subscriber id from the email address
		$subscriber_id = slb_get_subscriber_id( $email );
		
		// get subscriber data 
		$subscriber_data = slb_get_subscriber_data( $subscriber_id );
		
		// IF subscriber exists
		if( $subscriber_id ):
		
			// get subscriptions html
			$output = slb_get_manage_subscriptions_html( $subscriber_id );
			
		else:
		
			// invalid link
			$output .= '<p>This link is invalid.</p>';
		
		endif;
	
	
	} catch(Exception $e) {
		
		// php error
		
	}
	
	// close our html div tag
	$output .= '</div>';
	
	// return our html
	return $output;
	
}

// 2.4
// hint: displays subscription opt-in confirmation text and link to manage sunscriptions
// example: [slb_confirm_subscription]
function slb_confirm_subscription_shortcode( $args, $content="" ) {
	
	// setup output variable 
	$output = '<div class="slb">';
	
	// setup email and list_id variables and handle if they are not defined in the GET scope
	$email = ( isset( $_GET['email'] ) ) ? esc_attr( $_GET['email'] ) : '';
	$list_id = ( isset( $_GET['list'] ) ) ? esc_attr( $_GET['list'] ) : 0;
	
	// get subscriber id from email
	$subscriber_id = slb_get_subscriber_id( $email );
	$subscriber = get_post( $subscriber_id );
	
	// IF we found a subscriber matching that email address
	if( $subscriber_id && slb_validate_subscriber( $subscriber ) ):
	
		// get list object
		$list = get_post( $list_id );
		
		// IF list and subscriber are valid
		if( slb_validate_list( $list ) ):
		
		
			if( !slb_subscriber_has_subscription( $subscriber_id, $list_id) ):
				
				// complete opt-in
				$optin_complete = slb_confirm_subscription( $subscriber_id, $list_id );
				
				if( !$optin_complete ):
				
					$output .= slb_get_message_html('Due to an unknown error, we were unable to confirm your subscription.', 'error');
					$output .= '</div>';
					
					return $output;
				
				endif;
		
			endif;
		
			// get confirmation message html and append it to output
			$output .= slb_get_message_html( 'Your subscription to '. $list->post_title .' has now been confirmed.', 'confirmation' );
			
			// get manage subscriptions link
			$manage_subscriptions_link = slb_get_manage_subscriptions_link( $email );
			
			// append link to output
			$output .= '<p><a href="'. $manage_subscriptions_link .'">Click here to manage your subscriptions.</a></p>';
		
		
		else:
		
			$output .= slb_get_message_html( 'This link is invalid.', 'error');
		
		endif;
	
	else: 
	
		$output .= slb_get_message_html( 'This link is invalid. Invalid Subscriber '. $email .'.', 'error');
	
	endif;
	
	// close .slb div
	$output .= '</div>';
	
	// return output html
	return $output;
	
}

// 2.5
// [slb_download_reward]
// hint: returns a message if the download link has expired or is invalid
function slb_download_reward_shortcode( $args, $content="" ) {
	
	$output = '';
	
	$uid = (isset($_GET['reward']) && $_GET['reward']) ? (string)$_GET['reward'] : 0;
		
	// get reward form link uid
	$reward = slb_get_reward( $uid );
	
	// IF reward was found
	if( $reward !== false ):
	
		if( $reward['downloads'] >= slb_get_option( 'slb_download_limit') ):
	
			$output .= slb_get_message_html( 'This link has reached it\'s download limit.', 'warning');
		
		endif;
	
	else:
	
		$output .= slb_get_message_html( 'This link is invalid.', 'error');
	
	endif;
	
	return $output;
	
}





/* !3. FILTERS */

// 3.1
function slb_subscriber_column_headers( $columns ) {
	
	// creating custom column header data
	$columns = array(
		'cb'=>'<input type="checkbox" />',
		'title'=>__('Subscriber Name'),
		'email'=>__('Email Address'),	
	);
	
	// returning new columns
	return $columns;
	
}

// 3.2
function slb_subscriber_column_data( $column, $post_id ) {
	
	// setup our return text
	$output = '';
	
	switch( $column ) {
		case 'email':
			// get the custom email data
			$email = get_field('slb_email', $post_id );
			$output .= $email;
			break;
		
	}
	
	// echo the output
	echo $output;
	
}

// 3.2.2
// hint: registers special custom admin title columns
function slb_register_custom_admin_titles() {
    add_filter(
        'the_title',
        'slb_custom_admin_titles',
        99,
        2
    );
}

// 3.2.3
// hint: handles custom admin title "title" column data for post types without titles
function slb_custom_admin_titles( $title, $post_id ) {
   
    global $post;
	
    $output = $title;
   
    if( isset($post->post_type) ):
                switch( $post->post_type ) {
                        case 'slb_subscriber':
	                            $fname = get_field('slb_fname', $post_id );
	                            $lname = get_field('slb_lname', $post_id );
	                            $output = $fname .' '. $lname;
	                            break;
                }
        endif;
   
    return $output;
}

// 3.3
function slb_list_column_headers( $columns ) {
	
	// creating custom column header data
	$columns = array(
		'cb'=>'<input type="checkbox" />',
		'title'=>__('List Name'),
		'reward'=>__('Opt-In Reward'),
        'subscribers' => __('Subscribers'),
		'shortcode'=>__('Shortcode'),	
	);
	
	// returning new columns
	return $columns;
	
}

// 3.4
function slb_list_column_data( $column, $post_id ) {
	
	// setup our return text
	$output = '';
	
	switch( $column ) {
		
		case 'reward':
			$reward = slb_get_list_reward( $post_id );
    		if( $reward !== false ):
    		
	    		$output .= '<a href="'. $reward['file']['url'] .'" download="'. $reward['title'] .'">'. $reward['title'] .'</a>';
    		
    		endif;
			break;
		case 'subscribers' :
			// get the count of current susbcribers
			$subscriber_count = slb_get_list_subscriber_count( $post_id );
			// get our unique export link
			$export_href = slb_get_export_link( $post_id );
			// append the subscriber count to our output
		    $output .= $subscriber_count;
		    // if we have more than one subscriber, add our new export link to $output
		    if( $subscriber_count ) $output.= ' <a href="'. $export_href .'">Export</a>';
		    break;
		case 'shortcode':
			$output .= '[slb_form id="'. $post_id .'"]';
			break;
		
	}
	
	// echo the output
	echo $output;
	
}

// 3.5
// hint: registers custom plugin admin menus
function slb_admin_menus() {
	
	/* main menu */
	
		$top_menu_item = 'slb_dashboard_admin_page';
	    
	    add_menu_page( '', 'List Builder', 'manage_options', 'slb_dashboard_admin_page', 'slb_dashboard_admin_page', 'dashicons-email-alt' );
    
    /* submenu items */
    
	    // dashboard
	    add_submenu_page( $top_menu_item, '', 'Dashboard', 'manage_options', $top_menu_item, $top_menu_item );
	    
	    // email lists
	    add_submenu_page( $top_menu_item, '', 'Email Lists', 'manage_options', 'edit.php?post_type=slb_list' );
	    
	    // subscribers
	    add_submenu_page( $top_menu_item, '', 'Subscribers', 'manage_options', 'edit.php?post_type=slb_subscriber' );
	    
	    // import subscribers
	    add_submenu_page( $top_menu_item, '', 'Import Subscribers', 'manage_options', 'slb_import_admin_page', 'slb_import_admin_page' );
	    
	    // plugin options
	    add_submenu_page( $top_menu_item, '', 'Plugin Options', 'manage_options', 'slb_options_admin_page', 'slb_options_admin_page' );

}





/* !4. EXTERNAL SCRIPTS */

// 4.1
// Include ACF
if( !class_exists('Acf') ):
	include_once( plugin_dir_path( __FILE__ ) .'lib/advanced-custom-fields/acf.php' );
endif;

// 4.2
// hint: loads external files into PUBLIC website
function slb_public_scripts() {
	
	// register scripts with WordPress's internal library
	wp_register_script('snappy-list-builder-js-public', plugins_url('/js/public/snappy-list-builder.js',__FILE__), array('jquery'),'',true);
	wp_register_style('snappy-list-builder-css-public', plugins_url('/css/public/snappy-list-builder.css',__FILE__));
	
	// add to que of scripts that get loaded into every page
	wp_enqueue_script('snappy-list-builder-js-public');
	wp_enqueue_style('snappy-list-builder-css-public');
	
}

// 4.3
// hint: loads external files into wordpress ADMIN
function slb_admin_scripts() {
	
	// register scripts with WordPress's internal library
	wp_register_script('snappy-list-builder-js-private', plugins_url('/js/private/snappy-list-builder.js',__FILE__), array('jquery'),'',true);
	
	// add to que of scripts that get loaded into every admin page
	wp_enqueue_script('snappy-list-builder-js-private');
	
}





/* !5. ACTIONS */

// 5.1
// hint: saves subscription data to an existing or new subscriber
function slb_save_subscription() {
	
	// setup default result data
	$result = array(
		'status' => 0,
		'message' => 'Subscription was not saved. ',
		'error'=>'',
		'errors'=>array()
	);
	
	try {
		
		
		// get list_id
		$list_id = (isset($_POST['slb_list'])) ? (int)$_POST['slb_list']: 0;
	
		// verify nounce
		if( check_ajax_referer( 'slb-register-subscription_'.$list_id ) ):
	
			// prepare subscriber data
			$subscriber_data = array(
				'fname'=> esc_attr( $_POST['slb_fname'] ),
				'lname'=> esc_attr( $_POST['slb_lname'] ),
				'email'=> esc_attr( $_POST['slb_email'] ),
			);
			
			// setup our errors array
			$errors = array();
			
			// form validation
			if( !strlen( $subscriber_data['fname'] ) ) $errors['fname'] = 'First name is required.';
			if( !strlen( $subscriber_data['email'] ) ) $errors['email'] = 'Email address is required.';
			if( strlen( $subscriber_data['email'] ) && !is_email( $subscriber_data['email'] ) ) $errors['email'] = 'Email address must be valid.';
			
			// IF there are errors
			if( count($errors) ):
			
				// append errors to result structure for later use
				$result['error'] = 'Some fields are still required. ';
				$result['errors'] = $errors;
			
			else: 
			// IF there are no errors, proceed...
			
				// attempt to create/save subscriber
				$subscriber_id = slb_save_subscriber( $subscriber_data );
				
				// IF subscriber was saved successfully $subscriber_id will be greater than 0
				if( $subscriber_id ):
				
					// IF subscriber already has this subscription
					if( slb_subscriber_has_subscription( $subscriber_id, $list_id ) ):
					
						// get list object
						$list = get_post( $list_id );
						
						// return detailed error
						$result['error'] = esc_attr( $subscriber_data['email'] .' is already subscribed to '. $list->post_title .'.');
						
					else: 
						
						// send new subscriber a confirmation email, returns true if we were successful
						$email_sent = slb_send_subscriber_email( $subscriber_id, 'new_subscription', $list_id);
						
						// IF email was sent
						if( !$email_sent ):
						
							// email could not be sent
							$result['error'] = 'Unable to send email. ';
						
						else:
						
							// email sent and subscription saved!
							$result['status']=1;
							$result['message']='Success! A confirmation email has been sent to '. $subscriber_data['email'];
						
							// clean up: remove our empty error
							unset( $result['error'] );
						
						endif;
					
					endif;
				
				endif;
			
			endif;
		
		endif;
		
	} catch ( Exception $e ) {
		
	}
	
	// return result as json
	slb_return_json($result);
	
}

// 5.2
// hint: creates a new subscriber or updates and existing one
function slb_save_subscriber( $subscriber_data ) {
	
	// setup default subscriber id
	// 0 means the subscriber was not saved
	$subscriber_id = 0;
	
	try {
		
		$subscriber_id = slb_get_subscriber_id( $subscriber_data['email'] );
		
		// IF the subscriber does not already exists...
		if( !$subscriber_id ):
		
			// add new subscriber to database	
			$subscriber_id = wp_insert_post( 
				array(
					'post_type'=>'slb_subscriber',
					'post_title'=>$subscriber_data['fname'] .' '. $subscriber_data['lname'],
					'post_status'=>'publish',
				), 
				true
			);
		
		endif;
		
		// add/update custom meta data
		update_field(slb_get_acf_key('slb_fname'), $subscriber_data['fname'], $subscriber_id);
		update_field(slb_get_acf_key('slb_lname'), $subscriber_data['lname'], $subscriber_id);
		update_field(slb_get_acf_key('slb_email'), $subscriber_data['email'], $subscriber_id);
		
	} catch( Exception $e ) {
		
		// a php error occurred
		
	}
	
	// return subscriber_id
	return $subscriber_id;
	
}

// 5.3
// hint: adds list to subscribers subscriptions
function slb_add_subscription( $subscriber_id, $list_id ) {
	
	// setup default return value
	$subscription_saved = false;
	
	// IF the subscriber does NOT have the current list subscription
	if( !slb_subscriber_has_subscription( $subscriber_id, $list_id ) ):
	
		// get subscriptions and append new $list_id
		$subscriptions = slb_get_subscriptions( $subscriber_id );
		$subscriptions[]=$list_id;
		
		// update slb_subscriptions
		update_field( slb_get_acf_key('slb_subscriptions'), $subscriptions, $subscriber_id );
		
		// subscriptions updated!
		$subscription_saved = true;
	
	endif;
	
	// return result
	return $subscription_saved;
	
}

// 5.4
// hint: removes one or more subscriptions from a subscriber and notifies them via email
// this function is a ajax form handler...
// expects form post data: $_POST['subscriber_id'] and $_POST['list_id']
function slb_unsubscribe() {
	
	// setup default result data
	$result = array(
		'status' => 0,
		'message' => 'Subscriptions were NOT updated. ',
		'error' => '',
		'errors' => array(),
	);
	
	$subscriber_id = ( isset($_POST['subscriber_id']) ) ? (int)$_POST['subscriber_id'] : 0;
	$list_ids = ( isset($_POST['list_ids']) ) ? $_POST['list_ids'] : 0;
	
	try {
		
		// validate nounce
		if( check_ajax_referer( 'slb-update-subscriptions_'. $subscriber_id ) ):
		
			// if there are lists to remove
			if( is_array($list_ids) ):
		
				// loop over lists to remove
				foreach( $list_ids as &$list_id ):
				
					// remove this subscription
					slb_remove_subscription( $subscriber_id, $list_id );
				
				endforeach;
			
			endif;
			
			// setup success status and message
			$result['status']=1;
			$result['message']='Subscriptions updated. ';
			
			// get the updated list of subscriptions as html
			$result['html']= slb_get_manage_subscriptions_html( $subscriber_id );
		
		endif;
	
	} catch( Exception $e ) {
		
		// php error
		
	}
	
	// return result as json
	slb_return_json( $result );
	
}

// 5.5
// hint: removes a single subscription from a subscriber
function slb_remove_subscription( $subscriber_id, $list_id ) {
	
	// setup default return value
	$subscription_saved = false;
	
	// IF the subscriber has the current list subscription
	if( slb_subscriber_has_subscription( $subscriber_id, $list_id ) ):
	
		// get current subscriptions 
		$subscriptions = slb_get_subscriptions( $subscriber_id );
		
		// get the position of the $list_id to remove
		$needle = array_search( $list_id, $subscriptions );
		
		// remove $list_id from $subscriptions array
		unset( $subscriptions[$needle] );
		
		// update slb_subscriptions
		update_field(slb_get_acf_key( 'slb_subscriptions'), $subscriptions, $subscriber_id);
		
		// subscriptions updated!
		$subscription_saved = true;
	
	endif;
	
	// return result
	return $subscription_saved;
	
}

// 5.6
// hint: sends a unqiue customized email to a subscriber
function slb_send_subscriber_email( $subscriber_id, $email_template_name, $list_id ) {
	
	// setup return variable
	$email_sent = false;
	
	// get email template data
	$email_template_object = slb_get_email_template( $subscriber_id, $email_template_name, $list_id );
	
	// IF email template data was found
	if( !empty( $email_template_object ) ):
	
		// get subscriber data
		$subscriber_data = slb_get_subscriber_data( $subscriber_id );
		
		// set wp_mail headers
		$wp_mail_headers = array('Content-Type: text/html; charset=UTF-8');
		
		// use wp_mail to send email
		$email_sent = wp_mail( array( $subscriber_data['email'] ) , $email_template_object['subject'], $email_template_object['body'], $wp_mail_headers );
	
	endif;
	
	return $email_sent;
	
}

// 5.7
// hint: adds subcription to database and emails subscriber confirmation email
function slb_confirm_subscription( $subscriber_id, $list_id ) {
	
	// setup return variable
	$optin_complete = false;
	
	// add new subscription
	$subscription_saved = slb_add_subscription( $subscriber_id, $list_id );
	
	// IF subscription was saved
	if( $subscription_saved ):
	
		// send email
		$email_sent = slb_send_subscriber_email( $subscriber_id, 'subscription_confirmed', $list_id );
		
		// IF email sent
		if( $email_sent ):
		
			// return true
			$optin_complete = true;
		
		endif;
	
	endif;
	
	// return result
	return $optin_complete;
	
}


// 5.8
// hint: creates custom tables for our plugin
function slb_create_plugin_tables() {
	
	global $wpdb;
	
	// setup return value
	$return_value = false;
	
	try {
		
		$table_name = $wpdb->prefix . "slb_reward_links";
		$charset_collate = $wpdb->get_charset_collate();
	
		// sql for our table creation
		$sql = "CREATE TABLE $table_name (
			id mediumint(11) NOT NULL AUTO_INCREMENT,
			uid varchar(128) NOT NULL,
			subscriber_id mediumint(11) NOT NULL,
			list_id mediumint(11) NOT NULL,
			attachment_id mediumint(11) NOT NULL,
			downloads mediumint(11) DEFAULT 0 NOT NULL ,
			UNIQUE KEY id (id)
			) $charset_collate;";
		
		// make sure we include wordpress functions for dbDelta	
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			
		// dbDelta will create a new table if none exists or update an existing one
		dbDelta($sql);
		
		// return true
		$return_value = true;
	
	} catch( Exception $e ) {
		
		// php error
		
	}
	
	// return result
	return $return_value;
	
}

// 5.9
// hint: runs on plugin activation
function slb_activate_plugin() {
	
	// setup custom database tables
	slb_create_plugin_tables();
	
}

// 5.10
// hint: adds new reward links to the database
function slb_add_reward_link( $uid, $subscriber_id, $list_id, $attachment_id ) {
	
	global $wpdb;

	// setup our return value
	$return_value = false;
	
	try {
		
		$table_name = $wpdb->prefix . "slb_reward_links";
		
		$wpdb->insert(
			$table_name, 
			array( 
				'uid' => $uid, 
				'subscriber_id' => $subscriber_id,
				'list_id' => $list_id, 
				'attachment_id' => $attachment_id, 
			), 
			array( 
				'%s', 
				'%d', 
				'%d',
				'%d', 
			) 
		);
		
		// return true
		$return_value = true;
	
	} catch( Exception $e ) {
		
		// php error
		
	}
	
	// return result
	return $return_value;
	
}

// 5.11
// hint: triggers a download of the reward file
function slb_trigger_reward_download() {
	
	global $post;
	
	if( ! is_null($post) && $post->ID == slb_get_option( 'slb_reward_page_id') && isset($_GET['reward']) ):
		
		$uid = ($_GET['reward']) ? (string)$_GET['reward'] : 0;
		
		// get reward form link uid
		$reward = slb_get_reward( $uid );
		
		// IF reward was found
		if( $reward !== false && $reward['downloads'] < slb_get_option( 'slb_download_limit') ):
		
			slb_update_reward_link_downloads( $uid );
			
			// get the reward mimetype
			$mimetype = $reward['file']['mime_type'];
			// extract the filetype from the mimetype
			$mimetype_array = explode('/',$mimetype);
			$filetype = $mimetype_array[1];
		
			// setup file headers
			header("Content-type: ".$mimetype,true,200);
		    header("Content-Disposition: attachment; filename=".$reward['title'] .'.'. $filetype);
		    header("Pragma: no-cache");
		    header("Expires: 0");
		    readfile($reward['file']['url']);
		    exit();
	    
	    endif;
	
	endif;
	
}

// 5.12
// hint: increases reward link download count by one
function slb_update_reward_link_downloads( $uid ) {
	
	global $wpdb;

	// setup our return value
	$return_value = false;
	
	try {
		
		$table_name = $wpdb->prefix . "slb_reward_links";
		
		// get current download count
		$current_count = $wpdb->get_var( 
			$wpdb->prepare( 
				"
					SELECT downloads 
					FROM $table_name 
					WHERE uid = %s
				", 
				$uid
			) 
		);
		
		// set new count
		$new_count = (int)$current_count+1;
		
		// update downloads for this reward link entry
		$wpdb->query(
			$wpdb->prepare( 
				"
					UPDATE $table_name
					SET downloads = $new_count  
					WHERE uid = %s
				", 
				$uid
			) 
		);
		
		$return_value = true;
		
	} catch( Exception $e ) {
		
		// php error
		
	}
	
	return $return_value;
	
}

// 5.13
// hint: generates a .csv file of subscribers data
// expects $_GET['list_id'] to be set in the URL
function slb_download_subscribers_csv() {
	
	// get the list id from the URL scope
	$list_id = ( isset($_GET['list_id']) ) ? (int)$_GET['list_id'] : 0;
	
	// setup our return data
	$csv = '';
	
	// get the list object
	$list = get_post( $list_id );
	
	// get the list's subscribers or get all subscribers if no list id is given
	$subscribers = slb_get_list_subscribers( $list_id );
	
	// IF we have confirmed subscribers
	if( $subscribers !== false ):
	
		// get the current date
		$now = new DateTime();
		
		// setup a unique filename for the generated export file
		$fn1 = 'snappy-list-builder-export-list_id-'. $list_id .'-date-'. $now->format('Ymd'). '.csv';
		$fn2 = plugin_dir_path( __FILE__ ) .'exports/'.$fn1;
		
		// open new file in write mode
		$fp = fopen($fn2, 'w');
		
		// get the first subscriber's data
		$subscriber_data = slb_get_subscriber_data( $subscribers[0] );
		
		// remove the subscriptions and name column from the data
		unset($subscriber_data['subscriptions']);
		unset($subscriber_data['name']);
		
		// build our csv headers array from $subscriber_data's data keys
		$csv_headers = array();
		foreach( $subscriber_data as $key => $value ):
			array_push($csv_headers, $key);
		endforeach;
		
		// append $csv_headers to our csv file
		fputcsv($fp, $csv_headers);
	
		// loop over all our subscribers
		foreach( $subscribers as &$subscriber_id ):
	
			// get the subscriber data of the current subscriber
			$subscriber_data = slb_get_subscriber_data( $subscriber_id );
		
			// remove the subscriptions and name columns from the data
			unset($subscriber_data['subscriptions']);
			unset($subscriber_data['name']);
			
			// append this subscriber's data to our csv file
			fputcsv($fp, $subscriber_data);
		
		endforeach;
		
		// read open our new file is read mode
		$fp = fopen($fn2, 'r');
		// read our new csv file and store it's contents in $fc
		$fc = fread($fp, filesize($fn2) );
		// close our open file pointer
		fclose($fp);
	
		// setup file headers
		header("Content-type: application/csv");
		header("Content-Disposition: attachment; filename=".$fn1);
		// echo the contents of our file and return it to the browser
		echo($fc);
		// exit php processes 
		exit;
	
	endif;
	
	// return false if we were unable to download our csv
	return false;
	
}

// 5.14
// hint: this function retrieves a csv file from the server and parses the data into a php array
// it then returns that array in a json formatted object
// this function is a ajax post form handler
// expects: $_POST['slb_import_file_id']
function slb_parse_import_csv() {
	
	// setup our return array
	$result = array(
		'status'=>0,
		'message'=>'Could not parse import CSV. ',
		'error'=>'',
		'data'=>array(),
	);
	
	try {
	
		// get the attachment id from $_POST['slb_import_file_id']
		$attachment_id = (isset($_POST['slb_import_file_id'])) ? esc_attr( $_POST['slb_import_file_id'] ) : 0;
		
		// get the filename using wp's get_attached_file
		$filename = get_attached_file( $attachment_id );
		
		// IF we got the filename
		if( $filename !== false):
		
			// parse the csv file into a php array using slb_csv_to_array
			$csv_data = slb_csv_to_array($filename,',');
		
			// IF we were able to parse the file and there's data in it
			if( $csv_data !== false && count($csv_data) ):
		
				// append the data to our result array and return as success
				$result = array(
					'status'=>1,
					'message'=>'CSV Import data parsed successfully',
					'error'=>'',
					'data'=>$csv_data,
				);
			
			endif;
			
		else:
		
			// return an error message if we could not retrieve the file
			$result['error']='The import file does not exist. ';
		
		endif;
	
	} catch( Exception $e ) {
		
		// php error
	}
	
	// return the result as json
	slb_return_json( $result );
	
}

// 5.15
// hint: adds a new admin notice to array $slb_notices

$slb_notices = array();

function slb_add_admin_notice( $message, $class ) {
	
	// get our global variable
	global $slb_notices;
	
	try {
		
		// create new notice associate array
		$notice = array( 
			'message'=>$message, 
			'class'=>$class
		);
		
		// add this notice to $slb_notices
		$slb_notices[] = $notice;
		
	} catch( Exception $e ) {
		
	}
	
	// always return true
	return true;
	
}

// 5.16
// hint: imports new subscribers from our import admin page
// this function is a form handler and expect subscriber data in the $_POST scope
function slb_import_subscribers() {
	
	// setup our return array
	$result = array(
		'status'=>0,
		'message'=>'Could not import subscribers. ',
		'error'=>'',
		'errors'=>array(),
	);
	
	try {
		
		// get the assignment values
		$fname_column = (isset($_POST['slb_fname_column'])) ? (int)$_POST['slb_fname_column'] : 0;
		$lname_column = (isset($_POST['slb_lname_column'])) ? (int)$_POST['slb_lname_column'] : 0;
		$email_column = (isset($_POST['slb_email_column'])) ? (int)$_POST['slb_email_column'] : 0;
		
		// get the list id to import to
		$list_id = (isset($_POST['slb_import_list_id'])) ? (int)$_POST['slb_import_list_id'] : 0;
		
		// get the selected subscriber rows to import
		$selected_rows = (isset($_POST['slb_import_rows'])) ? (array)$_POST['slb_import_rows'] : array();
		
		// setup the data for selected rows
		$subscribers = array();
		
		// setup a variable for counting the subscribers we add
		$added_count = 0;
		
		// loop over selected rows and get the data
		foreach( $selected_rows as &$row_id ):
		
			// build our subscriber data 
			$subscriber_data = array(
				'fname'=>(string)$_POST['s_'. $row_id .'_'. $fname_column],
				'lname'=>(string)$_POST['s_'. $row_id .'_'. $lname_column],
				'email'=>(string)$_POST['s_'. $row_id .'_'. $email_column],
			);
			
			// IF the subscriber email is invalid
			if( !is_email($subscriber_data['email']) ):
			
				// don't attempt to add the subscriber if the email is not valid
				$result['errors'][] = 'Invalid email detected: '. $subscriber_data['email'] .'. This subscriber was not added';
			
			else:
			
				// IF the subscriber email is valid...
				// add subscriber to the database
				$subscriber_id = slb_save_subscriber( $subscriber_data );
				
				// IF subscriber was created or updated successfully
				if( $subscriber_id ):
				
					// add subscription for this subscriber without opt-in
					$subscription_added = slb_add_subscription( $subscriber_id, $list_id );
				
					// updated our added count
					$added_count++;
				
				endif;
			
			endif;
		
		endforeach;
		
		// IF no subscribers were actually added...
		if( $added_count == 0 ):
		
			// return error message
			$result['error'] = 'No subscribers were imported. ';
		
		else:
		
			// IF subscribers were added...
			// return success!
			$result = array(
				'status'=>1,
				'message'=> $added_count .' Subscribers imported successfully. ',
				'error'=>'',
				'errors'=>array(),
			);
		
		endif;
	
	} catch( Exception $e ) {
		
		// php errpr
		
	}
	
	// return result as json
	slb_return_json( $result );
	
	
}

// 5.17
// hint: checks the current version of wordpress against supported versions and displays a admin notice if it is not supported
function slb_check_wp_version() {
	
	global $pagenow;
	
	
	if ( $pagenow == 'plugins.php' && is_plugin_active('snappy-list-builder/snappy-list-builder.php') ):
	
		// get the wp version
		$wp_version = get_bloginfo('version');
		
		// tested vesions
		// these are the versions we've tested our plugin in
		$tested_versions = array(
			'4.2.0',
			'4.2.1',
			'4.2.2',
			'4.2.3',
			'4.2.4',
			'4.8.0',
			'4.9.0',
			'4.9.1',
			'4.9.2',
			'5.3.0',
			'5.3.1',
			'5.3.2',
			'5.4',
		);
		
		$tested_range = array(4.0,5.4);
		
		// IF the current wp version is  in our tested versions...
		// remove: if( !in_array( $wp_version, $tested_versions ) ):
		if( (float)$wp_version >= (float)$tested_range[0] && (float)$wp_version <= (float)$tested_range[1] ):
		
			// we're good!
		
		else:
			
			// get notice html
			$notice = slb_get_admin_notice('Snappy List Builder has not been tested in your version of WordPress. It still may work though...','error');
			
			// echo the notice html
			echo( $notice );
			
		endif;
	
	endif;
	
}

// 5.18
// hint: runs functions for plugin deactivation
function slb_uninstall_plugin() {
	
	// remove our custom plugin tables
	slb_remove_plugin_tables();
	// remove custom post types posts and data
	slb_remove_post_data();
	// remove plugin options
	slb_remove_options();
	
}

// 5.19
// hint: removes our custom database tabels
function slb_remove_plugin_tables() {
	
	// get WP's wpdb class
	global $wpdb;
	
	// setup return variable
	$tables_removed = false;
	
	try {
		
		// get our custom table name
		$table_name = $wpdb->prefix . "slb_reward_links";
	
		// delete table from database
		$tables_removed = $wpdb->query("DROP TABLE IF EXISTS $table_name;");
	
	} catch( Exception $e ) {
		
		
	}
	
	// return result
	return $tables_removed;
	
}

// 5.20
// hint: removes plugin related custom post type post data
function slb_remove_post_data() {
	
	// get WP's wpdb class
	global $wpdb;
	
	// setup return variable
	$data_removed = false;
	
	try {
		
		// get our custom table name
		$table_name = $wpdb->posts;
		
		// set up custom post types array
		$custom_post_types = array(
			'slb_subscriber',
			'slb_list'
		);
		
		// remove data from the posts db table where post types are equal to our custom post types
		$data_removed = $wpdb->query(
			"
				DELETE FROM $table_name 
				WHERE post_type = {$custom_post_types[0]} OR post_type = {$custom_post_types[1]}
			"
		);
		
		// get the table names for postmet and posts with the correct prefix
		$table_name_1 = $wpdb->postmeta;
		$table_name_2 = $wpdb->post;
		
		// delete orphaned meta data
		$wpdb->query(
			"
			DELETE pm
			FROM $table_name_1 pm
			LEFT JOIN $table_name_1 wp ON wp.ID = pm.post_id
			WHERE wp.ID IS NULL
			"
		);
		
		
		
	} catch( Exception $e ) {
		
		// php error
		
	}
	
	// return result
	return $data_removed;
	
}

// 5.21
// hint: removes any custom options from the database 
function slb_remove_options() {
	
	$options_removed = false;
	
	try {
	
		// get plugin option settings
		$options = slb_get_options_settings();
		
		// loop over all the settings
		foreach( $options['settings'] as &$setting ):
			
			// unregister the setting
			unregister_setting( $options['group'], $setting );
		
		endforeach;
	
	} catch( Exception $e ) {
		
		// php error
		
	}
	
	// return result
	return $options_removed;
	
}









/* !6. HELPERS */

// 6.1
// hint: returns true or false
function slb_subscriber_has_subscription( $subscriber_id, $list_id ) {
	
	// setup default return value
	$has_subscription = false;
	
	// get subscriber
	$subscriber = get_post($subscriber_id);
	
	// get subscriptions
	$subscriptions = slb_get_subscriptions( $subscriber_id );
	
	// check subscriptions for $list_id
	if( in_array($list_id, $subscriptions) ):
	
		// found the $list_id in $subscriptions
		// this subscriber is already subscribed to this list
		$has_subscription = true;
	
	else:
	
		// did not find $list_id in $subscriptions
		// this subscriber is not yet subscribed to this list
	
	endif;
	
	return $has_subscription;
	
}

// 6.2
// hint: retrieves a subscriber_id from an email address
function slb_get_subscriber_id( $email ) {
	
	$subscriber_id = 0;
	
	try {
	
		// check if subscriber already exists
		$subscriber_query = new WP_Query( 
			array(
				'post_type'		=>	'slb_subscriber',
				'posts_per_page' => 1,
				'meta_key' => 'slb_email',
				'meta_query' => array(
				    array(
				        'key' => 'slb_email',
				        'value' => $email,  // or whatever it is you're using here
				        'compare' => '=',
				    ),
				),
			)
		);
		
		// IF the subscriber exists...
		if( $subscriber_query->have_posts() ):
		
			// get the subscriber_id
			$subscriber_query->the_post();
			$subscriber_id = get_the_ID();
			
		endif;
	
	} catch( Exception $e ) {
		
		// a php error occurred
		
	}
		
	// reset the Wordpress post object
	wp_reset_query();
	
	return (int)$subscriber_id;
	
}

// 6.3
// hint: returns an array of list_id's
function slb_get_subscriptions( $subscriber_id ) {
	
	$subscriptions = array();
	
	// get subscriptions (returns array of list objects)
	$lists = get_field( slb_get_acf_key('slb_subscriptions'), $subscriber_id );
	
	// IF $lists returns something
	if( $lists ):
	
		// IF $lists is an array and there is one or more items
		if( is_array($lists) && count($lists) ):
			// build subscriptions: array of list id's
			foreach( $lists as &$list):
				$subscriptions[]= (int)$list->ID;
			endforeach;
		elseif( is_numeric($lists) ):
			// single result returned
			$subscriptions[]= $lists;
		endif;
	
	endif;
	
	return (array)$subscriptions;
	
}

// 6.4
function slb_return_json( $php_array ) {
	
	// encode result as json string
	$json_result = json_encode( $php_array );
	
	// return result
	die( $json_result );
	
	// stop all other processing 
	exit;
	
}


//6.5
// hint: gets the unique act field key from the field name
function slb_get_acf_key( $field_name ) {
	
	$field_key = $field_name;
	
	switch( $field_name ) {
		
		case 'slb_fname':
			$field_key = 'field_55c8ec63416a2';
			break;
		case 'slb_lname':
			$field_key = 'field_55c8ec76416a3';
			break;
		case 'slb_email':
			$field_key = 'field_55c8ec87416a4';
			break;
		case 'slb_subscriptions':
			$field_key = 'field_55c8ecac416a5';
			break;
		case 'slb_enable_reward':
			$field_key = 'field_55ce8fe510a17';
			break;
		case 'slb_reward_title':
			$field_key = 'field_55ce902710a18';
			break;
		case 'slb_reward_file':
			$field_key = 'field_55ce904710a19';
			break;
		
	}
	
	return $field_key;
	
}


// 6.6
// hint: returns an array of subscriber data including subscriptions
function slb_get_subscriber_data( $subscriber_id ) {
	
	// setup subscriber_data
	$subscriber_data = array();
	
	// get subscriber object
	$subscriber = get_post( $subscriber_id );
	
	// IF subscriber object is valid
	if( isset($subscriber->post_type) && $subscriber->post_type == 'slb_subscriber' ):
	
		$fname = get_field( slb_get_acf_key('slb_fname'), $subscriber_id);
		$lname = get_field( slb_get_acf_key('slb_lname'), $subscriber_id);
	
		// build subscriber_data for return
		$subscriber_data = array(
			'name'=> $fname .' '. $lname,
			'fname'=>$fname,
			'lname'=>$lname,
			'email'=>get_field( slb_get_acf_key('slb_email'), $subscriber_id),
			'subscriptions'=>slb_get_subscriptions( $subscriber_id )
		);
		
	
	endif;
	
	// return subscriber_data
	return $subscriber_data;
	
}

// 6.7
// hint: returns html for a page selector
function slb_get_page_select( $input_name="slb_page", $input_id="", $parent=-1, $value_field="id", $selected_value="" ) {
	
	// get WP pages
	$pages = get_pages( 
		array(
			'sort_order' => 'asc',
			'sort_column' => 'post_title',
			'post_type' => 'page',
			'parent' => $parent,
			'status'=>array('draft','publish'),	
		)
	);
	
	// setup our select html
	$select = '<select name="'. $input_name .'" ';
	
	// IF $input_id was passed in
	if( strlen($input_id) ):
	
		// add an input id to our select html
		$select .= 'id="'. $input_id .'" ';
	
	endif;
	
	// setup our first select option
	$select .= '><option value="">- Select One -</option>';
	
	// loop over all the pages
	foreach ( $pages as &$page ): 
	
		// get the page id as our default option value
		$value = $page->ID;
		
		// determine which page attribute is the desired value field
		switch( $value_field ) {
			case 'slug':
				$value = $page->post_name;
				break;
			case 'url':
				$value = get_page_link( $page->ID );
				break;
			default:
				$value = $page->ID;
		}
		
		// check if this option is the currently selected option
		$selected = '';
		if( $selected_value == $value ):
			$selected = ' selected="selected" ';
		endif;
	
		// build our option html
		$option = '<option value="' . $value . '" '. $selected .'>';
		$option .= $page->post_title;
		$option .= '</option>';
		
		// append our option to the select html
		$select .= $option;
		
	endforeach;
	
	// close our select html tag
	$select .= '</select>';
	
	// return our new select 
	return $select;
	
}

// 6.8
// hint: returns default option values as an associative array
function slb_get_default_options() {
	
	$defaults = array();
	
	try {
		
		// get front page id
		$front_page_id = get_option('page_on_front');
	
		// setup default email footer
		$default_email_footer = '
			<p>
				Sincerely, <br /><br />
				The '. get_bloginfo('name') .' Team<br />
				<a href="'. get_bloginfo('url') .'">'. get_bloginfo('url') .'</a>
			</p>
		';
		
		// setup defaults array
		$defaults = array(
			'slb_manage_subscription_page_id'=>$front_page_id,
			'slb_confirmation_page_id'=>$front_page_id,
			'slb_reward_page_id'=>$front_page_id,
			'slb_default_email_footer'=>$default_email_footer,
			'slb_download_limit'=>3,
		);
	
	} catch( Exception $e) {
		
		// php error
		
	}
	
	// return defaults
	return $defaults;
	
	
}

// 6.9
// hint: returns the requested page option value or it's default
function slb_get_option( $option_name ) {
	
	// setup return variable
	$option_value = '';	
	
	
	try {
		
		// get default option values
		$defaults = slb_get_default_options();
		
		// get the requested option
		switch( $option_name ) {
			
			case 'slb_manage_subscription_page_id':
				// subscription page id
				$option_value = (get_option('slb_manage_subscription_page_id')) ? get_option('slb_manage_subscription_page_id') : $defaults['slb_manage_subscription_page_id'];
				break;
			case 'slb_confirmation_page_id':
				// confirmation page id
				$option_value = (get_option('slb_confirmation_page_id')) ? get_option('slb_confirmation_page_id') : $defaults['slb_confirmation_page_id'];
				break;
			case 'slb_reward_page_id':
				// reward page id
				$option_value = (get_option('slb_reward_page_id')) ? get_option('slb_reward_page_id') : $defaults['slb_reward_page_id'];
				break;
			case 'slb_default_email_footer':
				// email footer
				$option_value = (get_option('slb_default_email_footer')) ? wpautop(get_option('slb_default_email_footer')) : $defaults['slb_default_email_footer'];
				break;
			case 'slb_download_limit':
				// reward download limit
				$option_value = (get_option('slb_download_limit')) ? (int)get_option('slb_download_limit') : $defaults['slb_download_limit'];
				break;
			
		}
		
	} catch( Exception $e) {
		
		// php error
		
	}
	
	// return option value or it's default
	return $option_value;
	
}

// 6.10
// hint: get's the current options and returns values in associative array
function slb_get_current_options() {
	
	// setup our return variable
	$current_options = array();
	
	try {
	
		// build our current options associative array
		$current_options = array(
			'slb_manage_subscription_page_id' => slb_get_option('slb_manage_subscription_page_id'),
			'slb_confirmation_page_id' => slb_get_option('slb_confirmation_page_id'),
			'slb_reward_page_id' => slb_get_option('slb_reward_page_id'),
			'slb_default_email_footer' => slb_get_option('slb_default_email_footer'),
			'slb_download_limit' => slb_get_option('slb_download_limit'),
		);
	
	} catch( Exception $e ) {
		
		// php error
	
	}
	
	// return current options
	return $current_options;
	
}

// 6.11
// hint: generates an html form for managing subscriptions
function slb_get_manage_subscriptions_html( $subscriber_id ) {
	
	$output = '';
	
	try {
		
		// get array of list_ids for this subscriber
		$lists = slb_get_subscriptions( $subscriber_id );
		
		// get the subscriber data
		$subscriber_data = slb_get_subscriber_data( $subscriber_id );
		
		// set the title
		$title = $subscriber_data['fname'] .'\'s Subscriptions';
	
		$nounce = wp_nonce_field( 'slb-update-subscriptions_'. $subscriber_id, '_wpnonce', true, false );
	
		// build out output html
		$output = '
			<form id="slb_manage_subscriptions_form" class="slb-form" method="post"  
			action="/wp-admin/admin-ajax.php?action=slb_unsubscribe">
			
				'. $nounce .'
				
				<input type="hidden" name="subscriber_id" value="'. $subscriber_id .'">
				
				<h3 class="slb-title">'. $title .'</h3>';
				
				if( !count($lists) ):
					
					$output .='<p>There are no active subscriptions.</p>';
				
				else:
				
					$output .= '<table>
						<tbody>';
						
						// loop over lists
						foreach( $lists as &$list_id ):
						
							$list_object = get_post( $list_id );
						
							$output .= '<tr>
								<td>'.
									$list_object->post_title
								.'</td>
								<td>
									<label>
										<input 
											type="checkbox" name="list_ids[]" 
											value="'. $list_object->ID .'" 
										/> UNSUBSCRIBE
									</label>
								</td>
							</tr>';
							
						endforeach;
						
						// close up our output html
						$output .='</tbody>
					</table>
					
					<p><input type="submit" value="Save Changes" /></p>';
				
				endif;
				
			$output .='
				</form>
			';
	
	} catch( Exception $e ) {
		
		// php error
		
	}
	
	// return output 
	return $output;
	
}

// 6.12
// hint: returns an array of email template data IF the template exists
function slb_get_email_template( $subscriber_id, $email_template_name, $list_id ) {
	
	// setup return variable
	$template_data = array();
	
	// create new array to store email templates
	$email_templates = array();
	
	// get list object
	$list = get_post( $list_id );
	
	// get subscriber object
	$subscriber = get_post( $subscriber_id );
	
	if( !slb_validate_list( $list ) || !slb_validate_subscriber( $subscriber ) ):
	
		// the list or the subscriber is not valid
	
	else:
	
		// get subscriber data 
		$subscriber_data = slb_get_subscriber_data( $subscriber_id );
	
		// get unique manage subscription link
		$manage_subscriptions_link = slb_get_manage_subscriptions_link( $subscriber_data['email'], $list_id );
		
		// get default email header 
		$default_email_header = '
			<p>
				Hello '. $subscriber_data['fname'] .',
			</p>
		';
		
		// get default email footer 
		$default_email_footer = slb_get_option('slb_default_email_footer');
		
		// setup unsubscribe text
		$unsubscribe_text = '
			<br /><br />
			<hr />
			<p><a href="'. $manage_subscriptions_link .'">Click here to unsubscribe</a> from this or any other email list.</p>';
			
		// get reward
		$reward = slb_get_list_reward( $list_id );
		
		// setup reward text 
		$reward_text = '';
		
		// IF reward exists
		if( $reward !== false ):
		
			// setup the appropriate reward text
			switch( $email_template_name ) {
				
				case 'new_subscription':
					// set reward text
					$reward_text = '<p>After confirming your subscription, we will send you a link for a FREE DOWNLOAD of '. $reward['title'] .'</p>';
					break;
				case 'subscription_confirmed':
					// get download limit
					$download_limit = slb_get_option('slb_download_limit');
					// generate new download link
					$download_link = slb_get_reward_link( $subscriber_id, $list_id );
					// set reward text
					$reward_text = '<p>Here is your <a href="'. $download_link .'">UNIQUE DOWNLOAD LINK</a> for '. $reward['title'] .'. This link will expire after '. $download_limit .' downloads</p>';
					break;
				
			}
		
		endif;
		
		// setup email templates
		
			// get unique opt-in link
			$optin_link = slb_get_optin_link( $subscriber_data['email'], $list_id );
			
			// template: new_subscription
			$email_templates['new_subscription'] = array(
				'subject' => 'Thank you for subscribing to '. $list->post_title .'! Please confirm your subscription.',
				'body' => '
					'. $default_email_header .'
					<p>Thank you for subscribing to '. $list->post_title .'!</p>
					<p>Please <a href="'. $optin_link .'">click here to confirm your subscription.</a></p>
					'. $reward_text . $default_email_footer . $unsubscribe_text,
			);
			
			// template: subscription_confirmed
			$email_templates['subscription_confirmed'] = array(
				'subject' => 'You are now subscribed to '. $list->post_title .'!',
				'body' => '
					'. $default_email_header .'
					<p>Thank you for confirming your subscription. You are now subscribed to '. $list->post_title .'!</p>
					'. $reward_text . $default_email_footer . $unsubscribe_text,
			);

	
	endif;
	
	// IF the requested email template exists
	if( isset( $email_templates[ $email_template_name ] ) ):
	
		// add template data to return variable
		$template_data = $email_templates[ $email_template_name ];
	
	endif;
	
	// return template data
	return $template_data;
	
}

// 6.13
// hint: validates whether the post object exists and that it's a validate post_type
function slb_validate_list( $list_object ) {
	
	$list_valid = false;
	
	if( isset($list_object->post_type) && $list_object->post_type == 'slb_list' ):
	
		$list_valid = true;
	
	endif;
	
	return $list_valid;
	
}

// 6.14
// hint: validates whether the post object exists and that it's a validate post_type
function slb_validate_subscriber( $subscriber_object ) {
	
	$subscriber_valid = false;
	
	if( isset($subscriber_object->post_type) && $subscriber_object->post_type == 'slb_subscriber' ):
	
		$subscriber_valid = true;
	
	endif;
	
	return $subscriber_valid;
	
}

// 6.15
// hint: returns a unique link for managing a particular users subscriptions
function slb_get_manage_subscriptions_link( $email, $list_id=0 ) {
	
	$link_href = '';
	
	try {
		
		$page = get_post( slb_get_option('slb_manage_subscription_page_id') );
		$slug = $page->post_name;
		
		$permalink = get_permalink($page);
		
		// get character to start querystring
		$startquery = slb_get_querystring_start( $permalink );
		
		$link_href = $permalink . $startquery .'email='. urlencode($email) .'&list='. $list_id;
		
	} catch( Exception $e ) {
		
		//$link_href = $e->getMessage();
		
	}
	
	return esc_url($link_href);
	
}

// 6.16
// hint: returns the appropriate character for the begining of a querystring
function slb_get_querystring_start( $permalink ) {
	
	// setup our default return variable
	$querystring_start = '&';
	
	// IF ? is not found in the permalink
	if( strpos($permalink, '?') === false ):
		$querystring_start = '?';
	endif;
	
	return $querystring_start;
	
}

// 6.17
// hint: returns a unique link for opting into an email list
function slb_get_optin_link( $email, $list_id=0 ) {
	
	$link_href = '';
	
	try {
		
		$page = get_post( slb_get_option('slb_confirmation_page_id') );
		$slug = $page->post_name;
		$permalink = get_permalink($page);
		
		// get character to start querystring
		$startquery = slb_get_querystring_start( $permalink );
		
		$link_href = $permalink . $startquery .'email='. urlencode($email) .'&list='. $list_id;
		
	} catch( Exception $e ) {
		
		//$link_href = $e->getMessage();
		
	}
	
	return esc_url($link_href);
	
}

// 6.18
// hint: returns html for messags
function slb_get_message_html( $message, $message_type ) {
	
	$output = '';
	
	try {
		
		$message_class = 'confirmation';
		
		switch( $message_type ) {
			case 'warning': 
				$message_class = 'slb-warning';
				break;
			case 'error': 
				$message_class = 'slb-error';
				break;
			default:
				$message_class = 'slb-confirmation';
				break;
		}
		
		$output .= '
			<div class="slb-message-container">
				<div class="slb-message '. $message_class .'">
					<p>'. $message .'</p>
				</div>
			</div>
		';
		
	} catch( Exception $e ) {
		
	}
	
	return $output;
	
}

// 6.19
// hint: returns false if list has no reward or returns the object containing file and title if it does
function slb_get_list_reward( $list_id ) {
	
	// setup return data
	$reward_data = false;
	
	// get enable_reward value
	$enable_reward = ( get_field( slb_get_acf_key('slb_enable_reward'), $list_id) ) ? true : false;
	
	// IF reward is enabled for this list
	if( $enable_reward ):
	
		// get reward file
		$reward_file = ( get_field( slb_get_acf_key('slb_reward_file'), $list_id) ) ? get_field( slb_get_acf_key('slb_reward_file'), $list_id) : false;
		// get reward title
		$reward_title = ( get_field(slb_get_acf_key('slb_reward_title'), $list_id) ) ? get_field(slb_get_acf_key('slb_reward_title'), $list_id) : 'Reward';
		
		
		
		// IF reward_file is a valid array
		if( is_array($reward_file) ):
	
	
			// setup return data
			$reward_data = array(
				'file' => $reward_file,
				'title' => $reward_title,
			);
		
		endif;
	
	endif;
	
	// return $reward_data
	return $reward_data;
	
}

// 6.20
// hint: returns a unique link for downloading a reward file
function slb_get_reward_link( $subscriber_id, $list_id ) {
	
	$link_href = '';
	
	try {
		
		$page = get_post( slb_get_option('slb_reward_page_id') );
		$slug = $page->post_name;
		$permalink = get_permalink($page);
		
		// generate unique uid for reward link
		$uid = slb_generate_reward_uid( $subscriber_id, $list_id );
		
		// get list reward
		$reward = slb_get_list_reward( $list_id );
		
		// IF an attachment id was returned
		if( $uid && $reward !== false ):
		
			// add reward link to database
			$link_added = slb_add_reward_link( $uid, $subscriber_id, $list_id, $reward['file']['id'] );
			
			// IF link was added successfully
			if( $link_added === true ):
				
				// get character to start querystring
				$startquery = slb_get_querystring_start( $permalink );
			
				// build reward link
				$link_href = $permalink . $startquery .'reward='. urlencode($uid);
			
			endif;
		
		endif;
		
	} catch( Exception $e ) {
		
		//$link_href = $e->getMessage();
		
	}
	
	// return reward link
	return esc_url($link_href);
	
}

// 6.21
// hint: generates a unique 
function slb_generate_reward_uid( $subscriber_id, $list_id ) {
	
	// setup our return variable
	$uid = '';
	
	// get subscriber post object
	$subscriber = get_post( $subscriber_id );
	
	// get list post object
	$list = get_post( $list_id );
	
	// IF subscriber and list are valid
	if( slb_validate_subscriber( $subscriber ) && slb_validate_list( $list ) ):
			
			// get list reward
			$reward = slb_get_list_reward( $list_id );
			
			// IF reward is not equal to false
			if( $reward !== false ):
				
				// generate a unique id
				$uid = uniqid( 'slb', true );
			
			endif;
			
	
	endif;
	
	return $uid;
	
}

// 6.22
// hint: returns false if list has no reward or returns the object containing file and title if it does
function slb_get_reward( $uid ) {
	
	global $wpdb;
	
	// setup return data
	$reward_data = false;
	
	// reward links download table name
	$table_name = $wpdb->prefix . "slb_reward_links";
	
	// get list id from reward link
	$list_id = $wpdb->get_var( 
		$wpdb->prepare( 
			"
				SELECT list_id 
				FROM $table_name 
				WHERE uid = %s
			", 
			$uid
		) 
	);
	
	// get downloads from reward link
	$downloads = $wpdb->get_var( 
		$wpdb->prepare( 
			"
				SELECT downloads 
				FROM $table_name 
				WHERE uid = %s
			", 
			$uid
		) 
	);
	
	// get reward data
	$reward = slb_get_list_reward( $list_id );
	
	// IF reward was found
	if( $reward !== false ):
	
		// set reward data
		$reward_data = $reward;
		
		// add downloads to reward data
		$reward_data['downloads']=$downloads;
		
	endif;
	
	// return $reward_data
	return $reward_data;
	
}

// 6.23
// hint: returns an array of subscriber_id's
function slb_get_list_subscribers( $list_id=0 ) {
	
	// setup return variable
	$subscribers = false;
	
	// get list object
	$list = get_post( $list_id );
	
	if( slb_validate_list( $list ) ):
			
		// query all subscribers from post this list only
		$subscribers_query = new WP_Query( 
			array(
				'post_type' => 'slb_subscriber',
				'published' => true,
				'posts_per_page' => -1,
				'orderby'=>'post_date',
				'order'=>'DESC',
				'status'=>'publish',
				'meta_query' => array(
					array(
						'key' => 'slb_subscriptions', 
						'value' => ':"'.$list->ID.'"', 
						'compare' => 'LIKE'
					)
				)
			)
		);
		
	elseif( $list_id === 0 ):
	
		// query all subscribers from all lists
		$subscribers_query = new WP_Query( 
			array(
				'post_type' => 'slb_subscriber',
				'published' => true,
				'posts_per_page' => -1,
				'orderby'=>'post_date',
				'order'=>'DESC',
			)
		);
	
	endif;
		
	// IF $subscribers_query isset and query returns results
	if( isset($subscribers_query) && $subscribers_query->have_posts() ):
	
		// set subscribers array
		$subscribers = array();
		
		// loop over results
		while ($subscribers_query->have_posts() ) : 
		
			// get the post object
			$subscribers_query->the_post();
			
			$post_id = get_the_ID();
		
			// append result to subscribers array
			array_push( $subscribers, $post_id);
		
		endwhile;
	
	endif;
	
	// reset wp query/postdata
	wp_reset_query();
	wp_reset_postdata();
	
	// return result
	return $subscribers;
}

// 6.24
// hint: returns the amount of subscribers in this list
function slb_get_list_subscriber_count( $list_id = 0 ) {
	
	// setup return variable
	$count = 0;
	
	// get array of subscribers ids
	$subscribers = slb_get_list_subscribers( $list_id );
	
	// IF array was returned
	if( $subscribers !== false ):
	
		// update count
		$count = count($subscribers);
	
	endif;
	
	// return result
	return $count;
	
}

// 6.25
// hint: returns a unique link for downloading a subscribers csv
function slb_get_export_link( $list_id=0 ) {
	
	$link_href = 'admin-ajax.php?action=slb_download_subscribers_csv&list_id='. $list_id;
	
	// return reward link
	return esc_url($link_href);
	
}

// 6.26
// hint: this function reads a csv file and converts the contents into a php array
function slb_csv_to_array($filename='', $delimiter=',')
{

	// this is an important setting!
	ini_set('auto_detect_line_endings', true);
	
	// IF the file doesn't exist or the file is not readable return false
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;
      
    // setup our return data  
    $return_data = array();
    
    // IF we can open and read the file
    if (($handle = fopen($filename, "r")) !== FALSE) {
	  
	  	$row = 0;
	  
	    // while data exists loop over data
	    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        // count the number of items in this data
	        $num = count($data);
	        // increment our row variable
	        $row++;
	        // setup our row data array
	        $row_data = array();
	        // loop over all items and append them to our row data
	        for ($c=0; $c < $num; $c++) {
	            // if this is the first row set it up as our header
				if( $row == 1):
					$header[] = $data[$c];
				else:
					// all rows greate than 1
					// add row data item
					$return_data[$row-2][$header[$c]] = $data[$c];
				endif;
	        }
	    } 
	    
	    // close our file
	    fclose($handle);
	}
	
	// return the new data as a php array
    return $return_data;
}



// 6.27
// hint: returns html formatted for WP admin notices
function slb_get_admin_notice( $message, $class ) {
	
	// setup our return variable
	$output = '';
	
	try {
		
		// create output html
		$output = '
		 <div class="'. $class .'">
		    <p>'. $message .'</p>
		</div>
		';
	    
	} catch( Exception $e ) {
		
		// php error
		
	}
	
	// return output
	return $output;
	
}

// 6.28
// hint: get's an array of plugin option data (group and settings) so as to save it all in one place
function slb_get_options_settings() {
	
	// setup our return data
	$settings = array( 
		'group'=>'slb_plugin_options',
		'settings'=>array(
			'slb_manage_subscription_page_id',
			'slb_confirmation_page_id',
			'slb_reward_page_id',
			'slb_default_email_footer',
			'slb_download_limit',
		),
	);
	
	// return option data
	return $settings;
	
}




/* !7. CUSTOM POST TYPES */

// 7.1
// subscribers
include_once( plugin_dir_path( __FILE__ ) . 'cpt/slb_subscriber.php');

//7.2
// lists
include_once( plugin_dir_path( __FILE__ ) . 'cpt/slb_list.php');




/* !8. ADMIN PAGES */

// 8.1
// hint: dashboard admin page
function slb_dashboard_admin_page() {
	
	// get our export link
	$export_href = slb_get_export_link();
	
	$output = '
		<div class="wrap">
			
			<h2>Snappy List Builder</h2>
			
			<p>The ultimate email list building plugin for WordPress. Capture new subscribers. Reward subscribers with a custom download upon opt-in. Build unlimited lists. Import and export subscribers easily with .csv</p>
			
			<p><a href="'. $export_href .'"  class="button button-primary">Export All Subscriber Data</a></p>
		
		</div>
	';
	
	echo $output;
	
}

// 8.2
// hint: import subscribers admin page
function slb_import_admin_page() {
	
	// enque special scripts required for our file import field
	wp_enqueue_media();
	
	echo('
	
	<div class="wrap" id="import_subscribers">
			
			<h2>Import Subscribers</h2>
						
			<form id="import_form_1">
			
				<table class="form-table">
				
					<tbody>
				
						<tr>
							<th scope="row"><label for="slb_import_file">Import CSV</label></th>
							<td>
								
								<div class="wp-uploader">
								    <input type="text" name="slb_import_file_url" class="file-url regular-text" accept="csv">
								    <input type="hidden" name="slb_import_file_id" class="file-id" value="0" />
								    <input type="button" name="upload-btn" class="upload-btn button-secondary" value="Upload">
								</div>
								
								
								<p class="description" id="slb_import_file-description">Expects a CSV file containing a   "Name" (First, Last or Full) and "Email Address".</p>
							</td>
						</tr>
						
					</tbody>
					
				</table>
				
			</form>
			
			<form id="import_form_2" method="post"
			action="/wp-admin/admin-ajax.php?action=slb_import_subscribers">
				
				<table class="form-table">
				
					<tbody class="slb-dynamic-content">
						
					</tbody>
					
					<tbody class="form-table show-only-on-valid" style="display: none">
						
						<tr>
							<th scope="row"><label>Import To List</label></th>
							<td>
								<select name="slb_import_list_id">');
									
									
										// get all our email lists
										$lists = get_posts(
											array(
												'post_type'			=>'slb_list',
												'status'			=>'publish',
												'posts_per_page'   	=> -1,
												'orderby'         	=> 'post_title',
												'order'            	=> 'ASC',
											)
										);
										
										// loop over each email list
										foreach( $lists as &$list ):
										
											// create the select option for that list
											$option = '
												<option value="'. $list->ID .'">
													'. $list->post_title .'
												</option>';
											
											// echo the new option	
											echo $option;
											
										
										endforeach;
										
								echo('</select>
								<p class="description"></p>
							</td>
						</tr>
						
					</tbody>
					
				</table>
				
				<p class="submit show-only-on-valid" style="display:none"><input type="submit" name="submit" id="submit" class="button button-primary" value="Import"></p>
				
			</form>
			
	</div>
	
	');
	
}

// 8.3
// hint: plugin options admin page
function slb_options_admin_page() {
	
	// get the default values for our options
	$options = slb_get_current_options();
	
	echo('<div class="wrap">
		
		<h2>Snappy List Builder Options</h2>
		
		<form action="options.php" method="post">');
		
			// outputs a unique nounce for our plugin options
			settings_fields('slb_plugin_options');
			
			echo('<table class="form-table">
			
				<tbody>
			
					<tr>
						<th scope="row"><label for="slb_manage_subscription_page_id">Manage Subscriptions Page</label></th>
						<td>
							'. slb_get_page_select( 'slb_manage_subscription_page_id', 'slb_manage_subscription_page_id', 0, 'id', $options['slb_manage_subscription_page_id'] ) .'
							<p class="description" id="slb_manage_subscription_page_id-description">This is the page where Snappy List Builder will send subscribers to manage their subscriptions. <br />
								IMPORTANT: In order to work, the page you select must contain the shortcode: <strong>[slb_manage_subscriptions]</strong>.</p>
						</td>
					</tr>
					
			
					<tr>
						<th scope="row"><label for="slb_confirmation_page_id">Opt-In Page</label></th>
						<td>
							'. slb_get_page_select( 'slb_confirmation_page_id', 'slb_confirmation_page_id', 0, 'id', $options['slb_confirmation_page_id'] ) .'
							<p class="description" id="slb_confirmation_page_id-description">This is the page where Snappy List Builder will send subscribers to confirm their subscriptions. <br />
								IMPORTANT: In order to work, the page you select must contain the shortcode: <strong>[slb_confirm_subscription]</strong>.</p>
						</td>
					</tr>
					
			
					<tr>
						<th scope="row"><label for="slb_reward_page_id">Download Reward Page</label></th>
						<td>
							'. slb_get_page_select( 'slb_reward_page_id', 'slb_reward_page_id', 0, 'id', $options['slb_reward_page_id'] ) .'
							<p class="description" id="slb_reward_page_id-description">This is the page where Snappy List Builder will send subscribers to retrieve their reward downloads. <br />
								IMPORTANT: In order to work, the page you select must contain the shortcode: <strong>[slb_download_reward]</strong>.</p>
						</td>
					</tr>
			
					<tr>
						<th scope="row"><label for="slb_default_email_footer">Email Footer</label></th>
						<td>');
						
							
							// wp_editor will act funny if it's stored in a string so we run it like this...
							wp_editor( $options['slb_default_email_footer'], 'slb_default_email_footer', array( 'textarea_rows'=>8 ) );
							
							
							echo('<p class="description" id="slb_default_email_footer-description">The default text that appears at the end of emails generated by this plugin.</p>
						</td>
					</tr>
			
					<tr>
						<th scope="row"><label for="slb_download_limit">Reward Download Limit</label></th>
						<td>
							<input type="number" name="slb_download_limit" value="'. $options['slb_download_limit'] .'" class="" />
							<p class="description" id="slb_download_limit-description">The amount of downloads a reward link will allow before expiring.</p>
						</td>
					</tr>
			
				</tbody>
				
			</table>');
		
			// outputs the WP submit button html
			@submit_button();
		
		
		echo('</form>
	
	</div>');
	
}





/* !9. SETTINGS */

// 9.1
// hint: registers all our plugin options
function slb_register_options() {
	
	// get plugin options settings
	
	$options = slb_get_options_settings();
	
	// loop over settings
	foreach( $options['settings'] as $setting ):
	
		// register this setting
		register_setting($options['group'], $setting);
	
	endforeach;
	
}




/* !10. MISC. */

function slb_acf_settings_dir( $dir ) {
    $dir = plugin_dir_url( __FILE__ ) . '/lib/advanced-custom-fields/';
    return $dir;  
}

function slb_acf_settings_path( $path ) {
    $path = plugin_dir_url(__FILE__) . '/lib/advanced-custom-fields/';
    return $path;   
}

function slb_acf_init() {
	//acf_update_setting('google_api_key', 'your_api_key');
}
