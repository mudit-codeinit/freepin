<?php 
	$_REQUEST["page"] = "shipping";
  	require __DIR__ . '/core/core.php';

  	// echo "<pre>"; print_r($_SESSION['order_info']); die();
  	// echo "<pre>"; print_r($_SESSION['shipping_info']); die();
?>


<?php include "./includes/header.php";    ?>
<?php include "./includes/nav.php";       ?>
<?php include "./includes/side-bar.php";  ?>

<?php include "./views/".$_VIEW.".php"; ?>

<?php include "./includes/footer.php";    ?>