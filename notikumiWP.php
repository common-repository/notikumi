<?php
/*
Plugin Name: notikumiWP
Plugin URI: http://www.notikumi.com/static/resources/wordpress
Description: notikumi es una agenda cultural y ocio. Te ofrecemos contenido para tú sección de eventos. ¡Gratis! www.notikumi.com
Version: 1.0.5
Author: notikumi
Author URI: http://www.notikumi.com
License: A GPL2
*/

define('NTKWP_VERSION', '1.0.5');

if (!class_exists("NotikumiWP")) {
	
	class NotikumiWP {
		// vars
		var $adminOptionsName = "notikumiWPAdminOptions";
		
		//constructor
		function NotikumiWP() { 
		}
		function ntk_init() {
			$this->getAdminOptions();
		}
		
		
		
		//Returns an array of admin options
		function getAdminOptions() {
			$notikumiWPAdminOptions = array('apikey' => '');
			$devOptions = get_option($this->adminOptionsName);
			if (!empty($devOptions)) {
				foreach ($devOptions as $key => $option) {
					$notikumiWPAdminOptions[$key] = $option;
				}
			}      
			update_option($this->adminOptionsName, $notikumiWPAdminOptions);
			return $notikumiWPAdminOptions;
		}
		
		//Prints out the admin page
		// save to options when the form is sent 
		function printAdminPage() {
			
			/*
			 * recuperar options
			 */
			$devOptions = $this->getAdminOptions();
			
			// si envían formulario
			if (isset($_POST['update_notikumiWPSettings'])) {		
						
				// Tratamiento del formulario enviado
				$devOptions = catch_form($devOptions);
					
				// Calculo de la firma
				$devOptions['notikumiWP_signature']  = make_signature($devOptions);
				
				// save options
				update_option($this->adminOptionsName, $devOptions);
			}
			
			
			// print admin HTML
			include_once("html/admin.html.php");
			
		}//End function printAdminPage() 			
			
	} // End class
	
	
	
	// create instance
	if (class_exists("NotikumiWP")) {
		$NotikumiWPimpl = new NotikumiWP();
	}
	
	
	
	/*
	 * include public functions
	*/
	include_once("src/functions.php");
	
	/*
	 * include admin functions
	*/
	include_once("src/admin-functions.php");
	
	
	
	/*
	 * Actions, Shortcodes and Filters
	 */
	if (isset($NotikumiWPimpl)) {		
		//Actions
		add_action('notikumiWP/notikumiWP.php', array(&$NotikumiWPimpl, 'ntk_init'));
		add_action('admin_menu', 'NotikumiWP_admin_panel');
		add_action('admin_init', 'NotikumiWP_admin_init' );
		
		// Shortcode
		add_shortcode('NTK', 'ntk_displayNotikumiScript');
		
		//Filters		
	}
	
	
 	/*
 	 * Initialize the admin panel
 	 */
	if (!function_exists("NotikumiWP_admin_panel")) {		
		function NotikumiWP_admin_panel() {
			global $NotikumiWPimpl;
			if (!isset($NotikumiWPimpl)) {
				return;
			}
			if (function_exists('add_options_page')) {
				$page = add_options_page('notikumi', 'notikumi', 9, basename(__FILE__), array(&$NotikumiWPimpl, 'printAdminPage'));
				
				add_action('admin_print_styles-' . $page, 'NotikumiWP_admin_loadScripts');
				
			}
		}		
	}
	
	
	if (!function_exists("NotikumiWP_admin_init")) {
		function NotikumiWP_admin_init(){
			wp_register_script('jquery-ui-autocomplete', plugins_url('js/jquery/jquery.ui.autocomplete.min.js', __FILE__ ), array( 'jquery-ui-widget', 'jquery-ui-position' ), '1.8.16', true );
			
			wp_enqueue_style('jquery-ui', 		plugins_url('/css/jquery/jquery-ui-1.8.19.custom.css', __FILE__ ));
			
			wp_enqueue_style('colorpicker', 		plugins_url('/css/colorpicker/css/colorpicker.css', __FILE__ ));
			
			wp_register_script('colorpicker-c', 	plugins_url('js/colorpicker/colorpicker.js', __FILE__ ), false, "1.0", false );
			
			wp_register_script('ntk_fn', 		plugins_url('js/notikumi_fn_widget.js', __FILE__ ), false, "1.0", false );
			wp_register_script('ntk_init', 		plugins_url('js/notikumi_init_widget.js', __FILE__ ), false, "1.0", false );
				
			wp_enqueue_style('ntk_styles', 		plugins_url('/css/styles.css', __FILE__ ));
			
		}
	}
	
	
	function NotikumiWP_admin_loadScripts() {
		
		wp_enqueue_script('jquery-ui-autocomplete');
		wp_enqueue_script('colorpicker-c');
		
		wp_enqueue_script('ntk_fn');
		wp_enqueue_script('ntk_init');
	}
	
	
	

}
?>