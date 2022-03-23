<?php
    include_once "Database.php";
?>

<?php
class Category {
    private $database;

    public function __construct()
    {
        $this->database = new Database;
    }

    public function show_category() {
        $query = "SELECT * FROM danhmucsanpham ORDER BY id_danhmuc";
        $result = $this->database->query($query);
        return $result;
    }

    public function insert_category($ten_danhmuc) {
        $query = "INSERT INTO danhmucsanpham(ten_danhmuc) VALUES('$ten_danhmuc')";
        $result = $this->database->query($query);
        return $result;
    }

    public function get_category($id_danhmuc) {
        $query = "SELECT * FROM danhmucsanpham WHERE id_danhmuc = $id_danhmuc";
        $result = $this->database->query($query);
        return $result;
    }

    public function update_category($id_danhmuc, $ten_danhmuc) {
        $query = 
                "UPDATE danhmucsanpham 
                SET ten_danhmuc = '$ten_danhmuc' 
                WHERE id_danhmuc = $id_danhmuc";
        $result = $this->database->query($query);
        return $result;
    }

    public function delete_category($id_danhmuc) {
        $query = "DELETE FROM danhmucsanpham WHERE id_danhmuc = $id_danhmuc";
        $result = $this->database->query($query);
        return $result;
    }
}
?>