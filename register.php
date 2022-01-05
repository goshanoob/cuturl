<?php
include_once "includes/header.php";
if (!empty($_SESSION['id'])) {
	header('Location: /profile.php');
	return;
}

if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
	$login = $_POST['login'];
	$password = $_POST['password'];
	if ($password !== $_POST['password2']) {
		$_SESSION['error'] = 'Пароли не совпали';
	} else if (empty(get_user_info($login))) { // Прверка сущестования пользователя.
		if (register_user($login, $password)) { // Попытка регистрации пользователя.
			$_SESSION['success'] = 'Пользователь ' . $login . ' успешно зарегистирован';
			header('Location: /login.php');
			return;
		} else {
			$_SESSION['error'] = 'Произошла ошибка регистрации';
		}
	} else {
		$_SESSION['error'] = 'Пользователь ' . $login . ' уже существует';
	}
}
?>
<main class="container">
	<?php include_once 'includes/messages.php'; ?>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Регистрация</h2>
			<p class="text-center">Если у вас уже есть логин и пароль, <a href="login.php">войдите на сайт</a></p>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-4 offset-4">
			<form action="" method="POST">
				<div class="mb-3">
					<label for="login-input" class="form-label">Логин</label>
					<input type="text" class="form-control is-valid" id="login-input" required name="login">
					<div class="valid-feedback">Все ок</div>
				</div>
				<div class="mb-3">
					<label for="password-input" class="form-label">Пароль</label>
					<input type="password" class="form-control is-invalid" id="password-input" required name="password">
					<div class="invalid-feedback">А тут не ок</div>
				</div>
				<div class="mb-3">
					<label for="password-input2" class="form-label">Пароль еще раз</label>
					<input type="password" class="form-control is-invalid" id="password-input2" required name="password2">
					<div class="invalid-feedback">И тут тоже не ок</div>
				</div>
				<button type="submit" class="btn btn-primary">Зарегистрироваться</button>
			</form>
		</div>
	</div>
</main>
<?php include_once "includes/footer.php"; ?>