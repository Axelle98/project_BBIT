<!DOCTYPE>
<html>
<head>
<title>Student Hostel Management System</title>
<link rel="stylesheet" type="text/css" href="homepage.css"/>
<link rel="stylesheet" type="text/css" href="dhtmlxcalendar.css"/>
	
<script src="dhtmlxcalendar.js"></script>
	
<style>
		#calendar,
		#calendar2,
		 	{
			border: 1px solid #909090;
			font-family: Tahoma;
			font-size: 12px;
			}
			.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
</style>
	<script>
		var myCalendar;
		function doOnLoad() 
			{
			myCalendar = new dhtmlXCalendarObject(["calendar","calendar2",]);
			}
	</script>
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
<body onload="doOnLoad();">
<div id="holder"><a ><img src="images/logo.jpg" width="200px" height="100px"/></a>
	 <div id="header">
     
	<ul>
    	<li><a href="login.html">Login</a></li>
    	<li><a href="overview.html">Overview</a></li>
		<li><a href="payment.html">Payment</a></li>
		 <li><a href="signup.html">Registration</a></li>
        <li><a href="homepage1.html">Home</a></li>
		
    	</ul>
    </div>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
			
				   <h4 class="box-title">HOSTEL DETAILS </h4>
				   	<h3> Copy hostel name in case of booking</h3>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table id="tab" class="table ">
						 <thead>
							<tr>
							   <th class="serial"> </th>
							   <th width="10%" >Hostel id</th>
							   <th width="10%">Hostel Name</th>
							    <th>Number of room</th>
							   <th>Location</th>
							   <th>Room type</th>
							   <th>Room price</th>
							
							   <th>Status</th>
							 
								 <th>Added date</th>
								  <th>Update date</th>
							
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


$type='studio';



							
							$sql = "SELECT id, hostel_name, number_of_room,location,room_type,room_price,status,created_date,updated_date FROM hostel WHERE room_type='private room'  ";
						$i=1;
							if ( $result = $conn->query($sql)) {
							
							while($row=mysqli_fetch_assoc($result)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['hostel_name']?></td>
							   <td><?php echo $row['number_of_room']?></td>
							   <td><?php echo $row['location']?></td>
							   <td><?php echo $row['room_type']?></td>
							   <td><?php echo $row['room_price']?></td>
							   <td><?php echo $row['status']?></td>
							   
							   <td><?php echo $row['created_date']?></td>
							 <td><?php echo $row['updated_date']?></td>
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
</body>
</html>