<?php
    require_once('src/php/tool/router.php');
    require_once('src/php/tool/http_info.php');
    session_start();
    $routers = new RouterList([
        new Router('/', 'GET',"src/php/page/home.php",'Home'), 
        new Router('/todo', 'GET', "src/php/page/todo.php",'ToDo'),
        new Router('/agenda', 'GET', "src/php/page/agenda.php",'Agenda'),
        new Router('/sign_in', 'GET', "src/php/page/sign_in.php",'Créer un compte'),
        new Router('/modify_login', 'GET', "src/php/page/modify_login.php",'Modifier votre mot de passe'),
        new Router('/process_todo.php', 'POST', "src/php/tool/todo/process_todo.php",'Process ToDo'),
        new Router('/process_agenda.php', 'POST', "src/php/tool/agenda/process_agenda.php",'Process Agenda'),
        new Router('/process_login.php', 'POST', "src/php/tool/login/process_login.php",'Process Login')
    ]);
    $currentpage = get_page($routers,$path,$http_method);
    if($currentpage!="nothtml"){
        require_once($currentpage);
    }
    $isnotHTML = $currentpage=="nothtml";
    $title = get_title($routers,$path,$http_method);
?>  