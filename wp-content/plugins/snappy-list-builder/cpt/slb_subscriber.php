<?php
	
add_action( 'init', 'slb_register_slb_subscriber' );
function slb_register_slb_subscriber() {
	$labels = array(
		"name" => "Subscribers",
		"singular_name" => "Subscriber",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "slb_subscriber", "with_front" => false ),
		"query_var" => true,
				
		"supports" => false,		
	);
	register_post_type( "slb_subscriber", $args );

// End of cptui_register_my_cpts()
}

	
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_subscriber-details',
		'title' => 'Subscriber Details',
		'fields' => array (
			array (
				'key' => 'field_55c8ec63416a2',
				'label' => 'First Name',
				'name' => 'slb_fname',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55c8ec76416a3',
				'label' => 'Last Name',
				'name' => 'slb_lname',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55c8ec87416a4',
				'label' => 'Email Address',
				'name' => 'slb_email',
				'type' => 'email',
				'required' => 1,
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				
				'key' => 'field_55c8ecac416a5',
				'label' => 'Subscriptions',
				'name' => 'slb_subscriptions',
				'allow_null' => 1,
				'multiple' => 1,
				'type' => 'relationship',
				'return_format' => 'object',
				'post_type' => array (
					0 => 'slb_list',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					1 => 'post_title',
				),
				'max' => ''
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slb_subscriber',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'revisions',
				7 => 'slug',
				8 => 'author',
				9 => 'format',
				10 => 'featured_image',
				11 => 'categories',
				12 => 'tags',
				13 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}
