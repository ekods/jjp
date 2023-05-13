<?php

	function register_proffesionals() {

		/**
		 * Post Type: Proffesionals
		 */

		$labels = array(
			"name" => __( "Proffesionals", "jjp_themes" ),
			"singular_name" => __( "Proffesionals", "jjp_themes" ),
			"menu_name" => __( "Proffesionals", "jjp_themes" ),
			"all_items" => __( "All Proffesionals", "jjp_themes" ),
			"add_new" => __( "Add Proffesionals", "jjp_themes" ),
			"add_new_item" => __( "Add New Proffesionals", "jjp_themes" ),
			"edit_item" => __( "Edit Proffesionals", "jjp_themes" ),
			"new_item" => __( "New Proffesionals", "jjp_themes" ),
			"view_item" => __( "View Proffesionals", "jjp_themes" ),
			"view_items" => __( "View Proffesionals", "jjp_themes" ),
		);

		$args = array(
			"label" => __( "Proffesionals", "jjp_themes" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			'taxonomies' => array('proffesionals-category'),
			//'rewrite' => array('slug' => 'proffesionals/%proffesionals-category%', 'with_front' => false),
			'rewrite' => array('slug' => 'proffesionals', 'with_front' => false),
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

	  register_post_type( "proffesionals", $args );
	}
	add_action( 'init', 'register_proffesionals' );

	function proffesionals_init() {
			register_taxonomy(
					'proffesionals-category',
					'proffesionals',
					array(
							'label' => __( 'Proffesionals Category' ),
							'rewrite' => array( 'slug' => 'proffesionals' ),
							'hierarchical' => true,
							'show_ui' => true,
			        'show_admin_column' => true,
			        'query_var' => true,
					)
			);
	}
	add_action( 'init', 'proffesionals_init' );

 ?>
