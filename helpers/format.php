<?php
// các hàm dùng chung
class Format {
    // format ngay thang nam tren website
    public function formatDate($date) {
        return date('F j, Y, g:i a', strtotime($date));
    }

    // chua text ngan, lam tieu de chuan seo
    public function textShorten($text, $limit = 400) {
        $text = $text. " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text.".....";
        return $text;
    }

    // kiem tra form trong hay khong trong
    public function validation($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // kiem tra ten cua server
    public function title() {
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path, '.php');
        //$title = str_replace('_', ' ', $title);
        if ($title == 'index') {
            $title = 'home';
        } elseif ($title == 'contact') {
            $title = 'contact';
        }
        return $title = ucfirst($title);
    }
}
?>
