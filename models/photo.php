<?php

require_once __DIR__ . '/../functions/sql.php';

function photo_getAll(){
    
    $sql = 'SELECT * FROM images';
    return sql_query($sql);
}

function photo_insert($data){
    $sql = "
          INSERT INTO images
          (title, path)
          VALUES
          ('" . $data['title'] . "', '" . $data['image'] . "')
    ";
    sql_exec($sql);
}
