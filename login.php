<?php
include_once "includes/header.php";
if (!empty($_SESSION['id'])) {
	header('Location: /profile.php');
	return;
}

if (!empty($_POST['login'] && !empty($_POST['password']))) {
	$login = $_POST['login'];
	$user = user_login($login, $_POST['password']);
	if ($user) {
		$_SESSION['id'] = $user['id'];
		$_SESSION['login'] = $user['login'];
		$_SESSION['success'] = 'Вы успешно вошли, ' . $login;
		header('Location: /profile.php');
		return;
	} else if ($user === 0) {
		$_SESSION['error'] = "Пользователь $login не зарегистрирован";
	} else {
		$_SESSION['error'] = "Неверный пароль";
	}
}
?>
<main class="container">
	<?php include_once 'includes/messages.php'; ?>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Вход в личный кабинет</h2>
			<p class="text-center">Если вы еще не зарегистрированы, то самое время <a href="register.php">зарегистрироваться</a></p>
		</div>
	</div>
	<div class="row mt-3">
		<div class="col-4 offset-4">
			<form action="" method="post">
				<div class="mb-3">
					<label for="login-input" class="form-label">Логин</label>
					<input type="text" class="form-control is-valid" id="login-input" required name="login">
				</div>
				<div class="mb-3">
					<label for="password-input" class="form-label">Пароль</label>
					<input type="password" class="form-control is-invalid" id="password-input" required name="password">
				</div>
				<button type="submit" class="btn btn-primary">Войти</button>
			</form>
		</div>
	</div>
</main>
<?php include_once "includes/footer.php"; ?>