<?php
    require_once('src/php/component/redirect.php');
    function process_login(){
        if($_SERVER["REQUEST_METHOD"] ==="POST"){
            require_once('sql_login.php');
            if($_POST['function'] === 'login'){
                $result = Sql_login::read_login($_POST['email'],$_POST['password']);
                if($result=="error sql" || count($result)==0){
                    require_once('src/php/component/alert.php');
                    echo alertJS("email et/ou mot de passe incorecte");
                    return redirect('/',0);
                }else{
                    $_SESSION['utilisateur']=[
                        "id"=>$result[0]['id_utilisateurs'],
                        "prenom"=>$result[0]['prenom_utilisateurs'],
                        "nom"=>$result[0]['nom_utilisateurs']
                    ];
                    return redirect('/',0);
                }
            }
            if($_POST['function'] === 'end'){
                session_destroy();
                session_start();
                return redirect('/',0);
            }
            if($_POST['function'] === 'delete'){
                $result = Sql_login::delete_login($_SESSION['utilisateur']['id']);
                session_destroy();
                session_start();
                return redirect('/',0);
            }
            if($_POST['function'] === 'add'){
                $result = Sql_login::add_login($_POST['email'],$_POST['password'],$_POST['nom'],$_POST['prenom']);
                if($result=="error sql" || count($result)==0){
                    return redirect('/',0);
                }
            }
            if($_POST['function'] === 'modify_password'){
                if($_POST['newpassword1']!==$_POST['newpassword2']){
                    require_once('src/php/component/alert.php');
                    echo alertJS("passwords does not match");
                    require_once('src/php/component/redirect.php');
                    return redirect('/modify_login',0);
                }else{
                    $newpassword=$_POST['newpassword1'];
                }
                $result = Sql_login::modify_password_login($_SESSION['utilisateur']['id'],$newpassword);
                if($result=="error sql" || count($result)==0){
                    return redirect('/',0);
                }
            }
        }   
    }
    $html = process_login();
?>