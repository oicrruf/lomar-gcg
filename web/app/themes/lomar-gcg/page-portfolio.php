<?php  ?>
<?php get_template_part( 'template-parts/header' ); ?>

<section class="pf-hero fade-in" aria-labelledby="portfolio-heading">
  <div class="container">
    <div class="pf-page-head">
      <div class="pf-page-head__left">
        <p class="eyebrow"><?php esc_html_e( 'Our Work', 'lomar-gcg' ); ?></p>
        <h1 id="portfolio-heading">
          <?php esc_html_e( 'Project', 'lomar-gcg' ); ?><br>
          <em><?php esc_html_e( 'portfolio.', 'lomar-gcg' ); ?></em>
        </h1>
      </div>
      <div class="pf-page-head__right">
        <p><?php esc_html_e( 'A selection of our landscape design, installation, and maintenance work across Northern Virginia.', 'lomar-gcg' ); ?></p>
      </div>
    </div>
  </div>
</section>

<section class="portfolio-page" aria-label="<?php esc_attr_e( 'Portfolio grid', 'lomar-gcg' ); ?>">
  <div class="container">

    <div class="pf-toolbar">
      <nav class="pf-filters" role="tablist" aria-label="<?php esc_attr_e( 'Filter by service type', 'lomar-gcg' ); ?>">
        <button class="pf-filter on" data-filter="all" role="tab" aria-selected="true">
          <?php esc_html_e( 'All', 'lomar-gcg' ); ?>
        </button>
        <button class="pf-filter" data-filter="paver-patios" role="tab" aria-selected="false">
          <?php esc_html_e( 'Paver Patios', 'lomar-gcg' ); ?>
        </button>
        <button class="pf-filter" data-filter="garden-design" role="tab" aria-selected="false">
          <?php esc_html_e( 'Garden Design', 'lomar-gcg' ); ?>
        </button>
        <button class="pf-filter" data-filter="fire-pits" role="tab" aria-selected="false">
          <?php esc_html_e( 'Fire Pits', 'lomar-gcg' ); ?>
        </button>
        <button class="pf-filter" data-filter="retaining-walls" role="tab" aria-selected="false">
          <?php esc_html_e( 'Retaining Walls', 'lomar-gcg' ); ?>
        </button>
        <button class="pf-filter" data-filter="maintenance" role="tab" aria-selected="false">
          <?php esc_html_e( 'Maintenance', 'lomar-gcg' ); ?>
        </button>
      </nav>
      <p class="pf-count-label" aria-live="polite">
        <span id="pf-visible-count">0</span> <?php esc_html_e( 'projects', 'lomar-gcg' ); ?>
      </p>
    </div>

    <?php get_template_part( 'template-parts/portfolio-grid', null, [ 'limit' => 0, 'preview' => false ] ); ?>

  </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
