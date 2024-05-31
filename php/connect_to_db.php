<?php
    $env = parse_ini_file(__DIR__ . '/../' . '.env');
try{
    $pdo = new PDO("mysql:host=".$env["HOST"].";dbname=".$env["DB_NAME"], $env["USER"], $env["PSWRD"]);
}
catch (PDOException $e) {
    echo "Error: $e";
}