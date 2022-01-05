<?php
// Скрипт удаления ссылки.

include_once 'functions.php';

if (!empty($_POST['link_id']) && !empty($_POST['long_link'])) {
    if (edit_link($_POST['link_id'], $_POST['long_link'])) {
        $_SESSION['success'] = 'Ссылка отредактирована';
    } else {
        $_SESSION['success'] = 'Ссылка не отредактирована';
    }
}
header('Location: /profile.php');
return;
