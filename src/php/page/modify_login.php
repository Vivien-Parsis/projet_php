<?php
    if(!isset($_SESSION['utilisateur'])){
        require_once('error_401.php');
    }else{
        require_once('src\php\tool\login\view_login.php');
        $html=html_modify_login();
    }
?>