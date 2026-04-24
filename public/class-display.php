<?php

class FSP_Display
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'fsp_enqueue_styles'));
        add_shortcode('free_shipping_progress', array($this, 'render_progress_bar'));

    }

    function fsp_enqueue_styles()
    {
        wp_enqueue_style('enqueue-progress-style', FSP_URL . "/assets/progress.css");
    }
    public function render_progress_bar()
    {

        if (!function_exists('WC') || !WC()->cart) {
            return 'You still haven’t installed the WooCommerce plugin';
        }

        $settings = get_option('fsp_settings');

        $color = isset($settings['color']) ? $settings['color'] : '#8e2de2';
        $text = !empty($settings['text']) ? $settings['text'] : 'Amount left for free shipping:';
        $notice = !empty($settings['notice_text']) ? $settings['notice_text'] : 'Free shipping activated🎉';
        $amount = !empty($settings['amount']) ? intval($settings['amount']) : 100;
        $align = isset($settings['align']) ? $settings['align'] : 'left';


        $cart_total = WC()->cart->total;

        $remaining = $amount - $cart_total;
        $percent = min(100, ($cart_total / $amount) * 100);

        if ($remaining > 0) {
            $text = $text . " " . wc_price($remaining) . " ";
        } else {
            $text = $notice;
        }

        $progress_html = '<div class="fsp-progress-wrapper">';
        $progress_html .= '<div class="fsp-progress-bar" style="width: ' . $percent . '%; background: ' . esc_attr($color) . ';"></div>';
        $progress_html .= '</div>';

        return '<div class="fsp-progress-container" style="text-align: ' . esc_attr($align) . ';">'
            . $text .
            $progress_html .
            '</div>';

    }

}