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
    // if(isset($_GET['proid']) && $_GET['proid']!=NULL){
    //     $id = $_GET['proid'];
    // }
    $id = Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
		$updateCustomers = $cs -> update_Customers($_POST,$id);
	}
?>

<div class="main">
    <div class="content">
		<div class="content-top">
			<div class="heading">
				<h3>Chỉnh sửa thông tin</h3>
			</div>
		</div>
		<div class="clear40"></div>
        <form action="" method="post">
            <?php 
                if(isset($updateCustomers)) {
                    echo $updateCustomers ;
                }
            ?>
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
                        <td><input type="text" name="name" id="" value="<?php echo $result['ten'] ?>"></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td>:</td>
                        <td><input type="text" name="city" id="" value="<?php echo $result['city'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><input type="text" name="phone" id="" value="<?php echo $result['phone'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>:</td>
                        <td><input type="text" name="country" id="" value="<?php echo $result['country'] ?>"></td>
                    </tr>
                    <tr>
                        <td>zipcode</td>
                        <td>:</td>
                        <td><input type="text" name="zipcode" id="" value="<?php echo $result['zipcode'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="text" name="email" id="" value="<?php echo $result['email'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td><input type="text" name="address" id="" value="<?php echo $result['diachi'] ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="submit" value="save" name="save" class="grey"></td>
                    </tr>
    
                <?php }} ?>
            </table>
        </form>
	</div>
</div>
<?php
	include 'inc/footer.php';
?>


