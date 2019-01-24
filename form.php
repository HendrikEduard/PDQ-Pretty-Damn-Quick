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
*/ ?>
<div class="col-sm-3 mt-4">
    <div class="justify-content-center">
    <?php $_SESSION['secure_token'] = secure_token();?>
      <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <input type="hidden" name="id" value="<?=$id?>">
        <div class="form-group">
          <label for="">First Name</label> 
          <input type="text" name="fname" required class="form-control" value="<?=out($fname)?>" placeholder="First Name">
        </div>
        <div class="form-group">
          <label for="">Last Name</label> 
          <input type="text" name="lname" required class="form-control" value="<?=out($lname)?>" placeholder="Last Name">
        </div>
        <div class="form-group">
          <label for="">Location</label> 
          <input type="text" name="location" required class="form-control" value="<?=out($location)?>" placeholder="Location">
        </div>
        <div class="form-group">
          <input type="hidden" name="csrf_token" value="<?=$_SESSION['secure_token']?>">
        </div>
        <div class="form-group"> <?php echo ($update == true) ? 
        '<button type="submit" class="btn btn-warning" name="update">Update</button>' : '<button type="submit" class="btn btn-primary" name="save">Save</button>'?>
        </div>
      </form>
    </div>
  </div>
