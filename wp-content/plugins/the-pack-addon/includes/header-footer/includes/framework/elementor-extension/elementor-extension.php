<?php
/**
 * LaStudioKit Elementor Extension Module.
 *
 * Version: 1.0.0
 */
namespace ThePackBuilder_Extension;

if (!defined('WPINC')) {
    die;
}

use Elementor\Core\Common\Modules\Ajax\Module as Ajax;

if (!class_exists('ThePackBuilder_Extension\Module')) {
    /**
     * Class ThePackBuilder_Extension\Module.
     *
     * @since 1.0.0
     */
    class Module
    {
        /**
         * A reference to an instance of this class.
         *
         * @since  1.0.0
         * @access private
         * @var    object
         */
        private static $instance = null;

        /**
         * Module version.
         *
         * @var string
         */
        protected $version = '1.0.0';

        /**
         * Module directory path.
         *
         * @since 1.0.0
         * @access protected
         * @var srting.
         */
        protected $path;

        /**
         * Module directory URL.
         *
         * @since 1.0.0
         * @access protected
         * @var srting.
         */
        protected $url;

        /**
         * Constructor.
         *
         * @since  1.0.0
         * @param  array $args
         * @access public
         * @return void
         */
        public function __construct(array $args = [])
        {
            $this->path = $args['path'];
            $this->url = $args['url'];

            $this->load_files();

            add_action('elementor/controls/controls_registered', [$this, 'register_controls']);
            add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);
            add_action('elementor/ajax/register_actions', [$this, 'register_ajax_actions']);

            // Register private actions
            $priv_actions = [
                'lakit_theme_search_posts' => [$this, 'search_posts'],
                'lakit_theme_search_pages' => [$this, 'search_pages'],
                'lakit_theme_search_cats' => [$this, 'search_cats'],
                'lakit_theme_search_tags' => [$this, 'search_tags'],
                'lakit_theme_search_terms' => [$this, 'search_terms'],
            ];

            foreach ($priv_actions as $tag => $callback) {
                add_action('wp_ajax_' . $tag, $callback);
            }
        }

        /**
         * Load required files.
         */
        public function load_files()
        {
            require trailingslashit($this->path) . 'inc/controls/control-query.php';
            require trailingslashit($this->path) . 'inc/controls/search.php';
            require trailingslashit($this->path) . 'inc/classes/query-control.php';
        }

        /**
         * Register new controls.
         *
         * @param  object $controls_manager Controls manager instance.
         * @return void
         */
        public function register_controls($controls_manager)
        {
            $controls_manager->register_control(\ThePackBuilder_Extension\Controls\Control_Query::get_control_type(), new \ThePackBuilder_Extension\Controls\Control_Query());
            $controls_manager->register_control(\ThePackBuilder_Extension\Controls\Control_Search::get_control_type(), new \ThePackBuilder_Extension\Controls\Control_Search());
        }

        /**
         * @param Ajax $ajax_manager
         */
        public function register_ajax_actions($ajax_manager)
        {
            $class_query = \ThePackBuilder_Extension\Classes\Query_Control::get_instance();
            $ajax_manager->register_ajax_action('lastudiokit_query_control_value_titles', [$class_query, 'ajax_posts_control_value_titles']);
            $ajax_manager->register_ajax_action('lastudiokit_query_control_filter_autocomplete', [$class_query, 'ajax_posts_filter_autocomplete']);
        }

        /**
         * Enqueue editor scripts.
         */
        public function enqueue_editor_scripts()
        {
            wp_enqueue_script(
                'lastudio-kit-ext-editor',
                $this->url . 'assets/js/editor.js',
                ['jquery'],
                $this->version,
                true
            );
        }

        /**
         * Serch page
         *
         * @return [type] [description]
         */
        public function search_pages()
        {
            if (!current_user_can('edit_posts')) {
                wp_send_json([]);
            }

            $query = isset($_GET['q']) ? esc_attr($_GET['q']) : '';
            $ids = isset($_GET['ids']) ? esc_attr($_GET['ids']) : [];

            wp_send_json([
                'results' => thepack_builder_helper()->search_posts_by_type('page', $query, $ids),
            ]);
        }

        /**
         * Serch post
         *
         * @return [type] [description]
         */
        public function search_posts()
        {
            if (!current_user_can('edit_posts')) {
                wp_send_json([]);
            }

            $query = isset($_GET['q']) ? esc_attr($_GET['q']) : '';
            $post_type = isset($_GET['preview_post_type']) ? esc_attr($_GET['preview_post_type']) : 'post';
            $ids = isset($_GET['ids']) ? esc_attr($_GET['ids']) : [];

            wp_send_json([
                'results' => thepack_builder_helper()->search_posts_by_type($post_type, $query, $ids),
            ]);
        }

        /**
         * Serch category
         *
         * @return [type] [description]
         */
        public function search_cats()
        {
            if (!current_user_can('edit_posts')) {
                wp_send_json([]);
            }

            $query = isset($_GET['q']) ? esc_attr($_GET['q']) : '';
            $ids = isset($_GET['ids']) ? esc_attr($_GET['ids']) : [];

            wp_send_json([
                'results' => thepack_builder_helper()->search_terms_by_tax('category', $query, $ids),
            ]);
        }

        /**
         * Serch tag
         *
         * @return [type] [description]
         */
        public function search_tags()
        {
            if (!current_user_can('edit_posts')) {
                wp_send_json([]);
            }

            $query = isset($_GET['q']) ? esc_attr($_GET['q']) : '';
            $ids = isset($_GET['ids']) ? esc_attr($_GET['ids']) : [];

            wp_send_json([
                'results' => thepack_builder_helper()->search_terms_by_tax('post_tag', $query, $ids),
            ]);
        }

        /**
         * Serach terms from passed taxonomies
         * @return [type] [description]
         */
        public function search_terms()
        {
            if (!current_user_can('edit_posts')) {
                wp_send_json([]);
            }

            $query = isset($_GET['q']) ? esc_attr($_GET['q']) : '';

            $tax = '';

            if (isset($_GET['conditions_archive-tax_tax'])) {
                $tax = $_GET['conditions_archive-tax_tax'];
            }

            if (isset($_GET['conditions_singular-post-from-tax_tax'])) {
                $tax = $_GET['conditions_singular-post-from-tax_tax'];
            }

            $tax = explode(',', $tax);

            $ids = isset($_GET['ids']) ? esc_attr($_GET['ids']) : [];

            wp_send_json([
                'results' => thepack_builder_helper()->search_terms_by_tax($tax, $query, $ids),
            ]);
        }

        /**
         * Returns the instance.
         *
         * @since  1.0.0
         * @param  array $args
         * @access public
         * @return object
         */
        public static function get_instance(array $args = [])
        {
            // If the single instance hasn't been set, set it now.
            if (null == self::$instance) {
                self::$instance = new self($args);
            }

            return self::$instance;
        }
    }
}
