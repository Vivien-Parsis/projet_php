<?php 
    require_once('src\php\tool\login\view_login.php');
    if(isset($_SESSION['utilisateur'])){
        require_once('src\php\tool\todo\view_todo.php');
        $html = html_todo().html_end_login();
    }else{
        require_once('error_401.php');
    }   
?>