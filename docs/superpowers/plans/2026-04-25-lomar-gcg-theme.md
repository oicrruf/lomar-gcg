# LoMar GCG Theme Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build the `lomar-gcg` WordPress theme from scratch — a multi-page classic PHP theme porting the approved visual prototype in `design/` into a fully functional WordPress site.

**Architecture:** Classic PHP template hierarchy (no block editor, no build tools). CSS design system ported directly from `design/styles.css` using native CSS custom properties. Vanilla JS (ES2023+) for animations, GLightbox, and Leaflet. Portfolio managed via CPT + ACF. Contact via CF7. SEO via RankMath + Site Kit.

**Tech Stack:** WordPress 6.4+ · PHP 8.2+ · Bedrock · ACF · Contact Form 7 · GLightbox 3 · Leaflet 1.9 · RankMath · Google Site Kit · Redis Object Cache

**Spec:** `docs/superpowers/specs/2026-04-25-lomar-gcg-theme-design.md`

---

## File Map

### Created
```
web/app/themes/lomar-gcg/
├── style.css
├── functions.php
├── index.php
├── front-page.php
├── page.php
├── archive-project.php
├── 404.php
├── template-parts/
│   ├── header.php
│   ├── footer.php
│   ├── hero.php
│   ├── services.php
│   ├── process.php
│   ├── portfolio-grid.php
│   └── contact.php
├── assets/
│   ├── css/
│   │   ├── style.css
│   │   └── cf7-overrides.css
│   ├── js/
│   │   └── main.js
│   └── img/
│       ├── logo-lomar-gcg.png
│       ├── favicon.ico
│       ├── apple-touch-icon.png
│       └── services/
│           ├── paver-patios.webp
│           ├── garden-design.webp
│           ├── fire-pits.webp
│           ├── retaining-walls.webp
│           └── maintenance.webp
└── acf-json/
    └── group_project_fields.json
```

### Modified
```
.env                           — add DB_HOST, WP_ENV, salts, Redis vars
config/application.php         — add Redis constants
composer.json                  — add ACF, CF7, RankMath, Site Kit, Redis Object Cache
```

---

## Task 1: Complete Environment Setup

**Files:**
- Modify: `.env`
- Modify: `config/application.php`

- [ ] **Step 1: Generate WordPress salts**

Run:
```bash
curl -s https://api.wordpress.org/secret-key/1.1/salt/
```

Copy the output — you'll paste the values into `.env` below.

- [ ] **Step 2: Update `.env` with all required fields**

Open `.env` and replace/append so it contains:
```ini
DB_NAME=u320060676_lomar-gcg
DB_USER=u320060676_rm
DB_PASSWORD=pD0!A|Ee@
DB_HOST=127.0.0.1

WP_ENV=development
WP_HOME=http://localhost:8083
WP_SITEURL=${WP_HOME}/wp

# Salts — paste values from Step 1
AUTH_KEY=''
SECURE_AUTH_KEY=''
LOGGED_IN_KEY=''
NONCE_KEY=''
AUTH_SALT=''
SECURE_AUTH_SALT=''
LOGGED_IN_SALT=''
NONCE_SALT=''

# Redis (disabled locally, enabled on Hostinger)
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
WP_REDIS_DISABLED=true
```

- [ ] **Step 3: Add Redis constants to `config/application.php`**

Open `config/application.php`. After the existing DB constants block, add:
```php
Config::define( 'WP_REDIS_HOST', env( 'REDIS_HOST' ) ?? '127.0.0.1' );
Config::define( 'WP_REDIS_PORT', (int) ( env( 'REDIS_PORT' ) ?? 6379 ) );
Config::define( 'WP_REDIS_DISABLED', (bool) ( env( 'WP_REDIS_DISABLED' ) ?? false ) );
```

- [ ] **Step 4: Install Composer dependencies**

```bash
composer install
```

Expected: `vendor/` populated, no errors.

- [ ] **Step 5: Start Docker**

```bash
docker compose up -d
```

Expected: two containers running (`lomar-gcg-app`, `lomar-gcg-web`).

- [ ] **Step 6: Run WP install**

```bash
wp core install \
  --url="http://localhost:8083" \
  --title="LoMar GCG" \
  --admin_user="admin" \
  --admin_password="changeme123!" \
  --admin_email="vm.reyesal@gmail.com" \
  --skip-email
```

Expected: `WordPress installed successfully.`

- [ ] **Step 7: Verify WordPress loads**

Open `http://localhost:8083` in browser.
Expected: WordPress default theme running.

---

## Task 2: Add Plugins via Composer

**Files:**
- Modify: `composer.json`

WordPress plugins in Bedrock are managed via Composer using the `wpackagist` repository.

- [ ] **Step 1: Add plugins to `composer.json`**

In `composer.json`, add to the `require` block:
```json
"wpackagist-plugin/advanced-custom-fields": "^6.3",
"wpackagist-plugin/contact-form-7": "^6.0",
"wpackagist-plugin/seo-by-rank-math": "^1.0",
"wpackagist-plugin/google-site-kit": "^1.0",
"wpackagist-plugin/redis-cache": "^2.5"
```

- [ ] **Step 2: Install**

```bash
composer update
```

Expected: plugins appear in `web/app/plugins/`.

- [ ] **Step 3: Activate all plugins via WP-CLI**

```bash
wp plugin activate advanced-custom-fields contact-form-7 seo-by-rank-math google-site-kit redis-cache
```

Expected: `Plugin 'X' activated.` for each.

- [ ] **Step 4: Verify plugins active**

```bash
wp plugin list --status=active
```

Expected: all 5 plugins listed.

---

## Task 3: Theme Scaffold

**Files:**
- Create: `web/app/themes/lomar-gcg/style.css`
- Create: `web/app/themes/lomar-gcg/index.php`
- Create: `web/app/themes/lomar-gcg/functions.php`

- [ ] **Step 1: Create theme directory**

```bash
mkdir -p web/app/themes/lomar-gcg/assets/css
mkdir -p web/app/themes/lomar-gcg/assets/js
mkdir -p web/app/themes/lomar-gcg/assets/img/services
mkdir -p web/app/themes/lomar-gcg/template-parts
mkdir -p web/app/themes/lomar-gcg/acf-json
```

- [ ] **Step 2: Create `style.css` (theme header only)**

