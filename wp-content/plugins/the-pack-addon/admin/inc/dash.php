<?php

class The_Pack_Demo_Sites_Dash {

	private $importer_page = 'the-pack-demo';

	public function admin_pages() {

		$temp = 'Starter Sites';
		add_submenu_page( 
			'the-pack',
			$temp, 
			$temp,
			'manage_options',
			$this->importer_page,
			[ $this, 'display_import_page' ]
		);
	}

	public function display_import_page() {

		$data = get_option('the_pack_library');
		$out = '';
		$page_number = isset($_POST['data']['page']) ? $_POST['data']['page'] : '1' ;
		$limit = 8;
		$offset = 0;
		$current_page = 1;
		if (isset($page_number)) {
			$current_page = (int)$page_number;
			$offset = ($current_page * $limit) - $limit;
		}

		$paged_products = array_slice($data['sites'], $offset, $limit);
		$total_products = count($data['sites']);
		$total_pages = is_float($total_products / $limit) ? intval($total_products / $limit) + 1 : $total_products / $limit;
		
		
		foreach($paged_products as $demo) { 
			//var_dump($demo); News24_Cloud_Library::$plugin_data["remote_site"]
			$pro = $demo['pro'] ? '<span class="pro">pro</span>' : '';
			$btn = $demo['pro'] && !class_exists('The_Pack_Pro') ? 'purchase' : 'import';
			$url = $demo['pro'] && !class_exists('The_Pack_Pro') ? The_Pack_Cloud_Library::$plugin_data["pro-link"] : '#';

			$out.='
				<div class="demo">
					<img class="xlspinner" src="'.admin_url().'/images/spinner.gif">
					<div class="theme-screenshot">
						<img src="'.$demo['thumb'].'">
						'.$pro.'
					</div>
					<a class="more-details" target="_blank" href="'.$demo['preview'].'">Preview</a>
					<h3 class="theme-name">'.$demo['name'].'</h3>
					<div class="theme-actions">
						<a target="_blank" data-xml="'.$demo['xml_attachment'].'" data-front="'.$demo['homepage'].'" class="button button-primary btn-import-xml '.$btn.'" href="'.$url.'">'.$btn.'</a>
					</div>

				</div>
			';
		}

		?>
		<?php if ( !wp_doing_ajax() ) { echo '<div class="xlimwrap">'; } ?>
			<div class="tp-loader"></div>
	    	<div class="demo-inner">
	    		<?php echo $out;?>
	    	</div>

			<?php
				if ($total_pages > 1) {
					$ends_count = 2;
					$middle_count = 1;
					$dots = false;
					$cur_page = $page_number;

					echo '<div class="pagination-wrap"><ul>';
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
					echo '</ul></div>';
				}
			?>
	      
		  <?php if ( !wp_doing_ajax() ) { echo '</div>'; } ?>	

		<?php
		if ( wp_doing_ajax() ) {
			die();
		}
	}

	public function admin_scripts() {

		if (isset($_GET['page']) && $_GET['page'] == 'the-pack-demo'){

			 $data = array(
			   'ajax_url' => admin_url( 'admin-ajax.php' ),
			   'site_url' => home_url(),
			);
			 wp_enqueue_script('janelove_demo_admin', plugin_dir_url( __FILE__ ).'assets/admin.js',array('jquery','masonry'), '', true);
			 wp_enqueue_style('janelove_demo_admin', plugin_dir_url( __FILE__ ).'assets/admin.css');
			 wp_localize_script('janelove_demo_admin', 'janelove', $data );
		 }
	}

	public static function the_pack_import_xml(){

		$remote = \The_Pack_Cloud_Library::$plugin_data['remote_sites'];
		set_time_limit(0);

		// If the function it's not available, require it.

		if ( ! function_exists( 'download_url' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Now you can use it!
		$file_url = json_decode(wp_remote_retrieve_body(wp_remote_get($remote . 'wp-json/wp/v2/thepack_site_xml/?id=' . $_POST['xml'] )), true);

		$tmp_file = download_url( $file_url );

		// Sets file final destination.
		$filepath = ABSPATH . 'wp-content/data.xml';
		copy( $tmp_file, $filepath );
		@unlink( $tmp_file );

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

		require_once 'vendor/wordpress-importer/wordpress-importer.php';

		$wp_import = new WP_Import();
		$wp_import->fetch_attachments = true;
		ob_start();
		$wp_import->import($filepath);
		ob_end_clean();
		update_option('page_on_front',$_POST['frontpage']);
		update_option('show_on_front','page');

		@unlink( $filepath );
		\Elementor\Plugin::instance()->files_manager->clear_cache();
	
		$created_default_kit = \Elementor\Plugin::$instance->kits_manager->create_default();
		update_option(\Elementor\Core\Kits\Manager::OPTION_ACTIVE, $created_default_kit);

		$var = new \ThePackThemeBuilder\Modules\ThemeBuilder\Classes\Conditions_Cache();
		$var->regenerate();
		die();

	}

	function tmx_delete_upload_folder($path) {

		if(!empty($path) && is_dir($path) ){
			$dir  = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
			$files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::CHILD_FIRST);
			foreach ($files as $f) {if (is_file($f)) {unlink($f);} else {$empty_dirs[] = $f;} } if (!empty($empty_dirs)) {foreach ($empty_dirs as $eachDir) {rmdir($eachDir);}} rmdir($path);
		}
	}

	public function the_pack_clean_data(){

		global $wpdb;
		$tables = ['commentmeta','comments','postmeta','posts','termmeta','terms','term_relationships','term_taxonomy'];

		foreach ( $tables as $table ) {
			$table  = $wpdb->prefix . $table;
			$wpdb->query( "TRUNCATE TABLE $table" );
		}

		$upload_dir = wp_upload_dir(date('Y/m'), true);
		$upload_dir['basedir'] = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $upload_dir['basedir']);
		$this->tmx_delete_upload_folder($upload_dir['basedir']);

	}

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_pages' ], 600 );
		add_action( 'admin_print_scripts', array( $this, 'admin_scripts' ), 10 );
		add_action( 'wp_ajax_the_pack_import_xml', array( $this, 'the_pack_import_xml' ), 10 );
		add_action( 'wp_ajax_the_pack_clean_data', array( $this, 'the_pack_clean_data' ), 10 );

		add_action( 'wp_ajax_display_import_page', array($this,'display_import_page'));
		add_action( 'wp_ajax_nopriv_display_import_page', array($this,'display_import_page')); 

	}
}

new The_Pack_Demo_Sites_Dash();
