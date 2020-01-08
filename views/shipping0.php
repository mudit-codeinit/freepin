<?php 
	// if(isset($_SESSION['cart'])){
	//     $cart_array = $_SESSION['cart'];
	// }else{
	//     $cart_array = array();
	//     header('location: index.php');
	// }
	// // header('location: index.php');
	// $shipping  = 0;
	// $total  = getTotal();
	// $grand_total = $total + $shipping;

 	$cart_array = (isset($_SESSION['cart']))?$_SESSION['cart']:[];




	$products = getProducts("Main");

	$pre_products = getProducts("pre_upsell");


	$product = $products[0];

	// echo"<pre>"; print_r($product); die();

	$email = (isset($_SESSION['email']))?$_SESSION['email']:"";


    // get Cart total
    $total = 0;
        foreach ($cart_array as $key => $p) {
        $total = $total+($p['price']*$p['quentaty']);
    }

	
?>

<style type="text/css">
	#error_handler_overlay {
	    position: fixed;
	    top: 0;
	    left: 0;
	    padding: 0;
	    margin: 0;
	    width: 100%;
	    height: 100%;
	    z-index: 2147483647;
	    background: #333;
	    background: rgba(255,255,255,.8);
	    display: none;
	    overflow-x: hidden;
	    -webkit-overflow-scrolling: touch;
	}

	.error_handler_body {
	    margin: 100px auto;
	    width: 40%;
	    padding: 20px;
	    background-color: #fff;
	    background-clip: padding-box;
	    border: 1px solid #999;
	    border: 1px solid rgba(0,0,0,.2);
	    border-radius: 0;
	    -webkit-box-shadow: 0 3px 9px rgba(0,0,0,.5);
	    box-shadow: 0 3px 9px rgba(0,0,0,.5);
	    font-size: 14px;
	    line-height: 1.42857143;
	    color: #333;
	    position: relative;
	    -webkit-box-sizing: border-box;
	    -moz-box-sizing: border-box;
	}
	#error_handler_overlay_close {
	    position: absolute;
	    right: -10px;
	    top: -10px;
	    color: #fff;
	    background-color: #333;
	    border: 2px solid #fff;
	    border-radius: 50%;
	    width: 30px;
	    height: 30px;
	    text-align: center;
	    cursor: pointer;
	    text-decoration: none;
	    font-weight: 700;
	    line-height: 30px;
	    padding: 0;
	    margin: 0;
	}
    #loading-indicator {
        background-color: rgba(0, 0, 0, 0.5);
        bottom: 0;
        box-sizing: border-box;
        height: 100%;
        left: 0;
        margin: 0 auto;
        position: fixed;
        right: 0;
        top: 0;
        width: 100%;
        padding: 0px !important;
        margin: 0px !important;
        font-size: 1px;
        z-index: 9999 !important;
    }
    
    #loading-indicator:before {
        background: url("assets/loading.gif") no-repeat center center;
        box-sizing: border-box;
        content: "";
        height: 70px;
        left: 50%;
        margin-left: -35px;
        margin-top: -70px;
        position: absolute;
        top: 50%;
        width: 70px;
        z-index: 2;
    }
    
    #loading-indicator:after {
        background: #fff;
        border-radius: 5px;
        box-sizing: border-box;
        color: #000;
        content: "Processing, one moment please... ";
        font-family: arial;
        font-size: 17px;
        height: 110px;
        left: 50%;
        line-height: 98px;
        margin-left: -150px;
        margin-top: -75px;
        padding-top: 35px;
        position: absolute;
        text-align: center;
        top: 50%;
        width: 300px;
        z-index: 1;
    }


</style>
    <p id="loading-indicator" style="display:none;">Processing...</p>

