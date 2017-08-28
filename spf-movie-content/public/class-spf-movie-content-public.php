<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/public
 * @author     Your Name <email@example.com>
 */
class Spf_Movie_Content_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $spf_movie_content    The ID of this plugin.
	 */
	private $spf_movie_content;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $spf_movie_content       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $spf_movie_content, $version ) {

		$this->spf_movie_content = $spf_movie_content;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Spf_Movie_Content_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Spf_Movie_Content_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->spf_movie_content, plugin_dir_url( __FILE__ ) . 'css/spf-movie-content-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Spf_Movie_Content_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Spf_Movie_Content_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->spf_movie_content, plugin_dir_url( __FILE__ ) . 'js/spf-movie-content-public.js', array( 'jquery' ), $this->version, false );

	}
	
	public function get_movie_post_type_template($single_template) {
		 global $post;
		
		 if ($post->post_type == 'spf_movie') {
		      $single_template = plugin_dir_path( dirname( __FILE__ ) ) .'public/partials/single-movie.php';
		 }
		 return $single_template;
	}
	
    // from http://snipplr.com/view/74493/adjacent-post-by-alphabetical-order-in-wordpress/
	public function filter_next_post_sort($sort) {
	  $sort = "ORDER BY p.post_title ASC LIMIT 1";
	  return $sort;
	}
	
	public function filter_next_post_where($where) {
	  global $post, $wpdb;
	 
	  return $wpdb->prepare("WHERE p.post_title > '%s' AND p.post_type = 'spf_movie' AND p.post_status = 'publish'",$post->post_title);
	}
		 
	public function filter_previous_post_sort($sort) {
	  $sort = "ORDER BY p.post_title DESC LIMIT 1";
	  return $sort;
	}
	
	public function filter_previous_post_where($where) {
	  global $post, $wpdb;
	 
	  return $wpdb->prepare("WHERE p.post_title < '%s' AND p.post_type = 'spf_movie' AND p.post_status = 'publish'",$post->post_title);
	}
	public function alpha_title_sort_order($query){

	  if (is_post_type_archive( 'spf_movie' )) {
		//If you wanted it for the archive of a custom post type use: 
		//Set the order ASC or DESC
	    $query->set( 'order', 'ASC' );
	    //Set the orderby
	    $query->set( 'orderby', 'title' );
	  }
	
	}
}
