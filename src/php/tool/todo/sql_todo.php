<?php
  require_once('src\php\tool\sql\handle_sql.php');
  class Sql_todo{
    private static string $dbname = "php_project";
    private array|null $url_query;
    private array|null  $http_body;

    function __construct(array|null $url_query, array|null $http_body){
      $this->url_query=$url_query;
      $this->http_body=$http_body;
    }

    function add_todo(string $objective){
      $query="insert into todo(objectif_todo,done) value ('$objective',0)";
      return connect_sql($query);
    }

    function read_all_todo():array{
      $query="select * from todo";
      return connect_sql($query);
    }
    function remove_todo(string $id){
      $query="DELETE FROM todo WHERE id_todo=$id";
      return connect_sql($query);
    }
    function remove_all_todo(int $id){
      $query="";
      return connect_sql($query);
    }
    function modify_todo(string $id, string $newvalue){
      $query="";
      return connect_sql($query);
    }
  }


?>