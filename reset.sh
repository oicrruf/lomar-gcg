#!/bin/bash
# Reset WordPress content and re-run setup for LoMar GCG
set -e

APP=lomar-gcg-app

echo "=== Resetting WordPress content ==="
docker exec -i $APP php -r "
chdir('/var/www/html');
require '/var/www/html/web/wp/wp-load.php';

// Remove pages
\$pages = get_posts(['post_type' => 'page', 'post_status' => 'any', 'numberposts' => -1]);
foreach (\$pages as \$p) { wp_delete_post(\$p->ID, true); }
echo 'Pages deleted: ' . count(\$pages) . PHP_EOL;

// Remove projects
\$projects = get_posts(['post_type' => 'project', 'post_status' => 'any', 'numberposts' => -1]);
foreach (\$projects as \$p) { wp_delete_post(\$p->ID, true); }
echo 'Projects deleted: ' . count(\$projects) . PHP_EOL;

// Remove menus
foreach (wp_get_nav_menus() as \$menu) { wp_delete_nav_menu(\$menu->term_id); }
echo 'Menus deleted' . PHP_EOL;

// Remove CF7 forms
\$forms = get_posts(['post_type' => 'wpcf7_contact_form', 'post_status' => 'any', 'numberposts' => -1]);
foreach (\$forms as \$f) { wp_delete_post(\$f->ID, true); }
delete_option('lomar_contact_form_id');
echo 'CF7 forms deleted: ' . count(\$forms) . PHP_EOL;

// Reset front page
delete_option('show_on_front');
delete_option('page_on_front');

echo 'Reset complete.' . PHP_EOL;
"

echo ""
echo "=== Running setup ==="
bash "$(dirname "$0")/setup.sh"
