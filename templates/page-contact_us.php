<?php

/*
 * Template Name: Page Contact Us
 */
get_header(); ?>

    <?php if (!empty(get_post_meta( get_the_ID(), 'hero-img', true ))): ?>
    <section id="hero" class="heroWrapper">
        <div class="heroInner">
            <?php if ( has_post_thumbnail() ) { ?>
                <img class="lozad" data-src="<?= the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            <?php } ?>
            <div class="heroTitle">
                <div class="container">
                    <h3><?= the_title(); ?></h3>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <div class="pageContact">
        <div class="container">
            <div class="pageContact-wrap">
                <div class="pageContact-col">
                    <h2 class="extrabold mb-10">Send Us a Message.</h2>
                    <h6 class="fblue-soft">Please fill in the form and a member of our team will contact you shortly.</h6>

                    <div class="pageContact-form">
                        <?= do_shortcode('[contact-form-7 id="5" title="Contact us"]'); ?>

                        <div class="w-100 mt-40">
                    
                                                                        <?php $the_query = new WP_Query ( "page_id= 12" ); ?>
                                      <?php while ($the_query -> have_posts()) : $the_query -> the_post();?>
                                    <a href="<?php $company_profile = get_post_meta( get_the_ID(), 'input-company_profile', true);
                                    if(!empty($company_profile)) echo $company_profile; ?>" target="_blank" class="downloadCompro"><i class="fa-solid fa-download"></i> Download Company Profile</a>
                                    <?php endwhile;?>
                        </div>
                    </div>
                </div>
                <div class="pageContact-col">
                    <div class="iframeWrapper --map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15865.60216770329!2d106.81575!3d-6.210786!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6a9bb97a195%3A0xd0f7f25026797be1!2sJANUAR%20JAHJA%20%26%20PARTNERS!5e0!3m2!1sid!2sid!4v1684262821965!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                    <div class="pageContact-detail">
                        <div class="row">
                            <div class="col-md-6">
                            <?php
                                $themes_address = myprefix_get_theme_option( 'themes_address' );
                                if (!empty( $themes_address )) {
                                    echo '<p>'. $themes_address .'</p>';
                                }
                            ?>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                <?php
                                    $themes_telephone = myprefix_get_theme_option( 'themes_telephone' );
                                    if (!empty( $themes_telephone )) {
                                    echo '<li><a href="'. $themes_telephone .'" target="_blank"><i class="fa-solid fa-phone-volume"></i> '. $themes_telephone .'</a></li>';
                                    }
                                ?>
                                <?php
                                    $themes_email = myprefix_get_theme_option( 'themes_email' );
                                    if (!empty( $themes_email )) {
                                    echo '<li><a href="'. $themes_email .'" target="_blank"><i class="fa-solid fa-envelope"></i> '. $themes_email .'</a></li>';
                                    }
                                ?>
                                <?php
                                    $themes_linkedin = myprefix_get_theme_option( 'themes_linkedin' );
                                    if (!empty( $themes_linkedin )) {
                                    echo '<li><a href="'. $themes_linkedin .'" target="_blank"><i class="fa-brands fa-linkedin"></i> Januar Jahja and Partners</a></li>';
                                    }
                                ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer(); ?>








