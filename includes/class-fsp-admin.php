<?php


if (!defined('ABSPATH')) {
    exit;
}

class FSP_Admin
{

    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_menu'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function add_menu()
    {
        add_menu_page(
            'Free Shipping Progress',
            'Shipping Progress',
            'manage_options',
            'fsp-settings',
            array($this, 'settings_page'),
            'dashicons-chart-bar'
        );
    }

    public function register_settings()
    {
        register_setting('fsp_settings_group', 'fsp_settings');
    }

    public function settings_page()
    {
        $settings = get_option('fsp_settings');

        $color = isset($settings['color']) ? $settings['color'] : '#8e2de2';
        $text = !empty($settings['text']) ? $settings['text'] : 'Amount left for free shipping:';
        $notice = !empty($settings['notice_text']) ? $settings['notice_text'] : 'Free shipping activated🎉';
        $amount = !empty($settings['amount']) ? intval($settings['amount']) : 100;
        $align = isset($settings['align']) ?$settings['align'] : 'left';

        ?>

        <div class="wrap">
            <h1>Free Shipping Progress Settings</h1>

            <form method="post" action="options.php">

                <?php settings_fields('fsp_settings_group'); ?>

                <table class="form-table">

                    <tr>
                        <th>Progress Color</th>
                        <td>
                            <input type="color" name="fsp_settings[color]" value="<?php echo esc_attr($color); ?>">
                        </td>
                    </tr>

                    <tr>
                        <th>Remaining Text</th>
                        <td>
                            <input type="text" name="fsp_settings[text]" value="<?php echo esc_attr($text); ?>"
                                style="width:300px;">
                        </td>
                    </tr>

                    <tr>
                        <th>Free Shipping Activated Text</th>
                        <td>
                            <input type="text" name="fsp_settings[notice_text]" value="<?php echo esc_attr($notice); ?>"
                                style="width:300px;">
                        </td>
                    </tr>

                    <tr>
                        <th>Free Shipping Amount</th>
                        <td>
                            <input type="number" name="fsp_settings[amount]" value="<?php echo esc_attr($amount); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>Text Align</th>
                        <td>
                            <select name="fsp_settings[align]">

                                <option value="right" <?php selected($align, 'right'); ?>>Right</option>
                                <option value="left" <?php selected($align, 'left'); ?>>Left</option>
                                <option value="center" <?php selected($align, 'center'); ?>>Center</option>

                            </select>

                        </td>
                    </tr>

                </table>

                <?php submit_button(); ?>

            </form>

        </div>



        <?php
    }


}