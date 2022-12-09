<?php

class zxp
{
    private static $instance;

    public static function instance()
    {
        if (!isset(self::$instance) && !(self::$instance instanceof zxp)) {
            self::$instance = new zxp;
            self::$instance->thepack_includes();
            self::$instance->thepack_hooks();
        }

        return self::$instance;
    }

    private function thepack_hooks()
    {
        add_action('elementor/preview/enqueue_scripts', [$this, 'ooohboi_register_scripts_front']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'thepack_frontend_styles']);
    }

    private function thepack_includes()
    {
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/ou.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/section.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/translate.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/column.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/icon_box.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/icon.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/image.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/heading.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/custom_css.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/tp-parallax.php';
        require_once THE_PACK_PLUGIN_DIR . 'includes/extension/inc/shape-divider.php';
    }

    public function ooohboi_register_scripts_front()
    {
        wp_enqueue_script('ooohboi-steroids', plugins_url('js/ooohboi-steroids.js', __FILE__));
    }

    public function thepack_frontend_styles()
    {
        wp_enqueue_style('ooohboi-steroids', plugins_url('css/style.css', __FILE__));
    }
}

zxp::instance();
