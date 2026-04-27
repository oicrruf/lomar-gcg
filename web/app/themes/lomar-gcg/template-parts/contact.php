<?php 
$form_id = apply_filters( 'lomar_contact_form_id', defined('FORM_ID') ? FORM_ID : 0 );
?>
<section class="section contact-section fade-in" id="contact" aria-labelledby="contact-heading">
  <div class="container">

    <div class="section-head">
      <div class="left">
        <p class="eyebrow"><?php esc_html_e( 'Get in Touch', 'lomar-gcg' ); ?></p>
        <h2 id="contact-heading">
          <?php esc_html_e( 'Start your', 'lomar-gcg' ); ?><br>
          <em><?php esc_html_e( 'project today.', 'lomar-gcg' ); ?></em>
        </h2>
      </div>
      <div class="right">
        <p><?php esc_html_e( 'Free estimates for all landscape design, installation, and maintenance projects across Northern Virginia.', 'lomar-gcg' ); ?></p>
      </div>
    </div>

    <div class="map-wrap fade-in" style="margin-bottom: var(--sp-7);">
      <div id="service-map" aria-label="<?php esc_attr_e( 'LoMar GCG service area map — Northern Virginia', 'lomar-gcg' ); ?>" role="img" style="height: 400px;"></div>
    </div>

    <div class="contact-layout">
      <div class="contact-form">
        <?php echo do_shortcode( '[contact-form-7 id="' . absint( $form_id ) . '" title="Free Estimate Request"]' ); ?>
      </div>
      <div class="contact-info">
        <p class="eyebrow"><?php esc_html_e( 'Service Area', 'lomar-gcg' ); ?></p>
        <p><?php esc_html_e( 'We serve all of Northern Virginia and the DMV metro area, including Fairfax, Loudoun, Prince William, and Arlington counties.', 'lomar-gcg' ); ?></p>
        <div class="contact-details" style="margin-top: var(--sp-6);">
          <p class="sheet-ref" style="opacity:.7; font-size: var(--fs-xs); font-family: var(--font-mono);">
            <?php esc_html_e( 'LICENSED & INSURED · VIRGINIA CLASS A CONTRACTOR', 'lomar-gcg' ); ?>
          </p>
        </div>
      </div>
    </div>

  </div>
</section>
