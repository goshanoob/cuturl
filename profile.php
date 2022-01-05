<?php
include_once 'includes/functions.php';
if (empty($_SESSION['id'])) {
	header('Location: /');
	return;
}

$users_links = get_users_links($_SESSION['id']);
?>
<!doctype html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<title>Cut URL</title>
	<script src="js/copyScript.js"></script>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="index.php">Cut URL</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="index.php">Главная</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="profile.php">Профиль</a>
						</li>
					</ul>
					<form class="d-flex" action="includes/add.php" method="post">
						<input class="form-control me-2" type="text" placeholder="Ссылка" aria-label="Ссылка" name="link">
						<button class="btn btn-success" type="submit"><i class="bi bi-plus-lg"></i></button>
					</form>
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a href="includes/logout.php" class="btn btn-primary">Выйти</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<main class="container">
		<?php include_once 'includes/messages.php'; ?>
		<div class="row mt-5">
			<table class="table table-striped">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Ссылка</th>
						<th scope="col">Сокращение</th>
						<th scope="col">Переходы</th>
						<th scope="col">Действия</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users_links as $key => $value) : ?>
						<tr>
							<th scope="row"><?= $key + 1; ?></th>
							<td><a href="<?= $value['long_link']; ?>" target="_blank"><?= $value['long_link']; ?></a></td>
							<td class="short-link"><?= $value['short_link']; ?></td>
							<td><?= $value['views']; ?></td>
							<td>
								<a href="#" class="btn btn-primary btn-sm copy-btn" title="Скопировать в буфер" data-clipboard-text="<?= HOST . '/' . $value['short_link']; ?>"><i class="bi bi-files"></i></a>
								<a href="includes/edit_link.php?link_id=<?= $value['id']; ?>&long_link=<?= $value['long_link']; ?>" class="btn btn-warning btn-sm" title="Редактировать"><i class="bi bi-pencil"></i></a>
								<a href="includes/delete.php?link_id=<?= $value['id']; ?>" class="btn btn-danger btn-sm" title="Удалить"><i class="bi bi-trash"></i></a>
							</td>
						</tr>
					<?php endforeach ?>

				</tbody>
			</table>
		</div>
	</main>
	<div aria-live="polite" aria-atomic="true" class="position-relative">
		<div class="toast-container position-absolute top-0 start-50 translate-middle-x">
			<div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="d-flex">
					<div class="toast-body">
						Ссылка скопирована в буфер
					</div>
					<button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
			</div>
		</div>
	</div>
	<?php include_once 'includes/footer.php'; ?>