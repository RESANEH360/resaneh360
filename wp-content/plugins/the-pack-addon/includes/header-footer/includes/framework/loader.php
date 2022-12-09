<?php

if (!defined('WPINC')) {
    die;
}

if (!class_exists('The_Pack_Builder_Loader')) {
    class The_Pack_Builder_Loader
    {
        private $key = 'cherry_x_modules';

        private $modules = [];

        private $modules_slugs = [];

        private $included_modules = [];

        public function __construct(array $modules = [])
        {
            $this->modules = $modules;

            add_action('after_setup_theme', [$this, 'store_versions'], -10);
            add_action('after_setup_theme', [$this, 'include_modules'], -1);
        }

        public function store_versions()
        {
            foreach ($this->modules as $module) {
                $this->store_module_version($module);
            }
        }

        public function include_modules()
        {
            $modules_data = wp_cache_get($this->key);

            foreach ($this->modules_slugs as $slug) {
                if (empty($modules_data[$slug])) {
                    continue;
                }

                $path = $this->get_latest_version_path($modules_data[$slug]);

                if (file_exists($path)) {
                    $dir = pathinfo($path, PATHINFO_DIRNAME);

                    $normalize_dir = wp_normalize_path($dir);
                    $plugin_dir = wp_normalize_path(WP_PLUGIN_DIR);

                    if (0 === strpos($normalize_dir, $plugin_dir)) {
                        $url = str_replace(
                            '\\',
                            '/',
                            str_replace($plugin_dir, plugins_url(), $normalize_dir)
                        );
                    } else {
                        $url = str_replace(
                            '\\',
                            '/',
                            str_replace(wp_normalize_path(WP_CONTENT_DIR), content_url(), $normalize_dir)
                        );
                    }

                    $this->included_modules[$slug] = [
                        'path' => trailingslashit($dir),
                        'url' => apply_filters('cx_include_module_url', trailingslashit($url), $path),
                    ];

                    require_once $path;
                }
            }

            return true;
        }

        public function get_included_module_data($file)
        {
            return isset($this->included_modules[$file]) ? $this->included_modules[$file] : false;
        }

        private function get_latest_version_path(array $module_versions = [])
        {
            // Immediately return path if array contain sinle element.
            if (1 === count($module_versions)) {
                $module_versions = array_values($module_versions);
                return $module_versions[0];
            }

            // Sort array by version and return highest
            uksort($module_versions, 'version_compare');
            return end($module_versions);
        }

        private function store_module_version($module_path = null)
        {
            $slug = basename($module_path);
            $modules_data = wp_cache_get($this->key);
            $modules_data = !empty($modules_data) ? $modules_data : [];

            if (empty($modules_data[$slug])) {
                $modules_data[$slug] = [];
            }

            $filedata = get_file_data($module_path, [
                'version' => 'Version',
            ]);

            if (empty($filedata['version'])) {
                // If version not passed in file header, so module defined not correctly and not be included
                return false;
            }

            $current_version = $filedata['version'];

            if (empty($modules_data[$slug][$current_version])) {
                $modules_data[$slug][$current_version] = $module_path;
            }

            $this->modules_slugs[] = $slug;

            wp_cache_set($this->key, $modules_data, '', 1);

            return true;
        }
    }
}
