<?php

namespace app\controllers;

use app\models\UploadModel;

class MainController
{
    public function actionMain()
    {
        if($_POST || $_FILES){
            $model = new UploadModel($_POST, $_FILES);
            if(is_array($model->validate())){
                $_SESSION['errors'] = $model->validate();
            }
            if(is_bool($model->validate()) && $model->save()){
                $_SESSION['model'] = $model;
                return require_once  __DIR__.'/../views/show.php';
            }
        }
        return require_once __DIR__.'/../views/main.php';
    }

    public function actionGetFile($f_name = null)
    {
        $myRow = UploadModel::file($f_name);

        if(count($myRow) == 0){
            return new Errors("Page not found");
        }
        if(!$myRow['available']){
            return new Errors("Not available file", 'not_available.png', '403');
        }

        if($_POST['password']){
            if(hash_equals($myRow['password'], crypt($_POST['password'], $myRow['password']))){
                $_SESSION['model'] = $myRow;
                return require_once __DIR__.'/../views/download.php';
            }else{
                $_SESSION['f_name'] = $f_name;
                $_SESSION['errors'] = ['Password incorrect'];
                return require_once __DIR__.'/../views/password.php';
            }
        }

        if($myRow['password']){
            $_SESSION['f_name'] = $f_name;
            return require_once __DIR__.'/../views/password.php';
        }else{
            $_SESSION['model'] = $myRow;
            return require_once __DIR__.'/../views/download.php';
        }


    }

    public function actionCheckOnceDownload()
    {
        if($_POST['file_n']){
            $fileModel = UploadModel::file($_POST['file_n']);

            if($fileModel['once_download'] && UploadModel::notAvailable($fileModel['id'])){
                return 'All done';
            }
        }else{
            return new Errors('Access denied');
        }

    }

}







