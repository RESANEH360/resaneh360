<?php
/*
Plugin Name: The Pack
Plugin URI: https://webangon.com/
Description: The most advanced addon for Elementor page builder.
Author: Webangon
Author URI: https://webangon.com
Version: 1.0.7
Text Domain: thepack
Domain Path: /languages/
*/
 
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('thepack_elementor_addon_widget')) {
    class thepack_elementor_addon_widget
    {
        private static $instance;

        public static function instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof thepack_elementor_addon_widget)) {
                self::$instance = new thepack_elementor_addon_widget;

                self::$instance->thepack_setup_constants();

                self::$instance->thepack_hooks();

                self::$instance->thepack_includes();
            }

            return self::$instance;
        }

        public function __clone()
        {
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'thepack'), '1.6');
        }

        public function __wakeup()
        {
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'thepack'), '1.6');
        }

        private function thepack_setup_constants()
        {
            if (!defined('THE_PACK_PLUGIN_DIR')) {
                define('THE_PACK_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }

            if (!defined('THE_PACK_PLUGIN_URL')) {
                define('THE_PACK_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

            if (!defined('THE_PACK_ADDON_ROOT')) {
                define('THE_PACK_ADDON_ROOT', __FILE__);
            }
        }

        /**
         * Include required files
         *
         */
        private function thepack_includes()
        {
            include_once THE_PACK_PLUGIN_DIR . 'includes/helper-functions.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/template-lib.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/header-footer/index.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/query-functions.php';

            include_once THE_PACK_PLUGIN_DIR . 'admin/framework/codestar-framework.php';
            include_once THE_PACK_PLUGIN_DIR . 'admin/helper/dynamic-styles.php';
            include_once THE_PACK_PLUGIN_DIR . 'admin/helper/activation.php';

            include_once THE_PACK_PLUGIN_DIR . 'admin/inc/dash.php';

            include_once THE_PACK_PLUGIN_DIR . 'admin/helper/index.php';
            include_once THE_PACK_PLUGIN_DIR . 'admin/lib/index.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/extension/index.php';
            include_once THE_PACK_PLUGIN_DIR . 'includes/contact_helper.php';

            include_once THE_PACK_PLUGIN_DIR . 'admin/configstar/option-panel.php';
            include_once THE_PACK_PLUGIN_DIR . 'admin/configstar/menu-meta.php';
            include_once THE_PACK_PLUGIN_DIR . 'admin/configstar/xlmega_walker.php';
            include_once THE_PACK_PLUGIN_DIR . 'admin/configstar/codestar-extra.php';

        }

        /**
         * Setup the default hooks and actions
         */
        private function thepack_hooks()
        {
            add_action('admin_init', [$this, 'installed_active_elementor'], 10);
            add_action('elementor/widgets/register', [self::$instance, 'thepack_include_widgets']);
            add_action('elementor/frontend/after_register_scripts', [$this, 'thepack_frontend_scripts']);
            add_action('elementor/frontend/after_enqueue_styles', [$this, 'thepack_frontend_styles']);
            add_action('elementor/init', [$this, 'thepack_add_elementor_category']);
            add_action('elementor/editor/after_enqueue_scripts', [$this, 'elementor_editor_scripts']);
            add_action('template_redirect', [self::$instance, 'template_preview'], 9);
            add_action('wp_footer', [$this, 'inject_pop_wrap']);
            add_action('wp_body_open', [$this, 'inject_header_markup']);
            add_filter('elementor/icons_manager/additional_tabs', [$this, 'icons_tabs']);
            add_action('init', [$this, 'init']);
            add_action( 'plugin_action_links_'. plugin_basename( __FILE__ ), array( $this, 'my_plugin_action_links' ), 10 );
        }

        public function my_plugin_action_links( $links ) {

			$links = array_merge( array(
				'<a href="' . esc_url( admin_url( 'admin.php?page=the-pack-demo' ) ) . '">' . __( 'Starter Sites', 'textdomain' ) . '</a>'
			), $links );

			return $links;

		}

        public function init()
        {
            add_theme_support('automatic-feed-links');
            add_theme_support('title-tag');
            add_theme_support('post-thumbnails');
            add_theme_support('wp-block-styles');
            add_theme_support('align-wide');
            add_theme_support('html5', [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]);

            register_nav_menus([
                'primary' => esc_attr__('Primary', 'thepackpro'),
            ]);
        }

        public function icons_tabs($tabs = [])
        {
            $tabs['themify-icons'] = [
                'name' => 'themify-icons',
                'label' => esc_html__('Themify', 'icon-element'),
                'labelIcon' => 'ti-wand',
                'prefix' => 'ti-',
                'displayPrefix' => 'tivo',
                'url' => THE_PACK_PLUGIN_URL . 'assets/iconfont/themify-icons/themify-icons.css',
                'fetchJson' => THE_PACK_PLUGIN_URL . 'assets/iconfont/themify-icons/fonts/themify-icons.json',
                'ver' => '3.0.1',
            ];

            return $tabs;
        }

        public function inject_header_markup()
        {   
            $options = get_option('_thepack');
            $yes = isset($options['preloader']) && $options['preloader'] ? $options['preloader'] : '';
            if ($yes){
                echo '<div class="tp-page-loader-wrap"><div class="loader"></div></div>';
            }
            
        }

        public function inject_pop_wrap()
        {
            echo '<div style="display:none;" class="tp-pop-response"><span class="close">x</span><div class="inner"><div class="popwrap"></div></div></div>';
        }

        public function installed_active_elementor()
        {
            if (is_admin() && current_user_can('activate_plugins') && !did_action('elementor/loaded')) {
                add_action('admin_notices', [$this, 'elementor_inactive_not_present'], 10);

                deactivate_plugins('the-pack-addon/index.php');

                if (isset($_GET['activate'])) {
                    unset($_GET['activate']);
                }
            }
        }

        public function elementor_inactive_not_present()
        {
            $class = 'notice notice-error';
            $plugin = 'elementor/elementor.php';
            $message = sprintf(__('The %1$sThe Pack%2$s plugin requires %1$sElementor%2$s plugin installed & activated.', 'thepack'), '<strong>', '</strong>');

            if (file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php')) {
                $action_url = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin);
                $button_label = __('Activate Elementor', 'thepack');
            } else {
                $action_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');
                $button_label = __('Install Elementor', 'thepack');
            }

            $button = '<p><a href="' . esc_url($action_url) . '" class="button-primary">' . esc_html($button_label) . '</a></p><p></p>';

            printf('<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr($class), wp_kses_post($message), wp_kses_post($button));
        }

        public function template_preview()
        {
            $instance = \Elementor\Plugin::$instance->templates_manager->get_source('local');
            remove_action('template_redirect', [$instance, 'block_template_frontend']);
        }

        public function thepack_active_element($items)
        {
            $yes = [];
            $options = get_option('_thepack');
            foreach ($items as $item) {
                $yes[] = isset($options[$item]) && $options[$item] ? $item : '';
            }

            return array_filter($yes);
        }

        public function elementor_editor_scripts() 
        {
            wp_enqueue_script('tp-backend-editor', THE_PACK_PLUGIN_URL . 'assets/js/elementor-editor.min.js');
        }

        /**
         * Load Frontend Scripts
         *
         */
        public function thepack_frontend_scripts()
        {
            wp_enqueue_script(['jquery', 'masonry']);
            wp_enqueue_script('lazysizes', THE_PACK_PLUGIN_URL . 'assets/js/lazysizes.min.js', '', '', true);
            wp_enqueue_style('e-animations');
            $scripts = [
                'scrollreveal',
                'circle-progress',
                'plyr',
                'countdown',
                'slick',
                'beerslider',
                'jarallax',
                'flex-images',
                'fitvideos'
            ];

            $tb_scripts = $this->thepack_active_element($scripts);

            if (is_array($tb_scripts)) {
                foreach ($tb_scripts as $key => $value) {
                    if (!empty($value)) {
                        wp_enqueue_script($value, THE_PACK_PLUGIN_URL . 'assets/js/' . $value . '.js', '', '', 'true');
                    }
                }
            }

            wp_enqueue_script('thepack-js', THE_PACK_PLUGIN_URL . 'assets/js/custom.js', '', '', true);
        }

        public function thepack_frontend_styles()
        {
            wp_enqueue_style('thepack-shortcode', THE_PACK_PLUGIN_URL . 'assets/css/shortcode.css');
            wp_enqueue_style('dashicons');

            $style = [
                'beerslider-styl',
                'plyr-styl',
                'slick-styl',
                'animate-styl'
            ];

            $tb_styles = $this->thepack_active_element($style);

            if (is_array($tb_styles)) {
                foreach ($tb_styles as $key => $value) {
                    if (!empty($value)) {
                        wp_enqueue_style($value, THE_PACK_PLUGIN_URL . 'assets/css/' . $value . '.css', '', 'true');
                    }
                }
            }
        }

        public function thepack_add_elementor_category()
        {
            \Elementor\Plugin::instance()->elements_manager->add_category(
                'ashelement-addons',
                [
                    'title' => esc_html__('The Pack', 'thepack'),
                    'icon' => 'fa fa-plug',
                ],
                1
            );
        }

        /**
         * Include required files
         *
         */
        public function glob_widget($path, $widgets_manager)
        {
            $widgets = [];
            foreach (glob($path . '*') as $file) {
                $widgets[] = substr($file, strrpos($file, '/') + 1);
            }

            $active_widgets = $this->thepack_active_element($widgets);
            if (is_array($active_widgets)) {
                foreach ($active_widgets as $key => $value) {
                    if (!empty($value)) {
                        require_once $path . $value . '/index.php';
                    }
                }
            }
        }

        public function thepack_include_widgets($widgets_manager)
        {
            $this->glob_widget(THE_PACK_PLUGIN_DIR . '/includes/widgets/theme/', $widgets_manager);
            $this->glob_widget(THE_PACK_PLUGIN_DIR . '/includes/widgets/element/', $widgets_manager);
        }
    }
}

function thepack_run()
{
    return thepack_elementor_addon_widget::instance();
}

thepack_run();
