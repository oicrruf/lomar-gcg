<?php  ?>
<?php get_template_part( 'template-parts/header' ); ?>

<?php
$form_id = (int) get_option( 'lomar_contact_form_id', 36 );
?>

<!-- ── Contact hero ─────────────────────────────────────────────────── -->
<section class="contact-hero" aria-labelledby="contact-hero-heading">
  <div class="container">
    <div class="contact-hero__inner">
      <div class="contact-hero__left">
        <p class="eyebrow"><?php esc_html_e( 'Contact', 'lomar-gcg' ); ?></p>
        <h1 id="contact-hero-heading">
          <?php esc_html_e( 'Start your', 'lomar-gcg' ); ?><br>
          <em><?php esc_html_e( 'project.', 'lomar-gcg' ); ?></em>
        </h1>
      </div>
      <div class="contact-hero__right">
        <p><?php esc_html_e( 'Free estimates for all landscape design, installation, and maintenance projects across Northern Virginia. We respond within one business day.', 'lomar-gcg' ); ?></p>
        <div class="contact-hero__links">
          <a href="tel:+17034762280" class="contact-quick-link">
            <span class="cql-icon" aria-hidden="true">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.6 3.32 2 2 0 0 1 3.55 1H6.5a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.46a16 16 0 0 0 6 6l.37-.36a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </span>
            <span>(703) 476-2280</span>
          </a>
          <a href="mailto:roberto@lomar-gcg.com" class="contact-quick-link">
            <span class="cql-icon" aria-hidden="true">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
            </span>
            <span>roberto@lomar-gcg.com</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ── Main contact layout ──────────────────────────────────────────── -->
<section class="contact-main" aria-label="<?php esc_attr_e( 'Contact form and information', 'lomar-gcg' ); ?>">
  <div class="container">
    <div class="contact-split">

      <!-- Form column -->
      <div class="contact-split__form">
        <div class="contact-form-head">
          <p class="eyebrow"><?php esc_html_e( 'Free Estimate', 'lomar-gcg' ); ?></p>
          <h2><?php esc_html_e( 'Tell us about your project', 'lomar-gcg' ); ?></h2>
          <p class="contact-form-sub"><?php esc_html_e( 'Fill out the form and we\'ll reach out within one business day to schedule a free on-site consultation.', 'lomar-gcg' ); ?></p>
        </div>

        <div class="contact-form-wrap">
          <?php if ( $form_id ) : ?>
            <?php echo do_shortcode( '[contact-form-7 id="' . absint( $form_id ) . '" title="Free Estimate Request"]' ); ?>
          <?php else : ?>
            <p class="contact-form-fallback"><?php esc_html_e( 'Contact form not configured.', 'lomar-gcg' ); ?></p>
          <?php endif; ?>
        </div>

        <p class="contact-trust-note">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          <?php esc_html_e( 'Your information is never shared with third parties.', 'lomar-gcg' ); ?>
        </p>
      </div>

      <!-- Info sidebar -->
      <aside class="contact-split__sidebar" aria-label="<?php esc_attr_e( 'Contact information', 'lomar-gcg' ); ?>">

        <div class="contact-info-block">
          <div class="cib-icon" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.6 3.32 2 2 0 0 1 3.55 1H6.5a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.46a16 16 0 0 0 6 6l.37-.36a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div class="cib-body">
            <p class="cib-label"><?php esc_html_e( 'Phone', 'lomar-gcg' ); ?></p>
            <a href="tel:+17034762280" class="cib-value">(703) 476-2280</a>
          </div>
        </div>

        <div class="contact-info-block">
          <div class="cib-icon" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          </div>
          <div class="cib-body">
            <p class="cib-label"><?php esc_html_e( 'Email', 'lomar-gcg' ); ?></p>
            <a href="mailto:roberto@lomar-gcg.com" class="cib-value">roberto@lomar-gcg.com</a>
          </div>
        </div>

        <div class="contact-info-block">
          <div class="cib-icon" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <div class="cib-body">
            <p class="cib-label"><?php esc_html_e( 'Business Hours', 'lomar-gcg' ); ?></p>
            <p class="cib-value"><?php esc_html_e( 'Mon – Sat', 'lomar-gcg' ); ?></p>
            <p class="cib-sub"><?php esc_html_e( '7:30 am – 5:30 pm', 'lomar-gcg' ); ?></p>
          </div>
        </div>

        <div class="contact-info-block">
          <div class="cib-icon" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div class="cib-body">
            <p class="cib-label"><?php esc_html_e( 'Service Area', 'lomar-gcg' ); ?></p>
            <p class="cib-value"><?php esc_html_e( 'Northern Virginia', 'lomar-gcg' ); ?></p>
            <p class="cib-sub"><?php esc_html_e( 'Fairfax · Loudoun · Prince William · Arlington · Alexandria', 'lomar-gcg' ); ?></p>
          </div>
        </div>

        <div class="contact-creds">
          <div class="contact-cred">
            <span class="cc-dot" aria-hidden="true"></span>
            <?php esc_html_e( 'Licensed & Insured', 'lomar-gcg' ); ?>
          </div>
          <div class="contact-cred">
            <span class="cc-dot" aria-hidden="true"></span>
            <?php esc_html_e( 'Virginia Class A Contractor', 'lomar-gcg' ); ?>
          </div>
          <div class="contact-cred">
            <span class="cc-dot" aria-hidden="true"></span>
            <?php esc_html_e( 'Est. 2004 · 20+ Years Experience', 'lomar-gcg' ); ?>
          </div>
        </div>

      </aside>
    </div>
  </div>
</section>

<!-- ── Service area map ─────────────────────────────────────────────── -->
<section class="contact-map-section fade-in" aria-label="<?php esc_attr_e( 'Service area map', 'lomar-gcg' ); ?>">
  <div class="container">
    <div class="contact-map-head">
      <p class="eyebrow"><?php esc_html_e( 'Where We Work', 'lomar-gcg' ); ?></p>
      <h2><?php esc_html_e( 'Northern Virginia', 'lomar-gcg' ); ?> <em><?php esc_html_e( 'service area.', 'lomar-gcg' ); ?></em></h2>
    </div>
    <div class="map-wrap">
      <div id="service-map"
           aria-label="<?php esc_attr_e( 'LoMar GCG service area — Northern Virginia', 'lomar-gcg' ); ?>"
           role="img"
           style="height: 420px;">
      </div>
    </div>
  </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
