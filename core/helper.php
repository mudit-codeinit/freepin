<?php


	/**
	 *===============================================================
	 * @Auther = Shekh Raies
	 * @Description = All helper function of this app shpuld be hear
	 *===============================================================
	 */

	// Get Products By Shopify
	if(function_exists("getProducts")==false){
		function getProducts($type = "Main"){
			// $type = Main, pre_upsell, post_upsell
			global $shopify;
			return $res	=	$shopify->Product->get(["product_type"=>$type]);
		}
	}

	// Get a Product By Shopify
	if(function_exists("getProduct")==false){
		function getProduct($productID = false){
			// $productID = 23564666666;
			if($productID){
				global $shopify;
				$res = $shopify->Product($productID)->get();
			}else{
				$res = false;
			}
			
			return $res;
		}
	}

	// Create a new Order
	if(function_exists("createOrder")==false){
		function createOrder($order = []){
			// $order = array ( createOrder
			//     "email" => "foo@example.com",
			//     "fulfillment_status" => "unfulfilled",
			//     "line_items" => [
			//       [
			//           "variant_id" => 27535413959,
			//           "quantity" => 5
			//       ]
			//     ]
			// );

			global $shopify;

			if(!empty($order) || isset($order))
				$res = $shopify->Order->post($order);
			else
				$res = false;

			return $res;
		}
	}

	// Update a order
	if(function_exists("updateOrder")==false){
		function updateOrder($orderID=false, $updateInfo = []){
			// $updateInfo = array (
			//     "fulfillment_status" => "fulfilled",
			// );

			

			if($orderID){
				if(!empty($updateInfo) || isset($updateInfo)){
					global $shopify;
					$res = $shopify->Order($orderID)->put($updateInfo);
				}else{
					$res = false;
				}
			}else{
				$res = false;
			}

			return $res;
		}
	}

	// Delete a order
	if(function_exists("deleteOrder")==false){
		function deleteOrder($orderID = false){
			// $productID = 23564666666;
			if($orderID){
				global $shopify;
				$res = $shopify->Order($orderID)->delete();
			}else{
				$res = false;
			}
			
			return $res;
		}
	}

	// Get country list
	if(function_exists("getCountries")==false){
		function getCountries($code = null){
			$countries = [
				'US' => 'United States'
			];
			if($code == null)
			{
				return $countries;
			}
			return isset($countries[$code]) ? $countries[$code] : '';
		}
	}

	// Get state list
	if(function_exists("getStates")==false){
		function getStates($code = null){
			$states = [
				"AL" => "Alabama",
				"AK" => "Alaska",
				"AS" => "American Samoa",
				"AZ" => "Arizona",
				"AR" => "Arkansas",
				"AE" => "Armed Forces Middle East",
				"AA" => "Armed Forces Americas",
				"AP" => "Armed Forces Pacific",
				"CA" => "California",
				"CO" => "Colorado",
				"CT" => "Connecticut",
				"DE" => "Delaware",
				"DC" => "District of Columbia",
				"FM" => "Federated States of Micronesia",
				"FL" => "Florida",
				"GA" => "Georgia",
				"GU" => "Guam",
				"HI" => "Hawaii",
				"ID" => "Idaho",
				"IL" => "Illinois",
				"IN" => "Indiana",
				"IA" => "Iowa",
				"KS" => "Kansas",
				"KY" => "Kentucky",
				"LA" => "Louisiana",
				"ME" => "Maine",
				"MD" => "Maryland",
				"MA" => "Massachusetts",
				"MI" => "Michigan",
				"MN" => "Minnesota",
				"MS" => "Mississippi",
				"MO" => "Missouri",
				"MT" => "Montana",
				"NE" => "Nebraska",
				"NV" => "Nevada",
				"NH" => "New Hampshire",
				"NJ" => "New Jersey",
				"NM" => "New Mexico",
				"NY" => "New York",
				"NC" => "North Carolina",
				"ND" => "North Dakota",
				"MP" => "Northern Mariana Islands",
				"OH" => "Ohio",
				"OK" => "Oklahoma",
				"OR" => "Oregon",
				"PA" => "Pennsylvania",
				"PR" => "Puerto Rico",
				"MH" => "Republic of Marshall Islands",
				"RI" => "Rhode Island",
				"SC" => "South Carolina",
				"SD" => "South Dakota",
				"TN" => "Tennessee",
				"TX" => "Texas",
				"UT" => "Utah",
				"VT" => "Vermont",
				"VI" => "Virgin Islands of the U.S.",
				"VA" => "Virginia",
				"WA" => "Washington",
				"WV" => "West Virginia",
				"WI" => "Wisconsin",
				"WY" => "Wyoming"
			];
			if($code == null)
			{
				return $states;
			}
			return isset($states[$code]) ? $states[$code] : '';
		}
	}

	if(function_exists("getVariationByProduct")==false){
		// 4401749721143
		function getVariationByProduct($product = false, $options = ['Size'=>"38mm", 'Series'=>1]){
			if(isset($product)){
				
				$variation = [];
				$ttc = count($options);
				$tc  = 0;

				// Get 
				foreach ($product['variants'] as $v) {
					$j=1;

					foreach ($options as $key => $option) {
						if($v['option'.$j] == $option)
						$tc++;
						
						$j++;
					}

					if($ttc==$tc){
						$variation = $v;//['id'];
					}
					$tc=0;					
				}

				return $variation;
			}else{
				return false;
			}
		}
	}

	if(function_exists("getImagesByProduct")==false){
		// 4401749721143
		function getImagesByProduct($product = false, $vid=false){
			if(isset($product)){
				
				$variation = [];
				$tc  = 0;

				// Get 
				foreach ($product['images'] as $v) {
					$j=1;

					foreach ($v['variant_ids'] as $key => $value) {
						if($value ==$vid){
							$variation[$j] = $v;
						}
					}

					// foreach ($options as $key => $option) {
					// 	if($v['option'.$j] == $option)
					// 	$tc++;
						
					// 	$j++;
					// }

					// if($ttc==$tc){
					// 	$variation = $v;//['id'];
					// }
					$tc=0;					
				}

				return $variation;
			}else{
				return false;
			}
		}
	}

	function getTotal(){
		$ca = (isset($_SESSION['cart']))? $_SESSION['cart']:[];
		$total = 0;
		foreach ($ca as $key => $p) {
			$total = $total+$p['price'];
		}

		return $total;
	}
	

	function addToCart($product_id, $variants= ['Title'=>"Default Title"], $quantity = 1){
		if(isset($_SESSION['cart'])){
		        $cart_array = $_SESSION['cart'];
		}else{
		    $cart_array = array();
		}


		if(isset($product_id)) {
			$product 	= 	getProduct($product_id);
			$variant =  	getVariationByProduct($product, $variants);

		    if(isset($_SESSION['cart'])){
		        $cart_array = $_SESSION['cart'];
		        if(!array_key_exists($product_id,$cart_array)){			            
		            $cart_array[$product_id] = $cart_array[$product_id] = [
						'product_id'	=>	$product['id'], 
						'variant_id'	=>	$variant['id'], 
						'title'			=>	$product['title'],
						'price'			=>	$variant['price'],
						'src'			=>	$product['image']['src'], 
						'quentaty'		=>	$quantity,
					];
		        }else{
		            unset($cart_array[$product_id]);
		            // if(isset($_POST['shipping'])){
		            //     $shipping = $_POST['shipping'];
		            // }
		            // else{
		            //     $shipping = 0;
		            // }
		            
		            $cart_array[$product_id] = [
						'product_id'	=>	$product['id'], 
						'variant_id'	=>	$variant['id'], 
						'title'			=>	$product['title'],
						'price'			=>	$variant['price'],
						'src'			=>	$product['image']['src'], 
						'quentaty'		=>	$quantity,
					];
		        }

		        $_SESSION['cart'] = $cart_array;
		    } else {
		            
		        $cart_array[$product_id] = [
					'product_id'	=>	$product['id'], 
					'variant_id'	=>	$variant['id'], 
					'title'			=>	$product['title'],
					'price'			=>	$variant['price'],
					'src'			=>	$product['image']['src'], 
					'quentaty'		=>	$quantity,
				];
		        $_SESSION['cart'] = $cart_array;
		    }
		}

		return $cart_array;
	}

	function submitPostUpsell($shipping_info= array(), $billing_address=array(), $post_upsell =array(), $page_redirect="../thank-you.php", $upsell_no=1, $meta=array(),$order_step = ''){
	
		
		$bill_info		=  $shipping_info;// R $_SESSION['shipping_info'];
		$qty = 1;
		$line_items = [];

		$i=0;
		
		
		foreach ( $post_upsell as $upsell_id) { //R $_POST['post_upsell']
			$line_items[$i]['variant_id'] = $upsell_id;
			$line_items[$i]['quantity']   = $qty;
			if(isset($meta['price'])){
				$line_items[$i]['price']   = $meta['price'];
			}
			$i++;
		}

		$upsell_total_price_for_db = $meta['price'] * $qty;
		$last_order_id =  isset($_SESSION["last_order_id"]) ? $_SESSION["last_order_id"] :'';
		$orderDetail = getOrderFromLocalByID($last_order_id);

		if(!$orderDetail){
			// header('location: ../index.php');
			header('location: '.BASE_URL.'index.php');
		}
		$oderItems = isset($orderDetail['line_items']) ? json_decode($orderDetail['line_items'],true) : [];
		$orderDetail['line_items'] = array_merge($oderItems,$line_items);
		$orderDetail['total'] = $orderDetail['total'] + $upsell_total_price_for_db;
		
		//updateOrderInLocal($last_order_id, $orderDetail);
		$orderDetail['id'] = $orderDetail['sno'];
		$orderDetail['currency']='USD';
		$orderDetail['total_price'] = $upsell_total_price_for_db;
		// echo '<pre>';
		// print_r($line_items);
		// print_r($oderItems);

		// print_r(array_merge($oderItems,$line_items));
		// die('ddd');
		//Get the data from db

		



		/*
		$shipping_address = [
			// "name"		=>	"Bob Bobsen",
			// "company"		=>	null,
			"first_name"		=> 	explode(" ", ($bill_info['first_name']))[0],
			"last_name"			=>	$bill_info['first_name'],
			"address1" 			=>	$bill_info['address'],
			// "address2" 			=>	$bill_info['apartment'],
			"city"				=>	$bill_info['city'],
			"country"			=>	$bill_info['country'],
			"phone"				=>	$bill_info['mobile'],
			"province"			=>	$bill_info['state'],
			"zip"				=>	$bill_info['pincode'],
			// "country_code"		=>	$bill_info['country'],
			// "province_code"		=>	$bill_info['state'],

			// "latitude"	=>	"45.41634",
			// "longitude"	=>	"-75.6868",
		];


		$billing_address = $billing_address;//R $_SESSION['billing_info_other'];
	
		$order = [
			"email" 				=>	$bill_info['email'],
			"fulfillment_status" 	=>	"unfulfilled",
			"line_items" 			=>	$line_items,
			"shipping_address"		=>	$shipping_address,
			"billing_address"		=>	$billing_address,
			"financial_status"		=>	"paid",//"pending",

			"metafields"=> [
				[
					"key"=> "main_order_id",
					"value"=> $_SESSION['order_info']['id'],
					"value_type"=> "string",
					"namespace"=> "global"
				]
			],
			"note"=>"This is post upsell order of order number ".$_SESSION['order_info']['order_number']." and order id ".$_SESSION['order_info']['id']

		];
	*/
		if(count($line_items) > 0)
		{
			$_SESSION['postupsell_order_info_'.$upsell_no] = $orderDetail;//createOrder($order);



			// Payment
			$payment_type = $_SESSION['payment_type'];

			if($payment_type=='paypal'){
				
				$paramDetail = base64_encode(json_encode($line_items));


				$order_info = $_SESSION['postupsell_order_info_'.$upsell_no];
				// Paypal payment gatway
				$payer = new \PayPal\Api\Payer();
				$payer->setPaymentMethod('paypal');

				$amount = new \PayPal\Api\Amount();
				$amount->setTotal($order_info['total_price']);
				$amount->setCurrency($order_info['currency']);

				$transaction = new \PayPal\Api\Transaction();
				$transaction->setAmount($amount);

				$redirectUrls = new \PayPal\Api\RedirectUrls();
				// hash("algo", data)

				$_SESSION['p_order_id'] = $_SESSION['postupsell_order_info_'.$upsell_no]['id'];

				$redirectUrls->setReturnUrl(BASE_URL."core/core.php?action=s-paypal&id=".$_SESSION['postupsell_order_info_'.$upsell_no]['id']."&osu=".$order_step."&param=".$paramDetail."&next=".BASE_URL.str_replace("../", "", $page_redirect))
					->setCancelUrl(BASE_URL."core/core.php?action=c-paypal&id=".$_SESSION['postupsell_order_info_'.$upsell_no]['id']."&osu=".$order_step."&next=".BASE_URL.str_replace("../", "", $_SESSION['paypal_cancel_page_url']));
					
				    // ->setCancelUrl(BASE_URL."core/core.php?action=c-paypal&id=".$_SESSION['postupsell_order_info_'.$upsell_no]['id']."&next=".BASE_URL.str_replace("../", "", $page_redirect));


				$payment = new \PayPal\Api\Payment();
				$payment->setIntent('sale')
				    ->setPayer($payer)
				    ->setTransactions(array($transaction))
				    ->setRedirectUrls($redirectUrls);

				// After Step 3
				try {
					global $apiContext;
				    $payment->create($apiContext);
				    // echo $payment;

				    // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n"; die();

				    header('location: '.$payment->getApprovalLink()); die();
				}
				catch (\PayPal\Exception\PayPalConnectionException $ex) {
				    // This will print the detailed information on the exception.
				    //REALLY HELPFUL FOR DEBUGGING
				    echo $ex->getData(); die();
				}
			}else{

				// Order information for useing payment
				$order_info = $_SESSION['postupsell_order_info_'.$upsell_no];
				$payment_note = "Transaction process ID: ".$order_info['transaction_id'].", user-email is ".$order_info['email'];
				
				// Include Stripe PHP library  
				require_once __DIR__ . '/../stripe_charge/init.php';
				
				// Set API key 
				\Stripe\Stripe::setApiKey(STRIPE_API_KEY);

				$token = $meta['stripeToken'];

				$charge = \Stripe\Charge::create([
			      "amount" => $order_info['total_price'] *100,
			      "currency" => $order_info['currency'],
			      // "source" => "tok_mastercard", // obtained with Stripe.js
			      'source'  => $token,
			      "description" => $payment_note
				], 
				[
			      "idempotency_key" => $order_info['id'].'-'.$upsell_no,
			    ]);
			    $chargeJson = $charge->jsonSerialize(); 

			    // echo "<pre>"; print_r($chargeJson); die();

			    if($chargeJson['status']=='succeeded'){
			    	$financial_status = "paid";
			    	// $order_update = [
					//     "financial_status"		=>	$financial_status,
					//     "note"					=>	"Payment paid of order no [".$order_info['order_number']."] and order id [".$order_info['id']."] is success by stripe and stripe Id =".$chargeJson['id'],
					// ];
					
					$orderDetail['order_status'] = $order_step;

					updateOrderInLocal($last_order_id, $orderDetail);

					//$_SESSION['order_update_info'] = updateOrder($order_info['id'], $order_update);
			    }else{
					$page_redirect = $_SESSION['paypal_cancel_page_url'].'?error="Payment has been declined, Please try again later"';
			    	// $order_update = [
					// 	"financial_status"		=>	"voided",
					// 	"note"					=>	"Payment failed of ".$order_info['order_number']." and order id ".$_SESSION['order_info']['id']." failed by stripe. stripe error is [".$chargeJson['failure_message']."]",
					// ];
			    	// $_SESSION['order_update_info'] = updateOrder($order_info['id'], $order_update);
			    }
			}

			/*
			$order_update = [
			    "financial_status"		=>	"paid"
			];
			$_SESSION['postupsell_order_update_info_'.$upsell_no] = updateOrder($_SESSION['postupsell_order_info_'.$upsell_no]['id'], $order_update);

			$order_update =[];
			$order_update = [
				"metafields"=> [
					[
						"key"=> "post_upsell_".$upsell_no."_order_id",
						"value"=> $_SESSION['postupsell_order_info_'.$upsell_no]['id'],
						"value_type"=> "string",
						"namespace"=> "global"
					]
				],
				"note"=> "Post Upsell order number is ".$_SESSION['postupsell_order_update_info_'.$upsell_no]['order_number']." and Order ID is ".$_SESSION['postupsell_order_update_info_'.$upsell_no]['id']
			];

			$_SESSION['order_update_info'] = updateOrder($_SESSION['order_info']['id'], $order_update);

			*/
			
		}
		
		header('location: '.$page_redirect);
		return true;
	}

	// Database
	function addOrderInLocal($order_data){
		global $conn;

		$total					= 0;

		foreach ($order_data['line_items'] as $key => $value) {
			$total = $total + ($value['quantity'] * $value['price']); 			
		}

		// die($total);
		
		$email 					= $conn->real_escape_string ($order_data['email']);
		$fulfillment_status 	= $conn->real_escape_string ($order_data['fulfillment_status']);
		$line_items 			= $conn->real_escape_string (json_encode($order_data['line_items']));
		
		$shipping_address 		= $conn->real_escape_string (json_encode($order_data['shipping_address']));
		$billing_address 		= $conn->real_escape_string (json_encode($order_data['billing_address']));
		$create_at 				= $conn->real_escape_string (date('Y-m-d H:i:s'));
		$update_at 				= $conn->real_escape_string (date('Y-m-d H:i:s'));
		$order_status 			= $conn->real_escape_string ("main-order");
		$payment_type			= $conn->real_escape_string ($order_data['payment_type']);	
		$payment_status			= $conn->real_escape_string ("unpaid");
		$txansaction = getTxansaction();

		$sql = "INSERT INTO `orders` (
					`email`, 
					`fulfillment_status`, 
					`line_items`,
					`total`,
					`shipping_address`,
					`billing_address`,
					`create_at`,
					`update_at`,
					`order_status`,
					`payment_type`,
					`payment_status`,
					`transaction_id`
				) VALUES (
					'$email', 
					'$fulfillment_status',
					'$line_items',
					$total,
					'$shipping_address',
					'$billing_address',
					'$create_at',
					'$update_at',
					'$order_status',
					'$payment_type',
					'$payment_status',
					'$txansaction'
				);";

		if ($conn->query($sql) === TRUE) {
		    // echo "New record created successfully";
			$last_id = $conn->insert_id;
			$_SESSION['txansaction_id'] = $txansaction;
		    return $last_id;
		} else {
		    // echo "Error: " . $sql . "<br>" . $conn->error;
		    return false;
		}

		$conn->close();
	}

	function updateOrderInLocal($order_id, $order_data){
		global $conn;

		$email 					= $conn->real_escape_string ($order_data['email']);
		$fulfillment_status 	= $conn->real_escape_string ($order_data['fulfillment_status']);
		$line_items 			= $conn->real_escape_string (json_encode($order_data['line_items']));
		$shipping_address 		= $conn->real_escape_string (json_encode($order_data['shipping_address']));
		$billing_address 		= $conn->real_escape_string (json_encode($order_data['billing_address']));
		$create_at 				= $conn->real_escape_string (date('Y-m-d H:i:s'));
		$update_at 				= $conn->real_escape_string (date('Y-m-d H:i:s'));
		$order_status 			= $conn->real_escape_string ($order_data['order_status']); //"main-order"
		$payment_type			= $conn->real_escape_string ($order_data['payment_type']);	
		$payment_status			= $conn->real_escape_string ($order_data['payment_status']);

		$sql = "UPDATE `orders`
				SET 
					payment_status='$payment_status',
					line_items='$line_items',
					update_at='$update_at',
					order_status='$order_status'

				WHERE sno=$order_id";

		if ($conn->query($sql) === TRUE) {
		    // echo "New record created successfully";
		    $last_id = $conn->insert_id;
		    return $last_id;
		} else {
		    // echo "Error: " . $sql . "<br>" . $conn->error;
		    return false;
		}

		$conn->close();
	}

	function updateOrderPaymentStatusInLocal($order_id, $payment_status){
		global $conn;

		$sql = "UPDATE `orders`
				SET 
					payment_status='$payment_status'
				WHERE sno=$order_id";

		if ($conn->query($sql) === TRUE) {
		    // echo "New record created successfully";
		    // $last_id = $conn->insert_id;
		    return $order_id;
		} else {
		    // echo "Error: " . $sql . "<br>" . $conn->error;
		    return false;
		}

		// $conn->close();
	}

	function getOrderFromLocalByID($order_id){
		global $conn;
		$sql = "SELECT * FROM orders where sno='$order_id'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
			$row = $result->fetch_assoc();
			return $row;
		} else {
		    return false;
		}
	}

	function checkOrderStatusAndRedirect($view = ''){
		
		global $conn;
		if(empty($view)){
			return false;
		}
		$last_order_id =  isset($_SESSION["last_order_id"]) ? $_SESSION["last_order_id"] :'';
		$orderDetail = getOrderFromLocalByID($last_order_id);

		// print_r($orderDetail['payment_status']); die();


		if(empty($orderDetail) && ($view=='upsell' || $view=='upsell1' || $view=='upsell2' || $view=='upsell3') ){
			// header('location: index.php');
			header('location: '.BASE_URL.'index.php');
		}

		$order_status = isset($orderDetail['order_status']) ? $orderDetail['order_status'] :'';

		// If unpaid then remove order
		if(!empty($orderDetail['payment_status']) && $orderDetail['payment_status'] != 'paid'){
			deleteOrderFromLocal($orderDetail['sno']);
			header('location: '.BASE_URL.'index.php');
		}

		if($order_status == 'upsell1' && $view!='upsell2'){
			// header('location: upsell2.php');
			header('location: '.BASE_URL.'upsell2.php');
		}

		if($order_status == 'upsell2' && $view!='upsell3'){
			// header('location: upsell3.php');
			header('location: '.BASE_URL.'upsell3.php');
		}

		if($order_status =='main-order' && $view=='home'){
			// header('location: upsell.php');
			header('location: '.BASE_URL.'upsell.php');
		}
		
	}

	function processShopifyOrder(){
		global $conn;
		$last_order_id =  isset($_SESSION["last_order_id"]) ? $_SESSION["last_order_id"] :'';
		$orderDetail = getOrderFromLocalByID($last_order_id);
		$order_status = isset($orderDetail['order_status']) ? $orderDetail['order_status'] :'';

		if($order_status!='upsell3'){
			header('location: '.BASE_URL.'index.php');
			// header('location: index.php');
			exit;
		}

		$processStatus = processFinalOrder($orderDetail);

		// if($processStatus!=false){
		// 	// session_destroy();
		// }

		return $processStatus;
	
	}

	function processFinalOrder($orderDetail = []){

		if(empty($orderDetail)){
			return false;
		}
		$sno = isset($orderDetail['sno']) ? $orderDetail['sno'] :'';
		$email = isset($orderDetail['email']) ? $orderDetail['email'] :'';
		$fulfillment_status = isset($orderDetail['fulfillment_status']) ? $orderDetail['fulfillment_status'] :'';
		$line_items = isset($orderDetail['line_items']) ? json_decode($orderDetail['line_items'],true) :[];
		$shipping_address = isset($orderDetail['shipping_address']) ? json_decode($orderDetail['shipping_address'],true) : [];
		$billing_address = isset($orderDetail['billing_address']) ? json_decode($orderDetail['billing_address'],true) : [];
		$payment_status = isset($orderDetail['payment_status']) ? $orderDetail['payment_status'] : '';
		$transaction_id = isset($orderDetail['transaction_id']) ? $orderDetail['transaction_id'] : '';
		$payment_type = isset($orderDetail['payment_type']) ? $orderDetail['payment_type'] : '';
		$payment_type = $payment_type == 'credit_card' ? 'Stripe' : ucfirst($payment_type); 
 
		if(empty($email) || empty($fulfillment_status) || empty($line_items) || empty($shipping_address) || empty($billing_address)){
			return false;
		}

		if($payment_status!='paid'){
			deleteOrderFromLocal($sno);
			return false;
		}

		$order = array (
			    "email" => $email,
			    "fulfillment_status" => $fulfillment_status,
				"line_items" => $line_items,
				"shipping_address"=>$shipping_address,
				"billing_address"=>$billing_address,
				"financial_status"=>'paid',
				"metafields"=> [
					[
						"key"=> "transaction_id",
						"value"=> $transaction_id,
						"value_type"=> "string",
						"namespace"=> "global"
					]
				],
				"note"=> $payment_type." payment transaction ID: ".$transaction_id
			);

			
			

		$status = createOrder($order);

		if($status){
			deleteOrderFromLocal($sno);
		}

		return $status;
	}

	function deleteOrderFromLocal($last_order_id = ''){
		global $conn;
		if(empty($last_order_id)){
			return false;
		}
		$sql = "Delete from `orders` WHERE sno=$last_order_id";

		return $conn->query($sql);
	}

	function getTxansaction(){
		return md5(date("Y-m-d h:i:sa"));
	}

	function getAllScheduledOrder(){
		global $conn;
		$date = date('Y-m-d H:i:s');
		$sql = "SELECT * FROM `orders` where ROUND(time_to_sec((TIMEDIFF('$date', `create_at`))) / 60) >=7 and `payment_status`='paid'";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    $data = [];
		    while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
			return $data;
		} 
		
		return false;
	}

?>