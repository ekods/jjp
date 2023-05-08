<?php 
  get_header();

  $category = get_queried_object();
  $category_id = $category->term_id;

  $categoryx = get_the_category(); 
  $category_parent_id = $categoryx[0]->category_parent;
?>



<?php get_footer(); ?>
