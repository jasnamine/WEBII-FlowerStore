
<?php
require_once 'connect.php'; 
require_once 'config/config.php';


function query($sql, $data = [], $check = false) {
    global $conn;
    $ketqua = false;

    try {
        $statement = $conn->prepare($sql);
        if (!empty($data)) {
            $ketqua = $statement->execute($data);
        } else {
            $ketqua = $statement->execute();
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
    return $ketqua;
}

// function insert($table, $data){
//     $key = array_keys($data);
//     $truong = implode(',', $key);
//     $valuetb = ':'.implode(',:', $key);

//     $sql = 'INSERT INTO' . $table . '('.$truong .')'. 'VALUES('. $valuetb .')';

//     $kq = query($sql, $data);
//     return $kq;

// }

function insert($table, $data){
    global $conn;
  
    // Prepare column names and placeholders
    $columns = implode(',', array_keys($data));
    $placeholders = ':' . implode(',:', array_keys($data));

    // Construct the SQL query with proper spacing
    $sql = 'INSERT INTO ' . $table . ' (' . $columns . ') VALUES (' . $placeholders . ')';

    try {
        // Prepare the SQL statement
        $statement = $conn->prepare($sql);
        
        // Execute the statement with data
        $kq = $statement->execute($data);

        // Return the result
        return $kq;
    } catch(Exception $exp) {
        // Handle exceptions
        echo $exp->getMessage() . '<br>';
        echo 'File: '. $exp->getFile() . '<br>';
        echo 'Line: '.$exp->getLine();
        die();
    }
}


function update($table, $data, $condition=''){
    $update = '';
    foreach($data as $key => $value){
        $update .= $key .'= :' . $key . ',';
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

// lấy nhiều dòng dữ liệu
function getRaw($sql){
    $kq = query($sql, '', true);
    if(is_object($kq)){
        $dataFetch = $kq -> fetchAll(PDO::FETCH_ASSOC);
    }
    return $dataFetch;
}

// lấy 1 dòng dữ liệu
function oneRaw($sql){
    $kq = query($sql, '', true);
    if(is_object($kq)){
        $dataFetch = $kq -> fetch(PDO::FETCH_ASSOC);
    }
    return $dataFetch;

}

// đếm số dòng dữ liệu
function getRows($sql){
    $kq = query($sql, '', true);
    if(!empty($kq)){
        return $kq -> rowCount();
        
    }
    

}



?>

