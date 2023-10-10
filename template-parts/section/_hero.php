<section id="hero" class="heroWrapper">
    <div class="heroInner">
    <?php if(is_category()):  ?>
		<?php
		$hero_banner_news_updates = myprefix_get_theme_option( 'hero_banner_news_updates' );
		if (!empty( $hero_banner_news_updates )) { ?>
		<img class="img-100" src="<?php echo $hero_banner_news_updates; ?>" alt="<?= single_cat_title('', false); ?>">
		<?php	}	?>
		
        <div class="heroTitle">
            <div class="container">
                <h3><?= single_cat_title('', false); ?></h3>
            </div>
        </div>
    <?php elseif(is_search()):  ?>    
    	<img src="<?php echo get_template_directory_uri(); ?>/images/DSC02995 2_11zon.jpg" alt="">
    <?php else: ?>
        <?php if ( has_post_thumbnail() ) { echo '<img class="img-100" src="' . get_the_post_thumbnail_url() . '" alt="' . get_the_title() . '">'; }; ?>
        <div class="heroTitle">
            <div class="container">
                <h3><?php if( is_search() ){ echo "Search"; }else{ echo get_the_title(); } ?></h3>
            </div>
        </div>
    <?php endif; ?>  
    </div>
</section>
