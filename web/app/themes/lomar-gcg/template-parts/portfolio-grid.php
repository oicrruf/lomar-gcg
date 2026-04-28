<?php

/** @var int  $limit   Max posts to show. 0 = no limit. */
/** @var bool $preview True = homepage preview (6 items, mosaic layout). */
$limit   = (int) ( $args['limit'] ?? 0 );
$preview = (bool) ( $args['preview'] ?? false );

$query_args = [
    'post_type'      => 'project',
    'post_status'    => 'publish',
    'posts_per_page' => $limit > 0 ? $limit : -1,
    'no_found_rows'  => true,
    'orderby'        => 'date',
    'order'          => 'DESC',
];

$projects = new WP_Query( $query_args );

if ( ! $projects->have_posts() ) {
    return;
}

// Mosaic span classes for homepage preview (first 7 items)
$mosaic = [ 'pf-a', 'pf-b', 'pf-c', 'pf-d', 'pf-e', 'pf-f', 'pf-g' ];
$index  = 0;
?>

<div class="portfolio-grid <?php echo $preview ? '' : 'portfolio-grid--full'; ?>" role="list">
  <?php while ( $projects->have_posts() ) : $projects->the_post();
    $service  = get_field( 'project_service' );
    $location = get_field( 'project_location' );

    // Featured Image is the single source of truth for the project photo.
    $thumbnail_id = get_post_thumbnail_id();
    if ( $thumbnail_id ) {
        $thumb_src = wp_get_attachment_image_src( $thumbnail_id, 'large' );
        $img_url   = $thumb_src[0];
        $img_w     = $thumb_src[1];
        $img_h     = $thumb_src[2];
        $img_alt   = get_post_meta( $thumbnail_id, '_wp_attachment_image_alt', true ) ?: get_the_title();
    } else {
        $service_slug = sanitize_key( $service ?: 'garden-design' );
        $img_url = get_template_directory_uri() . '/assets/img/services/' . $service_slug . '.webp';
        $img_w   = 800;
        $img_h   = 600;
        $img_alt = get_the_title();
    }

    $span_class = $preview ? ( $mosaic[ $index % count( $mosaic ) ] ?? 'pf-c' ) : '';
    ?>

    <div class="pf-item <?php echo esc_attr( $span_class ); ?> fade-in"
         role="listitem"
         tabindex="0"
         data-service="<?php echo esc_attr( $service ?? '' ); ?>"
         aria-label="<?php echo esc_attr( get_the_title() . ( $location ? ', ' . $location : '' ) ); ?>"
    >
      <?php if ( ! $preview ) : ?>
        <span class="pf-expand" aria-hidden="true">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M14 10l6.1-6.1M9 21H3v-6M10 14l-6.1 6.1"/></svg>
        </span>
      <?php endif; ?>

      <a
        href="<?php echo esc_url( $img_url ); ?>"
        class="glightbox"
        data-gallery="portfolio"
        data-title="<?php echo esc_attr( get_the_title() ); ?>"
        data-description="<?php echo esc_attr( $location ?? '' ); ?>"
        aria-label="<?php echo esc_attr( get_the_title() ); ?>"
      >
        <img
          src="<?php echo esc_url( $img_url ); ?>"
          alt="<?php echo esc_attr( $img_alt ); ?>"
          width="<?php echo esc_attr( (string) $img_w ); ?>"
          height="<?php echo esc_attr( (string) $img_h ); ?>"
          loading="lazy"
        >
      </a>

      <div class="meta">
        <?php if ( $service ) : ?>
          <div class="cat"><?php echo esc_html( ucwords( str_replace( '-', ' ', $service ) ) ); ?></div>
        <?php endif; ?>
        <div class="ti"><?php the_title(); ?></div>
        <?php if ( $location ) : ?>
          <div class="cat" style="margin-top:4px;opacity:.8"><?php echo esc_html( $location ); ?></div>
        <?php endif; ?>
      </div>
    </div>

  <?php $index++; endwhile; wp_reset_postdata(); ?>
</div>
