<?php
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php 
	$login_check = Session::get('customer_login');
	if($login_check) {
		header('Location:order.php');
	}
?>

<?php
// đăng ký
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$insertCustomer = $cs->insert_customer($_POST);
}
?>

<?php  

// đăng nhập
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
		$loginCustomer = $cs->login_customer($_POST);
}
?>
<!-- đăng nhập -->
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
				<?php
					if(isset($loginCustomer)){echo $loginCustomer;}
				?>        	
		<form action="" method="post" id="member">
                	<input name="email" type="text" placeholder="email" class="field">
                    <input name="password" type="password" placeholder="Password" class="field">
					<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><input type="submit" class="grey" name="login" value="Đăng nhập"></div></div>
				</div>
		</form>
				
<!-- đăng ký -->
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<form action="" method="post">
				<?php
					if(isset($insertCustomer)){echo $insertCustomer;}
				?>
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" placeholder="Enter Name" name="name" require="">
							</div>
							
							<div>
							   <input type="text" placeholder="City" name="city">
							</div>
							
							<div>
								<input type="text" placeholder="Zip-Code" name="zipcode">
							</div>
							<div>
								<input type="text" placeholder="E-Mail" name="email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" placeholder="Address" name="address">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.placeholder)" class="frm-field required">
							<option placeholder="null" >Select a Country</option>         
							<option value="hcm">Hồ Chí Minh</option>
							<option value="hn">Hà Nội</option>
							<option value="na">Nghê An</option>
							<option value="tth">Thừa Thiên Huế</option>
							<option value="pq">Phú Quốc</option>
		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" placeholder="Phone" name="phone">
		          </div>
				  
				  <div>
					<input type="text" placeholder="Password" name="password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" value="Đăng ký" class="grey">Create Account</div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include 'inc/footer.php';
?>
