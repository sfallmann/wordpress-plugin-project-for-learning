<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Spf_Movie_Content
 * @subpackage Spf_Movie_Content/admin
 * @author     Your Name <email@example.com>
 */
class Spf_Movie_Content_Admin {

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

  private $moviedb_content_loaded;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $spf_movie_content       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $spf_movie_content, $version ) {

		$this->spf_movie_content = $spf_movie_content;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->spf_movie_content, plugin_dir_url( __FILE__ ) . 'css/spf-movie-content-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->spf_movie_content, plugin_dir_url( __FILE__ ) . 'js/spf-movie-content-admin.js', array( 'jquery' ), $this->version, false );

	}

  public static function register_movie_post_type() {

    $labels = array(
      'name'                  => _x( 'Movies', 'Post Type General Name', 'text_domain' ),
      'singular_name'         => _x( 'Movie', 'Post Type Singular Name', 'text_domain' ),
      'menu_name'             => __( 'Movies', 'text_domain' ),
      'name_admin_bar'        => __( 'Movie', 'text_domain' ),
      'archives'              => __( 'Movie Archives', 'text_domain' ),
      'attributes'            => __( 'Movie Attributes', 'text_domain' ),
      'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
      'all_items'             => __( 'All Movies', 'text_domain' ),
      'add_new_item'          => __( 'Add New Movie', 'text_domain' ),
      'add_new'               => __( 'Add New Movie', 'text_domain' ),
      'new_item'              => __( 'New Movie', 'text_domain' ),
      'edit_item'             => __( 'Edit Movie', 'text_domain' ),
      'update_item'           => __( 'Update Movie', 'text_domain' ),
      'view_item'             => __( 'View Movie', 'text_domain' ),
      'view_items'            => __( 'ViewMovies', 'text_domain' ),
      'search_items'          => __( 'Search Movie', 'text_domain' ),
      'not_found'             => __( 'Not found', 'text_domain' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
      'featured_image'        => __( 'Featured Image', 'text_domain' ),
      'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
      'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
      'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
      'insert_into_item'      => __( 'Insert into Movie', 'text_domain' ),
      'uploaded_to_this_item' => __( 'Uploaded to this Movie', 'text_domain' ),
      'items_list'            => __( 'Movies list', 'text_domain' ),
      'items_list_navigation' => __( 'Movies list navigation', 'text_domain' ),
      'filter_items_list'     => __( 'Filter Movies list', 'text_domain' ),
    );

    $args = array(
      'label'                 => __( 'Movie', 'text_domain' ),
      'description'           => __( 'Post Type Description', 'text_domain' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'author', 'thumbnail', ),
      'taxonomies'            => array( 'category', 'post_tag' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,		
      'exclude_from_search'   => false,
      'publicly_queryable'    => true,
      'capability_type'       => 'page',
    );

    register_post_type( 'spf_movie', $args );

  }

  public static function create_movie_content() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-spf-movie-content-utils.php';

    $movies = get_movies();
    foreach ($movies as $movie) {

      $poster_path = $movie['poster_path'];
      $id = wp_insert_post(array(
        'post_title'=>$movie['title'],
        'post_content'=>$movie['overview'],
        'post_type'=>'spf_movie',
        'post_status'=>'publish'
      ), $wp_error);
      add_post_meta( $id, '_poster_path', $poster_path, true );
      self::get_poster($poster_path, $id);
    }
    
  }

  public static function get_poster($poster_path, $id) {
  	$image_url = 'https://image.tmdb.org/t/p/w342/';
  	
  	$img_ext = substr($poster_path, strpos($poster_path, ".") + 1);
  	$movie_slug = get_post_field( 'post_name', get_post($id) );
  	$img_name = $movie_slug.'-poster.'.$img_ext;
  	
  	$img_id = media_sideload_image("$image_url/$poster_path", $id, $img_name, 'id');
    set_post_thumbnail( $id, $img_id );
  }
  
  public static function new_attachment( $att_id ){
    // the post this was sideloaded into is the attachments parent!

    // fetch the attachment post
    $att = get_post( $att_id );

    // grab it's parent
    $post_id = $att->post_parent;

    // set the featured post
    
  }
  
  public static function remove_movie_content(){
    $args = array(
      'numberposts' => -1,
      'post_type'   => 'spf_movie'
    );
    $movies = get_posts($args);
    
    foreach ($movies as $movie) {
      $post_id = $movie->ID;
      $att_id = get_post_thumbnail_id(  $post_id );
      wp_delete_attachment( $att_id );      
      wp_delete_post( $post_id, true );
      
    }
  }

}

?>