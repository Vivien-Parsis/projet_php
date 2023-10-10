<?php
function process_todo (){
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include_once('sql_todo.php');
        include_once('.\src\php\tool\http_info.php');
        $sql_todo = new Sql_todo($url_query,$body);
        if ($_POST["function"] === "modify") {
            $sql_todo->modify_todo($_POST["id"],$_POST["newvalue"]);
        }
        if ($_POST["function"] === "add") {
            $sql_todo->add_todo($_POST["objectif"]);
        }
        if ($_POST["function"] === "delete") {
            $sql_todo->remove_todo($_POST["id"]);
        }
        if ($_POST["function"] === "delete_all") {
            $sql_todo->remove_all_todo();
        }
        if ($_POST["function"] === "check") {
            $sql_todo->update_done_todo($_POST["id"],$_POST["done"]);
        }
        if ($_POST["function"] === "default") {
            $sql_todo->default_todo();
        }
    }   
}
    $html = "<div class='loading'><img src='/assets/img/loading-svgrepo-com.svg'></div>";
    process_todo();
?>
<meta http-equiv="refresh" content="0;URL='/todo'"> 