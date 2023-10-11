<?php
  require_once('src\php\tool\sql\handle_sql.php');
  require_once('src\php\tool\sql\handle_query.php');
  class Sql_login{
    function add_login(string $email, string $password, string $nom, string $prenom){
      if(!check_exist($email) || !check_exist($password) || !check_exist($prenom) || !check_exist($nom)){
        return [];
      }
      $query="insert into utilisateurs (mail_utilisateurs, password_utilisateurs, prenom_utilisateurs, nom_utilisateurs) value ('$email','$password','$prenom','$nom')";
      return connect_sql($query);
    }
    function read_login(string $email, string $password):array{
      if(!check_exist($email) || !check_exist($password)){
        return [];
      }
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      $query="select * from utilisateurs where mail_utilisateurs='$email' and password_utilisateurs='$password'";
      return connect_sql($query);
    }
  }
?>