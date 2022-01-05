<?php
// Скрипт завершения сессии.

session_start();
session_destroy();
header('Location: /');
