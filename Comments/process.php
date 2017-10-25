<?php
header('Content-Type: text/html; charset=utf-8');

require_once("functions.php");

if(!($input1 = $_POST['title']) || !($input2 = $_POST['text'])) {
  die("Invalid input!");
}

if(!saveComment($_POST['title'], $_POST['text'])) {
  die("Comments can not be saved!");
}
header("Location: index.php");
