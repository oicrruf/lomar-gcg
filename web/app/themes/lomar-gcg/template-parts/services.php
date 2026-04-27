<?php  ?>
<section class="section services-section fade-in" aria-labelledby="services-heading">
  <div class="container">

    <div class="section-head">
      <div class="left">
        <p class="eyebrow"><?php esc_html_e( 'What We Do', 'lomar-gcg' ); ?></p>
        <h2 id="services-heading">
          <?php esc_html_e( 'Complete landscape', 'lomar-gcg' ); ?><br>
          <em><?php esc_html_e( 'services.', 'lomar-gcg' ); ?></em>
        </h2>
      </div>
      <div class="right">
        <p><?php esc_html_e( 'From initial design through final installation and ongoing maintenance — we handle every phase of your outdoor project.', 'lomar-gcg' ); ?></p>
      </div>
    </div>

    <?php
    $services = [
      [
        'num'   => '01',
        'title' => __( 'Paver Patios & Walkways', 'lomar-gcg' ),
        'desc'  => __( 'Custom stonework, brick, and concrete paver installations designed to extend your living space outdoors.', 'lomar-gcg' ),
        'img'   => 'paver-patios.webp',
        'alt'   => __( 'Elegant paver patio installation', 'lomar-gcg' ),
      ],
      [
        'num'   => '02',
        'title' => __( 'Garden Design', 'lomar-gcg' ),
        'desc'  => __( 'Thoughtful planting plans that bring color, texture, and life to every season of your property.', 'lomar-gcg' ),
        'img'   => 'garden-design.webp',
        'alt'   => __( 'Lush garden design with native plants', 'lomar-gcg' ),
      ],
      [
        'num'   => '03',
        'title' => __( 'Fire Pits & Outdoor Living', 'lomar-gcg' ),
        'desc'  => __( 'Stone fire pits, outdoor kitchens, and pergolas that create year-round gathering spaces.', 'lomar-gcg' ),
        'img'   => 'fire-pits.webp',
        'alt'   => __( 'Custom stone fire pit with seating area', 'lomar-gcg' ),
      ],
      [
        'num'   => '04',
        'title' => __( 'Retaining Walls', 'lomar-gcg' ),
        'desc'  => __( 'Structural and decorative walls that manage grades, prevent erosion, and define outdoor spaces.', 'lomar-gcg' ),
        'img'   => 'retaining-walls.webp',
        'alt'   => __( 'Stone retaining wall with landscaping', 'lomar-gcg' ),
      ],
      [
        'num'   => '05',
        'title' => __( 'Lawn & Landscape Maintenance', 'lomar-gcg' ),
        'desc'  => __( 'Seasonal maintenance programs that keep your property pristine throughout the year.', 'lomar-gcg' ),
        'img'   => 'maintenance.webp',
        'alt'   => __( 'Perfectly maintained lawn and garden', 'lomar-gcg' ),
      ],
    ];
    ?>

    <div class="services-list" role="list">
      <?php foreach ( $services as $service ) : ?>
        <div class="service-row" role="listitem">
          <span class="num" aria-hidden="true"><?php echo esc_html( $service['num'] ); ?></span>
          <h3><?php echo esc_html( $service['title'] ); ?></h3>
          <p><?php echo esc_html( $service['desc'] ); ?></p>
          <div class="thumb-wrap" aria-hidden="true">
            <img
              src="<?php echo esc_url( LOMAR_URI . '/assets/img/services/' . $service['img'] ); ?>"
              alt="<?php echo esc_attr( $service['alt'] ); ?>"
              class="service-thumb"
              width="400"
              height="250"
              loading="lazy"
            >
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
