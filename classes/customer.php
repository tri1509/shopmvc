<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath. '/../lib/database.php');
    include_once ($filepath. '/../helpers/format.php');
?>
<?php
    class customer {
        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_customer($data) {
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $country = mysqli_real_escape_string($this->db->link, $data['country']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $password = mysqli_real_escape_string($this->db->link, $data['password']);
            if($name == "" || $city == "" || $zipcode == "" || $address == "" || $country== "" || $phone = "" || $email == "" || $password == "" ) {
                $alert = "<span class='notok'>bà dà, không được để trống</span>";
                return $alert;
            }else{
                $check_email = "SELECT * FROM tbl_customer WHERE email='$email' LIMIT 1";
                $result_check = $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class='notok'>Email đã có rồi</span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO tbl_customer(ten,diachi,city,country,zipcode,phone,email,matkhau) VALUES('$name','$address','$city','$country','$zipcode','$phone','$email','$password')";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = "<span class='notok'>Thêm thông tin thành công</span>";
                        return $alert;
                    }else{
                        $alert = "<span class='notok'>Thất bại</span>";
                        return $alert;
                    }
                }
            }
        }

        public function login_customer($data){
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, $data['password']);
            if($email == "" || $password == "" ) {
                $alert = "<span class='notok'>bà dà, không được để trống</span>";
                return $alert;
            }else{
                $check_login = "SELECT * FROM tbl_customer WHERE email='$email' AND matkhau = '$password' LIMIT 1";
                $result_check = $this->db->select($check_login);
                if($result_check){
                    $value = $result_check -> fetch_assoc();
                    Session::set('customer_login',true);
                    Session::set('customer_id',$value['id']);
                    Session::set('customer_name',$value['name']);
                    header('location:order.php');
                }else{
                    $alert = "<span class='notok'>Email và password không đúng</span>";
                    return $alert;
                }
            }
        }

        public function show_customer($id) {
            $query = "SELECT * FROM tbl_customer WHERE id = '$id' LIMIT 1 ";
            $result = $this->db->select($query);
            return $result ;
        }

        public function update_Customers($data,$id) {
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $country = mysqli_real_escape_string($this->db->link, $data['country']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            if($name == "" || $zipcode == "" || $address == "" || $phone = "" || $email == "") {
                $alert = "<span class='notok'>bà dà, không được để trống</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_customer SET ten = '$name' ,diachi = '$address',zipcode = '$zipcode',phone = '$phone',email = '$email' WHERE id = '$id' ";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='notok'>Cập nhật thông tin thành công</span>";
                    return $alert;
                }else{
                    $alert = "<span class='notok'>Thất bại</span>";
                    return $alert;
                }
            }
        }

    }
?>
