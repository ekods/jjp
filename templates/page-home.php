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
    <section id="heroSlider" class="heroSlider slideN">
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
				<?php
				sort($home_slide_fields);
				foreach ($home_slide_fields as $home_slide): ?>
				<div class="swiper-slide">
					<picture>
						<!-- <?php if(!empty($home_slide['images_mobile'])): ?>
						<source media="(max-width: 767px)" srcset="<?php echo $home_slide['images_mobile']; ?>">
						<source media="(min-width: 1440px)" srcset="<?php echo $home_slide['images']; ?>">
						<?php else: ?>
						<source srcset="<?php echo $home_slide['images']; ?>">
						<?php endif; ?> -->
						<img src="<?php echo $home_slide['images']; ?>" alt="">
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
		</div>
    </section>
    <?php endwhile;?>

    <section class="sectionSc1">
        <div class="container-fluid">
            <div class="row sectionSc1-wrap">
              <?php $frontpage_id = get_option( 'page_on_front' ); ?>
              <?php $the_query = new WP_Query ( "page_id= $frontpage_id" ); ?>
              <?php while ($the_query -> have_posts()) : $the_query -> the_post();
                  $pillar_fields = get_post_meta( get_the_ID(), 'pillar', true);
              ?>
                <div class="sectionSc1-intro col-md-6">
                    <div class="container">

                        <?php if(!empty(get_post_meta( get_the_ID(), 'pilar_h-title', true))){ echo '<h2 class="extrabold fprimary mb-20">'. get_post_meta( get_the_ID(), 'pilar_h-title', true) .'</h2>'; } ?>
                        <?php if(!empty(get_post_meta( get_the_ID(), 'pilar_h-subtitle', true))){ ?>
                        <div class="content-body alignjustify">
                            <?= get_post_meta( get_the_ID(), 'pilar_h-subtitle', true); ?>
                        </div>
                        <?php } ?>

                        <br>
                        <br>

                        <div class="sectionSc1-point">
                          <?php
                          sort($pillar_fields);
                          foreach ($pillar_fields as $pillar): ?>
                            <div class="sectionSc1-point-item">
                                <div class="sectionSc1-point-icon">
                                  <img src="<?php echo $pillar['pillar_images']; ?>" alt="<?php if(!empty($pillar['pillar_title'])){ echo "<h2>" . $pillar['pillar_title'] . "</h2>"; } ?>">
                                </div>
                                <?php if(!empty($pillar['pillar_title'])){ echo "<h2>" . $pillar['pillar_title'] . "</h2>"; } ?>
                                <?php if(!empty($pillar['pillar_subtitle'])){ echo "<p>" . $pillar['pillar_subtitle'] . "</p>"; } ?>
                            </div>
                          <?php endforeach; ?>

                        </div>

                    </div>
                </div>
                <?php endwhile;?>

                <div class="sectionSc1-testimonial col-md-6 half-right">
                    <div class="container">
                        <div class="sectionSc1-testimonial-head">
                            <a href="<?= esc_url(home_url('testimonials')) ?>">
                                <h5 class="fblue">View Our Testimonials</h5>
                            </a>
                        </div>

                        <div class="sectionSc1-testimonial-content">
                            <div class="w-100">
                                <div class="pageOurFirm-sub">
                                    <h5>What Our Clients Say</h5>
                                </div>
                            </div>

                            <div class="w-100 mt-20">
                              <?php get_template_part( 'template-parts/parts/_sliderTestimonials' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php $frontpage_id = get_option( 'page_on_front' ); ?>
    <?php $the_query = new WP_Query ( "page_id= $frontpage_id" ); ?>
    <?php while ($the_query -> have_posts()) : $the_query -> the_post();
        $member_fields = get_post_meta( get_the_ID(), 'member', true);
        $rangked_fields = get_post_meta( get_the_ID(), 'rangked', true);
    ?>
    <section class="sectionSc2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-20">
                  <h6 class="fprimary">MEMBER OF</h6>
                    <div class="sectionSc2-list">
                      <ul>
                          <?php
                          sort($member_fields);
                          foreach ($member_fields as $member): ?>
                            <li>
                                <?php if(!empty($member['link_member'])){ echo "<a href=". $member['link_member'] .">"; } ?>
                                    <img src="<?php echo $member['images_member']; ?>" alt="">
                                <?php if(!empty($member['link_member'])){ echo "</a>"; } ?>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 mb-20">
                    <h6 class="fprimary">RANKED IN</h6>

                    <div class="sectionSc2-list">
                    <ul>
                      <?php
                      sort($rangked_fields);
                      foreach ($rangked_fields as $rangked): ?>
                        <li>
                            <?php if(!empty($rangked['link_rangked'])){ echo "<a href=". $rangked['link_rangked'] .">"; } ?>
                                <img src="<?php echo $rangked['images_rangked']; ?>" alt="">
                            <?php if(!empty($rangked['link_rangked'])){ echo "</a>"; } ?>
                        </li>
                      <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
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
                    'order'=>'DESC'
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

    <section class="sectionPracticeareas">
        <div class="container">
            <div class="sectionPracticeareas-wrap">
                <div class="sectionPracticeareas-head">
                    <h2 class="extrabold">Explore our practice areas.</h2>
                </div>

                <div class="sectionPracticeareas-tabs">
                    <div class="tabsNav-wrap">
                        <ul class="tabsNav">
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
                            <li>
                                <div class="tabsNav-at" data-tab="#tab_<?= $pageChild->ID; ?>">
                                    <h6><?= $pageChild->post_title; ?></h6>
                                    <span><?= $pageChild->post_title; ?></span>
                                </div>
                            </li>
                                <?php
                                endforeach;
                            endif;
                        ?>
                        </ul>
                    </div>

                    <div class="tabsNav-select">
                        <div class="filtersBox">
                            <select class="filtersBox-page_practice_areas">
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
                                <option value="#tab_<?= $pageChild->ID; ?>"><?= $pageChild->post_title; ?></option>
                                <?php
                                    endforeach;
                                endif;
                            ?>
                            </select>
                        </div>
                    </div>


                    <div class="tabsContainer">
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
                        <div id="tab_<?= $pageChild->ID; ?>" class="tabsContent">
                            <div class="sectionPracticeareas-box">
                                <div class="sectionPracticeareas-content">
                                    <?php $practice_areas_title = get_post_meta( $pageChild->ID, 'practice_areas-title', true);
                                    if(!empty($practice_areas_title)) echo "<h2>" . $practice_areas_title . "</h2>"; ?>

                                    <div class="w-100 mb-30">
                                        <?php $practice_areas_content = get_post_meta( $pageChild->ID, 'practice_areas-content', true);
                                        if(!empty($practice_areas_content)) echo htmlspecialchars_decode($practice_areas_content); ?>
                                    </div>

                                    <a class="postArticle-item_link" href="<?php echo get_the_permalink($pageChild->ID); ?>">
                                        Read More
                                    </a>
                                </div>
                                <div class="sectionPracticeareas-thumb">
                                    <div class="sectionPracticeareas-img">
                                        <div class="thumb-sq">
                                            <?php if ( has_post_thumbnail($pageChild->ID) ) { ?>
                                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageChild->ID ), 'single-post-thumbnail' ); ?>
                                            <img class="lozad" data-src="<?= $image[0]; ?>" alt="<?= $pageChild->post_title; ?>">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            endforeach;
                        endif;
                    ?>
                    </div>
                </div>
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
                            $args = array( 'post_type'=> 'post', 'posts_per_page' => 7,   'orderby' => 'date', 'order'          => 'ASC', );
                            $the_query = new WP_Query( $args );
                            if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
                        ?>
                        <div class="swiper-slide">
                            <div class="postArticle-item">
                                <div class="postArticle-item_date">
                                    <span><?= the_time( 'd' ); ?></span>
                                    <?= the_time( 'M, Y' ); ?>
                                </div>
                                <div class="postArticle-item_thumb">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <div class="thumb-sq">
                                            <img class="lozad" data-src="<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }else{ echo get_template_directory_uri().'/images/thumb-default.jpg'; } ?>" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="postArticle-item_content">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <h5><?php the_title(); ?></h5>
                                    </a>

                                    <a class="postArticle-item_link" href="<?php echo get_the_permalink(); ?>">
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
                            <a href="<?= esc_url(home_url('news-updates')) ?>">Go to Newsroom</a>
                        </div>
                    </div>
                </div>
                <!-- Swiper End -->

            </div>

        </div>
    </section>
<?php get_footer(); ?>