```css
/*
Theme Name: LoMar GCG
Theme URI: https://lomar-gcg.com
Author: Víctor M. Reyes
Author URI: https://lomar-gcg.com
Description: Custom theme for LoMar GCG Landscaping — Northern Virginia's premier landscape contractor.
Version: 1.0.0
Requires at least: 6.4
Tested up to: 6.7
Requires PHP: 8.2
Text Domain: lomar-gcg
*/
```

- [ ] **Step 3: Create `index.php` (fallback)**

```php
<?php
// Fallback template — WordPress requires this file.
get_template_part( 'template-parts/header' );
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
endif;
get_template_part( 'template-parts/footer' );
```

- [ ] **Step 4: Create `functions.php`**

```php
<?php

declare(strict_types=1);

define( 'LOMAR_VERSION', wp_get_theme()->get( 'Version' ) );
define( 'LOMAR_URI', get_template_directory_uri() );

// ── Theme support ──────────────────────────────────────────────────────
add_action( 'after_setup_theme', function (): void {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'lomar-gcg' ),
    ] );
} );

// ── Enqueue assets ─────────────────────────────────────────────────────
add_action( 'wp_enqueue_scripts', function (): void {
    // Fonts
    wp_enqueue_style(
        'lomar-fonts',
        'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;1,9..144,400;1,9..144,500&family=Inter:wght@400;500&family=JetBrains+Mono:wght@400;500&display=swap',
        [],
        null
    );

    // Design system CSS
    wp_enqueue_style(
        'lomar-style',
        LOMAR_URI . '/assets/css/style.css',
        [ 'lomar-fonts' ],
        LOMAR_VERSION
    );

    // CF7 style overrides (only when CF7 is active)
    if ( function_exists( 'wpcf7' ) ) {
        wp_enqueue_style(
            'lomar-cf7',
            LOMAR_URI . '/assets/css/cf7-overrides.css',
            [ 'lomar-style' ],
            LOMAR_VERSION
        );
    }

    // GLightbox (portfolio pages and front-page only)
    if ( is_front_page() || is_post_type_archive( 'project' ) ) {
        wp_enqueue_style(
            'glightbox',
            'https://cdn.jsdelivr.net/npm/glightbox@3/dist/css/glightbox.min.css',
            [],
            '3.3.0'
        );
        wp_enqueue_script(
            'glightbox',
            'https://cdn.jsdelivr.net/npm/glightbox@3/dist/js/glightbox.min.js',
            [],
            '3.3.0',
            true
        );
    }

    // Leaflet (front-page only, service area map)
    if ( is_front_page() ) {
        wp_enqueue_style(
            'leaflet',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
            [],
            '1.9.4'
        );
        wp_enqueue_script(
            'leaflet',
            'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
            [],
            '1.9.4',
            true
        );
    }

    // Main JS (depends on GLightbox and Leaflet when present)
    $deps = [ 'glightbox', 'leaflet' ];
    if ( ! is_front_page() && ! is_post_type_archive( 'project' ) ) {
        $deps = [];
    }
    wp_enqueue_script(
        'lomar-main',
        LOMAR_URI . '/assets/js/main.js',
        $deps,
        LOMAR_VERSION,
        true
    );

    wp_script_add_data( 'lomar-main', 'type', 'module' );
} );

// ── Favicon ────────────────────────────────────────────────────────────
add_action( 'wp_head', function (): void {
    echo '<link rel="icon" type="image/x-icon" href="' . esc_url( LOMAR_URI . '/assets/img/favicon.ico' ) . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url( LOMAR_URI . '/assets/img/apple-touch-icon.png' ) . '">' . "\n";
} );

// ── Portfolio CPT ──────────────────────────────────────────────────────
add_action( 'init', function (): void {
    register_post_type( 'project', [
        'labels' => [
            'name'               => __( 'Projects', 'lomar-gcg' ),
            'singular_name'      => __( 'Project', 'lomar-gcg' ),
            'add_new_item'       => __( 'Add New Project', 'lomar-gcg' ),
            'edit_item'          => __( 'Edit Project', 'lomar-gcg' ),
            'view_item'          => __( 'View Project', 'lomar-gcg' ),
            'all_items'          => __( 'All Projects', 'lomar-gcg' ),
            'search_items'       => __( 'Search Projects', 'lomar-gcg' ),
            'not_found'          => __( 'No projects found.', 'lomar-gcg' ),
            'not_found_in_trash' => __( 'No projects found in Trash.', 'lomar-gcg' ),
        ],
        'public'       => true,
        'has_archive'  => 'portfolio',
        'rewrite'      => [ 'slug' => 'portfolio' ],
        'supports'     => [ 'title', 'thumbnail' ],
        'menu_icon'    => 'dashicons-camera',
        'show_in_rest' => false,
    ] );
} );

// ── Flush rewrite rules on theme activation ────────────────────────────
add_action( 'after_switch_theme', function (): void {
    register_post_type( 'project', [] ); // triggers rewrite
    flush_rewrite_rules();
} );

// ── ACF JSON save/load path ────────────────────────────────────────────
add_filter( 'acf/settings/save_json', function (): string {
    return get_template_directory() . '/acf-json';
} );

add_filter( 'acf/settings/load_json', function ( array $paths ): array {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
} );

// ── Security headers ───────────────────────────────────────────────────
add_action( 'send_headers', function (): void {
    header( 'X-Frame-Options: SAMEORIGIN' );
    header( 'X-Content-Type-Options: nosniff' );
    header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
} );
```

- [ ] **Step 5: Syntax check**

```bash
php -l web/app/themes/lomar-gcg/functions.php
```

Expected: `No syntax errors detected`

- [ ] **Step 6: Activate theme**

```bash
wp theme activate lomar-gcg
```

Expected: `Switched to 'LoMar GCG' theme.`

- [ ] **Step 7: Verify theme loads**

Open `http://localhost:8083` — expect blank white page (no templates yet, no errors in PHP log).

---

## Task 4: CSS Design System

**Files:**
- Create: `web/app/themes/lomar-gcg/assets/css/style.css`

Port `design/styles.css` to the theme, removing SPA-specific classes.

- [ ] **Step 1: Copy base design system**

```bash
cp design/styles.css web/app/themes/lomar-gcg/assets/css/style.css
```

- [ ] **Step 2: Remove SPA-only rules**

Open `assets/css/style.css` and delete these blocks (they are SPA-specific, not needed in WordPress):
- `.page` / `[data-page]` rules (hash-based routing)
- `.lang-toggle` and `button.on` (bilingual toggle — English only)
- `[data-t-en]` / `[data-t-es]` visibility rules
- `.nav-links a.active` JS-toggled class (replace with WordPress `current-menu-item`)

