<?php
session_start();
	$con=mysqli_connect("localhost","root","","booking");
	define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/booking/');
	define('SITE_PATH','http://127.0.0.1/php/booking/');
	define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
	define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');
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
function isManager(){
	if(!isset($_SESSION['MANAGER_LOGIN'])){
	?>
		<script>
		window.location.href='managerlog.html';
		</script>
		<?php
	}
	if($_SESSION['MANAGER_ROLE']==1){
		?>
		<script>
		window.location.href='logout.php';
		</script>
		<?php
	}
}

if(isset($_SESSION['MANAGER_LOGIN']) && $_SESSION['MANAGER_LOGIN']!=''){


}
else{
   header('location:managerlog.php');
 
  die();
}

?>

<!doctype html>
<html class="no-js" lang="">
 
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
 
  <head>
   
   <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">
 
     <title>MANAGER DASHBOARD PAGE</title>
  
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
 
  </head>
  
 <body>
     
 <aside id="left-panel" class="left-panel">
  
       <nav class="navbar navbar-expand-sm navbar-default">
     
       <div id="main-menu" class="main-menu collapse navbar-collapse">
     
          <ul class="nav navbar-nav">
            
      <li class="menu-title">MENU</li>
            
      <?php if($_SESSION['MANAGER_ROLE']!=1){?>
	
			   <li class="menu-item-has-children dropdown">
           
          <a href="agentapp.php" > AGENT </a>
          </li>
	
			  <li class="menu-item-has-children dropdown">
     
                <a href="hostelapp.php" > HOSTEL </a>
                  </li>

 <li class="menu-item-has-children dropdown">
       
              <a href="bookingapp.php" > BOOKING </a>
                  </li>
	
			  <li class="menu-item-has-children dropdown">
              
       <a href="promotion.php" > PROMOTION
 </a>
                  </li>
	
			  <li class="menu-item-has-children dropdown">
    
                 <a href="feed-back.php" > FEEDBACK </a>
                 </li>
		
		  <?php } ?>
       
        </ul>
            </div>
         </nav>
      </aside>
    
  <div id="right-panel" class="right-panel">
       
  <header id="header" class="header">
          
  <div class="top-left">
     
          <div class="navbar-header">
       
           <a class="navbar-brand" href="managerdashboard.php"><img src="images/logo.jpg" alt="Logo" width="150px" height="75px"></a>
        
        <a class="navbar-brand hidden" href="managerdashboard.php"><img src="images/logo.jpg" alt="Logo"></a>
          
        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
     </div>

           </div>
      
      <div class="top-right">
     
          <div class="header-menu">
      
            <div class="user-area dropdown float-right">
           
          <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">WELCOME <?php echo $_SESSION['MANAGER_USERNAME']?></a>
         
            <div class="user-menu dropdown-menu">
             
           <a class="nav-link" href="logout.php"><i class="fa fa-power-off"></i>LOGOUT</a>
           
          </div>
                  </div>
           
    </div>
            </div>
     
    </header>