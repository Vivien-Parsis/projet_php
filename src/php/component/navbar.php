<?php
    if(isset($_SESSION['utilisateur'])){
        $navbar = 
        '<nav>
            <a href="/">home</a>
            <a href="/todo">todo</a>
            <a href="/agenda">agenda</a>
        </nav>';
    }
?>