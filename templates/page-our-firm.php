<?php

/*
 * Template Name: Page Our Firm
 */
get_header(); ?>

    <?php if (!empty(get_post_meta( get_the_ID(), 'hero-img', true ))): ?>
    <section id="hero" class="heroWrapper">
        <div class="heroInner">
            <?php if ( has_post_thumbnail() ) { ?>
                <img class="lozad" data-src="<?= the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            <?php } ?>
            <?php if (!empty(get_post_meta( get_the_ID(), 'hero-title', true ))): ?>
                <div class="heroTitle">
                    <div class="container">
                        <h3><?= the_title(); ?></h3>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>

    <div class="pageOurFirm">
        <div class="container">
            <div class="w-100">
                <div class="pageOurFirm-sub">
                  <?php $our_firm_title = get_post_meta( get_the_ID(), 'our_firm-title', true);
                  if(!empty($our_firm_title)) echo '<h5>'. $our_firm_title .'</h5>'; ?>
                </div>
            </div>
            <div class="pageOurFirm-wrap">
                <div class="pageOurFirm-col">
                    <div class="w-100 mb-40 mt-10">
                        <?php $our_firm_subtitle = get_post_meta( get_the_ID(), 'our_firm-subtitle', true);
                        if(!empty($our_firm_subtitle)) echo '<h2 class="extrabold">'. $our_firm_subtitle .'</h2>'; ?>

                        <div class="w-100 mt-40">
                            <div class="row">
                                <div class="col-md-6 mb-10">
                                    <a href="<?php $company_profile = get_post_meta( get_the_ID(), 'input-company_profile', true);
                                    if(!empty($company_profile)) echo $company_profile; ?>" target="_blank" class="downloadCompro"><i class="fa-solid fa-download"></i> Download Company Profile</a>
                                </div>
                                <div class="col-md-6 mb-10">
                                    <a href="<?= esc_url(home_url('professionals')) ?>" class="btnCta">Discover Our Team</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pageOurFirm-col">
                    <div class="content-body alignjustify mb-40">
                        <?= the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pageOurFirm --sectionawards">
        <div class="container">
            <div class="w-100">
                <div class="pageOurFirm-sub">
                  <?php $our_firm_title_1 = get_post_meta( get_the_ID(), 'our_firm-title_1', true);
                  if(!empty($our_firm_title_1)) echo '<h5>'. $our_firm_title_1 .'</h5>'; ?>
                </div>
            </div>
            <div class="pageOurFirm-wrap">
                <div class="pageOurFirm-col">
                    <div class="w-100 mb-40 mt-10">
                        <?php $our_firm_subtitle_1 = get_post_meta( get_the_ID(), 'our_firm-subtitle_1', true);
                        if(!empty($our_firm_subtitle_1)) echo '<h2 class="extrabold">'. $our_firm_subtitle_1 .'</h2>'; ?>

                        <div class="w-100 mt-40">
                            <div class="row">
                                <div class="col-md-6 mb-10">
                                    <a href="<?= esc_url(home_url('testimonials')) ?>" class="btnCta">View Our Testimonials</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pageOurFirm-col">
                  <!-- Swiper -->
                  <div class="swiper sliderTestimonials">
                      <div class="swiper-wrapper">
                        <?php $awards_recognitions_item = get_post_meta( get_the_ID(), 'awards_recognitions', true);

                        sort($awards_recognitions_item);
                        foreach ($awards_recognitions_item as $awards_recognitions): ?>
                          <div class="swiper-slide">
                            <div class="testimonialsItem">
                                <div class="testimonialsItem-content mb-30">
                                    <h4 class="extrabold">
                                    <?php
                                      if(!empty($awards_recognitions['title'])) echo $awards_recognitions['title']; ?>
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
                                <?php if($awards_recognitions['media'] == $term->term_id){

                                  $awards_recognition_media = get_the_terms(get_the_ID(), 'testimonials-media');
                                  $med_1 = $term->term_id;
                                  $awards_recognition_media_meta = get_option("taxonomy_term_$med_1");
                                ?>
                                <div class="testimonialsItem-detail">
                                    <div class="testimonialsItem-icon">
                                        <div class="thumb-sq">
                                          <?php
                                            if(!empty($med_1)){
                                              echo "<img class='lozad' data-src='" . $awards_recognition_media_meta['icon_images'] . "' alt='" . $term->name . "'>";
                                            }
                                          ?>
                                        </div>
                                    </div>
                                    <div class="testimonialsItem-label">
                                      <h5 class="fblue extrabold"><?= $term->name; ?></h5>
                                      <?php if(!empty($awards_recognitions['year'])) echo '<p>'. $awards_recognitions['year'] .'</p>'; ?>
                                    </div>
                                </div>
                                <?php }
                              } ?>

                            </div>
                          </div>

                        <?php endforeach; ?>

                      </div>

                      <div class="swiper-acc">
                          <div class="swiper-pagination"></div>
                      </div>
                  </div>
                  <!-- Swiper End -->

                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>
