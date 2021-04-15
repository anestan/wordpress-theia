<?php
	
add_action( 'init', 'slb_register_slb_list' );
function slb_register_slb_list() {

	$labels = array(
		"name" => "Lists",
		"singular_name" => "Lists",
		);

	$args = array(
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "slb_list", "with_front" => false ),
		"query_var" => true,
				
		"supports" => array( "title" ),		
	);
	register_post_type( "slb_list", $args );

// End of cptui_register_my_cpts()
}

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_list-settings',
		'title' => 'List Settings',
		'fields' => array (
			array (
				'key' => 'field_55ce8fe510a17',
				'label' => 'Enable Reward on Opt-In',
				'name' => 'slb_enable_reward',
				'type' => 'radio',
				'instructions' => 'Whether or not you\'d like to reward subscribers when they sign-up to your list.',
				'choices' => array (
					0 => 'No',
					1 => 'Yes',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 0,
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_55ce902710a18',
				'label' => 'Reward Title',
				'name' => 'slb_reward_title',
				'type' => 'text',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55ce8fe510a17',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55ce904710a19',
				'label' => 'Reward File',
				'name' => 'slb_reward_file',
				'type' => 'file',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_55ce8fe510a17',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'object',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slb_list',
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

