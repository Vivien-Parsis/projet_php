<?php
function process_agenda (){
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include_once('sql_agenda.php');
        include_once('.\src\php\tool\http_info.php');
        $sql_agenda = new Sql_agenda($url_query,$body);
        if ($_POST["function"] === "add") {
            $currentStarthour = explode(":",explode("T",$_POST["startdate"])[1]);
            $currentEndhour = explode(":",explode("T",$_POST["enddate"])[1]);
            if((count(explode("T",$_POST["startdate"]))!=2 || count(explode("T",$_POST["enddate"]))!=2)||intval($currentStarthour[0])>intval($currentEndhour[0])||intval($currentStarthour[0])==intval($currentEndhour[0])&&intval($currentStarthour[1])>intval($currentEndhour[1])){
                return;
            }
            $StartDateTransform = explode("T",$_POST["startdate"])[0]." ".explode("T",$_POST["startdate"])[1].":00";
            $EndDateTransform = explode("T",$_POST["enddate"])[0]." ".explode("T",$_POST["enddate"])[1].":00";
            $sql_agenda->add_agenda($StartDateTransform,$EndDateTransform,$_POST["evenement"]);
        }
        if ($_POST["function"] === "default") {
            $sql_agenda->default_agenda();
        }
        if ($_POST["function"] === "modify") {
            $currentStarthour = explode(":",explode("T",$_POST["newstart"])[1]);
            $currentEndhour = explode(":",explode("T",$_POST["newend"])[1]);
            if((count(explode("T",$_POST["newstart"]))!=2 || count(explode("T",$_POST["newend"]))!=2)||intval($currentStarthour[0])>intval($currentEndhour[0])||intval($currentStarthour[0])==intval($currentEndhour[0])&&intval($currentStarthour[1])>intval($currentEndhour[1])){
                return;
            }
            $newstartTransform = explode("T",$_POST["newstart"])[0]." ".explode("T",$_POST["newstart"])[1].":00";
            $newendTransform = explode("T",$_POST["newend"])[0]." ".explode("T",$_POST["newend"])[1].":00";
            $sql_agenda->modify_agenda($_POST['id'],$newstartTransform,$newendTransform,$_POST["newevenement"]);
        }
        if ($_POST["function"] === "delete") {
            $sql_agenda->remove_agenda($_POST["id"]);
        }
        if ($_POST["function"] === "delete_all_user") {
            $sql_agenda->remove_all_user_agenda($_SESSION['utilisateur']['id']);
        }
    }   
}
    $html = "<div class='loading'><img src='/assets/img/loading-svgrepo-com.svg'></div>";
    process_agenda();
?>
<meta http-equiv="refresh" content="0;URL='/agenda'"> 