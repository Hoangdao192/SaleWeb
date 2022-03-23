<?php
    include_once "Database.php";
?>

<?php
class Product {
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function show_product() {
        $query = "SELECT * FROM sanpham ORDER BY id_sanpham";
        $result = $this->database->query($query);
        return $result;
    }

    public function insert_product($id_loaisanpham, $ten_sanpham, $mau, $giatien, $hinhanh) {
        $query = "INSERT INTO sanpham(id_loaisanpham, ten_sanpham, mau, giatien, hinhanh)
        VALUES($id_loaisanpham, '$ten_sanpham', '$mau', $giatien, '$hinhanh')";
        $result = $this->database->query($query);
        return $result;
    }

    public function get_product($id_sanpham) {
        $query = "SELECT * FROM sanpham WHERE id_sanpham = $id_sanpham";
        $result = $this->database->query($query);
        return $result;
    }

    public function update_product($id_sanpham, $id_loaisanpham, $ten_sanpham, $mau, $giatien, $hinhanh) {
        $query = 
                "UPDATE sanpham 
                SET id_loaisanpham = $id_loaisanpham, 
                    ten_sanpham = '$ten_sanpham',
                    mau = '$mau',
                    giatien = $giatien,
                    hinhanh = '$hinhanh' 
                WHERE id_sanpham = $id_sanpham";
        $result = $this->database->query($query);
        return $result;
    }

    public function delete_product($id_sanpham) {
        $query = "DELETE FROM sanpham WHERE id_sanpham = $id_sanpham";
        $result = $this->database->query($query);
        return $result;
    }
}
?>