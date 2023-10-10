<div class="singleWrap">
  <div class="container">
    <div class="practiceareasSingle">
      <div class="practiceareasSingle-main">
        <?php custom_breadcrumbs(); ?>

        <?php if(have_posts()) : while(have_posts())  : the_post(); ?>
        <div class="w-100">
          <h1 class="extrabold fblue mb-20"><?= the_title(); ?></h1>

          <div class="content-body alignjustify mb-40">
            <?= the_content(); ?>
          </div>

          <?php $practice_areas_prosecution = get_post_meta( get_the_ID(), 'practice_areas-prosecution', true);
          if(!empty($practice_areas_prosecution)){ ?>
          <div class="w-100 mb-20 pb-20 accordionBox">
           <div class="accordionItem accordion-open">
             <div class="accordionLabel">
               <h3 class="extrabold fblue mb-10">Prosecution</h3>
             </div>

             <div class="accordionBody content-body alignjustify accordionBody-open">
                <?= htmlspecialchars_decode($practice_areas_prosecution); ?>
             </div>
           </div>
          </div>
          <?php } ?>
          <?php $practice_areas_contentious = get_post_meta( get_the_ID(), 'practice_areas-contentious', true);
          if(!empty($practice_areas_contentious)){ ?>
          <div class="w-100 mb-20 pb-20 accordionBox">
           <div class="accordionItem accordion-open">
             <div class="accordionLabel">
               <h3 class="extrabold fblue mb-10">Contentious</h3>
             </div>

             <div class="accordionBody content-body alignjustify accordionBody-open">
               <?= htmlspecialchars_decode($practice_areas_contentious); ?>
             </div>
           </div>
          </div>
          <?php } ?>


        </div>

        <div class="share-holder ver-share fl-wrap">
              <div class="shareTitle">Share</div>
              <div class="shareContainer isShare"></div>
          </div>

        <?php endwhile; endif; wp_reset_postdata(); ?>

      </div>
      <div class="practiceareasSingle-sidebar">

        <div class="w-100 mb-20 pb-20">
          <h5 class="extrabold fblue-soft mb-10">Our Other Practice Areas</h5>
          
          <?php
            $practice_areas_more = get_post_meta( get_the_ID(), 'practice_areas-more', true);
            if ( $practice_areas_more ) :
          ?>

          <div class="practiceareasList-side">
            <!-- Swiper -->
            <div class="swiper sliderPracticeareas-side">
              <div class="swiper-wrapper">
              <?php
                    foreach ( $practice_areas_more as $pa_id ) :
                      ?>
                      <div class="swiper-slide">
                        <div class="practiceareasItem mb-10">
                          <div class="practiceareasItem-inner">
                            <a href="<?php echo get_permalink($pa_id) ?>">
                              <div class="practiceareasItem-img">
                                <?php if ( has_post_thumbnail($pa_id) ) { ?>
                                  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $pa_id ), 'single-post-thumbnail' ); ?>
                                  <img class="lozad" data-src="<?= $image[0]; ?>" alt="<?= get_the_title($pa_id); ?>">
                                <?php } ?>
                              </div>
                              <div class="practiceareasItem-detail">
                                <h5 class="fblue"><?= get_the_title($pa_id); ?></h5>
                              </div>
                            </a>
                          </div>
                        </div>
                      </div>
                      <?php
                    endforeach;
                    ?>
              </div>
            </div>

            <div class="swiper-acc">
              <div class="swiper-pagination"></div>
            </div>
            <!-- Swiper End -->


          </div>
        <?php endif; ?>    
          
        </div>

      </div>

      <div class="w-100 mt-40 --practiceareasProfessionals">
        <div class="practiceareasProfessionals">
          <h5 class="extrabold">Meet Our <?= the_title(); ?> Professionals</h5>

          <div class="swiper-acc">
              <div class="swiper-nav">
                  <div class="swiper-button-next"></div>
                  <div class="swiper-button-prev"></div>
              </div>
          </div>

          <!-- Swiper -->
          <div class="swiper sliderProfessionals">
            <div class="swiper-wrapper">
                <?php
                    global $post;
                    $page_id = get_the_ID();
                    $args = array( 'post_type'=> 'professionals', 'posts_per_page' => -1, 'order' => 'asc', 'orderby' => 'term_order', 'order'=>'DESC' );
                    $professionals = new WP_Query( $args );
                    if($professionals->have_posts() ) : while ( $professionals->have_posts() ) : $professionals->the_post();

                    $professionals_type = get_the_terms(get_the_ID(), 'professionals-category');

                    $practice_areas = get_post_meta( get_the_ID(), 'professionals-practice_areas', true);
                        if ( $practice_areas ) :
                            foreach ( $practice_areas as $practice_area_id ) :
                                if($practice_area_id ==  $page_id) :
                ?>
                <div class="swiper-slide">
                  <div class="professionalsItem <?php foreach($professionals_type as $type ){ echo $type->slug; } ?>">
                    <div class="professionalsItem-inner">
                      <a href="<?= the_permalink(); ?>">
                        <div class="professionalsItem-img">
                          <?php if ( has_post_thumbnail() ) { ?>
                            <img class="lozad" data-src="<?= the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                          <?php } ?>
                        </div>
                      </a>
                      <div class="professionalsItem-detail">
                        <a href="<?= the_permalink(); ?>">
                          <h4><?= the_title(); ?></h4>
                        </a>
                        <ul class="professionalsItem-type">
                          <?php
                            foreach($professionals_type as $type ){
                              echo "<li><h6>". $type->name ."</h6></li>";
                            }
                          ?>
                        </ul>
                        <ul class="professionalsItem-connect">
                          <?php $professionals_linkedin = get_post_meta( get_the_ID(), 'professionals-linkedin', true);
                          if(!empty($professionals_linkedin)) echo '<li><a href="'. $professionals_linkedin .'" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>'; ?>

                          <?php $professionals_email = get_post_meta( get_the_ID(), 'professionals-email', true);
                          if(!empty($professionals_email)) echo '<li><a href="'. $professionals_email .'" target="_blank"><i class="fa-solid fa-envelope"></i></a></li>'; ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <?php  endif;
                            endforeach;
                        endif;
                endwhile; endif; ?>
            </div>
          </div>
          <!-- Swiper End -->

        </div>
      </div>


    </div>
  </div>
</div>
<script>

var init = false;

  function swiperCard() {
    if (window.innerWidth <= 767) {
      if (!init) {
        init = true;
        swiper = new Swiper(".sliderPracticeareas-side", {
          direction: "horizontal",
          slidesPerView: "auto",
          spaceBetween: 27,
          slidesPerView: 3,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          breakpoints: {
            320: {
              slidesPerView: 1,
              spaceBetween: 15
            },
            330: {
              slidesPerView: 2,
              spaceBetween: 15
            },
            600: {
              slidesPerView: 3,
              spaceBetween: 15
            },
          }
        });
      }
    } else if (init) {
      swiper.destroy();
      init = false;
    }
  }
  swiperCard();
  window.addEventListener("resize", swiperCard);

</script>
