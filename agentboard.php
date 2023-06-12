<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: agent-log.html");
    exit;
}


	$con=mysqli_connect("localhost","root","","booking");
	define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/booking/');
	define('SITE_PATH','http://127.0.0.1/php/booking/');
	define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
	define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
	$name='';
	$room='';
	$location='';
	$type='';
	$price='';
	$status='pending';
	$image='';
	function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}
function isAgent(){
	if(!isset($_SESSION['loggedin'])){
	?>
		<script>
		window.location.href='agent-log.html';
		</script>
		<?php
	}
	if($_SESSION['AGENT_STATUS']==1){
		?>
		<script>
		window.location.href='logout.php';
		</script>
		<?php
	}
}

$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from hostel where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$name=$row['hostel_name'];
		$room=$row['number_of_room'];
		$location=$row['location'];
		$type=$row['room_type'];
		$price=$row['room_price'];
		$status=$row['status'];
		$image=$row['image'];
		
	}else{
		header('location:agentboard.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$name=get_safe_value($con,$_POST['hostelname']);
    $room=get_safe_value($con,$_POST['room']);
	$location=get_safe_value($con,$_POST['location']);
	$type=get_safe_value($con,$_POST['type']);
	$price=get_safe_value($con,$_POST['price']);
    $status="pending";
   	
	
	$res=mysqli_query($con,"select * from hostel where hostel_name='$name'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['id']){
			
			}else{
				$msg="Hostel already exist";
			}
		}else{
			$msg="Hostel already exist";
		}
	}
	
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$update_sql="update hostel set hostel_name='$name',number_of_room='$room',location='$location',room_type='$type',room_price='$price',status='$status',image='' where id='$id'";
			mysqli_query($con,$update_sql);
		}else{
			mysqli_query($con,"insert into `hostel`(`id`, `hostel_name`, `number_of_room`, `location`, `room_type`, `room_price`, `status`, `image`, `created_date`, `updated_date`) values('', '$name','$room','$location','$type','$price','pending','','','')");
		}
		header('location:agentboard.php');
		die();
	}
	if(isset($_FILES['file']['name'])){
   // file name
   $filename = $_FILES['file']['name'];

   // Location
   $location = 'upload/'.$filename;

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
   exit;
}
}

?>
<!DOCTYPE>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="login.css"/>
 <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
     <title>AGENT DASHBOARD PAGE</title>
  
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
   <link rel="stylesheet" href="assets/css/normalize.css">
  
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   
   <link rel="stylesheet" href="assets/css/font-awesome.min.css">
   
   <link rel="stylesheet" href="assets/css/themify-icons.css">
    
  <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
  
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
  
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
  
    <link rel="stylesheet" href="assets/css/style.css">
    
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
 <script>
		
	// Upload file
function uploadFile() {

   var files = document.getElementById("file").files;

   if(files.length > 0 ){

      var formData = new FormData();
      formData.append("file", files[0]);

      var xhttp = new XMLHttpRequest();

      // Set POST method and ajax file path
      xhttp.open("POST", "ajaxfile.php", true);

      // call on request changes state
      xhttp.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {

           var response = this.responseText;
           if(response == 1){
              alert("Upload successfully.");
           }else{
              alert("File not uploaded.");
           }
         }
      };

      // Send request with data
      xhttp.send(formData);

   }else{
      alert("Please select a file");
   }

}
	
	</script>
</head>

<body>
 <h1 id="h" >Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. dear Agent</h1>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>HOSTEL MANAGEMENT FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="name" class=" form-control-label">HOSTEL NAME</label>
									<input type="text" name="hostelname" placeholder="Enter hostel name" class="form-control" required value="<?php echo $name?>">
								</div>
								
								<div class="form-group">
									<label for="room" class=" form-control-label">NUMBER OF ROOM AVAILABLE</label>
									<input type="text" name="room" placeholder="Enter number of room" class="form-control" required value="<?php echo $room?>">
								</div>
								<div class="form-group">
									<label for="location" class=" form-control-label">LOCATION</label>
									<input type="text" name="location" placeholder="Enter the location of the hostel" class="form-control" required value="<?php echo $location?>">
								</div>
								<div class="form-group">
									<label for="type" class=" form-control-label">TYPE OF ROOM AVAILABLE</label>
									<input type="text" name="type" placeholder="Enter type of room" class="form-control" required value="<?php echo $type?>">
								</div>
								<div class="form-group">
									<label for="price" class=" form-control-label">PRICE OF ROOM </label>
									<input type="text" name="price" placeholder="Enter price of room" class="form-control" required value="<?php echo $price?>">
								</div>
								
								<div class="form-group">
									<label for="image" class=" form-control-label">PHOTO OF THE HOSTEL</label>
									  <input type="file" name="file" id="file" value="<?php echo $image?>">
                                      <input type="button" id="btn_uploadfile" value="Upload"  onclick="uploadFile();" >
								</div>
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">SUBMIT</span>
							   </button>
							    <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <a href="logout.php" style="color:red;">LOGOUT</a> </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
		 
		 
<div class="clearfix"></div>
         <footer class="site-footer">
            <div class="footer-inner bg-white">
               <div class="row">
                  <div class="col-sm-6">
                
				<p><center>  <h5><b>Welcome Agent</b></h5></center></p>
				 
                  </div>                
               </div>
            </div>
         </footer>
</div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
</body>
</html>