<section class="row justify-content-center grayBG">
    <?php if(isset($_SESSION['paypal_error']) && $_SESSION['paypal_error']==1){ ?>
    <div class="col-10 alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Payment Failed!</strong> Payment is cancelled from the paypal.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    unset($_SESSION['paypal_error']);
    } ?>

    <div class="col-10">
        <div class="row justify-content-center ad_Banner txt-center" style="background-image: url('assets/images/4k-Flag.png');">
            <h2>
                HURRY UP! These Trump Train 2020 Pins Are Moving Fast..
            </h2>
        </div>
    </div>
    <div class="col-md-4 text-center"> 
        <h3>GET YOUR <?php echo $product['title']; ?> NOW</h3>



        <div class="row zoomImg">
            <div class="show col-12" href="assets/images/mainProduct.webp">
                <!-- <img src="assets/images/mainProduct.webp" class="img-fluid product" id="show-img"/> -->
                <img src="<?php echo $product['image']['src']; ?>" class="img-fluid product" id="show-img"/>
            </div>

            <div class="small-img col-12">
                <div class="small-container">
                    <div id="small-img-roll">
                    	<?php foreach ($product['images'] as $image_obj) { ?>
                        <img src="<?php echo $image_obj['src']; ?>" class="show-small-img" alt="">
                        <?php } ?>
                        <!-- <img src="assets/images/mainProduct.webp" class="show-small-img" alt="">
                        <img src="assets/images/mainProduct_2.webp" class="show-small-img" alt="">
                        <img src="assets/images/mainProduct_3.webp" class="show-small-img" alt="">
                        <img src="assets/images/mainProduct_4.webp" class="show-small-img" alt="">
                        <img src="assets/images/mainProduct_5.webp" class="show-small-img" alt="">
                        <img src="assets/images/currency.png" class="show-small-img" alt=""> -->
                    </div>
                </div>
            </div>
        </div>



        <!-- <img src="assets/images/currency.png" class="img-fluid product"/> -->

        <!-- <div class="row">
            <img src="assets/images/money-back-banner.png" class="img-fluid">
        </div> -->

        <div class="row txt-center">
            <img src="assets/images/money-back-banner.png" class="img-fluid" style="margin-left: auto;margin-right: auto;">
            <p>Each pin comes with our 100% satisfaction guarantee. If you aren't satisfied with your order, we'll refund you 100%, no questions asked!</p>
        </div>

    </div>
    <div class="col-md-6">
    	<!-- Div by raies -->
    	<div  class="col-md-12">
    		<div id="error_handler_overlay" style="display: none;">
				<div class="error_handler_body" >
					<a href="javascript:void(0);"  id="error_handler_overlay_close">X</a>
					<ul id="custom_error_div" style="padding: 20px; color: red;">
					</ul>
				</div>
			</div>
    	</div>

        <h4 class=" text-center">
            <!-- Fill out your shipping details below now Because we have activated your 100% Free coupon code for the next 10 minutes.... -->
            Fill out the shipping details below and let us know where to ship your Free Trump Train 2020 pin! Just cover the small Shipping & Handling fee and we’ll take care of the rest! 
        </h4>
        <div class="row justify-content-center formBox">

            <div class="col-10">

                <div class="row formHead">
                    <div class="col-6 active">
                        <h5>
                            SHIPPING
                            <span>Where To Ship</span>
                        </h5>
                    </div>

                    <div class="col-6">
                        <h5>
                            YOUR INFO
                            <span>Your Billing Info</span>
                        </h5>
                    </div>


                </div>


                <div class="row justify-content-center formBody">
                    <form id="form1" class="shopping_form active">
                        <div class="col-12 form-group">
                            <input class="form-control" name="first_name" required="" type="text" placeholder="Full Name..."/>
                        </div>
                        
                        <div class="col-12 form-group">
                            <input class="form-control" name="email" required="" value="<?php echo $email; ?>" type="email" placeholder="Email Address..."/>
                        </div>
                        
                        <div class="col-12 form-group">
                            <input class="form-control" name="mobile" required="" type="text" placeholder="Phone Number..." onkeypress="return isNumberKey(event)" minlength="10" maxlength="13"/>
                        </div>
                        
                        <!-- <div class="col-12 form-group">
                            Shopping
                        </div> -->

                        <div class="col-12 form-group">
                            <input class="form-control" name="address"  type="text" placeholder="Full Address..."/>
                        </div>

                        <div class="col-12 form-group">
                            <input class="form-control" name="city" required="" type="text" placeholder="City Name..."/>
                        </div>

                        <div class="col-12 form-group">
                            <input class="form-control"  name="state" required="" type="text" placeholder="State / Province..."/>
                        </div>

                        <div class="col-12 form-group">
                            <input class="form-control" name="pincode" required="" type="text" placeholder="Zip Code..." onkeypress="return isNumberKey(event)" minlength="5" maxlength="5"/>
                        </div>

                        <div class="col-12 form-group">
                            <select class="form-control" name="country">
                                <option value="" >Select Country</option>
								<?php foreach(getCountries() as $key => $value){ ?>
									<option value="<?php echo $value; ?>" selected="selected"><?php echo $value; ?></option>
								<?php } ?>  
                            </select>
                        </div>

                        <div class="col-12 form-group text-center">
                            <button type="submit" class="btn-green big_btn GoStepTo ">
                                <!-- Go To Step 2 -->
                                Checkout
                            </button>
                            <span>
                                *Offer Is Only Valid For United States Addresses*
                            </span>
                        </div>
                    </form>

                    <!-- core/core.php -->
                    <form id="form2" class="yourInfo_form" action="core/core.php" method="POST">
                    	<input type="hidden" name="action" value="place_order">
                        <input id="payment_type" type="hidden" name="payment_type" value="credit_card">
                        <input id="pid" type="hidden" name="pid" value="<?php echo $product['id']; ?>">

                        <div class="col-12 form-group">
                            <a class="back"> <i class="fa fa-chevron-left" aria-hidden="true"></i> 
                                <!-- Edit to Shopping Details -->
                                Edit Shipping Details
                            </a>
                        </div>
                        
                        
                        <div class="col-12">
                            <div class="row justify-content-center align-items-center form-group">
                                <h6 class="col-9">
                                    <!-- Due to limited stock and high demand, we can only send a maximum of 10 pins to each customer. Select Below -->
                                    *Supplies are very limited. We have a strict limit of 10 per customer.*
                                </h6>
                                <h6 class="col-3 text-right">
                                    Price
                                </h6>
                            </div>

                            <div class="row justify-content-center align-items-center form-group">
                                <div class="col-9">
                                    <label for="#retailPrice_1">
                                        <input onclick="addProduct1(<?php echo $product['id']; ?>, <?php echo $product['variants'][0]['id']; ?>,1, 7.95)" type="radio" name="quentaty" value="1" id="retailPrice_1" >
                                        <!-- Free Trump $1000 Bill (Retail $15.00) -->
                                        <span onclick='radioClickFunc("retailPrice_1");'>1 FREE Trump Train Pin (Retail $<?php echo $product['variants'][0]['price']; ?>)</span>
                                        <!-- (Retail $14.95)   -->
                                    </label>

                                </div>
                                <div class="col-3 text-right">
                                    <span>$7.95 S&H</span>
                                </div>
                            </div>

                            

                            <div class="row justify-content-center align-items-center form-group">
                                <div class="col-9">
                                    <label for="#retailPrice_2">
                                        <input onclick="addProduct1(<?php echo $product['id']; ?>, <?php echo $product['variants'][0]['id']; ?>, 2, 6.95)" type="radio" name="quentaty" value="2" id="retailPrice_2" >
                                        <!-- 2 FREE Trump $1000 Bill's (Retail $30) -->
                                        <span onclick='radioClickFunc("retailPrice_2");'>2 FREE Trump Train Pins (Retail $<?php echo (($product['variants'][0]['price'])*2); ?>) </span>
                                        <!-- (Retail $29.90)  -->
                                    </label>

                                </div>
                                <div class="col-3 text-right">
                                    <span>$6.95 S&H/Each</span>
                                </div>
                            </div>                                    

                            

                            <div class="row justify-content-center align-items-center form-group bestDeal">
                                <div class="col-9">
                                    <label for="#retailPrice_3">
                                        <input onclick="addProduct1(<?php echo $product['id']; ?>, <?php echo $product['variants'][0]['id']; ?>, 5, 5.95)" type="radio" name="quentaty" value="5" id="retailPrice_3" checked>
                                        <!-- 5 FREE Trump $1000 Bill's (Retail $75) -->
                                        <span onclick='radioClickFunc("retailPrice_3");'>5 FREE Trump Train Pins (Retail $<?php echo (($product['variants'][0]['price'])*5); ?>)</span> 
                                        <!-- (Retail $74.75)  -->
                                    </label>

                                </div>
                                <div class="col-3 text-right">
                                    <span>
                                    	$5.95 S&H/Each
                                    </span>
                                </div>
                            </div>                                 

                            

                            <div class="row justify-content-center align-items-center form-group">
                                <div class="col-9">
                                    <label for="#retailPrice_4">
                                        <input onclick="addProduct1(<?php echo $product['id']; ?>, <?php echo $product['variants'][0]['id']; ?>, 10, 4.95)"  type="radio" name="quentaty" value="10"id="retailPrice_4" >
                                        <!-- 10 FREE Trump $1000 Bill's (Retail $150) -->
                                        <span onclick='radioClickFunc("retailPrice_4");'>10 FREE Trump Train Pins (Retail $<?php echo (($product['variants'][0]['price'])*10); ?>) </span>
                                        <!-- (Retail $149.50)  -->
                                    </label>

                                </div>
                                <div class="col-3 text-right">
                                    <span>
	                                    $4.95 
	                                    S&H/Each
	                                </span>
                                </div>
                            </div>
                            

                        </div>



                        <!-- acountDtails  -->
                        <div class="col-12 acountDtails">

                            <div class="row accord">
                                <div id="credit_card" class="col-12 accordItem">
                                    <div  class="row accordHead">
                                        <h6 class="col">
                                            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
                                            Credit Card
                                        </h6>
                                    </div>
                                    <div  class="row accordBody">
                                        <div class="col">
                                            <div class="row form-group">
                                                <div class="col-12">Credit Card Number:</div>
                                                <div class="col-12">
                                                    <input id="card_number" name="card[number]" type="text" class="form-control" placeholder="Card Number" onkeypress="return isNumberKey(event)" minlength="16" maxlength="16">
                                                </div>
                                            </div>
        
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-12">Exp:</div>
                                                        <div class="col-12 form-group">
                                                        	  
                                                            <input id="card_exp" name="card[exp]" type="text" class="form-control" placeholder="MM/YY" onkeypress="return isNumberKeyWithSlash(event)" minlength="5" maxlength="5">
                                                        </div>                                                            
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-12">CVC:</div>
                                                        <div class="col-12 form-group">
                                                        	 
                                                            <input id="card_cvc" name="card[cvc]" type="text" class="form-control" placeholder="CVC" onkeypress="return isNumberKey(event)" minlength="3" maxlength="3">
                                                        </div>                                                            
                                                    </div>
                                                </div>                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="paypal" class="col-12 accordItem">
                                    <div class="row accordHead">
                                        <h6 class="col">
                                            <i class="fab fa-paypal" aria-hidden="true"></i>
                                            Paypal
                                        </h6>
                                    </div>
                                    <div class="row accordBody" style="display: none;">
                                        <div class="col">
                                            <div class="row form-group text-center">
                                                
                                                <div class="col-12">
                                                    <p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="163" height="80.9" viewBox="-252.3 356.1 163 80.9" enable-background="new -252.3 356.1 163 80.9"><path stroke="#B2B2B2" stroke-width="2" stroke-miterlimit="10" d="M-108.9 404.1v30c0 1.1-.9 2-2 2h-120.1c-1.1 0-2-.9-2-2v-75c0-1.1.9-2 2-2h120.1c1.1 0 2 .9 2 2v37m-124.1-29h124.1" fill="none"/><circle fill="#B2B2B2" cx="-227.8" cy="361.9" r="1.8"/><circle fill="#B2B2B2" cx="-222.2" cy="361.9" r="1.8"/><circle fill="#B2B2B2" cx="-216.6" cy="361.9" r="1.8"/><path stroke="#B2B2B2" stroke-width="2" stroke-miterlimit="10" d="M-128.7 400.1h36.7m-3.6-4.1l4 4.1-4 4.1" fill="none"/></svg>
                                                    </p>
                                                </div>
                                                <div class="col-12">
                                                    <p>
                                                        After clicking 'Complete order', you will be redirected to PayPal to complete your purchase securely.
                                                    </p>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                                                                
                        </div>
                        <!-- acountDtails -->


                        <div id="checkout-products" class="col-11 itemSelected">
                        
                            <div class="row justify-content-center align-items-center itemHead form-group">
                                <h5 class="col-8">
                                    Item
                                </h5>
                                <h5 class="col-4 text-right">
                                    <span>Amount</span>
                                </h5>
                            </div>
                        
                        	<?php foreach ($cart_array as $key => $p) { ?>
								<div class="row justify-content-center align-items-center form-group">
								    <h6 class="col-8">
								        <!-- Free Trump $1000 Bill (Retail $15.00) -->
								        <?php echo $p['title']; ?>
								    </h6>
								    <h6 class="col-4 text-right">
								        <span> $<?php echo $p['price'] * $p['quentaty']; ?>   &nbsp;&nbsp; S&H</span>
								    </h6>
								</div>
							<?php } ?>

                            <hr/>
                            <div class="row justify-content-center align-items-center form-group">
                                <h6 class="col-8">
                                    <!-- Free Trump $1000 Bill (Retail $15.00) -->
                                    Total
                                </h6>
                                <h6 class="col-4 text-right">
                                    <span> $<?php echo $total; ?>   &nbsp;&nbsp; S&H</span>
                                </h6>
                            </div>

                            <!-- <div class="row justify-content-center align-items-center form-group">
                                <h6 class="col-8">
                                    Free Trump $1000 Bill (Retail $15.00)
                                </h6>
                                <h6 class="col-4 text-right">
                                    <span>6.95 S&H</span>
                                </h6>
                            </div> -->

                            <!-- for card payment -->
							<span style="display: none;" id="total-price-span" data-price="<?php echo getTotal();?>"><strong>Total</strong> $<?php echo getTotal();?></span>
							<!--  -->
                        </div>

                        <?php foreach ($pre_products as $key => $p) { ?>

                            <div class="col-11 shopping_Line">
                                <div class="clearfix  prod-detail">
                                    <!--class="prod-thumb"-->
                                	<div class="txt-center">                    
                    					<img src="<?php echo $p['image']['src']; ?>" style="max-height: 275px;">
                                    </div>
                                    <!--<p>-->
                                	   <!--<?php echo $p['body_html']; ?>-->
                                    <!--</p>-->
                                    <!-- <p>
                                        <span>Put me in front of the shipping line:</span> This will give your order priority in the fulfillment center (There is a Huge online Demand for this item). Also the insurance will cover your shipment for any lost or damange without any questions.
                                    </p> -->
                                </div>
                                <div class="clearfix shopping_LineHead">
                                    <!-- <i class="fa fa-arrow-right" aria-hidden="true"></i> -->
                                    <label for="checkIt"  style="font-size: 1rem; padding: 5px;">
                                    	
                                        <input id="<?php echo $p['id']; ?>" onclick="addProduct(<?php echo $p['id']; ?>,<?php echo $p['variants'][0]['id']; ?>, 1, 7.95);" name="product[<?php echo $p['id']; ?>]" style="zoom: 1.8;" type="checkbox">
                                        <?php /*
                                        <input type="checkbox"  id="checkIt">
                                        */?>
                                        <!-- Yes! Rush & Insure my Order for $4.95 -->
                                        <b>Yes! Add a <?php echo $p['title']; ?> to my order for $<?php echo $p['variants'][0]['price']; ?></b>
                                        
                                        
                                    </label>
                                    
                                </div>
                                
                            </div>
                        <?php } ?>


                        <div class="col-12 form-group text-center">
                            <!-- <a id="payButton" href="javascript:void(0)" class="btn-green big_btn">
                            	Complete Order
                            	<input type="hidden" id="payProcess" value="0"/>
                            </a> -->

                            <button id="payButton" type="button" class="btn-green big_btn">
                            	Complete Order
                            	<!-- <input type="hidden" id="payProcess" value="0"/> -->
                            </button>
                            <span>
                                * 100% Secure & Safe Payments *
                            </span>
                        </div>
                    </form>

                </div>

            </div>

            

        </div>
    </div>
