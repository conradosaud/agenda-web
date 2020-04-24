<?php

/*
 *  Conexão com o banco de dados utilizando o Singleton como Design Patterns
 *  e a tecnologia PDO do PhP para conexão do banco.
 */

class Conexao{
    
    private static $db;
    
    const USERNAME = "root";
    const PASSWORD = "";
    const HOST = "localhost";
    const DB = "agenda";
    
    public function instance(){
        if(!self::$db){
            self::$db = $this->connect();
        }
        return self::$db;
    }
    
    private function connect(){
        
        $username = self::USERNAME;
        $password = self::PASSWORD;
        $host = self::HOST;
        $dbname = self::DB;
        
        $db = new PDO("mysql:dbname=$dbname;host=$host", $username, $password);
        $db->setAttribute(PDO::ATTR_AUTOCOMMIT, PDO::ERRMODE_EXCEPTION);
        
        return $db;
        
    }
}