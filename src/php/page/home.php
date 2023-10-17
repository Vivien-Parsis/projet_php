<?php
    require_once('src/php/tool/login/view_login.php');
    if(!isset($_SESSION['utilisateur'])){
        $html = html_login();
    }else{
        $html = html_handle_login();
        $html .= <<<HTML
        <span class='welcome_home'>
            Bienvenue {$_SESSION['utilisateur']['prenom']} {$_SESSION['utilisateur']['nom']} !
        </span>
HTML;
    }
?>