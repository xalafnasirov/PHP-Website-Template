<?php include 'backend/app.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>

    <?php



    // CHECK AUTHORIZATION
    include 'backend/auth.php';
    
    ### HEADER ###
    include 'header.php';
    include 'sidebar.php';
    ###############

    


  $db->query($sql);
    
    // ROUTES
    if (isset($_GET['route'])) {
        $route = $_GET['route'];
    
        switch ($route) {
            case '':
                include 'statistics.php';
                break;
            case 'home.show':
                include 'statistics.php';
                break;
            case 'links.edit':
                include 'links.php';
                break;
            default:
                include 'statistics.php';
                break;
        }
    }
    
    ### FOOTER ###
    include 'footer.php';
    ###############
    ?>
