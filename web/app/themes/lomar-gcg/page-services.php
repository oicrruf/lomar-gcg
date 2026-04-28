<?php  ?>
<?php get_template_part( 'template-parts/header' ); ?>

<!-- ── Services hero ────────────────────────────────────────────────── -->
<section class="services-hero fade-in" aria-labelledby="services-page-heading">
  <div class="container">
    <div class="services-hero__inner">
      <div class="services-hero__left">
        <p class="eyebrow"><?php esc_html_e( 'What We Do', 'lomar-gcg' ); ?></p>
        <h1 id="services-page-heading">
          <?php esc_html_e( 'Complete landscape', 'lomar-gcg' ); ?><br>
          <em><?php esc_html_e( 'services.', 'lomar-gcg' ); ?></em>
        </h1>
      </div>
      <div class="services-hero__right">
        <p><?php esc_html_e( 'From initial design through final installation and ongoing maintenance — we handle every phase of your outdoor project across Northern Virginia.', 'lomar-gcg' ); ?></p>
        <nav class="services-hero__toc" aria-label="<?php esc_attr_e( 'Jump to service', 'lomar-gcg' ); ?>">
          <a href="#paver-patios" class="svc-toc-link">
            <span class="svc-toc-num" aria-hidden="true">01</span>
            <span><?php esc_html_e( 'Paver Patios & Walkways', 'lomar-gcg' ); ?></span>
            <svg class="svc-toc-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="#garden-design" class="svc-toc-link">
            <span class="svc-toc-num" aria-hidden="true">02</span>
            <span><?php esc_html_e( 'Garden Design', 'lomar-gcg' ); ?></span>
            <svg class="svc-toc-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="#fire-pits" class="svc-toc-link">
            <span class="svc-toc-num" aria-hidden="true">03</span>
            <span><?php esc_html_e( 'Fire Pits & Outdoor Living', 'lomar-gcg' ); ?></span>
            <svg class="svc-toc-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="#retaining-walls" class="svc-toc-link">
            <span class="svc-toc-num" aria-hidden="true">04</span>
            <span><?php esc_html_e( 'Retaining Walls', 'lomar-gcg' ); ?></span>
            <svg class="svc-toc-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
          <a href="#maintenance" class="svc-toc-link">
            <span class="svc-toc-num" aria-hidden="true">05</span>
            <span><?php esc_html_e( 'Lawn & Landscape Maintenance', 'lomar-gcg' ); ?></span>
            <svg class="svc-toc-arrow" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
          </a>
        </nav>
      </div>
    </div>
  </div>
</section>

