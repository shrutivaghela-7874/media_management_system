<?php
$uploads = 'uploads';
// echo "<pre>";

if (!empty($_FILES['files']['name'])) {
    $c = count($_FILES['files']['name']);
    for ($i = 0; $i < $c; $i++) {

        $extension = pathinfo($_FILES['files']['name'][$i], PATHINFO_EXTENSION);
        $new_name = time() . $i . '.' . $extension;
        $uploadfile = $uploads . '/' . $new_name;

        move_uploaded_file($_FILES['files']['tmp_name'][$i], $uploadfile);
            
     
    }
    echo 'true';
}
