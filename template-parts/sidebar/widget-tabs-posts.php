<div class="content-tabs-wrap tabs-act tabs-widget fl-wrap">
    <div class="content-tabs fl-wrap">
        <ul class="tabs-menu fl-wrap no-list-style">
            <li class="current"><a href="#tab-popular"> Popular News </a></li>
        </ul>
    </div>
    <!--tabs -->
    <div class="tabs-container">
        <!--tab -->
        <div class="tab">
            <div id="tab-popular" class="tab-content first-tab">
                <div class="post-widget-container fl-wrap">
                  <?php
                  $i = 1;
                  $args = array(
                      'post_type' => 'post',
                      'posts_per_page' => '10',
                      'meta_key' => 'post_views_count',
                      'orderby' => 'meta_value_num',
                      'order' => 'DESC',
                      'post_status' => 'publish',
                      'date_query' => array(
                          array(
                              'after' => '24 hours ago'
                          )
                      )
                  );
                  $arr_posts = new WP_Query( $args );
                  if ( $arr_posts->have_posts() ) :
                      while ( $arr_posts->have_posts() ) :
                      $arr_posts->the_post(); ?>
                      <!-- post-widget-item -->
                      <div class="post-widget-item fl-wrap">
                          <div class="post-widget-number"><?php echo $i; ?></div>
                          <a href="<?= get_the_permalink(); ?>" class="post-widget-item-media">
                              <img class="lozad" data-src="<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }else{ echo get_template_directory_uri().'/images/thumb-default.jpg'; } ?>"  alt="<?= the_title(); ?>">
                          </a>
                          <div class="post-widget-item-content">
                              <h4><a href="<?= get_the_permalink(); ?>"><?= the_title(); ?></a></h4>
                          </div>
                      </div>
                      <!-- post-widget-item end -->
                      <?php
                      $i++;
                    endwhile;
                  endif;
                  ?>
                </div>
            </div>
        </div>
        <!--tab  end-->
    </div>
    <!--tabs end-->
</div>
