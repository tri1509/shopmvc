<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	if(isset($_GET['catid']) && $_GET['catid']!=NULL){
		$id = $_GET['catid'];
	}
	
	// if($_SERVER['REQUEST_METHOD'] === 'POST') {
	// 	$catName = $_POST['catName'];
	// 	$addtoCart = $ct -> add_to_cart($quantity,$id);
	// }
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
		<?php
			$namebycat = $cat -> get_name_by_cat($id);
			if($namebycat) {
			$result_name = $namebycat -> fetch_assoc();
		?>
    		<div class="heading"><h3>Danh mục : <?php echo $result_name['catName'] ?> </h3></div>
		<?php } ?>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  	<?php
				$productbycat = $cat -> get_product_by_cat($id);
				if($productbycat) {
					while($result = $productbycat -> fetch_assoc()) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="preview-3.php"><img src="admin/uploads/<?php echo $result['img'] ?>" alt="" /></a>
					<h2><?php echo $result['productName'] ?></h2>
					<p><?php echo $fm -> textShorten($result['product_desc'],50) ?></p>
					<p><span class="price"><?php echo number_format($result['price'])." đ" ?></span></p>
					<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
			<?php }}else{
				echo "có cái nịt";
			} ?>
			</div>

	
	
    </div>
 </div>
 <?php
	include 'inc/footer.php';
?>

