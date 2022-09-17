<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath. '/../lib/database.php');
    include_once ($filepath. '/../helpers/format.php');
?>
<?php
    class brand {

        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_brand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link,$brandName);
            if(empty($brandName)) {
                $alert = "<span class='notok'>Xem ki vao, de trong kia !!!</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert= "<span class='success'>Them thanh cong</span>";
                    return $alert;
                }else{
                    $alert= "<span class='ok'>That bai roi ba da</span>";
                    return $alert;

                }
            }
        }

        public function show_brand(){
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getbrandbyId($id){
            $query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_brand($brandName,$id) {
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link,$brandName);
            $id = mysqli_real_escape_string($this->db->link,$id);
            if(empty($brandName)) {
                $alert = "<span class='notok'>Sửa chuẩn vào bà dà</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId='$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert= "<span class='success'>Đã cập nhật</span>";
                    return $alert;
                }else{
                    $alert= "<span class='ok'>Cập nhật thất bại</span>";
                    return $alert;

                }
            }
        }

        
        public function del_brand($id) {
            $query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert= "<span class='success'>Đã xoá rồi bà dà</span>";
                return $alert;
            }else{
                $alert= "<span class='ok'>Méo xoá đc</span>";
                return $alert;

            }
        }
        
    }
?>
