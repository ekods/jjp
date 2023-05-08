<?php
  get_header();
  $s=get_search_query();
  $args = array('s' =>$s );
  $the_query = new WP_Query( $args );
?>

  <?php get_template_part( 'template-parts/section/_hero' ); ?>


  <div>
    <h2>Search: <?php echo $s; ?></h2>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php endwhile; else: ?>
    <p><?php _e('Sorry, no post available.'); ?></p>
    <?php endif; ?>
  </div>

<?php get_footer(); ?>
