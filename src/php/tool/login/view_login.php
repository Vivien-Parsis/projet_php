<?php
    function html_login():string{
        return "<h2>Authentification</h2>
        <div class='login_content'>
            <form action='process_login.php' method='POST'>
                <input type='hidden' name='function' value='login'>
                <label for='email'>email :</label><br>
                <input type='email' name='email' id='email'><br>
                <label for='password'>mot de passe :</label><br>
                <input type='password' name='password' id='password'><br>
                <input type='submit' value='se connecter'>
            </form>
        </div>";
    }
    function html_end_login():string{
        return "<form action='process_login.php' method='POST' class='disconnect_form'>
            <input type='hidden' name='function' value='end'>
            <input type='submit' value='se deconnecter'>
        </form>";
    }
    
?>