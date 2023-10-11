<?php
    function process_login (){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            include_once('sql_login.php');
            include_once('.\src\php\tool\http_info.php');
            $sql_login = new Sql_login();
            if($_POST['function']=='login'){
                $result = $sql_login->read_login($_POST['email'],$_POST['password']);
                if($result=="error sql" || count($result)==0){
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
                return;
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
    include_once('.\src\php\component\redirect.php');
    $html = redirect('/',0);
?>