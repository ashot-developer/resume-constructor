<?php
add_action('admin_menu', function () {

	add_menu_page('Resume form shortcode', 'Const. Resume', 'manage_options', 'resume-constructor', function () {
		add_my_setting($_GET['id']);
	}, CONSTRUCTOR_RESUME_URL . 'assets/img/profile.png', 4);
});

// функция отвечает за вывод страницы настроек
// подробнее смотрите API Настроек: http://wp-kama.ru/id_3773/api-optsiy-nastroek.html
function add_my_setting($id)
{
?>
	<div class="wrap">
		<h2><?php echo get_admin_page_title() ?></h2>

		<p>For using constructor resume form add in your code or page this shortcode - [<?= FORM_SHORTCODE_NAME ?>]</p>
		<?= $id; ?>
	</div>
<?php

}

function add_options()
{
	add_submenu_page('resume-constructor', 'Success', 'Success', true, 'success', function () {
		menu_success();
	}, 1);
	add_submenu_page('resume-constructor', 'Fail', 'Fail', true, 'fail', function () {
		menu_fail();
	}, 2);
	add_submenu_page('resume-constructor', 'Notify', 'Notify', true, 'Notify', function () {
		menu_notify();
	}, 3);
}

add_action('admin_menu', 'add_options');

function menu_success()
{
	var_dump($_REQUEST);
}

function menu_fail()
{
	var_dump($_REQUEST);
}

function menu_notify()
{
	var_dump($_REQUEST);
}
