<?php



define('LOMAR_VERSION', wp_get_theme()->get('Version'));
define('LOMAR_URI', get_template_directory_uri());

// ── Theme support ──────────────────────────────────────────────────────
add_action('after_setup_theme', function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo');

    register_nav_menus([
        'primary' => __('Primary Navigation', 'lomar-gcg'),
    ]);
});

// ── Google Fonts — non-blocking via preload ────────────────────────────
add_action('wp_head', function (): void {
    $fonts_url = 'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;1,9..144,400;1,9..144,500&family=Inter:wght@400;500&family=JetBrains+Mono:wght@400;500&display=swap';
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="preload" as="style" href="' . esc_url($fonts_url) . '" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    echo '<noscript><link rel="stylesheet" href="' . esc_url($fonts_url) . '"></noscript>' . "\n";
}, 2);

// ── Enqueue assets ─────────────────────────────────────────────────────
add_action('wp_enqueue_scripts', function (): void {

    // Design system CSS — local, no external deps
    wp_enqueue_style('lomar-style', LOMAR_URI . '/assets/css/style.css', [], LOMAR_VERSION);

    // CF7 style overrides (only when CF7 is active)
    if (function_exists('wpcf7')) {
        wp_enqueue_style('lomar-cf7', LOMAR_URI . '/assets/css/cf7-overrides.css', ['lomar-style'], LOMAR_VERSION);
    }

    // GLightbox — local copy, no CDN
    if (is_front_page() || is_post_type_archive('project')) {
        wp_enqueue_style('glightbox', LOMAR_URI . '/assets/css/glightbox.min.css', [], '3.3.0');
        // wp_enqueue_script( 'glightbox', 'https://cdn.jsdelivr.net/npm/glightbox@3/dist/js/glightbox.min.js', [], '3.3.0', true );
    }

    // Leaflet — local CSS, deferred JS
    if (is_front_page()) {
        wp_enqueue_style('leaflet', LOMAR_URI . '/assets/css/leaflet.css', [], '1.9.4');
        wp_enqueue_script('leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', [], '1.9.4', true);
    }

    // Main JS
    wp_enqueue_script('lomar-main', LOMAR_URI . '/assets/js/main.js', [], LOMAR_VERSION, true);
});

// ── Defer CDN scripts so they never block DOMContentLoaded ─────────────
add_filter('script_loader_tag', function (string $tag, string $handle): string {
    if (in_array($handle, ['glightbox', 'leaflet'], true)) {
        return str_replace('<script ', '<script defer ', $tag);
    }
    return $tag;
}, 10, 2);

// ── Favicon ────────────────────────────────────────────────────────────
add_action('wp_head', function (): void {
    echo '<link rel="icon" type="image/x-icon" href="' . esc_url(LOMAR_URI . '/assets/img/favicon.ico') . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url(LOMAR_URI . '/assets/img/apple-touch-icon.png') . '">' . "\n";
});

// ── Portfolio CPT ──────────────────────────────────────────────────────
add_action('init', function (): void {
    register_post_type('project', [
        'labels' => [
            'name' => __('Projects', 'lomar-gcg'),
            'singular_name' => __('Project', 'lomar-gcg'),
            'add_new_item' => __('Add New Project', 'lomar-gcg'),
            'edit_item' => __('Edit Project', 'lomar-gcg'),
            'view_item' => __('View Project', 'lomar-gcg'),
            'all_items' => __('All Projects', 'lomar-gcg'),
            'search_items' => __('Search Projects', 'lomar-gcg'),
            'not_found' => __('No projects found.', 'lomar-gcg'),
            'not_found_in_trash' => __('No projects found in Trash.', 'lomar-gcg'),
        ],
        'public' => true,
        'has_archive' => 'portfolio',
        'rewrite' => ['slug' => 'portfolio'],
        'supports' => ['title', 'thumbnail'],
        'menu_icon' => 'dashicons-camera',
        'show_in_rest' => false,
    ]);
});

// ── Flush rewrite rules on theme activation ────────────────────────────
add_action('after_switch_theme', function (): void {
    register_post_type('project', []); // triggers rewrite
    flush_rewrite_rules();
});

// ── ACF JSON save/load path ────────────────────────────────────────────
add_filter('acf/settings/save_json', function (): string {
    return get_template_directory() . '/acf-json';
});

add_filter('acf/settings/load_json', function (array $paths): array {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
});

// ── Contact form ID ────────────────────────────────────────────────────
add_filter('lomar_contact_form_id', function (): int {
    return (int) get_option('lomar_contact_form_id', 0);
});

// ── Security headers ───────────────────────────────────────────────────
add_action('send_headers', function (): void {
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
});
