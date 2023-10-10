<!-- Swiper -->
<div class="swiper sliderTestimonials">
    <div class="swiper-wrapper">
      <?php $the_query = new WP_Query ( "page_id= 221" ); ?>
      <?php while ($the_query -> have_posts()) : $the_query -> the_post();
          $testimonials_highlight = get_post_meta( get_the_ID(), 'testimonials_highlight', true);

      sort($testimonials_highlight);
      foreach ($testimonials_highlight as $testimonials_): ?>
        <div class="swiper-slide">
          <div class="testimonialsItem">
              <div class="testimonialsItem-content mb-30">
                  <h4 class="extrabold">
                  <?php
                    if(!empty($testimonials_['title'])) echo $testimonials_['title']; ?>
                  </h4>
              </div>
              <?php
              $terms = get_terms( array(
                'taxonomy' => 'testimonials-media',
                'child_of'               => 0,
                'parent'                 => 0,
                'fields'                 => 'all',
                'hide_empty'             => true,
              ));

              foreach( $terms as $term ) { ?>
              <?php if($testimonials_['media'] == $term->term_id){

                $testimonials_media = get_the_terms(get_the_ID(), 'testimonials-media');
                $med_1 = $term->term_id;
                $testimonials_media_meta = get_option("taxonomy_term_$med_1");
              ?>
              <div class="testimonialsItem-detail">
                  <div class="testimonialsItem-icon">
                      <div class="thumb-sq">
                        <?php
                          if(!empty($med_1)){
                            echo "<img class='lozad' data-src='" . $testimonials_media_meta['icon_images'] . "' alt='" . $term->name . "'>";
                          }
                        ?>
                      </div>
                  </div>
                  <div class="testimonialsItem-label">
                    <h5 class="fblue extrabold"><?= $term->name; ?></h5>
                    <?php if(!empty($testimonials_['year'])) echo '<p>'. $testimonials_['year'] .'</p>'; ?>
                  </div>
              </div>
              <?php }
            } ?>

          </div>
        </div>

      <?php endforeach; ?>

      <?php endwhile;?>

    </div>

    <div class="swiper-acc">
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Swiper End -->
