<?php
    function html_todo():string{
        require_once('src/php/tool/todo/process_todo.php');
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $html = <<<HTML
                <form methode='GET' class='form_search'>
                    <input type='text' placeholder='search by objectif...' name='search' value='$search' autocomplete='off'>
                    <label for='search'><img src='/assets/img/search-alt-2-svgrepo-com.svg'></label>
                    <input type='submit' value='recherche' id='search'>
                </form>
HTML;
        $index = 0;
        $data_todo = get_todo();
        if(gettype($data_todo)=="array")
        {
            foreach($data_todo as $value){
                if(!str_starts_with(strtolower($value['objectif_todo']),strtolower($search))){
                    continue;
                }
                $index++;
                $checked = $value['done_todo']==0 ? "" : "checked";
                $currentClassContent = "todo_content";
                $currentClassContent .= $checked==="checked" ? " todo_content_check": ($index%2==0 ? " todo_content_altcol" : ""); 
                $html.=<<<HTML
                <div class='{$currentClassContent}'>
                <span class='$checked'>
                    <form action='process_todo.php' method='POST' class='todo_form_done' id='check$value[id_todo]'>
                        <input type='hidden' name='function' value='check'>
                        <input type='hidden' name='id' value='$value[id_todo]'>
                        <input type='hidden' name='done' value='$value[done_todo]'>
                        <input type='checkbox' onchange='update($value[id_todo])' id='done$value[id_todo]' $checked>
                    </form>
                    $value[objectif_todo]
                </span>
                <button class='view_modify' onclick='toggleModify($value[id_todo])'>modifier</button>
                <form action='process_todo.php' method='POST' style='display:none' class='todo_form_modify' id='todo_form_modify$value[id_todo]'>
                    <input type='hidden' name='function' value='modify'>
                    <input type='hidden' name='id' value='$value[id_todo]'>
                    <textarea name='newvalue' cols='100' rows='2' maxlength='1000' required></textarea>
                    <input type='submit' value='envoyer' onclick='hideModify($value[id_todo])'>
                </form>
                <form action='process_todo.php' method='POST' class='todo_form_remove'>
                    <input type='hidden' name='function' value='delete'>
                    <input type='hidden' name='id' value='$value[id_todo]'>
                    <input type='submit' value='supprimer'>
                </form>
                </div>
HTML;
            } 
        }   
        $html.= <<<HTML
        <form action='process_todo.php' method='POST' class='todo_form_add'>
            <input type='hidden' name='function' value='add'>
            <textarea name='objectif' cols='100' rows='2' maxlength='1000' required></textarea>
            <input type='submit' value='ajouter'>
        </form>
        <form action='process_todo.php' method='POST' class='todo_form_remove_all'>
            <input type='hidden' name='function' value='delete_all_user'>
            <input type='submit' value='tout supprimer'>
        </form>
        <form action='process_todo.php' method='POST' class='todo_form_default'>
            <input type='hidden' name='function' value='default'>
            <input type='submit' value='todolist par defaut'>
        </form>
HTML;
        return $html;
    }
?>

<script src='assets/js/TodoModify.js'></script>