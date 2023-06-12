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
$msg='';
if(isset($_POST['submit'])){
	$username=get_safe_value($con,$_POST['username']);
	$password=get_safe_value($con,$_POST['password']);
	$sql="select * from manager where username='$username' and password='$password'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
		if($row['status']=='0'){
			$msg="Account deactivated";	
		}else{
			$_SESSION['MANAGER_LOGIN']='yes';
			$_SESSION['MANAGER_ID']=$row['id'];
			$_SESSION['MANAGER_USERNAME']=$username;
			$_SESSION['MANAGER_ROLE']=$row['role'];
			header('location:managerdashboard.php');
			die();
		}
	}else{
		$msg="PLEASE ENTER CORRECT LOGIN DETAILS";	
	}
	
}
?>
