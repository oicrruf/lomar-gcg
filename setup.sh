#!/bin/bash
# WP-CLI Setup Script for LoMar GCG
set -e

APP=lomar-gcg-app
# Install WP-CLI into the volume so it survives container restarts
WP="php /var/www/html/wp.phar --allow-root"

echo "Installing WP-CLI..."
docker exec -i $APP sh -c "curl -sS https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /var/www/html/wp.phar && chmod +x /var/www/html/wp.phar"

echo "Activating plugins..."
docker exec -i $APP php -r "
chdir('/var/www/html');
require '/var/www/html/web/wp/wp-load.php';
foreach (['advanced-custom-fields/acf.php', 'contact-form-7/wp-contact-form-7.php', 'simple-page-ordering/simple-page-ordering.php'] as \$plugin) {
    if (file_exists(WP_PLUGIN_DIR . '/' . \$plugin)) {
        \$r = activate_plugin(\$plugin);
        echo (is_wp_error(\$r) ? 'SKIP ' : 'OK   ') . \$plugin . PHP_EOL;
    } else {
        echo 'MISSING ' . \$plugin . PHP_EOL;
    }
}
"

echo "Setting up WordPress pages..."
HOME_ID=$(docker exec -i $APP $WP post create --post_type=page --post_title="Home" --post_status=publish --porcelain)
PORTFOLIO_ID=$(docker exec -i $APP $WP post create --post_type=page --post_title="Portfolio" --post_status=publish --porcelain)
CONTACT_ID=$(docker exec -i $APP $WP post create --post_type=page --post_title="Contact" --post_status=publish --porcelain)

echo "Setting Front Page..."
docker exec -i $APP $WP option update show_on_front page
docker exec -i $APP $WP option update page_on_front $HOME_ID

echo "Creating and Assigning Menus..."
MENU_ID=$(docker exec -i $APP $WP menu create "Primary Navigation" --porcelain)
docker exec -i $APP $WP menu item add-post $MENU_ID $HOME_ID
docker exec -i $APP $WP menu item add-post $MENU_ID $PORTFOLIO_ID
docker exec -i $APP $WP menu item add-post $MENU_ID $CONTACT_ID
docker exec -i $APP $WP menu location assign $MENU_ID primary

echo "Creating Dummy Portfolio Projects..."
PROJECT1_ID=$(docker exec -i $APP $WP post create --post_type=project --post_title="Fairfax Garden Oasis" --post_status=publish --porcelain)
docker exec -i $APP $WP post meta add $PROJECT1_ID project_service "garden-design"
docker exec -i $APP $WP post meta add $PROJECT1_ID project_location "Fairfax, VA"

PROJECT2_ID=$(docker exec -i $APP $WP post create --post_type=project --post_title="Loudoun Stone Patio" --post_status=publish --porcelain)
docker exec -i $APP $WP post meta add $PROJECT2_ID project_service "paver-patios"
docker exec -i $APP $WP post meta add $PROJECT2_ID project_location "Loudoun, VA"

PROJECT3_ID=$(docker exec -i $APP $WP post create --post_type=project --post_title="Arlington Fire Pit" --post_status=publish --porcelain)
docker exec -i $APP $WP post meta add $PROJECT3_ID project_service "fire-pits"
docker exec -i $APP $WP post meta add $PROJECT3_ID project_location "Arlington, VA"

echo "Creating Contact Form 7 form..."
docker exec -i $APP php -r "
chdir('/var/www/html');
require '/var/www/html/web/wp/wp-load.php';

// Skip if form already exists
\$existing = get_option('lomar_contact_form_id', 0);
if (\$existing && get_post(\$existing)) {
    echo 'CF7 form already exists (ID=' . \$existing . '), skipping.' . PHP_EOL;
    exit;
}

\$form_body = '[text* your-name placeholder \"Full Name\"]
[email* your-email placeholder \"Email Address\"]
[tel your-phone placeholder \"Phone Number (optional)\"]
[select project-service \"Garden Design\" \"Paver Patios &amp; Walkways\" \"Fire Pits\" \"Retaining Walls\" \"Outdoor Lighting\" \"Lawn Maintenance\" \"Other\"]
[textarea your-message rows:5 placeholder \"Tell us about your project and timeline\"]
[submit \"Request Free Estimate\"]';

\$form_id = wp_insert_post([
    'post_type'   => 'wpcf7_contact_form',
    'post_title'  => 'Free Estimate Request',
    'post_status' => 'publish',
    'post_name'   => 'free-estimate-request',
]);

if (is_wp_error(\$form_id)) {
    echo 'Error creating CF7 form: ' . \$form_id->get_error_message() . PHP_EOL;
    exit(1);
}

update_post_meta(\$form_id, '_form', \$form_body);
update_post_meta(\$form_id, '_mail', [
    'subject'            => 'Free Estimate Request — LoMar GCG',
    'sender'             => 'LoMar GCG <' . get_option('admin_email') . '>',
    'recipient'          => get_option('admin_email'),
    'body'               => \"Name: [your-name]\nEmail: [your-email]\nPhone: [your-phone]\nService: [project-service]\n\nMessage:\n[your-message]\",
    'additional_headers' => 'Reply-To: [your-email]',
    'attachments'        => '',
    'use_html'           => 0,
    'exclude_blank'      => 0,
]);
update_post_meta(\$form_id, '_mail_2', ['active' => false, 'subject' => '', 'sender' => '', 'recipient' => '', 'body' => '', 'additional_headers' => '', 'attachments' => '', 'use_html' => 0, 'exclude_blank' => 0]);
update_post_meta(\$form_id, '_messages', []);
update_post_meta(\$form_id, '_additional_settings', '');
update_option('lomar_contact_form_id', \$form_id);

echo 'CF7 form created (ID=' . \$form_id . ')' . PHP_EOL;
"

echo "Setup Complete! Open http://localhost:8083 in your browser."
