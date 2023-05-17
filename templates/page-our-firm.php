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
                    <h5>Who We Are</h5>
                </div>
            </div>
            <div class="pageOurFirm-wrap">
                <div class="pageOurFirm-col">
                    <div class="w-100 mb-40 mt-10">
                        <h2 class="extrabold">A Leading Indonesian Intellectual Property Law Firm, since 1986.</h2>

                        <div class="w-100 mt-40">
                            <div class="row">
                                <div class="col-md-6 mb-10">
                                    <a href="#" target="_blank" class="downloadCompro"><i class="fa-solid fa-download"></i> Download Company Profile</a>
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
                    <h5>Awards and Recognitions</h5>
                </div>
            </div>
            <div class="pageOurFirm-wrap">
                <div class="pageOurFirm-col">
                    <div class="w-100 mb-40 mt-10">
                        <h2 class="extrabold">We Are One of The Best Reviewed IP Firms in Indonesia.</h2>

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

                            <div class="swiper-slide">
                                <a href="https://www.legal500.com/c/indonesia/intellectual-property/" target="_blank">
                                    <div class="testimonialsItem">
                                        <div class="testimonialsItem-content mb-30">
                                            <h4 class="extrabold">"Top Tier" ranking for seven consecutive years. JJP lauded for its "notably strong reputation in litigation" and representation of "a number of household brands in IP disputes" while IP Consultant Juanitasari Winaga has been recognized as a “trade mark prosecution specialist” </h4>
                                        </div>
                                        <div class="testimonialsItem-detail">
                                            <div class="testimonialsItem-icon">
                                                <div class="thumb-sq">
                                                    <img src="<?= get_template_directory_uri() ?>/images/dummy/f90d5ee0e676a44e398e92635ed76a08.png" alt="">
                                                </div>
                                            </div>
                                            <div class="testimonialsItem-label">
                                                <h5 class="fblue extrabold">Legal 500</h5>
                                                <p>2019</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="https://www.worldtrademarkreview.com/rankings/wtr-1000/profile/firm/januar-jahja-partners" target="_blank">
                                    <div class="testimonialsItem">
                                        <div class="testimonialsItem-content mb-30">
                                            <h4 class="extrabold">Consistently ranked “Gold” for Prosecution and Strategy and “Gold/Highly Recommended” for Enforcement and Litigation. “[W]idely considered one of the strongest IP sides in Indonesia,” with a “strong, powerful, and successful combination” of leaders.</h4>
                                        </div>
                                        <div class="testimonialsItem-detail">
                                        <div class="testimonialsItem-icon">
                                                <div class="thumb-sq">
                                                    <img src="<?= get_template_directory_uri() ?>/images/dummy/ddf299a76384ccd1ee637f016045b4d3.png" alt="">
                                                </div>
                                            </div>
                                            <div class="testimonialsItem-label">
                                                <h5 class="fblue extrabold">WTR 1000</h5>
                                                <p>2021</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

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
