<?php
//Database credentials
$dbHost     = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName     = 'booking';

//Connect with the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//Display error if failed to connect
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}


//check whether stripe token is not empty
if(!empty($_POST['stripeToken'])){
    //get token, card and user info from the form
    $token  = $_POST['stripeToken'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $card_num = $_POST['card_num'];
    $card_cvc = $_POST['cvc'];
    $card_exp_month = $_POST['exp_month'];
    $card_exp_year = $_POST['exp_year'];
    
    //include Stripe PHP library
    require_once('stripe-php/init.php');
    
    //set api key
    $stripe = array(
      "secret_key"      => "sk_test_51JQwS4F8vcIcut91Z7VRMndrwUyfNMbZkWup4zURUt20ErGz0xZtYmoO2EtF8lQAquWlfwQaLRFr6XrBCJA0HdSX00Gugz8HSP",
      "publishable_key" => "pk_test_51JQwS4F8vcIcut91yOmcZ49XHwmjx2qFFnrsuC2LvEeSX37QJrHcE0IUpxNlYStkj9U7GCpX4XBwxHkwDiZgiRmD00qTqCgtxN"
    );
    
    \Stripe\Stripe::setApiKey($stripe['sk_test_51JQwS4F8vcIcut91Z7VRMndrwUyfNMbZkWup4zURUt20ErGz0xZtYmoO2EtF8lQAquWlfwQaLRFr6XrBCJA0HdSX00Gugz8HSP']);
    
    //add customer to stripe
    $customer = \Stripe\Customer::create(array(
        'email' => $email,
        'source'  => $token
    ));
    
    //item information
    $RoomType = $_POST['rtype'];
    $duration = $_POST['duration'];
    $price = $_POST['amount'];
    $currency = "rwf";
    $orderID = "";
    
    //charge a credit or a debit card
    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => $price,
        'currency' => $currency,
        'description' => $RoomType,
        'metadata' => array(
            'order_id' => $orderID
        )
    ));
    
    //retrieve charge details
    $chargeJson = $charge->jsonSerialize();

    //check whether the charge is successful
    if($chargeJson['amount_refunded'] == 0 && empty($chargeJson
['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){
        //order details 
        $price = $chargeJson['amount'];
        $balance_transaction = $chargeJson['balance_transaction'];
        $currency = $chargeJson['currency'];
        $status = $chargeJson['status'];
        $date = date("Y-m-d H:i:s");
        
        //include database config file
       
        
        //insert tansaction data into the database
        $sql = 
"INSERT INTO payment(name,email,card_num,card_cvc,card_exp_month,card_exp_year,
room_type,duration,price,price_currency,paid_amount,
paid_amount_currency,txn_id,payment_status,created,modified) VALUES
('".$name."','".$email."','".$card_num."','".$card_cvc."','".$card_exp_month."',
'".$card_exp_year."','".$RoomType."','".$duration."','".$price."','".$currency."',
'".$amount."','".$currency."','".$balance_transaction."'
,'".$status."','".$date."','".$date."')";
        $insert = $db->query($sql);
        $last_insert_id = $db->insert_id;
        
        //if order inserted successfully
        if($last_insert_id && $status == 'succeeded'){
            $statusMsg = "<h2>The transaction was successful.</h2>
<h4>Order ID: {$last_insert_id}</h4>";
        }else{
            $statusMsg = "Transaction has been failed";
        }
    }else{
        $statusMsg = "Transaction has been failed";
    }
}else{
    $statusMsg = "Form submission error.......";
	
}

//show success or error message
echo $statusMsg;
?>