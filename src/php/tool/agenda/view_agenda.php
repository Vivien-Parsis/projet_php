<?php
    function html_agenda():string{
        require_once('src/php/tool/agenda/process_agenda.php');
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $html = <<<HTML
        <form methode='GET' class='form_search'>
            <input type='text' placeholder='search by event...' name='search' value='$search' autocomplete='off'>
            <label for='search'><img src='/assets/img/search-alt-2-svgrepo-com.svg'></label>
            <input type='submit' value='recherche' id='search'>
        </form>
HTML;
        $index = 0;
        $data_agenda = get_agenda();
        $todayDate = explode("-",date('Y-m-d'));
        $todayDate = [
            'day'=>explode("-",date('Y-m-d'))[2],
            'month'=>explode("-",date('Y-m-d'))[1],
            'year'=>explode("-",date('Y-m-d'))[0]
        ];
        if(gettype($data_agenda)=="array")
        {
            foreach($data_agenda as $value){
                if(!str_starts_with(strtolower($value['evenement_agenda']),strtolower($search)) || count(explode(" ",$value['date_debut_agenda']))!=2){
                    continue;
                }
                $index++;
                $DateDebutString = explode(" ",$value['date_debut_agenda'])[0]; 
                $HourDebutString = explode(" ",$value['date_debut_agenda'])[1]; 
                $DateFinString = explode(" ",$value['date_fin_agenda'])[0]; 
                $HourFinString = explode(" ",$value['date_fin_agenda'])[1]; 
                $currentStart = [
                    'date' => [
                        'day'=>explode("-",$DateDebutString)[2],
                        'month'=>explode("-",$DateDebutString)[1],
                        'year'=>explode("-",$DateDebutString)[0]
                    ],
                    'hour' => [
                        'sec'=>explode(":",$HourDebutString)[2],
                        'min'=>explode(":",$HourDebutString)[1],
                        'hour'=>explode(":",$HourDebutString)[0]
                    ]
                ];
                $currentEnd = [
                    'date' => [
                        'day'=>explode("-",$DateFinString)[2],
                        'month'=>explode("-",$DateFinString)[1],
                        'year'=>explode("-",$DateFinString)[0]
                    ],
                    'hour' => [
                        'sec'=>explode(":",$HourFinString)[2],
                        'min'=>explode(":",$HourFinString)[1],
                        'hour'=>explode(":",$HourFinString)[0]
                    ]
                ];
                $pastEvent = $todayDate['year']>$currentEnd['date']['year']||($todayDate['year']===$currentEnd['date']['year']&&$todayDate['month']>$currentEnd['date']['month'])||($todayDate['year']===$currentEnd['date']['year']&&$todayDate['month']===$currentEnd['date']['month']&&$todayDate['day']>$currentEnd['date']['day']);
                $currentClassContent = 'agenda_content';
                $currentClassContent .= $pastEvent ? " agenda_content_pastEvent" : ($index%2==0 ? " agenda_content_altcol" : null); 
                $html.=<<<HTML
                <div class='{$currentClassContent}'>
                <span>
                    {$currentStart['date']['day']}/{$currentStart['date']['month']}/{$currentStart['date']['year']}
                    -
                    {$currentStart['hour']['hour']}h{$currentStart['hour']['min']}
                    >
                    {$currentEnd['date']['day']}/{$currentEnd['date']['month']}/{$currentEnd['date']['year']}
                    -
                    {$currentEnd['hour']['hour']}h{$currentEnd['hour']['min']}
                    <br>$value[evenement_agenda]
                </span>
                <button class='view_modify' onclick='toggleModify($value[id_agenda])'>modifier</button>
                <form action='process_agenda.php' method='POST' style='display:none' class='agenda_form_modify' id='agenda_form_modify$value[id_agenda]'>
                    <input type='hidden' name='function' value='modify'>
                    <input type='hidden' name='id' value='$value[id_agenda]'>
                    <input type='datetime-local' name='newstart' value='{$DateDebutString}T{$HourDebutString}'>
                    <input type='datetime-local' name='newend' value='{$DateFinString}T{$HourFinString}'>
                    <input type='text' name='newevenement' placeholder='evenement' autocomplete='off' max-length='150' value='$value[evenement_agenda]'>
                    <input type='submit' value='modifier'>
                </form>
                <form action='process_agenda.php' class='agenda_form_remove' method='POST'>
                    <input type='hidden' name='function' value='delete'>
                    <input type='hidden' name='id' value='$value[id_agenda]'>
                    <input type='submit' value='supprimer'>
                </form>
                </div>
HTML;
            } 
        }   
        $html.=<<<HTML
        <form action='process_agenda.php' method='POST' class='agenda_form_add'>
            <input type='hidden' name='function' value='add'>
            <input type='datetime-local' name='startdate' required>
            <input type='datetime-local' name='enddate' required>
            <input type='text' name='evenement' placeholder='evenement' autocomplete='off' max-length='150' required>
            <input type='submit' value='ajouter'>
        </form>
        <form action='process_agenda.php' method='POST' class='agenda_form_default'>
            <input type='hidden' name='function' value='default'>
            <input type='submit' value='agenda par defaut'>
        </form>
        <form action='process_agenda.php' method='POST' class='agenda_form_remove_all'>
            <input type='hidden' name='function' value='delete_all_user'>
            <input type='submit' value='tout supprimer'>
        </form>
HTML;
        return $html;
    }
?>
<script src='assets/js/AgendaModify.js'></script>