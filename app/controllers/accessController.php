<?php
/*
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header("Content-Type: *");
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Credentials: true');

session_start();
if (isset($_POST['token']) && $_POST['token'] !== null) {
    $_SESSION = json_decode($_POST['usuario'], true);
    $_SESSION['_token'] = $_POST['token'];
    $result['ruta'] = '../administracionController.php';
    echo $_SERVER['HTTP_ORIGIN'] . dirname($_SERVER['PHP_SELF']) . '/administracionController.php';
}
*/