Replace `.nav-links a.active::after` with:
```css
.nav-links .current-menu-item > a::after,
.nav-links .current_page_item > a::after {
  content: ""; position: absolute; left: 0; right: 0; bottom: -3px;
  height: 2px; background: var(--accent);
}
```

- [ ] **Step 3: Add architectural detail CSS**

Append to `assets/css/style.css`:
```css
/* ── Architectural aesthetic ─────────────────────────── */
--grid-line: oklch(0.895 0.008 86 / 0.55);

.hero::before {
  content: "";
  position: absolute; inset: 0;
  background-image:
    linear-gradient(var(--grid-line) 1px, transparent 1px),
    linear-gradient(90deg, var(--grid-line) 1px, transparent 1px);
  background-size: 48px 48px;
  pointer-events: none;
  z-index: 0;
}
.hero > * { position: relative; z-index: 1; }

.process {
  background-image: radial-gradient(
    circle,
    oklch(0.84 0.010 86 / .6) 1px,
    transparent 1px
  );
  background-size: 24px 24px;
}

/* Corner marks on hero media */
.hero-media::before,
.hero-media::after {
  content: "";
  position: absolute;
  width: 10px; height: 10px;
  border: 1px solid var(--bg);
  opacity: .5;
  z-index: 3;
}
.hero-media::before { top: 8px; left: 8px; border-right: none; border-bottom: none; }
.hero-media::after  { bottom: 8px; right: 8px; border-left: none; border-top: none; }

/* Sheet reference */
.sheet-ref {
  font-family: var(--font-mono);
  font-size: 9px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  opacity: .5;
}

/* ── Animations ──────────────────────────────────────── */
.fade-in {
  opacity: 0;
  transform: translateY(20px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}
.fade-in.is-visible {
  opacity: 1;
  transform: translateY(0);
}

/* ── Nav scroll state ────────────────────────────────── */
.nav.scrolled {
  padding-top: 0;
  padding-bottom: 0;
  box-shadow: var(--shadow-sm);
}
.nav.scrolled .nav-inner {
  padding-top: 12px;
  padding-bottom: 12px;
}

/* ── Mobile menu ─────────────────────────────────────── */
.mobile-menu {
  display: none;
  position: fixed; inset: 0; z-index: 200;
  background: var(--bg);
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: var(--sp-6);
}
.mobile-menu.open { display: flex; }
.mobile-menu .nav-links {
  flex-direction: column;
  font-size: var(--fs-xl);
  text-align: center;
}
.mobile-close {
  position: absolute; top: 20px; right: 20px;
  font-size: var(--fs-xl);
  padding: 10px;
}

/* ── Responsive ──────────────────────────────────────── */
@media (max-width: 900px) {
  .hero-grid { grid-template-columns: 1fr; }
  .hero-media { display: none; }
  .services-grid { grid-template-columns: 1fr 1fr; }
  .stats-grid { grid-template-columns: 1fr 1fr; }
  .process-grid { grid-template-columns: 1fr 1fr; }
  .section-head { grid-template-columns: 1fr; }
  .service-row { grid-template-columns: 1fr 2fr; }
  .service-row .num, .service-row .thumb-wrap { display: none; }
  .portfolio-grid { grid-template-columns: 1fr 1fr; }
  .pf-a, .pf-b, .pf-c, .pf-d, .pf-e, .pf-f, .pf-g { grid-column: span 1; aspect-ratio: 4/3; }
  .nav-links, .nav-cta { display: none; }
  .mobile-toggle { display: flex; }
}

@media (max-width: 600px) {
  .services-grid { grid-template-columns: 1fr; }
  .stats-grid { grid-template-columns: 1fr 1fr; }
  .process-grid { grid-template-columns: 1fr; }
  .portfolio-grid { grid-template-columns: 1fr; }
  .pf-a, .pf-b, .pf-c, .pf-d, .pf-e, .pf-f, .pf-g { grid-column: span 1; }
}
```

- [ ] **Step 4: Verify CSS loads**

```bash
wp theme activate lomar-gcg  # already active, just recheck
```

Open `http://localhost:8083` — browser devtools Network tab should show `style.css` loading with HTTP 200.

---

## Task 5: Header Template Part

**Files:**
- Create: `web/app/themes/lomar-gcg/template-parts/header.php`

- [ ] **Step 1: Create `template-parts/header.php`**

```php
<?php declare(strict_types=1); ?>
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
```

- [ ] **Step 2: Syntax check**

```bash
php -l web/app/themes/lomar-gcg/template-parts/header.php
```

Expected: `No syntax errors detected`

---

## Task 6: Footer Template Part

**Files:**
- Create: `web/app/themes/lomar-gcg/template-parts/footer.php`

- [ ] **Step 1: Create `template-parts/footer.php`**

```php
<?php declare(strict_types=1); ?>
</main>

<footer class="site" role="contentinfo">
  <div class="container">
    <div class="footer-inner">

      <div class="footer-brand">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'LoMar GCG home', 'lomar-gcg' ); ?>">
          <img
            src="<?php echo esc_url( LOMAR_URI . '/assets/img/logo-lomar-gcg.png' ); ?>"
            alt="<?php esc_attr_e( 'LoMar GCG', 'lomar-gcg' ); ?>"
            class="brand-logo"
            width="200"
            height="64"
            loading="lazy"
          >
        </a>
        <p class="footer-tagline"><?php esc_html_e( 'Full-service landscape contractor across Northern Virginia.', 'lomar-gcg' ); ?></p>
        <p class="sheet-ref">38°45′N 77°28′W · Est. 2004</p>
      </div>

      <nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer navigation', 'lomar-gcg' ); ?>">
        <ul>
          <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'lomar-gcg' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>"><?php esc_html_e( 'Portfolio', 'lomar-gcg' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'lomar-gcg' ); ?></a></li>
          <li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'lomar-gcg' ); ?></a></li>
        </ul>
      </nav>

      <div class="footer-contact">
        <p class="eyebrow"><?php esc_html_e( 'Get in touch', 'lomar-gcg' ); ?></p>
        <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary" style="margin-top: 16px;">
          <?php esc_html_e( 'Free Estimate →', 'lomar-gcg' ); ?>
        </a>
      </div>

    </div>

    <div class="footer-bottom">
      <p class="sheet-ref">
        © <?php echo esc_html( (string) gmdate( 'Y' ) ); ?> LoMar GCG ·
        <?php esc_html_e( 'Northern Virginia Landscape Contractor', 'lomar-gcg' ); ?>
      </p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
```

