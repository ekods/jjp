<section id="hero" class="heroWrapper">
    <div class="heroInner">
        <?php if ( has_post_thumbnail() ) { echo '<img class="img-100" src="' . get_the_post_thumbnail_url() . '" alt="' . get_the_title() . '">'; }; ?>
        <div class="heroTitle">
            <div class="container">
                <h3><?php if( is_search() ){ echo "Search"; }else{ echo get_the_title(); } ?></h3>
            </div>
        </div>
    </div>
</section>
