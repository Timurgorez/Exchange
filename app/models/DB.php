<?php

namespace app\models;


class DB{

    private static $instance = null;
    private $pdo = null;


    private static $defaultConfig = [
        'host' => 'localhost',
        'db_name' => 'exchange_system',
        'admin' => 'root',
        'pass' => '',
    ];

    private function __wakeup(){}
    private function __clone(){}
    private function __construct($config = [])
    {
        if(empty($config)) {
            $config = self::$defaultConfig;
        }
        try{
            $this->pdo = new \PDO("mysql:host={$config['host']}; dbname={$config['db_name']}", $config['admin'], $config['pass']);
        }catch (\PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getInstance($config = [])
    {
        if(!isset(static::$instance))
        {
            self::$instance = new self($config);
        }
        return self::$instance;
    }
    public function PDO()
    {
        return $this->pdo;
    }
    public function ClosePDO()
    {
        $this->pdo = null;
    }

}