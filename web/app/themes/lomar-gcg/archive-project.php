<?php  ?>
<?php get_template_part( 'template-parts/header' ); ?>

<section class="section" aria-labelledby="portfolio-heading">
  <div class="container">

    <div class="section-head">
      <div class="left">
        <p class="eyebrow"><?php esc_html_e( 'Our Work', 'lomar-gcg' ); ?></p>
        <h1 id="portfolio-heading">
          <?php esc_html_e( 'Project', 'lomar-gcg' ); ?><br>
          <em><?php esc_html_e( 'portfolio.', 'lomar-gcg' ); ?></em>
        </h1>
      </div>
      <div class="right">
        <p><?php esc_html_e( 'A selection of our landscape design, installation, and maintenance work across Northern Virginia.', 'lomar-gcg' ); ?></p>
      </div>
    </div>

    <?php get_template_part( 'template-parts/portfolio-grid', null, [ 'limit' => 0, 'preview' => false ] ); ?>

  </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
