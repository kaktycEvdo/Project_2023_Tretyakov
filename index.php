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
    $request = $_SERVER['REQUEST_URI'];
    $viewDir = '/views/';

    $html = new DOMDocument();
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
    <script type="module" src="../static/input_validation.js"></script>
</head>
<body>
    <header></header>
    <main id="content">
        <?php
        @$profile_id = $_GET['profile_id']; // если не будет, то ладно, но если есть, то хоть файл заработает
        @$error_code = $_GET['error_code']; // если не будет, то ладно, но если есть, то хоть файл заработает

        switch (explode('?', $request)[0]) {
            case '':
            case '/':
                include_once __DIR__ . $viewDir . 'index.php';
                break;

            case '/auth':
                include_once __DIR__ . $viewDir . 'auth.php';
                break;

            case '/profile':
                include_once __DIR__ . $viewDir . 'profile.php';
                break;

            default:
                http_response_code(404);
                include_once __DIR__ . $viewDir . '404.php';
        }
        ?>
    </main>
</body>
</html>
