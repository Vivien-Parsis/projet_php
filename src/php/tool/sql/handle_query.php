<?php
    function check_id(mixed $id):bool{
        if($id==null){
            return false;
        }
        return ctype_digit($id) || gettype($id)=="int";
    }
    function check_exist(mixed $value):bool{
        if($value==null){
            return false;
        }
        return !(trim($value)=="");
    }
    function check_email(mixed $email):bool{
        if($email==null){
            return false;
        }
        return !filter_var($email, FILTER_VALIDATE_EMAIL)===false;
    }
    function check_illegal_sequence(mixed $value):bool{
        if($value==null){
            return false;
        }
        return !str_contains($value,"--") && !str_contains($value,"';") && !str_contains($value,"\";") && !str_contains($value,"`;");
    }
?>