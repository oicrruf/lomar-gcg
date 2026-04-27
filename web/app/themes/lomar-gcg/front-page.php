<?php  ?>
<?php get_template_part( 'template-parts/header' ); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<?php get_template_part( 'template-parts/services' ); ?>

<section class="stats fade-in" aria-label="<?php esc_attr_e( 'Company statistics', 'lomar-gcg' ); ?>">
  <div class="container">
    <div class="stats-grid">
      <div class="stat">
        <div class="n">20<em>+</em></div>
        <div class="l"><?php esc_html_e( 'Years of experience', 'lomar-gcg' ); ?></div>
      </div>
      <div class="stat">
        <div class="n">400<em>+</em></div>
        <div class="l"><?php esc_html_e( 'Projects completed', 'lomar-gcg' ); ?></div>
      </div>
      <div class="stat">
        <div class="n">98<em>%</em></div>
        <div class="l"><?php esc_html_e( 'Client referral rate', 'lomar-gcg' ); ?></div>
      </div>
      <div class="stat">
        <div class="n">5<em>★</em></div>
        <div class="l"><?php esc_html_e( 'Average Google rating', 'lomar-gcg' ); ?></div>
      </div>
    </div>
  </div>
</section>

<?php get_template_part( 'template-parts/process' ); ?>

<section class="section portfolio-preview fade-in" aria-labelledby="portfolio-preview-heading">
  <div class="container">
    <div class="section-head">
      <div class="left">
        <p class="eyebrow"><?php esc_html_e( 'Recent Work', 'lomar-gcg' ); ?></p>
        <h2 id="portfolio-preview-heading">
          <?php esc_html_e( 'Selected', 'lomar-gcg' ); ?><br>
          <em><?php esc_html_e( 'projects.', 'lomar-gcg' ); ?></em>
        </h2>
      </div>
      <div class="right" style="display:flex;align-items:flex-end;justify-content:flex-end;">
        <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-ghost">
          <?php esc_html_e( 'View All Work →', 'lomar-gcg' ); ?>
        </a>
      </div>
    </div>

    <?php get_template_part( 'template-parts/portfolio-grid', null, [ 'limit' => 6, 'preview' => true ] ); ?>
  </div>
</section>

<?php get_template_part( 'template-parts/contact' ); ?>

<?php get_template_part( 'template-parts/footer' ); ?>
