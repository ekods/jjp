<?php


function add_hero_meta() {

  global $post;
  if(!empty($post))
  {
      $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

      if($pageTemplate !== 'templates/page-home.php' )
      {
        add_meta_box( 'hero', 'Hero Content', 'meta_hero', 'page', 'normal', 'high');
      }
  }

}
add_action('add_meta_boxes', 'add_hero_meta', 1);


  function meta_hero( $post) {
    wp_nonce_field( '_hcf_meta_nonce', 'hcf_meta_nonce' ); ?>

    <table class="form-table">
      <tbody>

        <tr class="form-field">
          <th scope="row">
              <label for="hero-img">Hero</label>
          </th>
          <td>
            <input name="hero-img" class="images" type="hidden" value="<?php echo get_post_meta( get_the_ID(), 'hero-img', true ); ?>"  />
            <br>
            <img class="meta-image-preview" src="<?php echo get_post_meta( get_the_ID(), 'hero-img', true ); ?>" alt="" width="100px;">
            <br>
            <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="hero-title">Sub Title</label>
          </th>
          <td>
  					<input id="hero-title" type="text" name="hero-title" value="<?php echo get_post_meta( get_the_ID(), 'hero-title', true ); ?>">
          </td>
        </tr>

      </tbody>

    </table>



    <script>
    jQuery(document).ready( function($) {

      jQuery('.images_button').click(function() {

        var div = $(this).parent();
        var send_attachment_bkp = wp.media.editor.send.attachment;
        wp.media.editor.send.attachment = function(props, attachment) {
          console.log(div);
          jQuery(div).find('.images').val(attachment.url);
          jQuery(div).find('.meta-image-preview').attr('src',attachment.url);
          wp.media.editor.send.attachment = send_attachment_bkp;
        }

        wp.media.editor.open();
        return false;
      }); // End on click

    });
    </script>

  <?php }


  function get_meta_hero( $value ) {
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
  function meta_save_hero( $post_id ) {

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      if ( $parent_id = wp_is_post_revision( $post_id ) ) {
          $post_id = $parent_id;
      }
      if ( ! isset( $_POST['hcf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hcf_meta_nonce'], '_hcf_meta_nonce' ) ) return;

      $fields = [
        'hero-img',
        'hero-title'
      ];
      foreach ( $fields as $field ) {
          if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
          }

       }

  }
  add_action( 'save_post', 'meta_save_hero' );

?>