- [ ] **Step 2: Add footer CSS to `assets/css/style.css`**

Append:
```css
/* ── Footer ──────────────────────────────────────────── */
footer.site {
  background: var(--ink);
  color: var(--bg);
  padding: var(--sp-9) 0 var(--sp-6);
  border-top: 1px solid oklch(0.52 0.20 132 / 0.3);
}
.footer-inner {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr;
  gap: var(--sp-7);
  padding-bottom: var(--sp-7);
  border-bottom: 1px solid oklch(1 0 0 / 0.08);
}
.footer-tagline {
  color: color-mix(in oklab, var(--bg) 75%, var(--ink) 25%);
  font-size: var(--fs-sm);
  margin-top: var(--sp-4);
  max-width: 32ch;
}
footer.site .sheet-ref {
  color: color-mix(in oklab, var(--bg) 50%, var(--ink) 50%);
  margin-top: var(--sp-3);
}
.footer-nav ul { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: var(--sp-3); }
.footer-nav a { color: color-mix(in oklab, var(--bg) 75%, var(--ink) 25%); font-size: var(--fs-sm); transition: color .15s; }
.footer-nav a:hover { color: var(--bg); }
.footer-bottom { padding-top: var(--sp-5); }
.footer-bottom .sheet-ref { color: color-mix(in oklab, var(--bg) 40%, var(--ink) 60%); }

@media (max-width: 900px) {
  .footer-inner { grid-template-columns: 1fr 1fr; }
  .footer-brand { grid-column: span 2; }
}
@media (max-width: 600px) {
  .footer-inner { grid-template-columns: 1fr; }
  .footer-brand { grid-column: span 1; }
}
```

- [ ] **Step 3: Syntax check**

```bash
php -l web/app/themes/lomar-gcg/template-parts/footer.php
```

Expected: `No syntax errors detected`

---

## Task 7: Hero Template Part

**Files:**
- Create: `web/app/themes/lomar-gcg/template-parts/hero.php`

- [ ] **Step 1: Get a hero image**

The hero needs a landscape photo. Download a service image from lomar-gcg.com's homepage or use any high-quality landscape photo. Save as:
```bash
# If downloading from lomar-gcg.com, use curl:
curl -L "https://lomar-gcg.com/wp-content/uploads/hero.jpg" \
  -o web/app/themes/lomar-gcg/assets/img/hero.jpg
# Then convert to WebP:
cwebp web/app/themes/lomar-gcg/assets/img/hero.jpg \
  -o web/app/themes/lomar-gcg/assets/img/hero.webp -q 85
# If cwebp not installed: brew install webp
```

If no image is available, use a placeholder:
```bash
curl -L "https://picsum.photos/800/1000" \
  -o web/app/themes/lomar-gcg/assets/img/hero.webp
```

- [ ] **Step 2: Create `template-parts/hero.php`**

```php
<?php declare(strict_types=1); ?>
<section class="hero fade-in" aria-labelledby="hero-heading">
  <div class="container">
    <div class="hero-grid">

      <div class="hero-content">
        <p class="eyebrow"><?php esc_html_e( 'Landscape Design · Build · Maintain', 'lomar-gcg' ); ?></p>

        <h1 id="hero-heading">
          <?php esc_html_e( 'Landscapes that', 'lomar-gcg' ); ?><br>
          <em><?php esc_html_e( 'live with your home.', 'lomar-gcg' ); ?></em>
        </h1>

        <p class="hero-sub">
          <?php esc_html_e( 'LoMar GCG is a full-service landscape contractor serving Northern Virginia and the greater DMV area. Twenty years designing, building, and maintaining the region\'s finest outdoor spaces.', 'lomar-gcg' ); ?>
        </p>

        <div class="hero-ctas">
          <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-primary">
            <?php esc_html_e( 'Get a Free Estimate', 'lomar-gcg' ); ?>
            <span class="arrow" aria-hidden="true">→</span>
          </a>
          <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-ghost">
            <?php esc_html_e( 'See Our Work', 'lomar-gcg' ); ?>
          </a>
        </div>

        <div class="hero-meta">
          <div>
            <div class="n">20<em>+</em></div>
            <div class="l"><?php esc_html_e( 'Years', 'lomar-gcg' ); ?></div>
          </div>
          <div>
            <div class="n">400<em>+</em></div>
            <div class="l"><?php esc_html_e( 'Projects', 'lomar-gcg' ); ?></div>
          </div>
          <div>
            <div class="n">98<em>%</em></div>
            <div class="l"><?php esc_html_e( 'Referrals', 'lomar-gcg' ); ?></div>
          </div>
        </div>
      </div>

      <div class="hero-media">
        <img
          src="<?php echo esc_url( LOMAR_URI . '/assets/img/hero.webp' ); ?>"
          alt="<?php esc_attr_e( 'Beautifully landscaped Northern Virginia backyard', 'lomar-gcg' ); ?>"
          width="600"
          height="750"
          loading="eager"
          fetchpriority="high"
        >
        <div class="hero-badge">
          <span class="dot" aria-hidden="true"></span>
          <div>
            <div class="t"><?php esc_html_e( 'Currently accepting', 'lomar-gcg' ); ?></div>
            <div class="v"><?php esc_html_e( 'New projects', 'lomar-gcg' ); ?></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<div class="marquee" aria-hidden="true">
  <div class="marquee-track">
    <span>
      <?php esc_html_e( 'Garden Design', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Paver Patios', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Fire Pits', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Retaining Walls', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Outdoor Lighting', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Lawn Maintenance', 'lomar-gcg' ); ?> <span class="sep">✦</span>
    </span>
    <span aria-hidden="true">
      <?php esc_html_e( 'Garden Design', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Paver Patios', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Fire Pits', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Retaining Walls', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Outdoor Lighting', 'lomar-gcg' ); ?> <span class="sep">✦</span>
      <?php esc_html_e( 'Lawn Maintenance', 'lomar-gcg' ); ?> <span class="sep">✦</span>
    </span>
  </div>
</div>
```

- [ ] **Step 3: Syntax check**

```bash
php -l web/app/themes/lomar-gcg/template-parts/hero.php
```

Expected: `No syntax errors detected`

