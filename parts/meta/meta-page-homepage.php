<?php
add_action('add_meta_boxes', 'add_home_meta');
function add_home_meta()
{

    global $post;
    if(!empty($post))
    {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

        if($pageTemplate == 'templates/page-home.php' )
        {
          add_meta_box( 'repeatable-fields', 'Slide Item', 'repeatable_meta_box_home_slide_display', 'page', 'normal', 'high');

          add_meta_box( 'pilar_h', 'Pilar Content', 'meta_pilar_h', 'page', 'normal', 'high');

          add_meta_box( 'repeatable-pillar', 'Pillar Item', 'repeatable_meta_box_pillar_display', 'page', 'normal', 'high');


          add_meta_box( 'repeatable-fields_member', 'Member', 'repeatable_meta_box_member_display', 'page', 'normal', 'high');
          add_meta_box( 'repeatable-fields_rangked', 'Rangked', 'repeatable_meta_box_rangked_display', 'page', 'normal', 'high');

          remove_post_type_support('page', 'editor');
        }
    }
}


function repeatable_meta_box_home_slide_display() {
    global $post;
    $home_slide = get_post_meta($post->ID, 'home_slide', true);
    wp_nonce_field( 'hhs_repeatable_meta_box_nonce_home_slide', 'hhs_repeatable_meta_box_nonce_home_slide' );
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
      var i = $("#repeatable-fieldset-one .repeatable-item-ex").length - 1;

      $(document).on("click", "#add-row" , function() {
  			var row = $( '#repeatable-fieldset-one .empty-row.screen-reader-text.group' ).clone(true);
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


      if ( $home_slide ) :

        $is = 0;
        sort($home_slide);
        foreach ( $home_slide as $field ) {
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
              Images
            </div>
            <div class="repeatable-item-value">
              <input name="images[]" class="images" type="hidden" value="<?php if($field['images'] != '') echo esc_attr( $field['images'] ); ?>"  />
              <img class="meta-image-preview" src="<?php if($field['images'] != '') echo esc_attr( $field['images'] ); ?>" alt="" width="100px;">
              <input class="images_button button button-small" type="button" value="Upload Image" />

            </div>
          </div>

          <!-- <div class="repeatable-item">
            <div class="repeatable-item-label">
              Images Mobile
            </div>
            <div class="repeatable-item-value">
              <input name="images_mobile[]" class="images" type="hidden" value="<?php if($field['images_mobile'] != '') echo esc_attr( $field['images_mobile'] ); ?>"  />
              <img class="meta-image-preview" src="<?php if($field['images_mobile'] != '') echo esc_attr( $field['images_mobile'] ); ?>" alt="" width="100px;">
              <input class="images_button button button-small" type="button" value="Upload Image" />
            </div>
          </div> -->

          <hr>

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
              Link
            </div>
            <div class="repeatable-item-value">
              <input type="text" class="widefat" name="link[]" value="<?php if($field['link'] != '') echo esc_attr( $field['link'] ); ?>" />
            </div>
          </div>

          <a class="button remove-row" href="#">Remove</a>

        </div>

      <?php
      $is++;
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
              <input type="text" class="widefat" name="order[]" value="<?= $is; ?>" style="width: 50px"/>
            </div>
          </div>

          <div class="repeatable-item">
            <div class="repeatable-item-label">
              Images
            </div>
            <div class="repeatable-item-value">
              <input name="images[]" class="images" type="hidden"  />
              <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
              <img class="meta-image-preview" src="<?php if($field['images'] != '') echo esc_attr( $field['images'] ); ?>" alt="" width="100px;">
            </div>
          </div>

          <!-- <div class="repeatable-item">
            <div class="repeatable-item-label">
              Images Mobile
            </div>
            <div class="repeatable-item-value">
              <input name="images_mobile[]" class="images" type="hidden"  />
              <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
              <img class="meta-image-preview" src="<?php if($field['images_mobile'] != '') echo esc_attr( $field['images_mobile'] ); ?>" alt="" width="100px;">
            </div>
          </div> -->

          <hr>

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
              Link
            </div>
            <div class="repeatable-item-value">
              <input type="text" class="widefat" name="link[]"/>
            </div>
          </div>

          <a class="button remove-row" href="#">Remove</a>

        </div>


      <?php endif; ?>

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
            Images
          </div>
          <div class="repeatable-item-value">
            <input name="images[]" class="images" type="hidden"  />
            <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
            <img class="meta-image-preview" src="" alt="" width="100px;">
          </div>
        </div>


        <!-- <div class="repeatable-item">
          <div class="repeatable-item-label">
            Images Mobile
          </div>
          <div class="repeatable-item-value">
            <input name="images_mobile[]" class="images" type="hidden"  />
            <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
            <img class="meta-image-preview" src="" alt="" width="100px;">
          </div>
        </div> -->

        <hr>

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
            Link
          </div>
          <div class="repeatable-item-value">
            <input type="text" class="widefat" name="link[]"/>
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


  function repeatable_meta_box_home_slide_save($post_id) {
      if ( ! isset( $_POST['hhs_repeatable_meta_box_nonce_home_slide'] ) ||
      ! wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce_home_slide'], 'hhs_repeatable_meta_box_nonce_home_slide' ) )
          return;

      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
          return;

      if (!current_user_can('edit_post', $post_id))
          return;

      $old = get_post_meta($post_id, 'home_slide', true);
      $new = array();

      $order = $_POST['order'];
      $images = $_POST['images'];
      // $images_mobile = $_POST['images_mobile'];
      $title = $_POST['title'];
      $subtitle = $_POST['subtitle'];

      $link = $_POST['link'];

      $count = count( $order );

      for ( $i = 0; $i < $count; $i++ ) {
        if ( $images[$i] != '' ) :
          $new[$i]['order'] = stripslashes( strip_tags( $order[$i] ) );

          $new[$i]['images'] = stripslashes( strip_tags( $images[$i] ) );
          // $new[$i]['images_mobile'] = stripslashes( strip_tags( $images_mobile[$i] ) );

          $new[$i]['title'] = stripslashes( strip_tags( $title[$i] ) );
          $new[$i]['subtitle'] = stripslashes( strip_tags( $subtitle[$i] ) );

          $new[$i]['link'] = stripslashes( strip_tags( $link[$i] ) );
        endif;
      }
      if ( !empty( $new ) && $new != $old )
          update_post_meta( $post_id, 'home_slide', $new );

      elseif ( empty($new) && $old )
          delete_post_meta( $post_id, 'home_slide', $old );
  }
  add_action('save_post', 'repeatable_meta_box_home_slide_save');





  function repeatable_meta_box_pillar_display() {
      global $post;
      $pillar = get_post_meta($post->ID, 'pillar', true);
      wp_nonce_field( 'hhs_repeatable_meta_box_nonce_pillar', 'hhs_repeatable_meta_box_nonce_pillar' );
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
        var i = $("#repeatable-fieldset-two .repeatable-item-ex").length - 1;

        $(document).on("click", "#add-row-two" , function() {
    			var row = $( '#repeatable-fieldset-two .empty-row.screen-reader-text.group' ).clone(true);
        			row.removeClass( 'empty-row screen-reader-text group' );
        			row.insertBefore( '#repeatable-fieldset-two .repeatable-item-wrapper:last' );
              row.find( 'input[name="pillar_order[]"]' ).val(i);
    			i++;
          return false;
    		});

        $(document).on("click", ".remove-row" , function() {
    			$(this).parents('.repeatable-item-wrapper').remove();
    			return false;
    		});

    	});
    	</script>

      <div id="repeatable-fieldset-two" width="100%">
        <?php


        if ( $pillar ) :

          $is = 0;
          sort($pillar);
          foreach ( $pillar as $field ) {
        ?>
          <div class="repeatable-item-wrapper repeatable-item-ex">
            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Order

              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="pillar_order[]" value="<?php if($field['pillar_order'] != '') echo esc_attr( $field['pillar_order'] ); ?>"  style="width: 50px" />
              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Images
              </div>
              <div class="repeatable-item-value">
                <input name="pillar_images[]" class="images" type="hidden" value="<?php if($field['pillar_images'] != '') echo esc_attr( $field['pillar_images'] ); ?>"  />
                <img class="meta-image-preview" src="<?php if($field['pillar_images'] != '') echo esc_attr( $field['pillar_images'] ); ?>" alt="" width="100px;">
                <input class="images_button button button-small" type="button" value="Upload Image" />

              </div>
            </div>

            <hr>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Title
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="pillar_title[]" value="<?php if($field['pillar_title'] != '') echo esc_attr( $field['pillar_title'] ); ?>" />
              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Sub Title
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="pillar_subtitle[]" value="<?php if($field['pillar_subtitle'] != '') echo esc_attr( $field['pillar_subtitle'] ); ?>" />
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
                <input type="text" class="widefat" name="pillar_order[]" value="<?= $is; ?>" style="width: 50px"/>
              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Images
              </div>
              <div class="repeatable-item-value">
                <input name="pillar_images[]" class="images" type="hidden"  />
                <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
                <img class="meta-image-preview" src="<?php if($field['pillar_images'] != '') echo esc_attr( $field['pillar_images'] ); ?>" alt="" width="100px;">
              </div>
            </div>

            <hr>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Title
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="pillar_title[]" value="" />
              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Sub Title
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="pillar_subtitle[]" value="" />
              </div>
            </div>

            <a class="button remove-row" href="#">Remove</a>

          </div>


        <?php
        $is++;

      endif; ?>

        <!-- empty hidden one for jQuery -->
        <div class="repeatable-item-wrapper repeatable-item-ex empty-row screen-reader-text group">

          <div class="repeatable-item">
            <div class="repeatable-item-label">
              Order
            </div>
            <div class="repeatable-item-value">
              <input type="text" class="widefat" name="pillar_order[]" value="" style="width: 50px"/>
            </div>
          </div>


          <div class="repeatable-item">
            <div class="repeatable-item-label">
              Images
            </div>
            <div class="repeatable-item-value">
              <input name="pillar_images[]" class="images" type="hidden"  />
              <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
              <img class="meta-image-preview" src="" alt="" width="100px;">
            </div>
          </div>

          <hr>

          <div class="repeatable-item">
            <div class="repeatable-item-label">
              Title
            </div>
            <div class="repeatable-item-value">
              <input type="text" class="widefat" name="pillar_title[]" value="" />
            </div>
          </div>

          <div class="repeatable-item">
            <div class="repeatable-item-label">
              Sub Title
            </div>
            <div class="repeatable-item-value">
              <input type="text" class="widefat" name="pillar_subtitle[]" value="" />
            </div>
          </div>

          <a class="button remove-row" href="#">Remove</a>

        </div>

      </div>

      <hr>
      <hr>

      <p><a id="add-row-two" class="button" href="#">Add another</a></p>

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


    function repeatable_meta_box_pillar_save($post_id) {
        if ( ! isset( $_POST['hhs_repeatable_meta_box_nonce_pillar'] ) ||
        ! wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce_pillar'], 'hhs_repeatable_meta_box_nonce_pillar' ) )
            return;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        if (!current_user_can('edit_post', $post_id))
            return;

        $old = get_post_meta($post_id, 'pillar', true);
        $new = array();

        $order = $_POST['pillar_order'];
        $images = $_POST['pillar_images'];
        $title = $_POST['pillar_title'];
        $subtitle = $_POST['pillar_subtitle'];
        $count = count( $order );

        for ( $i = 0; $i < $count; $i++ ) {
          if ( $images[$i] != '' ) :
            $new[$i]['pillar_order'] = stripslashes( strip_tags( $order[$i] ) );

            $new[$i]['pillar_images'] = stripslashes( strip_tags( $images[$i] ) );

            $new[$i]['pillar_title'] = stripslashes( $title[$i] );
            $new[$i]['pillar_subtitle'] = stripslashes( strip_tags( $subtitle[$i] ) );
          endif;
        }
        if ( !empty( $new ) && $new != $old )
            update_post_meta( $post_id, 'pillar', $new );

        elseif ( empty($new) && $old )
            delete_post_meta( $post_id, 'pillar', $old );
    }
    add_action('save_post', 'repeatable_meta_box_pillar_save');







  function meta_pilar_h( $post) {
    wp_nonce_field( '_hcf_meta_nonce', 'hcf_meta_nonce' ); ?>

    <table class="form-table">
      <tbody>

        <tr class="form-field">
          <th scope="row">
              <label for="pilar_h-title">Title</label>
          </th>
          <td>
  					<input id="pilar_h-title" type="text" name="pilar_h-title" value="<?php echo get_post_meta( get_the_ID(), 'pilar_h-title', true ); ?>">
          </td>
        </tr>

		    <tr class="form-field">
					<th scope="row">
							<label for="pilar_h-subtitle">Sub Title</label>
					</th>
					<td>
					    <textarea id="pilar_h-subtitle" name="pilar_h-subtitle"><?php echo get_post_meta( get_the_ID(), 'pilar_h-subtitle', true ); ?></textarea>
					</td>
				</tr>

      </tbody>

    </table>
  <?php }


  function get_meta_pilar_h( $value ) {
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
  function meta_save_pilar_h( $post_id ) {

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      if ( $parent_id = wp_is_post_revision( $post_id ) ) {
          $post_id = $parent_id;
      }
      if ( ! isset( $_POST['hcf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hcf_meta_nonce'], '_hcf_meta_nonce' ) ) return;


      $fields = [
          'pilar_h-title',
		      'pilar_h-subtitle'
      ];
      foreach ( $fields as $field ) {
          if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
          }

       }

  }
  add_action( 'save_post', 'meta_save_pilar_h' );










  function repeatable_meta_box_member_display() {
      global $post;
      $member = get_post_meta($post->ID, 'member', true);
      wp_nonce_field( 'hhs_repeatable_meta_box_nonce_member', 'hhs_repeatable_meta_box_nonce_member' );
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
        var i = $("#repeatable-fieldset-one_member .repeatable-item-ex").length - 1;

        $(document).on("click", "#add-row_member" , function() {
    			var row = $( '#repeatable-fieldset-one_member .empty-row.screen-reader-text.group' ).clone(true);
        			row.removeClass( 'empty-row screen-reader-text group' );
        			row.insertBefore( '#repeatable-fieldset-one_member .repeatable-item-wrapper:last' );
              row.find( 'input[name="order_member[]"]' ).val(i);
    			i++;
          return false;
    		});

        $(document).on("click", ".remove-row" , function() {
    			$(this).parents('.repeatable-item-wrapper').remove();
    			return false;
    		});

    	});
    	</script>

      <div id="repeatable-fieldset-one_member" width="100%">
        <?php

        $is = 0;

        if ( $member ) :

          sort($member);
          foreach ( $member as $field ) {
        ?>
          <div class="repeatable-item-wrapper repeatable-item-ex">
            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Order
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="order_member[]" value="<?php if($field['order_member'] != '') echo esc_attr( $field['order_member'] ); ?>"  style="width: 50px" />
              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Images
              </div>
              <div class="repeatable-item-value">
                <input name="images_member[]" class="images" type="hidden" value="<?php if($field['images_member'] != '') echo esc_attr( $field['images_member'] ); ?>"  />
                <img class="meta-image-preview" src="<?php if($field['images_member'] != '') echo esc_attr( $field['images_member'] ); ?>" alt="" width="100px;">
                <input class="images_button button button-small" type="button" value="Upload Image" />

              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Link
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="link_member[]" value="<?php if($field['link_member'] != '') echo esc_attr( $field['link_member'] ); ?>" />
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
                <input type="text" class="widefat" name="order_member[]" value="<?= $is; ?>" style="width: 50px"/>
              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Images
              </div>
              <div class="repeatable-item-value">
                <input name="images_member[]" class="images" type="hidden"  />
                <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
                <img class="meta-image-preview" src="<?php if($field['images_member'] != '') echo esc_attr( $field['images_member'] ); ?>" alt="" width="100px;">
              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Link
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="link_member[]"/>
              </div>
            </div>

            <a class="button remove-row" href="#">Remove</a>

          </div>


        <?php
$is++;
      endif; ?>

        <!-- empty hidden one for jQuery -->
        <div class="repeatable-item-wrapper repeatable-item-ex empty-row screen-reader-text group">

          <div class="repeatable-item">
            <div class="repeatable-item-label">
              Order
            </div>
            <div class="repeatable-item-value">
              <input type="text" class="widefat" name="order_member[]" style="width: 50px"/>
            </div>
          </div>


          <div class="repeatable-item">
            <div class="repeatable-item-label">
              Images
            </div>
            <div class="repeatable-item-value">
              <input name="images_member[]" class="images" type="hidden"  />
              <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
              <img class="meta-image-preview" src="" alt="" width="100px;">
            </div>
          </div>

          <div class="repeatable-item">
            <div class="repeatable-item-label">
              Link
            </div>
            <div class="repeatable-item-value">
              <input type="text" class="widefat" name="link_member[]"/>
            </div>
          </div>

          <a class="button remove-row" href="#">Remove</a>

        </div>

      </div>

      <hr>
      <hr>

      <p><a id="add-row_member" class="button" href="#">Add another</a></p>

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


    function repeatable_meta_box_member_save($post_id) {
        if ( ! isset( $_POST['hhs_repeatable_meta_box_nonce_member'] ) ||
        ! wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce_member'], 'hhs_repeatable_meta_box_nonce_member' ) )
            return;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        if (!current_user_can('edit_post', $post_id))
            return;

        $old = get_post_meta($post_id, 'member', true);
        $new = array();

        $order = $_POST['order_member'];
        $images = $_POST['images_member'];

        $link = $_POST['link_member'];

        $count = count( $order );

        for ( $i = 0; $i < $count; $i++ ) {
          if ( $images[$i] != '' ) :
            $new[$i]['order_member'] = stripslashes( strip_tags( $order[$i] ) );

            $new[$i]['images_member'] = stripslashes( strip_tags( $images[$i] ) );

            $new[$i]['link_member'] = stripslashes( strip_tags( $link[$i] ) );
          endif;
        }
        if ( !empty( $new ) && $new != $old )
            update_post_meta( $post_id, 'member', $new );

        elseif ( empty($new) && $old )
            delete_post_meta( $post_id, 'member', $old );
    }
    add_action('save_post', 'repeatable_meta_box_member_save');








      function repeatable_meta_box_rangked_display() {
          global $post;
          $rangked = get_post_meta($post->ID, 'rangked', true);
          wp_nonce_field( 'hhs_repeatable_meta_box_nonce_rangked', 'hhs_repeatable_meta_box_nonce_rangked' );
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
            var i = $("#repeatable-fieldset-one_rangked .repeatable-item-ex").length - 1;

            $(document).on("click", "#add-row_rangked" , function() {
        			var row = $( '#repeatable-fieldset-one_rangked .empty-row.screen-reader-text.group' ).clone(true);
            			row.removeClass( 'empty-row screen-reader-text group' );
            			row.insertBefore( '#repeatable-fieldset-one_rangked .repeatable-item-wrapper:last' );
                  row.find( 'input[name="order_rangked[]"]' ).val(i);
        			i++;
              return false;
        		});

            $(document).on("click", ".remove-row" , function() {
        			$(this).parents('.repeatable-item-wrapper').remove();
        			return false;
        		});

        	});
        	</script>

          <div id="repeatable-fieldset-one_rangked" width="100%">
            <?php

            $is = 0;

            if ( $rangked ) :

              sort($rangked);
              foreach ( $rangked as $field ) {
            ?>
              <div class="repeatable-item-wrapper repeatable-item-ex">
                <div class="repeatable-item">
                  <div class="repeatable-item-label">
                    Order
                  </div>
                  <div class="repeatable-item-value">
                    <input type="text" class="widefat" name="order_rangked[]" value="<?php if($field['order_rangked'] != '') echo esc_attr( $field['order_rangked'] ); ?>"  style="width: 50px" />
                  </div>
                </div>

                <div class="repeatable-item">
                  <div class="repeatable-item-label">
                    Images
                  </div>
                  <div class="repeatable-item-value">
                    <input name="images_rangked[]" class="images" type="hidden" value="<?php if($field['images_rangked'] != '') echo esc_attr( $field['images_rangked'] ); ?>"  />
                    <img class="meta-image-preview" src="<?php if($field['images_rangked'] != '') echo esc_attr( $field['images_rangked'] ); ?>" alt="" width="100px;">
                    <input class="images_button button button-small" type="button" value="Upload Image" />

                  </div>
                </div>

                <div class="repeatable-item">
                  <div class="repeatable-item-label">
                    Link
                  </div>
                  <div class="repeatable-item-value">
                    <input type="text" class="widefat" name="link_rangked[]" value="<?php if($field['link_rangked'] != '') echo esc_attr( $field['link_rangked'] ); ?>" />
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
                    <input type="text" class="widefat" name="order_rangked[]" value="<?= $is; ?>" style="width: 50px"/>
                  </div>
                </div>

                <div class="repeatable-item">
                  <div class="repeatable-item-label">
                    Images
                  </div>
                  <div class="repeatable-item-value">
                    <input name="images_rangked[]" class="images" type="hidden"  />
                    <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
                    <img class="meta-image-preview" src="<?php if($field['images_rangked'] != '') echo esc_attr( $field['images_rangked'] ); ?>" alt="" width="100px;">
                  </div>
                </div>

                <div class="repeatable-item">
                  <div class="repeatable-item-label">
                    Link
                  </div>
                  <div class="repeatable-item-value">
                    <input type="text" class="widefat" name="link_rangked[]"/>
                  </div>
                </div>

                <a class="button remove-row" href="#">Remove</a>

              </div>


            <?php
    $is++;
          endif; ?>

            <!-- empty hidden one for jQuery -->
            <div class="repeatable-item-wrapper repeatable-item-ex empty-row screen-reader-text group">

              <div class="repeatable-item">
                <div class="repeatable-item-label">
                  Order
                </div>
                <div class="repeatable-item-value">
                  <input type="text" class="widefat" name="order_rangked[]" style="width: 50px"/>
                </div>
              </div>


              <div class="repeatable-item">
                <div class="repeatable-item-label">
                  Images
                </div>
                <div class="repeatable-item-value">
                  <input name="images_rangked[]" class="images" type="hidden"  />
                  <input class="images_button button button-small" type="button" value="Upload Image" /><br/>
                  <img class="meta-image-preview" src="" alt="" width="100px;">
                </div>
              </div>

              <div class="repeatable-item">
                <div class="repeatable-item-label">
                  Link
                </div>
                <div class="repeatable-item-value">
                  <input type="text" class="widefat" name="link_rangked[]"/>
                </div>
              </div>

              <a class="button remove-row" href="#">Remove</a>

            </div>

          </div>

          <hr>
          <hr>

          <p><a id="add-row_rangked" class="button" href="#">Add another</a></p>

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


        function repeatable_meta_box_rangked_save($post_id) {
            if ( ! isset( $_POST['hhs_repeatable_meta_box_nonce_rangked'] ) ||
            ! wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce_rangked'], 'hhs_repeatable_meta_box_nonce_rangked' ) )
                return;

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return;

            if (!current_user_can('edit_post', $post_id))
                return;

            $old = get_post_meta($post_id, 'rangked', true);
            $new = array();

            $order = $_POST['order_rangked'];
            $images = $_POST['images_rangked'];

            $link = $_POST['link_rangked'];

            $count = count( $order );

            for ( $i = 0; $i < $count; $i++ ) {
              if ( $images[$i] != '' ) :
                $new[$i]['order_rangked'] = stripslashes( strip_tags( $order[$i] ) );

                $new[$i]['images_rangked'] = stripslashes( strip_tags( $images[$i] ) );

                $new[$i]['link_rangked'] = stripslashes( strip_tags( $link[$i] ) );
              endif;
            }
            if ( !empty( $new ) && $new != $old )
                update_post_meta( $post_id, 'rangked', $new );

            elseif ( empty($new) && $old )
                delete_post_meta( $post_id, 'rangked', $old );
        }
        add_action('save_post', 'repeatable_meta_box_rangked_save');

?>
