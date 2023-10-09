<?php
    function html_todo():string{
        require_once('.\src\php\tool\todo\sql_todo.php');
        include('.\src\php\http_info.php');
        $sql_todo = new Sql_todo($url_query, $body);
        $html = "";
        $data_todo = $sql_todo->read_all_todo();
        if(gettype($data_todo)=="array")
        {
            foreach($data_todo as $value){
                $html.="<div class='todo_content'>
                <span>".$value['objectif_todo']."</span>
                <button onclick='toggleModify(".$value['id_todo'].")'>modifier</button>
                <form action='process_todo.php' method='POST' style='display:none' class='todo_form_modify' id='todo_form_modify".$value['id_todo']."'>
                    <input type='hidden' name='function' value='modify'>
                    <input type='hidden' name='id' value='".$value['id_todo']."'>
                    <textarea name='newvalue' cols='100' rows='2' maxlength='1000'></textarea>
                    <input type='submit' value='envoyer' onclick='hideModify(".$value['id_todo'].")'>
                </form>
                <form action='process_todo.php' method='POST' class='todo_form_remove'>
                    <input type='hidden' name='function' value='delete'>
                    <input type='hidden' name='id' value='".$value['id_todo']."'>
                    <input type='submit' value='supprimer'>
                </form>
                </div>";
            } 
        }   
        $html.="<form action='process_todo.php' method='POST' class='todo_form_add'>
            <input type='hidden' name='function' value='add'>
            <textarea name='objectif' cols='100' rows='2' maxlength='1000'></textarea>
            <input type='submit' value='ajouter'>
        </form>
        <form action='process_todo.php' method='POST' class='todo_form_remove_all'>
            <input type='hidden' name='function' value='delete_all'>
            <input type='submit' value='tout supprimer'>
        </form>";
        return $html;
    }
?>

<script src='assets/js/modify.js'></script>