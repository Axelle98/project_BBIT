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
	$username = $_POST['username'];
	$fd = $_POST['feed'];
	$sql_query ="INSERT INTO `feedback` (feedback_id, username, feedback) VALUES ('', '$username', '$fd')";
		if(mysqli_query($conn,$sql_query))
	{
		 echo "Feedback successfully submitted";
		header('Location: homepage1.html');
	}
		else
    {
		echo "Error:" . $sql . "" . mysqli_error($conn);
	}
	mysqli_close($conn);
	}

?>