<?php
/*
Plugin Name: Custom Bootstrap Editor
Plugin URI: https://github.com/bassjobsen/custom-bootstrap-editor
Description: Add Twitter's Bootstrap CSS with LESS editor to your site.
Version: 1.0.1
Author: Bass Jobsen
Author URI: http://bassjobsen.weblogs.fm/
License: GPLv2
*/

/*  Copyright 2013 Bass Jobsen (email : bass@w3masters.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


if(!class_exists('Custom_Bootstrap_Editor')) 
{ 
	
class Custom_Bootstrap_Editor 
{ 

	private	$customlesscode, $folder,$filename,$folderurl;
        
	
/*
* Construct the plugin object 
*/ 
public function __construct() 
{ 
	load_plugin_textdomain( 'cbe', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
 	// register actions 
	add_action('admin_init', array(&$this, 'admin_init')); 
	add_action('admin_menu', array(&$this, 'add_menu')); 
	
        $upload_dir = wp_upload_dir();
        $this->folder = trailingslashit($upload_dir['basedir']).'cbe/';
        $this->folderurl = trailingslashit($upload_dir['baseurl']).'cbe/'; 
        $this->filename = 'custombootstrap.css';

	
	
	add_filter( 'init', array( $this, 'init' ) );
} 
// END public 

/** 
 * Activate the plugin 
**/ 
public static function activate() 
{ 
	// Do nothing 
} 
// END public static function activate 

/** 
 * Deactivate the plugin 
 * 
**/ 
public static function deactivate() 
{ 

$upload_dir = wp_upload_dir();
$folder = trailingslashit($upload_dir['basedir']).'cbe/';
$filename = 'custombootstrap.css';
unlink($folder.$filename);
rmdir($folder);
} 
// END public static function deactivate 

/** 
 * hook into WP's admin_init action hook 
 * */ 
 
public function admin_init() 
{ 
	// Set up the settings for this plugin 
	
	$this->init_settings(); 
	// Possibly do additional admin_init tasks 
} 
// END public static function activate - See more at: http://www.yaconiello.com/blog/how-to-write-wordpress-plugin/#sthash.mhyfhl3r.JacOJxrL.dpuf

/** * Initialize some custom settings */ 
public function init_settings() 
{ 
	// register the settings for this plugin 
	register_setting('cbe-group', 'customlesscode'); 
	register_setting('cbe-group', 'cbeversion'); 
} // END public function init_custom_settings()


function load_options() {
		$this->customlesscode = get_option('customlesscode');

	}
	function reset_options() {
		delete_option($this->customlesscode);
		unset($this->customlesscode);
		$this->load_options();
	}
	
	function save_options() {
	
		update_option('customlesscode',$this->customlesscode);
		update_option('cbeversion',time());
		
	}
	

/** * add a menu */ 
public function add_menu() 
{
	 
	 add_options_page('Custom Bootstrap Editor', 'Custom Bootstrap Editor', 'manage_options', 'custom-bootstrap-editor', array(&$this, 'Custom_Bootstrap_Editor_settings_page'));
} // END public function add_menu() 

/** * Menu Callback */ 
public function Custom_Bootstrap_Editor_settings_page() 
{ 
	if(!current_user_can('manage_options')) 
	{ 
		wp_die(__('You do not have sufficient permissions to access this page.')); 
	
	} 
// Render the settings template 

include(sprintf("%s/templates/settings.php", dirname(__FILE__))); 

} 
// END public function plugin_settings_page() 

	



function init()
{

		$this->load_options();
		
		
		/* load css from upload dir */
		
		
		
		wp_enqueue_style( 'bootstrap', $this->folderurl.$this->filename, array(),get_option('cbeversion',1)  ); 
}
		



} // END class 

}

if(class_exists('Custom_Bootstrap_Editor')) 
{ // Installation and uninstallation hooks 
	register_activation_hook(__FILE__, array('Custom_Bootstrap_Editor', 'activate')); 
	register_deactivation_hook(__FILE__, array('Custom_Bootstrap_Editor', 'deactivate')); 
	
	$cbe = new Custom_Bootstrap_Editor();
	// Add a link to the settings page onto the plugin page 
	if(isset($cbe))
	{
		
		 function Custom_Bootstrap_Editor_settings_link($links) 
		 { 
			 $settings_link = '<a href="options-general.php?page=custom-bootstrap-editor">'.__('Settings','cbe').'</a>';
			 array_unshift($links, $settings_link); 
			
			 return $links; 
		 } 	
		 $plugin = plugin_basename(__FILE__); 
		 	
		
		 add_filter("plugin_action_links_$plugin", 'Custom_Bootstrap_Editor_settings_link'); 
	}
	
}

