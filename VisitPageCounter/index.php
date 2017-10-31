<?php
const FILE = 'stat.json';

$c = writeStat();

die("LAST 30 SECONDS WAS $c USERS.");

function writeStat() {
  
  $stats = readStat();
  $clearStat = [];

  foreach ($stats as $stat) {
    if ((time() - $stat['time']) > 30) {
      continue;
    }
    $clearStat[] = $stat;
  }

  if (!isset($_COOKIE['stat'])) {
    $data['time'] = time();
    $clearStat[] = $data;
    setcookie('stat', time() + 30);
  }
  
  writeToFile($clearStat, FILE);
  return count($clearStat);
}

function readStat() {
  return !file_exists(FILE) ? [] : (array) json_decode(file_get_contents(FILE), true);
}

function writeToFile($arr, $fileName) {
  if (!$arr && file_exists($fileName)) {
    return unlink($fileName);
  }

  if ($arr) {
    return (bool) file_put_contents($fileName, json_encode($arr));
  }

  return true;
}
