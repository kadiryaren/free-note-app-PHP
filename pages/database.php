<?php

    class database{
        public static function database_check(){
            try{
                $db = new PDO("mysql:host=localhost;dbname=first_database;charset=utf8","root","");
                $db->exec('SET NAMES utf8');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $db; 
            
            }
            catch( PDOException $e){
                die($e->getMessage());
                $status = 0;
            }
        }
    }

?>