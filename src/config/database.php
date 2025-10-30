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

    public static function getResultFromQuery($sql){
        //connection
        $conn = self::getConnection();
        //query
        $result = $conn->query($sql);
        $conn->close();

        return $result;
    }

    //verificar se vai funcionar!
    //auxiliar a executar insertion 
    public static function executeSQL($sql){
        $conn = self::getConnection();

        //executando sql
        $conn->query($sql);

        if ($conn->connect_error){
            throw new Exception($conn->connect_error);
        }

        //id auto_increment from dateBase
        $id = $conn->insert_id;
        $conn->close();
        
        return $id;
    }
}