<?php      
 define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'booking');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
	
     $name = $_POST['name'];
     $email = $_POST['email'];
      $telephone = $_POST['contact_no'];
      $address=$_POST['address'];	  
	 $username = $password = $confirm_password = "";
     $username_err = $password_err = $confirm_password_err = "";
    
	  
	 if($_SERVER["REQUEST_METHOD"] == "POST"){
		   if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
	$sql = "SELECT id FROM commissionaire WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
			 mysqli_stmt_bind_param($stmt, "s", $param_username);
			  $param_username = trim($_POST["username"]);
			   if(mysqli_stmt_execute($stmt)){
          
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
			       mysqli_stmt_close($stmt);
        }     
    }
	  if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
	   if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
	 if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
		  $sql = "INSERT INTO commissionaire (id, name, email, telephone, address, username, password, status)
		  VALUES ('', '$name', '$email', '$telephone', '$address', ?, ?, 'pending')";
         
        if($stmt = mysqli_prepare($link, $sql)){
			 mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
			 $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
			 if(mysqli_stmt_execute($stmt)){
                echo 'Pending for approval';
                header("location: agent-reg.html");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
			         mysqli_stmt_close($stmt);
        }
    }
	 mysqli_close($link);
	
	 }
	 
	?>