<div class="wrap">
    <h1><?php esc_html_e('HTL Dash Settings', 'htl-dash'); ?></h1>
    <form method="post" action="options.php">
        <?php settings_fields('htl_dash_settings_group'); ?>
        <?php do_settings_sections('htl_dash_settings_group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php esc_html_e('Stripe Secret Key (Live)', 'htl-dash'); ?></th>
                <td><input type="text" name="htl_dash_stripe_secret_key_live" value="<?php echo esc_attr(get_option('htl_dash_stripe_secret_key_live')); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('Stripe Publishable Key (Live)', 'htl-dash'); ?></th>
                <td><input type="text" name="htl_dash_stripe_publishable_key_live" value="<?php echo esc_attr(get_option('htl_dash_stripe_publishable_key_live')); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('Stripe Secret Key (Test)', 'htl-dash'); ?></th>
                <td><input type="text" name="htl_dash_stripe_secret_key_test" value="<?php echo esc_attr(get_option('htl_dash_stripe_secret_key_test')); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('Stripe Publishable Key (Test)', 'htl-dash'); ?></th>
                <td><input type="text" name="htl_dash_stripe_publishable_key_test" value="<?php echo esc_attr(get_option('htl_dash_stripe_publishable_key_test')); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('Stripe Mode', 'htl-dash'); ?></th>
                <td>
                    <select name="htl_dash_stripe_mode">
                        <option value="live" <?php selected(get_option('htl_dash_stripe_mode'), 'live'); ?>><?php esc_html_e('Live', 'htl-dash'); ?></option>
                        <option value="test" <?php selected(get_option('htl_dash_stripe_mode'), 'test'); ?>><?php esc_html_e('Test', 'htl-dash'); ?></option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><?php esc_html_e('Stripe Connection Status', 'htl-dash'); ?></th>
                <td>
                    <span id="htl-dash-stripe-status">
                        <?php
                        $status = get_option('htl_dash_stripe_connection_status', 'not_checked');
                        if ($status === 'connected') {
                            esc_html_e('Connected', 'htl-dash');
                        } elseif ($status === 'error') {
                            esc_html_e('Error: Could not connect to Stripe', 'htl-dash');
                        } else {
                            esc_html_e('Not checked', 'htl-dash');
                        }
                        ?>
                    </span>
                    <button type="button" id="htl-dash-test-connection" class="button"><?php esc_html_e('Test Connection', 'htl-dash'); ?></button>
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
