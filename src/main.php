<?php include_once('src\assets\css\style.php');?>
<?php
    include_once('php\tool\router.php');
    //use assets\php\tool\router\Router;
    //use assets\php\tool\router\RouterList;
    //var_dump($_SERVER);
    include_once('php\http_info.php');

    $routers = new RouterList([
        new Router('/', 'GET',"php/page/home.php",'Home'), 
        new Router('/todo', 'GET', "php/page/todo.php",'ToDo'),
        new Router('/process_todo.php', 'POST', "php/page/process_todo.php",'ToDo')   
    ]);
    include_once(get_page($routers,$path,$http_method));
    $page = $html;
    //$css = require_once('src/assets/css/style.php');
    $title = get_title($routers,$path,$http_method);
?>  