<?php
    $path = explode("?",$_SERVER["REQUEST_URI"])[0];
    if($path=='/js/modify.js'){
        header("Content-Type: application/javascript");
        $js = "./src/assets/js/modify.js";
        if(file_exists($js)){
            echo file_get_contents($js);
        }else{
            echo "error loading js";
        }
    }
    if($path=='/css/style.css'){
        header("Content-Type: text/css");
        $css = "./src/assets/css/style.css";
        if(file_exists($css)){
            echo file_get_contents($css);
        }else{
            echo "error loading css";
        }
    }
?>