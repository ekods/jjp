<?php


function add_professionals_meta() {

  global $post;
  if(!empty($post))
  {
    add_meta_box( 'professionals', 'Our Team Content', 'meta_professionals', 'professionals', 'normal', 'high');
    add_meta_box( 'repeatable-fields', 'Education', 'repeatable_meta_box_professionals_education_display', 'professionals', 'normal', 'high');
  }

}
add_action('add_meta_boxes', 'add_professionals_meta', 1);


  function meta_professionals( $post) {
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
              <label for="professionals-practice_areas">Practice Areas</label>
          </th>
          <td>
            <div id="professionals-practice_areas-all" class="panel-practice_areas">
              <ul id="professionals-practice_areaschecklist" data-wp-lists="list:professionals-category">
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

                      <li id="professionals-practice_areas-<?= $practice_area->ID; ?>" class="practice_areas-category">
                        <label class="selectit">
                          <input value="<?= $practice_area->ID; ?>" type="checkbox" name="professionals-practice_areas[]" id="in-professionals-practice_areas-<?= $practice_area->ID; ?>" <?= $checked; ?>> <?= $practice_area->post_title; ?>
                        </label>
                      </li>

                      <?php
                  }
                 ?>
        			</ul>
        		</div>
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="professionals-contact">Contact</label>
          </th>
          <td>
  					<input id="professionals-contact" type="tel" name="professionals-contact" value="<?php echo get_post_meta( get_the_ID(), 'professionals-contact', true ); ?>">
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="professionals-languages">Languages</label>
          </th>
          <td>
  					<input id="professionals-languages" type="text" name="professionals-languages" value="<?php echo get_post_meta( get_the_ID(), 'professionals-languages', true ); ?>">
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="professionals-email">Email</label>
          </th>
          <td>
  					<input id="professionals-email" type="email" name="professionals-email" value="<?php echo get_post_meta( get_the_ID(), 'professionals-email', true ); ?>">
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="professionals-linkedin">Linkedin</label>
          </th>
          <td>
  					<input id="professionals-linkedin" type="url" name="professionals-linkedin" value="<?php echo get_post_meta( get_the_ID(), 'professionals-linkedin', true ); ?>">
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="professionals-profile">Profile</label>
          </th>
          <td>
            <input name="professionals-profile" class="professionals-profile" type="text" value="<?php echo get_post_meta( get_the_ID(), 'professionals-profile', true ); ?>"  />
            <br>
            <br>
            <input class="pdf_button button button-small" type="button" value="Upload Profile" /><br/>
          </td>
        </tr>

        <tr class="form-field">
					<th scope="row">
							<label for="professionals-speaking_engagements">Speaking Engagements</label>
					</th>
					<td>
            <?php wp_editor( get_post_meta( get_the_ID(), 'professionals-speaking_engagements', true ), 'professionals-speaking_engagements', array( 'textarea_rows' =>5,	'media_buttons' => false,	'tinymce'          => array(
              'wp_autoresize_on'      => true,
              'toolbar1'              => 'bold,italic,underline,link,unlink,bullist',
              'toolbar2'              => '',
            ),) ); ?>
					</td>
				</tr>

				<tr class="form-field">
					<th scope="row">
							<label for="professionals-publications">Publications</label>
					</th>
					<td>
            <?php wp_editor( get_post_meta( get_the_ID(), 'professionals-publications', true ), 'professionals-publications', array( 'textarea_rows' =>5,	'media_buttons' => false,	'tinymce'          => array(
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
          target: $(this).parent().find(".professionals-profile"),
          type: 'application/pdf'
        });
      });

    });
    </script>

  <?php }


  function get_meta_professionals( $value ) {
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
  function meta_save_professionals( $post_id ) {

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      if ( $parent_id = wp_is_post_revision( $post_id ) ) {
          $post_id = $parent_id;
      }
      if ( ! isset( $_POST['hcf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hcf_meta_nonce'], '_hcf_meta_nonce' ) ) return;

      $fields = [
        'professionals-practice_areas',
        'professionals-contact',
        'professionals-languages',
        'professionals-email',
        'professionals-linkedin',
        'professionals-profile',
        'professionals-speaking_engagements',
        'professionals-publications'
      ];
      foreach ( $fields as $field ) {
          if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
          }

          if ( ! empty( $_POST['professionals-practice_areas'] ) ) {
              update_post_meta( $post_id, 'practice_areas', $_POST['professionals-practice_areas'] );

          // Otherwise just delete it if its blank value.
          }else {
              delete_post_meta( $post_id, 'practice_areas' );
          }

       }

  }
  add_action( 'save_post', 'meta_save_professionals' );




function repeatable_meta_box_professionals_education_display() {
  global $post;
  $professionals_education = get_post_meta($post->ID, 'professionals_education', true);
  wp_nonce_field( 'hhs_repeatable_meta_box_nonce_professionals_education', 'hhs_repeatable_meta_box_nonce_professionals_education' );


  print_r(get_post_meta(get_queried_object_id(), 'professionals_education', true));

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
    if ( $professionals_education ) :

      sort($professionals_education);
      foreach ( $professionals_education as $field ) {
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

        <div class="repeatable-item">
          <div class="repeatable-item-label">
            Year
          </div>
          <div class="repeatable-item-value">
            <input type="text" class="widefat" name="year[]" value="<?php if($field['year'] != '') echo esc_attr( $field['year'] ); ?>" />
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

        <div class="repeatable-item">
          <div class="repeatable-item-label">
            Year
          </div>
          <div class="repeatable-item-value">
            <input type="text" class="widefat" name="year[]" value="" />
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

      <div class="repeatable-item">
        <div class="repeatable-item-label">
          Year
        </div>
        <div class="repeatable-item-value">
          <input type="text" class="widefat" name="year[]" value="" />
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


function repeatable_meta_box_professionals_education_save($post_id) {
    if ( ! isset( $_POST['hhs_repeatable_meta_box_nonce_professionals_education'] ) ||
    ! wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce_professionals_education'], 'hhs_repeatable_meta_box_nonce_professionals_education' ) )
        return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (!current_user_can('edit_post', $post_id))
        return;

    $old = get_post_meta($post_id, 'professionals_education', true);
    $new = array();

    $order = $_POST['order'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $year = $_POST['year'];

    $count = count( $order );

    for ( $i = 0; $i < $count; $i++ ) {
      if ( $title[$i] != '' ) :
        $new[$i]['order'] = stripslashes( strip_tags( $order[$i] ) );

        $new[$i]['title'] = stripslashes( strip_tags( $title[$i] ) );
        $new[$i]['subtitle'] = stripslashes( strip_tags( $subtitle[$i] ) );
        $new[$i]['year'] = stripslashes( strip_tags( $year[$i] ) );
      endif;
    }
    if ( !empty( $new ) && $new != $old )
        update_post_meta( $post_id, 'professionals_education', $new );

    elseif ( empty($new) && $old )
        delete_post_meta( $post_id, 'professionals_education', $old );
}
add_action('save_post', 'repeatable_meta_box_professionals_education_save');

?>
