<?php
// Настройки сервера, объявленные в виде констант.

define('SITE_NAME', 'CutURL');
define('HOST', $_SERVER['HTTP_HOST']);

// Настройки подключения к базе данных.
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'cuturl');
define('DB_USER', 'admin');
define('DB_PASS', '12345');

// Запуск сессии на всех ст
session_start();
