<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$testFile = 'test.json';
$testData = file_exists($testFile) ? json_decode(file_get_contents($testFile), true) : [];
if (!is_array($testData)) {
    die('Ошибка загрузки теста');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['answers'] = $_POST;
    header('Location: result.php');
    exit();
}

require_once('test_index.php');