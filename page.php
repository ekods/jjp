<?php get_header(); ?>

  <?php get_template_part( 'template-parts/section/_hero' ); ?>


  <?php if(have_posts()) : while(have_posts())  : the_post(); ?>
    <?= the_content(); ?>
  <?php endwhile; endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>
