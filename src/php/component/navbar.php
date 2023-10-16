<?php
    $navbar = '';
    if(isset($_SESSION['utilisateur'])){
        $navbar ='<nav>
            <a href="/" alt="home">
                home
            </a>
            <a href="/todo" alt="todo">
                todo
            </a>
            <a href="/agenda" alt="agenda">
                agenda
            </a>
        </nav>';
    }
?>