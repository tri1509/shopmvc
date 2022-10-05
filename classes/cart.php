<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath. '/../lib/database.php');
    include_once ($filepath. '/../helpers/format.php');
?>
<?php
    class cart {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function add_to_cart($quantity,$id){
            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link,$id);
            $sId = session_id();

            $query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
            $result = $this -> db -> select($query) -> fetch_assoc();
            // echo '<pre>';
            // echo print_r($result) ;
            // echo '</pre>';
            $img = $result["img"];
            $price = $result["price"];
            $productName = $result["productName"];
            $query_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sessionId = '$sId' ";
            $check_cart =  $this->db->select($query_cart); 
            if($check_cart){
                $mgs = "Sản phẩm này đã có trong giỏ hàng rồi!!!";
                return $mgs;
            }else{
                $query_insert =
                "INSERT INTO tbl_cart(productId,quantity,sessionId,img,price,productName) 
                VALUES('$id','$quantity','$sId','$img','$price','$productName')";
                $result_insert = $this->db->insert($query_insert);
                if($result_insert){
                    header('Location:cart.php');
                }else{
                    header('Location:404.php');
                }
            }
        }

        public function get_product_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_quantity_cart($quantity,$cartId){
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);
            $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId='$cartId'";
            $result = $this->db->update($query);
            if($result){
                header('Location:cart.php');
            }else{
                $mgs = "Lỗi rồi bà dà";
                return $mgs;
            }
        }

        public function del_cart($cartDel) {
            $cartDel = mysqli_real_escape_string($this->db->link, $cartDel);
            $query = "DELETE FROM tbl_cart WHERE cartID = '$cartDel'";
            $result = $this->db->delete($query);
            if($result){
                header('Location:cart.php');
            }else{
                $mgs = "Lỗi rồi bà dà";
                return $mgs;
            }
        }

        public function del_all_data_cart() {
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sessionId = '$sId' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function check_cart() {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertOrder($customer_id) {
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sId' ";
            $get_product = $this->db->select($query);
            if($get_product) {
                while($result = $get_product -> fetch_assoc()) {
                    $productId = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'] * $quantity;
                    $img = $result['img'];
                    $customer_id = $customer_id;
                    $query_order =
                    "INSERT INTO tbl_order(productId,productName,quantity,price,img,customer_id) 
                    VALUES('$product_id','$productName','$quantity','$price','$img','$customer_id')";
                    $query_order = $this->db->insert($query_order);
                    
                }
            }
        }

        public function getAmountPrice($customer_id) {
            $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id' AND date_order = now()";
            $get_price = $this->db->select($query);
            return $get_price;

        }
    }
?>
