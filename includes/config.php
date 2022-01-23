<?php
// Настройки сервера, объявленные в виде констант.

define('SITE_NAME', 'CutURL');
define('HOST', $_SERVER['HTTP_HOST']);

// Настройки подключения к базе данных.
define('DB_HOST', '127.0.0.1');
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');

// Запуск сессии на всех страницах
session_start();
