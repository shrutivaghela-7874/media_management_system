<?php

if (isset($_POST['action']) == 'delete_image' && isset($_POST['image'])) {
    $upfile = "./uploads/" . $_POST['image'];
    if (file_exists($upfile)) {
        if (unlink($upfile)) {
            $res = [
                'status' => 200,
                'messgae' => 'File Delted Succesfully'
            ];
            echo json_encode($res);
        } else {
            $res = [
                'status' => 202,
                'messgae' => '"Error: The file  could not be deleted.'
            ];
            echo json_encode($res);
        }
    } else {
        echo "Error: The file  does not exist.";
    }
}


if (isset($_POST['action']) == 'delete_selected_image' && isset($_POST['arr'])) {
    // print_r($_POST);
    // die;
    $success = false;
    $arr = $_POST['arr'];
    foreach ($arr as $img_item) {
        $upfile = "./uploads/" . $img_item;
        if (file_exists($upfile)) {
            if (unlink($upfile)) {
                $success = true;
            } else {
                $success = false;
            }
        } else {
            echo "Error: The file  does not exist.";
        }
    }
    if ($success) {
        echo  http_response_code(200);
    } else {
        echo  http_response_code(202);
    }
}
