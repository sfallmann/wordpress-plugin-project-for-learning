<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/includes
 * @author     Your Name <email@example.com>
 */
class Spf_Movie_Content_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-spf-movie-content-admin.php';
		Spf_Movie_Content_Admin::remove_movie_content();
    	flush_rewrite_rules();
	}

}
