<?php 

    // $product = getProduct(4399115534441); 4400565223529
    $product = getProduct(4400565223529);
    // print_r($product); die();
    
    $paymet_type = $_SESSION['payment_type'];
    $card = array(); 
    $card['card_cvc']       =   (isset($_SESSION['card']))? $_SESSION['card']['cvc']       :'';
    $card['card_exp']       =   (isset($_SESSION['card']))? $_SESSION['card']['exp']       :'';
    $card['card_number']    =   (isset($_SESSION['card']))? $_SESSION['card']['number']    :'';
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
                <div  class="col-md-12">
                    <div id="error_handler_overlay" style="display: none;">
                        <div class="error_handler_body" >
                            <a href="javascript:void(0);"  id="error_handler_overlay_close">X</a>
                            <ul id="custom_error_div" style="padding: 20px; color: red;">
                            </ul>
                        </div>
                    </div>
                </div>


            <div class="col-10">
                <div class="row justify-content-center ad_Banner" style="background-image: url('assets/images/4k-Flag.png');">
                    
                    <div class="text-center">
                        <h2>
                            OK... THIS IS YOUR LAST OFFER...
                        </h2>
                        <!-- <h4>Do not hit the "Back" button as it can cause multiple charges on your card</h4> -->
                    </div>

                </div>
            </div>
            
            <div class="col-10">
                <div class="row justify-content-center">
                    <div class="col-md-9 text-center">
                        <h2 class="BigTxt txt_primary margin_B">
                            <!-- Get The 5 Pack Gold $1000 Bill Bundle Now For 75% OFF (And Add it To Your Shipment) -->
                            Get The Trump hair hat Now For 50% OFF (And Add it To Your Shipment)
                        </h2>
                    </div>
                    <div class="col-md-11 text-center markingHigh margin_B">
                        <h4>
                            Incredible deal! <br>
                            Share the Bills with your friends and family.
                        </h4>
                    </div>

                    <div class="col-md-9">
                        <div class="row justify-content-around align-items-center  margin_B">
                            <div class="col-sm-9 col-md-5 upSell_ProductBox">
                                <img id="pi" src="<?php echo $product['image']['src']; ?>" alt="" class="img-fluid upSell_Product">
                            </div>
                            <div class="col-sm-9 col-md-6">
                                

                                <form id="form2" class="swatch_view_form" action="core/core.php" method="POST">
                                    <input type="hidden" name="action" value="upsell2-submit">
                                    <input id="payment_type" type="hidden" name="payment_type" value="<?php echo($paymet_type); ?>">
                                    <input id="variants" type="hidden" value="<?php echo $product['variants'][0]['id']; ?>" name="post_upsell[]">

                                    <?php foreach ($product['options'] as $option) { ?>
                                        <?php if($option['name']=='color' || $option['name']=='Color') { ?>
                                        <div class="form-group">
                                        <h4>Options</h4>
                                            <ul class="swatch-view-part">
                                                <?php foreach ($option['values'] as $key => $value) { 
                                                    if($key==0){
                                                        $active = 'active';
                                                        $src = "https://cdn.shopify.com/s/files/1/0263/9111/7929/products/Webp.net-resizeimage_36.jpg?v=1574919821";
                                                    }elseif($key==1){
                                                        $active = '';
                                                        $src = "https://cdn.shopify.com/s/files/1/0263/9111/7929/products/Webp.net-resizeimage_45.jpg?v=1574921132";
                                                    }elseif($key==2){
                                                        $active = '';
                                                        $src = "https://cdn.shopify.com/s/files/1/0263/9111/7929/products/Webp.net-resizeimage_41.jpg?v=1574920588";
                                                    } else{
                                                        $active = '';
                                                        $src = "https://cdn.shopify.com/s/files/1/0263/9111/7929/products/Webp.net-resizeimage_36.jpg?v=1574919821";
                                                    }
                                                ?>
                                                    <li class="swatch-view-item-part <?php echo $active; ?>">
                                                        <label for="option<?php echo $key; ?>">
                                                            <input id="option<?php echo $key; ?>" type="radio" name="swatch_views"  value="<?php echo $value; ?>" on-click="productOptionSelect(<?php echo $value; ?>, <?php echo $product['id']?>)" data-pid="<?php echo $product['id']?>">
                                                            <img src="<?php echo $src; ?>">
                                                        </label>
                                                            <p><?php echo $value; ?></p>
                                                        

                                                    </li>
                                                <?php } ?>
                                                    <!-- <li class="swatch-view-item-part">
                                                        <label for="option2">
                                                            <input id="option2" type="radio" name="swatch_views">
                                                            <img src="https://cdn.shopify.com/s/files/1/0263/9111/7929/products/Webp.net-resizeimage_41_110x110@2x.jpg?v=1574920588">
                                                        </label>
                                                        <p>Gray</p>
                                                    </li>
                                                    <li class="swatch-view-item-part">
                                                        <label for="option3">
                                                            <input id="option3" type="radio" name="swatch_views">
                                                            <img src="https://cdn.shopify.com/s/files/1/0263/9111/7929/products/Webp.net-resizeimage_45_110x110@2x.jpg?v=1574921132">
                                                        </label>
                                                        <p>Black</p>
                                                    </li> -->
                                                </ul>

                                            <!--<label for="exampleFormControlSelect2">Options</label>
                                            <select name="<?php echo($option['name']); ?>" class="form-control" id="exampleFormControlSelect2" onchange="productOptionSelect(this.value, <?php echo $product['id']?>)">
                                            <?php foreach ($option['values'] as $key => $value) { ?>
                                                <option><?php echo $value; ?></option>
                                            <?php } ?>
                                            </select>-->
                                        </div>
                                    <?php } ?>
                                    <?php } ?>

                                    <script>
                                        $('input[type=radio][name=swatch_views]').change(function() {
                                            // alert(this.value);
                                            $("#loading-indicator").show();
                                            $.post("<?php echo BASE_URL.'/core/core.php'; ?>",{action: "variants", option:{key:'color', value:this.value}, product_id:<?php echo $product['id']?>},
                                                function(data, status){
                                                    // alert("Data: " + data + "\nStatus: " + status);
                                                    var data = JSON.parse(data);
                                                    console.log((data));
                                                    $('#pi').attr('src',data.src);
                                                    $("#variants").val(data.variant);

                                                    $("#loading-indicator").hide();
                                            });
                                        });
                                    // function productOptionSelect(val, pid) {
                                    //     // alert(val);
                                    //   // var x = document.getElementById("mySelect").value;
                                    //   // document.getElementById("demo").innerHTML = "You selected: " + x;

                                    //     $("#loading-indicator").show();
                                    //       $.post("<?php echo BASE_URL.'/core/core.php'; ?>",{action: "variants", option:{key:'color', value:val}, product_id:pid},
                                    //           function(data, status){
                                    //             // alert("Data: " + data + "\nStatus: " + status);
                                    //             var data = JSON.parse(data);
                                    //             console.log((data));
                                    //             $('#pi').attr('src',data.src);
                                    //             $("#variants").val(data.variant);

                                    //             $("#loading-indicator").hide();
                                    //           }
                                    //       );
                                    // }
                                    </script>

                                    <input id="card_number" type="hidden" class="form-control" value="<?php echo $card['card_number']; ?>" placeholder="Card Number">
                                    <input id="card_exp" type="hidden" class="form-control" value="<?php echo $card['card_exp']; ?>" placeholder="MM/YY">
                                    <input id="card_cvc" type="hidden" class="form-control" value="<?php echo $card['card_cvc']; ?>" placeholder="CVC">

                                    <input type="hidden" name="payment_type" value="<?php echo $_SESSION['payment_type']; ?>">

                                    <button id="payButton" type="button"  class="btn upSell_Btn">
                                        Yes! Add this Trump hair hat Now to my shipment today for $14.95
                                        <span class="">Because the 50% Discount is activated for next 5 mins....</span>
                                    </button>
                                </form>

                                <a href="core/core.php?action=upsell2-skip" class="dontNeed_Btn">I Don't Need This Right Now</a>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <img src="assets/images/credit-only.png" class="credit_only"/>
                        </div>
                        
                    </div>


                </div>
            </div>

        </section>

                <script>
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

                console.log(token);
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
        });
    </script>
    <script>
$(document).ready(function(){
	$('.swatch-view-part li').on('click', function(){
		$(".swatch-view-part li").removeClass("active");	
	$(this).toggleClass('active');
	});
});
</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>