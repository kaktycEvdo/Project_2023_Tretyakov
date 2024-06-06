<?php
putenv('DB_NAME=freelance');
putenv('USER=root');
putenv('PSWRD=');
putenv('HOST=localhost');
try{
    $pdo = new PDO("mysql:host=".getenv("HOST").";dbname=".getenv("DB_NAME"), getenv("USER"), getenv("PSWRD"));
}
catch (PDOException $e) {
    echo "Error: $e";
}