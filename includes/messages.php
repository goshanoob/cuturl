<?php
// Скрипт вывода сообщений пользователю.

include_once 'functions.php';
$messages = get_message();
$success = $messages[0];
$error = $messages[1];
?>

<?php if ($success) : ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <?= $success; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>
<?php if ($error) : ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <?= $error; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>