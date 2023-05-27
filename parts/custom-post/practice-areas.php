<?php

	function register_practice_areas() {

		/**
		 * Post Type: Practice Areas
		 */

		$labels = array(
			"name" => __( "Practice Areas", "jjp_themes" ),
			"singular_name" => __( "Practice Areas", "jjp_themes" ),
			"menu_name" => __( "Practice Areas", "jjp_themes" ),
			"all_items" => __( "All Practice Areas", "jjp_themes" ),
			"add_new" => __( "Add Practice Areas", "jjp_themes" ),
			"add_new_item" => __( "Add New Practice Areas", "jjp_themes" ),
			"edit_item" => __( "Edit Practice Areas", "jjp_themes" ),
			"new_item" => __( "New Practice Areas", "jjp_themes" ),
			"view_item" => __( "View Practice Areas", "jjp_themes" ),
			"view_items" => __( "View Practice Areas", "jjp_themes" ),
		);

		$args = array(
			"label" => __( "Practice Areas", "jjp_themes" ),
			"labels" => $labels,
			"description" => "",
			"public" => true,
			"publicly_queryable" => true,
			"show_ui" => true,
			"show_in_rest" => true,
			"rest_base" => "",
			// 'taxonomies' => array('practice_areas-category'),
			// 'rewrite' => array('slug' => 'practice_areas/%practice_areas-category%', 'with_front' => false),
			'rewrite' => array('slug' => 'practice_areas', 'with_front' => false),
			"has_archive" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"show_in_admin_bar" => true,
	    "menu_icon" => "dashicons-cart",
	    "menu_position" => 4,
			"show_in_nav_menus" => true,
			"exclude_from_search" => true,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"query_var" => true,
			"supports" => array( "title", "thumbnail", "editor", "excerpt"),
		);

	  register_post_type( "practice_areas", $args );
	}
	add_action( 'init', 'register_practice_areas' );

	function practice_areas_init() {
			register_taxonomy(
					'practice_areas-category',
					'practice_areas',
					array(
							'label' => __( 'Practice Areas Category' ),
							'rewrite' => array( 'slug' => 'practice_areas' ),
							'hierarchical' => true,
							'show_ui' => true,
			        'show_admin_column' => true,
			        'query_var' => true,
					)
			);
	}
	add_action( 'init', 'practice_areas_init' );



	add_filter('post_type_link', 'projectcategory_permalink_structure', 10, 4);
	function projectcategory_permalink_structure($post_link, $post, $leavename, $sample) {
	    if (false !== strpos($post_link, '%practice_areas-category%')) {
	        $projectscategory_type_term = get_the_terms($post->ID, 'practice_areas-category');
	        if (!empty($projectscategory_type_term))
	            $post_link = str_replace('%practice_areas-category%', array_pop($projectscategory_type_term)->
	            slug, $post_link);
	        else
	            $post_link = str_replace('%practice_areas-category%', 'uncategorized', $post_link);
	    }
	    return $post_link;
	}

 ?>
