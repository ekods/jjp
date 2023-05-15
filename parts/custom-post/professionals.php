<?php

	function register_professionals() {

		/**
		 * Post Type: Professionals
		 */

		$labels = array(
			"name" => __( "Professionals", "jjp_themes" ),
			"singular_name" => __( "Professionals", "jjp_themes" ),
			"menu_name" => __( "Professionals", "jjp_themes" ),
			"all_items" => __( "All Professionals", "jjp_themes" ),
			"add_new" => __( "Add Professionals", "jjp_themes" ),
			"add_new_item" => __( "Add New Professionals", "jjp_themes" ),
			"edit_item" => __( "Edit Professionals", "jjp_themes" ),
			"new_item" => __( "New Professionals", "jjp_themes" ),
			"view_item" => __( "View Professionals", "jjp_themes" ),
			"view_items" => __( "View Professionals", "jjp_themes" ),
		);

		$args = array(
			"label" => __( "Professionals", "jjp_themes" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			'taxonomies' => array('professionals-category'),
			//'rewrite' => array('slug' => 'Professionals/%Professionals-category%', 'with_front' => false),
			'rewrite' => array('slug' => 'professionals', 'with_front' => false),
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

	  register_post_type( "professionals", $args );
	}
	add_action( 'init', 'register_professionals' );

	function professionals_init() {
			register_taxonomy(
					'professionals-category',
					'professionals',
					array(
							'label' => __( 'Professionals Category' ),
							'rewrite' => array( 'slug' => 'professionals' ),
							'hierarchical' => true,
							'show_ui' => true,
			        'show_admin_column' => true,
			        'query_var' => true,
					)
			);
	}
	add_action( 'init', 'professionals_init' );

 ?>
