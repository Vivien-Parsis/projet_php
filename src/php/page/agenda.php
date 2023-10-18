<?php 
    require_once('src/php/tool/agenda/view_agenda.php');
    require_once('src/php/tool/login/view_login.php');
    if(isset($_SESSION['utilisateur'])){
        $html = html_agenda().html_handle_login();
    }else{
        require_once('error_401.php');
    } 
?>
<script src='assets/js/Agenda.js'></script>