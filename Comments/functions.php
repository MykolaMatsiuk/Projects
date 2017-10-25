<?php
const COMMENTS_FILE_NAME = 'comments.json';

/**
 * function to get comments from Json file
 * @return {array} from file
 *
 */

function getComments() {
  return readJson(COMMENTS_FILE_NAME, []);
}

/**
 * saves comments
 * @param {string} name
 * @param {string} text
 * @return Json object
 */

function saveComment($name, $text) {
  $list = readJson(COMMENTS_FILE_NAME, []);
  $list[] = [
    'name' => $name,
    'text' => $text,
    'date' => date("Y-m-d H:i:s", time())
  ];
  return writeJson(COMMENTS_FILE_NAME, $list);
}

/**
 * function to read Json file
 * @param {string} filename
 * @param {null} default
 * @return {array} assoc
 */

function readJson($fileName, $default = null) {  // if file does not exists return null
  if(!file_exists($fileName)) {
    return $default;
  }
  $json = file_get_contents($fileName);
  return json_decode($json, true);     // true - returns associative array
}                                     //(no parameter - returns object)


/**
 * function write Json file
 * @param {string} filename
 * @param {array} data
 * @return {bool} 
 */

function writeJson($fileName, $data) {
  $json = json_encode($data);         
  return (bool) file_put_contents($fileName, $json); // returns amount of bites
}                                                    // (true(smth has been written), 
                                                    //  (false(nth has been written))


/**
 * function that builds table
 * @param {array} array
 * @return html
 *
 */

function getBuiltHTMLTable($array) {
  if(!$array) {
    return "<h2>No data provided</h2>";
  }
  $html = "<table border='1'><thead>";
  $html .= "<th>" . implode("</th><th>", $keys = array_keys($array[0]))."</th>";
  $html .= "</thead><tbody>";
  $banList = getBannedWordsList();
  foreach ($array as $row) {
    $html .= "<tr>";
    foreach ($keys as $key) {
      $temp = strtolower($row[$key]);
      foreach ($banList as $banWord) {
        if((strpos($temp, $banWord)) === false) {
          continue;
        }
        $temp = str_replace($banWord, "***", $temp);
      }
      $html .= "<td>".correctText($temp)."</td>";
    }
    $html .= "</tr>";
  }
  return $html . "</tbody></table><br>";
}

function getBannedWordsList() {
  return [
    'up',
    'test'
  ];
}


/**
 * function that makes Ucfirst in sentence
 * @param {string} text
 * @return {string} text
 */

function correctText($text) {
  $text = explode(".", $text);
  foreach ($text as &$string) {
    $first = mb_substr(trim($string), 0, 1);
    $rest = mb_substr(trim($string), 1);
    $string = mb_strtoupper($first) . $rest;
  }
  return implode(". ", $text);
}
