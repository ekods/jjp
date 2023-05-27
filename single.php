<?php get_header(); ?>
<!--?php setPostViews(get_the_ID()); ?-->

<!--?php get_template_part( 'template-parts/section/_hero' ); ?-->


<div class="singleWrap">
  <div class="container">
    <div class="postSingle">
      <div class="postSingle-main">
        <?php custom_breadcrumbs(); ?>

        <?php if(have_posts()) : while(have_posts())  : the_post(); ?>
        <div class="w-100">
          <h2 class="extrabold mb-20"><?= the_title(); ?></h2>
          <p class="fblue mb-40"><?= the_time( 'M d, Y' ); ?></p>
          <div class="content-body alignjustify mb-40">
            <?= the_content(); ?>
          </div>

          <div class="share-holder ver-share fl-wrap mb-40">
              <div class="shareTitle">Share</div>
              <div class="shareContainer isShare"></div>
          </div>

        </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>

      </div>
      <div class="postSingle-sidebar">

        <div class="w-100 mb-20 pb-20">
          <h5 class="extrabold fblue-soft mb-10">Related News & Updates</h5>

          <div class="postList-side mt-20">
            <!-- Swiper -->
            <div class="swiper sliderPost-side">
              <div class="swiper-wrapper">
              <?php
                //query arguments
                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 4,
                    'post__not_in' => array ($post->ID),
                );
                $relatedPosts = new WP_Query( $args );

                //loop through query
                if($relatedPosts->have_posts()){
                    while($relatedPosts->have_posts()){
                        $relatedPosts->the_post();
                ?>
                    <div class="swiper-slide">
                      <div class="postItem mb-20">
                        <div class="postItem-inner">
                          <a href="<?php echo get_the_permalink(); ?>" class="postItem-thumb">
                            <div class="postItem-img">
                              <div class="thumb-sq">
                              <?php if ( has_post_thumbnail() ) { ?>
                                <img class="lozad" data-src="<?= the_post_thumbnail_url(); ?>" alt="<?= the_title(); ?>">
                              <?php } ?>
                              </div>
                            </div>
                          </a>
                          <div class="postItem-detail">
                            <div class="postItem-detail_date">
                              <?= the_time( 'M d, Y' ); ?>
                            </div>
                            <p class="extrabold"><?= the_title(); ?></p>
                            <a href="<?php echo get_the_permalink(); ?>" class="postItem-detail_link">
                              Read More
                            </a>
                          </div>

                        </div>
                      </div>
                    </div>
                    <?php
                  }
                }
                wp_reset_postdata(); ?>
              </div>
            </div>

            <div class="swiper-acc">
              <div class="swiper-pagination"></div>
            </div>
            <!-- Swiper End -->


          </div>
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
        swiper = new Swiper(".sliderPost-side", {
          direction: "horizontal",
          slidesPerView: "auto",
          spaceBetween: 27,
          slidesPerView: 2,
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
              slidesPerView: 2,
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

<?php get_footer(); ?>
