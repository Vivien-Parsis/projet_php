<?php
    include_once('php\tool\router.php');
    include_once('php\tool\http_info.php');

    $routers = new RouterList([
        new Router('/', 'GET',"php/page/home.php",'Home'), 
        new Router('/todo', 'GET', "php/page/todo.php",'ToDo'),
        new Router('/agenda', 'GET', "php/page/agenda.php",'Agenda'),
        new Router('/process_todo.php', 'POST', "php/tool/todo/process_todo.php",'ToDo'),
        new Router('/process_agenda.php', 'POST', "php/tool/agenda/process_agenda.php",'Agenda')
    ]);
    $currentpage = get_page($routers,$path,$http_method);
    if($currentpage!="nothtml"){
        include_once($currentpage);
    }
    $currentRouter = $routers->get_router($path,$http_method);
    $isnotHTML = $currentpage=="nothtml";
    $title = get_title($routers,$path,$http_method);
?>  