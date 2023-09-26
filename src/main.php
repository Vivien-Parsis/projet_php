<?php
    include_once('php/tool/router.php');
    //use assets\php\tool\router\Router;
    //use assets\php\tool\router\RouterList;
    //var_dump($_SERVER);
    
    $path = explode("?",$_SERVER["REQUEST_URI"])[0];
    $query = count(explode("?",$_SERVER["REQUEST_URI"]))>1 ? explode("?",$_SERVER["REQUEST_URI"])[1] : null;
    $http_method = $_SERVER["REQUEST_METHOD"];

    $routers = new RouterList([
        new Router('/', 'GET',"php/page/home.php",'Home'),
        new Router('/article', 'GET', "php/page/article.php",'Article'),  
        new Router('/art', 'GET', "php/page/article.php",'Article')   
    ]);

    
?>  
<head>
    <title><?php echo get_title($routers,$path,$http_method);?></title>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php require_once(get_page($routers,$path,$http_method)); ?>
</body>