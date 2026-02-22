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
        wp_enqueue_style('enqueue-progress-stylexx', FSP_URL."/assets/progress.css" );
    }
    public function render_progress_bar()
    {

        if (!function_exists('WC') || !WC()->cart) {
            return 'test';
        }

        $free_shipping = 500000;
        $cart_total = WC()->cart->total;

        $remaining = $free_shipping - $cart_total;
        $percent = min(100, ($cart_total / $free_shipping) * 100);

        if ($remaining > 0) {
            $text = " فقط" . wc_price($remaining) . "تا ارسال رایگان!";
        } else {
            $text = "ارسال رایگان فعال شد 🎉";
        }

        $progress_html = '<div class="fsp-progress-wrapper">';
        $progress_html .= '<div class="fsp-progress-bar" style="width:' . $percent . '%;"></div>';
        $progress_html .= '</div>';

        return '<div class="fsp-progress-container">' . $text . $progress_html . '</div>';

    }

}