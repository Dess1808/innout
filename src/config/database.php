<?php

class DataBase {
    public static function getConnection(){
        //path env
        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        //converter para array assoc - chave valor
        $env = parse_ini_file($envPath);
       
        //mysql connection
        $conn = new mysqli($env['host'], $env['username'], $env['password'], $env['database']);
       
        //test
        if ($conn->connect_error){
            die("Error: " . $conn->connect_error);
        }

        return $conn;
    }
}