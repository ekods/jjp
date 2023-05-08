<?php

/*
 * Template Name: Page Home
 */
get_header(); ?>

    <?php $frontpage_id = get_option( 'page_on_front' ); ?>
    <?php $the_query = new WP_Query ( "page_id= $frontpage_id" ); ?>
    <?php while ($the_query -> have_posts()) : $the_query -> the_post();
        $home_slide_fields = get_post_meta( get_the_ID(), 'home_slide', true);
    ?>
    <section id="heroSlider" class="heroSlider">
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
            <?php
            sort($home_slide_fields);
            foreach ($home_slide_fields as $home_slide): ?>
            <div class="swiper-slide">
                <picture>
                    <?php if(!empty($home_slide['images_mobile'])): ?>
                    <source media="(max-width: 767px)" srcset="<?php echo $home_slide['images_mobile']; ?>">
                    <source media="(min-width: 1440px)" srcset="<?php echo $home_slide['images']; ?>">
                    <?php else: ?>
                    <source srcset="<?php echo $home_slide['images']; ?>">
                    <?php endif; ?>
                    <img src="<?php echo $home_slide['images']; ?>" class="lozad" alt="">
                </picture>

                <div class="heroSlider-content">
                    <div class="container-fluid">
                        <?php if(!empty($home_slide['title'])){ echo "<h3>" . $home_slide['title'] . "</h3>"; } ?>
                        <div class="heroSlider-in">
                            <?php if(!empty($home_slide['subtitle'])){ echo "<p>" . $home_slide['subtitle'] . "</p>"; } ?>
                            <?php if(!empty($home_slide['link'])){ echo "<a href='" . $home_slide['link'] . "' class='btn'>VIEW MORE</a>"; } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="swiper-acc">
                <div class="swiper-nav">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <?php endwhile;?>



    <section class="sectionNewroom">
        <div class="container">
            <div class="sectionNewroom-head">
                <h5>News & Updates</h5>
                <h2 class="extrabold">Newsroom</h2>
            </div>
            <div>
                <!-- Swiper -->
                <div class="swiper sliderNewsroom">
                    <div class="swiper-wrapper">
                        <?php
                            global $post;
                            $args = array( 'post_type'=> 'post', 'posts_per_page' => 10 );
                            $the_query = new WP_Query( $args );
                            if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                        ?>
                        <div class="swiper-slide">
                            <div class="sliderNewsroom-item">
                                <div class="sliderNewsroom-item_date">
                                    <span><?= the_time( 'd' ); ?></span>
                                    <?= the_time( 'M, Y' ); ?>
                                </div>
                                <div class="sliderNewsroom-item_thumb">
                                    <div class="thumb-sq">
                                        <img src="<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }else{ echo get_template_directory_uri().'/images/thumb-default.jpg'; } ?>" alt="">
                                    </div>
                                </div>
                                <div class="sliderNewsroom-item_content">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <h5><?php the_title(); ?></h5>
                                    </a>

                                    <a class="sliderNewsroom-item_link" href="<?php echo get_the_permalink(); ?>">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php  endwhile; endif; ?>
                    </div>

                    <div class="swiper-acc">
                        <div class="swiper-nav">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-more">
                            <a href="">Go to Newsroom</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php get_footer(); ?>
