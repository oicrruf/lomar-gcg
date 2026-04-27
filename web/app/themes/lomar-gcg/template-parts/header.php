<?php  ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="nav" id="site-nav" role="banner">
  <div class="container">
    <nav class="nav-inner" aria-label="<?php esc_attr_e( 'Primary navigation', 'lomar-gcg' ); ?>">

      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand" aria-label="<?php esc_attr_e( 'LoMar GCG home', 'lomar-gcg' ); ?>">
        <img
          src="<?php echo esc_url( LOMAR_URI . '/assets/img/logo-lomar-gcg.png' ); ?>"
          alt="<?php esc_attr_e( 'LoMar GCG', 'lomar-gcg' ); ?>"
          class="brand-logo"
          width="180"
          height="52"
          loading="eager"
        >
      </a>

      <?php
      wp_nav_menu( [
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'nav-links',
          'fallback_cb'    => function (): void {
              echo '<ul class="nav-links">';
              echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'lomar-gcg' ) . '</a></li>';
              echo '<li><a href="' . esc_url( home_url( '/portfolio' ) ) . '">' . esc_html__( 'Portfolio', 'lomar-gcg' ) . '</a></li>';
              echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">' . esc_html__( 'Contact', 'lomar-gcg' ) . '</a></li>';
              echo '</ul>';
          },
      ] );
      ?>

      <div class="nav-cta">
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
          <?php esc_html_e( 'Get a Free Estimate', 'lomar-gcg' ); ?>
          <span class="arrow" aria-hidden="true">→</span>
        </a>
      </div>

      <button class="mobile-toggle" aria-label="<?php esc_attr_e( 'Open menu', 'lomar-gcg' ); ?>" aria-expanded="false" aria-controls="mobile-menu">
        <svg width="22" height="16" viewBox="0 0 22 16" fill="none" aria-hidden="true">
          <rect width="22" height="2" rx="1" fill="currentColor"/>
          <rect y="7" width="22" height="2" rx="1" fill="currentColor"/>
          <rect y="14" width="22" height="2" rx="1" fill="currentColor"/>
        </svg>
      </button>
    </nav>
  </div>
</header>

<div class="mobile-menu" id="mobile-menu" role="dialog" aria-label="<?php esc_attr_e( 'Mobile navigation', 'lomar-gcg' ); ?>" aria-hidden="true">
  <button class="mobile-close" aria-label="<?php esc_attr_e( 'Close menu', 'lomar-gcg' ); ?>">✕</button>
  <ul class="nav-links">
    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'lomar-gcg' ); ?></a></li>
    <li><a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>"><?php esc_html_e( 'Portfolio', 'lomar-gcg' ); ?></a></li>
    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'lomar-gcg' ); ?></a></li>
  </ul>
  <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
    <?php esc_html_e( 'Get a Free Estimate', 'lomar-gcg' ); ?> →
  </a>
</div>

<main id="main-content" role="main">
