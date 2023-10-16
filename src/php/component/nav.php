<?php
    $navbar = '';
    require_once('src\php\tool\http_info.php');
    if(isset($_SESSION['utilisateur'])){
        $activanchor = [
            'index' => $path=='/' ? "active_anchor" : "",
            'todo' => $path=='/todo' ? "active_anchor" : "",
            'agenda' => $path=='/agenda' ? "active_anchor" : "",
        ];
        $nav .=<<<HTML
        <nav>
            <a href='/' class='$activanchor[index]' alt='home'>
                home
            </a>
            <a href='/todo' class='$activanchor[todo]' alt='todo'>
                todo
            </a>
            <a href='/agenda' class='$activanchor[agenda]' alt='agenda'>
                agenda
            </a>
        </nav>
HTML;
    }
?>