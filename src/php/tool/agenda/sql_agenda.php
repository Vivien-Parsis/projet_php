<?php
  require_once('src\php\tool\sql\handle_sql.php');
  class Sql_agenda{
    private static string $dbname = "php_project";
    private array|null $url_query;
    private array|null  $http_body;

    function __construct(array|null $url_query, array|null $http_body){
      $this->url_query=$url_query;
      $this->http_body=$http_body;
    }
    function add_agenda(string $startDate, string $endDate, string $event){
      //traiter les heures, début > fin ou pas
      $query="";
      return connect_sql($query);
    }
    function default_agenda(){
      $query='insert into agenda (evenement_agenda,date_debut_agenda,date_fin_agenda) values 
      ("cours français", "2023-04-23 12:00:00","2023-04-23 13:00:00"),("cours philo", "2023-04-23 08:00:00","2023-04-23 09:00:00"),
      ("cours math", "2023-11-02 16:00:00","2023-11-02 18:00:00"),("cours info", "2023-10-25 11:00:00","2023-10-25 17:00:00"),
      ("anniversaire de untel", "2023-12-23 12:00:00","2023-12-23 13:00:00")';
      $this->remove_all_agenda();
      return connect_sql($query);
    }
    function read_all_agenda():array{
      $query="select * from agenda order by date_debut_agenda asc";
      return connect_sql($query);
    }
    function remove_agenda(string $id){
      if(!check_id($id)){
        return;
      }
      $query="delete from agenda where id_agenda=$id";
      return connect_sql($query);
    }
    function remove_all_agenda(){
      $query="delete from agenda";
      return connect_sql($query);
    }
    function modify_agenda(string $id, string $newvalue){
      if(!check_id($id)){
        return;
      }
      $query="";
      return connect_sql($query);
    }
  }
  function check_id(string $id):bool{
    return ctype_digit($id);
  }
?>