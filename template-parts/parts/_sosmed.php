<?php
  $themes_tw = myprefix_get_theme_option( 'themes_twitter' );
  if (!empty( $themes_tw )) {
    echo '<li><a href="'. $themes_tw .'" target="_blank"><i class="fab fa-twitter"></i></a></li>';
  }
?>
<?php
  $themes_fb = myprefix_get_theme_option( 'themes_facebook' );
  if (!empty( $themes_fb )) {
    echo '<li><a href="'. $themes_fb .'" target="_blank"><i class="fab fa-facebook-f"></i></a></li>';
  }
?>
<?php
  $themes_ig = myprefix_get_theme_option( 'themes_instagram' );
  if (!empty( $themes_ig )) {
    echo '<li><a href="'. $themes_ig .'" target="_blank"><i class="fab fa-instagram"></i></a></li>';
  }
?>
<?php
  $themes_yt = myprefix_get_theme_option( 'themes_youtube' );
  if (!empty( $themes_yt )) {
    echo '<li><a href="'. $themes_yt .'" target="_blank"><i class="fab fa-youtube"></i></a></li>';
  }
?>
<?php
  $themes_linkedin = myprefix_get_theme_option( 'themes_linkedin' );
  if (!empty( $themes_linkedin )) {
    echo '<li><a href="'. $themes_linkedin .'" target="_blank"><i class="fab fa-linkedin"></i></a></li>';
  }
?>
<?php
  $themes_spotify = myprefix_get_theme_option( 'themes_spotify' );
  if (!empty( $themes_spotify )) {
    echo '<li><a href="'. $themes_spotify .'" target="_blank"><i class="fab fa-spotify"></i></a></li>';
  }
?>
