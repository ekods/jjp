<?php


function add_head_page_meta() {

  global $post;
  if(!empty($post))
  {
      $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

      if($pageTemplate == 'templates/page-testimonials.php' || $pageTemplate == 'templates/page-professionals.php' || $pageTemplate == 'templates/page-practice-areas.php' )
      {
        add_meta_box( 'head_page', 'Head Page', 'meta_head_page', 'page', 'normal', 'high');
        remove_post_type_support('page', 'editor');
      }
  }

}
add_action('add_meta_boxes', 'add_head_page_meta', 1);


  function meta_head_page( $post) {
    wp_nonce_field( '_hcf_meta_nonce', 'hcf_meta_nonce' ); ?>


    <table class="form-table">
      <tbody>

        <tr class="form-field">
          <th scope="row">
              <label for="head_page-side-left">Side Left</label>
          </th>
          <td>
  					<input id="head_page-side-left" type="tel" name="head_page-side-left" value="<?php echo get_post_meta( get_the_ID(), 'head_page-side-left', true ); ?>">
          </td>
        </tr>

				<tr class="form-field">
					<th scope="row">
							<label for="head_page-side-right">Side Right</label>
					</th>
					<td>
            <?php wp_editor( get_post_meta( get_the_ID(), 'head_page-side-right', true ), 'head_page-side-right', array( 'textarea_rows' =>5,	'media_buttons' => false,	'tinymce'          => array(
              'wp_autoresize_on'      => true,
              'wpautop'               => true,
              'toolbar1'              => 'bold,italic,underline,link,unlink,bullist',
              'toolbar2'              => '',
            ),) ); ?>
					</td>
				</tr>

      </tbody>

    </table>

  <?php }


  function get_meta_head_page( $value ) {
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
  function meta_save_head_page( $post_id ) {

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      if ( $parent_id = wp_is_post_revision( $post_id ) ) {
          $post_id = $parent_id;
      }
      if ( ! isset( $_POST['hcf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hcf_meta_nonce'], '_hcf_meta_nonce' ) ) return;

      $fields = [
        'head_page-side-left',
        'head_page-side-right',
      ];
      foreach ( $fields as $field ) {
          if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
          }

          if ( ! empty( $_POST['head_page-practice_areas'] ) ) {
              update_post_meta( $post_id, 'practice_areas', $_POST['head_page-practice_areas'] );

          // Otherwise just delete it if its blank value.
          }else {
              delete_post_meta( $post_id, 'practice_areas' );
          }

       }

  }
  add_action( 'save_post', 'meta_save_head_page' );

?>
