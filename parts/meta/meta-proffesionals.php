<?php


function add_proffesionals_meta() {

  global $post;
  if(!empty($post))
  {
    add_meta_box( 'proffesionals', 'Our Team Content', 'meta_proffesionals', 'proffesionals', 'normal', 'high');
    add_meta_box( 'repeatable-fields', 'Education', 'repeatable_meta_box_proffesionals_education_display', 'proffesionals', 'normal', 'high');
  }

}
add_action('add_meta_boxes', 'add_proffesionals_meta', 1);


  function meta_proffesionals( $post) {
    wp_nonce_field( '_hcf_meta_nonce', 'hcf_meta_nonce' ); ?>

    <table class="form-table">
      <tbody>

        <tr class="form-field">
          <th scope="row">
              <label for="proffesionals-contact">Contact</label>
          </th>
          <td>
  					<input id="proffesionals-contact" type="tel" name="proffesionals-contact" value="<?php echo get_post_meta( get_the_ID(), 'proffesionals-contact', true ); ?>">
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="proffesionals-languages">Languages</label>
          </th>
          <td>
  					<input id="proffesionals-languages" type="text" name="proffesionals-languages" value="<?php echo get_post_meta( get_the_ID(), 'proffesionals-languages', true ); ?>">
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="proffesionals-email">Email</label>
          </th>
          <td>
  					<input id="proffesionals-email" type="email" name="proffesionals-email" value="<?php echo get_post_meta( get_the_ID(), 'proffesionals-email', true ); ?>">
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="proffesionals-linkedin">Linkedin</label>
          </th>
          <td>
  					<input id="proffesionals-linkedin" type="url" name="proffesionals-linkedin" value="<?php echo get_post_meta( get_the_ID(), 'proffesionals-linkedin', true ); ?>">
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="proffesionals-profile">Profile</label>
          </th>
          <td>
            <input name="proffesionals-profile" class="proffesionals-profile" type="text" value="<?php echo get_post_meta( get_the_ID(), 'proffesionals-profile', true ); ?>"  />
            <br>
            <br>
            <input class="pdf_button button button-small" type="button" value="Upload Profile" /><br/>
          </td>
        </tr>

        <tr class="form-field">
					<th scope="row">
							<label for="proffesionals-speaking_engagements">Speaking Engagements</label>
					</th>
					<td>
            <?php wp_editor( get_post_meta( get_the_ID(), 'proffesionals-speaking_engagements', true ), 'proffesionals-speaking_engagements', array( 'textarea_rows' =>5,	'media_buttons' => false,	'tinymce'          => array(
              'wp_autoresize_on'      => true,
              'toolbar1'              => 'bold,italic,underline,link,unlink,bullist',
              'toolbar2'              => '',
            ),) ); ?>
					</td>
				</tr>

				<tr class="form-field">
					<th scope="row">
							<label for="proffesionals-publications">Publications</label>
					</th>
					<td>
            <?php wp_editor( get_post_meta( get_the_ID(), 'proffesionals-publications', true ), 'proffesionals-publications', array( 'textarea_rows' =>5,	'media_buttons' => false,	'tinymce'          => array(
              'wp_autoresize_on'      => true,
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
          target: $(this).parent().find(".proffesionals-profile"),
          type: 'application/pdf'
        });
      });

    });
    </script>

  <?php }


  function get_meta_proffesionals( $value ) {
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
  function meta_save_proffesionals( $post_id ) {

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      if ( $parent_id = wp_is_post_revision( $post_id ) ) {
          $post_id = $parent_id;
      }
      if ( ! isset( $_POST['hcf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hcf_meta_nonce'], '_hcf_meta_nonce' ) ) return;

      $fields = [
        'proffesionals-contact',
        'proffesionals-languages',
        'proffesionals-email',
        'proffesionals-linkedin',
        'proffesionals-profile',
        'proffesionals-speaking_engagements',
        'proffesionals-publications'
      ];
      foreach ( $fields as $field ) {
          if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
          }

       }

  }
  add_action( 'save_post', 'meta_save_proffesionals' );




