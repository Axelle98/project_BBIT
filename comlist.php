<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){


}
else{
   header('location:adminlog.html');
 
  die();
}

?>
<!DOCTYPE html>
<html>
<head>
<title>ADMIN DASHBOARD </title>
<style>
#print{
	background-color:aqua;
	width:100px;
	height:50px;
	color:white;
	
}
table, td, th {  
  border: 1px solid #ddd;
  text-align: left;
}

table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 15px;
}

.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>
</head>
<body>
<div id="holder"><a ><img src="images/logo.jpg" width="200px" height="100px"/></a>
	<div id="out">
	<button style="color:white;background-color:aqua;margin-left:90%;"><a href="logout.php">LOGOUT </a></button>
	</div>
<h2> Welcome <b><?php echo htmlspecialchars($_SESSION["ADMIN_USERNAME"]); ?></b></h2>
	 <div id="dropdown">
     <aside >
	 <button onclick="myFunction()" class="dropbtn">MENU</button>
	 <button id="print" onClick="printContent('agent')"><b>PRINT</b></button>
	 <div id="myDropdown" class="dropdown-content">
        <a href="userlist.php">USERS LIST</a>
         <a href="booklist.php">BOOKING</a>
		<a href="comlist.php">AGENT LIST</a>
    	<a href="hostlist.php">HOSTEL</a>
	<a href="room.php">ROOM</a>
		<a href="bill.php">PAYMENT</a>
    	</div >
		</aside>
		</div>
		 <div id="agent">
 <h2>AGENT LIST</h2>
  <table id="tab" class="table ">
						 <thead>
							<tr>
							   <th class="serial"> </th>
							   <th>AGENT ID</th>
							   <th>NAME</th>
							    <th>EMAIL</th>
							   <th>TELEPHONE</th>
							   <th>ADDRESS</th>
							   <th>USERNAME</th>
							    <th>STATUS</th>
							 
							
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

							
							$sql = "SELECT id,name,email,telephone,address,username,status FROM commissionaire";
						$i=1;
							if ( $result = $conn->query($sql)) {
							
							while($row=mysqli_fetch_assoc($result)){?>
							<tr>
							   <td class="serial"><?php echo $i++?></td>
							 <th><?php echo $row['id']?></th>
							   <th><?php echo $row['name']?></th>
							    <th><?php echo $row['email']?></th>
							   <th><?php echo $row['telephone']?></th>
							  <th><?php echo $row['address']?></th>
							  <th><?php echo $row['username']?></th>
							   <th><?php echo $row['status']?></th>
							 
							</tr>
							<?php 
							}
							}
							?>
						 </tbody>
					  </table>
 
 </div>
</div>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
</body>
<footer>
</br></br></br></br></br></br></br></br></br>
<h3> ADMIN DASHBOARD STUDENT HOSTEL MANAGEMENT </h3>
</footer>
</html>