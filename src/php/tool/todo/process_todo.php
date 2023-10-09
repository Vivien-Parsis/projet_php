<?php
function process_todo (){
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include_once('sql_todo.php');
        include_once('.\src\php\http_info.php');
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
    }   
}
    $html = "<span>redirection</span>";
    process_todo();
?>
<meta http-equiv="refresh" content="0;URL='/todo'"> 