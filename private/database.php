<?php
  
    $DB_SERVER = '127.0.0.1';
    $DB_NAME = 'php_pagination';
    $DB_USER = 'root';
    $DB_PASS= '';
    
    $conn = "mysql:host=$DB_SERVER;dbname=$DB_NAME;charset=UTF8";
    $connection = new PDO($conn, $DB_USER, $DB_PASS);
    try {
      $connection->setAttribute(PDO:: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
    } catch(PDOException $e){
      die($e->getMessage());
    }
   
?>