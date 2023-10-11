<?php
    function process_login (){
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            include_once('sql_login.php');
            include_once('.\src\php\tool\http_info.php');
            $sql_login = new Sql_login($url_query,$body);
            if($_POST['function']=='login'){
                $result = $sql_login->read_login($_POST['email'],$_POST['password']);
                if($result=="error sql" || count($result)==0){
                    return "<div class='loading'><img src='/assets/img/loading-svgrepo-com.svg'></div>;
                    <meta http-equiv='refresh' content=\"0;URL='/'\"> ";
                }else{
                    $_SESSION['utilisateur']=[
                        "id"=>$result[0]['id_utilisateurs'],
                        "prenom"=>$result[0]['prenom_utilisateurs'],
                        "nom"=>$result[0]['nom_utilisateurs'],
                    ];
                    return "<div class='loading'><img src='/assets/img/loading-svgrepo-com.svg'></div>
                    <meta http-equiv='refresh' content=\"0;URL='/'\">";
                }
            }
            if($_POST['function']=='end'){
                $_SESSION=NULL;
                return "<div class='loading'><img src='/assets/img/loading-svgrepo-com.svg'></div>
                <meta http-equiv='refresh' content=\"0;URL='/'\">";
            }
        }   
    }
    $html = process_login();
?>