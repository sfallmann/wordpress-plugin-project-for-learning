<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/includes
 * @author     Your Name <email@example.com>
 */
class Spf_Movie_Content_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-spf-movie-content-admin.php';
		Spf_Movie_Content_Admin::create_movie_content();
	}

}
