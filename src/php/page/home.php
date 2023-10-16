<?php
    require_once('src\php\tool\login\view_login.php');
    if(!isset($_SESSION['utilisateur'])){
        $html = html_login();
    }else{
        $html = "Bienvenue ".$_SESSION["utilisateur"]["prenom"]." ".$_SESSION["utilisateur"]["nom"]." !".html_handle_login();
    }
?>