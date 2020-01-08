<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.theme.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href="https://fonts.googleapis.com/css?family=Archivo+Black|Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Patua+One&display=swap" rel="stylesheet"> 
    <?php if($_VIEW=="home"){ ?>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <?php } ?>

    <?php if($_VIEW=="shipping" || $_VIEW=="upsell" || $_VIEW=="upsell2"|| $_VIEW=="upsell3"){ ?>
    
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="0 crossorigin="anonymous"></script>
    <?php } ?>

    <script src="https://kit.fontawesome.com/5435820dec.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/css/jquerysctipttop.css">
<link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- payment -->
    <!-- <script src="https://checkout.stripe.com/checkout.js"></script> -->

    <!-- Stripe JavaScript library -->
    <script src="https://js.stripe.com/v2/"></script>

    <title>Trump Train 2020 Pin </title>

  </head>
  <body>

    <body>
    
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center topBar">
            <div class="justify-content-center align-items-center">
                <!--<img src="assets/images/usa-american-flag-gif-3.gif" class="Flag" />-->
                <?php if($_VIEW=="home" ||$_VIEW=="shipping" || $_VIEW=="upsell" || $_VIEW=="upsell2"|| $_VIEW=="upsell3"){ ?>
				<img src="assets/images/logo.jpg" class="Flag" />
                <?php }else{ ?>
                    <a href="<?php echo(BASE_URL); ?>"><img src="assets/images/logo.jpg" class="Flag" /></a>
                <?php } ?>

                <?php if($_VIEW=="home" || $_VIEW=="shipping"){ ?>
                    <h2 class="">claim yours now!</h2>
                <?php } else { ?>
                    <!--<h2 class=""><?php echo $_VIEW; ?></h2>-->
                <?php } ?>
            </div>
        </div>
    </div>


    <div class="container-fluid mainBody">