<?php
	include 'inc/header.php';
	include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading"><h3>Feature Products</h3></div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
			<?php
				$product_feathered = $product -> getproduct_feathered();
				if($product_feathered) {
					while ($result = $product_feathered ->fetch_assoc()) {
						
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['img'] ?>" alt="" width='100%' /></a>
					<h2><?php echo $result['productName'] ?></h2>
					<p><?php echo $fm -> textShorten($result['product_desc'],50) ?></p>
					<p><span class="price"><?php echo number_format($result['price'])." đ" ?></span></p>
					<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php }}?>
		</div>
			<div class="content_bottom">
			<div class="heading">
			<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>	
		<div class="section group">
			<?php
				$product_new = $product -> getproduct_new();
				if($product_new) {
					while ($result_new = $product_new ->fetch_assoc()) {
						
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proid=<?php echo $result_new['productId'] ?>"><img src="admin/uploads/<?php echo $result_new['img'] ?>" alt="" width='100%' /></a>
					<h2><?php echo $result_new['productName'] ?></h2>
					<p><?php echo $fm -> textShorten($result_new['product_desc'],50) ?></p>
					<p><span class="price"><?php echo number_format($result_new['price'])." đ" ?></span></p>
					<div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php }} ?>
		</div>
	</div>
</div>
 <?php 
 include 'inc/footer.php';
 ?>
 

 <!-- 
	git remote add origin https://github.com/tri1509/shopmvc.git
	git branch -M main
	git push -u origin main
  -->

