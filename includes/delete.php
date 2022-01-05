<?php
// Скрипт удаления ссылки из базы данных.

include_once 'functions.php';

if (!empty($_GET['link_id'])) {
    // Здесь имеет смысл проверить принадлежность ссылки удаляющему ее пользователю.
    if (delete_link($_GET['link_id'])) {
        $_SESSION['success'] = 'Ссылка удалена';
    } else {
        $_SESSION['error'] = 'Ссылка не удалена';
    }
}
header('Location: /profile.php');
return;
