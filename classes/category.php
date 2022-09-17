<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath. '/../lib/database.php');
    include_once ($filepath. '/../helpers/format.php');
?>
<?php
    class category {

        private $db;
        private $fm;
        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insert_category($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link,$catName);
            if(empty($catName)) {
                $alert = "<span class='notok'>Nhap danh muc vao di ba da</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert= "<span class='success'>Them thanh cong</span>";
                    return $alert;
                }else{
                    $alert= "<span class='notok'>That bai roi ba da</span>";
                    return $alert;

                }
            }
        }

        public function show_category(){
            $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_category($catName,$id) {
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link,$catName);
            $id = mysqli_real_escape_string($this->db->link,$id);
            if(empty($catName)) {
                $alert = "<span class='notok'>Sửa chuẩn vào bà dà</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId='$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert= "<span class='success'>Đã cập nhật</span>";
                    return $alert;
                }else{
                    $alert= "<span class='notok'>Cập nhật thất bại</span>";
                    return $alert;

                }
            }
        }

        public function getcatbyId($id){
            $query = "SELECT * FROM tbl_category WHERE catID = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function del_category($id) {
            $query = "DELETE FROM tbl_category WHERE catID = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert= "<span class='success'>Đã xoá rồi bà dà</span>";
                return $alert;
            }else{
                $alert= "<span class='notok'>Méo xoá đc</span>";
                return $alert;

            }
        }
        
    }
?>
