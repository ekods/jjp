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
			'taxonomies' => array('testimonials-year', 'testimonials-media'),
			//'rewrite' => array('slug' => 'testimonials/%testimonials-category%', 'with_front' => false),
			'rewrite' => array('slug' => 'testimonials', 'with_front' => false),
			"has_archive" => false,
			"show_ui" => true,
			"show_in_menu" => true,
			"show_in_nav_menus" => true,
			"show_in_admin_bar" => true,
	    "menu_icon" => "dashicons-testimonial",
	    "menu_position" => 4,
			"show_in_nav_menus" => true,
			"exclude_from_search" => true,
			"capability_type" => "post",
			"map_meta_cap" => true,
			"hierarchical" => false,
			"query_var" => true,
			"supports" => array( "title", "editor"),
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

			register_taxonomy(
				'testimonials-media',
				'testimonials',
				array(
						'label' => __( 'Media' ),
						'rewrite' => array( 'slug' => 'testimonials' ),
						'hierarchical' => true,
						'show_ui' => true,
						'show_admin_column' => true,
						'query_var' => true,
				)
		);
	}
	add_action( 'init', 'testimonials_init' );



	add_action('testimonials-media_add_form_fields', 'add_term_image', 10, 2);
	function add_term_image($taxonomy){
	    ?>

				<div class="form-field term-description-wrap">
					<label for="icon_images">Icon Images</label>
					<input id="icon_images" type="hidden" name="term_meta[icon_images]" value="">
					<img id="url_icon_images" src="" alt="" width="200px;">
					<br>
					<br>
					<input id="icon_images-btn" type="button" field-url="url_icon_images" field-id="icon_images" class="button upload" value="Upload" />
				</div>

	    <?php
	}

	add_action('created_testimonials-media', 'save_term_image', 10, 2);
	function save_term_image($term_id, $tt_id) {
		if (isset($_POST['term_meta'])) {
	    $t_id = $term_id;
	    $term_meta = get_option("taxonomy_term_$t_id");
	    $cat_keys = array_keys($_POST['term_meta']);
	    foreach ($cat_keys as $key) {
	        if (isset($_POST['term_meta'][$key])) {
	            $term_meta[$key] = $_POST['term_meta'][$key];
	        }
	    }
	    //save the option array
	    update_option("taxonomy_term_$t_id", $term_meta);
	   }
	}


	add_action('testimonials-media_edit_form_fields', 'edit_image_upload', 10, 2);
	function edit_image_upload($term, $taxonomy) {

	    // get current group
	    $txt_upload_image = get_term_meta($term->term_id, 'term_image', true);
			$term_meta = get_option("taxonomy_term_$term->term_id");
			$is_checked = ($term_meta['display_filter'] == 1) ? 'checked' : '';
	?>


			<table class="form-table" role="presentation">
				<tr class="form-field term-description-wrap">
					<th scope="row">
						<label for="icon_images">Icon Images</label>
					</th>
					<td>
						<input id="icon_images" type="hidden" name="term_meta[icon_images]" value="<?php echo $term_meta['icon_images'] ?>">
						<img id="url_icon_images" src="<?php echo $term_meta['icon_images']; ?>" alt="" width="200px;">
						<br>
						<br>
						<input id="icon_images-btn" type="button" field-url="url_icon_images" field-id="icon_images" class="button upload" value="Upload" />
					</td>
				</tr>
			</table>
		</table>


	<?php
	}

	add_action('edited_testimonials-media', 'update_term_image', 10, 2);
	function update_term_image($term_id, $tt_id) {

		if (isset($_POST['term_meta'])) {
	    $t_id = $term_id;
	    $term_meta = get_option("taxonomy_term_$t_id");
	    $cat_keys = array_keys($_POST['term_meta']);
	    foreach ($cat_keys as $key) {
	        if (isset($_POST['term_meta'][$key])) {
	            $term_meta[$key] = $_POST['term_meta'][$key];
	        }
	    }
	    //save the option array
	    update_option("taxonomy_term_$t_id", $term_meta);
	   }

	}

	function image_uploader_enqueue() {
	    global $typenow;
	    if( ($typenow == 'testimonials') ) {
	        wp_enqueue_media();

	        wp_register_script( 'meta-image', get_template_directory_uri() . '/includes/js/media-uploader.js', array( 'jquery' ) );
	        wp_localize_script( 'meta-image', 'meta_image',
	            array(
	                'title' => 'Upload an Image',
	                'button' => 'Use this Image',
	            )
	        );
	        wp_enqueue_script( 'meta-image' );
	    }
	}
	add_action( 'admin_enqueue_scripts', 'image_uploader_enqueue' );
	
	
	
	
	
	
	
	
	function wpse_139269_term_radio_checklist( $args ) {
        if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'testimonials-year' /* <== Change to your required taxonomy */ || ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'testimonials-media' ) {
            if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
                if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                    /**
                     * Custom walker for switching checkbox inputs to radio.
                     *
                     * @see Walker_Category_Checklist
                     */
                    class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                        function walk( $elements, $max_depth, ...$args ) {
                            $output = parent::walk( $elements, $max_depth, ...$args );
                            $output = str_replace(
                                array( 'type="checkbox"', "type='checkbox'" ),
                                array( 'type="radio"', "type='radio'" ),
                                $output
                            );
    
                            return $output;
                        }
                    }
                }
    
                $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
            }
        }
    
        return $args;
    }
    
    add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );


 ?>
