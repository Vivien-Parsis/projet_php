<link href="src/assets/css/style.css" rel="stylesheet" type="text/css">
<?php
    include_once('src/assets/php/tool/router.php');
    //use assets\php\tool\router\Router;
    //use assets\php\tool\router\RouterList;
    //var_dump($_SERVER);
    
    $path = explode("?",$_SERVER["REQUEST_URI"])[0];
    $query = count(explode("?",$_SERVER["REQUEST_URI"]))>1 ? explode("?",$_SERVER["REQUEST_URI"])[1] : null;
    $http_method = $_SERVER["REQUEST_METHOD"];

    $routers = new RouterList([
        new Router('/', 'GET',"src/assets/php/page/home.php"),
        new Router('/article', 'GET', "src/assets/php/page/article.php"),  
        new Router('/art', 'GET', "src/assets/php/page/article.php")   
    ]);

    require_once(get_page($routers,$path,$http_method));
?>   