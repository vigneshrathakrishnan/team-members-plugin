<?php
/**
 * Plugin Name: Team Showcase
 * Description: Team Showcase plugin with CPT, shortcode, REST API, and SEO features.
 * Version: 1.0.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit;
}

define('TS_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('TS_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once TS_PLUGIN_PATH . 'includes/class-team-member-post-type.php';
require_once TS_PLUGIN_PATH . 'includes/class-team-member-meta.php';
require_once TS_PLUGIN_PATH . 'includes/class-team-query.php';
require_once TS_PLUGIN_PATH . 'includes/class-team-showcase-shortcode.php';
require_once TS_PLUGIN_PATH . 'includes/class-team-rest-controller.php';

class Team_Showcase_Plugin {

    public function __construct() {
        new TS_Team_Member_Post_Type();
        new TS_Team_Member_Meta();
        new TS_Team_Showcase_Shortcode();
        new TS_Team_REST_Controller();

        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_head', [$this, 'output_structured_data']);
        add_action('wp_head', [$this, 'handle_noindex_for_filters'], 1);
    }

    public function enqueue_assets() {
        wp_enqueue_style('team-showcase', TS_PLUGIN_URL . 'assets/css/team-showcase.css');
        wp_enqueue_script('team-showcase', TS_PLUGIN_URL . 'assets/js/team-showcase.js', [], false, true);
    }

    public function output_structured_data() {
        if (is_singular('team_member')) {
            global $post;

            $role = get_post_meta($post->ID, '_ts_role', true);
            $image = get_the_post_thumbnail_url($post->ID, 'full');

            $data = [
                "@context" => "https://schema.org",
                "@type" => "Person",
                "name" => get_the_title($post),
                "jobTitle" => $role,
                "description" => wp_strip_all_tags(get_the_content(null, false, $post)),
                "image" => $image,
                "url" => get_permalink($post)
            ];

            echo '<script type="application/ld+json">' . wp_json_encode($data) . '</script>';
        }
    }

    public function handle_noindex_for_filters() {
        if (isset($_GET['role'])) {
            echo '<meta name="robots" content="noindex, follow">';
        }
    }
}

new Team_Showcase_Plugin();