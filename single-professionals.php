<?php get_header(); ?>
<!--?php setPostViews(get_the_ID()); ?-->

  <div class="singleWrap">
    <div class="container">
      
      <?php custom_breadcrumbs(); ?>

      <?php if(have_posts()) : while(have_posts())  : the_post(); 
        $proffesionals_type = get_the_terms(get_the_ID(), 'proffesionals-category');
      ?>

      <div class="singleProffesionals">
        <div class="singleProffesionals-wrap">
          <div class="singleProffesionals-col1">

            <div class="professionalsItem-img">
              <?php if ( has_post_thumbnail() ) { ?>
                <img class="lozad" data-src="<?= the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
              <?php } ?>
            </div>

            <div class="singleProffesionals-title">
              <h2><?= the_title(); ?></h2>

              <ul class="professionalsItem-type mt-10">
                <?php
                  foreach($proffesionals_type as $type ){
                    echo "<li><h5>". $type->name ."</h5></li>";
                  }
                ?>
              </ul>
            </div>

            <div class="w-100">
              <?php if(!empty (get_post_meta( get_the_ID(), 'proffesionals-contact', true))){ ?>
                <div class="singleProffesionals-detail mtb-20">
                  <h5 class="extrabold">Contact</h5>
                  <h6>
                    <a href="tel:<?= preg_replace("/[^a-zA-Z0-9]+/", "", get_post_meta( get_the_ID(), 'proffesionals-contact', true)); ?>">
                      <?= get_post_meta( get_the_ID(), 'proffesionals-contact', true); ?>
                    </a>
                  </h6>
                </div>
              <?php } ?>

              <?php if(!empty (get_post_meta( get_the_ID(), 'proffesionals-languages', true))){ ?>
                <div class="singleProffesionals-detail mtb-20">
                  <h5 class="extrabold">Languages</h5>
                  <h6>
                    <?= get_post_meta( get_the_ID(), 'proffesionals-languages', true); ?>
                  </h6>
                </div>
              <?php } ?>

              <?php if(!empty (get_post_meta( get_the_ID(), 'proffesionals-email', true))){ ?>
                <div class="singleProffesionals-detail mtb-20">
                  <h5 class="extrabold">Email</h5>
                  <h6>
                    <a href="mailto:<?= get_post_meta( get_the_ID(), 'proffesionals-email', true); ?>">
                      <?= get_post_meta( get_the_ID(), 'proffesionals-email', true); ?>
                    </a>  
                  </h6>
                </div>
              <?php } ?>

              <?php 
              $proffesionals_profile = get_post_meta( get_the_ID(), 'proffesionals-profile', true);
              $proffesionals_linkedin = get_post_meta( get_the_ID(), 'proffesionals-linkedin', true);
              if(!empty ($proffesionals_profile || $proffesionals_linkedin)){ ?>
                <div class="singleProffesionals-detail mtb-20 --connect">
                  <h5 class="extrabold">Link</h5>
                  <div class="w-100 dflex mt-10">
                  <?php
                    if(!empty($proffesionals_linkedin)){ ?>
                    <a class="h6" href="<?= $proffesionals_linkedin; ?>" target="_blank">
                      <span class="icn icn-likedin"></span>
                      <span class="icn-label">LinkedIn</span>
                    </a>  
                  <?php } ?>

                  <?php
                    if(!empty($proffesionals_profile)){ ?>
                    <a class="h6" href="<?= $proffesionals_profile; ?>">
                      <span class="icn icn-pdf"></span>
                      <span class="icn-label">Download Profile</span>
                    </a> 
                  <?php } ?>
                  </div>
                </div>
              <?php } ?>


              <?php
                $proffesionals_education = get_post_meta( get_the_ID(), 'proffesionals_education', true);
                if(!empty($proffesionals_education)){ 
              ?>
                <div class="w-100 pt-20 display-mxtablet_2">
                  <h4 class="extrabold fblue-soft mb-10">Education</h4>

                  <?php foreach($proffesionals_education as $education){ ?>
                    <div class="w-100 mb-20">
                      <h6 class="extrabold fblue"><?= $education['title']; ?></h6>
                      <p class="fblue-soft"><?= $education['subtitle']; ?></p>
                      <p class="fblue-soft">(<?= $education['year']; ?>)</p>
                    </div>
                  <?php } ?>
                </div>
              <?php 
              } ?>
              
            </div>

          </div>
          <div class="singleProffesionals-col2">
            <div class="w-100 mb-20 pb-20">
              <h3 class="extrabold fblue-soft mb-10">Personal Info</h3>

              <div class="content-body alignjustify">
                <?= the_content(); ?>
              </div>
            </div>

            <?php if(!empty (get_post_meta( get_the_ID(), 'proffesionals-speaking_engagements', true))){ ?>
              <div class="w-100 mb-20 pb-20 --contentSpeaking_engagements">
                
                <div class="accordionItem">
                  <div class="accordionLabel">
                    <h3 class="extrabold fblue-soft mb-10">Speaking Engagements</h3>
                  </div>

                  <div class="accordionBody content-body">
                    <?= htmlspecialchars_decode(get_post_meta( get_the_ID(), 'proffesionals-speaking_engagements', true )); ?>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if(!empty (get_post_meta( get_the_ID(), 'proffesionals-publications', true))){ ?>
              <div class="w-100 mb-20 pb-20 --contentPublications">
                
                <div class="accordionItem">
                  <div class="accordionLabel">
                    <h3 class="extrabold fblue-soft mb-10">Publications</h3>
                  </div>

                  <div class="accordionBody content-body">
                    <?= htmlspecialchars_decode(get_post_meta( get_the_ID(), 'proffesionals-publications', true )); ?>
                  </div>
                </div>
              </div>
            <?php } ?>

          </div>
          <div class="singleProffesionals-col3">
            <?php
              $proffesionals_education = get_post_meta( get_the_ID(), 'proffesionals_education', true);
              if(!empty($proffesionals_education)){ 
            ?>
              <div class="w-100 mb-20 pb-20 none-mxtablet_2">
                <h4 class="extrabold fblue-soft mb-10">Education</h4>

                <?php foreach($proffesionals_education as $education){ ?>
                  <div class="w-100 mb-20">
                    <h6 class="extrabold fblue"><?= $education['title']; ?></h6>
                    <p class="fblue-soft"><?= $education['subtitle']; ?></p>
                    <p class="fblue-soft">(<?= $education['year']; ?>)</p>
                  </div>
                <?php } ?>
              </div>
            <?php 
            } ?>
          <?php endwhile; endif; wp_reset_postdata(); ?>

            <div class="row">
              <div class="col-md-12 col-sm-6 mb-20 pb-20">
                <h4 class="extrabold fblue-soft mb-10">Practice Areas</h4>

                <div class="sidebarPracticeAreas">
                  <ul>
                  <?php
                    $page_practice_areas = 88;
                    $child_pages = query_posts('post_per_page=-1&orderby=menu_order&order=asc&post_type=page&post_parent='.$page_practice_areas.'');
                    if ( $child_pages ) :
                        foreach ( $child_pages as $pageChild ) :
                          ?>
                            <li>
                              <a href="<?= get_permalink($pageChild->ID) ?>">
                                <h5><?= $pageChild->post_title; ?></h5>
                              </a>
                            </li>
                            <?php
                        endforeach;
                    endif;
                  ?>
                  </ul>
                </div>
              </div>

              <div class="col-md-12 col-sm-6 mb-20 pb-20">
                <h4 class="extrabold fblue-soft mb-10">Individual Recognitions</h4>

                <div class="sidebarArticle">
                  <ul>
                    <li>
                      <a href="#">
                        <h6>Top 250 Women in IP, Managing IP</h6>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <h6>Top 100 Lawyers in Indonesia, Asia Business Law Journal</h6>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <h6>Shortlisted, IP Practitioner of the Year- Indonesia 2023, Managing IP</h6>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <h6>Leading Individual/Ranked Lawyer, Legal 500; Chambers & Partners</h6>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <h6>Recommended, IAM Patent 1000; WTR 1000</h6>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <h6>IP Star-Trademarks, Managing IP</h6>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      

    </div>
  </div>
<?php get_footer(); ?>
