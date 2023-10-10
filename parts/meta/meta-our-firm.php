<?php


function add_our_firm_meta() {

  global $post;
  if(!empty($post))
  {
      $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

      if($pageTemplate == 'templates/page-our-firm.php' )
      {
        add_meta_box( 'our_firm', 'Our Firm Content', 'meta_our_firm', 'page', 'normal', 'high');
        add_meta_box( 'repeatable-fields', 'Awards and Recognitions', 'repeatable_meta_box_awards_recognitions_display', 'page', 'normal', 'high');
      }
  }

}
add_action('add_meta_boxes', 'add_our_firm_meta', 1);


  function meta_our_firm( $post) {
    wp_nonce_field( '_hcf_meta_nonce', 'hcf_meta_nonce' ); ?>

    <table class="form-table">
      <tbody>

        <tr class="form-field">
          <th scope="row">
              <label for="our_firm-title">Title</label>
          </th>
          <td>
  					<input id="our_firm-title" type="text" name="our_firm-title" value="<?php echo get_post_meta( get_the_ID(), 'our_firm-title', true ); ?>">
          </td>
        </tr>

		    <tr class="form-field">
					<th scope="row">
							<label for="our_firm-subtitle">Sub Title</label>
					</th>
					<td>
            <input id="our_firm-subtitle" type="text" name="our_firm-subtitle" value="<?php echo get_post_meta( get_the_ID(), 'our_firm-subtitle', true ); ?>">
					</td>
				</tr>


        <tr class="form-field">
          <th scope="row">
              <label for="input-company_profile">Company Profile PDF</label>
          </th>
          <td>
            <input name="input-company_profile" class="pdf-company_profile" type="text" value="<?php echo get_post_meta( get_the_ID(), 'input-company_profile', true ); ?>"  />
            <br>
            <br>
            <input class="images_button button button-small" type="button" value="Upload PDF" /><br/>
          </td>
        </tr>

      </tbody>

    </table>

    <hr>
    <hr>Awards and Recognitions

    <table class="form-table">
      <tbody>

        <tr class="form-field">
          <th scope="row">
              <label for="our_firm-title_1">Title 1</label>
          </th>
          <td>
            <input id="our_firm-title_1" type="text" name="our_firm-title_1" value="<?php echo get_post_meta( get_the_ID(), 'our_firm-title_1', true ); ?>">
          </td>
        </tr>

        <tr class="form-field">
          <th scope="row">
              <label for="our_firm-subtitle">Sub Title 1</label>
          </th>
          <td>
            <input id="our_firm-subtitle_1" type="text" name="our_firm-subtitle_1" value="<?php echo get_post_meta( get_the_ID(), 'our_firm-subtitle_1', true ); ?>">
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
      $(document).on('click', '.images_button', function (e) {
        e.preventDefault();
        uploadMedia({
          target: $(this).parent().find(".pdf-company_profile"),
          type: 'application/pdf'
        });
      });


    });
    </script>

  <?php }


  function get_meta_our_firm( $value ) {
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
  function meta_save_our_firm( $post_id ) {

      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      if ( $parent_id = wp_is_post_revision( $post_id ) ) {
          $post_id = $parent_id;
      }
      if ( ! isset( $_POST['hcf_meta_nonce'] ) || ! wp_verify_nonce( $_POST['hcf_meta_nonce'], '_hcf_meta_nonce' ) ) return;


      $fields = [
          'our_firm-title',
		      'our_firm-subtitle',
		      'input-company_profile',
          'our_firm-title_1',
		      'our_firm-subtitle_1'
      ];
      foreach ( $fields as $field ) {
          if ( array_key_exists( $field, $_POST ) ) {
            update_post_meta( $post_id, $field, $_POST[$field] );
          }

       }

  }
  add_action( 'save_post', 'meta_save_our_firm' );










  function repeatable_meta_box_awards_recognitions_display() {
      global $post;
      $awards_recognitions = get_post_meta($post->ID, 'awards_recognitions', true);
      wp_nonce_field( 'hhs_repeatable_meta_box_nonce_awards_recognitions', 'hhs_repeatable_meta_box_nonce_awards_recognitions' );
      ?>
      <style media="screen">
        .panel-media {
          min-height: 42px;
          max-height: 150px;
          overflow: auto;
          padding: 0 0.9em;
          border: solid 1px #dcdcde;
          background-color: #fff;
        }

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

        $is = 0;

        if ( $awards_recognitions ) :

          sort($awards_recognitions);
          foreach ( $awards_recognitions as $field ) {
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
                Year
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="year[]" value="<?php if($field['year'] != '') echo esc_attr( $field['year'] ); ?>" />
              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Media
              </div>

              <div class="repeatable-item-value">
                <select name="media[]" class="filters-select">
                  <option value="">Select Media</option>
                  <?php
                  $terms = get_terms( array(
                    'taxonomy' => 'testimonials-media',
                    'child_of'               => 0,
                    'parent'                 => 0,
                    'fields'                 => 'all',
                    'hide_empty'             => true,
                  ));

                  foreach( $terms as $term ) { ?>
                    <option value="<?= $term->term_id; ?>" <?php if($field['media'] == $term->term_id) echo 'selected'; ?>><?= $term->name; ?></option>
                  <?php } ?>
                </select>
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
                Year
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="year[]" value="" />
              </div>
            </div>

            <div class="repeatable-item">
              <div class="repeatable-item-label">
                Media
              </div>

              <div class="repeatable-item-value">
                <select name="media[]" class="filters-select">
                  <option value="">Select Media</option>
                  <?php
                  $terms = get_terms( array(
                    'taxonomy' => 'testimonials-media',
                    'child_of'               => 0,
                    'parent'                 => 0,
                    'fields'                 => 'all',
                    'hide_empty'             => true,
                  ));

                  foreach( $terms as $term ) { ?>
                    <option value="<?= $term->term_id; ?>" <?php if($field['media'] == $term->term_id) echo 'selected'; ?>><?= $term->name; ?></option>
                  <?php } ?>
                </select>
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
                Year
              </div>
              <div class="repeatable-item-value">
                <input type="text" class="widefat" name="year[]" value="" />
              </div>
            </div>

          <div class="repeatable-item">
            <div class="repeatable-item-label">
              Media
            </div>

            <div class="repeatable-item-value">
              <select name="media[]" class="filters-select">
                <option value="">Select Media</option>
                <?php
                $terms = get_terms( array(
                  'taxonomy' => 'testimonials-media',
                  'child_of'               => 0,
                  'parent'                 => 0,
                  'fields'                 => 'all',
                  'hide_empty'             => true,
                ));

                foreach( $terms as $term ) { ?>
                  <option value="<?= $term->term_id; ?>"><?= $term->name; ?></option>
                <?php } ?>
              </select>
            </div>

          </div>


          <a class="button remove-row" href="#">Remove</a>

        </div>

      </div>

      <hr>
      <hr>

      <p><a id="add-row" class="button" href="#">Add another</a></p>


      <?php
    }


    function repeatable_meta_box_awards_recognitions_save($post_id) {
        if ( ! isset( $_POST['hhs_repeatable_meta_box_nonce_awards_recognitions'] ) ||
        ! wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce_awards_recognitions'], 'hhs_repeatable_meta_box_nonce_awards_recognitions' ) )
            return;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        if (!current_user_can('edit_post', $post_id))
            return;

        $old = get_post_meta($post_id, 'awards_recognitions', true);
        $new = array();

        $order = $_POST['order'];
        $title = $_POST['title'];
        $year = $_POST['year'];

        $media = $_POST['media'];

        $count = count( $order );

        for ( $i = 0; $i < $count; $i++ ) {
          if ( $title[$i] != '' ) :
            $new[$i]['order'] = stripslashes( strip_tags( $order[$i] ) );

            $new[$i]['title'] = stripslashes( strip_tags( $title[$i] ) );
            $new[$i]['year'] = stripslashes( strip_tags( $year[$i] ) );

            $new[$i]['media'] = stripslashes( strip_tags( $media[$i] ) );
          endif;
        }
        if ( !empty( $new ) && $new != $old )
            update_post_meta( $post_id, 'awards_recognitions', $new );

        elseif ( empty($new) && $old )
            delete_post_meta( $post_id, 'awards_recognitions', $old );
    }
    add_action('save_post', 'repeatable_meta_box_awards_recognitions_save');

?>
