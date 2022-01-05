<?php
// Принятый здесь принцип разделения кода: обработка форм производится в отдельных скриптах или на страницах с соответствующими формами, функции работы с базой данных, общие для всего сайта, вынесены в functions.php, запись в массив $_SESSION происходит на страницах, но не в функциях functions.php.

include_once "includes/header.php";
echo SITE_NAME;

if (!empty($_GET['url'])) {
	$links = get_links($_GET['url']);
	if (!empty($links)) {
		update_link_views($links['short_link']);
		header('Location: ' . $links['long_link']);
	} else {
		header('Location: /404.php');
	}
	return;
}
?>
<main class="container">
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Необходимо <a href="register.php">зарегистрироваться</a> или <a href="login.php">войти</a> под своей учетной записью</h2>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Пользователей в системе: <?= get_users_count(); ?></h2>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Ссылок в системе: <?= get_links_count(); ?></h2>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Всего переходов по ссылкам: <?= get_views_count(); ?></h2>
		</div>
	</div>
</main>
<?php include_once "includes/footer.php"; ?>