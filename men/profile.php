<?php
session_start();

if(!isset($_SESSION['userId']))
{
  header('location:login.php');
}
 ?>
<?php require "assets/function.php" ?>
<?php require 'assets/db.php';?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>
 <?php 
 $notice="";
if (isset($_POST['saveSetting'])) {
if ($con->query("update users SET name='$_POST[name]',number='$_POST[number]' where id='$_SESSION[userId]'")) {
  $notice ="<div class='alert alert-success'>Successfully Saved</div>";
  header("location:profile.php?notice=Successfully saved");
}
else{
  $notice ="<div class='alert alert-danger'>Error is:".$con->error."</div>";
}
}
if (isset($_GET['notice'])) {
  $notice = "<div class='alert alert-success'>Successfully Saved</div>";
}
 ?>
</head>
<body style="background: #ECF0F5;padding:0;margin:0">
<div class="dashboard" style="position: fixed;width: 18%;height: 100%;background:#1345BA">
<!--------SITE NAME------->
  <div style="background:#1345BA;padding: 14px 3px;color:white;font-size: 15pt;text-align: center;text-shadow: 1px 1px 11px black">
    <a href="index.php" style="color: white;text-decoration: none;"><?php echo strtoupper(siteName());// SHOW SITE NAME IN UPPER CASE
      ?> 
    </a>
  </div>


<!--------MAIN NAVIGATION-------->
  
   <div>
    <div style="background:#1345BA;color: white;padding: 13px 17px;border-left:"><span><i class="fa fa-dashboard fa-fw"></i> Dashboard</span></div>
    <div class="panel-group">
      <ul class="nostyle zero">
        <a href="index.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Home</li></a>
        <a href="inventeries.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Inventeries</li></a>
       <a href="addnew.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Add New Item</li></a>
        <a href="reports.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Report</li></a>
      </ul>

    </div>
  </div>
  <div style="background:#1345BA;color: white;padding: 13px 17px;border-left:"><span><i class="fa fa-globe fa-fw"></i> Other Menu</span></div>
  <div class="panel-group">
      <ul class="nostyle zero">
        <a href="sitesetting.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Site Setting</li></a>
       <a href="bill1.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Sending Bill</li></a>
        <a href="ph.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Prescription</li></a>
        <a href="logout.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> Sign Out</li></a>
      </ul><
    </div>
</div>

<div class="marginLeft" >
  <div style="color:white;background:#FFFFFF" >
    <div class="pull-right flex rightAccount" style="padding-right: 11px;padding: 7px;">
      <div><img src="photo/<?php echo $user['pic'] ?>" style='width: 41px;height: 33px;' class='img-circle'></div>
      <div style="padding: 8px"><?php echo ucfirst($user['name']) ?></div>
    </div>
    <div class="clear"></div>
  </div>
<div class="account" style="display: none;">
  <div style="background: #3C8DBC;padding: 22px;" class="center">
    <img src="photo/<?php echo $user['pic'] ?>" style='width: 100px;height: 100px; margin:auto;' class='img-circle img-thumbnail'>
    <br><br>
    <span style="font-size: 13pt;color:#CEE6F0"><?php echo $user['name'] ?></span><br>
    <span style="color: #CEE6F0;font-size: 10pt">Member Since:<?php echo $user['date']; ?></span>
  </div>
  <div style="padding: 11px;">
    <a href="profile.php"><button class="btn btn-default" style="border-radius:0">Profile</button>
    <a href="logout.php"><button class="btn btn-default pull-right" style="border-radius: 0">Sign Out</button></a>
  </div>
</div>

  <div class="content2">
<ol class="breadcrumb ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Pofile Setting</li>
    </ol>
    <?php echo $notice ?>
    <div style="width: 55%;margin: auto;padding: 22px;" class="well well-sm center">

      <h4>Profile Setting</h4><hr>
      <form method="POST">
         <div class="form-group">
            <label for="some" class="col-form-label">Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $user['name'] ?>" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">Number</label>
            <input type="text" name="number" value="<?php echo $user['number'] ?>" class="form-control" id="some"  required>
          </div>
          <div class="center">
            <button class="btn btn-primary btn-sm btn-block" name="saveSetting">Save Setting</button>
          </div>   
        </form>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

