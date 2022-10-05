<?php
    include 'lib/session.php';
    Session::init();
?>
<?php
    include_once 'lib/database.php';
    include_once 'helpers/format.php';
    spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});

    $db = new Database();
    $fm = new Format();
    $ct = new cart();
    $cs = new customer();
    $us = new user();
    $cat = new category();
    $product = new product();
?>
<?php
    if(isset($_GET['customerid'])){
        $delCart = $ct -> del_all_data_cart();
        session::destroy();
    }
?>

<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache"); 
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE php>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
<div class="wrap">
    <div class="header_top">
        <div class="logo">
            <a href="index.php"><img src="images/logo.png" alt="" /></a>
        </div>
            <div class="header_top_right">
            <div class="search_box">
                <form>
                    <input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
                </form>
            </div>
            <div class="shopping_cart">
                <div class="cart">
                    <a href="#" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product">
                                <?php
                                    $check_cart = $ct -> check_cart();
                                    if($check_cart){
                                        $sum = session::get("sum");
                                        $qty = session::get("qty");
                                        echo number_format($sum)." đ"." - "."$qty";
                                    }else{
                                        echo "empty";
                                    }
                                ?>
                            </span>
                        </a>
                    </div>
                </div>
                <?php
                    if(isset($_GET['customerid'])){
                        session::destroy();
                    }
                ?>
        <div class="login">
            <?php 
                $login_check = Session::get('customer_login');
                if($login_check) {
            ?>
                    <a href="?customerid=<?php echo Session::get('customer_id')?>"> Đăng xuất</a>

            <?php
                }else{
                    echo "<a href='login.php'>Đăng Nhập</a>";
                }
            ?>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
    <?php
        $check_cart = $ct -> check_cart();
        if($check_cart) {
    ?>
        <li><a href="cart.php">Cart</a></li>
    <?php } ?>

	  <li><a href="contact.php">Contact</a></li>
      <?php
        if($login_check) {
      ?>
	    <li><a href="profile.php">profile</a> </li>
      <?php } ?>
	  <div class="clear"></div>
	</ul>
</div>