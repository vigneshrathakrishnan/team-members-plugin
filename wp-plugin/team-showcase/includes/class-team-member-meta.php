<?php
if (!defined('ABSPATH')) exit;

class TS_Team_Member_Meta {

    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_meta_box']);
        add_action('save_post', [$this, 'save_meta']);
    }

    public function add_meta_box() {
        add_meta_box(
            'ts_team_meta',
            'Team Member Details',
            [$this, 'render_meta_box'],
            'team_member'
        );
    }

    public function render_meta_box($post) {
        wp_nonce_field('ts_save_meta', 'ts_meta_nonce');

        $role = get_post_meta($post->ID, '_ts_role', true);
        $short_bio = get_post_meta($post->ID, '_ts_short_bio', true);

        ?>
        <p>
            <label>Role</label><br>
            <input type="text" name="ts_role" value="<?php echo esc_attr($role); ?>" style="width:100%;">
        </p>
        <p>
            <label>Short Bio</label><br>
            <textarea name="ts_short_bio" style="width:100%;" rows="4"><?php echo esc_textarea($short_bio); ?></textarea>
        </p>
        <?php
    }

    public function save_meta($post_id) {

        if (!isset($_POST['ts_meta_nonce']) || 
            !wp_verify_nonce($_POST['ts_meta_nonce'], 'ts_save_meta')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        if (isset($_POST['ts_role'])) {
            update_post_meta($post_id, '_ts_role', sanitize_text_field($_POST['ts_role']));
        }

        if (isset($_POST['ts_short_bio'])) {
            update_post_meta($post_id, '_ts_short_bio', sanitize_textarea_field($_POST['ts_short_bio']));
        }
    }
}