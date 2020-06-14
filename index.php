<?php 
/**
 * Plugin Name: Da Slider
 * Author: David
 * Description: Bootstrap Carousel Slider
 * Version: 0.1
 */

 
if( !defined('WPINC') ){
    die;
}

class Da_Slider
{
	public function __construct()
	{
		// Add to menu
		add_action('admin_menu', array($this, 'add_menu'));

		// Add scripts to the dashboard
		add_action('admin_enqueue_scripts', array($this, 'addons'));
		// Add scripts to the site
		add_action('wp_enqueue_scripts', array($this, 'my_scripts'));
		
		// When activated. Call create_table, and insert data method
		register_activation_hook( __FILE__, array($this, 'create_table'));
		register_activation_hook( __FILE__, array($this, 'insert_data'));
		// When deactivated. Delete data from the data base
		register_deactivation_hook( __FILE__, array($this, 'delete_table'));

		// CREATE. UPDATE and DELETE
		add_action('admin_post_create_slide', array($this, 'post'));
		add_action('admin_post_update_slide', array($this, 'put'));
		add_action('admin_post_delete_slide', array($this, 'delete'));

		add_shortcode('my-slider', array($this, 'code'));
	}

	public function add_menu(){
		add_menu_page(
			'Da Slider',
			'Da Slider',
			0,
			'da-slider',
			array($this, 'view'),
			'dashicons-images-alt2'
		);
	}

	// Files for the plugin
	public function addons(){
		wp_enqueue_media('media');
		wp_enqueue_script('jQuery');
		wp_enqueue_script('bootstrap_js', plugins_url('js/bootstrap.min.js', __FILE__));
		wp_enqueue_script('media_files', plugins_url('js/media.js', __FILE__));
		wp_enqueue_style('bootstrap_css', plugins_url('css/bootstrap.min.css', __FILE__));
		wp_enqueue_style('my_styles', plugins_url('css/style.css', __FILE__));
	}

	// Files for the site
	public function my_scripts(){
		wp_enqueue_script('jQuery');
		wp_enqueue_script('media_files', plugins_url('js/media.js', __FILE__));
		wp_enqueue_style('bootstrap_css', plugins_url('css/bootstrap.min.css', __FILE__));
		wp_enqueue_style('my_styles', plugins_url('css/style.css', __FILE__));
	}

	// VIEW
	public function view(){
		$slider = $this->get();

		require 'view.php';
	}

	// When activated
	public function create_table(){
		global $wpdb;
		$installed_ver = get_option("jal_db_version");

		$table_name = $wpdb->prefix . 'da_slider';// -> wp_da_slider
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  img varchar(255) DEFAULT '' NOT NULL,
		  title varchar(255) DEFAULT '' NOT NULL,
		  content varchar(255) DEFAULT '' NOT NULL,
		  PRIMARY KEY  (id)
		) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);		
	}

	public function insert_data(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'da_slider';

		$img = plugins_url('img/01.jpg', __FILE__);
		// Photo by Suzy Hazelwood from Pexels

		$title = 'TITLE EX';
		$content = 'DA SLIDER EXAMPLE CONTENT';

		$wpdb->query($wpdb->prepare(
			"INSERT INTO $table_name (img, title, content) 
			VALUES ('$img', '$title', '$content')",
			$_POST['img'],$_POST['title'],$_POST['content']
		));
	}

	public function delete_table(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'da_slider';
    	$wpdb->query("DROP TABLE IF EXISTS $table_name");
	}

	/* GET */
	public function get(){
		global $wpdb;

		return $wpdb->get_results("SELECT * FROM wp_da_slider");
	}

	/* POST */
	public function post(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'da_slider';

		$wpdb->query($wpdb->prepare(
			"INSERT INTO $table_name (img, title, content) VALUES (%s, %s, %s)",
			$_POST['img'],$_POST['title'],$_POST['content']
		));
		wp_redirect(wp_get_referer());
	}

	/* UPDATE */
	public function put(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'da_slider';

		$wpdb->query($wpdb->prepare(
			"UPDATE $table_name SET img=%s, title=%s, content=%s WHERE id=%d",
			$_POST['update_img'],$_POST['update_title'],$_POST['update_content'],$_GET['id']
		));
		wp_redirect(wp_get_referer());
	}

	/* DELETE */
	public function delete(){
		global $wpdb;
		$table_name = $wpdb->prefix . 'da_slider';

		$wpdb->query($wpdb->prepare(
			"DELETE FROM $table_name WHERE id=%d",
			$_GET['id']
		));
		wp_redirect(wp_get_referer());
	}

	/* SITE CODE */
	public function code(){
		$slider = $this->get();

		include 'code.php';
	}
}

$newSlider = new Da_Slider();