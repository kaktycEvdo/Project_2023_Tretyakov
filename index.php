<?php 
    $env = parse_ini_file('.env');
    // if (!empty($_GET["process"]) && !empty($_GET["arg"])){
    //     $process = $_GET["page"];
    //     $arg = $_GET["arg"];
    //     switch ($process){
    //         case "change_role":
    //             $_SESSION["role"] = $arg;
    //             break;
    //     }
    // }
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>КФ</title>
    <script type="module" src="static/models.js"></script>
    <script type="module" src="components/header.js"></script>
    <script src="static/scripts.js"></script>
    <link rel="stylesheet" href="static/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
</head>
<body>
    <header></header>
    <main id="content">
    </main>
    <script>getPage('pages/index.php');</script>
</body>
</html>
