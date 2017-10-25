<?php
header('Content-Type: text/html; charset=utf-8');
require_once("functions.php");
echo "<link rel='stylesheet' href='style.css'>";
echo getBuiltHTMLTable(getComments());

$html = "
  <form action='process.php' method='post'>
  <input type='text' name='title' placeholder='Enter your name'><br>
  <textarea name='text' placeholder='Enter comment'></textarea><br>
  <input type='submit' value='send'>
  </form>
";

echo $html;
