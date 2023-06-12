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
$user=$_POST['username'];
$check = $_POST['in'];
$rt = $_POST['roomt'];
$dt = $_POST['duree'];
$hostel=$_POST['hostel-name'];
$pt= $_POST['payment'];
$attach=$_POST['file'];
$sql_query = "INSERT INTO `book` (booking_id, username, check_in, duration, room_type, hostel_name, payment_type, attachment, status)
 VALUES ('', '$user', '$check','$dt','$rt', '$hostel', '$pt', '$attach', 'pending')";
	if(mysqli_query($conn,$sql_query))
	{
		 echo "Booking successfully submitted";
		header("Location: booking.html");
    
    }
	else
    {
		echo "Error:" . $sql . "" . mysqli_error($conn);
	}
	if(isset($_FILES['file']['name'])){
   // file name
   $filename = $_FILES['file']['name'];

   // Location
   $location = 'attachment/'.$filename;

   // file extension
   $file_extension = pathinfo($location, PATHINFO_EXTENSION);
   $file_extension = strtolower($file_extension);

   // Valid extensions
   $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");

   $response = 0;
   if(in_array($file_extension,$valid_ext)){
      // Upload file
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         $response = 1;
      } 
   }

   echo $response;
 
	mysqli_close($conn);
	}
	}
?>