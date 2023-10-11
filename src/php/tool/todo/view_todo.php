<?php
    function html_todo():string{
        require_once('.\src\php\tool\todo\sql_todo.php');
        include('.\src\php\tool\http_info.php');
        $sql_todo = new Sql_todo($url_query, $body);
        $html = "";
        $data_todo = $sql_todo->read_todo($_SESSION['utilisateur']['id']);
        if(gettype($data_todo)=="array")
        {
            foreach($data_todo as $value){
                $checked = $value['done_todo']==0?"":"checked";
                $html.="<div class='todo_content'>
                <span class='$checked'>
                    <form action='process_todo.php' method='POST' class='todo_form_done' id='check$value[id_todo]'>
                        <input type='hidden' name='function' value='check'>
                        <input type='hidden' name='id' value='$value[id_todo]'>
                        <input type='hidden' name='done' value='$value[done_todo]'>
                        <input type='checkbox' onchange='update($value[id_todo])' id='done$value[id_todo]' $checked>
                    </form>
                    $value[objectif_todo]
                </span>
                <button onclick='toggleModify($value[id_todo])'>modifier</button>
                <form action='process_todo.php' method='POST' style='display:none' class='todo_form_modify' id='todo_form_modify$value[id_todo]'>
                    <input type='hidden' name='function' value='modify'>
                    <input type='hidden' name='id' value='$value[id_todo]'>
                    <textarea name='newvalue' cols='100' rows='2' maxlength='1000'></textarea>
                    <input type='submit' value='envoyer' onclick='hideModify($value[id_todo])'>
                </form>
                <form action='process_todo.php' method='POST' class='todo_form_remove'>
                    <input type='hidden' name='function' value='delete'>
                    <input type='hidden' name='id' value='$value[id_todo]'>
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
            <input type='hidden' name='function' value='delete_all_user'>
            <input type='submit' value='tout supprimer'>
        </form>
        <form action='process_todo.php' method='POST' class='todo_form_default'>
            <input type='hidden' name='function' value='default'>
            <input type='submit' value='reset'>
        </form>";
        return $html;
    }
?>

<script src='assets/js/TodoModify.js'></script>