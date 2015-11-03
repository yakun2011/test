<?php

require_once __DIR__ . '/functions/file.php';
require_once __DIR__ . '/models/photo.php';

if (!empty($_POST)){
    
    $data = [];
    
    if (!empty($_POST['title'])) {
        $data['title'] = $_POST['title'];
    }

    if (!empty($_FILES)) {
        $res = file_upload('image');
        if (false !== $res) {
            $data['image'] = $res;
        }
    }
    
    if (isset($data['title']) && isset($data['image'])) {
        photo_insert($data);
        header('Location: /');
        die;
    }
}

require_once __DIR__ . '/views/add.php';