---

## Task 8: Services Template Part

**Files:**
- Create: `web/app/themes/lomar-gcg/template-parts/services.php`
- Create: `web/app/themes/lomar-gcg/assets/img/services/*.webp`

- [ ] **Step 1: Download service images from lomar-gcg.com**

```bash
# Visit https://lomar-gcg.com in a browser, right-click service images → Save As
# Or use curl to download from the live site's media library
# Save each as WebP at ~800x600px into assets/img/services/

# Placeholders if live images unavailable:
for name in paver-patios garden-design fire-pits retaining-walls maintenance; do
  curl -sL "https://picsum.photos/seed/${name}/800/600" \
    -o "web/app/themes/lomar-gcg/assets/img/services/${name}.webp"
done
```

- [ ] **Step 2: Create `template-parts/services.php`**

```php
<?php declare(strict_types=1); ?>
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
```

- [ ] **Step 3: Syntax check**

```bash
php -l web/app/themes/lomar-gcg/template-parts/services.php
```

Expected: `No syntax errors detected`

---

## Task 9: Process Template Part

**Files:**
- Create: `web/app/themes/lomar-gcg/template-parts/process.php`

- [ ] **Step 1: Create `template-parts/process.php`**

```php
<?php declare(strict_types=1); ?>
<section class="section process fade-in" aria-labelledby="process-heading">
  <div class="container">

    <div class="section-head">
      <div class="left">
        <p class="eyebrow"><?php esc_html_e( 'How We Work', 'lomar-gcg' ); ?></p>
        <h2 id="process-heading">
          <?php esc_html_e( 'From concept', 'lomar-gcg' ); ?><br>
          <em><?php esc_html_e( 'to completion.', 'lomar-gcg' ); ?></em>
        </h2>
      </div>
      <div class="right">
        <p><?php esc_html_e( 'Every project follows a clear, collaborative process — so you always know what to expect next.', 'lomar-gcg' ); ?></p>
      </div>
    </div>

    <div class="process-grid" role="list">

      <div class="step fade-in" role="listitem">
        <span class="num" aria-hidden="true">01</span>
        <h4><?php esc_html_e( 'Consult', 'lomar-gcg' ); ?></h4>
        <p><?php esc_html_e( 'We visit your property, discuss your goals and budget, and assess the site conditions.', 'lomar-gcg' ); ?></p>
      </div>

      <div class="step fade-in" role="listitem">
        <span class="num" aria-hidden="true">02</span>
        <h4><?php esc_html_e( 'Design', 'lomar-gcg' ); ?></h4>
        <p><?php esc_html_e( 'Our team creates a detailed plan with material selections, plant layouts, and a full cost estimate.', 'lomar-gcg' ); ?></p>
      </div>

      <div class="step fade-in" role="listitem">
        <span class="num" aria-hidden="true">03</span>
        <h4><?php esc_html_e( 'Build', 'lomar-gcg' ); ?></h4>
        <p><?php esc_html_e( 'Our experienced crews execute the project with craftsmanship and minimal disruption to your property.', 'lomar-gcg' ); ?></p>
      </div>

      <div class="step fade-in" role="listitem">
        <span class="num" aria-hidden="true">04</span>
        <h4><?php esc_html_e( 'Maintain', 'lomar-gcg' ); ?></h4>
        <p><?php esc_html_e( 'Optional seasonal maintenance plans keep your landscape thriving year after year.', 'lomar-gcg' ); ?></p>
      </div>

    </div>

  </div>
</section>
```

- [ ] **Step 2: Syntax check**

```bash
php -l web/app/themes/lomar-gcg/template-parts/process.php
```

Expected: `No syntax errors detected`

---

## Task 10: Portfolio CPT + ACF Fields

**Files:**
- Create: `web/app/themes/lomar-gcg/acf-json/group_project_fields.json`

- [ ] **Step 1: Create ACF field group JSON**

Create `web/app/themes/lomar-gcg/acf-json/group_project_fields.json`:

```json
{
  "key": "group_project_fields",
  "title": "Project Details",
  "fields": [
    {
      "key": "field_project_photos",
      "label": "Project Photos",
      "name": "project_photos",
      "type": "gallery",
      "min": 1,
      "max": 20,
      "preview_size": "medium",
      "return_format": "array",
      "instructions": "Add project photos. First image will be used as the grid thumbnail."
    },
    {
      "key": "field_project_service",
      "label": "Service Type",
      "name": "project_service",
      "type": "select",
      "choices": {
        "paver-patios": "Paver Patios",
        "garden-design": "Garden Design",
        "fire-pits": "Fire Pits",
        "retaining-walls": "Retaining Walls",
        "maintenance": "Maintenance",
        "other": "Other"
      },
      "default_value": "",
      "allow_null": 0,
      "return_format": "value"
    },
    {
      "key": "field_project_location",
      "label": "Location",
      "name": "project_location",
      "type": "text",
      "placeholder": "e.g. McLean, VA",
      "instructions": "City and state where the project was completed."
    }
  ],
  "location": [
    [
      {
        "param": "post_type",
        "operator": "==",
        "value": "project"
      }
    ]
  ],
  "active": true
}
```

- [ ] **Step 2: Sync ACF field group**

```bash
wp acf sync
```

Expected: `Synced group_project_fields`

If `wp acf sync` isn't available, go to **WP Admin → Custom Fields → Tools → Sync** and click Sync for the group.

- [ ] **Step 3: Verify fields appear**

```bash
wp post create --post_type=project --post_title="Test Project" --post_status=publish
wp post list --post_type=project
```

Expected: project created. Go to WP Admin → Projects → Test Project and verify three ACF fields appear: Photos, Service Type, Location.

---

## Task 11: Portfolio Grid Template Part

**Files:**
- Create: `web/app/themes/lomar-gcg/template-parts/portfolio-grid.php`
- Create: `web/app/themes/lomar-gcg/archive-project.php`

- [ ] **Step 1: Create `template-parts/portfolio-grid.php`**

This partial accepts `$args['limit']` (int, default 0 = all) and `$args['preview']` (bool, default false).

```php
<?php
declare(strict_types=1);

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
        $index++;
        continue;
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
```

- [ ] **Step 2: Create `archive-project.php`**

```php
<?php declare(strict_types=1); ?>
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
```

- [ ] **Step 3: Syntax check both files**

```bash
php -l web/app/themes/lomar-gcg/template-parts/portfolio-grid.php
php -l web/app/themes/lomar-gcg/archive-project.php
```

