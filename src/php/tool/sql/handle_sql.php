<?php
    //replace by yours mysql login
    //$dbname="project_php";
    //$username = "";
    //$password = "";
    //$servername = "";
    //$port = 3306;
    function connect_sql(string $query):array|string{
        try {
            require('src/php/tool/sql/login.php');
            $conn = new PDO("mysql:host=".$servername.";port=".$port.";dbname=".$dbname, $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            check_query($query);
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $returndata = $stmt->fetchAll();
            return $returndata;
        } catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            return "error sql";
        }
    }
    function check_query(string &$queryToCheck):void{
        //prevent from adding comment in the sql request
        $queryToCheck = str_replace("--","",$queryToCheck);
        //prevent from adding mutliple instructions in the sql request 
        $queryToCheck = str_replace("';"," ",$queryToCheck);
        $queryToCheck = str_replace("\";"," ",$queryToCheck);
        $queryToCheck = strip_tags($queryToCheck);
    }
?>