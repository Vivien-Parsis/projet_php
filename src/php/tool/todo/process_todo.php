<?php
    function process_todo (){
        require_once('src\php\component\redirect.php');
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            require_once('sql_todo.php');
            if ($_POST["function"] === "modify") {
                Sql_todo::modify_todo($_POST["id"],$_POST["newvalue"]);
                return redirect('/todo',0);
            }
            if ($_POST["function"] === "add") {
                Sql_todo::add_todo($_POST["objectif"],$_SESSION['utilisateur']['id']);
                return redirect('/todo',0);
            }
            if ($_POST["function"] === "delete") {
                Sql_todo::remove_todo($_POST["id"]);
                return redirect('/todo',0);
            }
            if ($_POST["function"] === "delete_all_user") {
                Sql_todo::remove_all_user_todo($_SESSION['utilisateur']['id']);
                return redirect('/todo',0);
            }
            if ($_POST["function"] === "check") {
                Sql_todo::update_done_todo($_POST["id"],$_POST["done"]);
                return redirect('/todo',0);
            }
            if ($_POST["function"] === "default") {
                Sql_todo::default_user_todo($_SESSION['utilisateur']['id']);
                return redirect('/todo',0);
            }
        }   
    }
    function get_todo():array{
        require_once('src\php\tool\todo\sql_todo.php');
        return Sql_todo::read_todo($_SESSION['utilisateur']['id']);
    }
$html = process_todo();
?>