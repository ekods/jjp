<?php

/*
 * Template Name: Page Contact Us
 */
get_header(); ?>

    <?php if (!empty(get_post_meta( get_the_ID(), 'hero-img', true ))): ?>
    <section id="hero" class="heroWrapper">
        <div class="heroInner">
            <img class="img-100" src="<?php echo get_post_meta( get_the_ID(), 'hero-img', true ); ?>" alt="">
            <div class="heroTitle">
                <div class="container">
                    <h3><?= the_title(); ?></h3>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

<?php get_footer(); ?>