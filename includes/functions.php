<?php
// Фукнции, общие для всего сайта.

// Подключение файла настроек сайта.
include_once "config.php";

// Подключиться к базе данных. Вернуть объект подключения.
function get_db()
{
    $connection = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . '; charset=utf8';
    $settings = [
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];
    return new PDO($connection, DB_USER, DB_PASS, $settings);
}

// Выполнить запрос к базе данных.
function db_query($sql)
{
    return get_db()->query($sql);
}

// Получить число зарегистрированных пользователей.
function get_users_count()
{
    $sql = 'SELECT COUNT(`id`) from `users`;';
    return db_query($sql)->fetchColumn();
}

// Получить количество добавленных ссылок в базу данных.
function get_links_count()
{
    $sql = 'SELECT COUNT(`id`) from `links`;';
    return db_query($sql)->fetchColumn();
}

// Получить общее число переходов по ссылкам.
function get_views_count()
{
    $sql = 'SELECT SUM(`views`) from `links`;';
    return db_query($sql)->fetchColumn();
}

// Вернуть запись о ссылках из базы данных по совпадению с короткой ссылкой.
function get_links($short_link)
{
    $sql = 'SELECT * FROM `links` WHERE `short_link` = ?;';
    $query = get_db()->prepare($sql);
    $query->execute([$short_link]);
    return $query->fetch();
}

// Обновить количество переходов по короткой ссылке.
function update_link_views($short_link)
{
    $sql = 'UPDATE `links` SET `views` = `views` + 1 WHERE `short_link` = ?;';
    $query = get_db()->prepare($sql);
    $query->execute([$short_link]);
}

// Получить данные о пользователе.
function get_user_info($login)
{
    $sql = 'SELECT * FROM `users` WHERE `login` = ?;';
    $query = get_db()->prepare($sql);
    $query->execute([$login]);
    return $query->fetch();
}

// Зарегистрировать пользователя.
function register_user($login, $password)
{
    $sql = 'INSERT INTO `users` (`login`, `password`) VALUES (?,?);';
    $query = get_db()->prepare($sql);
    return $query->execute([$login, password_hash($password, PASSWORD_DEFAULT)]);
}

// Вывести сообщение сессии.
function get_message()
{
    $success = '';
    $error = '';
    if (!empty($_SESSION['success'])) {
        $success = $_SESSION['success'];
        $_SESSION['success'] = '';
    }

    if (!empty($_SESSION['error'])) {
        $error = $_SESSION['error'];
        $_SESSION['error'] = '';
    }

    return [$success, $error];
}

// Выполнить аутентификацию пользователя. Вернуть запись из базы данных, если пользователь найден. Вернуть число 0, если пользователь не найден. Вернуть false, если пароли не совпали.
function user_login($login, $password)
{
    $user = get_user_info($login);
    if ($user && password_verify($password, $user['password'])) {
        $result = $user;
    } elseif (empty($user)) {
        $result = 0;
    } else {
        $result = false;
    }
    return $result;
}

// Получить все ссылки пользователя по его идентификатору.
function get_users_links($user_id)
{
    $sql = 'SELECT * FROM `links` WHERE `user_id` = ?;';
    $query = get_db()->prepare($sql);
    $query->execute([$user_id]);
    return $query->fetchAll();
}

// Удалить ссылку по иднетификатору.
function delete_link($link_id)
{
    $sql = 'DELETE FROM `links` WHERE `id` = ?;';
    $query = get_db()->prepare($sql);
    return $query->execute([$link_id]);
}

// Сгенерировать короткую ссылку.
function get_new_link($link_length = 5)
{
    $letters = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $new_link = '';
    for ($i = 0; $i < $link_length; $i++) {
        $new_link .= $letters[rand(0, strlen($letters) - 1)];
    }
    return $new_link;
}

// Добавить новую ссылку в базу данных.
function add_link($link, $user_id)
{
    $length = 5;
    $short_link = get_new_link();
    $sql = 'INSERT INTO `links` (`user_id`, `long_link`, `short_link`) VALUES (?,?,?);';
    $query = get_db()->prepare($sql);
    while (check_link($short_link)) {
        $short_link = get_new_link(++$length);
    }
    return $query->execute([$user_id, $link, $short_link]);
}

// Проверить уникальнось сгенерированной ссылки в базе данных.
function check_link($short_link)
{
    $sql = 'SELECT EXISTS(SELECT `id` FROM `links` WHERE `short_link` = ?);';
    $query = get_db()->prepare($sql);
    $query->execute([$short_link]);
    return $query->fetchColumn();
}

// Обновить ссылку в базе данных по идентификатору.
function edit_link($link_id, $long_link)
{
    $sql = 'UPDATE `links` SET `long_link` = ? WHERE `id` = ?;';
    $query = get_db()->prepare($sql);
    return $query->execute([$long_link, $link_id]);
}
