<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];
		$update_quantity_cart = $ct -> update_quantity_cart($quantity,$cartId);
	}
	if(isset($_GET['cartid']) && $_GET['cartid']!=NULL){
        $cartDel = $_GET['cartid'];
		$cartDel = $ct->del_cart($cartDel);
    }
?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
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
						<th width="25%">Hinh</th>
						<th width="15%">Gia</th>
						<th width="15%">So Luong</th>
						<th width="20%">Gia tong</th>
						<th width="10%">Xoa</th>
					</tr>
					<?php
						$get_product_cart = $ct -> get_product_cart();
						$subTotal = 0;
						$total = 0;
						$gtotal = 0;
						if($get_product_cart){
							$i = 0;
							while($result = $get_product_cart -> fetch_assoc()){
								$total = $result['price'] * $result['quantity'];
								$subTotal += $total ;
								$gtotal = $subTotal * 1.1;
								$i++;
					?>
					<tr>
						<td><?php echo $i ?></td>
						<td><?php echo $result['productName'] ?></td>
						<td><img src="admin/uploads/<?php echo $result['img'] ?>" width="100%" height="auto" alt="" /></td>
						<td><?php echo number_format($result['price'])." vnd"  ?></td>
						<td>
							<form action="" method="post">
								<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" min="1"/>
								<input type="number" name="quantity" value="<?php echo $result['quantity'] ?>" min="1"/>
								<input type="submit" name="submit" value="Update"/>
							</form>
						</td>
						<td><?php echo number_format($total)." vnd"; ?></td>
						<td><a href="?cartid=<?php echo $result['cartId'] ?>">X</a></td>
					</tr>
					<?php }} ?>
					
				</table>
				<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td><?php echo number_format($subTotal)." vnd"; ?></td>
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
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="login.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include 'inc/footer.php';
?>


