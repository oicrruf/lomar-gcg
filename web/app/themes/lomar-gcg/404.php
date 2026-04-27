<?php  ?>
<?php get_template_part( 'template-parts/header' ); ?>

<section class="section" style="min-height: 60vh; display:flex; align-items:center;">
  <div class="container" style="text-align:center;">
    <p class="eyebrow"><?php esc_html_e( 'Error 404', 'lomar-gcg' ); ?></p>
    <h1 style="margin-top: var(--sp-4);">
      <?php esc_html_e( 'Page not', 'lomar-gcg' ); ?><br>
      <em><?php esc_html_e( 'found.', 'lomar-gcg' ); ?></em>
    </h1>
    <p style="margin-top: var(--sp-5); color: var(--ink-2);">
      <?php esc_html_e( "The page you're looking for doesn't exist.", 'lomar-gcg' ); ?>
    </p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary" style="margin-top: var(--sp-6);">
      <?php esc_html_e( '← Back to Home', 'lomar-gcg' ); ?>
    </a>
  </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
