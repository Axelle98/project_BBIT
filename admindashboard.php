<?php
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