<?php

/*
 * Template Name: Page Testimonials
 */
get_header(); ?>

    <?php get_template_part( 'template-parts/section/_hero' ); ?>

    <div class="pageHead bgblue-soft">
      <div class="container">
        <div class="dflex row">
          <div class="col-50">
            <h2>An Award-Winning IP Firm with Industry-Leading testimonials.</h2>
          </div>
          <div class="col-50">
            <h4>JJP is routinely recognized as one of the best ranked IP firms in Indonesia. Our testimonials are also the recipients of various recognitions across a wide range of practice areas. Find out more below. </h4>

            <div class="filtersBox mt-40">
              <select class="filters-select">
                <option value="" disabled selected>Filter by Years</option>
                <option value="*">All Years</option>
                <?php
                $terms = get_terms( array(
                  'taxonomy'   => 'testimonials-year', // Swap in your custom taxonomy name
                  'hide_empty' => false, 
                ));
                
                foreach( $terms as $term ) {
                  echo '<option value=".year_'. $term->slug .'">'. $term->name .'</option>';
                }
                ?>
              </select>
            </div>
          
          </div>
        </div>
      </div>
    </div>

    <div class="testimonialsWrap bgblue-soft">
      <div class="container">
        <div class="testimonialsList --testimonialsList-isotope">
            
            <div class="testimonialsGroup year_2022" data-label="2022">
                <div class="testimonialsItem">
                    <div class="testimonialsItem-detail mb-30">
                        <div class="testimonialsItem-icon">
                            <div class="thumb-sq">
                              <img src="<?= get_template_directory_uri() ?>/images/dummy/f90d5ee0e676a44e398e92635ed76a08.png" alt="">
                            </div>
                        </div>
                        <div class="testimonialsItem-label">
                          <a href="https://www.legal500.com/c/indonesia/intellectual-property/" target="_blank">
                            <h5 class="fblue extrabold">Legal 500</h5>
                          </a>
                          <p>2022</p>
                        </div>
                    </div>
                    <div class="testimonialsItem-content mb-20">
                      <h4 class="extrabold">"Top Tier" ranking for seven consecutive years. JJP lauded for its "notably strong reputation in litigation" and representation of "a number of household brands in IP disputes" while IP Consultant Juanitasari Winaga has been recognized as a “trade mark prosecution specialist” </h4>
                    
                      <div class="content-body mt-20">
                        <ul>
                          <li>“Tier 1” ranking for the 7thconsecutive year</li>
                          <li>JJP described as having an “impressive range of capabilities including the prosecution and litigation of trademarks, in addition to a strong track record in the filing of patent applications.”</li>
                        </ul>
                      </div>
                    </div>
                    <a href="<?php echo get_the_permalink(); ?>" class="postItem-detail_link">
                      Read More
                    </a>
                </div>

                <div class="testimonialsItem">
                    <div class="testimonialsItem-detail mb-30">
                        <div class="testimonialsItem-icon">
                            <div class="thumb-sq">
                              <img src="<?= get_template_directory_uri() ?>/images/dummy/ddf299a76384ccd1ee637f016045b4d3.png" alt="">
                            </div>
                        </div>
                        <div class="testimonialsItem-label">
                          <a href="https://www.worldtrademarkreview.com/rankings/wtr-1000/profile/firm/januar-jahja-partners" target="_blank">
                            <h5 class="fblue extrabold">WTR 1000</h5>
                          </a>
                          <p>2022</p>
                        </div>
                    </div>
                    <div class="testimonialsItem-content mb-20">
                      <h4 class="extrabold">Consistently ranked “Gold” for Prosecution and Strategy and “Gold/Highly Recommended” for Enforcement and Litigation. “[W]idely considered one of the strongest IP sides in Indonesia,” with a “strong, powerful, and successful combination” of leaders.</h4>
                      <div class="content-body mt-20">
                        <ul>
                          <li>“Tier 1” ranking for the 7thconsecutive year</li>
                          <li>JJP described as having an “impressive range of capabilities including the prosecution and litigation of trademarks, in addition to a strong track record in the filing of patent applications.”</li>
                        </ul>
                      </div>
                    </div>

                    <a href="<?php echo get_the_permalink(); ?>" class="postItem-detail_link">
                      Read More
                    </a>
                </div>
            </div>

            <div class="testimonialsGroup year_2021" data-label="2021">
                <div class="testimonialsItem">
                    <div class="testimonialsItem-detail mb-30">
                        <div class="testimonialsItem-icon">
                            <div class="thumb-sq">
                              <img src="<?= get_template_directory_uri() ?>/images/dummy/f90d5ee0e676a44e398e92635ed76a08.png" alt="">
                            </div>
                        </div>
                        <div class="testimonialsItem-label">
                          <a href="https://www.legal500.com/c/indonesia/intellectual-property/" target="_blank">
                            <h5 class="fblue extrabold">Legal 500</h5>
                          </a>
                          <p>2022</p>
                        </div>
                    </div>
                    <div class="testimonialsItem-content mb-20">
                      <h4 class="extrabold">"Top Tier" ranking for seven consecutive years. JJP lauded for its "notably strong reputation in litigation" and representation of "a number of household brands in IP disputes" while IP Consultant Juanitasari Winaga has been recognized as a “trade mark prosecution specialist” </h4>
                    
                      <div class="content-body mt-20">
                        <ul>
                          <li>“Tier 1” ranking for the 7thconsecutive year</li>
                          <li>JJP described as having an “impressive range of capabilities including the prosecution and litigation of trademarks, in addition to a strong track record in the filing of patent applications.”</li>
                        </ul>
                      </div>
                    </div>
                    <a href="<?php echo get_the_permalink(); ?>" class="postItem-detail_link">
                      Read More
                    </a>
                </div>

                <div class="testimonialsItem">
                    <div class="testimonialsItem-detail mb-30">
                        <div class="testimonialsItem-icon">
                            <div class="thumb-sq">
                              <img src="<?= get_template_directory_uri() ?>/images/dummy/ddf299a76384ccd1ee637f016045b4d3.png" alt="">
                            </div>
                        </div>
                        <div class="testimonialsItem-label">
                          <a href="https://www.worldtrademarkreview.com/rankings/wtr-1000/profile/firm/januar-jahja-partners" target="_blank">
                            <h5 class="fblue extrabold">WTR 1000</h5>
                          </a>
                          <p>2022</p>
                        </div>
                    </div>
                    <div class="testimonialsItem-content mb-20">
                      <h4 class="extrabold">Consistently ranked “Gold” for Prosecution and Strategy and “Gold/Highly Recommended” for Enforcement and Litigation. “[W]idely considered one of the strongest IP sides in Indonesia,” with a “strong, powerful, and successful combination” of leaders.</h4>
                      <div class="content-body mt-20">
                        <ul>
                          <li>“Tier 1” ranking for the 7thconsecutive year</li>
                          <li>JJP described as having an “impressive range of capabilities including the prosecution and litigation of trademarks, in addition to a strong track record in the filing of patent applications.”</li>
                        </ul>
                      </div>
                    </div>

                    <a href="<?php echo get_the_permalink(); ?>" class="postItem-detail_link">
                      Read More
                    </a>
                </div>
            </div>

        </div>
      </div>
    </div>



<?php get_footer(); ?>
