<?php
session_start();

if(!isset($_SESSION['userId']))
{
  header('location:login.php');
}

 ?>
<?php require "assets/function.php" ?>
<?php require 'db.php';?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="js/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <title><?php echo siteTitle(); ?></title>

  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>
	  
	   <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT',
            ' Calibri', 'Trebuchet MS', 'sans-serif';
        }
 
        td {
            background-color: #E4F5D4;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
    </style>

  </style>

</head>
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
<div class="account" style="display: none;z-index: 6">
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


<!-----------Inventeries Page Part-------->
<?php 
if (isset($_GET['catId'])) // display items of a specific categories 
{
  $catId = $_GET['catId'];
  $array = $con->query("select * from categories where id='$catId'");
  $catArray =$array->fetch_assoc();
  $catName = $catArray['name'];
  $stockArray = $con->query("select * from inventeries where catId='$catArray[id]'");
 
} 
else  // display all items
{
  $catName = "All Inventeries";
  $stockArray = $con->query("select * from inventeries");
}

  include 'assets/bill.php'; // including bill file
 ?>


  <div class="content">
   <ol class="breadcrumb ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $catName ?></li>
    </ol>
  <div class="tableBox" >
    <table>
             <div class="col-lg-12">
                        <h2>List of Records</h2> 
                                
                         <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Full name</th>
                                        <th>age</th>
										<th>Prescription Date</th>
                                        <th>Prescription</th>
										 
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                 <?php                  
                $query = 'SELECT * FROM prescription';
                    $result = mysqli_query($con, $query) or die (mysqli_error($con));
                  
                        while ($row = mysqli_fetch_assoc($result)) {
                                             
                            echo '<tr>';
                            echo '<td>'. $row['name'].'</td>';
                            echo '<td>'. $row['age'].'</td>';
							echo '<td>'. $row['date'].'</td>';
                            echo '<td>'. $row['prescription'].'</td>';
							
                            
                            
                            echo ' <td><a  type="button" class="btn btn-xs btn-danger" href="del.php?type=people&delete & id=' . $row['Pid'] . '">DELETE </a> </td>';
                            echo '</tr> ';
                }
									
            ?> 
                                    
                                </tbody>
                            </table>
  </div>                      

  </div>  <!-- ending tag for content -->

</div> <!-- ending tag for margin left -->



</body>
</html>

<script type="text/javascript">
  function addInBill(id,place)
  { 
    var value = $("#counter").val();
    value ++;
    var selection = 'selection'+place;
    $("#bill").fadeIn();
    $("#counter").val(value);
    $("#"+selection).html("selected");
    $.post('called.php?q=addtobill',
               {
                   id:id
               }
        );

  }
   $(document).ready(function()
  {
    $(".rightAccount").click(function(){$(".account").fadeToggle();});
    $("#dataTable").DataTable();
   
  });
</script>

  <script src="js/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="js/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>