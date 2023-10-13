<?php
  require_once('src\php\tool\sql\handle_sql.php');
  require_once('src\php\tool\sql\handle_query.php');
  class Sql_agenda{
    function add_agenda(string $startDate, string $endDate, string $event, string $id_user){
      if(!check_id($id_user) || !check_exist($startDate) || !check_exist($endDate) || !check_exist($event)){
        require_once('src\php\component\alert.php');
        echo alertJS("error");
        return;
      }
      if(!check_illegal_sequence($startDate) || !check_illegal_sequence($endDate) || !check_illegal_sequence($event)){
        require_once('src\php\component\alert.php');
        echo alertJS("error illegal sequence");
        return;
      }
      $currentStarthour = explode(":",explode("T",$startDate)[1]);
      $currentEndhour = explode(":",explode("T",$endDate)[1]);
      $currentStartdate = explode("-",explode("T",$startDate)[0]);
      $currentEnddate = explode("-",explode("T",$endDate)[0]);
      if((count(explode("T",$startDate))!=2||count(explode("T",$endDate))!=2)||count($currentStarthour)!=2||count($currentEndhour)!=2||count($currentStartdate)!=3||count($currentEnddate)!=3){
          require_once('src\php\component\alert.php');
          echo alertJS("format de date incorect");
          return;
      }
      if(intval($currentStartdate[0],10)>intval($currentEnddate[0],10)
      ||(intval($currentStartdate[0],10)==intval($currentEnddate[0],10)&&intval($currentStartdate[1],10)>intval($currentEnddate[1],10))
      ||(intval($currentStartdate[0],10)==intval($currentEnddate[0],10)&&intval($currentStartdate[1],10)==intval($currentEnddate[1],10)&&intval($currentStartdate[2],10)>intval($currentEnddate[2],10))){
          require_once('src\php\component\alert.php');
          echo alertJS("erreur, date de fin anterieur a la date de début");
          return;
      }
      if(intval($currentStarthour[0],10)>intval($currentEndhour[0],10)
      ||(intval($currentStarthour[0],10)==intval($currentEndhour[0],10)&&intval($currentStarthour[1],10)>intval($currentEndhour[1],10))){
          require_once('src\php\component\alert.php');
          echo alertJS("erreur, heure de fin anterieur a la heure de début");
          return;
      }
      $StartDateTransform = explode("T",$startDate)[0]." ".explode("T",$startDate)[1].":00";
      $EndDateTransform = explode("T",$endDate)[0]." ".explode("T",$endDate)[1].":00";
      $query="INSERT INTO agenda (evenement_agenda,date_debut_agenda,date_fin_agenda,id_utilisateurs) values ('$event','$StartDateTransform','$EndDateTransform','$id_user')";
      return connect_sql($query);
    }
    function default_user_agenda(string $id_user){
      $query="INSERT INTO agenda (id_utilisateurs,evenement_agenda,date_debut_agenda,date_fin_agenda) values 
      ($id_user,'cours français', '2023-04-23 12:00:00','2023-04-23 13:00:00'),($id_user,'cours philo', '2023-04-23 08:00:00','2023-04-23 09:00:00'),
      ($id_user,'cours math', '2023-11-02 16:00:00','2023-11-02 18:00:00'),($id_user,'cours info', '2023-10-25 11:00:00','2023-10-25 17:00:00'),
      ($id_user,'anniversaire de untel', '2023-12-23 12:00:00','2023-12-23 13:00:00')";
      $this->remove_all_agenda();
      return connect_sql($query);
    }
    function read_all_agenda():array{
      $query="select * from agenda order by date_debut_agenda asc";
      return connect_sql($query);
    }
    function read_all_user_agenda(string $id_user):array{
      if(!check_id($id_user)){
        require_once('src\php\component\alert.php');
        echo alertJS("error id");
        return [];
      }
      $query="select * from agenda where id_utilisateurs=$id_user order by date_debut_agenda asc";
      return connect_sql($query);
    }
    function remove_agenda(string $id){
      if(!check_id($id)){
        require_once('src\php\component\alert.php');
        echo alertJS("error id");
        return;
      }
      $query="delete from agenda where id_agenda=$id";
      return connect_sql($query);
    }
    function remove_all_agenda(){
      $query="delete from agenda";
      return connect_sql($query);
    }
    function remove_all_user_agenda(string $id_user){
      if(!check_id($id_user)){
        require_once('src\php\component\alert.php');
        echo alertJS("error id");
        return;
      }
      $query="delete from agenda where id_utilisateurs=$id_user";
      return connect_sql($query);
    }
    function modify_agenda(string $id, string $startDate, string $endDate, string $event){
      if(!check_id($id) || !check_exist($startDate) || !check_exist($endDate) || !check_exist($event)){
        require_once('src\php\component\alert.php');
        echo alertJS("error");
        return;
      }
      if(!check_illegal_sequence($startDate) || !check_illegal_sequence($endDate) || !check_illegal_sequence($event)){
        require_once('src\php\component\alert.php');
        echo alertJS("error illegal sequence");
        return;
      }
      $currentStarthour = explode(":",explode("T",$_POST["newstart"])[1]);
      $currentEndhour = explode(":",explode("T",$_POST["newend"])[1]);
      if((count(explode("T",$startDate))!=2 || count(explode("T",$endDate))!=2)){
          require_once('src\php\component\alert.php');
          echo alertJS("format de date incorect");
          return;
      }
      if(intval($currentStarthour[0],10)>intval($currentEndhour[0],10)||intval($currentStarthour[0],10)==intval($currentEndhour[0],10)&&intval($currentStarthour[1],10)>intval($currentEndhour[1],10)){
          require_once('src\php\component\alert.php');
          echo alertJS("erreur, date de fin anterieur a la date de début");
          return;
      }
      $newstartTransform = explode("T",$_POST["newstart"])[0]." ".explode("T",$_POST["newstart"])[1].":00";
      $newendTransform = explode("T",$_POST["newend"])[0]." ".explode("T",$_POST["newend"])[1].":00";
      $query="update agenda set evenement_agenda='$event', date_debut_agenda='$newstartTransform', date_fin_agenda='$newendTransform' where id_agenda=$id";
      return connect_sql($query);
    }
  }
?>