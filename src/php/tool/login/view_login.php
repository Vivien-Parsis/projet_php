<?php
    function html_login():string{
        return <<<HTML
        <h2>Se connecter</h2>
        <div class='login_content'>
            <form action='process_login.php' method='POST'>
                <input type='hidden' name='function' value='login'>
                <label for='email'>email :</label><br>
                <input type='email' name='email' id='email' autocomplete='off' required><br>
                <label for='password'>mot de passe :</label><br>
                <input type='password' name='password' id='password' required><br>
                <input type='submit' value='se connecter'>
            </form>
            <a href='/sign_in'>creer un compte</a>
        </div>
HTML;
    }
    function html_add_login():string{
        return <<<HTML
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
            <a href='/'>revenir a la page de connexion</a>
        </div>
HTML;
    }
    function html_handle_login():string{
        return <<<HTML
        <div class='connection_content'>
            <form action='process_login.php' method='POST' class='disconnect_form'>
                <input type='hidden' name='function' value='end'>
                <input type='submit' value='se deconnecter' class='disconnect_form_button'>
            </form>
            <a href='/modify_login'>modifier son mot de passe</a>
        </div>
HTML;
    }
    function html_modify_login():string{
        return <<<HTML
        <form action='process_login.php' method='POST' class='login_modify_form'>
            <input type='hidden' name='function' value='modify_password'>
            <label for='newpassword1'>Nouveau mot de passe</label>
            <input type='password' name='newpassword1' id='newpassword1' required>
            <label for='newpassword2'>Confirmer nouveau mot de passe</label>
            <input type='password' name='newpassword2' id='newpassword2' required>
            <input type='submit' value='modifier'>
        </form>
HTML;
    }
?>