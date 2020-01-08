<?php 
// Include configuration file   
//require_once 'config.php';  
	require __DIR__ . '/core/core.php';

    // Include Stripe PHP library  
    require_once 'stripe_charge/init.php';  

    \Stripe\Stripe::setApiKey("pk_test_wKXnMv2EYY4KrucgkbRFx6rx00KnmdUGy3");

    $charge = \Stripe\Charge::create([
      "amount" => 2000,
      "currency" => "inr",
      "source" => "tok_mastercard", // obtained with Stripe.js
      "description" => "Charge for jenny.rosen@example.com"
    ], [
      "idempotency_key" => "S8TcOdgcW39sGRRn",
    ]);
    $chargeJson = $charge->jsonSerialize(); 
    echo "<pre>"; print_r($chargeJson);die();
//----------------------------------------------------------------
 
$response = array(); 
 
// Check whether stripe token is not empty 
if(!empty($_POST['stripeToken'])){ 
     
    // Get token and buyer info 
    $token  = $_POST['stripeToken']; 
    $email  = $_POST['stripeEmail']; 
     
    // Include Stripe PHP library  
    require_once 'stripe_charge/init.php';  
     
    // Set API key 
    \Stripe\Stripe::setApiKey(STRIPE_API_KEY); 
     
    // Add customer to stripe  
    $customer = \Stripe\Customer::create(array(  
        'email' => $email,  
        'source'  => $token
    ));  
     //print_r($_REQUEST);exit;
	 
    $shipping  = 0;
    $total  = getTotal();
    $grand_total = $total + $shipping;
  
    if(ISSET($_REQUEST['products']) && count($_REQUEST['products']) > 0)
    {
      $grand_total = 0;
      foreach($_REQUEST['products'] as $product_id)
      {
    	  $product = getProduct($product_id);
    	  $grand_total += $product['variants'][0]['price'];
      }
    }
  
   $bill_info = $_SESSION['bill_info'];
    // Charge a credit or a debit card 
    $charge = \Stripe\Charge::create(array( 
        'customer' => $customer->id, 
        'amount'   => $grand_total * 100, 
        'currency' => 'USD', 
        'description' => 'watchband', 
    )); 
     
    // Retrieve charge details 
    $chargeJson = $charge->jsonSerialize(); 
 
    // Check whether the charge is successful 
    if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){ 
         
        // Order details 
        $txnID = $chargeJson['balance_transaction'];  
        $paidAmount = ($chargeJson['amount']/100); 
        $paidCurrency = $chargeJson['currency'];  
        $status = $chargeJson['status']; 
        $orderID = $chargeJson['id']; 
        $payerName = $chargeJson['source']['name']; 
         
        // Include database connection file   
       // require_once 'dbConnect.php'; 
         
        // Insert tansaction data into the database 
       // $sql = "INSERT INTO orders(name, email, item_name, item_price, item_price_currency, paid_amount, paid_amount_currency, txn_id, payment_status, created, modified) VALUES('".$payerName."', '".$email."', '".$productName."', '".$productPrice."', '".$currency."', '".$paidAmount."', '".$paidCurrency."', '".$txnID."', '".$status."', NOW(), NOW())"; 
       // $insert = $db->query($sql); 
       // $last_insert_id = $db->insert_id; 
         
        // If order inserted successfully 
        if( $status == 'succeeded'){ 
            $response = array( 
                'status' => 1, 
                'msg' => 'Your Payment has been Successful!', 
                'txnData' => $chargeJson 
            ); 
			
			$_SESSION['stripe_session']=$chargeJson;
        }else{ 
            $response = array( 
                'status' => 0, 
                'msg' => 'Transaction has been failed.' 
            ); 
        } 
    }else{ 
        $response = array( 
            'status' => 0, 
            'msg' => 'Transaction has been failed.' 
        ); 
    } 
}else{ 
    $response = array( 
        'status' => 0, 
        'msg' => 'Form submission error...' 
    ); 
} 
 
// Return response 
echo json_encode($response);