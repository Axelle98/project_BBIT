<?php 
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking";
$conn = new mysqli($servername, $username, $password, $dbname);

$search = $_GET['search'];
	$sql = "SELECT username FROM signin WHERE username LIKE '%".$search."%'";
						$i=1;
							if ( $result = $conn->query($sql)) {
							
							while($row=mysqli_fetch_assoc($result)){
								
							 echo $row['username'];
							  echo $row['email'];
							   echo $row['telephone'];
							 
								
							}
							}

  ?>