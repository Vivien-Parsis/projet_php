<?php
    function connect_sql(string $query):array|string{
        try {
            require_once('src\php\tool\sql\login.php');
            $conn = new PDO("mysql:host=".$servername.";port=".$port.";dbname=".$dbname, $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            check_query($query);
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $returndata = $stmt->fetchAll();
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return "error sql";
        }
    }
    function check_query(string &$queryToCheck){
        //prevent from adding comment in the sql request
        $queryToCheck = str_replace("--","",$queryToCheck);
        //prevent from adding mutliple instructions in the sql request 
        $queryToCheck = str_replace("';"," ",$queryToCheck);
        $queryToCheck = str_replace("\";"," ",$queryToCheck);
        $queryToCheck = strip_tags($queryToCheck);
    }
?>