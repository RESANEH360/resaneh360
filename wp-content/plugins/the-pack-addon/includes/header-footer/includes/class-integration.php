<?php

if (!defined('WPINC')) {
    die;
}

if (!class_exists('The_Pack_Builder_Integration')) {
    class The_Pack_Builder_Integration
    {
        private static $instance = null;

        public function init()
        {
            $ext_module_data = thepack_builder()->module_loader->get_included_module_data('elementor-extension.php');

            ThePackBuilder_Extension\Module::get_instance(
                [
                    'path' => $ext_module_data['path'],
                    'url' => $ext_module_data['url'],
                ]
            );
        }

        public static function get_instance()
        {
            // If the single instance hasn't been set, set it now.
            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }
    }
}

function thepack_builder_integration()
{
    return The_Pack_Builder_Integration::get_instance();
}
