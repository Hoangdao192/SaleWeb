<?php
    include_once "database_class.php";
?>

<?php
class product {
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
}
?>