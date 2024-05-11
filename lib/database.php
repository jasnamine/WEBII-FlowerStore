<?php
require_once 'connect.php'; 

// Hàm thực hiện truy vấn đến cơ sở dữ liệu
function query($sql, $data = [], $check = false) {
    global $conn;
    $result = false;
    //echo $sql;

    try {
        $statement = $conn->prepare($sql);
        if (!empty($data)) {
            $result = $statement->execute($data);
        } else {
            $result = $statement->execute();
        }
    } catch(Exception $exp) {
        echo $exp->getMessage() . '<br>';
        echo 'File: '. $exp->getFile() . '<br>';
        echo 'Line: '.$exp->getLine();
        die();
    }

    if($check){
        return $statement;
    }
    return $result;
}

// function insert($table, $data){
//     $key = array_keys($data);
//     $truong = implode(',', $key);
//     $valuetb = ':'.implode(',:', $key);

//     $sql = 'INSERT INTO' . $table . '('.$truong .')'. 'VALUES('. $valuetb .')';

//     $kq = query($sql, $data);
//     return $kq;

// }

// Hàm thực hiện thêm dữ liệu vào bảng
function insert($table, $data){
    global $conn;
  
    $columns = implode(',', array_keys($data));
    $placeholders = ':' . implode(',:', array_keys($data));

    $sql = 'INSERT INTO ' . $table . ' (' . $columns . ') VALUES (' . $placeholders . ')';

    try {
        $statement = $conn->prepare($sql);
        
        $kq = $statement->execute($data);

        return $kq;
    } catch(Exception $exp) {
        
        echo $exp->getMessage() . '<br>';
        echo 'File: '. $exp->getFile() . '<br>';
        echo 'Line: '.$exp->getLine();
        die();
    }
}

//Hàm thực hiện cập nhật dữ liệu trong bảng
function update($table, $data, $condition=''){
    
    $update = '';
    foreach($data as $key => $value){
        $update .= $key .' =:' . $key . ',';
    }

    $update = trim($update, ',');

    if(!empty($condition)){
        $sql = 'UPDATE ' . $table . ' SET ' .$update . ' WHERE ' . $condition;

    }
    else{
        $sql = 'UPDATE ' . $table . ' SET ' .$update;

    }
    $kq = query($sql, $data);
    return $kq;
}


// Hàm thực hiện xóa dữ liệu từ bảng
function delete($table, $condition=''){
    if(empty($condition)){
        $sql = 'DELETE FROM ' .$table;
    }
    else{
        $sql = 'DELETE FROM ' .$table . ' WHERE ' . $condition ;
    }

    $kq = query($sql);
    return $kq;

}

// Hàm lấy nhiều dòng dữ liệu từ cơ sở dữ liệu
function getRaw($sql){
    $kq = query($sql, '', true);
    if(is_object($kq)){
        $dataFetch = $kq -> fetchAll(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

// Hàm lấy một dòng dữ liệu từ cơ sở dữ liệu
function oneRaw($sql){
    $kq = query($sql, '', true);
    if(is_object($kq)){
        $dataFetch = $kq -> fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;

}

// Hàm đếm số dòng dữ liệu từ cơ sở dữ liệu
function getRows($sql){
    $kq = query($sql, '', true);
    if(!empty($kq)){
        return $kq -> rowCount();
        
    }
}



?>