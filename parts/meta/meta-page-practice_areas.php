<?php


function add_practice_areas_meta() {

  global $post;


  if(!empty($post))
  {
      $pageParent = $post->post_parent;

      if($pageParent == 88 )
      {
        add_meta_box( 'practice_areas', 'Content', 'meta_practice_areas', 'page', 'normal', 'high');
      }


      $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

      if($pageTemplate == 'templates/page-practice-areas.php' )
      {
        add_meta_box( 'practice_areas_parent', 'Practice Areas Content', 'meta_practice_areas_parent', 'page', 'normal', 'high');
      }

  }

}
add_action('add_meta_boxes', 'add_practice_areas_meta', 1);


  function meta_practice_areas( $post) {
    wp_nonce_field( '_hcf_meta_nonce', 'hcf_meta_nonce' ); ?>
    <style media="screen">
      .panel-practice_areas {
        min-height: 42px;
        max-height: 150px;
        overflow: auto;
        padding: 0 0.9em;
        border: solid 1px #dcdcde;
        background-color: #fff;
      }
    </style>
    <table class="form-table">
      <tbody>

        <tr class="form-field">
          <th scope="row">
              <label for="practice_areas-title">Title</label>
          </th>
          <td>
  					<input id="practice_areas-title" type="text" name="practice_areas-title" value="<?php echo get_post_meta( get_the_ID(), 'practice_areas-title', true ); ?>">
          </td>
        </tr>

				<tr class="form-field">
					<th scope="row">
							<label for="practice_areas-content">Content</label>
					</th>
					<td>
            <?php wp_editor( get_post_meta( get_the_ID(), 'practice_areas-content', true ), 'practice_areas-content', array( 'textarea_rows' =>5,	'media_buttons' => false,	'tinymce'          => array(
              'wp_autoresize_on'      => true,
              'wpautop'               => false,
              'toolbar1'              => 'bold,italic,underline,link,unlink,bullist',
              'toolbar2'              => '',
            ),) ); ?>
					</td>
				</tr>

				<tr class="form-field">
					<th scope="row">
							<label for="practice_areas-prosecution">Prosecution</label>
					</th>
					<td>
            <?php wp_editor( get_post_meta( get_the_ID(), 'practice_areas-prosecution', true ), 'practice_areas-prosecution', array( 'textarea_rows' =>5,	'media_buttons' => false,	'tinymce'          => array(
              'wp_autoresize_on'      => true,
              'wpautop'               => false,
              'toolbar1'              => 'bold,italic,underline,link,unlink,bullist',
              'toolbar2'              => '',
            ),) ); ?>
					</td>
				</tr>

				<tr class="form-field">
					<th scope="row">
							<label for="practice_areas-contentious">Contentious</label>
					</th>
					<td>
            <?php wp_editor( get_post_meta( get_the_ID(), 'practice_areas-contentious', true ), 'practice_areas-contentious', array( 'textarea_rows' =>5,	'media_buttons' => false,	'tinymce'          => array(
              'wp_autoresize_on'      => true,
              'wpautop'               => false,
              'toolbar1'              => 'bold,italic,underline,link,unlink,bullist',
              'toolbar2'              => '',
            ),) ); ?>
					</td>
				</tr>
				
				
				        <tr class="form-field">
          <th scope="row">
              <label for="practice_areas_more">Practice Areas More</label>
          </th>
          <td>
            <div id="practice_areas_more-all" class="panel-practice_areas">
              <ul id="practice_areas_morechecklist" data-wp-lists="list:professionals-category">
                <?php
                  // How to use 'get_post_meta()' for multiple checkboxes as array?
                  $postmeta = maybe_unserialize( get_post_meta( get_the_ID(), 'practice_areas', true ) );

                  $page_practice_areas = 88;
                  $args = array(
                    'post_per_page' => -1,
                    'orderby'       => 'menu_order',
                    'order'         => 'asc',
                    'post_type'     => 'page',
                    'post_parent'   => $page_practice_areas,
                  );

                  $practice_areas = query_posts($args);


                  // Loop through array and make a checkbox for each element
                  foreach ( $practice_areas as $id => $practice_area) {
                      // If the postmeta for checkboxes exist and
                      // this element is part of saved meta check it.
                      if ( is_array( $postmeta ) && in_array( $practice_area->ID, $postmeta ) ) {
                          $checked = 'checked="checked"';
                      } else {
                          $checked = null;
                      }
                      ?>

                      <li id="practice_areas_more-<?= $practice_area->ID; ?>" class="practice_areas-category">
                        <label class="selectit">
                          <input value="<?= $practice_area->ID; ?>" type="checkbox" name="practice_areas-more[]" id="in-practice_areas-more-<?= $practice_area->ID; ?>" <?= $checked; ?>> <?= $practice_area->post_title; ?>
                        </label>
                      </li>

                      <?php
                  }
                 ?>
        			</ul>
        		</div>
          </td>
        </tr>

      </tbody>

    </table>



    <script>
    jQuery(document).ready( function($) {
        
        $('.practice_areas-category input:checkbox').click(
            function() {
              var limitReached = $('.practice_areas-category input:checkbox:checked').length >= 4;   
              $('.practice_areas-category input:checkbox').not(':checked').attr('disabled', limitReached);
            }
        );
        
        
        var bol = $(".practice_areas-category input:checkbox:checked").length >= 2;     
        $(".practice_areas-category input:checkbox").not(":checked").attr("disabled",bol);

      function uploadMedia(options) {
        var title = options.title || 'Select File PDF',
          text = options.text || 'Select PDF',
          urlInput = options.target;

        var multiple = options.multiple == true ? 'add' : false;
        var uploader = wp.media({
          multiple: multiple,
          title: title,
          button: {
            text: text
          },
          library: {
            type: options.type
          }

        })
          .on('select', function () {
            var files = uploader.state().get('selection');

            if (multiple == false) {
              var fileUrl = files.models[0].attributes.url;
              urlInput.val(fileUrl);
              if (options.callback) options.callback(fileUrl);
            }
            else {
              if (options.callback) options.callback(files);
            }


          })
          .open();
      }

      //upload doc
      $(document).on('click', '.pdf_button', function (e) {
        e.preventDefault();
        uploadMedia({
          target: $(this).parent().find(".practice_areas-profile"),
          type: 'application/pdf'
        });
      });

    });
    </script>

  <?php }


  function get_meta_practice_areas( $value ) {
    global $post;

    $field = get_post_meta( $post->ID, $value, true );
    if ( ! empty( $field ) ) {
      return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
    } else {
      return false;
    }
  }


  /**
   * Save meta box content.
   */
  function meta_save_practice_areas( $post_id ) {

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      if ( $parent_id = wp_is_post_revision( $post_id ) ) {
          $post_id = $parent_id;
      }
      if ( ! isset( $_POST['hcf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hcf_meta_nonce'], '_hcf_meta_nonce' ) ) return;

      $fields = [
        'practice_areas-title',
        'practice_areas-content',
        'practice_areas-prosecution',
        'practice_areas-contentious',
        'practice_areas-more'
      ];
      foreach ( $fields as $field ) {
          if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
          }

          if ( ! empty( $_POST['practice_areas-more'] ) ) {
              update_post_meta( $post_id, 'practice_areas', $_POST['practice_areas-more'] );

          // Otherwise just delete it if its blank value.
          }else {
              delete_post_meta( $post_id, 'practice_areas' );
          }

       }

  }
  add_action( 'save_post', 'meta_save_practice_areas' );










    function meta_practice_areas_parent( $post) {
      wp_nonce_field( '_hcf_meta_nonce', 'hcf_meta_nonce' ); ?>

      <table class="form-table">
        <tbody>

          <!-- <tr class="form-field">
            <th scope="row">
                <label for="practice_areas_parent-title">Title</label>
            </th>
            <td>
    					<input id="practice_areas_parent-title" type="text" name="practice_areas_parent-title" value="<?php echo get_post_meta( get_the_ID(), 'practice_areas_parent-title', true ); ?>">
            </td>
          </tr> -->

  		    <tr class="form-field">
  					<th scope="row">
  							<label for="practice_areas_parent-subtitle">Sub Title</label>
  					</th>
  					<td>
              <input id="practice_areas_parent-subtitle" type="text" name="practice_areas_parent-subtitle" value="<?php echo get_post_meta( get_the_ID(), 'practice_areas_parent-subtitle', true ); ?>">
  					</td>
  				</tr>

        </tbody>

      </table>
    <?php }


    function get_meta_practice_areas_parent( $value ) {
      global $post;

      $field = get_post_meta( $post->ID, $value, true );
      if ( ! empty( $field ) ) {
        return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
      } else {
        return false;
      }
    }


    /**
     * Save meta box content.
     */
    function meta_save_practice_areas_parent( $post_id ) {

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( $parent_id = wp_is_post_revision( $post_id ) ) {
            $post_id = $parent_id;
        }
        if ( ! isset( $_POST['hcf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hcf_meta_nonce'], '_hcf_meta_nonce' ) ) return;


        $fields = [
            // 'practice_areas_parent-title',
  		      'practice_areas_parent-subtitle',
        ];
        foreach ( $fields as $field ) {
            if ( array_key_exists( $field, $_POST ) ) {
              update_post_meta( $post_id, $field, $_POST[$field] );
            }

         }

    }
    add_action( 'save_post', 'meta_save_practice_areas_parent' );

?>
