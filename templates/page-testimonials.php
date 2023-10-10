<?php

/*
 * Template Name: Page Testimonials
 */
get_header(); ?>

    <?php get_template_part( 'template-parts/section/_hero' ); ?>



    <?php
        $side_left = get_post_meta( get_the_ID(), 'head_page-side-left', true);
        $side_right = get_post_meta( get_the_ID(), 'head_page-side-right', true);
    ?>
    <div class="pageHead bgblue-soft">
      <div class="container">
        <div class="dflex row">
          <div class="col-50">
            <?php if(!empty($side_left)): ?>
            <h2><?= $side_left; ?></h2>
            <?php endif; ?>
          </div>
          <div class="col-50 alignjustify">
            <?php if(!empty($side_right)): ?>
            <h4><?= $side_right; ?></h4>
            <?php endif; ?>

            <div class="filtersBox mt-40">
              <select class="filters-select">
                <option value="" disabled selected>Filter by Years</option>
                <option value="*">All Years</option>
                <?php
                $terms = get_terms( array(
                  'taxonomy' => 'testimonials-year', // <-- Custom Taxonomy name..
                  'orderby'                => 'name',
                  'order'                  => 'ASC',
                  'child_of'               => 0,
                  'parent'                 => 0,
                  'fields'                 => 'all',
                  'hide_empty'             => false,
                ));

                foreach( $terms as $term ) {
                  echo '<option value=".year_'. $term->slug .'">'. $term->name .'</option>';
                }
                ?>
              </select>
            </div>

          </div>
        </div>
      </div>
    </div>


    <div class="testimonialsWrap bgblue-soft">
      <div class="container">
        <div class="testimonialsList --testimonialsList-isotope">
            <?php
            $terms = get_terms( array(
              'taxonomy' => 'testimonials-year', // <-- Custom Taxonomy name..
              'orderby'                => 'name',
              'order'                  => 'ASC',
              'child_of'               => 0,
              'parent'                 => 0,
              'fields'                 => 'all',
              'hide_empty'             => true,
            ));

            foreach( $terms as $term ) { ?>
            <div class="testimonialsGroup year_<?= $term->name; ?>" data-label="<?= $term->name; ?>" data-id="<?= $term->term_id; ?>">
              <div class="testimonialsGroup-wrap">

              <?php
                    global $post;
                    $args = array(
                      'post_type'=> 'testimonials',
                      'posts_per_page' => -1,
                      'tax_query' => array(
                          array(
                              'taxonomy' => 'testimonials-year',
                              'field' => 'term_id',
                              'terms' => $term->term_id,
                          ),
                      ),
                    );
                    $the_query = new WP_Query( $args );
                    if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                    $testimonials_media = get_the_terms(get_the_ID(), 'testimonials-media');
                    $med_1 = isset($testimonials_media[0]->term_id) ? $testimonials_media[0]->term_id : '';
                    $testimonials_media_meta = get_option("taxonomy_term_$med_1");
                ?>
                <div class="testimonialsItem">
                    <div class="testimonialsItem-inner">
                      <div class="testimonialsItem-detail mb-30">
                          <div class="testimonialsItem-icon">
                              <div class="thumb-sq">
                                <?php
                                  if(!empty($med_1)){
                                    echo "<img class='lozad' data-src='" . $testimonials_media_meta['icon_images'] . "' alt='" . $testimonials_media[0]->name . "'>";
                                  }
                                ?>
                              </div>
                          </div>
                          <div class="testimonialsItem-label">
                            <!-- <a href="https://www.legal500.com/c/indonesia/intellectual-property/" target="_blank">
                              <h5 class="fblue extrabold"><?= the_title(); ?></h5>
                            </a> -->
                            <h5 class="fblue extrabold"><?= the_title(); ?></h5>
                            <p><?= $term->name; ?></p>
                          </div>
                      </div>
                      <div class="testimonialsItem-content mb-20 show-more-height">
						  	<h4 class="extrabold">
							<?php $testimonials_highlight = get_post_meta( get_the_ID(), 'testimonials-highlight', true);
							if(!empty($testimonials_highlight)) echo htmlspecialchars_decode($testimonials_highlight); ?>
							</h4>
                        <div class="content-body mt-20" data-id="<?= $med_1; ?>">
                          <?= the_content(); ?>
                        </div>
                      </div>

                      <div class="postItem-detail_link show-more">Read More</div>

                      <!-- <?php $testimonials_url = get_post_meta( get_the_ID(), 'testimonials-url', true);
                      if(!empty($testimonials_url)){ ?>

                      <a href="<?= $testimonials_url; ?>" class="postItem-detail_link show-more">
                        Read More
                      </a>

                      <?php } ?> -->
                    </div>
                </div>
                <?php  endwhile; endif; ?>

              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>



<?php get_footer(); ?>
