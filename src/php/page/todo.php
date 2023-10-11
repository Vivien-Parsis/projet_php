<?php 
    require_once('.\src\php\tool\todo\view_todo.php');
    require_once('.\src\php\tool\login\view_login.php');
    if(isset($_SESSION['utilisateur'])){
        $html = html_todo().html_end_login();
    }else{
        $html = "<div class='loading'><img src='/assets/img/loading-svgrepo-com.svg'></div>
        <meta http-equiv='refresh' content=\"0;URL='/'\">";
    }   
?>