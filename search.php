<?php
  get_header();
  $s=get_search_query();
  $args = array('s' =>$s );
  $the_query = new WP_Query( $args );
?>

  <?php get_template_part( 'template-parts/section/_hero' ); ?>


  <div class="pageHead bgwhite">
    <div class="container">
      <div class="dflex row">
        <div class="col-50">
          <h2>Search: <?php echo $s; ?></h2>
        </div>
      </div>
    </div>
  </div>
  
    <div class="w-100 bgwhite">
        <div class="container">
          <div class="postArticle-wrap">
            <div class="postArticle-list">
                <?php if(have_posts()) : while(have_posts())  : the_post(); ?>
    
                <div class="postArticle-item">
                    <div class="postArticle-item_date">
                        <span><?= the_time( 'd' ); ?></span>
                        <?= the_time( 'M, Y' ); ?>
                    </div>
                    <div class="postArticle-item_thumb">
                        <a href="<?php echo get_the_permalink(); ?>">
                            <div class="thumb-sq">
                                <img class="lozad" data-src="<?php if ( has_post_thumbnail() ) { the_post_thumbnail_url(); }else{ echo get_template_directory_uri().'/images/thumb-default.png'; } ?>" alt="">
                            </div>
                        </a>
                    </div>
                    <div class="postArticle-item_content">
                        <a href="<?php echo get_the_permalink(); ?>">
                            <h5><?php the_title(); ?></h5>
                        </a>
    
                        <a class="postArticle-item_link" href="<?php echo get_the_permalink(); ?>">
                            Read More
                        </a>
                    </div>
                </div>
                <?php endwhile; else: ?>
                <p><?php _e('Sorry, no post available.'); ?></p>
                <?php endif; ?>
            </div>
          </div>
          
    
          <div class="clearfix"></div>
          <!--pagination-->
          <?php pagination_numeric_posts_nav(); ?>
          <!--pagination end-->
    
        </div>

    </div>
  

<?php get_footer(); ?>
