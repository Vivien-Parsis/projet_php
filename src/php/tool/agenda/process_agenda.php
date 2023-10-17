<?php
    function process_agenda():string{
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            require_once('sql_agenda.php');
            if($_POST["function"] === "add"){
                Sql_agenda::add_agenda($_POST["startdate"],$_POST["enddate"],$_POST["evenement"],$_SESSION['utilisateur']['id']);
                return redirect('/agenda',0);
            }
            if($_POST["function"] === "default"){
                Sql_agenda::default_user_agenda($_SESSION['utilisateur']['id']);
                return redirect('/agenda',0);
            }
            if($_POST["function"] === "modify"){
                Sql_agenda::modify_agenda($_POST['id'],$_POST["startdate"],$_POST["enddate"],$_POST["newevenement"]);
                return redirect('/agenda',0);
            }
            if($_POST["function"] === "delete"){
                Sql_agenda::remove_agenda($_POST["id"]);
                return redirect('/agenda',0);
            }
            if($_POST["function"] === "delete_all_user"){
                Sql_agenda::remove_all_user_agenda($_SESSION['utilisateur']['id']);
                return redirect('/agenda',0);
            }
        } 
        return '';  
    }
    function get_agenda():array{
        require_once('src/php/tool/agenda/sql_agenda.php');
        return Sql_agenda::read_all_user_agenda($_SESSION['utilisateur']['id']);
    }
    require_once('src/php/component/redirect.php');
    $html = process_agenda();
    process_agenda();
?>