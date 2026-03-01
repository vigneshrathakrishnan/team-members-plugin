<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

$members = get_posts([
    'post_type' => 'team_member',
    'numberposts' => -1,
    'fields' => 'ids'
]);

foreach ($members as $member_id) {
    delete_post_meta($member_id, '_ts_role');
    delete_post_meta($member_id, '_ts_short_bio');
}