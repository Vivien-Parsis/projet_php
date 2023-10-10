<?php
function process_agenda (){
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include_once('sql_agenda.php');
        include_once('.\src\php\tool\http_info.php');
        $sql_agenda = new Sql_agenda($url_query,$body);
        if ($_POST["function"] === "add") {
            $sql_agenda->add_agenda($_POST["startdate"],$_POST["enddate"],$_POST["evenement"]);
        }
        if ($_POST["function"] === "default") {
            $sql_agenda->default_agenda();
        }
        if ($_POST["function"] === "delete") {
            $sql_agenda->remove_agenda($_POST["id"]);
        }
        if ($_POST["function"] === "delete_all") {
            $sql_agenda->remove_all_agenda();
        }
    }   
}
    $html = "<div class='loading'><img src='/assets/img/loading-svgrepo-com.svg'></div>";
    process_agenda();
?>
<meta http-equiv="refresh" content="0;URL='/agenda'"> 