Expected: `No syntax errors detected` for both.

---

## Task 12: Contact Template Part + CF7 Setup

**Files:**
- Create: `web/app/themes/lomar-gcg/template-parts/contact.php`
- Create: `web/app/themes/lomar-gcg/assets/css/cf7-overrides.css`

- [ ] **Step 1: Create CF7 form in WordPress**

Go to **WP Admin → Contact → Add New**. Name it "Free Estimate Request". Use this template:

```
[text* your-name placeholder "Your Name"]
[email* your-email placeholder "Email Address"]
[tel your-phone placeholder "Phone (optional)"]
[select* service-interest "Select a Service" "Paver Patios" "Garden Design" "Fire Pits" "Retaining Walls" "Lawn Maintenance" "Other"]
[textarea your-message placeholder "Tell us about your project..."]
[submit "Send Request →"]
```

Mail tab — To: `vm.reyesal@gmail.com`, Subject: `New estimate request from [your-name]`.

Save the form. Note its **shortcode ID** (e.g., `[contact-form-7 id="123" title="Free Estimate Request"]`).

- [ ] **Step 2: Get CF7 shortcode ID**

```bash
wp post list --post_type=wpcf7_contact_form --fields=ID,post_title
```

Note the ID number. Replace `FORM_ID` in the next step.

- [ ] **Step 3: Create `template-parts/contact.php`**

Replace `FORM_ID` with the actual ID from Step 2:

```php
<?php declare(strict_types=1);
$form_id = apply_filters( 'lomar_contact_form_id', FORM_ID );
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
```

- [ ] **Step 4: Add contact layout CSS to `assets/css/style.css`**

Append:
```css
/* ── Contact section ─────────────────────────────────── */
.contact-layout {
  display: grid;
  grid-template-columns: 3fr 2fr;
  gap: var(--sp-9);
  align-items: start;
}
@media (max-width: 900px) {
  .contact-layout { grid-template-columns: 1fr; gap: var(--sp-6); }
}
```

- [ ] **Step 5: Create `assets/css/cf7-overrides.css`**

```css
/* CF7 overrides — matches LoMar GCG design system */
.wpcf7 form { font-family: var(--font-body); }
.wpcf7 .wpcf7-form-control-wrap { display: block; width: 100%; margin-bottom: var(--sp-4); }
.wpcf7 input[type="text"],
.wpcf7 input[type="email"],
.wpcf7 input[type="tel"],
.wpcf7 select,
.wpcf7 textarea {
  width: 100%;
  padding: 14px 16px;
  background: var(--bg-2);
  border: 1px solid var(--line);
  border-radius: var(--radius);
  color: var(--ink);
  font-family: var(--font-body);
  font-size: var(--fs-base);
  transition: border-color .2s;
  outline: none;
}
.wpcf7 input:focus,
.wpcf7 select:focus,
.wpcf7 textarea:focus { border-color: var(--accent); }
.wpcf7 textarea { min-height: 120px; resize: vertical; }
.wpcf7 input[type="submit"] {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 16px 24px;
  background: var(--accent);
  color: var(--accent-ink);
  border: none;
  border-radius: var(--radius);
  font-size: var(--fs-sm);
  font-weight: 500;
  letter-spacing: 0.02em;
  cursor: pointer;
  transition: filter .2s, transform .18s;
}
.wpcf7 input[type="submit"]:hover { filter: brightness(1.08); transform: translateY(-1px); }
.wpcf7 .wpcf7-not-valid-tip { color: oklch(0.55 0.22 28); font-size: var(--fs-xs); margin-top: 4px; }
.wpcf7 .wpcf7-response-output {
  margin: var(--sp-4) 0 0;
  padding: var(--sp-3) var(--sp-4);
  border-radius: var(--radius);
  font-size: var(--fs-sm);
  border: 1px solid var(--line);
}
.wpcf7 .wpcf7-mail-sent-ok { border-color: var(--accent); background: color-mix(in oklab, var(--accent) 8%, transparent); }
.wpcf7 .wpcf7-validation-errors { border-color: oklch(0.55 0.22 28); }
```

- [ ] **Step 6: Syntax check**

```bash
php -l web/app/themes/lomar-gcg/template-parts/contact.php
```

Expected: `No syntax errors detected`

---

## Task 13: Service Area Map

**Files:**
- Modify: `web/app/themes/lomar-gcg/template-parts/contact.php`

The map goes between the section header and the contact form layout.

- [ ] **Step 1: Add map HTML to `template-parts/contact.php`**

After the closing `</div>` of `section-head` and before `<div class="contact-layout">`, insert:

```php
    <div class="map-wrap fade-in" style="margin-bottom: var(--sp-7);">
      <div id="service-map" aria-label="<?php esc_attr_e( 'LoMar GCG service area map — Northern Virginia', 'lomar-gcg' ); ?>" role="img" style="height: 400px;"></div>
    </div>
```

- [ ] **Step 2: Add map initialization to `assets/js/main.js`** (see Task 14 — map init is part of main.js)

The map code lives in `main.js`. This task just confirms the DOM element is present.

---

## Task 14: JavaScript — `main.js`

**Files:**
- Create: `web/app/themes/lomar-gcg/assets/js/main.js`

- [ ] **Step 1: Create `assets/js/main.js`**

