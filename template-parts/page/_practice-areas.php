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

          <div class="w-100 mb-20 pb-20 accordionBox">
            <div class="accordionItem">
              <div class="accordionLabel">
                <h3 class="extrabold fblue mb-10">Prosecution</h3>
              </div>

              <div class="accordionBody content-body">
                <p>BLorem Ipsu oin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum nisi elit consequat ipsum, nec sagittis sebh id elit. Duis sed odio sit amet nibh vulputatrsus a sit amet mauris. Morbi accumsan ipsum venec tellus a odio tincidunt auctor Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felispibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum am pharetra, erat sed fermentum.</p>

                <p>Morbi accumsan ipsum venec tellus a odio tincidunt auctor Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felispibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum am pharetra, erat sed fermentum. Peugiat, velit mauris egestas quam, ut.</p>
              </div>
            </div>
          </div>

          <div class="w-100 mb-20 pb-20 accordionBox">
            <div class="accordionItem">
              <div class="accordionLabel">
                <h3 class="extrabold fblue mb-10">Contentious</h3>
              </div>

              <div class="accordionBody content-body">
                <p>BLorem Ipsu oin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum nisi elit consequat ipsum, nec sagittis sebh id elit. Duis sed odio sit amet nibh vulputatrsus a sit amet mauris. Morbi accumsan ipsum venec tellus a odio tincidunt auctor Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felispibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum am pharetra, erat sed fermentum.</p>

                <p>Morbi accumsan ipsum venec tellus a odio tincidunt auctor Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felispibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum am pharetra, erat sed fermentum. Peugiat, velit mauris egestas quam, ut.</p>
              </div>
            </div>
          </div>

        </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>

      </div>
      <div class="practiceareasSingle-sidebar">

        <div class="w-100 mb-20 pb-20">
          <h5 class="extrabold fblue-soft mb-10">Our Other Practice Areas</h5>

          <div class="practiceareasList-side">
            <!-- Swiper -->
            <div class="swiper sliderPracticeareas-side">
              <div class="swiper-wrapper">
              <?php
                $page_practice_areas = 88;
                $args = array(
                  'post_per_page' => -1,
                  'orderby'       => 'menu_order',
                  'order'         => 'asc',
                  'post_type'     => 'page',
                  'post_parent'   => $page_practice_areas,
                  'post__not_in'  => array($post->ID),
                );

                $child_pages = query_posts($args);
                if ( $child_pages ) :
                    foreach ( $child_pages as $pageChild ) :
                      ?>
                      <div class="swiper-slide">
                        <div class="practiceareasItem mb-10">
                          <div class="practiceareasItem-inner">
                            <a href="<?php echo get_permalink($pageChild->ID) ?>">
                              <div class="practiceareasItem-img">
                                <?php if ( has_post_thumbnail($pageChild->ID) ) { ?>
                                  <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageChild->ID ), 'single-post-thumbnail' ); ?>
                                  <img class="lozad" data-src="<?= $image[0]; ?>" alt="<?= $pageChild->post_title; ?>">
                                <?php } ?>
                              </div>
                              <div class="practiceareasItem-detail">
                                <h5 class="fblue"><?= $pageChild->post_title; ?></h5>
                              </div>
                            </a>
                          </div>
                        </div>
                      </div>
                      <?php
                    endforeach;
                endif;
              ?>
              </div>
            </div>

            <div class="swiper-acc">
              <div class="swiper-pagination"></div>
            </div>
            <!-- Swiper End -->


          </div>
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
                    $args = array( 'post_type'=> 'professionals', 'posts_per_page' => -1, 'order'         => 'asc' );
                    $professionals = new WP_Query( $args );
                    if($professionals->have_posts() ) : while ( $professionals->have_posts() ) : $professionals->the_post();

                    $professionals_type = get_the_terms(get_the_ID(), 'professionals-category');
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
                <?php  endwhile; endif; ?>
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