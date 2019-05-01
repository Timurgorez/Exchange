<?php

    $file_name = $_GET['file_n'];

    $strArr = explode('.', $file_name);
    $extension = $strArr[count($strArr)-1];
        switch ($extension) {
            case "zip": $ctype="application/zip"; break;
            case "png": $ctype="image/png"; break;
            case "jpeg": $ctype="image/jpg"; break;
            case "jpg": $ctype="image/jpg"; break;
            default: $ctype="application/force-download";
        }


    $file_path = 'upload/'.$file_name;

    if (file_exists($file_path)) {
        if (ob_get_level()) {
            ob_end_clean();
        }

        header('Content-Description: File Transfer');
        header('Content-Type: '.$ctype);
        header('Content-Disposition: attachment; filename=' . basename($file_path));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit();
    }else {
        var_dump( [
            'status' => 'error',
            'message' => 'Файл не найден'
        ]);
    }
