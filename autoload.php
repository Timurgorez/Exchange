<?php
spl_autoload_register(function ($class_name)
{
    //echo $class_name;
    $class_pieces = explode('\\', $class_name);
    switch ($class_pieces[0]) {
        case 'app':
            $file = __DIR__ . '/' . implode(DIRECTORY_SEPARATOR, $class_pieces) . '.php';
            if (file_exists($file)) {
                require_once $file;
            }else{
//                echo "Autoload does not found: " .$file;
            }
            break;
    }
},true, true);
