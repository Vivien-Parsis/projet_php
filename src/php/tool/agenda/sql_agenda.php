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
      $query="INSERT INTO agenda (evenement_agenda,date_debut_agenda,date_fin_agenda) values ('$event','$startDate','$endDate')";
      return connect_sql($query);
    }
    function default_agenda(){
      $query='INSERT INTO agenda (id_agenda,id_utilisateurs,evenement_agenda,date_debut_agenda,date_fin_agenda) values 
      (1,2,"cours français", "2023-04-23 12:00:00","2023-04-23 13:00:00"),(2,2,"cours philo", "2023-04-23 08:00:00","2023-04-23 09:00:00"),
      (3,1,"cours math", "2023-11-02 16:00:00","2023-11-02 18:00:00"),(4,1,"cours info", "2023-10-25 11:00:00","2023-10-25 17:00:00"),
      (5,3,"anniversaire de untel", "2023-12-23 12:00:00","2023-12-23 13:00:00")';
      $this->remove_all_agenda();
      return connect_sql($query);
    }
    function read_all_agenda():array{
      $query="select * from agenda order by date_debut_agenda asc";
      return connect_sql($query);
    }
    function read_all_user_agenda($id_user):array{
      if(!check_id($id_user)){
        return [];
      }
      $query="select * from agenda where id_utilisateurs=$id_user order by date_debut_agenda asc";
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
    function remove_all_user_agenda(string $id_user){
      if(!check_id($id_user)){
        return;
      }
      $query="delete from agenda where id_utilisateurs=$id_user";
      return connect_sql($query);
    }
    function modify_agenda(string $id, string $startDate, string $endDate, string $event){
      if(!check_id($id)){
        return;
      }
      $query="update agenda set evenement_agenda='$event', date_debut_agenda='$startDate', date_fin_agenda='$endDate' where id_agenda=$id";
      return connect_sql($query);
    }
  }
  function check_id(string $id):bool{
    return ctype_digit($id);
  }
?>