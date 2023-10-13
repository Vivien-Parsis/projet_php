<?php
    function html_agenda():string{
        require_once('src\php\tool\agenda\sql_agenda.php');
        require_once('src\php\tool\http_info.php');
        $sql_agenda = new Sql_agenda();
        $html = "";
        $data_agenda = $sql_agenda->read_all_user_agenda($_SESSION['utilisateur']['id']);
        if(gettype($data_agenda)=="array")
        {
            foreach($data_agenda as $value){
                $DateDebutString = explode(" ",$value['date_debut_agenda'])[0]; 
                $HourDebutString = explode(" ",$value['date_debut_agenda'])[1]; 
                $DateFinString = explode(" ",$value['date_fin_agenda'])[0]; 
                $HourFinString = explode(" ",$value['date_fin_agenda'])[1]; 
                $CurrentDateDebut = [
                    'day'=>explode("-",$DateDebutString)[2],
                    'month'=>explode("-",$DateDebutString)[1],
                    'year'=>explode("-",$DateDebutString)[0]];
                $CurrentHourDebut = [
                    'sec'=>explode(":",$HourDebutString)[2],
                    'min'=>explode(":",$HourDebutString)[1],
                    'hour'=>explode(":",$HourDebutString)[0]
                ];
                $CurrentDateFin = [
                    'day'=>explode("-",$DateFinString)[2],
                    'month'=>explode("-",$DateFinString)[1],
                    'year'=>explode("-",$DateFinString)[0]];
                $CurrentHourFin = [
                    'sec'=>explode(":",$HourFinString)[2],
                    'min'=>explode(":",$HourFinString)[1],
                    'hour'=>explode(":",$HourFinString)[0]
                ];
                $html.="<div class='agenda_content'>
                <span>
                $CurrentDateDebut[day]/$CurrentDateDebut[month]/$CurrentDateDebut[year] - ".$CurrentHourDebut["hour"]."h".$CurrentHourDebut["min"]." 
                >
                $CurrentDateFin[day]/$CurrentDateFin[month]/$CurrentDateFin[year] - ".$CurrentHourFin["hour"]."h".$CurrentHourFin["min"].
                "<br>$value[evenement_agenda] 
                </span>
                <form action='process_agenda.php' class='agenda_form_remove' method='POST'>
                    <input type='hidden' name='function' value='delete'>
                    <input type='hidden' name='id' value='$value[id_agenda]'>
                    <input type='submit' value='supprimer'>
                </form>
                <button onclick='toggleModify($value[id_agenda])'>modifier</button>
                <form action='process_agenda.php' method='POST' style='display:none' class='agenda_form_modify' id='agenda_form_modify$value[id_agenda]'>
                    <input type='hidden' name='function' value='modify'>
                    <input type='hidden' name='id' value='$value[id_agenda]'>
                    <input type='datetime-local' name='newstart' value='$DateDebutString".'T'."$HourDebutString'>
                    <input type='datetime-local' name='newend' value='$DateFinString".'T'."$HourFinString'>
                    <input type='text' name='newevenement' placeholder='evenement' autocomplete='off' max-length='150' value='$value[evenement_agenda]'>
                    <input type='submit' value='modifier'>
                </form>
                </div>";
            } 
        }   
        $html.="
        <form action='process_agenda.php' method='POST' class='agenda_form_add'>
            <input type='hidden' name='function' value='add'>
            <input type='datetime-local' name='startdate' required>
            <input type='datetime-local' name='enddate' required>
            <input type='text' name='evenement' placeholder='evenement' autocomplete='off' max-length='150' required>
            <input type='submit' value='ajouter'>
        </form>
        <form action='process_agenda.php' method='POST' class='agenda_form_default'>
            <input type='hidden' name='function' value='default'>
            <input type='submit' value='reset'>
        </form>
        <form action='process_agenda.php' method='POST' class='agenda_form_remove_all'>
            <input type='hidden' name='function' value='delete_all_user'>
            <input type='submit' value='tout supprimer'>
        </form>";
        return $html;
    }
?>
<script src='assets/js/AgendaModify.js'></script>