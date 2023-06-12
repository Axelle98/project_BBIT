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
.search
{
	border: 2px solid #CF5C3F;
	overflow: auto;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
}

.search input[type="text"]
{
	border: 0px;
	width: 67%;
	padding: 10px 10px;
}

.search input[type="text"]:focus
{
	outline: 0;
}

.search input[type="submit"]
{
	border: 0px;
	background: none;
	background-color: #CF5C3F;
	color: #fff;
	float: right;
	padding: 10px;
	border-radius-top-right: 5px;
	-moz-border-radius-top-right: 5px;
	-webkit-border-radius-top-right: 5px;
	border-radius-bottom-right: 5px;
	-moz-border-radius-bottom-right: 5px;
	-webkit-border-radius-bottom-right: 5px;
        cursor:pointer;
}

/* ===========================
   ====== Medua Query for Search Box ====== 
   =========================== */

@media only screen and (min-width : 150px) and (max-width : 780px)
{
	{}
	.search
	{
		width: 95%;
		margin: 0 auto;
	}

}
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
	 <button id="print" onClick="printContent('book')"><b>PRINT</b></button>
	
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
		 <div id="book">
 <h2>BOOKING LIST</h2>
  <table id="tab" class="table ">
						 <thead>
							<tr>
							   <th class="serial"> </th>
							   <th>BOOKING ID</th>
							   <th>USERNAME</th>
							    <th>CHECK IN</th>
							   <th>DURATION</th>
							   <th>ROOM TYPE</th>
							   <th>HOSTEL NAME</th>
							   <th>PAYMENT TYPE</th>
							    <th>STATUS</th>
							   <th>DATE</th>
							 
							
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

							
							$sql = "SELECT booking_id,username,check_in,duration,room_type,hostel_name,payment_type,status,created_date FROM book";
						$i=1;
							if ( $result = $conn->query($sql)) {
							
							while($row=mysqli_fetch_assoc($result)){?>
							<tr>
							   <td class="serial"><?php echo $i++?></td>
							 <th><?php echo $row['booking_id']?></th>
							   <th><?php echo $row['username']?></th>
							    <th><?php echo $row['check_in']?></th>
							   <th><?php echo $row['duration']?></th>
							  <th><?php echo $row['room_type']?></th>
							  <th><?php echo $row['hostel_name']?></th>
							 <th><?php echo $row['payment_type']?></th>
							   <th><?php echo $row['status']?></th>
							     <th><?php echo $row['created_date']?></th>
							 
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