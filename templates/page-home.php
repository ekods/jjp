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

    <section class="sectionProfessionals">
        <div class="container">
            <div class="sectionProfessionals-head">
                <h2 class="extrabold">Devoted professionals.</h2>
                <a href="<?= esc_url(home_url('professionals')) ?>">
                    <h5 class="fblue">Meet Our Team</h5>
                </a>
            </div>
            <div class="professionalsList --professionalsList-isotope">
                <?php
                //query arguments
                $args = array(
                    'post_type' => 'professionals',
                    'post_status' => 'publish',
                    'posts_per_page' => 4,
                    'orderby' => 'taxonomy, term_order', // Just enter 2 parameters here, seprated by comma
                    'order'=>'ASC'
                );
                $professionals = new WP_Query( $args );
                
                //loop through query
                if($professionals->have_posts()){
                    while($professionals->have_posts()){ 
                        $professionals->the_post();
                        $professionals_type = get_the_terms(get_the_ID(), 'professionals-category');
                ?>
                
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

                <?php 
                    }
                }
                wp_reset_postdata(); ?>
                </div>
        </div>
    </section>

    <section class="sectionNewroom">
        <div class="container">
            <div class="sectionNewroom-head">
                <h5>News & Updates</h5>
                <h2 class="extrabold">Newsroom</h2>
            </div>
            <div class="w-100">
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
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <div class="thumb-sq">
                                            <img class="lozad" data-src="<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }else{ echo get_template_directory_uri().'/images/thumb-default.jpg'; } ?>" alt="">
                                        </div>
                                    </a>
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
                <!-- Swiper End -->

            </div>

        </div>
    </section>
<?php get_footer(); ?>
