<?php
include_once 'functions.php';
if (empty($_SESSION['id'])) {
    header('Location: /');
    return;
}

if (!empty($_GET['link_id']) && !empty($_GET['long_link'])) {
    // Здесь стоит проверить, принадлежит ли редактируемая ссылка редактируещему.
} else {
    header('Location: /profile.php');
    return;
}

include_once 'header.php';
?>
<div class="row mt-5">
    <div class="col">
        <h2 class="text-center">Редактирование ссылки</h2>
    </div>
</div>
<div class="row mt-3">
    <div class="col-4 offset-4">
        <form action="edit.php" method="POST">
            <div class="mb-3">
                <label for="login-input" class="form-label">Ссылка: </label>
                <input type="text" class="form-control is-valid" id="login-input" required name="long_link" value="<?= $_GET['long_link']; ?>">
                <input type="hidden" name="link_id" value="<?= $_GET['link_id']; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>
<?php include_once 'footer.php'; ?>