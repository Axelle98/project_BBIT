<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "booking";

$conn= mysqli_connect($server_name, $username, $password, $database_name);
   if(!$conn)
   {
	   die("Connection failed:" . mysqli_connect_error());
   }
   
	if(isset($_POST['submit']))
	{
$type = $_POST['rtype'];
$details=$_POST['rdetails'];
$stat = $_POST['status'];
$rp = $_POST['price'];
$hostel=$_POST['hostelid'];
$time= $_POST['date'];

$sql_query = "INSERT INTO `rooms` (room_id, type, room_details, status, price, id, date)
 VALUES ('', '$type', '$details','$stat','$rp', '$hostel', '$time')";
	if(mysqli_query($conn,$sql_query))
	{
		 echo "Room registered";
		header("Location: room.php");
    
    }
	else
    {
		echo "Error:" . $sql . "" . mysqli_error($conn);
	}
	}
	?>