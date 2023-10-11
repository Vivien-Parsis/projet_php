<?php
    function html_login():string{
        return "<h2>Se connecter</h2>
        <div class='login_content'>
            <form action='process_login.php' method='POST'>
                <input type='hidden' name='function' value='login'>
                <label for='email'>email :</label><br>
                <input type='email' name='email' id='email' required><br>
                <label for='password'>mot de passe :</label><br>
                <input type='password' name='password' id='password' required><br>
                <input type='submit' value='se connecter'>
            </form>
            <a href='/sign_in'>creer un compte</a>
        </div>";
    }
    function html_add_login():string{
        return "<a href='/'>revenir a la page de connexion</a>
        <h2>Creer un compte</h2>
        <div class='login_content'>
            <form action='process_login.php' method='post'>
                <input type='hidden' name='function' value='add'>
                <label for='prenom'>Prenom :</label><br>
                <input type='text' name='prenom' id='prenom' required><br>
                <label for='nom'>Nom :</label><br>
                <input type='text' name='nom' id='nom' required><br>
                <label for='email'>Email :</label><br>
                <input type='email' name='email' id='email' required><br>
                <label for='password'>Mot de passe :</label><br>
                <input type='password' name='password' id='password' required><br>
                <input type='submit' value='Ajouter'>
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