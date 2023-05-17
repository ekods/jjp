<?php

	function register_testimonials() {

		/**
		 * Post Type: Testimonials
		 */

		$labels = array(
			"name" => __( "Testimonials", "jjp_themes" ),
			"singular_name" => __( "Testimonials", "jjp_themes" ),
			"menu_name" => __( "Testimonials", "jjp_themes" ),
			"all_items" => __( "All Testimonials", "jjp_themes" ),
			"add_new" => __( "Add Testimonials", "jjp_themes" ),
			"add_new_item" => __( "Add New Testimonials", "jjp_themes" ),
			"edit_item" => __( "Edit Testimonials", "jjp_themes" ),
			"new_item" => __( "New Testimonials", "jjp_themes" ),
			"view_item" => __( "View Testimonials", "jjp_themes" ),
			"view_items" => __( "View Testimonials", "jjp_themes" ),
		);

		$args = array(
			"label" => __( "Testimonials", "jjp_themes" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			'taxonomies' => array('testimonials-year'),
			//'rewrite' => array('slug' => 'testimonials/%testimonials-category%', 'with_front' => false),
			'rewrite' => array('slug' => 'testimonials', 'with_front' => false),
			"has_archive" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"show_in_admin_bar" => true,
	    "menu_icon" => "dashicons-businessman",
	    "menu_position" => 4,
			"show_in_nav_menus" => true,
			"exclude_from_search" => true,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"query_var" => true,
			"supports" => array( "title", "thumbnail", "editor"),
		);

	  register_post_type( "testimonials", $args );
	}
	add_action( 'init', 'register_testimonials' );

	function testimonials_init() {
			register_taxonomy(
					'testimonials-year',
					'testimonials',
					array(
							'label' => __( 'Testimonials Year' ),
							'rewrite' => array( 'slug' => 'testimonials' ),
							'hierarchical' => true,
							'show_ui' => true,
			        'show_admin_column' => true,
			        'query_var' => true,
					)
			);
	}
	add_action( 'init', 'testimonials_init' );

 ?>
