<?php
    require_once('.\src\php\tool\login\view_login.php');
    if(!isset($_SESSION['utilisateur'])){
        $html = html_login();
    }else{
        $html = "bienvenue ".$_SESSION["utilisateur"]["nom"]." ".$_SESSION["utilisateur"]["prenom"]." !".html_end_login();
    }
?>