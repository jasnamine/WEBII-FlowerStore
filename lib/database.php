<?php
include '../config/config.php';
?>



<?php
class Database {
    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $dbname = DB_NAME;
    public $link;
    public $error;

    // Phương thức khởi tạo: tự động kết nối khi khởi tạo đối tượng Database
    public function __construct() {
        $this->connectDB();
    }

    // Phương thức kết nối đến cơ sở dữ liệu
    private function connectDB() {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

        // Kiểm tra kết nối thành công hay không
        if (!$this->link) {
            $this->error = "Connection fail" . $this->link->connect_error;
            return false;
        }
    }

    // Phương thức thực hiện truy vấn Select và trả về kết quả
    public function select($query) {
        $result = $this->link->query($query) or die($this->link->error.__LINE__);

        // Kiểm tra có dữ liệu trả về không
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insert($query) {
        $insert_row = $this->link->query($query) or die($this->link->error. __LINE__);
        
        // Kiểm tra có thêm dữ liệu thành công không
        if ($insert_row) {
            return $insert_row;
        } else {
            return false;
        }
    }

    // Phương thức thực hiện truy vấn Update và trả về kết quả
    public function update($query) {
        $update_row = $this->link->query($query) or die($this->link->error. __LINE__);
        
        // Kiểm tra có cập nhật dữ liệu thành công không
        if ($update_row) {
            return $update_row;
        } else {
            return false;
        }
    }

    public function delete($query) {
        $dekete_row = $this->link->query($query) or die($this->link->error. __LINE__);
        
        // Kiểm tra có cập nhật dữ liệu thành công không
        if ($delete_row) {
            return $delete_row;
        } else {
            return false;
        }
    }
}

?>
