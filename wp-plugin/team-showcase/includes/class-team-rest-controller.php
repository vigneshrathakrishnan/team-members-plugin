<?php
if (!defined('ABSPATH')) exit;

class TS_Team_REST_Controller {

    public function __construct() {
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() {

        register_rest_route('2creative/v1', '/team-members', [
            'methods' => 'GET',
            'callback' => [$this, 'get_all_members'],
            'permission_callback' => '__return_true'
        ]);

        register_rest_route('2creative/v1', '/team-members/(?P<id>\d+)', [
            'methods' => 'GET',
            'callback' => [$this, 'get_single_member'],
            'permission_callback' => '__return_true',
            'args' => [
                'id' => [
                    'validate_callback' => function($param) {
                        return is_numeric($param);
                    }
                ]
            ]
        ]);
    }

    public function get_all_members() {

        $query = TS_Team_Query::get_team_members();

        $data = [];

        while ($query->have_posts()) {
            $query->the_post();

            $data[] = $this->format_member(get_the_ID());
        }

        wp_reset_postdata();

        return rest_ensure_response($data);
    }

    public function get_single_member($request) {

        $id = (int) $request['id'];

        if (!get_post($id) || get_post_type($id) !== 'team_member') {
            return new WP_Error('not_found', 'Team member not found', ['status' => 404]);
        }

        return rest_ensure_response($this->format_member($id));
    }

    private function format_member($id) {
        return [
            'id' => $id,
            'name' => get_the_title($id),
            'role' => get_post_meta($id, '_ts_role', true),
            'short_bio' => get_post_meta($id, '_ts_short_bio', true),
            'photo_url' => get_the_post_thumbnail_url($id, 'full'),
            'permalink' => get_permalink($id)
        ];
    }
}