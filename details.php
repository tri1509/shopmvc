<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
    if(isset($_GET['proid']) && $_GET['proid']!=NULL){
        $id = $_GET['proid'];
    }
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$quantity = $_POST['quantity'];
		$addtoCart = $ct -> add_to_cart($quantity,$id);
	}
?>

<div class="main">
    <div class="content">
	<?php
		$get_product_details = $product -> get_details($id);
		if($get_product_details) {
			while($result_detils = $get_product_details -> fetch_assoc()){
	?>
    	<div class="section group">
			<div class="cont-desc span_1_of_2">				
				<div class="grid images_3_of_2"><img src="admin/uploads/<?php echo $result_detils['img'] ?>" alt="" /></div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_detils['brandName'] ?></h2>
					<p><?php echo $result_detils['product_desc'] ?></p>					
					<div class="price">
						<p>Giá: <span><?php echo number_format($result_detils['price'])." đ"  ?></span></p>
						<p>Danh mục: <span><?php echo $result_detils['catName'] ?></span></p>
						<p>Thương hiệu:<span><?php echo $result_detils['brandName'] ?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
							<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
							<?php if(isset($addtoCart)){ echo "<p class='coroi'>Sp này có rồi á bà dà !!!</p>" ; } ?>
						</form>				
					</div>
			</div>
			<div class="product-desc">
				<h2>Product Details</h2>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
			</div>
		</div>
	<?php 
}} 
?>
		<div class="rightsidebar span_3_of_1">
			<h2>CATEGORIES</h2>
			<ul>
				<?php 
					$showCat = $cat -> show_category();
					if($showCat) {
						while($result_showCat = $showCat -> fetch_assoc()){
				?>
				<li><a href="productbycat.php?catid=<?php echo $result_showCat['catId'] ?>"><?php echo $result_showCat['catName'] ?></a></li>
				<?php }} ?>
			</ul>

		</div>
	</div>
</div>
<?php
	include 'inc/footer.php';
?>

<style>
	.coroi {
		font-size: 18px !important;
		color: red !important;
		font-weight: 500 !important;
	}
</style>

