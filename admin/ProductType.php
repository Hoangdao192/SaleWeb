<?php
    include_once "Database.php";
?>

<?php
class ProductType {
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function show_product_type() {
        $query = "SELECT * FROM loaisanpham ORDER BY id_loaisanpham";
        $result = $this->database->query($query);
        return $result;
    }

    public function insert_product_type($id_danhmuc, $ten_loaisanpham) {
        $query = "INSERT INTO loaisanpham (id_danhmuc, ten_loaisanpham) VALUES($id_danhmuc, '$ten_loaisanpham')";
        $result = $this->database->query($query);
        return $result;
    }

    public function get_product_type($id_loaisanpham) {
        $query = "SELECT * FROM loaisanpham WHERE id_loaisanpham = $id_loaisanpham";
        $result = $this->database->query($query);
        return $result;
    }

    public function update_product_type($id_loaisanpham, $id_danhmuc, $ten_loaisanpham) {
        $query = 
                "UPDATE loaisanpham 
                SET id_danhmuc = $id_danhmuc, 
                    ten_loaisanpham = '$ten_loaisanpham'
                WHERE id_loaisanpham = $id_loaisanpham";
        $result = $this->database->query($query);
        return $result;
    }

    public function delete_product_type($id_loaisanpham) {
        $query = "DELETE FROM loaisanpham WHERE id_loaisanpham = $id_loaisanpham";
        $result = $this->database->query($query);
        return $result;
    }
}
?>