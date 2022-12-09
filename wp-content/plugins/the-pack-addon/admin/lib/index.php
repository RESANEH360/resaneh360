<?php

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

if (!class_exists('The_Pack_Cloud_Library')) {
    
    class The_Pack_Cloud_Library
    {
        private static $_instance = null;
        public static $plugin_data = null;

        public static function init()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
                self::$_instance->include_files();
            }
            return self::$_instance;
        }

        private function __construct()
        {
            self::$plugin_data = [

                'pro-link' => 'https://webangon.com/the-pack-elementor-addon/',
                //'remote_widget' => 'http://thepack.test/main/',
                'remote_widget' => 'https://thepack.webangon.com/main/', // all widgets
                'remote_sites' => 'https://thepack.webangon.com/readypages/', // all section & demo sites
                //'remote_sites' => 'http://thepack.test/business/', // all section & demo sites
                'remote_page_site' => 'https://thepack.webangon.com/readypages/', // all pages
                'thepack_import_data' => 'thepack_single_lib' // elementor import endpoint

            ];      

            add_action('elementor/editor/before_enqueue_scripts', [$this, 'editor_script']);
            add_action('wp_ajax_process_ajax', [$this, 'ajax_data']);
            add_action('wp_ajax_xl_tab_reload_template', [$this, 'reload_library']);
            
        }

        public function __clone()
        {
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'thepack'), '1.0.0');
        }

        public function __wakeup()
        {
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'thepack'), '1.0.0');
        }

        public function include_files()
        {
            require __DIR__ . '/inc/import.php'; 
 
        }

        public function editor_script()
        {
            wp_enqueue_script('thepack-library', plugins_url('/assets/js/elementor-manage-library.js', __FILE__));  
            wp_localize_script('thepack-library', 'thepack_lib_params', [
                'site' => site_url(),
            ]);                         
            wp_enqueue_script('masonry');
            wp_enqueue_style('thepack_lib', plugins_url('/assets/css/style.css', __FILE__));
        }

        public function reload_library()
        {
            The_Pack_Activation_Class::init();
            die();
        }

        public function choose_option_table($table_name)
        {
            if ($table_name == 'element') {
                $out = 'widget';
            } elseif ($table_name == 'section') {
                $out = 'section';
            } elseif ($table_name == 'header-footer') {
                $out = 'header_footer';
            } elseif ($table_name == 'theme-builder') {
                $out = 'themebuilder';
            } else {
                $out = 'pages';
            }
            return $out;
        }

        public function ajax_data()
        {
            $option_type = $this->choose_option_table($_POST['data']['type']);
            $nav = '';
            $data = get_option('the_pack_library');
            $products = $data[$option_type]; 
            if (is_array($products)) {
                $category = isset($_POST['data']['category']) ? $_POST['data']['category'] : '' ;
                $page_number = esc_attr($_POST['data']['page']);
                $search = isset($_POST['data']['search']) ? $_POST['data']['search'] : '' ;
                $limit = 30;
                $offset = 0;

                $current_page = 1;
                if (isset($page_number)) {
                    $current_page = (int)$page_number;
                    $offset = ($current_page * $limit) - $limit;
                }
                $search_filter = strtolower($search);
                //$paged = $total_products > count($paged_products) ? true : false;

                if (!empty($search_filter)) {
                    $filtered_products = [];
                    foreach ($products as $product) {
                        if (!empty($search_filter)) {
                            if (preg_match("/{$search_filter}/", strtolower($product['name']))) {
                                $filtered_products[] = $product;
                            }
                        }
                    }

                    $products = $filtered_products;
                }

                $paged_products = array_slice($products, $offset, $limit);
                $total_products = count($products);
                $total_pages = is_float($total_products / $limit) ? intval($total_products / $limit) + 1 : $total_products / $limit;

                //echo '<div class="filter-wrap"><a data-cat="" href="#">All</a>'.$nav.'</div>';
                echo '<div class="item-inner">';
                echo '<div class="item-wrap">';
                if (count($paged_products)) {
                    foreach ($paged_products as $product) {
                        $pro = $product['pro'] ? '<span class="pro">pro</span>' : '';
                        $parent_site = substr($product['thumb'], 0, strpos($product['thumb'], 'wp-content'));
                        if ($product['pro'] && !class_exists('The_Pack_Pro')) {
                            $btn = '<a target="_blank" href="' . self::$plugin_data['pro-link'] . '" class="buy-tmpl ' . $option_type . '"><i class="eicon-external-link-square"></i> Buy pro</a>';
                        } else {
                            $btn = '<a href="#" data-parentsite="' . $parent_site . '" data-id="' . $product['id'] . '" class="insert-tmpl ' . $option_type . '"><i class="eicon-file-download"></i> Insert</a>';
                        } ?>
					<div class="item">
						<div class="product">
							<div data-preview='<?php echo $product['preview']; ?>' class='lib-img-wrap'>
								<?php echo $pro; ?>
								<img src="<?php echo $product['thumb']; ?>">
								<i class="eicon-zoom-in-bold"></i>
							</div>
							<div class='lib-footer'>
									<p class="lib-name"><?php echo $product['name']; ?></p>
								<?php echo $btn; ?>
							</div>

						</div>
					</div>

					<?php
                    }
                    if ($total_pages > 1) {
                        $ends_count = 2;
                        $middle_count = 1;
                        $dots = false;
                        $cur_page = $_POST['data']['page'];

                        echo '</div><div class="pagination-wrap"><ul>';
                        for ($page_number = 1; $page_number <= $total_pages; $page_number++) {
                            if ($page_number == $cur_page) {?>
									<li class="page-item active"><a class="page-link" href="#" data-page-number="<?php echo $page_number; ?>"><?php echo $page_number; ?></a></li>
								<?php } else {
                                if ($page_number <= $ends_count || ($cur_page && $page_number >= $cur_page - $middle_count && $page_number <= $cur_page + $middle_count) || $page_number > $total_pages - $ends_count) { ?>
										<li class="page-item"><a class="page-link" href="#" data-page-number="<?php echo $page_number; ?>"><?php echo $page_number; ?></a></li>
									<?php $dots = true;
                                    } elseif ($dots) {
                                        echo '<li><a>&hellip;</a></li>';
                                        $dots = false;
                                    }
                            }
                        }
                        echo '</ul></div></div>';
                    }
                } else {
                    echo '<h3 class="no-found">No template found</h3>';
                }
                die();
            }
        }
    }

    The_Pack_Cloud_Library::init();
}
