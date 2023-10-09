<?php
    header("Content-Type: text/css");
    $css = "src/assets/css/style.css";
    if(file_exists($css)){
        echo file_get_contents($css);
    }else{
        echo "error loading css";
    }
?>