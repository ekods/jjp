<section id="hero" class="heroWrapper">
    <div class="heroInner">

    <?php if(is_category()):  ?>
        <img class="img-100" src="<?= get_template_directory_uri() ?>/images/dummy/646f677afe96d40ae44bc11177260bd0.jpeg" alt="<?= single_cat_title('', false); ?>">
        <div class="heroTitle">
            <div class="container">
                <h3><?= single_cat_title('', false); ?></h3>
            </div>
        </div>
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
