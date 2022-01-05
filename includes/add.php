<?php
// Скрипт добавления ссылки в базу данных.

include_once 'functions.php';

if (!empty($_POST['link'])) {
    if (add_link($_POST['link'], $_SESSION['id'])) {
        $_SESSION['success'] = 'Ссылка добавлена';
    } else {
        $_SESSION['error'] = 'Ссылка не добавлена';
    }
}
header('Location: /profile.php');
return;
