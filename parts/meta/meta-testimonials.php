<?php


function add_testimonials_meta() {

  global $post;
  if(!empty($post))
  {
    add_meta_box( 'testimonials', 'Testimonials Content', 'meta_testimonials', 'testimonials', 'normal', 'high');
  }

}
add_action('add_meta_boxes', 'add_testimonials_meta', 1);


  function meta_testimonials( $post) {
    wp_nonce_field( '_hcf_meta_nonce', 'hcf_meta_nonce' ); ?>

    <table class="form-table">
      <tbody>

        <tr class="form-field">
          <th scope="row">
              <label for="testimonials-feature">Feature</label>
          </th>
          <td>
            <?php $testimonials_feature = get_post_meta( get_the_ID(), 'testimonials-feature', true ); ?>
  						<input id="testimonials-feature" class="checkbox" type="checkbox" name="testimonials-feature" value="yes" <?php if ( isset ( $testimonials_feature  ) ) checked( $testimonials_feature, 'yes' ); ?> />
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="testimonials-url">Url</label>
          </th>
          <td>
  					<input id="testimonials-url" type="tel" name="testimonials-url" value="<?php echo get_post_meta( get_the_ID(), 'testimonials-url', true ); ?>">
          </td>
        </tr>

		    <tr class="form-field">
					<th scope="row">
							<label for="testimonials-highlight">Highlight</label>
					</th>
					<td>
            <?php wp_editor( get_post_meta( get_the_ID(), 'testimonials-highlight', true ), 'testimonials-highlight', array( 'textarea_rows' =>5,	'media_buttons' => false,	'tinymce'          => array(
              'wp_autoresize_on'      => false,
              'toolbar1'              => 'bold,italic,underline,link,unlink,bullist',
              'toolbar2'              => '',
            ),) ); ?>
					</td>
				</tr>

      </tbody>

    </table>

  <?php }


  function get_meta_testimonials( $value ) {
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
  function meta_save_testimonials( $post_id ) {

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      if ( $parent_id = wp_is_post_revision( $post_id ) ) {
          $post_id = $parent_id;
      }
      if ( ! isset( $_POST['hcf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hcf_meta_nonce'], '_hcf_meta_nonce' ) ) return;

      $fields = [
        'testimonials-feature',
        'testimonials-url',
		  'testimonials-highlight'
      ];
      foreach ( $fields as $field ) {
	        if ( array_key_exists( $field, $_POST ) ) {
	          update_post_meta( $post_id, $field, $_POST[$field] );
	        }

					if( isset( $_POST[ 'testimonials-feature' ] ) ) {
							update_post_meta( $post_id, 'testimonials-feature', 'yes' );
					} else {
							update_post_meta( $post_id, 'testimonials-feature', 'no' );
					}

	     }

  }
  add_action( 'save_post', 'meta_save_testimonials' );

?>
