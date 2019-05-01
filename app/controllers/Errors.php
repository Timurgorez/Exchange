<?php

namespace app\controllers;

class Errors
{
    private $img_name = 'error-404.jpg';
    private $code_err = '404';
    private $error = 'Not Found';

    public function __construct($error, $img_name = null, $code_err = null)
    {
        $this->error = $error ? $error : $this->error;
        $this->img_name = $img_name ? $img_name : $this->img_name;
        $this->code_err = $code_err ? $code_err : $this->code_err;
        print_r("
            <div class='wrong-page'>
                <div class='err-img'>
                    <img src='../../img/".$this->img_name."' width='400' height='100%'>
                </div>
                <div class='err-text'>
                    <h1>".$this->code_err."</h1>
                    <b>".$error."</b>
                    <a href='/'>Go Home</a>
                </div>
            </div>
        ");
    }
}
