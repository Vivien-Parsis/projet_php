<?php
    require_once('src/php/tool/sql/handle_sql.php');
    require_once('src/php/tool/sql/handle_query.php');
    class Sql_login{
        static function add_login(string $email, string $password, string $nom, string $prenom):array|string{
            if(!check_exist($email) || !check_exist($password) || !check_exist($prenom) || !check_exist($nom)){
                require_once('src/php/component/alert.php');
                echo alertJS("error");
                return [];
            }
            if(!check_illegal_sequence($email) || !check_illegal_sequence($password) || !check_illegal_sequence($prenom) || !check_illegal_sequence($nom)){
                require_once('src/php/component/alert.php');
                echo alertJS("error illegal sequence");
                return [];
            }
            if(!check_email($email)){
                require_once('src/php/component/alert.php');
                echo alertJS("invalid email");
                return [];
            }
            $listofmails = self::read_all_mail();
            foreach($listofmails as $mail){
                if($mail["mail_utilisateurs"] ===$email){
                    require_once('src/php/component/alert.php');
                    echo alertJS("email already use");
                    return [];
                }
            }
            $query="insert into utilisateurs (mail_utilisateurs, password_utilisateurs, prenom_utilisateurs, nom_utilisateurs) value ('$email','$password','$prenom','$nom')";
            return connect_sql($query);
        }
        static function read_all_mail():array{
            $query="select mail_utilisateurs from utilisateurs";
            return connect_sql($query);
        }
        static function read_login(string $email, string $password):array{
            if(!check_exist($email) || !check_exist($password)){
                require_once('src/php/component/alert.php');
                echo alertJS("error");
                return [];
            }
            if(!check_illegal_sequence($email) || !check_illegal_sequence($password)){
                require_once('src/php/component/alert.php');
                echo alertJS("error illegal sequence");
                return [];
            }
            if(!check_email($email)){
                require_once('src/php/component/alert.php');
                echo alertJS("invalid email");
                return [];
            }
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $query="select * from utilisateurs where mail_utilisateurs='$email' and password_utilisateurs='$password'";
            return connect_sql($query);
        }
        static function modify_password_login(string $id, string $newPassword):array|string{
            if(!check_id($id) || !check_exist($newPassword)){
                require_once('src/php/component/alert.php');
                echo alertJS("error");
                return [];
            }
            if(!check_illegal_sequence($newPassword)){
                require_once('src/php/component/alert.php');
                echo alertJS("error");
                return [];
            }
            $query="update utilisateurs set password_utilisateurs='$newPassword' where id_utilisateurs='$id'";
            return connect_sql($query);
        }
        static function delete_login(string $id):array|string{
            if(!check_id($id)){
                require_once('src/php/component/alert.php');
                echo alertJS("error unknow id");
                return [];
            }
            $query="delete from utilisateurs where id_utilisateurs='$id'";
            return connect_sql($query);
        }
    }
?>