<!-- ── Service blocks ────────────────────────────────────────────────── -->
<div class="svc-detail-wrap">

  <!-- 01 — Paver Patios & Walkways -->
  <section id="paver-patios" class="svc-block fade-in" aria-labelledby="svc-heading-01">
    <div class="container">
      <div class="svc-block__inner">
        <div class="svc-media">
          <img
            src="<?php echo esc_url( LOMAR_URI . '/assets/img/services/paver-patios.webp' ); ?>"
            alt="<?php esc_attr_e( 'Elegant paver patio installation', 'lomar-gcg' ); ?>"
            width="800" height="600"
            loading="eager"
          >
        </div>
        <div class="svc-content">
          <p class="eyebrow" aria-hidden="true">01</p>
          <h2 id="svc-heading-01"><?php esc_html_e( 'Paver Patios & Walkways', 'lomar-gcg' ); ?></h2>
          <p class="svc-desc"><?php esc_html_e( 'Custom stonework, brick, and concrete paver installations designed to extend your living space outdoors — built to last through Northern Virginia winters.', 'lomar-gcg' ); ?></p>
          <ul class="svc-includes" aria-label="<?php esc_attr_e( 'What is included', 'lomar-gcg' ); ?>">
            <li><?php esc_html_e( 'Bluestone, flagstone & natural stone', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Concrete & clay brick pavers', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Pool surrounds & courtyard design', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Steps, landings & entryway upgrades', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Proper base prep & drainage planning', 'lomar-gcg' ); ?></li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-ghost">
            <?php esc_html_e( 'Get a free estimate', 'lomar-gcg' ); ?>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 02 — Garden Design -->
  <section id="garden-design" class="svc-block svc-block--flip fade-in" aria-labelledby="svc-heading-02">
    <div class="container">
      <div class="svc-block__inner">
        <div class="svc-media">
          <img
            src="<?php echo esc_url( LOMAR_URI . '/assets/img/services/garden-design.webp' ); ?>"
            alt="<?php esc_attr_e( 'Lush garden design with native plants', 'lomar-gcg' ); ?>"
            width="800" height="600"
            loading="lazy"
          >
        </div>
        <div class="svc-content">
          <p class="eyebrow" aria-hidden="true">02</p>
          <h2 id="svc-heading-02"><?php esc_html_e( 'Garden Design', 'lomar-gcg' ); ?></h2>
          <p class="svc-desc"><?php esc_html_e( 'Thoughtful planting plans that bring color, texture, and life to every season of your property — tailored to Northern Virginia\'s climate and your personal style.', 'lomar-gcg' ); ?></p>
          <ul class="svc-includes" aria-label="<?php esc_attr_e( 'What is included', 'lomar-gcg' ); ?>">
            <li><?php esc_html_e( 'Custom planting plans & plant selection', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Native & drought-tolerant species', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Seasonal color & year-round interest', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Mulching, edging & soil prep', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Irrigation planning & integration', 'lomar-gcg' ); ?></li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-ghost">
            <?php esc_html_e( 'Get a free estimate', 'lomar-gcg' ); ?>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 03 — Fire Pits & Outdoor Living -->
  <section id="fire-pits" class="svc-block fade-in" aria-labelledby="svc-heading-03">
    <div class="container">
      <div class="svc-block__inner">
        <div class="svc-media">
          <img
            src="<?php echo esc_url( LOMAR_URI . '/assets/img/services/fire-pits.webp' ); ?>"
            alt="<?php esc_attr_e( 'Custom stone fire pit with seating area', 'lomar-gcg' ); ?>"
            width="800" height="600"
            loading="lazy"
          >
        </div>
        <div class="svc-content">
          <p class="eyebrow" aria-hidden="true">03</p>
          <h2 id="svc-heading-03"><?php esc_html_e( 'Fire Pits & Outdoor Living', 'lomar-gcg' ); ?></h2>
          <p class="svc-desc"><?php esc_html_e( 'Stone fire pits, outdoor kitchens, and pergolas that create year-round gathering spaces — turning your backyard into an extension of your home.', 'lomar-gcg' ); ?></p>
          <ul class="svc-includes" aria-label="<?php esc_attr_e( 'What is included', 'lomar-gcg' ); ?>">
            <li><?php esc_html_e( 'Custom stone & masonry fire pits', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Outdoor kitchen design & build', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Pergolas & shade structures', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Seating walls & built-in benches', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Integrated lighting & electrical planning', 'lomar-gcg' ); ?></li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-ghost">
            <?php esc_html_e( 'Get a free estimate', 'lomar-gcg' ); ?>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 04 — Retaining Walls -->
  <section id="retaining-walls" class="svc-block svc-block--flip fade-in" aria-labelledby="svc-heading-04">
    <div class="container">
      <div class="svc-block__inner">
        <div class="svc-media">
          <img
            src="<?php echo esc_url( LOMAR_URI . '/assets/img/services/retaining-walls.webp' ); ?>"
            alt="<?php esc_attr_e( 'Stone retaining wall with landscaping', 'lomar-gcg' ); ?>"
            width="800" height="600"
            loading="lazy"
          >
        </div>
        <div class="svc-content">
          <p class="eyebrow" aria-hidden="true">04</p>
          <h2 id="svc-heading-04"><?php esc_html_e( 'Retaining Walls', 'lomar-gcg' ); ?></h2>
          <p class="svc-desc"><?php esc_html_e( 'Structural and decorative walls that manage grades, prevent erosion, and define outdoor spaces — engineered for Northern Virginia\'s clay soils and freeze-thaw cycles.', 'lomar-gcg' ); ?></p>
          <ul class="svc-includes" aria-label="<?php esc_attr_e( 'What is included', 'lomar-gcg' ); ?>">
            <li><?php esc_html_e( 'Natural stone & boulder walls', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Segmental block (Allan Block, Versa-Lok)', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Tiered terracing & raised planters', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'French drain & waterproofing systems', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Erosion control & slope stabilization', 'lomar-gcg' ); ?></li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-ghost">
            <?php esc_html_e( 'Get a free estimate', 'lomar-gcg' ); ?>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- 05 — Lawn & Landscape Maintenance -->
  <section id="maintenance" class="svc-block fade-in" aria-labelledby="svc-heading-05">
    <div class="container">
      <div class="svc-block__inner">
        <div class="svc-media">
          <img
            src="<?php echo esc_url( LOMAR_URI . '/assets/img/services/maintenance.webp' ); ?>"
            alt="<?php esc_attr_e( 'Perfectly maintained lawn and garden', 'lomar-gcg' ); ?>"
            width="800" height="600"
            loading="lazy"
          >
        </div>
        <div class="svc-content">
          <p class="eyebrow" aria-hidden="true">05</p>
          <h2 id="svc-heading-05"><?php esc_html_e( 'Lawn & Landscape Maintenance', 'lomar-gcg' ); ?></h2>
          <p class="svc-desc"><?php esc_html_e( 'Seasonal maintenance programs that keep your property pristine throughout the year — from spring cleanups to winter dormancy care.', 'lomar-gcg' ); ?></p>
          <ul class="svc-includes" aria-label="<?php esc_attr_e( 'What is included', 'lomar-gcg' ); ?>">
            <li><?php esc_html_e( 'Weekly & bi-weekly mowing programs', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Spring & fall cleanups', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Fertilization & weed control', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Pruning, trimming & bed maintenance', 'lomar-gcg' ); ?></li>
            <li><?php esc_html_e( 'Aeration, overseeding & dethatching', 'lomar-gcg' ); ?></li>
          </ul>
          <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-ghost">
            <?php esc_html_e( 'Get a free estimate', 'lomar-gcg' ); ?>
          </a>
        </div>
      </div>
    </div>
  </section>

</div>

<!-- ── Our process ───────────────────────────────────────────────────── -->
<?php get_template_part( 'template-parts/process' ); ?>

<!-- ── CTA banner ───────────────────────────────────────────────────── -->
<section class="cta-banner fade-in" aria-labelledby="svc-cta-heading">
  <div class="container">
    <div class="cta-inner">
      <h2 id="svc-cta-heading">
        <?php esc_html_e( 'Ready to start your', 'lomar-gcg' ); ?><br>
        <em><?php esc_html_e( 'outdoor project?', 'lomar-gcg' ); ?></em>
      </h2>
      <div class="cta-meta">
        <p><?php esc_html_e( 'Free estimates for all projects across Northern Virginia. We respond within one business day.', 'lomar-gcg' ); ?></p>
        <div class="cta-phone">
          <span class="cta-phone__label"><?php esc_html_e( 'Call us today', 'lomar-gcg' ); ?></span>
          <a href="tel:+17034762280" class="phone">(703) 476-2280</a>
        </div>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-dark">
          <?php esc_html_e( 'Request a free estimate', 'lomar-gcg' ); ?>
          <svg class="arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