</section>


    




    <div class="modal_container ">
        <div class="modal_Inner">
            <div class="modal_Head">
                <a class="modalClose"><i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <h5>Enter Your Email Below Get Your FREE Trump Train 2020 pin</h5>
            </div>

            <div class="modal_Body">
                <div class="col">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control margin_B" placeholder="Email Address">
                        </div>
                        
                        <div class="form-group text-center">
                            <a class="big_btn btn btn-green">
                                START YOUR FREE ORDER
                                <h6>
                                    Offer is only available if the promotion is still active
                                </h6>
                            </a>
                        </div>
                    </form>
                    <span>Privacy Policy: We need your email address to send you free gear deals.</span>
                </div>
            </div>


        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/zoomImg.js" ></script>
    <script src="assets/js/custom.js" ></script>
    




    <div class="modal_container ">
        <div class="modal_Inner">
            <div class="modal_Head">
                <a class="modalClose"><i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <h5>Enter Your Email Below Get Your FREE Trump $1000 Bill</h5>
            </div>

            <div class="modal_Body">
                <div class="col">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control margin_B" placeholder="Email Address">
                        </div>
                        
                        <div class="form-group text-center">
                            <a class="big_btn btn btn-green">
                                START YOUR FREE ORDER
                                <h6>
                                    Offer is only available if the promotion is still active
                                </h6>
                            </a>
                        </div>
                    </form>
                    <span>Privacy Policy: We need your email address to send you free gear deals.</span>
                </div>
            </div>


        </div>
    </div>
    <script>
        $(document).ready(function(){


            $('.accordHead').click(function(){
                $(this).siblings('.accordBody').slideDown();
                $(this).parent('.accordItem').siblings('.accordItem').children('.accordBody').slideUp();
            });

            // Commented By Raies
                        
            // $('.GoStepTo').click(function(){
            //     alert(1);
            //     $(this).parents('.shopping_form').slideUp();
            //     $(this).parents('.shopping_form ').siblings('.yourInfo_form').slideDown();

            //     $(this).parents('.formBox').find('.col-6').toggleClass('active');
            // });




            $('.modal_Open').on('click', function(){
                // alert('i am on');
                $('.modal_container').addClass('opened');
                
                $('.mainBody').css('overflow', 'hidden');

                // var modal_Inner_height = $('.modal_Inner').height()
                // var head_height = $('.modal_Head').height();
                // var modal_Body = modal_Inner_height - (head_height + 30);

                // $('.modal_Body').css('height', modal_Body);

                // $('.modal_container').click(function(event){
                //     event.stopPropagation()
                //     alert(1);
                // });


                $('.modal_container').on('click', function(e) {
                if (e.target !== this)
                    return;
                
                // alert( 'clicked the foobar' );

                    $(this).removeClass('opened');
                    $('.mainBody').css({
                        'overflow-x' : 'hidden',
                        'overflow-y' : 'auto' 
                    });

                });

                $('.modalClose').click(function(){
                    $(this).parents('.modal_container').removeClass('opened');
                });

                $('.modal_container .btn').click(function(){
                    $(this).parents('.modal_container').removeClass('opened');
                    alert('submitted')
                });

                // alert(modal_Inner_height);

                // alert(head_height);

                // alert(modal_Body);


            });




            
        });

        $(window).on('resize', function(){
            

        } )
   
    </script>



