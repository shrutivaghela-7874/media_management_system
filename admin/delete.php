<?php

if (isset($_POST['action']) == 'delete_image' && isset($_POST['image'])) {
    $upfile="./uploads/".$_POST['image'];
    if (file_exists($upfile)) {
        if (unlink($upfile)) {
            $res=[
                'status'=>200,
                'messgae'=>'File Delted Succesfully'
            ];
            echo json_encode($res);
        } else {
            $res=[
                'status'=>202,
                'messgae'=>'"Error: The file  could not be deleted.'
            ];
            echo json_encode($res);
        }
    } else {
        echo "Error: The file  does not exist.";
    }
}