```js
/** @type {module} LoMar GCG — main.js */

// ── Nav scroll behavior ────────────────────────────────────────────────
const initNavScroll = () => {
  const nav = document.getElementById('site-nav');
  if (!nav) return;

  const onScroll = () => {
    nav.classList.toggle('scrolled', window.scrollY > 60);
  };

  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll(); // run once on load
};

// ── Mobile menu ────────────────────────────────────────────────────────
const initMobileMenu = () => {
  const toggle = document.querySelector('.mobile-toggle');
  const menu   = document.getElementById('mobile-menu');
  const close  = document.querySelector('.mobile-close');

  if (!toggle || !menu) return;

  const open = () => {
    menu.classList.add('open');
    toggle.setAttribute('aria-expanded', 'true');
    menu.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
  };

  const closeMenu = () => {
    menu.classList.remove('open');
    toggle.setAttribute('aria-expanded', 'false');
    menu.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
  };

  toggle.addEventListener('click', open);
  close?.addEventListener('click', closeMenu);

  // Close on ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && menu.classList.contains('open')) closeMenu();
  });
};

// ── Fade-in on scroll (IntersectionObserver) ───────────────────────────
const initFadeIn = () => {
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target); // fire once
        }
      });
    },
    { threshold: 0.12 }
  );

  document.querySelectorAll('.fade-in').forEach((el) => observer.observe(el));
};

// ── Hero parallax ──────────────────────────────────────────────────────
const initParallax = () => {
  const heroMedia = document.querySelector('.hero-media img');
  if (!heroMedia) return;

  // Disable on mobile
  const mq = window.matchMedia('(max-width: 900px)');
  if (mq.matches) return;

  window.addEventListener('scroll', () => {
    const offset = window.scrollY * 0.2;
    heroMedia.style.transform = `translateY(${offset}px)`;
  }, { passive: true });
};

// ── GLightbox ─────────────────────────────────────────────────────────
const initLightbox = () => {
  if (typeof GLightbox === 'undefined') return;

  GLightbox({
    selector: '.glightbox',
    touchNavigation: true,
    loop: true,
    autoplayVideos: false,
  });
};

// ── Leaflet service area map ───────────────────────────────────────────
const initMap = () => {
  const mapEl = document.getElementById('service-map');
  if (!mapEl || typeof L === 'undefined') return;

  const map = L.map('service-map', {
    center: [38.9, -77.3],
    zoom: 9,
    scrollWheelZoom: false,
    zoomControl: true,
  });

  // CartoDB Positron tiles — minimal, matches Studio Green palette
  L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 19,
  }).addTo(map);

  // Northern Virginia service area polygon
  // Approximate boundary: Loudoun · Fairfax · Prince William · Arlington · Alexandria
  const serviceArea = L.polygon(
    [
      [39.32, -77.73], // NW Loudoun
      [39.32, -77.10], // NE
      [38.95, -77.07], // Arlington/Alexandria
      [38.58, -77.16], // SE Prince William
      [38.55, -77.68], // SW
      [39.02, -77.88], // W Loudoun
    ],
    {
      color: 'oklch(0.52 0.20 132)',
      fillColor: 'oklch(0.52 0.20 132)',
      fillOpacity: 0.12,
      weight: 2,
      opacity: 0.7,
    }
  ).addTo(map);

  // Custom marker for company location
  const icon = L.divIcon({
    html: `<div style="
      width:36px;height:36px;
      background:oklch(0.52 0.20 132);
      border-radius:50% 50% 50% 0;
      transform:rotate(-45deg);
      border:3px solid white;
      box-shadow:0 2px 8px rgba(0,0,0,.25);
    "></div>`,
    iconSize: [36, 36],
    iconAnchor: [18, 36],
    className: '',
  });

  L.marker([38.87, -77.37], { icon })
    .addTo(map)
    .bindPopup('<strong>LoMar GCG</strong><br>Northern Virginia')
    .openPopup();
};

// ── Init all ──────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  initNavScroll();
  initMobileMenu();
  initFadeIn();
  initParallax();
  initLightbox();
  initMap();
});
```

- [ ] **Step 2: Verify no syntax errors via browser devtools**

Open `http://localhost:8083` — browser console should show zero JS errors.

---

## Task 15: Front Page + Remaining Templates

**Files:**
- Create: `web/app/themes/lomar-gcg/front-page.php`
- Create: `web/app/themes/lomar-gcg/page.php`
- Create: `web/app/themes/lomar-gcg/404.php`

- [ ] **Step 1: Create `front-page.php`**

```php
<?php declare(strict_types=1); ?>
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
```

- [ ] **Step 2: Create `page.php`**

```php
<?php declare(strict_types=1); ?>
<?php get_template_part( 'template-parts/header' ); ?>

<section class="section page-content" aria-labelledby="page-title">
  <div class="container" style="max-width: 860px;">
    <?php while ( have_posts() ) : the_post(); ?>
      <h1 id="page-title" class="fade-in"><?php the_title(); ?></h1>
      <div class="page-body fade-in" style="margin-top: var(--sp-6); color: var(--ink-2); font-size: var(--fs-md); line-height: 1.7;">
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>
  </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
```

- [ ] **Step 3: Create `404.php`**

```php
<?php declare(strict_types=1); ?>
<?php get_template_part( 'template-parts/header' ); ?>

<section class="section" style="min-height: 60vh; display:flex; align-items:center;">
  <div class="container" style="text-align:center;">
    <p class="eyebrow"><?php esc_html_e( 'Error 404', 'lomar-gcg' ); ?></p>
    <h1 style="margin-top: var(--sp-4);">
      <?php esc_html_e( 'Page not', 'lomar-gcg' ); ?><br>
      <em><?php esc_html_e( 'found.', 'lomar-gcg' ); ?></em>
    </h1>
    <p style="margin-top: var(--sp-5); color: var(--ink-2);">
      <?php esc_html_e( "The page you're looking for doesn't exist.", 'lomar-gcg' ); ?>
    </p>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary" style="margin-top: var(--sp-6);">
      <?php esc_html_e( '← Back to Home', 'lomar-gcg' ); ?>
    </a>
  </div>
</section>

<?php get_template_part( 'template-parts/footer' ); ?>
```

- [ ] **Step 4: Syntax check all three**

```bash
php -l web/app/themes/lomar-gcg/front-page.php
php -l web/app/themes/lomar-gcg/page.php
php -l web/app/themes/lomar-gcg/404.php
```

Expected: `No syntax errors detected` for all.

---

## Task 16: Logo + Favicon Assets

**Files:**
- Create: `web/app/themes/lomar-gcg/assets/img/logo-lomar-gcg.png`
- Create: `web/app/themes/lomar-gcg/assets/img/favicon.ico`
- Create: `web/app/themes/lomar-gcg/assets/img/apple-touch-icon.png`

