<?php
namespace WebangonAddon;

class The_Pack_Codestar_Extra
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'admin_scripts']);
    }

    public static function admin_scripts()
    {
        wp_enqueue_style('thepack-admin', plugin_dir_url(__FILE__) . 'codestar.css');
    }
}

new The_Pack_Codestar_Extra();
