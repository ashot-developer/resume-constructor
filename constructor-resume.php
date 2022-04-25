<?php
/*
 * Plugin Name: Constructor Resume
 * Plugin URI: google.com
 * Description: Plugin for building resume
 * Version: 1.0.0
 * Author: Ashot Markosyan
 * Author URI: google.com
 */


define('CONSTRUCTOR_RESUME_DIR', plugin_dir_path(__FILE__));
define('CONSTRUCTOR_RESUME_URL', plugin_dir_url(__FILE__));
define('FORM_SHORTCODE_NAME', 'resume-form');

// connection styles and scrits.


function add_theme_scripts()
{

	wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap&subset=cyrillic,cyrillic-ext,latin-ext', array(), '');
	wp_enqueue_style('bootstrap-css', CONSTRUCTOR_RESUME_URL . 'assets/css/bootstrap.min.css', array('fonts'), '');
	wp_enqueue_style('main-style', CONSTRUCTOR_RESUME_URL . 'assets/css/main.css', array('fonts'), '');
	wp_enqueue_style('pdf-style', CONSTRUCTOR_RESUME_URL . 'assets/css/pdf.css', array('fonts'), '');
	wp_enqueue_style('media-style', CONSTRUCTOR_RESUME_URL . 'assets/css/media.css', array('fonts'), '');
	//wp_enqueue_style( 'gijgo-style', CONSTRUCTOR_RESUME_URL . 'assets/css/gijgo.min.css', array('fonts'), '');
	wp_enqueue_style('date-style', CONSTRUCTOR_RESUME_URL . 'assets/css/jquery.datepick.css', array('fonts'), '');


	wp_enqueue_script('script-odsdk', CONSTRUCTOR_RESUME_URL . 'assets/js/gijgo.min.js', array('jquery'), '', true);
	wp_enqueue_script('script-bootstrap', CONSTRUCTOR_RESUME_URL . 'assets/js/bootstrap.min.js', array('jquery'), '', true);
	//  wp_enqueue_script( 'script-gi', CONSTRUCTOR_RESUME_URL . 'assets/js/messages.ru-ru.min.js', array ( 'jquery' ), '', true);
	wp_enqueue_script('script-main', CONSTRUCTOR_RESUME_URL . 'assets/js/main.js', array('jquery'), '', true);
	wp_enqueue_script('date-main-script', CONSTRUCTOR_RESUME_URL . 'assets/js/jquery.plugin.js', array('jquery'), '', false);
	wp_enqueue_script('date-main', CONSTRUCTOR_RESUME_URL . 'assets/js/jquery.datepick.js', array('jquery'), '', false);
	wp_enqueue_script('date-loc-main', CONSTRUCTOR_RESUME_URL . 'assets/js/jquery.datepick-ru.js', array('jquery'), '', false);

	wp_localize_script('script-main', 'myScript', array(
		'pluginsUrl' => CONSTRUCTOR_RESUME_URL,
		'pluginsDir' => CONSTRUCTOR_RESUME_DIR,
	));
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

// functions activation and deactivetion plugin

register_activation_hook(__FILE__, 'cosntructor_resume_activation');
register_deactivation_hook(__FILE__, 'cosntructor_resume_deactivation');

function cosntructor_resume_activation()
{
	add_action('wp_enqueue_scripts', 'add_theme_scripts');
	create_table();
	create_data_table();
}

function cosntructor_resume_deactivation()
{
	remove_action('wp_enqueue_scripts', 'add_theme_scripts');
	delete_table();
}

// При активации плагина создаеть таблица
function create_table()
{
	global $wpdb;
	// задаем название таблицы
	$table_name = $wpdb->get_blog_prefix() . 'resume';
	// проверяем есть ли в базе таблица с таким же именем, если нет - создаем.
	if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		// устанавливаем кодировку
		$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
		// подключаем файл нужный для работы с bd
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		// запрос на создание
		$sql = "CREATE TABLE {$table_name} (
	id int(11) unsigned NOT NULL auto_increment,
	pdf_name varchar(255) NOT NULL default '',
	file_url varchar(255) NOT NULL default '',
	unic_code varchar(255) NOT NULL default '',
	payment_status int(11) unsigned NOT NULL default '0',
	created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY  (id)
	) {$charset_collate};";
		// Создать таблицу.
		dbDelta($sql);
	}
}

function create_data_table()
{
	global $wpdb;
	// задаем название таблицы
	$table_name = $wpdb->get_blog_prefix() . 'resume_data';
	// проверяем есть ли в базе таблица с таким же именем, если нет - создаем.
	if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		// устанавливаем кодировку
		$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
		// подключаем файл нужный для работы с bd
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		// запрос на создание
		$sql = "CREATE TABLE {$table_name} (
	id int(11) unsigned NOT NULL auto_increment,
	unic_key varchar(255) NOT NULL default '',
	form_data text(1000) NOT NULL default '',
	PRIMARY KEY  (id)
	) {$charset_collate};";
		// Создать таблицу.
		dbDelta($sql);
	}
}

// При деактивации плагина удаляет таблица
function delete_table()
{
	global $wpdb;
	$table_name = $wpdb->get_blog_prefix() . 'resume';
	$wpdb->query("DROP TABLE IF EXISTS $table_name");

	$table_name_2 = $wpdb->get_blog_prefix() . 'resume_data';
	$wpdb->query("DROP TABLE IF EXISTS $table_name_2");
}

//conection php files

include CONSTRUCTOR_RESUME_DIR . 'includes/form-generation.php';

include CONSTRUCTOR_RESUME_DIR . 'includes/create-menu.php';

include CONSTRUCTOR_RESUME_DIR . 'includes/form-data-createing.php';

include CONSTRUCTOR_RESUME_DIR . 'includes/pdf.php';

include CONSTRUCTOR_RESUME_DIR . 'includes/upload.php';
