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
require_once 'conx.php';
require_once 'process.php'; 
$title = 'PDQ Pure PHP Table Sorting';
$save = $delete = '';
$order = isset($_GET['order']) ? $_GET['order'] : 'id';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ASC';
$result = $mysqli->query("SELECT * FROM `persons` WHERE deleted=0 Order By ".$order."");require_once 'layouts/header.php' ?>
<body>
<?php if(isset($_SESSION['message'])):?>
  <div class="text-center alert alert-<?=$_SESSION['msg_type']?>">
    <?php echo $_SESSION['message']; unset($_SESSION['message']);?>
  </div>
<?php endif; ?>
  <div class="container">
    <h1 class ="text-center my-5"><?=$title?></h1>
    <div class="row">
    <?php require_once 'form.php'?>
    <div class="col-sm-9">
        <div class="justify-content-center">
          <table class="table">
            <thead>
              <tr>
              <?php $sort == "DESC" ? $sort = "ASC" : $sort = "DESC"?>
                <th><a href="?order=fname&&sort=$sort">First Name</a></th>
                <th><a href="?order=lname&&sort=$sort">Last Name</a></th>
                <th><a href="?order=location&&sort=$sort">Location</a></th>
                <th>Action</th>
              </tr>
            </thead>
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?=out($row['fname'])?></td>
                <td><?=out($row['lname'])?></td>
                <td><?=out($row['location'])?></td>
                <td><a href="index.php?edit=<?=out($row['id'])?>" class="btn btn-warning">Edit</a> &nbsp; 
                <a href="process.php?delete=<?=out($row['id'])?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this record?')">Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>    
          </table>
        </div>
      </div>
    </div>
  </div>
<?php require_once 'layouts/footer.php';
