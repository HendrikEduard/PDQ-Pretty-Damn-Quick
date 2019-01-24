<?php
/*
* @package   	PDQ (Pretty 'n' Damn Quick) PHP Toolkit
* @version    4.2
* @author     Hendrik Eduard Kuiper
* @copyright  Hendrik Eduard Kuiper
* @link       
* @copyright 	Copyright (c) 2006 - 2019
* @license 		http://opensource.org/licenses/MIT	MIT License
* @since 			Version 1
*/
/**
 * Cleanse HTML going in or coming out of the database
 */
function in($data) {
  $data = strip_tags(stripslashes($data));
  return trim(htmlentities($data, ENT_QUOTES, 'UTF-8'));
}
function out($data) {
  return trim(htmlentities($data, ENT_QUOTES, 'UTF-8'));
}
// var_Dump and Die for troubleshooting
function dnd($data) {
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
  die();
}
function secure_token() {
  $token = '';
  $count = 0;
  while (++$count <= 3) {
    $i = random_int(11, 22);
    $token .= bin2hex(random_bytes($i));
  }
  return $token;
}
// $secure_token = secure_token();
// $_SESSION['secure_token'] = secure_token();
// echo $_SESSION['secure_token'];