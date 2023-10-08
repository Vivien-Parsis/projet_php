<?php
    $html = "<span>redirection</span>";
    require_once('./src/php/tool/todo/process_todo.php');
    process_todo ();
?>
<meta http-equiv="refresh" content="0;URL='/todo'">