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
/* Button used to open the contact form - fixed at the bottom of the page */
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

/* The popup form - hidden by default */
.form-popup {
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

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
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
	 <button id="print" onClick="printContent('roomlist')"><b>PRINT</b></button>
	 <button id="print" onclick="openForm()"><b>ADD ROOM</b></button>
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
 <div id="roomlist">
 <h2>ROOM LIST</h2>
  <table id="tab" class="table ">
						 <thead>
							<tr>
							   <th class="serial"> </th>
							   <th>ROOM ID</th>
							   <th>ROOM TYPE</th>
							    <th>ROOM DETAILS</th>
							   <th>STATUS</th>
							   <th>PRICE</th>
							   <th>HOSTEL ID</th>
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

							
							$sql = "SELECT room_id,type,room_details,status,price,id,date FROM rooms";
						$i=1;
							if ( $result = $conn->query($sql)) {
							
							while($row=mysqli_fetch_assoc($result)){?>
							<tr>
							   <td class="serial"><?php echo $i++?></td>
							 <th><?php echo $row['room_id']?></th>
							   <th><?php echo $row['type']?></th>
							    <th><?php echo $row['room_details']?></th>
							   <th><?php echo $row['status']?></th>
							  <th><?php echo $row['price']?></th>
							  <th><?php echo $row['id']?></th>
							 <th><?php echo $row['date']?></th>
						
							</tr>
							<?php 
							}
							}
							?>
						 </tbody>
					  </table>
 
 </div>
 <div class="form-popup" id="myForm">
  <form action="addroom.php" method="post" class="form-container">
    <h1>ROOM REGISTRATION</h1>
	    <label for="type"><b>ROOM TYPE</b></label>
    <input type="text" placeholder="Enter room type" name="rtype" required>

    <label for="details"><b>ROOM DETAILS</b></label>
    <input type="text" placeholder="Enter room details" name="rdetails" required>

    <label for="status"><b>ROOM STATUS</b></label>
    <input type="text" placeholder="Enter room status" name="status" required>

 <label for="price"><b>ROOM PRICE</b></label>
    <input type="text" placeholder="Enter room price" name="price" required>
	
	 <label for="hostel"><b>HOSTEL ID</b></label>
    <input type="text" placeholder="Enter hostel id" name="hostelid" required>
	
	 <label for="date"><b>DATE</b></label>
    <input type="date" placeholder="Enter date" name="date" required>
	
    <button name="submit" type="submit" class="btn">SUBMIT</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
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
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
</body>
<footer>
</br></br></br></br></br></br></br></br></br>
<h3> ADMIN DASHBOARD STUDENT HOSTEL MANAGEMENT </h3>
</footer>
</html>