<?php get_header(); 

  global $post;
?>

  <?php get_template_part( 'template-parts/section/_hero' ); ?>

  <?php if($post->post_parent == 88): ?>
    <?php get_template_part( 'template-parts/page/_practice-areas' ); ?>
  <?php else: ?>
    <?php if(have_posts()) : while(have_posts())  : the_post(); ?>
      <?= the_content(); ?>
    <?php endwhile; endif; wp_reset_postdata(); ?>
  <?php endif; ?>

<?php get_footer(); ?>
