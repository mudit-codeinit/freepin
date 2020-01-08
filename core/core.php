<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require __DIR__ . '/../vendor/autoload.php';
	require __DIR__ . '/../core/config.php';
	// echo "<pre>"; print_r($_SESSION);die;
	require __DIR__ . '/../core/helper.php';
	
	require __DIR__ . '/../core/controller.php';
	
	//check order is live then forcelly redirect on that page

	if($_VIEW=='thank-you'){
		$last_order_id =  isset($_SESSION["txansaction_id"]) ? $_SESSION["txansaction_id"] :'';
		if(empty($last_order_id)){
			header('location: index.php');
		}
		$responseShop = processShopifyOrder();

		$order_info = (isset($_SESSION['order_info']))?$_SESSION['order_info']:[];
		if(!empty($order_info) && is_array($responseShop)){
			$_SESSION['order_info'] = array_merge($order_info, $responseShop);
		}

	}else{
		
		checkOrderStatusAndRedirect($_VIEW);
	}
	
?>