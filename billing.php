<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
  <title>Billing statement </title>
  <link rel="stylesheet" href="libs/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="profile.css"/>
    <style>
#tab {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#tab td, #tab th {
  border: 1px solid #ddd;
  padding: 8px;
}

#tab tr:nth-child(even){background-color: #f2f2f2;}

#tab tr:hover {background-color: #ddd;}

#tab th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
  </head>
<body>
<div id="holder"><a ><img src="images/logo.jpg" width="200px" height="100px"/></a>
	 <div id="header">
     
	<ul>
	    <li><a href="logout.php">Logout</a></li>
    	<li><a href="reset-password.html">Reset pass</a></li>
		<li><a href="billing.php">Bill statement</a></li>
    	<li><a href="profile.php">Home</a></li>
		
       
    	</ul>
    </div>
	 <h1 id="h" >Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to your user personal place.</h1>

<form method="get" action="">
<div id=""><a ><img src="images/userprofile.png" width="200px" height="100px"/></a>
 
</form>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">BILL DETAILS </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table id="tab" class="table ">
						 <thead>
							<tr>
							   <th class="serial"> </th>
							   <th>User id</th>
							   <th>Name</th>
							    <th>Card Number</th>
							   <th>Card CVC</th>
							   <th>Card expiration month</th>
							   <th>Card expiration year</th>
							   <th>Room type</th>
							    <th>Room price</th>
							   <th>Price currency</th>
							     <th>Paid amount</th>
								  <th>Paid amount currency</th>
								   <th>Txn ID</th>
							   <th>Payment status</th>
							    <th>Created</th>
								 <th>Modified</th>
							
							</tr>
						 </thead>
						 <tbody>
							<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$username=$_SESSION['username'];
$id=$_SESSION['user_id'];
							
							$sql = "SELECT * FROM payment WHERE user_id=$id";
						$i=1;
							if ( $result = $conn->query($sql)) {
							
							while($row=mysqli_fetch_assoc($result)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							 <th><?php echo $row['user_id']?></th>
							   <th><?php echo $row['name']?></th>
							    <th><?php echo $row['card_num']?></th>
							   <th><?php echo $row['card_cvc']?></th>
							  <th><?php echo $row['card_exp_month']?></th>
							  <th><?php echo $row['card_exp_year']?></th>
							 <th><?php echo $row['room_type']?></th>
							   <th><?php echo $row['price']?></th>
							     <th><?php echo $row['price_currency']?></th>
							     <th><?php echo $row['paid_amount']?></th>
							  <th><?php echo $row['paid_amount_currency']?></th>
								   <th><?php echo $row['txn_id']?></th>
							    <th><?php echo $row['payment_status']?></th>
							  <th><?php echo $row['created']?></th>
								  <th><?php echo $row['modified']?></th>
							</tr>
							<?php 
							}
							}
							?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
</div>

</div>

	<div class="clearfix"></div>
         <footer class="site-footer">
            <div class="footer-inner bg-white">
               <div class="row">
                  <div class="col-sm-6">
                
				<p><center>  <h5><b>Welcome dear Student</b></h5></center></p>
				 
                  </div>                
               </div>
            </div>
         </footer>
</div> 
	 </body>
      </html>
