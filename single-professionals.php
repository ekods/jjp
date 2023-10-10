<?php get_header(); ?>
<!--?php setPostViews(get_the_ID()); ?-->

  <div class="singleWrap">
    <div class="container">

      <?php custom_breadcrumbs(); ?>

      <?php if(have_posts()) : while(have_posts())  : the_post();
        $professionals_type = get_the_terms(get_the_ID(), 'professionals-category');
        $professionals_practice_areas = get_the_terms(get_the_ID(), 'professionals-practice_areas');
      ?>

      <div class="singleProfessionals">
        <div class="singleProfessionals-wrap">
          <div class="singleProfessionals-col1">

            <div class="professionalsItem-img">
              <?php if ( has_post_thumbnail() ) { ?>
                <img class="lozad" data-src="<?= the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
              <?php } ?>
            </div>

            <div class="singleProfessionals-title">
              <h2><?= the_title(); ?></h2>

              <ul class="professionalsItem-type mt-10">
                <?php
                  foreach($professionals_type as $type ){
                    echo "<li><h5>". $type->name ."</h5></li>";
                  }
                ?>
              </ul>
            </div>

            <div class="w-100">
              <?php if(!empty (get_post_meta( get_the_ID(), 'professionals-contact', true))){ ?>
                <div class="singleProfessionals-detail mtb-20">
                  <h5 class="extrabold">Contact</h5>
                  <h6>
                    <a href="tel:<?= preg_replace("/[^a-zA-Z0-9]+/", "", get_post_meta( get_the_ID(), 'professionals-contact', true)); ?>">
                      <?= get_post_meta( get_the_ID(), 'professionals-contact', true); ?>
                    </a>
                  </h6>
                </div>
              <?php } ?>

              <?php if(!empty (get_post_meta( get_the_ID(), 'professionals-languages', true))){ ?>
                <div class="singleProfessionals-detail mtb-20">
                  <h5 class="extrabold">Languages</h5>
                  <h6>
                    <?= get_post_meta( get_the_ID(), 'professionals-languages', true); ?>
                  </h6>
                </div>
              <?php } ?>

              <?php if(!empty (get_post_meta( get_the_ID(), 'professionals-email', true))){ ?>
                <div class="singleProfessionals-detail mtb-20">
                  <h5 class="extrabold">Email</h5>
                  <h6>
                    <a href="mailto:<?= get_post_meta( get_the_ID(), 'professionals-email', true); ?>">
                      <?= get_post_meta( get_the_ID(), 'professionals-email', true); ?>
                    </a>
                  </h6>
                </div>
              <?php } ?>

              <?php
              $professionals_profile = get_post_meta( get_the_ID(), 'professionals-profile', true);
              $professionals_linkedin = get_post_meta( get_the_ID(), 'professionals-linkedin', true);
              if(!empty ($professionals_profile || $professionals_linkedin)){ ?>
                <div class="singleProfessionals-detail mtb-20 --connect">
                  <h5 class="extrabold">Link</h5>
                  <div class="w-100 dflex mt-10 gap-20">
                  <?php
                    if(!empty($professionals_linkedin)){ ?>
                    <a class="h6" href="<?= $professionals_linkedin; ?>" target="_blank">
                      <span class="icn icn-likedin"></span>
                      <span class="icn-label">LinkedIn</span>
                    </a>
                  <?php } ?>

                  <?php
                    if(!empty($professionals_profile)){ ?>
                    <!--<a class="h6" href="<?= $professionals_profile; ?>">-->
                    <!--  <span class="icn icn-pdf"></span>-->
                    <!--  <span class="icn-label">Download Profile</span>-->
                    <!--</a>-->
                  <?php } ?>
                  </div>
                </div>
              <?php } ?>


              <?php
                $professionals_education = get_post_meta( get_the_ID(), 'professionals_education', true);
                if(!empty($professionals_education)){
              ?>
                <div class="w-100 pt-20 display-mxtablet_2">
                  <h4 class="extrabold fblue-soft mb-10">Education</h4>

                  <?php foreach($professionals_education as $education){ ?>
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
          <div class="singleProfessionals-col2">
            <div class="w-100 mb-20 pb-20">
              <h3 class="extrabold fblue-soft mb-10">Personal Info</h3>

              <div class="content-body alignjustify">
                <?= the_content(); ?>
              </div>
            </div>

            <?php if(!empty (get_post_meta( get_the_ID(), 'professionals-speaking_engagements', true))){ ?>
              <div class="w-100 mb-20 pb-20 --contentSpeaking_engagements">

                <div class="accordionItem accordion-open">
                  <div class="accordionLabel">
                    <h3 class="extrabold fblue-soft mb-10">Speaking Engagements</h3>
                  </div>

                  <div class="accordionBody content-body accordionBody-open content-body">
                    <?= htmlspecialchars_decode(get_post_meta( get_the_ID(), 'professionals-speaking_engagements', true )); ?>
                  </div>
                </div>
              </div>
            <?php } ?>

            <?php if(!empty (get_post_meta( get_the_ID(), 'professionals-publications', true))){ ?>
              <div class="w-100 mb-20 pb-20 --contentPublications">

                <div class="accordionItem accordion-open">
                  <div class="accordionLabel">
                    <h3 class="extrabold fblue-soft mb-10">Publications</h3>
                  </div>

                  <div class="accordionBody content-body accordionBody-open content-body">
                    <?= htmlspecialchars_decode(get_post_meta( get_the_ID(), 'professionals-publications', true )); ?>
                  </div>
                </div>
              </div>
            <?php } ?>

          </div>
          <div class="singleProfessionals-col3">
            <?php
              $professionals_education = get_post_meta( get_the_ID(), 'professionals_education', true);
              if(!empty($professionals_education)){
            ?>
              <div class="w-100 mb-20 pb-20 none-mxtablet_2">
                <h4 class="extrabold fblue-soft mb-10">Education</h4>

                <?php foreach($professionals_education as $education){ ?>
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
                    $practice_areas = get_post_meta( get_the_ID(), 'professionals-practice_areas', true);
                    if ( $practice_areas ) :
                        foreach ( $practice_areas as $practice_area_id ) :
                          ?>
                            <li>
                              <a href="<?= get_permalink($practice_area_id) ?>">
                                <h5><?= get_the_title($practice_area_id); ?></h5>
                              </a>
                            </li>
                            <?php
                        endforeach;
                    endif;
                  ?>
                  </ul>
                </div>
              </div>

              <?php
                $individual_recognitions = get_post_meta( get_the_ID(), 'professionals_individual_recognitions', true);
                if ( $individual_recognitions ) : ?>
                <div class="sidebarArticle">
                  <div class="col-md-12 col-sm-6 mb-20 pb-20">
                    <h4 class="extrabold fblue-soft mb-10">Individual Recognitions</h4>

                        <div class="sidebarArticle">
                          <ul style="list-style: disc;padding-left: 20px;">
                          <?php foreach ( $individual_recognitions as $recognitions ) :
                            ?>
                              <li>
                                <h6><?= $recognitions['media']; ?></h6>
                                <h6><?= $recognitions['title']; ?></h6>
                              </li>
                              <?php
                          endforeach; ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <?php
                endif;
              ?>
            </div>


            <div class="share-holder ver-share fl-wrap">
                <div class="shareTitle">Share</div>
                <div class="shareContainer isShare"></div>
            </div>


          </div>
        </div>
      </div>


    </div>
  </div>
<?php get_footer(); ?>
