<?php 
	$_REQUEST["page"] = "product";
  	require __DIR__ . '/core/core.php';
?>

<?php include "./includes/header.php";    ?>
<?php include "./includes/nav.php";       ?>
<?php include "./includes/side-bar.php";  ?>

<?php 
  
  include "./views/".$_VIEW.".php";  

?>

<?php include "./includes/footer.php";    ?>