<?php
function process_agenda (){
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        require_once('sql_agenda.php');
        require_once('.\src\php\tool\http_info.php');
        $sql_agenda = new Sql_agenda();
        if ($_POST["function"] === "add") {
            $sql_agenda->add_agenda($_POST["startdate"],$_POST["enddate"],$_POST["evenement"],$_SESSION['utilisateur']['id']);
        }
        if ($_POST["function"] === "default") {
            $sql_agenda->default_user_agenda($_SESSION['utilisateur']['id']);
        }
        if ($_POST["function"] === "modify") {
            $sql_agenda->modify_agenda($_POST['id'],$_POST["startdate"],$_POST["enddate"],$_POST["newevenement"]);
        }
        if ($_POST["function"] === "delete") {
            $sql_agenda->remove_agenda($_POST["id"]);
        }
        if ($_POST["function"] === "delete_all_user") {
            $sql_agenda->remove_all_user_agenda($_SESSION['utilisateur']['id']);
        }
    }   
}
    require_once('.\src\php\component\redirect.php');
    $html = redirect('/agenda',0);
    process_agenda();
?>