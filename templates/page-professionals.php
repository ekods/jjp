<?php

/*
 * Template Name: Page Professionals
 */
get_header(); ?>

    <?php get_template_part( 'template-parts/section/_hero' ); ?>

    <?php
        $side_left = get_post_meta( get_the_ID(), 'head_page-side-left', true);
        $side_right = get_post_meta( get_the_ID(), 'head_page-side-right', true);
    ?>
    <div class="pageHead">
      <div class="container">
        <div class="dflex row">
          <div class="col-50">
            <?php if(!empty($side_left)): ?>
            <h2><?= $side_left; ?></h2>
            <?php endif; ?>
          </div>
          <div class="col-50 alignjustify">
            <?php if(!empty($side_right)): ?>
            <h4><?= $side_right; ?></h4>
            <?php endif; ?>

            <div class="filtersBox mt-40">
              <select class="filters-select">
                <option value="" disabled selected>Filter by Practice Areas</option>
                <option value="*">All Professionals Type</option>
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

                          echo '<option value=".--pa-'. $pageChild->ID .'">'. $pageChild->post_title .'</option>';

                        endforeach;
                    endif;
                ?>
              </select>
            </div>

          </div>
        </div>
      </div>
    </div>

    <div class="professionalsWrap">
      <div class="container">
        <div class="professionalsList --professionalsList-isotope">
        <?php
        //query arguments
        $args = array(
            'post_type' => 'professionals',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'term_order',
            'order'=>'DESC'
        );
        $professionals = new WP_Query( $args );

        //loop through query
        if($professionals->have_posts()){
            while($professionals->have_posts()){
                $professionals->the_post();
                $professionals_practice_areas = get_post_meta( get_the_ID(), 'professionals-practice_areas', true);
                $professionals_practice_areas = is_array($professionals_practice_areas) ? $professionals_practice_areas : array($professionals_practice_areas);

                $professionals_type = get_the_terms(get_the_ID(), 'professionals-category');
        ?>



          <div class="professionalsItem <?php foreach ($professionals_practice_areas as $practice_area_id) { echo '--pa-' . $practice_area_id . ' '; } ?>">
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
    </div>



<?php get_footer(); ?>
