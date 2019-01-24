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
session_start();
require_once 'functions.php'; 
require_once 'conx.php';
$fname = $lname = $location = '';
$update = false;
$id = 0;

if(isset($_POST['save'])) {
  if ($_POST["csrf_token"] !== $_SESSION['secure_token']) {
    die('Your form has been submitted.');
  }
  $save = true;
  $fname = in($_POST['fname']);
  $lname = in($_POST['lname']);
  $location = in($_POST['location']);
  $mysqli->query("INSERT INTO persons (fname, lname, location) VALUES('$fname', '$lname', '$location')") or die($mysqli->error);
  $_SESSION['message'] = "Record Added";
  $_SESSION['msg_type'] = "success";
  header("Location: index.php");
  exit();
}
if(isset($_GET['edit'])) {
  $id = intval($_GET['edit']);
  $update = true;
  $result = $mysqli->query("SELECT * FROM persons WHERE id=$id") or die($mysqli->error);
    $row = $result->fetch_array();
    $fname = $row['fname'];
    $lname = $row['lname'];
    $location = $row['location'];
}
if(isset($_POST['update'])) {
  if ($_POST["csrf_token"] !== $_SESSION['secure_token']) {
    die('Your form has been submitted.');
  }
  $id = intval($_POST['id']);
  $fname = in($_POST['fname']);
  $lname = in($_POST['lname']);
  $location = in($_POST['location']);
  $mysqli->query("UPDATE persons SET fname='$fname', lname='$lname', location='$location' WHERE id=$id") or die($mysqli->error);
  $_SESSION['message'] = "Record updated";
  $_SESSION['msg_type'] = "info";
  header("Location: index.php");
  exit();
}
if(isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $mysqli->query("UPDATE persons SET deleted=1 WHERE id=$id") or die($mysqli->error);
  $_SESSION['message'] = "Record deleted";
  $_SESSION['msg_type'] = "danger";
  header("Location: index.php");
}
