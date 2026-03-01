<?php
if (!defined('ABSPATH')) exit;

class TS_Team_Query {

    public static function get_team_members($role = null) {

        $args = [
            'post_type' => 'team_member',
            'post_status' => 'publish',
            'posts_per_page' => -1
        ];

        if ($role) {
            $args['meta_query'] = [
                [
                    'key' => '_ts_role',
                    'value' => sanitize_text_field($role),
                    'compare' => '='
                ]
            ];
        }

        return new WP_Query($args);
    }
}