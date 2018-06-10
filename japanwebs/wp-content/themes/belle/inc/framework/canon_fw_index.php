<?php

/**************************************
INDEX

PHP INCLUDES
BUNDLED PLUGINS AUTOMATIC UPDATE CHECKER

***************************************/


/**************************************
PHP INCLUDES
***************************************/

	//framework sets
	include get_template_directory() . '/inc/framework/canon_fw_functions.php';
	include get_template_directory() . '/inc/framework/canon_fw_option.php';
	include get_template_directory() . '/inc/framework/canon_fw_option_help.php';
	include get_template_directory() . '/inc/framework/canon_fw_cmb_option.php';



/**************************************
BUNDLED PLUGINS AUTOMATIC UPDATE CHECKER
***************************************/

	// add action
	add_action('init', 'init_canon_auc');

	// init
	if (!function_exists("init_canon_auc")) { function init_canon_auc() {	
	    new canon_auc();
	}}

	class canon_auc {

		// CONSTRUCT
		function __construct() {
			add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_updates'));	
			add_filter('plugins_api', array(&$this, 'check_info'), 10, 3);
		}


		public function check_updates($transient) {

			$tgm_plugins = canon_get_tgm_plugins_array();
			$all_plugins = get_plugins();

			// first check if plugin auc is set to true
			foreach ($tgm_plugins as $key => $tgm_plugin) {
				if (isset($tgm_plugin['canon_auc'])) { if ($tgm_plugin['canon_auc']) {

					// skip if tgm plugin is not currently installed
					$tgm_plugin_file = $tgm_plugin['canon_auc_plugin_file'];
					if (!isset($all_plugins[$tgm_plugin_file])) { continue; }

					// get current plugin version
					$tgm_plugin_file = $tgm_plugin['canon_auc_plugin_file'];
					$tgm_plugin_current_version = $all_plugins[$tgm_plugin_file]['Version'];

					// get latest version
					$tgm_plugin_latest_version = $tgm_plugin['version'];

					// compare and add to transient if newer version is found			
					if (version_compare($tgm_plugin_current_version, $tgm_plugin_latest_version, "<")) {

						$tgm_plugin_slug = $tgm_plugin['slug'];
						$tgm_plugin_source = $tgm_plugin['source'];

				        $obj = new stdClass();
				        $obj->slug = $tgm_plugin_slug;
				        $obj->plugin = $tgm_plugin_file;
				        $obj->new_version = $tgm_plugin_latest_version;
				        $obj->url = $tgm_plugin_source;
				        $obj->package = $tgm_plugin_source;
				        $transient->response[$tgm_plugin_file] = $obj;

					}

				}}

			}	

			// var_dump($transient);
	        return $transient;

		}	


		public function check_info($false, $action, $arg) {
			
			$tgm_plugins = canon_get_tgm_plugins_array();
			$all_plugins = get_plugins();


			foreach ($tgm_plugins as $key => $tgm_plugin) {
				if (isset($tgm_plugin['canon_auc'])) { if ($tgm_plugin['canon_auc']) {

					// skip if tgm plugin is not currently installed
					$tgm_plugin_file = $tgm_plugin['canon_auc_plugin_file'];
					if (!isset($all_plugins[$tgm_plugin_file])) { continue; }

					// if match then edit info
					$tgm_plugin_slug = $tgm_plugin['slug'];

				    if (isset($arg->slug)) { if ($arg->slug === $tgm_plugin_slug) {

						// build new info
						$obj = new stdClass();
						$obj->name = (isset($tgm_plugin['canon_auc_info']['name'])) ? $tgm_plugin['canon_auc_info']['name'] : $tgm_plugin['name'];
						$obj->slug = (isset($tgm_plugin['canon_auc_info']['slug'])) ? $tgm_plugin['canon_auc_info']['slug'] : $tgm_plugin['slug'];
						$obj->requires = (isset($tgm_plugin['canon_auc_info']['requires'])) ? $tgm_plugin['canon_auc_info']['requires'] : "3.0";
						$obj->tested = (isset($tgm_plugin['canon_auc_info']['tested'])) ? $tgm_plugin['canon_auc_info']['tested'] : "4.2";
						$obj->last_updated = (isset($tgm_plugin['canon_auc_info']['last_updated'])) ? $tgm_plugin['canon_auc_info']['last_updated'] : "";
						$obj->sections = (isset($tgm_plugin['canon_auc_info']['sections'])) ? $tgm_plugin['canon_auc_info']['sections'] : array('description' => 'Bundled plugin.');
						$obj->download_link = 'http://localhost/update.php';
						$obj->version = (isset($tgm_plugin['canon_auc_info']['version'])) ? $tgm_plugin['canon_auc_info']['version'] : $tgm_plugin['version'];
						$obj->author = (isset($tgm_plugin['canon_auc_info']['author'])) ? $tgm_plugin['canon_auc_info']['author'] : "";
						// $obj->plugin_name = $tgm_plugin['name'];
						// $obj->downloaded = 12540;

				        $information = $obj;
				        return $information;
				    }}

				}}
			}

		    return false;

		}	

	}	// end class

