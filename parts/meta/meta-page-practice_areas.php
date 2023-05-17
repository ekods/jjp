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
  }

}
add_action('add_meta_boxes', 'add_practice_areas_meta', 1);


  function meta_practice_areas( $post) {
    wp_nonce_field( '_hcf_meta_nonce', 'hcf_meta_nonce' ); ?>

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

      </tbody>

    </table>



    <script>
    jQuery(document).ready( function($) {

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
      ];
      foreach ( $fields as $field ) {
          if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
          }

    }

  }
  add_action( 'save_post', 'meta_save_practice_areas' );

?>