<?php 
    $path = explode("?",$_SERVER["REQUEST_URI"])[0];
    $temp_query = count(explode("?",$_SERVER["REQUEST_URI"]))>1 ? explode("?",$_SERVER["REQUEST_URI"])[1] : "";
    $temp_query = explode("&",$temp_query);
    $url_query = [];
    foreach($temp_query as $value){
        if(count(explode("=",$value))==2){
            $url_query[explode("=",$value)[0]]=explode("=",$value)[1];
        }
    }
    $body = $_POST!=null ? $_POST : [];
    $http_method = $_SERVER["REQUEST_METHOD"];
?>