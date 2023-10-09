<?php
    $path = explode("?",$_SERVER["REQUEST_URI"])[0];
    //handle js file
    if(str_ends_with($path,".js")&&str_starts_with($path,"/assets/js/")){
        header("Content-Type: application/javascript");
        $js = "./src".$path;
        if(file_exists($js)){
            echo file_get_contents($js);
        }else{
            echo "error loading js";
        }
    }
    //handle css file
    if(str_ends_with($path,".css")&&str_starts_with($path,"/assets/css/")){
        header("Content-Type: text/css");
        $css = "./src".$path;
        if(file_exists($css)){
            echo file_get_contents($css);
        }else{
            echo "error loading css";
        }
    }
    //handle image file
    if((str_ends_with($path,".ico")||str_ends_with($path,".png")||str_ends_with($path,".svg"))&&str_starts_with($path,"/assets/img/")){
        $mime_type = "";
        if(str_ends_with($path,".ico")){
            $mime_type = "image/x-icon";
        }
        if(str_ends_with($path,".png")){
            $mime_type = "image/png";
        }
        if(str_ends_with($path,".svg")){
            $mime_type = "image/svg+xml";
        }
        header("Content-Type: $mime_type");
        $img = "./src".$path;
        if(file_exists($img)){
            echo file_get_contents($img);
        }else{
            echo "error loading image";
        }
    }
?>