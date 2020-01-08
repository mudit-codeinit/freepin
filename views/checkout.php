
<?php 
  // echo "<pre>"; print_r($_SESSION['cart']);  echo "</pre>";

  $cart_array = (isset($_SESSION['cart']))?$_SESSION['cart']:false;

  if(!$cart_array){
    header("location: index.php");
  }

  $shipping  = 0;
  $total  = getTotal();
  $grand_total = $total + $shipping;

  $bill_info = $_SESSION['bill_info'];

  $pre_upsell_products = getProducts("pre_upsell");
  // echo "<pre>"; print_r($pre_upsell_products);die();
?>

<div class="checkout-page-section">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="checkout-header">
          <img src="assets/images/checkout-steps.png">
        </div>
        <div class="checkout-product-info">
          <div class="checkout-info">
            <div class="checkout-info-title">Contact</div>
              <div class="checkout-info-disc"><?php echo $bill_info['email']; ?></div>
          </div>
          
          <div class="checkout-info">
            <div class="checkout-info-title">Ship to</div>
            <div class="checkout-info-disc">
              <?php echo $bill_info['first_name']; ?> <?php echo $bill_info['last_name']; ?>, <?php echo $bill_info['city']; ?>, <?php echo $bill_info['apartment']; ?>, <?php echo $bill_info['state']; ?>, <?php echo $bill_info['pincode']; ?> </div>
          </div>
          
          <div class="checkout-info">
            <div class="checkout-info-title">Method</div>
            <div class="checkout-info-disc">
              <div class="control-group">
                <label class="control control-radio">Free USPS 1st Class : $0.00
                  <input type="radio" name="free class" checked="checked"/>
                  <div class="control_indicator"></div>
                </label>
              </div>
            </div>
          </div>
        </div>

        <form action="core/core.php?action=place_order" method="POST">
          <input type="hidden" name="action" value="place_order">
          <div class="payment-method">
            <!-- Payment Methoad -->
            <h2>Payment Method</h2>
            <span>All Transection are secure and encrypted</span>
            <div class="card-type">
              <img src="assets/images/card-type.png">
            </div>
            <div class="make-payment">
              
                <div class="row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Credit Card Number" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Account Holder Name" required="">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group">
                      <input type="date" class="form-control" placeholder="MM/YY" required="">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="CVV" required="">
                      <i class="fas fa-question-circle"></i>
                    </div>
                  </div>
                </div>              
            </div>

            <!-- Billing Address -->
            <div class="billing-address-part">
              <h2>Billing Address</h2>

              <div class="billing-address-type">
                <div class="control-group">
                  <label class="control control-radio">Same as shipping address
                    <input type="radio" name="same_address" value="true" checked="checked" onclick="show1();"/>
                    <div class="control_indicator"></div>
                  </label>
                </div>
                
                <div class="control-group">
                  <label class="control control-radio">Use a different billing address 
                    <input type="radio" name="same_address" value="false" onclick="show2();"/>
                    <div class="control_indicator"></div>
                  </label>
                </div>
              </div>
              <div id="div1" class="hide billing-address">
                
                  <div class="row">                 
                    <div class="col-md-6">
                      <div class="input-group">
                        <input type="text" name="bill[first_name]"  class="form-control" placeholder="Billing First Name">
                      </div>
                    </div>                  
                    <div class="col-md-6">
                      <div class="input-group">
                        <input type="text" name="bill[last_name]" class="form-control" placeholder="Billing Last Name">
                      </div>
                    </div>                
                    <div class="col-md-12">
                      <div class="input-group">
                        <input name="bill[address]" type="text" class="form-control" placeholder="Billing Address">
                      </div>
                    </div>                
                    <div class="col-md-12">
                      <div class="input-group">
                        <textarea name="bill[apartment]" type="text" class="form-control" rows="3" placeholder="Apartment (Optional)"></textarea>
                      </div>
                    </div>                
                    <div class="col-md-12">
                      <div class="input-group">
                        <input name="bill[city]" type="text" class="form-control" placeholder="Billing City">
                      </div>
                    </div>                  
                    <div class="col-md-4">
                      <div class="select">
                        <select name="bill[country]">
                          <option value="">Select Country</option>
                          <option value="US" >United States</option>
                        </select>
                        <div class="select_arrow"></div>
                      </div>
                    </div>                  
                    <div class="col-md-4">
                      <div class="select">
                        <select name="bill[state]" >
                                        <option value="" selected="selected">Select State</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AS">American Samoa</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="AE">Armed Forces Middle East</option>
                                        <option value="AA">Armed Forces Americas</option>
                                        <option value="AP">Armed Forces Pacific</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District of Columbia</option>
                                        <option value="FM">Federated States of Micronesia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="GU">Guam</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="MP">Northern Mariana Islands</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="PR">Puerto Rico</option>
                                        <option value="MH">Republic of Marshall Islands</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VI">Virgin Islands of the U.S.</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                        </select>
                        <div class="select_arrow"></div>
                      </div>
                    </div>               

                    <div class="col-md-4">
                      <div class="input-group">
                        <input name="bill[pin_code]" type="text" class="form-control" placeholder="Postal Code">
                      </div>
                    </div>
                  </div>                
              </div>

              <div class="row">
                <div class="col-md-6">
                  <a href="shipping.php" class="btn btn-block ">Return to customer information</a>
                </div>
                <div class="col-md-6">
                  <button type="submit" class="btn btn-block order-now-btn">
                    <!-- COMPLETE ORDER -->
                    Click hear to process your order
                  </button>
                </div>                
              </div>              
            </div>

            <div class="security-part">
              <img src="assets/images/security.png">
            </div>
          </div>
        </form>
      </div>
      
      <div class="col-md-4">
        <div class="checkout-aside">
          <div id="checkout-products" class="checkout-products">
            <ul>
              <?php foreach ($cart_array as $key => $p) { ?>
                <li>
                  <a href="">
                    <div class="checkout-product-img">
                      <img src="<?php echo $p['src']; ?>">
                      <span class="product-count"><?php echo $p['quentaty']; ?></span>
                    </div>
                    <div class="checkout-product-disc">
                      <h4><?php echo $p['title']; ?> </h4>
                      <span>$<?php echo $p['price']; ?></span>
                    </div>
                  </a>
                </li>
              <?php } ?>
            </ul>
            <div class="products-totaling">             
              <span>
                <strong>Subtotal</strong> $<?php echo $total; ?>
              </span>           
              <span><strong>Shipping</strong> $<?php echo $shipping; ?></span>
            </div>
            <div class="products-tota-price">                             
              <span class="total-price"><strong>Total</strong> $<?php echo $grand_total; ?></span>
            </div>
          </div>

          <?php if(!empty($pre_upsell_products) && isset($pre_upsell_products)) { ?>
            <div class="aditional-products">
              <h3>Would you like to add these additional Beard Care products to your cart ?</h3>

              <?php foreach ($pre_upsell_products as $key => $p) { ?>
              <div class="single-aditional-product">
                <label class="control control-checkbox">Yes i want a <?php echo $p['title']; ?> $<?php echo $p['variants'][0]['price']; ?>
                  <input id="<?php echo $p['id']; ?>" onclick="addProduct(<?php echo $p['id']; ?>,<?php echo $p['variants'][0]['id']; ?>);" name="product[<?php echo $p['id']; ?>]" type="checkbox"/>
                  <div class="control_indicator"></div>
                </label>

                <div class="aditional-product-img">
                  <img src="<?php echo $p['image']['src']; ?>">
                </div>

                <div class="aditional-product-disc">
                  <p><?php echo $p['body_html']; ?></p>
                </div>
              </div>
              <?php } ?>
              
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  function show1(){
    document.getElementById('div1').style.display ='none';
  }
  function show2(){
    document.getElementById('div1').style.display = 'block';
  }

  function addProduct(id, vid) {
    // if (document.getElementById(id).checked)

      var check = document.getElementById(id).checked;
      check = (check)?check:false;
      $.ajax({
            type:'POST',
            url:'core/core.php',
            data:'action=cart_update_AJAX&product_id='+id+'&variant_id='+vid+'&checked='+check,
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

