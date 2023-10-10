<?php
    include('src\php\tool\sql\login.php');
    try {
        $conn = new PDO("mysql:host=$servername;port=$port", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd = file_get_contents('bdd.sql');
        $stmt = $conn->exec($bdd);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return "error sql";
    }
?>