<?php
    include_once('php\tool\router.php');
    //use assets\php\tool\router\Router;
    //use assets\php\tool\router\RouterList;
    //var_dump($_SERVER);
    include_once('php\http_info.php');

    $routers = new RouterList([
        new Router('/', 'GET',"php/page/home.php",'Home',false), 
        new Router('/todo', 'GET', "php/page/todo.php",'ToDo',false),
        new Router('/agenda', 'GET', "php/page/agenda.php",'Agenda',false),
        new Router('/process_todo.php', 'POST', "php/tool/todo/process_todo.php",'ToDo',false),
        new Router('/css/style.css','GET',"php/page/process_not_html.php",'style',true),
        new Router('/js/modify.js','GET',"php/page/process_not_html.php",'modify',true)
    ]);
    include_once(get_page($routers,$path,$http_method));
    $currentRouter = $routers->get_router($path,$http_method);
    $isnotHTML = $currentRouter!=null ? $currentRouter->getisnotHTML() : null;
    $title = get_title($routers,$path,$http_method);
?>  