- [ ] **Step 1: Copy logo from design/**

```bash
cp design/logo-lomar-gcg.png web/app/themes/lomar-gcg/assets/img/logo-lomar-gcg.png
```

- [ ] **Step 2: Generate favicon and apple-touch-icon**

If `convert` (ImageMagick) is available:
```bash
convert design/logo-lomar-gcg.png \
  -resize 32x32 \
  web/app/themes/lomar-gcg/assets/img/favicon.ico

convert design/logo-lomar-gcg.png \
  -resize 180x180 \
  web/app/themes/lomar-gcg/assets/img/apple-touch-icon.png
```

If ImageMagick is not installed:
```bash
brew install imagemagick
```

Or use an online favicon generator (upload `design/logo-lomar-gcg.png`) and save the outputs to `assets/img/`.

---

## Task 17: WordPress Content Setup

- [ ] **Step 1: Create required pages**

```bash
wp post create --post_type=page --post_title="Home" --post_status=publish --post_name="home"
wp post create --post_type=page --post_title="Portfolio" --post_status=publish --post_name="portfolio"
wp post create --post_type=page --post_title="Contact" --post_status=publish --post_name="contact"
wp post create --post_type=page --post_title="Privacy Policy" --post_status=publish --post_name="privacy-policy"
```

- [ ] **Step 2: Set front page to "Home"**

```bash
wp option update show_on_front page
FRONT_ID=$(wp post list --post_type=page --post_status=publish --name="home" --field=ID)
wp option update page_on_front $FRONT_ID
```

- [ ] **Step 3: Set portfolio page**

```bash
PORTFOLIO_ID=$(wp post list --post_type=page --post_status=publish --name="portfolio" --field=ID)
wp option update page_for_posts 0
```

The `archive-project.php` template is used automatically by WordPress for the `project` CPT archive at `/portfolio`.

- [ ] **Step 4: Set permalink structure**

```bash
wp rewrite structure '/%postname%/' --hard
wp rewrite flush --hard
```

- [ ] **Step 5: Create primary nav menu**

```bash
wp menu create "Primary"
wp menu item add-custom "Primary" "Home" "http://localhost:8083/"
wp menu item add-custom "Primary" "Portfolio" "http://localhost:8083/portfolio"
wp menu item add-custom "Primary" "Contact" "http://localhost:8083/contact"
wp menu location assign "Primary" primary
```

- [ ] **Step 6: Add CF7 shortcode to Contact page**

```bash
CF7_ID=$(wp post list --post_type=wpcf7_contact_form --field=ID --posts-per-page=1)
CONTACT_ID=$(wp post list --post_type=page --post_status=publish --name="contact" --field=ID)
wp post update $CONTACT_ID --post_content="[contact-form-7 id=\"$CF7_ID\" title=\"Free Estimate Request\"]"
```

- [ ] **Step 7: Add sample portfolio projects**

Go to **WP Admin → Projects → Add New**. Create 6+ projects with:
- Title: e.g. "McLean Paver Patio"
- Photos: upload 2-3 project photos
- Service Type: select from dropdown
- Location: city, state

Alternatively, download project photos from `https://lomar-gcg.com/portfolio` if accessible.

- [ ] **Step 8: Verify homepage**

Open `http://localhost:8083` — expect full homepage with hero, services, stats, process, portfolio preview, and contact sections.

---

## Task 18: RankMath SEO Configuration

- [ ] **Step 1: Run RankMath setup wizard**

Go to **WP Admin → Rank Math → Setup Wizard**. Select:
- Website type: Local Business
- Business type: Landscape Architect
- Business name: LoMar GCG
- Address: (use the business address)
- Enable: XML Sitemap, Open Graph, Twitter Cards

- [ ] **Step 2: Enable LocalBusiness schema**

Go to **Rank Math → Titles & Meta → Local SEO**.
- Business Name: LoMar GCG
- Business Type: LandscapeArchitect
- Phone: (business phone)
- Address fields: fill in
- Opening hours: set business hours
- Service areas: Northern Virginia, DMV

- [ ] **Step 3: Submit sitemap to Google Search Console**

After Site Kit is connected (Task 19), go to **Search Console → Sitemaps**.
Submit: `https://lomar-gcg.com/sitemap_index.xml`

---

## Task 19: Google Site Kit Configuration

- [ ] **Step 1: Connect Site Kit**

Go to **WP Admin → Site Kit → Start Setup**.
Sign in with `vm.reyesal@gmail.com` Google account.
Connect: Google Analytics 4, Google Search Console.

- [ ] **Step 2: Verify GA4 tracking**

After connection, Site Kit shows a green checkmark. Visit `http://localhost:8083` — GA4 DebugView (in Google Analytics) should show a pageview event within 30 seconds.

Note: On production, GA4 will track real visitors. On local dev, the GA4 ID will be set but events may not fire if the domain doesn't match.

---

## Task 20: Production Deployment Prep

- [ ] **Step 1: Update `.env` for production**

Create a `.env.production` (not committed to git) with:
```ini
DB_NAME=u320060676_lomar-gcg
DB_USER=u320060676_rm
DB_PASSWORD=pD0!A|Ee@
DB_HOST=localhost

WP_ENV=production
WP_HOME=https://lomar-gcg.com
WP_SITEURL=${WP_HOME}/wp

WP_REDIS_DISABLED=false
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

- [ ] **Step 2: Enable Redis Object Cache on production**

After deploying, in WP Admin → Settings → Redis:
Click **Enable Object Cache**.

Verify: Redis status shows "Connected".

- [ ] **Step 3: Set Hostinger PHP version**

In Hostinger hPanel → PHP Configuration:
- PHP version: 8.2
- Extensions: enable `redis`, `mbstring`, `zip`, `opcache`

- [ ] **Step 4: Configure nginx/Apache rewrite rules**

Bedrock requires WordPress to run from `web/` subdirectory. In Hostinger, set document root to `web/`.

If using `.htaccess`, Bedrock's `web/.htaccess` already handles WP rewrites. Verify it's present:
```bash
cat web/.htaccess
```

Expected: contains `RewriteBase /` and WordPress rewrite rules.

---

## Self-Review Notes

- **Spec coverage:** All spec sections covered — visual identity (CSS task 4), file structure (tasks 3–15), pages (tasks 15, 17), portfolio CPT (tasks 10–11), CF7 (task 12), animations (CSS + JS tasks 4, 14), dependencies (tasks 2, 14), SEO (tasks 18–19), Redis (tasks 1, 20).
- **No placeholders:** `FORM_ID` in task 12 is intentional — it's resolved at setup time via `wp post list` and replaced with the actual ID. Flagged with a comment.
- **Type consistency:** `portfolio-grid.php` passes `$args['limit']` as int, `front-page.php` passes `'limit' => 6` and `'limit' => 0` — consistent. `get_field()` returns `mixed` — handled with `empty()` guard and `array_map` type annotation.
- **Security:** All output escaped with `esc_html()`, `esc_url()`, `esc_attr()`. `do_shortcode()` wraps a controlled shortcode with `absint()` on the ID. Security headers registered in `functions.php`.