<style type="text/css">
    .error {
  color: red;
  /*margin-left: 5px;*/
}
</style>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
    var validator =  $('form[id="form1"]').validate({
      rules: {
        first_name: 'required',
        country: 'required',
        address: 'required',
        email: {
          required: true,
          email: true,
        }
          },
      submitHandler: function(form) {
        // formSubmitFunc();
      }      
    });
</script>


    <script type="text/javascript">
// function formSubmitFunc()
{
    	$('#form1').submit(function( e ) {
    	    
    	    validator.resetForm();
            if(!validator.form()) {                         
                 return;
            }
            
			var firstName = '',  shippingAddress1 ='', shippingZip ='', shippingCity ='', shippingState ='', email ='', phone = '';

			
			firstName 		= $('input[name="first_name"]').val();
			// lastName 		= $('input[name="lastName"]').val();
			shippingAddress1 		= $('input[name="address"]').val();
			shippingZip 		= $('input[name="zip"]').val();
			shippingCity 		= $('input[name="city"]').val();
			// shippingState 			= $('#state option:selected').val();
			shippingState 			= $('input[name="state"]').val();
			email 		= $('input[name="email"]').val();
			phone 		= $('input[name="phone"]').val();


			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; 
	  		var check_status = 0;
	  		$("#custom_error_div").html('');
			if(firstName == '') {
				$("#custom_error_div").append('<li>Please enter name</li>');
				check_status = 1;
			}
			if(shippingAddress1 == '') {
				$("#custom_error_div").append('<li>Please enter address</li>');
				check_status = 1;
			}
			if(shippingZip == '') {
				$("#custom_error_div").append('<li>Please enter zipcode</li>');
				check_status = 1;
			}
			if(shippingCity == '') {
				$("#custom_error_div").append('<li>Please enter city</li>');
				check_status = 1;
			}
			if(shippingState == '') {
				$("#custom_error_div").append('<li>Please select state</li>');
				check_status = 1;
			}
			if(email == '' || !(regex.test(email))) {
				$("#custom_error_div").append('<li>Please enter correct email</li>');
				check_status = 1;
			}
			if(phone == '') {
				$("#custom_error_div").append('<li>Please enter phone</li>');
				check_status = 1;
			}
			if(check_status==1)
			{
				$("#error_handler_overlay").show();
				return false;
			}
			else
			{
			    e.preventDefault();
			    var fdata=$('#form1').serialize();
			    $.ajax({
			        type:'POST',
			        url:'core/core.php',
			        data:pdata=fdata+'&action=submit_user_info',
			        beforeSend: function() {
                      $("#loading-indicator").show();

			       },
			        success:function(msg){
			            if(msg=="success"){
			                $("#loading-indicator").hide();
			                // var url_prm=location.search;
			                // window.location.href = "checkout.php"+url_prm;

			                $(document).ready(function(){

					    		$('.GoStepTo').parents('.shopping_form').slideUp();
					            $('.GoStepTo').parents('.shopping_form ').siblings('.yourInfo_form').slideDown();
					            
					            $('.GoStepTo').parents('.formBox').find('.col-6').toggleClass('active');
					        });
			            }else{
			                $("#loading-indicator").hide();
			                // $("#loading-indicator2").html("<p>"+msg+"</p>");
			                // $("#loading-indicator2").show();
							alert(msg);



			            }
			        }
			    });
			}
		});

}

		$(document).ready(function(){
			$('#error_handler_overlay_close').click(function(){
				$("#error_handler_overlay").hide();
			});

			$("#credit_card").click(function(){
			  $("#payment_type").val("credit_card");
			});

			$("#paypal").click(function(){
			  $("#payment_type").val("paypal");
			});

			$(".back").click(function(){
				$('.GoStepTo').parents('.shopping_form').slideDown();
	            $('.GoStepTo').parents('.shopping_form ').siblings('.yourInfo_form').slideUp();
	            
	            $('.GoStepTo').parents('.formBox').find('.col-6').toggleClass('active');
			});
		});
    </script>


    <script>
	  function addProduct(id, vid, qty=1, price=0) {
	    // if (document.getElementById(id).checked)

	      var check = document.getElementById(id).checked;
	      check = (check)?check:false;
	      $.ajax({
	            type:'POST',
	            url:'core/core.php',
	            data:'action=cart_update_AJAX&product_id='+id+'&variant_id='+vid+'&checked='+check+'&qty='+qty+'&price='+price,
	            beforeSend: function() {
	              $("#loading-indicator").show();
	           },
	            success:function(data){
	              // console.log(data);
	                if(data){
	                    $("#loading-indicator").hide();                    
	                    // $("#loading-indicator2").show();
	                      $('#checkout-products').html(data);
	                }
	            }
	        });
	  }

	  function addProduct1(id, vid, qty=1, price=0) {
	    // if (document.getElementById(id).checked)

	      var check =true;
	      $.ajax({
	            type:'POST',
	            url:'core/core.php',
	            data:'action=cart_update_AJAX&product_id='+id+'&variant_id='+vid+'&checked='+check+'&qty='+qty+'&price='+price+'&product_type=Main',
	            beforeSend: function() {
	              $("#loading-indicator").show();
	           },
	            success:function(data){
	              // console.log(data);
	                if(data){
	                    $("#loading-indicator").hide();                    
	                    // $("#loading-indicator2").show();
	                      $('#checkout-products').html(data);
	                }
	            }
	        });
	  }
	</script>

	<script>
		// var handler = StripeCheckout.configure({
		//     key: '<?php echo STRIPE_PUBLISHABLE_KEY; ?>',
		//     image: 'https://www.apcompinfotech.com/public/uploads/logo.png',
		//     locale: 'auto',
		//     token: function(token) {
		//         // You can access the token ID with `token.id`.
		//         // Get the token ID to your server-side code for use.
		        
		//         $('#paymentDetails').hide();
		//         $('#payProcess').val(1);
		//         $.ajax({
		//             url: 'stripe_charge.php',
		//             type: 'POST',
		//             data: {stripeToken: token.id, stripeEmail: token.email},
		//             dataType: "json",
		//             beforeSend: function(){
		//                 $('body').prepend('<div class="overlay"></div>');
		//                // $('#payButton').prop('disabled', true);
		//                // $('#payButton').html('Please wait...');
		//             },
		//             success: function(data){
		//                 $('.overlay').remove();
		//                 $('#payProcess').val(0);
		//                 if(data.status == 1){
		//                     var paidAmount = (data.txnData.amount/100);
		// 					$('#form2').submit();
		//                 }else{
		//                     $('#payButton').html('Click hear to process your order');
		//                     alert('Payment Failed, please try again.');
		//                 }
		//             },
		//             error: function() {
		//                 $('#payProcess').val(0);
		//                 //$('#payButton').prop('disabled', false);
		//                 $('#payButton').html('Click hear to process your order');
		//                 alert('Payment Failed, please try again.');
		//             }
		//         });
		//     }
		// });

		// var stripe_closed = function(){
		//     var processing = $('#payProcess').val();
		//     if (processing == 0){
		//         //$('#payButton').prop('disabled', false);
		//         $('#payButton').html('Click hear to process your order');
		//     }
		// };

		// var eventTggr = document.getElementById('payButton');
		// if(eventTggr){
		//     eventTggr.addEventListener('click', function(e) {
		//       // $('#form2').parsley().validate();
		//       // if(!$('#form2').parsley().isValid())
		//       // {
		//       //   return false;
		//       // }
		//         //$('#payButton').prop('disabled', true);
		//         //$('#payButton').html('Please wait...');
		// 		var price= $('#total-price-span').attr('data-price');
		        
		//         // Open Checkout with further options:
		//         handler.open({
		//             name: 'Watchband',
		//             description: 'Watchband',
		//             amount: price * 100,
		//             currency: 'USD',
		//             closed:	stripe_closed
		//         });
		//         e.preventDefault();
		//     });
		// }

		// // Close Checkout on page navigation:
		// window.addEventListener('popstate', function() {
		//     handler.close();
		// });
	</script>
	
	<script>

        function radioClickFunc(value)
        {
            $("#"+value).click();
        }

      function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
         {
            return false;
         }
         return true;
      }

      function isNumberKeyWithSlash(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 47)
         {
            return false;
         }
         return true;
      }

		// Set your publishable key
		Stripe.setPublishableKey('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

		// Callback to handle the response from stripe
		function stripeResponseHandler(status, response) {
		    if (response.error) {
		        // Enable the submit button
		        $('#payButton').removeAttr("disabled");

		        $("#custom_error_div").html('<li>'+response.error.message+'</li>');
		        // Display the errors on the form
		        $("#error_handler_overlay").show();
		    } else {
		        var form$ = $("#form2");
		        // Get token id
		        var token = response.id;
		        // Insert the token into the form
		        form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
		        // Submit form to the server
		        // form$.get(0).submit();
                $("#loading-indicator").show();
		        $("#form2").submit();
		    }
		}

		$(document).ready(function() {
			$('#payButton').click(function(){
                var payment_type = $("#payment_type").val();
                if(payment_type=="paypal"){
                    $("#loading-indicator").show();
                    $("#form2").submit();
                    return false;
                }

				$('#payButton').attr("disabled", "disabled");
				
				var card_data = {
		            number: $('#card_number').val(),
		            exp_month: $('#card_exp').val().split("/")[0],
		            exp_year: $('#card_exp').val().split("/")[1],
		            cvc: $('#card_cvc').val()
		        };
		         var check_status = 0;
		  		$("#custom_error_div").html('');
				if(!Stripe.card.validateCardNumber(card_data.number)) {
					$("#custom_error_div").append('<li>Invalid card number</li>');
					check_status = 1;
				}
				if(!Stripe.card.validateExpiry(card_data.exp_month, card_data.exp_year)) {
					$("#custom_error_div").append('<li>Invalid card expiry date</li>');
					check_status = 1;
				}
				if(!Stripe.card.validateCVC(card_data.cvc)) {
					$("#custom_error_div").append('<li>Invalid CVC</li>');
					check_status = 1;
				}
				if(check_status==1)
				{
					$("#error_handler_overlay").show();
					$('#payButton').removeAttr("disabled");
					return false;
				}
				else
				{
					// Create single-use token to charge the user 
			        Stripe.createToken(card_data, stripeResponseHandler);
					
			        // Submit from callback
			        return false;
				}

			});

		    // On form submit
		  //   $("#form2").submit(function() {
		  //       // Disable the submit button to prevent repeated clicks
		  //       $('#payButton').attr("disabled", "disabled");
				
				// var card_data = {
		  //           number: $('#card_number').val(),
		  //           exp_month: $('#card_exp').val().split("/")[0],
		  //           exp_year: $('#card_exp').val().split("/")[1],
		  //           cvc: $('#card_cvc').val()
		  //       };
		  //       console.log(card_data);

		        
		        

		  //       var check_status = 0;
		  // 		$("#custom_error_div").html('');
				// if(!Stripe.card.validateCardNumber(card_data.number)) {
				// 	$("#custom_error_div").append('<li>Invalid card number</li>');
				// 	check_status = 1;
				// }
				// if(!Stripe.card.validateExpiry(card_data.exp_month, card_data.exp_year)) {
				// 	$("#custom_error_div").append('<li>Invalid card expiry date</li>');
				// 	check_status = 1;
				// }
				// if(!Stripe.card.validateCVC(card_data.cvc)) {
				// 	$("#custom_error_div").append('<li>Invalid CVC</li>');
				// 	check_status = 1;
				// }
				// if(check_status==1)
				// {
				// 	$("#error_handler_overlay").show();
				// 	return false;
				// }
				// else
				// {
				// 	// Create single-use token to charge the user 
			 //        Stripe.createToken(card_data, stripeResponseHandler);
					
			 //        // Submit from callback
			 //        return false;
				// }

		        
		  //   });
		});

</script>