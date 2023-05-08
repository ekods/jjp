</div>

<footer class="footer">
  <div class="container">
    <div class="footerMain">
      <div class="footerInner">

        <?php get_template_part( 'template-parts/section/_boxNav' ); ?>

      </div>
    </div>

    <?php
    $copyright = myprefix_get_theme_option( 'themes_copy' );
    if (!empty( $copyright )) { ?>
    <div class="footerCopyright">
      <?php echo $copyright; ?>
    </div>
    <?php	}	?>

  </div>
</footer>


<!-- Back to top button -->
<a id="backtop"></a>


<!-- Search -->
<?php get_template_part( 'template-parts/section/_search' ); ?>


<!-- MENU OVERLAY -->
<?php get_template_part( 'template-parts/section/_menuNav' ); ?>


<?php wp_footer(); ?>
</body>
</html>
