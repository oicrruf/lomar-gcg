<?php  ?>
</main>

<footer class="site" role="contentinfo">
  <div class="container">
    <div class="footer-inner">

      <div class="footer-brand">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'LoMar GCG home', 'lomar-gcg' ); ?>">
          <img
            src="<?php echo esc_url( LOMAR_URI . '/assets/img/logo-lomar-gcg.png' ); ?>"
            alt="<?php esc_attr_e( 'LoMar GCG', 'lomar-gcg' ); ?>"
            class="brand-logo"
            width="200"
            height="64"
            loading="lazy"
          >
        </a>
        <p class="footer-tagline"><?php esc_html_e( 'Full-service landscape contractor across Northern Virginia.', 'lomar-gcg' ); ?></p>
        <p class="sheet-ref">38°45′N 77°28′W · Est. 2004</p>
      </div>

      <nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer navigation', 'lomar-gcg' ); ?>">
        <ul>
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'lomar-gcg' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>"><?php esc_html_e( 'Portfolio', 'lomar-gcg' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'lomar-gcg' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'lomar-gcg' ); ?></a></li>
        </ul>
      </nav>

      <div class="footer-contact">
        <p class="eyebrow"><?php esc_html_e( 'Get in touch', 'lomar-gcg' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary" style="margin-top: 16px;">
          <?php esc_html_e( 'Free Estimate →', 'lomar-gcg' ); ?>
        </a>
      </div>

    </div>

    <div class="footer-bottom">
      <p class="sheet-ref">
        © <?php echo esc_html( (string) gmdate( 'Y' ) ); ?> LoMar GCG ·
        <?php esc_html_e( 'Northern Virginia Landscape Contractor', 'lomar-gcg' ); ?>
      </p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
