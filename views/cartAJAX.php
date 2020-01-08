<?php 
  $cart_array = (isset($_SESSION['cart']))?$_SESSION['cart']:[];
  // $shipping  = 0;
  // $total  = getTotal();
  // $grand_total = $total + $shipping;

  $total = 0;
  foreach ($cart_array as $key => $p) {
    $total = $total+($p['price']*$p['quentaty']);
  }
?>

<?php /*
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
*/ ?>


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
<hr>
<div class="row justify-content-center align-items-center form-group">
    <h6 class="col-8">
        <!-- Free Trump $1000 Bill (Retail $15.00) -->
        Total
    </h6>
    <h6 class="col-4 text-right">
        <span> $<?php echo $total; ?>   &nbsp;&nbsp; S&H</span>
    </h6>
</div>