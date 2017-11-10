<?php
const USERS_FILE = "users.json";

function register() {
  $login = htmlspecialchars(trim($_POST['login']));
  $pass = htmlspecialchars(trim($_POST['pass']));

  if (!$login || !$pass) {
    header("Location: /php/user_login/?action=register&msg=Empty login or password!");
    exit;
  }

  $users = getUserList();

  if (getUserFromUsersList($users, $login)) {
    header("Location: /php/user_login/?action=register&msg=User exists!");
    exit;
  }

  if ($_FILES['logo']['size'] > 5000000) {
    header("Location: /php/user_login/?action=register&msg=File must be less than 
      5000000 bytes");
    exit;
  }

  if (isset($_FILES['logo']) && $_FILES['logo']['type'] == 'image/jpeg') {
    if (!file_exists('storage/' . $login)) {
      mkdir('storage/' . $login);
    }
    move_uploaded_file($_FILES['logo']['tmp_name'], 'storage/' . $login . '/' . 
                        $_FILES['logo']['name']);
  }

  $users[] = $user = [
    'login' => $login,
    'pass' => $pass,
    'registered' => date("Y-m-d H:m:s", time()),
    'logged_in' => date("Y-m-d H:m:s", time()),
    'avatar' => $_FILES['logo']['name']
  ];

  $isSet = setUsers($users);

  if (!$isSet) {
    return false;
  }


  $_SESSION['user'] = $user;
  $_SESSION['user']['hello'] = "Wellcome";
  header("Location: /php/user_login/?action=main");
}

function login() {
  $login = htmlspecialchars(trim($_POST['login']));
  $pass = htmlspecialchars(trim($_POST['pass']));

  if (!$login || !$pass) {
    header("Location: /php/user_login/?action=login&msg=Empty login or password!");
    exit;
  }

  $users = getUserList();

  if (!$user = getUserFromUsersList($users, $login)) {
    header("Location: /php/user_login/?action=login&msg=User does not exist!");
    exit;
  }

  $greeting = "Wellcome back";

  $_SESSION['user'] = $user;
  $_SESSION['user']['hello'] = "Wellcome back";
  header("Location: /php/user_login/?action=main");
}

function getUserList() {

  return (!file_exists(USERS_FILE)) ? [] : json_decode(file_get_contents(USERS_FILE), true);

}

function setUsers($users) {
  return file_put_contents(USERS_FILE, json_encode($users));
}

function getUserFromUsersList($users, $loginUser) {
  foreach ($users as $user) {
    if ($user['login'] == $loginUser) {
      return $user;
    }
  }

  return null;
}

