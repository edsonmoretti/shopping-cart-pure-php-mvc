<?php
if (!file_exists('app/config/configuration.php')) {
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    header('Location: ' . $uri . '/admin/install');
    exit;
}

require_once 'vendor/autoload.php';
use App\App;

if(isset($_GET['api'])){
    header('Content-Type: application/json');
    echo App::getInstance()->api($_GET);
    die();
}

if (!App::getInstance()->checkSession() && empty($_POST)) {
    App::getInstance()->render('login', $_GET);
    die();
}

if (!empty($_POST)) {
    App::getInstance()->post($_POST);
}


$page = filter_input(INPUT_GET, 'p');

if (view_exists($page) or empty($page)) {
    App::getInstance()->render($page, $_GET);
} else {
    App::getInstance()->render('404');
}