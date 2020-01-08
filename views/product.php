<?php 
	if (isset($_REQUEST['product_id'])) {
		$product = getProduct($_REQUEST['product_id']);
		die;

		// echo getVariationByProduct($product, ['Size'=>"38mm", 'Series'=>2]);
?>

		<!-- Final -->
		<div class="product-detail-disc">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<div class="product-details-large" id="ProductPhoto">
							<img id="ProductPhotoImg" class="product-zoom" data-image-id="" alt="<?php echo $product['image']['alt']; ?>" data-zoom-image="<?php echo $product['image']['src']; ?>" src="<?php echo $product['image']['src']; ?>">

						</div>
						<div class="thumnails-center">
							<div id="ProductThumbs" class="product-thumbnail owl-carousel">
								<a class="product-single__thumbnail active" href="#" data-image="<?php echo $product['image']['src']; ?>" data-image-id="<?php echo $product['image']['id']; ?>">
								<img src="<?php echo $product['image']['src']; ?>" alt="<?php echo $product['image']['alt']; ?>"></a>

								<?php foreach ($product['images'] as $image_obj) { ?>
									<a class="product-single__thumbnail " href="#" 
									data-image="<?php echo $image_obj['src']; ?>" data-zoom-image="<?php echo $image_obj['src']; ?>" data-image-id="<?php echo $image_obj['id']; ?>">
									<img src="<?php echo $image_obj['src']; ?>" alt="<?php echo $image_obj['alt']; ?>"></a>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<form action="./core/core.php?action=buy-now" method="post">
							<input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
							<div class="product-disc-part part-2">
								<!-- <div class="color-boxes">
									<ul>
										<li class=""><label for="color1" class="pomegranate-color"><input type="radio" id="color1" name="product-color"></label></li>
										<li><label for="color2" class="beryl-color"><input type="radio" id="color2" name="product-color"></label></li>
										<li><label for="color3" class="khaki-color"><input type="radio" id="color3" name="product-color"></label></li>
										<li><label for="color4" class="lemon-cream-color"><input type="radio" id="color4" name="product-color"></label></li>
										<li><label for="color5" class="clementine-color"><input type="radio" id="color5" name="product-color"></label></li>
										<li><label for="color6" class="pine-green-color"><input type="radio" id="color6" name="product-color"></label></li>
										<li><label for="color7" class="alaskan-blue-color"><input type="radio" id="color7" name="product-color"></label></li>
										<li><label for="color8" class="stone-color"><input type="radio" id="color8" name="product-color"></label></li>
										<li><label for="color9" class="pink-sand-color"><input type="radio" id="color9" name="product-color"></label></li>
										<li><label for="color10" class="white-color"><input type="radio" id="color10" name="product-color"></label></li>
										<li><label for="color11" class="black-color"><input type="radio" id="color11" name="product-color"></label></li>
									</ul>
								</div> -->
									<div class="product-disc-2-detail">
										<h3><?php echo $product['title']; ?></h3>	
										<div class="product-reviews-ratting">
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star"></span>
											<p>(8 customer reviews)</p>
										</div>
										
										<div class="product-colors">
											<div class="color-name-result">Choose color</div>
											<div class="color-boxes horizontal">								
												<ul>
													<li class="">
														<label for="color1" class="pomegranate-color"><input type="radio" id="color1" name="product-color"></label>
													</li>
													<li><label for="color2" class="beryl-color">
														<input type="radio" id="color2" name="product-color"></label>
													</li>
													<li>
														<label for="color3" class="khaki-color">
															<input type="radio" id="color3" name="product-color"></label>
													</li>
													<li><label for="color4" class="lemon-cream-color"><input type="radio" id="color4" name="product-color"></label></li>
													<li><label for="color5" class="clementine-color"><input type="radio" id="color5" name="product-color"></label></li>
													<li><label for="color6" class="pine-green-color"><input type="radio" id="color6" name="product-color"></label></li>
													<li><label for="color7" class="alaskan-blue-color"><input type="radio" id="color7" name="product-color"></label></li>
													<li><label for="color8" class="stone-color"><input type="radio" id="color8" name="product-color"></label></li>
													<li><label for="color9" class="pink-sand-color"><input type="radio" id="color9" name="product-color"></label></li>
													<li><label for="color10" class="white-color"><input type="radio" id="color10" name="product-color"></label></li>
													<li><label for="color11" class="black-color"><input type="radio" id="color11" name="product-color"></label></li>
												</ul>
											</div>
										</div>



								<div class="product-size">
									<?php  foreach ($product['options'] as $key => $option) { ?>
										<?php if(strtolower($option['name'])=='color'){ ?>

										<?php }elseif (strtolower($option['name'])=='size' || strtolower($option['name'])=='series') { ?>

										
											<div class="choose-size">
												<span><?php echo $option['name']; ?></span>
												<!-- <div class="select">
													<select>
														<option>Select Case Size</option>
														<option>40mm</option>
														<option>42mm</option>
														<option>44mm</option>
														<option>46mm</option>
													</select>
													<div class="select_arrow"></div>
												</div> -->

												<?php $j=0; foreach ($option['values'] as $key => $value) { $j++; ?>
												
													<button id="<?php echo $j; ?>" class="<?php echo ($j==1)?'active':''; ?>"  type="button" title="" ><?php echo $value; ?> 
														<label for="case-<?php echo strtolower($option['name']).$j; ?>">
															<input type="radio" id="<?php echo strtolower($option['name']).$j; ?>" value="<?php echo $value; ?>" name="variants[<?php echo $option['name']; ?>]" <?php echo ($j==1)?'checked':''; ?>>
														</label>
													</button>
												<?php } ?>
											</div>
										<?php } else { ?>

											<div class="select">
												<select name="variants[<?php echo $option['name']; ?>]">
													<option>Select <?php echo $option['name']; ?></option>
													<?php $j=0; foreach ($option['values'] as $key => $value) { $j++; ?>
														<option value="<?php echo $value; ?>"><?php echo $value; ?></option>
													<?php } ?>
												</select>
												<div class="select_arrow"></div>
											</div>
										<?php } ?>
									<?php }  ?>
										<!-- 
										<div class="choose-size">
											<span>Case Series</span>
											<button type="submit" name="" value="" title="">1 
												<label for="case-series1"><input type="radio" id="case-series1" name="case-size"></label>
											</button>
											<button type="submit" name="" value="" title="">2 
												<label for="case-series2"><input type="radio" id="case-series2" name="case-size"></label>
											</button>
											<button type="submit" name="" value="" title="">3 
												<label for="case-series3"><input type="radio" id="case-series3" name="case-size"></label>
											</button>
											<button type="submit" name="" value="" title="">4 
												<label for="case-series4"><input type="radio" id="case-series4" name="case-size"></label>
											</button>
											<button type="submit" name="" value="" title="">5
												<label for="case-series5"><input type="radio" id="case-series5" name="case-size"></label>
											</button>
										</div> -->

									</div>
										<div class="product-price">
											<span>
												<small><del>$ <?php echo $product['variants'][0]['compare_at_price']; ?></del></small> 
												$ <?php echo $product['variants'][0]['price']; ?> USD
											</span>
										</div>
										<div class="free-shipping">
											<ul>
												<li><i class="fas fa-truck"></i> FREE Worldwide Shipping</li>
												<li><i class="fas fa-undo"></i> FREE Worldwide Shipping</li>
											</ul>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-10 offset-md-1">
								<div class="row">		 
									<div class="col-md-6">			
										<div class="refund-and-payment">
											<h5>60 Day Guarantee</h5>
											<p>If yo are unhappy for any reason, we will refund your payment. <strong>No Question Asked!</strong></p>
										</div>
									</div>		 
									<div class="col-md-6">		
										<div class="refund-and-payment">
											<h5>Secure order form - 100% protected & Safe</h5>
											<img src="assets/images/payment-method.png">
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-8 offset-md-2">					
								<div class="add-to-cart-btn">
									<button type="submit"  name="add-to-cart" value="add-to-cart" title="Add to Cart">
										CLICK HERE TO ORDER
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End -->


<?php } else{ ?>

	<!-- First Container -->
	<div class="bg-1 text-center ">
	  <h3 class="margin">404</h3>
	  <!-- <img src="assets/img/banner1.jpg" class="img-responsive" style="display:inline;" alt="Bird"> -->
	  <h3>Product not found!</h3>
	</div>
<?php }  ?>



