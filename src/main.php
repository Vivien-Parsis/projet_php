<?php
    require_once('src/php/tool/router.php');
    require_once('src/php/tool/http_info.php');
    session_start();
    $routers = new RouterList([
        new Router('/', 'GET',"php/page/home.php",'Home'), 
        new Router('/todo', 'GET', "php/page/todo.php",'ToDo'),
        new Router('/agenda', 'GET', "php/page/agenda.php",'Agenda'),
        new Router('/sign_in', 'GET', "php/page/sign_in.php",'Créer un compte'),
        new Router('/modify_login', 'GET', "php/page/modify_login.php",'Modifier votre mot de passe'),
        new Router('/process_todo.php', 'POST', "php/tool/todo/process_todo.php",'Process ToDo'),
        new Router('/process_agenda.php', 'POST', "php/tool/agenda/process_agenda.php",'Process Agenda'),
        new Router('/process_login.php', 'POST', "php/tool/login/process_login.php",'Process Login')
    ]);
    $currentpage = get_page($routers,$path,$http_method);
    if($currentpage!="nothtml"){
        require_once($currentpage);
    }
    $currentRouter = $routers->get_router($path,$http_method);
    $isnotHTML = $currentpage=="nothtml";
    $title = get_title($routers,$path,$http_method);
?>  