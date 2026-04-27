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

<div class="portfolio-grid" role="list">
  <?php while ( $projects->have_posts() ) : $projects->the_post();
    $photos   = get_field( 'project_photos' );
    $service  = get_field( 'project_service' );
    $location = get_field( 'project_location' );

    if ( empty( $photos ) ) {
        $service_slug = sanitize_key( $service ?: 'garden-design' );
        $service_img  = get_template_directory_uri() . '/assets/img/services/' . $service_slug . '.webp';
        $photos       = [ [
            'url'   => $service_img,
            'sizes' => [
                'large'        => $service_img,
                'large-width'  => 800,
                'large-height' => 600,
            ],
            'alt'   => get_the_title(),
        ] ];
    }

    $thumb    = $photos[0];
    $all_imgs = array_map( fn( array $img ): string => esc_url( $img['url'] ), $photos );

    $span_class = $preview ? ( $mosaic[ $index % count( $mosaic ) ] ?? 'pf-c' ) : '';
    ?>

    <div class="pf-item <?php echo esc_attr( $span_class ); ?> fade-in"
         role="listitem"
         tabindex="0"
         aria-label="<?php echo esc_attr( get_the_title() . ( $location ? ', ' . $location : '' ) ); ?>"
    >
      <?php foreach ( $photos as $i => $photo ) : ?>
        <a
          href="<?php echo esc_url( $photo['url'] ); ?>"
          class="glightbox"
          data-gallery="project-<?php echo esc_attr( (string) get_the_ID() ); ?>"
          data-title="<?php echo esc_attr( get_the_title() ); ?>"
          data-description="<?php echo esc_attr( $location ?? '' ); ?>"
          <?php if ( $i > 0 ) : ?>style="display:none"<?php endif; ?>
          aria-<?php echo $i === 0 ? 'label' : 'hidden'; ?>="<?php echo $i === 0 ? esc_attr( get_the_title() ) : 'true'; ?>"
        >
          <?php if ( $i === 0 ) : ?>
            <img
              src="<?php echo esc_url( $thumb['sizes']['large'] ?? $thumb['url'] ); ?>"
              alt="<?php echo esc_attr( $thumb['alt'] ?: get_the_title() ); ?>"
              width="<?php echo esc_attr( (string) ( $thumb['sizes']['large-width'] ?? 800 ) ); ?>"
              height="<?php echo esc_attr( (string) ( $thumb['sizes']['large-height'] ?? 600 ) ); ?>"
              loading="lazy"
            >
          <?php endif; ?>
        </a>
      <?php endforeach; ?>

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
