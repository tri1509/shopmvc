<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
    if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
		$customer_id = Session::get('customer_id');
        $insertOrder = $ct -> insertOrder($customer_id);
		$delCart = $ct -> del_all_data_cart();
		header('Location:success.php');
    }
?>

<form action="" method="post">

	<div class="main">
		<div class="content">
			<h4>Thanh toán offline</h4>
		</div>
		<div class="clear40"></div>
		
	</div>
	
	<div class="cartpage">
		<h2>Your Cart</h2>
		<?php 
			if(isset($update_quantity_cart)){ 
				echo $update_quantity_cart ; 
			}elseif(isset($cartDel)){
				echo $cartDel;
			}else{
				echo "";
			}
		?>
		<table class="tblone">
		<tr>
			<th width="5%">STT</th>
			<th width="15%">Ten SP</th>
			<th width="15%">Gia</th>
			<th width="15%">So Luong</th>
			<th width="20%">Gia tong</th>
		</tr>
		<?php
			$get_product_cart = $ct -> get_product_cart();
			$subTotal = 0;
			$total = 0;
			$gtotal = 0;
			$qty = 0;
			if($get_product_cart){
				$i = 0;
				while($result = $get_product_cart -> fetch_assoc()){
					$total = $result['price'] * $result['quantity'];
					$qty = $qty + $result['quantity'];
					$subTotal += $total ;
					$gtotal = $subTotal * 1.1;
					$i++;
		?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo $result['productName'] ?></td>
			<td><?php echo number_format($result['price'])." vnd"  ?></td>
			<td>
				<?php echo $result['quantity'] ?>
			</td>
			<td><?php echo number_format($total)." vnd"; ?></td>
		</tr>
		<?php }} ?>
	
		</table>
		<?php
		$check_cart = $ct -> check_cart();
		if($check_cart){
		?>
		<table style="float:right;text-align:left;" width="40%">
		<tr>
			<th>Sub Total : </th>
			<td>
				<?php
					echo number_format($subTotal)." vnd"; 
					session::set('sum',$subTotal);
					session::set('qty',$qty);
				?>
			</td>
		</tr>
		<tr>
			<th>VAT : </th>
			<td>10%</td>
		</tr>
		<tr>
			<th>Grand Total :</th>
			<td><?php echo number_format($gtotal)." vnd"; ?></td>
		</tr>
		</table>
		<?php 
		}else{
			echo "<p style='text-align:center; font-size:20px; color:blue;'>Giỏ hàng có cái nịt !!!!</p>
			<p style='text-align:center; font-size:20px; color:blue;'>Làm ơn mua hàng giùm :)</p>";
		}
		?>
		</div>
		Thông tin khách hàng
		
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
		<div class="w"><a href="?orderid=order" class="submit-order">Order</a></div>
		
	</div>
</form>



<?php
	include 'inc/footer.php';
?>
<style>
	.coroi {
		font-size: 18px !important;
		color: red !important;
		font-weight: 500 !important;
	}
	.w {
		width: 100%;
		text-align:center;
	}
	.submit-order {
		padding: 30px;
		width: 200px;
		header: 100px;
		background-color: red;
		line-height:100px;
		text-align:center;
		margin: 0 auto;
		border-radius:10px;
		color:#ffff;
	}
</style>

