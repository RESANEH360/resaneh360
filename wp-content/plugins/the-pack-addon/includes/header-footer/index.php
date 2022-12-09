<?php

if (!defined('WPINC')) {
    die;
}

if (!function_exists('The_Pack_Builder')) {
    class The_Pack_Builder
    {
        private static $instance = null;

        private $plugin_url = null;

        private $plugin_path = null;

        private $version = '1.0.3';

        public $module_loader = null;

        public $modules_manager;

        public function __construct()
        {
            spl_autoload_register([$this, 'autoload']);

            add_action('after_setup_theme', [$this, 'module_loader'], -20);

            add_action('init', [$this, 'init'], -999);

            add_action('elementor/init', [$this, 'on_elementor_init']);

            add_action('admin_enqueue_scripts', [$this, 'admin_enqueue']);
        }

        /**
         * Load the theme modules.
         *
         * @since  1.0.0
         */
        public function module_loader()
        {
            require $this->plugin_path('includes/framework/loader.php');

            $this->module_loader = new The_Pack_Builder_Loader(
                [
                    $this->plugin_path('includes/framework/elementor-extension/elementor-extension.php'),
                ]
            );
        }

        public function get_version()
        {
            return $this->version;
        }

        public function init()
        {
            $this->load_files();

            thepack_builder_integration()->init();
        }

        public function has_elementor_pro()
        {
            return defined('ELEMENTOR_PRO_VERSION');
        }

        public function elementor()
        {
            return \Elementor\Plugin::$instance;
        }

        public function load_files()
        {
            require $this->plugin_path('includes/class-helper.php');
            require $this->plugin_path('includes/class-integration.php');
        }

        public function plugin_path($path = null)
        {
            if (!$this->plugin_path) {
                $this->plugin_path = trailingslashit(plugin_dir_path(__FILE__));
            }

            return $this->plugin_path . $path;
        }

        public function plugin_url($path = null)
        {
            if (!$this->plugin_url) {
                $this->plugin_url = trailingslashit(plugin_dir_url(__FILE__));
            }

            return $this->plugin_url . $path;
        }

        public function on_elementor_init()
        {
            if (!$this->has_elementor_pro()) {
                $this->modules_manager = new \ThePackThemeBuilder\Modules\Modules_Manager();
            }
        }

        public function admin_enqueue()
        {
            wp_enqueue_script(
                'thepack-kit-admin',
                $this->plugin_url('assets/js/thepack-kit-admin.js'),
                ['jquery'],
                $this->get_version()
            );
        }

        public static function get_instance()
        {
            // If the single instance hasn't been set, set it now.
            if (null == self::$instance) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function autoload($class)
        {
            if (0 !== strpos($class, 'ThePackThemeBuilder')) {
                return;
            }

            if (!class_exists($class)) {
                $filename = strtolower(
                    preg_replace(
                        ['/^' . 'ThePackThemeBuilder' . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/'],
                        ['', '$1-$2', '-', DIRECTORY_SEPARATOR],
                        $class
                    )
                );

                $filename = $this->plugin_path('includes/' . $filename . '.php');

                if (is_readable($filename)) {
                    include $filename;
                }
            }
        }
    }
}

if (!function_exists('thepack_builder')) {
    function thepack_builder()
    {
        return The_Pack_Builder::get_instance();
    }
}
if (did_action('elementor/loaded')) {
    thepack_builder();
}
