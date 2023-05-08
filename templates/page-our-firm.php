<?php

/*
 * Template Name: Page Our Firm
 */
get_header(); ?>

    <?php if (!empty(get_post_meta( get_the_ID(), 'hero-img', true ))): ?>
    <section id="hero" class="heroWrapper">
        <div class="heroInner">
            <img class="img-100" src="<?php echo get_post_meta( get_the_ID(), 'hero-img', true ); ?>" alt="">
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

<?php get_footer(); ?>
