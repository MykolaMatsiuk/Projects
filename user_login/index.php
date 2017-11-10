<?php
require_once "session.php";
require_once "functions.php";
include_once "libs/Smarty.class.php";
$smarty = new Smarty();
$smarty->setTemplateDir('templates');

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

if (isset($_SESSION['user']) && in_array($action, ['login', 'register'])) {
  $action = 'main';
}

switch ($action) {
  case 'login':
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $smarty->display('login.tpl');
      exit;
    }
    login();
    break;
  case 'register':
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $smarty->display('register.tpl');
      exit;
    }
    register();
    break;
  case 'main':
    if (!isset($_SESSION['user'])) {
      header("Location: /php/user_login/?action=login");
      exit;
    }
    $smarty->assign('hi', $_SESSION['user']['hello']);
    $smarty->assign('session_user', $_SESSION['user']['login']);
    $smarty->assign('avatar', $_SESSION['user']['avatar']);
    $smarty->display('main.tpl');
    break;
}
