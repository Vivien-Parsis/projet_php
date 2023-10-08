<?php
    function html_todo():string{
        require_once('.\src\php\tool\todo\sql_todo.php');
        include('.\src\http_info.php');
        $sql_todo = new Sql_todo($url_query, $body);
        $html = "";
        $data_todo = $sql_todo->read_all_todo();
        if(gettype($data_todo)=="array")
        {
            foreach($data_todo as $value){
                $html.="<div>
                ".$value['objectif_todo'].
                "<form action='process_todo.php' method='POST'>
                <input type='hidden' name='function' value='modify'>
                <input type='hidden' name='id' value='".$value['id_todo']."'>
                <input type='text' name='newvalue'>
                <input type='submit' value='modifier'>
                </form>
                <form action='process_todo.php' method='POST'>
                <input type='hidden' name='function' value='delete'>
                <input type='hidden' name='id' value='".$value['id_todo']."'>
                <input type='submit' value='supprimer'>
                </form>
                </div>";
            } 
        }   
        $html.="<form action='process_todo.php' method='POST'>
        <input type='hidden' name='function' value='add'>
        <input type='text' name='objectif'>
        <input type='submit' value='ajouter'>
        </form>";
        
        return $html;
    }
?> 