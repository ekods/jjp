<?php

/*
 * Template Name: Page Proffesionals
 */
get_header(); ?>

    <?php get_template_part( 'template-parts/section/_hero' ); ?>

    <div class="pageHead">
      <div class="container">
        <div class="dflex row">
          <div class="col-50">
            <h2>Home to Industry-Setting Leaders and IP Professionals.</h2>
          </div>
          <div class="col-50">
            <h4>JJP’s experienced IP professionals can help navigate the complex world of Indonesian intellectual property law. Find an expert below.</h4>

            <div class="filtersBox mt-40">
              <select class="filters-select">
                <option value="" disabled selected>Filter by Professionals Type</option>
                <option value="*">Show All</option>
                <?php
                $terms = get_terms( array(
                  'taxonomy'   => 'proffesionals-category', // Swap in your custom taxonomy name
                  'hide_empty' => true, 
                ));
                
                foreach( $terms as $term ) {
                  echo '<option value=".'. $term->slug .'">'. $term->name .'</option>';
                }
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
            'post_type' => 'proffesionals',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'taxonomy, term_order', // Just enter 2 parameters here, seprated by comma
            'order'=>'ASC'
        );
        $proffesionals = new WP_Query( $args );
          
        //loop through query
        if($proffesionals->have_posts()){
            while($proffesionals->have_posts()){ 
                $proffesionals->the_post();
                $proffesionals_type = get_the_terms(get_the_ID(), 'proffesionals-category');
        ?>
          
          <div class="professionalsItem <?php foreach($proffesionals_type as $type ){ echo $type->slug; } ?>">
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
                    foreach($proffesionals_type as $type ){
                      echo "<li><h6>". $type->name ."</h6></li>";
                    }
                  ?>
                </ul>
                <ul class="professionalsItem-connect">
                  <?php $proffesionals_linkedin = get_post_meta( get_the_ID(), 'proffesionals-linkedin', true);
                  if(!empty($proffesionals_linkedin)) echo '<li><a href="'. $proffesionals_linkedin .'" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>'; ?>
                  
                  <?php $proffesionals_email = get_post_meta( get_the_ID(), 'proffesionals-email', true);
                  if(!empty($proffesionals_email)) echo '<li><a href="'. $proffesionals_email .'" target="_blank"><i class="fa-solid fa-envelope"></i></a></li>'; ?>
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
