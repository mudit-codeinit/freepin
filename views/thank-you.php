<?php 
	// session_destroy();

    $order_info = (isset($_SESSION['order_info']))?$_SESSION['order_info']:[];
    // print_r($order_info ); die();

    $products = getProducts("Main");

/*echo "<pre>";print_r($products);
die();*/
    $product = $products[0];

    if(isset($order_info['total_price']) && !empty($order_info['total_price'])){
        $total =  $order_info['total_price'];
    }

    if(isset($_SESSION['postupsell_order_update_info_1']) && !empty($_SESSION['postupsell_order_update_info_1'])){
        $total =  $total + $_SESSION['postupsell_order_update_info_1']['total_price'];
    }

    if(isset($_SESSION['postupsell_order_update_info_2']) && !empty($_SESSION['postupsell_order_update_info_2'])){
        $total =  $total + $_SESSION['postupsell_order_update_info_2']['total_price'];
    }

    if(isset($_SESSION['postupsell_order_update_info_3']) && !empty($_SESSION['postupsell_order_update_info_3'])){
        $total =  $total + $_SESSION['postupsell_order_update_info_3']['total_price'];
    }
?>


 <section class="row justify-content-center trumpBgGray">

    <div class="col-sm-3 col-xs-4">
        <img src="<?php if(isset($products[0]['image']['src'])){ echo $products[0]['image']['src']; } ?>" alt="" class="img-fluid">
        <!-- <img src="assets/images/smartTrump.png" alt="" class="img-fluid"> -->
    </div>

    <div class="col-sm-5 col-xs-8">

        <div class="row justify-content-center" >
            <div class="col-12">
                <div class="success_box margin_B">
                    <img src="assets/images/happystate.gif" class="success" style="margin-left: 15px;">
                    <style>
                        .trumpBgGray{
                            background-color: #eceff1;
                        }
                        .success{
                                    width: 80px;
                                    height: auto;
                                }
                    </style>
                </div>
            
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-9 margin_B">
                        <h2 class=" txt_primary">
                            Thank You
                        </h2>
                        <h5>For Purchasing <span>Product Name</span>.</h5>
                    </div>
                    <div class="col-md-9">
                        <P  class="smallTxt">
                            We hpe You enjoy the product with in 3-5 business days.
                        </P>
                        <p class="smallTxt">
                            You will receive an email receipt containing this information for your records.
                        </p>
                        <p  class="smallTxt">
                            Please dont't hesitate to call our customer support if you requir assistance. Our agents will be more than glad to assist you 24 hours a day!
                        </p>
                        <h5 class="margin_B">
                          Customer Support: (888)000-0000(us)
                        </h5>

                        <?php if (isset($order_info) && !empty(($order_info))) {?>
                        <div class="clearfix order_Details margin_B">

                            <h4>
                                ORDER DETAILS
                            </h4>
                            <p>
                                Order Number: <?php echo ($order_info["id"]); ?>
                            </p>
                            <p>
                                OrderPlaced: <?php echo date("M d, Y",strtotime($order_info["created_at"])); ?>
                            </p>
                            <p>
                                Subtotal: $ <?php echo $total;//($order_info["total_price"]); ?>
                            </p>
                            <p>
                                TOTAL:  $ <?php echo $total;//($order_info["total_price"]); ?>
                            </p>

                        </div>
                    <?php } ?>
                        
                        <!-- <a class="btn-green big_btn">Back To Home Page</a> -->
                        <center>
                            <a href="https://www.facebook.com/StillMyPresidentUSA" target="_blank" type="button" class="btn btn-primary"><img src="assets/images/facebook.png" alt="" class="social-img"></a>
                            <a href="https://www.instagram.com/StillMyPresidentUSA"  type="button"  target="_blank" class="btn btn-secondary"><img src="assets/images/instagram.png" alt="" class="social-img"></a>
                            <a href="https://stillmypresident.com/"  type="button" class="btn btn-success"><img src="assets/images/website.png" alt="" class="social-img"></a>
                        </center>
                    </div>

                    <style>

                    .success_box {
                        position: absolute;
                        top: 100px;
                        left: -25px;
                    }
                    
                    .smallTxt{
                        font-size: 11px;
                        color: rgb(117, 117, 117);
                    }

                    .order_Details {
                        padding: 30px;
                        background-color: #031861;
                        color: #fff;
                        border-radius: 8px;
                        font-size: 14px;
                    }
                    .order_Details h4{
                        padding-bottom: 10px;
                        margin-bottom: 20px;
                        border-bottom: solid 1px #ccc;
                    }
                    .social-img
                    {
                        height: 50px;
                        width: 50px;
                    }
                    </style>

                </div>
            </div>
        </div>
    </div>
    
</section>

<!-- m -->

<?php /*
<section class="row justify-content-center">
    <div class="col-10">
        <div class="row justify-content-center" >
            
            <div class="text-center">
                <img src="assets/images/happystateF.gif" class="success">
            </div>

            <style>
                .success{
                            width: 150px;
                            height: auto;
                        }
            </style>

        </div>
    </div>
    
    <div class="col-10">
        <div class="row justify-content-center">
            <div class="col-md-9 text-center margin_B">
                <h2 class="BigTxt txt_primary">
                    Thank You
                </h2>
                <h5>For Purchasing <span><?php echo (isset($product['title']))?$product['title']:''; ?></span>.</h5>
            </div>
            <div class="col-md-11 text-center">
                <!-- <a class="btn-green big_btn">Back To Home Page</a> -->
            </div>

            <center>
				<a href="https://www.facebook.com/StillMyPresidentUSA" target="_blank" type="button" class="btn btn-primary">F</a>
				<a href="https://www.instagram.com/StillMyPresidentUSA"  type="button"  target="_blank" class="btn btn-secondary">Instagram</a>
				<a href="https://stillmypresident.com/"  type="button" class="btn btn-success">Website</a>
			</center>


        </div>
    </div>

</section>
*/
?>