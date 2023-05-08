<div class="boxNav">
  <div class="boxNav-col">
    <div class="brandLogo">
      <a href="<?php echo esc_url(home_url()) ?>">
        <?php
          $themes_logo = myprefix_get_theme_option( 'themes_logo_secondary' );
          if (!empty( $themes_logo )) { ?>
            <img src="<?php echo $themes_logo; ?>" alt="" class="img-100">
        <?php	}	?>
      </a>
    </div>
  </div>

  <div class="boxNav-col">
    <div class="navOffcanvas-menu">
      <?php
        wp_nav_menu( array(
            'menu' => 'Main Menu'
        ) );
      ?>
    </div>
  </div>

  <div class="boxNav-col">
    <div class="navOffcanvas-menu">
      <ul>
        <li>
          <a href="#">Practice Areas</a>

          <?php
            $terms = get_terms( "practice_areas-category", array(
              'hide_empty' => false,
            ) );
          ?>
          <ul class="submenu">
            <?php
            foreach($terms as $term ){; ?>
            <li>
              <a href="<?= get_term_link($term->term_id); ?>"><?= $term->name; ?></a>
            </li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </div>
  </div>

  <div class="boxNav-col">
    <div class="boxNav-content">

    <?php
      $themes_address = myprefix_get_theme_option( 'themes_address' );
      if (!empty( $themes_address )) {
        echo '<p>'. $themes_address .'</p>';
      }
    ?>

    <ul>
      <?php
        $themes_telephone = myprefix_get_theme_option( 'themes_telephone' );
        if (!empty( $themes_telephone )) {
          echo '<li><a href="'. $themes_telephone .'" target="_blank"><i class="fa-solid fa-phone-volume"></i> '. $themes_telephone .'</a></li>';
        }
      ?>
      <?php
        $themes_email = myprefix_get_theme_option( 'themes_email' );
        if (!empty( $themes_email )) {
          echo '<li><a href="'. $themes_email .'" target="_blank"><i class="fa-solid fa-envelope"></i> '. $themes_email .'</a></li>';
        }
      ?>
      <?php
        $themes_linkedin = myprefix_get_theme_option( 'themes_linkedin' );
        if (!empty( $themes_linkedin )) {
          echo '<li><a href="'. $themes_linkedin .'" target="_blank"><i class="fa-brands fa-linkedin"></i> Januar Jahja and Partners</a></li>';
        }
      ?>
      </ul>

    </div>
  </div>

</div>