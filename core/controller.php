<?php

	$_VIEW = (isset($_REQUEST["page"]))?$_REQUEST["page"]:"home";
	$_ACTION =  (isset($_REQUEST["action"]))?$_REQUEST["action"]:"home"; 

	switch ($_ACTION) {
		case 'go_shipping':

			$_SESSION['email'] = $_POST['email'];

			$cart_array = array();
			$_SESSION['cart'] = array();

			$products = getProducts("Main");
			$product = $products[0];
			$product_id = (string)$product['id'];
			$price = 5.95;//$variant['price'];
			$variant = $products[0]['variants'][0];

			$cart_array[$product_id] = [
				'product_id'	=>	$product['id'], 
				'variant_id'	=>	$variant['id'], 
				'title'			=>	$product['title'],
				'price'			=>	$price,
				'src'			=>	$product['image']['src'], 
				'quentaty'		=>	5,
			];
			$_SESSION['cart'] = $cart_array;

			header('location: '.BASE_URL.'shipping.php');

			break;
		case 'submit_user_info':
			$_SESSION['shipping_info'] 	=	$_POST; //print_r($_SESSION['shipping_info']); die();
			echo "success";
			exit;
			break;
		

		case 'place_order':
			// $_SESSION = array();			

			// echo "<pre>"; print_r($_POST); die();
			
			

			// [payment_type] => paypal [pid] => 4399053504617 [quentaty] => 3

			// Get information
			$payment_type 	= $_POST['payment_type'];
			$product 		= getProduct($_POST['pid']);
			$quentaty 		= $_POST['quentaty'];
			
			$bill_info		= $_SESSION['shipping_info'];

			if($payment_type=='credit_card'){
				// Strip payment card info
				$_SESSION['card'] = $_POST['card'];
			}
			$_SESSION['payment_type'] = $payment_type;


			// Add orders to cart
			// addToCart($_REQUEST['pid'], ['Title'=>"Default Title"], $quentaty);

			// Order Items
			//--------------------------------------------------------
				$cart_array 	= $_SESSION['cart'];
				$line_items = [];
				$order_total = 0;

				$i=0;
				foreach ($cart_array as $key => $value) {
					$line_items[$i]['variant_id'] = $value['variant_id'];
					$line_items[$i]['quantity']   = $value['quentaty'];
					$line_items[$i]['price']   = $value['price'];
					$i++;
				}
			//--------------------------------------------------------

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

			// Shipping address and billing address is same in this project
			$billing_address = $shipping_address;

			// Save billing address to session for use
			$_SESSION['billing_info_other'] = $billing_address;

			// Order details for pass in api
			$order = [
			    "email" 				=>	$bill_info['email'],
			    "fulfillment_status" 	=>	"unfulfilled",
			    "line_items" 			=>	$line_items,
			    "shipping_address"		=>	$shipping_address,
			    "billing_address"		=>	$billing_address,
			    "financial_status"		=>	"paid",
			    "payment_status"		=>	"unpaid",
			    "payment_type"			=>	$_SESSION['payment_type'],
			];

			$_SESSION["last_order_id"] = addOrderInLocal($order);
			$_SESSION['order_info'] = getOrderFromLocalByID($_SESSION["last_order_id"]);

			// echo "<pre>"; print_r($_SESSION["order_info"]); die();

			// // Create a order for main order			
			// $_SESSION['order_info'] = createOrder($order);

			if($payment==true){

				if($payment_type=='paypal'){
					$order_info = $_SESSION['order_info'];
					// Paypal payment gatway
					$payer = new \PayPal\Api\Payer();
					$payer->setPaymentMethod('paypal');

					$amount = new \PayPal\Api\Amount();
					$amount->setTotal($order_info['total']);
					$amount->setCurrency("USD");

					$transaction = new \PayPal\Api\Transaction();
					$transaction->setAmount($amount);

					$redirectUrls = new \PayPal\Api\RedirectUrls();
					// hash("algo", data)

					$_SESSION['p_order_id'] = $_SESSION['order_info']['sno'];

					$redirectUrls->setReturnUrl(BASE_URL."core/core.php?action=s-paypal&id=".$_SESSION['order_info']['sno']."&next=".BASE_URL."upsell.php&last_order_id=".$_SESSION["last_order_id"])
					    ->setCancelUrl(BASE_URL."core/core.php?action=c-paypal&id=".$_SESSION['order_info']['sno']."&next=".BASE_URL."shipping.php&last_order_id=".$_SESSION["last_order_id"]);

					$payment = new \PayPal\Api\Payment();
					$payment->setIntent('sale')
					    ->setPayer($payer)
					    ->setTransactions(array($transaction))
					    ->setRedirectUrls($redirectUrls);

					// After Step 3
					try {
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

					// $financial_status = "paid";
				}else{

					// Order information for useing payment
					$order_info = $_SESSION['order_info'];
					$payment_note = "Transaction process ID=".$_SESSION['txansaction_id'].", user-email is ".$order_info['email'];
					
					// Include Stripe PHP library  
					require_once __DIR__ . '/../stripe_charge/init.php';
					
					$token = $_POST['stripeToken'];

					// Set API key 
					\Stripe\Stripe::setApiKey(STRIPE_API_KEY);

					$charge = \Stripe\Charge::create([
				      "amount" => $order_info['total'] *100,
				      "currency" => "USD",
				      // "source" => "tok_mastercard", // obtained with Stripe.js
				      'source'  => $token,
				      "description" => $payment_note
				    ], [
				      "idempotency_key" => $order_info['sno'],
				    ]);
				    $chargeJson = $charge->jsonSerialize(); 

				    // echo "<pre>"; print_r($chargeJson); die();

				    if($chargeJson['status']=='succeeded'){
				    	$financial_status = "paid";

				    	updateOrderPaymentStatusInLocal($order_info['sno'], $financial_status);

				  		// $order_update = [
						//     "financial_status"		=>	$financial_status,
						//     "note"					=>	"Payment paid of order no [".$order_info['order_number']."] and order id [".$order_info['id']."] is success by stripe and stripe Id =".$chargeJson['id'],
						// ];
						// $_SESSION['order_update_info'] = updateOrder($order_info['id'], $order_update);

				    }else{
				    	$financial_status = "canceled";
				    	updateOrderPaymentStatusInLocal($order_info['sno'], $financial_status);

				    	$_SESSION['paypal_error'] = 1;
						// header('location: shipping.php'); 
						header('location: '.BASE_URL.'shipping.php');
						die();

					  //   	$order_update = [
							// 	"financial_status"		=>	"voided",
							// 	"note"					=>	"Payment failed of ".$order_info['order_number']." and order id ".$_SESSION['order_info']['id']." failed by stripe. stripe error is [".$chargeJson['failure_message']."]",
							// ];
					  //   	$_SESSION['order_update_info'] = updateOrder($order_info['id'], $order_update);
				    }
				}
			}

			// header('location: ../upsell.php');
			header('location: '.BASE_URL.'upsell.php');
			exit;
			break;
		
		case 'upsell1-submit':
			$meta = [];
			$meta['stripeToken'] = isset($_POST['stripeToken']) ? $_POST['stripeToken'] :'';
			$meta['price'] 		= 14.95;
			$_SESSION['paypal_cancel_page_url'] = '../upsell.php';
			submitPostUpsell($_SESSION['shipping_info'], $_SESSION['billing_info_other'], $_POST['post_upsell'], "../upsell2.php", 1, $meta,'upsell1');
			exit;
			break;
		case 'upsell1-skip':
			$last_order_id =  isset($_SESSION["last_order_id"]) ? $_SESSION["last_order_id"] :'';
			$orderDetail = getOrderFromLocalByID($last_order_id);
			$orderDetail['line_items'] = json_decode($orderDetail['line_items'], true);
			$orderDetail['shipping_address'] = json_decode($orderDetail['shipping_address'], true);
			$orderDetail['billing_address'] = json_decode($orderDetail['billing_address'], true);
			$orderDetail['order_status'] = 'upsell1';


			updateOrderInLocal($last_order_id, $orderDetail);
			// header('location: ../upsell2.php');
			header('location: '.BASE_URL.'upsell2.php');
			exit;
			break;

		case 'upsell2-submit':
			// print_r($_POST); die();
			$meta['stripeToken'] = isset($_POST['stripeToken']) ? $_POST['stripeToken'] :'';
			$meta['price'] 		= 14.95;
			$_SESSION['paypal_cancel_page_url'] = '../upsell2.php';
			submitPostUpsell($_SESSION['shipping_info'], $_SESSION['billing_info_other'], $_POST['post_upsell'], "../upsell3.php", 2, $meta,'upsell2');
			exit;	
		break;

		case 'upsell2-skip':
			// print_r($_POST); die();
			
			$last_order_id =  isset($_SESSION["last_order_id"]) ? $_SESSION["last_order_id"] :'';
			$orderDetail = getOrderFromLocalByID($last_order_id);
			$orderDetail['line_items'] = json_decode($orderDetail['line_items'], true);
			$orderDetail['shipping_address'] = json_decode($orderDetail['shipping_address'], true);
			$orderDetail['billing_address'] = json_decode($orderDetail['billing_address'], true);
			$orderDetail['order_status'] = 'upsell2';
			updateOrderInLocal($last_order_id, $orderDetail);
			// header('location: ../upsell3.php');
			header('location: '.BASE_URL.'upsell3.php');
			exit;
			break;

		case 'upsell3-submit':
			$meta['stripeToken'] = isset($_POST['stripeToken']) ? $_POST['stripeToken'] :'';
			$meta['price'] 		= 19.95;
			$_SESSION['paypal_cancel_page_url'] = '../upsell3.php';
			submitPostUpsell($_SESSION['shipping_info'], $_SESSION['billing_info_other'], $_POST['post_upsell'], "../thank-you.php", 3, $meta,'upsell3');
			exit;
		break;

		case 'upsell3-skip':
			// print_r($_POST); die();
			$last_order_id =  isset($_SESSION["last_order_id"]) ? $_SESSION["last_order_id"] :'';
			$orderDetail = getOrderFromLocalByID($last_order_id);
			$orderDetail['line_items'] = json_decode($orderDetail['line_items'], true);
			$orderDetail['shipping_address'] = json_decode($orderDetail['shipping_address'], true);
			$orderDetail['billing_address'] = json_decode($orderDetail['billing_address'], true);
			$orderDetail['order_status'] = 'upsell3';
			updateOrderInLocal($last_order_id, $orderDetail);
			// header('location: ../thank-you.php');
			header('location: '.BASE_URL.'thank-you.php');
			exit;
			break;

		case 'variants':
			$res = [];

			$res['src'] = 'https://cdn.shopify.com/s/files/1/0263/9111/7929/products/Webp.net-resizeimage_28_1024x1024_2x_ed1fdea0-bbef-45a0-9d70-e1a5bbd617f2.jpg?v=1576221495';
			$res['variant'] = 1000000000;
			$res['request'] = $_REQUEST;

			// logic
			$product = getProduct($_POST['product_id']);
			$variation = getVariationByProduct($product, $options = [$_POST['option']['key']=>$_POST['option']['value']]);
			$images = getImagesByProduct($product, $variation['id']);

			foreach ($images as $key => $image) {
				$res['src'] = $image['src'];
			}

			$res['variant'] = $variation['id'];

			// $res['product'] = $product;
			// $res['variation'] = $variation;
			// $res['images'] = $images;
			echo json_encode($res);
			die();
		break;

		case 'cart_update_AJAX':
			// ---------- 
			if(isset($_SESSION['cart'])){
			        $cart_array = $_SESSION['cart'];
			}else{
			    $cart_array = array();
			}



			if(isset($_POST['product_id'])) {
				$qty = (isset($_POST['qty']))?$_POST['qty']:1;
				$price = (isset($_POST['price']))?$_POST['price']:$product['variants'][0]['price'];
				// $price = (isset($_POST['price']))?$_POST['price']:1;

				$product 	= 	getProduct($_POST['product_id']);
				$variant_id	=	$_POST['variant_id'];
				// print_r($product); die();

			    if(isset($cart_array) && !empty($cart_array)){

			        if(array_key_exists($_POST['product_id'],$cart_array)){
			        	$id = $_POST['product_id'];

			        	if($_POST['checked']=='false'){
			        		
			        		unset($cart_array[$id]);
			        	}

			        	if(isset($_POST['product_type']) && $_POST['product_type']=="Main"){
				        		$cart_array[$_POST['product_id']] = [
								'product_id'	=>	$product['id'], 
								'variant_id'	=>	$variant_id, 
								'title'			=>	$product['title'],
								'price'			=>	$price,
								'src'			=>	$product['image']['src'], 
								'quentaty'		=>	$qty,
							];
			        	}
			        }else{
			            // unset($cart_array[$_POST['product_id']]);
			            // if(isset($_POST['shipping'])){
			            //     $shipping = $_POST['shipping'];
			            // }
			            // else{
			            //     $shipping = 0;
			            // }
			            
			            $cart_array[$_POST['product_id']] = [
							'product_id'	=>	$product['id'], 
							'variant_id'	=>	$variant_id, 
							'title'			=>	$product['title'],
							'price'			=>	$price,
							'src'			=>	$product['image']['src'], 
							'quentaty'		=>	$qty,
						];
			        }

			        $_SESSION['cart'] = $cart_array;

			        // echo $_POST['product_id'];
			        // print_r($cart_array); die();
			    }
			}
			//----------
			require __DIR__ . '/../views/cartAJAX.php';
			die;
			break;

		case 's-paypal':

			if($_SESSION['p_order_id']==$_REQUEST['id']){

				//for upsell product
				$param = isset($_REQUEST['param']) ? $_REQUEST['param'] : [];
				if(!empty($param)){

					

					$param = json_decode(base64_decode($param), true);
					$orderDetail = getOrderFromLocalByID($_SESSION['p_order_id']);
					$upsell_total_price_for_db = $param[0]['price'] * $param[0]['quantity'];

					$oderItems = isset($orderDetail['line_items']) ? json_decode($orderDetail['line_items'],true) : [];
					$orderDetail['line_items'] = array_merge($oderItems,$param);
					$orderDetail['total'] = $orderDetail['total'] + $upsell_total_price_for_db;


					// Order state update
					$order_step = isset($_REQUEST['osu']) ? $_REQUEST['osu'] : false;
					if($order_step){
						$orderDetail['order_status'] = $order_step;
					}

					// die($orderDetail['order_status']);


					$u_return = updateOrderInLocal($_SESSION['p_order_id'], $orderDetail);

					if(!$u_return){
						header('location: '.BASE_URL.'index.php?error=Order failed.'); die;
					}
				}

				// $financial_status = "paid";
				//     	$order_update = [
				//     "financial_status"		=>	$financial_status,
				//     "note"					=>	"Payment paid of order id [".$_REQUEST['id']."] is success by paypal",
				// ];
				// updateOrder($_REQUEST['id'], $order_update);

				updateOrderPaymentStatusInLocal($_REQUEST['id'], "paid");
				header('location: '.$_REQUEST['next']);
				exit;
			}else{
				die("Invalid access");
			}
			break;
		case 'c-paypal':
			if($_SESSION['p_order_id']==$_REQUEST['id']){
				// $financial_status = "paid";
				//     	$order_update = [
				//     "financial_status"		=>	$financial_status,
				//     "note"					=>	"Payment paid of order id [".$_REQUEST['id']."] is canceled by paypal",
				// ];
				// updateOrder($_REQUEST['id'], $order_update);
				// updateOrderPaymentStatusInLocal($_REQUEST['id'], "canceled");
				$_SESSION['paypal_error'] = 1;
				// $_SESSION['error_message'] = "Payment ";
				header('location: '.$_REQUEST['next']);
				exit;
			}else{
				die("Invalid access");
			}
			break;
		
		case 'order-cron':
			echo '<pre>';
			//Cronurl : <BASE_URL>/core/core.php?action=order-cron
			$orders = getAllScheduledOrder();
			

			if($orders){
				foreach($orders as $key=>$val){
					try{
						processFinalOrder($val);
					}catch(Exception $ex){
						continue;
					}
				}
			}
			echo 'success';
		break;
		exit;
		default:
			// echo "Home";
			break;
	}

?>