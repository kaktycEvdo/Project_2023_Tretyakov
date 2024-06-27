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

// make classes sometimes maybe
// <?php
// putenv('DB_NAME=freelance');
// putenv('USER=root');
// putenv('PSWRD=');
// putenv('HOST=localhost');

// class DBConnection {
//     protected static $pdo;

//     public function __construct(PDO $pdo) {
//         try{
//             $pdo = new PDO("mysql:host=".getenv("HOST").";dbname=".getenv("DB_NAME"), getenv("USER"), getenv("PSWRD"));
//         }
//         catch (PDOException $e) {
//             echo "Error: $e";
//         }
//     }
//     public function getAll(string|array $table, string|array $columns = '*', string $clause = null){
//         if($clause) {
//             $query = $this->pdo->prepare("SELECT :columns FROM :table WHERE :clause", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
//             $query->execute([$table, $columns, $clause]);
//             $res = $query->fetchAll(PDO::FETCH_ASSOC);
//             if ($res || sizeof($res) == 0){
//                 header('Content-Type: application/json; charset=utf-8');
//                 $this->pdo = null;
//                 return json_encode($res);
//             }

//             $this->pdo = null;
//             return "ошибка";
//         }
//         else {
//             $query = $this->pdo->prepare("SELECT :columns FROM :table", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
//             $query->execute([$table, $columns]);
//             $res = $query->fetchAll(PDO::FETCH_ASSOC);
//             if ($res || sizeof($res) == 0){
//                 header('Content-Type: application/json; charset=utf-8');
//                 $this->pdo = null;
//                 return json_encode($res);
//             }

//             $this->pdo = null;
//             return "ошибка";
//         }
//     }
//     public function get(string|array $table, string|array $columns = '*', string $clause = null){
//         if($clause) {
//             $query = $this->pdo->prepare("SELECT :columns FROM :table WHERE :clause", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
//             $query->execute([$table, $columns, $clause]);
//             $res = $query->fetch(PDO::FETCH_ASSOC);
//             if ($res || sizeof($res) == 0){
//                 header('Content-Type: application/json; charset=utf-8');
//                 $this->pdo = null;
//                 return json_encode($res);
//             }

//             $this->pdo = null;
//             return "ошибка";
//         }
//         else {
//             $query = $this->pdo->prepare("SELECT :columns FROM :table", [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
//             $query->execute([$table, $columns]);
//             $res = $query->fetch(PDO::FETCH_ASSOC);
//             if ($res || sizeof($res) == 0){
//                 header('Content-Type: application/json; charset=utf-8');
//                 $this->pdo = null;
//                 return json_encode($res);
//             }

//             $this->pdo = null;
//             return "ошибка";
//         }
//     }

//     public function create(){

//     }
// }
