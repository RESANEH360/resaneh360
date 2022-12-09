<?php
if (!defined('WPINC')) {
    die;
}

if (!class_exists('The_Pack_Builder_Helper')) {
    class The_Pack_Builder_Helper
    {
        private static $instance = null;

        public static function get_post_types($args = [])
        {
            $post_type_args = [
                'show_in_nav_menus' => true,
                'public' => true,
            ];

            if (!empty($args['post_type'])) {
                $post_type_args['name'] = $args['post_type'];
            }

            $post_type_args = apply_filters('the-pack/post-types-list/args', $post_type_args, $args);

            $post_types = get_post_types($post_type_args, 'objects');

            $deprecated = apply_filters(
                'the-pack/post-types-list/deprecated',
                ['attachment', 'elementor_library']
            );

            $result = [];

            if (empty($post_types)) {
                return $result;
            }

            foreach ($post_types as $slug => $post_type) {
                if (in_array($slug, $deprecated)) {
                    continue;
                }

                $result[$slug] = $post_type->label;
            }

            return $result;
        }

        public static function get_instance()
        {
            // If the single instance hasn't been set, set it now.
            if (null == self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public static function set_global_authordata()
        {
            global $authordata;
            if (!isset($authordata->ID)) {
                $post = get_post();
                $authordata = get_userdata($post->post_author); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
            }
        }
    }
}

/**
 * Returns instance of The_Pack_Builder_Helper
 *
 * @return The_Pack_Builder_Helper
 */
function thepack_builder_helper()
{
    return The_Pack_Builder_Helper::get_instance();
}
