<?php
  require_once('src\php\tool\sql\handle_sql.php');
  class Sql_login{
    private static string $dbname = "php_project";
    private array|null $url_query;
    private array|null  $http_body;

    function __construct(array|null $url_query, array|null $http_body){
      $this->url_query=$url_query;
      $this->http_body=$http_body;
    }
    function add_login(string $startDate, string $endDate, string $event){
      $query="";
      return connect_sql($query);
    }
    function default_login(){
      $query='';
      $this->remove_all_login();
      return connect_sql($query);
    }
    function read_login(string $email, string $password):array{
      $query="select * from utilisateurs where mail_utilisateurs='$email' and password_utilisateurs='$password'";
      return connect_sql($query);
    }
    function remove_login(string $id){
      if(!check_id($id)){
        return;
      }
      $query="";
      return connect_sql($query);
    }
    function remove_all_login(){
      $query="";
      return connect_sql($query);
    }
    function modify_login(string $id, string $startDate, string $endDate, string $event){
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