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


if(isset($_POST['send']))
{

	$text = $_POST['message'];
	$sql_query ="INSERT INTO `chat` (id, message, date) VALUES ('', '$text', '')";
	
		if(mysqli_query($conn,$sql_query))
	{
		 echo "Chat successfully submitted";
		header('Location: homepage1.html');
	}
		else
    {
		echo "Error:" . $sql . "" . mysqli_error($conn);
	}
	mysqli_close($conn);
	}
	

?>