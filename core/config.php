<?php

	session_start();

	// define("BASE_URL", "https://freepin.stillmypresident.com/");
	// define("BASE_URL", "http://localhost/sketchbrains/DR/free_pin/");
	define("BASE_URL", "http://localhost/sketch/freepin-funnal-new/free-pin-new/");

	// Local Datatbase
    	$servername = "localhost";
    	$username = "root";
    	$password = "";
    	$dbname = "skb_free_pin";
	
	// $servername = "localhost";
	// $username = "free_pin";
	// $password = ",J9eO-lGQkqe";
	// $dbname = "skb_free_pin";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	// echo "Connected successfully";die;

	// Shopify API
	$_SHOPIFY_API = [
		'ShopUrl' => 'still-my-president-trump.myshopify.com/',
	    'ApiKey' => '97a0eaa52f169d9edbf132cf11a157d9',
	    'Password' => '4bca03c7e4359a913f438bf45b951ae1',
	];

	$shopify =  new PHPShopify\ShopifySDK($_SHOPIFY_API);

	// Paypal
	// ClientID' 
	// ClientSecret
	$payment = true;
	$ClientID 		= "AdPWESyzHzewyGDUYZp7wZEkhvS-DCmpYFVLfyADrfxDN2EAb5ImPGZFZviDtDzOaU_1Z92_ARksXLnG"; 
	$ClientSecret	= "EJOhnO1t9vxx3Jc3x9Mez_IM7whfPSgiUGU9Wh2ZEF8r4ECNs8BXqWIaWAHl0DvR-uYoxyq-2Zy3Pgfq";
	$apiContext = new \PayPal\Rest\ApiContext(new \PayPal\Auth\OAuthTokenCredential($ClientID, $ClientSecret));

	// Stryp
	define('STRIPE_API_KEY', 'sk_test_p6i4gH9svzcm0NL80AdW7erA001uYS9TNl');  
	define('STRIPE_PUBLISHABLE_KEY', 'pk_test_wKXnMv2EYY4KrucgkbRFx6rx00KnmdUGy3');

	//Product Info
	$_PRODUCTS = [
		"main"	=> [
			// "id" => 	"4399053504617",
			// "title"=>	"Trump Train 2020 Pin",
			// "body_html" =>"CHOO! CHOO! All aboard the Trump Train to re-elect our President Donald Trump in 2020! The perfect gift for you or a fellow Patriot!",
			// "price"=>[
			// 	[1]=>7.95,
			// 	[2]=>6.95,
			// 	[5]=>5.95,
			// 	[10]=>4.95
			// ],
		],
		"pre_upsell" =>[
			[
				"id" => 	"4437130772585",
				"title"=>	"Build The Wall Trump Lapel Pin",
				"body_html" =>"It is time to BUILD THE WALL! Featuring our President Donald Trump with a trowel in hand, the perfect gift for you or a fellow Patriot!",
				"price"=>7.95,
			],
			[
				"id" => 	"4437132902505",
				"title"=>	"Keep America Great Trump 2020 Lapel Pin",
				"body_html" =>"He's already made America Great Again, now it's time to KEEP AMERICA GREAT in 2020! Featuring our President Donald Trump, the perfect gift for you or a fellow Patriot!",
				"price"=>7.95,
			]
		],
		"post_upsell" =>[
			[
				"id" => 	"4437307359337",
				"title"=>	"",
				"body_html" =>"",
				"price"=>14.95,
			],
			[
				"id" => 	"4399115534441",
				"title"=>	"",
				"body_html" =>"",
				"price"=>14.95,
			],
			[
				"id" => 	"4438250422377",
				"title"=>	"",
				"body_html" =>"",
				"price"=>19.95,
			],
		],
	];
?>