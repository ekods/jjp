<?php


function add_testimonials_h_meta() {

  global $post;
  if(!empty($post))
  {

    if($post->ID == 221 )
    {
      add_meta_box( 'repeatable-fields', 'Testimonials Highlight', 'repeatable_meta_box_testimonials_highlight_display', 'page', 'normal', 'high');
      remove_post_type_support('page', 'editor');
    }

  }

}
add_action('add_meta_boxes', 'add_testimonials_h_meta', 1);



  function repeatable_meta_box_testimonials_highlight_display() {
      global $post;
      $testimonials_highlight = get_post_meta($post->ID, 'testimonials_highlight', true);
      wp_nonce_field( 'hhs_repeatable_meta_box_nonce_testimonials_highlight', 'hhs_repeatable_meta_box_nonce_testimonials_highlight' );
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

        if ( $testimonials_highlight ) :

          sort($testimonials_highlight);
          foreach ( $testimonials_highlight as $field ) {
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


    function repeatable_meta_box_testimonials_highlight_save($post_id) {
        if ( ! isset( $_POST['hhs_repeatable_meta_box_nonce_testimonials_highlight'] ) ||
        ! wp_verify_nonce( $_POST['hhs_repeatable_meta_box_nonce_testimonials_highlight'], 'hhs_repeatable_meta_box_nonce_testimonials_highlight' ) )
            return;

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;

        if (!current_user_can('edit_post', $post_id))
            return;

        $old = get_post_meta($post_id, 'testimonials_highlight', true);
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
            update_post_meta( $post_id, 'testimonials_highlight', $new );

        elseif ( empty($new) && $old )
            delete_post_meta( $post_id, 'testimonials_highlight', $old );
    }
    add_action('save_post', 'repeatable_meta_box_testimonials_highlight_save');

?>
