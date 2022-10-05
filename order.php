
<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
 	$login_check = Session::get('customer_login');
	if($login_check ==false) {
		header('Location:login.php');
	}
?>
<?php

?>

<div class="main">
    <div class="content">
		<div class="content-top">
			<div class="heading">
				<h3>Thanh toan</h3>
				<a href="online.php">online</a>
				<a href="offline.php">offline</a>
			</div>
		</div>
		<div class="clear40"></div>
		<table class="tblone">
				<tr>
					<td>Name</td>
					<td>:</td>
					<td></td>
				</tr>

		</table>
	</div>
</div>
<?php
	include 'inc/footer.php';
?>



