<?php 
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
    $scriptsDir = '/php/';

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
        @$profile = $_GET['profile']; // если не будет, то ладно, но если есть, то хоть файл заработает
        @$error_code = $_GET['error_code']; // если не будет, то ладно, но если есть, то хоть файл заработает

        switch (explode('?', $request)[0]) {
            case '':
            case '/':
                include_once __DIR__ . $viewDir . 'index.php';
                break;

            case '/auth':
                include_once __DIR__ . $viewDir . 'auth.php';
                break;

            case '/account':
            case '/profile':
                include_once __DIR__ . $viewDir . 'profile.php';
                break;

            case '/burse':
                include_once __DIR__ . $viewDir . 'burse.php';
                break;

            case '/reg':
                include_once __DIR__ . $viewDir . 'reg.php';
                break;

            case '/logout':
                include_once __DIR__ . $viewDir . 'logout.php';
                break;

            case '/freelancers':
                include_once __DIR__ . $viewDir . 'freelancers.php';
                break;

            case '/task':
                include_once __DIR__ . $viewDir . 'task.php';
                break;

            case '/new_task':
                include_once __DIR__ . $viewDir . 'new_task.php';
                break;

            case '/chat':
                include_once __DIR__ . $viewDir . 'chat.php';
                break;

            default:
                http_response_code(404);
                include_once __DIR__ . $viewDir . '404.php';
        }
        ?>
    </main>
</body>
</html>
