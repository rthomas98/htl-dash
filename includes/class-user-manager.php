<?php

class HTL_Dash_User_Manager {

    public function __construct() {
        add_action('show_user_profile', array($this, 'extra_user_profile_fields'));
        add_action('edit_user_profile', array($this, 'extra_user_profile_fields'));
        add_action('personal_options_update', array($this, 'save_extra_user_profile_fields'));
        add_action('edit_user_profile_update', array($this, 'save_extra_user_profile_fields'));
    }

    public function extra_user_profile_fields($user) {
        ?>
        <h3><?php _e('Extra Profile Information', 'htl-dash'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="favorite_course"><?php _e('Favorite Course'); ?></label></th>
                <td>
                    <input type="text" name="favorite_course" id="favorite_course" value="<?php echo esc_attr(get_the_author_meta('favorite_course', $user->ID)); ?>" class="regular-text" />
                </td>
            </tr>
        </table>
        <?php
    }

    public function save_extra_user_profile_fields($user_id) {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }

        update_user_meta($user_id, 'favorite_course', $_POST['favorite_course']);
    }
}

new HTL_Dash_User_Manager();
