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

<div class="main">
    <div class="content">
		<div class="content-top">
			<div class="heading">
				<h3>Thông tin khách hàng</h3>
			</div>
		</div>
		<div class="clear40"></div>
		<table class="tblone">
			<?php
			$id = Session::get('customer_id');
				$get_customer = $cs -> show_customer($id);
				if($get_customer) {
					while($result = $get_customer -> fetch_assoc()){
			?>
				<tr>
					<td>Name</td>
					<td>:</td>
					<td><?php echo $result['ten'] ?></td>
				</tr>
				<tr>
					<td>City</td>
					<td>:</td>
					<td><?php echo $result['city'] ?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>:</td>
					<td><?php echo $result['phone'] ?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>:</td>
					<td><?php echo $result['country'] ?></td>
				</tr>
				<tr>
					<td>zipcode</td>
					<td>:</td>
					<td><?php echo $result['zipcode'] ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><?php echo $result['email'] ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td>:</td>
					<td><?php echo $result['diachi'] ?></td>
				</tr>
				<tr>
					<td colspan="3"><a href="editprofile.php">Chỉnh sửa</a></td>
				</tr>

			<?php }} ?>
		</table>
	</div>
</div>
<?php
	include 'inc/footer.php';
?>


