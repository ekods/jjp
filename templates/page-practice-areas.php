<?php

/*
 * Template Name: Page Practice Areas
 */
get_header(); ?>

    <?php get_template_part( 'template-parts/section/_hero' ); ?>

    <div class="pageHead">
      <div class="container">
        <div class="dflex row">
          <div class="col-50">
            <h2>Covering All Aspects of Indonesian Intellectual Property .</h2>
          </div>
          <div class="col-50">
            <h4>From trademark and patent prosecution to complex IP litigation and everything in between, JJP has you covered across our 8 practice areas. Find out more below.</h4>
          </div>
        </div>
      </div>
    </div>

    <div class="practiceareasWrap">
      <div class="container">
        <div class="practiceareasList">
        <?php
            $page_practice_areas = 88;
            $args = array(
              'post_per_page' => -1,
              'orderby'       => 'menu_order',
              'order'         => 'asc',
              'post_type'     => 'page',
              'post_parent'   => $page_practice_areas,
            );

            $child_pages = query_posts($args);
            if ( $child_pages ) :
                foreach ( $child_pages as $pageChild ) :
                  ?>
                    <div class="practiceareasItem">
                      <div class="practiceareasItem-inner">
                        <a href="<?php echo get_permalink($pageChild->ID) ?>">
                          <div class="practiceareasItem-img">
                            <?php if ( has_post_thumbnail($pageChild->ID) ) { ?>
                              <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageChild->ID ), 'single-post-thumbnail' ); ?>
                              <img class="lozad" data-src="<?= $image[0]; ?>" alt="<?= $pageChild->post_title; ?>">
                            <?php } ?>
                          </div>
                          <div class="practiceareasItem-detail">
                            <h3><?= $pageChild->post_title; ?></h3>
                          </div>
                        </a>
                      </div>
                    </div>
                    <?php
                endforeach;
            endif;
          ?>
        </div>
      </div>
    </div>



<?php get_footer(); ?>
