<?php
if (!defined('ABSPATH')) exit;

class TS_Team_Showcase_Shortcode {

    public function __construct() {
        add_shortcode('team_showcase', [$this, 'render_shortcode']);
    }

    public function render_shortcode() {

        $role = isset($_GET['role']) ? sanitize_text_field($_GET['role']) : null;

        $query = TS_Team_Query::get_team_members($role);

        ob_start();

        if ($query->have_posts()) {
            include TS_PLUGIN_PATH . 'templates/team-showcase-grid.php';
        } else {
            echo '<p>No team members found.</p>';
        }

        wp_reset_postdata();

        return ob_get_clean();
    }
}