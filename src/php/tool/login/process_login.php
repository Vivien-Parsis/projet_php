<?php
    function process_login (){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            require_once('sql_login.php');
            require_once('src\php\tool\http_info.php');
            $sql_login = new Sql_login();
            if($_POST['function']=='login'){
                $result = $sql_login->read_login($_POST['email'],$_POST['password']);
                if($result=="error sql" || count($result)==0){
                    require_once('src\php\component\alert.php');
                    echo alertJS("email et/ou mot de passe incorecte");
                    return;
                }else{
                    $_SESSION['utilisateur']=[
                        "id"=>$result[0]['id_utilisateurs'],
                        "prenom"=>$result[0]['prenom_utilisateurs'],
                        "nom"=>$result[0]['nom_utilisateurs'],
                    ];
                    return;
                }
            }
            if($_POST['function']=='end'){
                session_destroy();
                session_start();
                return "<div class='loading'><img src='/assets/img/loading-svgrepo-com.svg'></div>
                <meta http-equiv='refresh' content=\"0;URL='/'\">";
            }
            if($_POST['function']=='add'){
                $result = $sql_login->add_login($_POST['email'],$_POST['password'],$_POST['nom'],$_POST['prenom']);
                if($result=="error sql" || count($result)==0){
                    return;
                }
            }
        }   
    }
    process_login();
    require_once('src\php\component\redirect.php');
    $html = redirect('/',0);
?>