function repeatable_meta_box_proffesionals_education_display() {
  global $post;
  $proffesionals_education = get_post_meta($post->ID, 'proffesionals_education', true);
  wp_nonce_field( 'hhs_repeatable_meta_box_nonce_proffesionals_education', 'hhs_repeatable_meta_box_nonce_proffesionals_education' );


  print_r(get_post_meta(get_queried_object_id(), 'proffesionals_education', true));

  ?>
  <style media="screen">
    .repeatable-item-wrapper {
      width: 100%;
      margin-bottom: 30px;
      float: left;
      position: relative;
    }

    .repeatable-item-label {
      width: 140px;
      display: table-cell;
      vertical-align: middle;
    }

    .repeatable-item-value {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 10px;
    }

    .repeatable-item {
      display: table;
      width: 100%;
      margin-bottom: 10px;
    }

    .button.remove-row {
      position: absolute;
      top: 0;
      right: 0;
    }
  </style>

  <script type="text/javascript">
  jQuery(document).ready(function( $ ){
    var i = $(".repeatable-item-ex").length - 1;

    $(document).on("click", "#add-row" , function() {
      var row = $( '.empty-row.screen-reader-text.group' ).clone(true);
          row.removeClass( 'empty-row screen-reader-text group' );
          row.insertBefore( '#repeatable-fieldset-one .repeatable-item-wrapper:last' );
          row.find( 'input[name="order[]"]' ).val(i);
      i++;
      return false;
    });
    
    $(document).on("click", ".remove-row" , function() {
      $(this).parents('.repeatable-item-wrapper').remove();
      return false;
    });

  });
  </script>

  <div id="repeatable-fieldset-one" width="100%">
    <?php

    $is = 0;
    if ( $proffesionals_education ) :

      sort($proffesionals_education);
      foreach ( $proffesionals_education as $field ) {
    ?>
      <div class="repeatable-item-wrapper repeatable-item-ex">
        <div class="repeatable-item">
          <div class="repeatable-item-label">
            Order

          </div>
          <div class="repeatable-item-value">
          <input type="text" class="widefat" name="order[]" value="<?php if($field['order'] != '') echo esc_attr( $field['order'] ); ?>"  style="width: 50px" />
          </div>
        </div>

        <div class="repeatable-item">
          <div class="repeatable-item-label">
            Title
          </div>
          <div class="repeatable-item-value">
            <input type="text" class="widefat" name="title[]" value="<?php if($field['title'] != '') echo esc_attr( $field['title'] ); ?>" />
          </div>
        </div>

        <div class="repeatable-item">
          <div class="repeatable-item-label">
            Sub Title
          </div>
          <div class="repeatable-item-value">
            <input type="text" class="widefat" name="subtitle[]" value="<?php if($field['subtitle'] != '') echo esc_attr( $field['subtitle'] ); ?>" />
          </div>
        </div>

        <a class="button remove-row" href="#">Remove</a>

      </div>

    <?php
    }
    else :
    // show a blank one
    ?>
      <div class="repeatable-item-wrapper repeatable-item-ex">
        <div class="repeatable-item">
          <div class="repeatable-item-label">
            Order
          </div>
          <div class="repeatable-item-value">
            <input type="text" class="widefat" name="order[]" value="<?php echo $is; ?>" style="width: 50px"/>
          </div>
        </div>

        <div class="repeatable-item">
          <div class="repeatable-item-label">
            Title
          </div>
          <div class="repeatable-item-value">
            <input type="text" class="widefat" name="title[]" value="" />
          </div>
        </div>

        <div class="repeatable-item">
          <div class="repeatable-item-label">
            Sub Title
          </div>
          <div class="repeatable-item-value">
            <input type="text" class="widefat" name="subtitle[]" value="" />
          </div>
        </div>

        <a class="button remove-row" href="#">Remove</a>

      </div>


    <?php     $is++;
    endif; ?>

    <!-- empty hidden one for jQuery -->
    <div class="repeatable-item-wrapper repeatable-item-ex empty-row screen-reader-text group">

      <div class="repeatable-item">
        <div class="repeatable-item-label">
          Order
        </div>
        <div class="repeatable-item-value">
          <input type="text" class="widefat" name="order[]" style="width: 50px"/>
        </div>
      </div>

      <div class="repeatable-item">
        <div class="repeatable-item-label">
          Title
        </div>
        <div class="repeatable-item-value">
          <input type="text" class="widefat" name="title[]" value="" />
        </div>
      </div>

      <div class="repeatable-item">
        <div class="repeatable-item-label">
          Sub Title
        </div>
        <div class="repeatable-item-value">
          <input type="text" class="widefat" name="subtitle[]" value="" />
        </div>
      </div>

      <a class="button remove-row" href="#">Remove</a>

    </div>

  </div>

  <hr>
  <hr>

  <p><a id="add-row" class="button" href="#">Add another</a></p>

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

  <?php
}


function repeatable_meta_box_proffesionals_education_save($post_id) {
    if ( ! isset( $_POST['hhs_repeatable_meta_box_nonce_proffesionals_education'] ) ||
    ! wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce_proffesionals_education'], 'hhs_repeatable_meta_box_nonce_proffesionals_education' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'proffesionals_education', true);
    $new = array();

    $order = $_POST['order'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];

    $count = count( $order );

    for ( $i = 0; $i < $count; $i++ ) {
      if ( $title[$i] != '' ) :
        $new[$i]['order'] = stripslashes( strip_tags( $order[$i] ) );

        $new[$i]['title'] = stripslashes( strip_tags( $title[$i] ) );
        $new[$i]['subtitle'] = stripslashes( strip_tags( $subtitle[$i] ) );
      endif;
    }
    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'proffesionals_education', $new );

    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'proffesionals_education', $old );
}
add_action('save_post', 'repeatable_meta_box_proffesionals_education_save');

?>