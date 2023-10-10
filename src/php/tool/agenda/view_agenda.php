<?php
    function html_agenda():string{
        require_once('.\src\php\tool\agenda\sql_agenda.php');
        include('.\src\php\tool\http_info.php');
        $sql_agenda = new Sql_agenda($url_query, $body);
        $html = "";
        $data_agenda = $sql_agenda->read_all_agenda();
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
                </div>";
            } 
        }   
        $html.="
        <form action='process_agenda.php' method='POST' class='agenda_form_add'>
            <input type='hidden' name='function' value='add'>
            <input type='datetime-local' name='startdate'>
            <input type='datetime-local' name='enddate'>
            <input type='text' name='evenement' placeholder='evenement' max-length='150'>
            <input type='submit' value='ajouter'>
        </form>
        <form action='process_agenda.php' method='POST' class='agenda_form_default'>
            <input type='hidden' name='function' value='default'>
            <input type='submit' value='reset'>
        </form>
        <form action='process_agenda.php' method='POST' class='agenda_form_remove_all'>
            <input type='hidden' name='function' value='delete_all'>
            <input type='submit' value='tout supprimer'>
        </form>";
        return $html;
    }
?>

<script src='assets/js/modify.js'></script>