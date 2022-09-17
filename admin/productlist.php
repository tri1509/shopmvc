<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php
	$fm = new Format();
	$pd = new product();
	$pdlist = $pd -> show_product();
	if(isset($_GET['productid'])){
		$id = $_GET['productid'];
		$delpro = $pd->del_product($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
		<h2>Liệt kê sản phẩm</h2>
        <div class="block">  
			<?php if(isset($delpro)){echo $delpro ;} ?>   
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Id</th>
					<th>Tên SP</th>
					<th>Giá</th>
					<th>Hình ảnh</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if($pdlist) {
						$i=0;
						while($resule = $pdlist -> fetch_assoc()){
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?> </td>
					<td><?php echo $resule['productName'] ?></td>
					<td><?php echo $resule['price'] ?></td>
					<td><img src="uploads/<?php echo $resule['img'] ?>" alt="" width='100' height='100'></td>
					<td><?php echo $resule['catId'] ?></td>
					<td><?php echo $resule['brandId'] ?></td>
					<td><?php echo $fm -> textShorten($resule['product_desc'],100) ; ?></td>
					<td>
						<?php 
							if($resule['types'] == 0) {
								echo 'Thường';
							}else{
								echo 'Nổi bật';
							}
						?>
					</td>
					<td><a href="productedit.php?productid=<?php echo $resule['productId'] ?>">Edit</a> || <a href="?productid=<?php echo $resule['productId'] ?>" onclick="return confirm('mày có muốn xoá không?')">Delete</a></td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
