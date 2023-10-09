<?php
    class Router{
        public string $path;
        public string $http_method;
        public string $php_file;
        public string $title;
        function __construct(string $path, string $http_method, string $php_file, string $title){
            $this->path=$path;
            $this->http_method=$http_method;
            $this->php_file=$php_file;
            $this->title=$title;
        }
    }
    class RouterList{
        /**
         * array<Router>
         */
        public array $list;
        function __construct(array $list){
            $only_with_router = true;
            foreach($list as $value){
                if(gettype($value)!="Router"){
                    !$only_with_router;
                    break;
                }
            }
            $only_with_router ? $this->list=$list : $this->list=[];
        }
        function get_router(string $path, string $method){
            foreach($this->list as $router){
                if($router->path==$path && $router->http_method==$method){
                    return $router;
                }
            }
            return null;
        }
        function right_method(string $path, string $method){
            $check = true;
            foreach($this->list as $router){
                if($router->path==$path && $router->http_method!=$method){
                    $check=false;
                    break;
                }
            }
            return $check;
        }
        function isnotHTML(string $path, string $method):bool{
            foreach($this->list as $router){
                if($router->isnotHTML==true){
                    return true;
                }
            }
            return false;
        }
        function right_path(string $path, string $method){
            $check = false;
            foreach($this->list as $router){
                if($router->path==$path && $router->http_method==$method){
                    $check=true;
                    break;
                }
            }
            return $check;
        }
    }
    function get_page(RouterList $routers, string $path, string $method):string{
        $current_router = $routers->get_router($path,$method);
        //handle js file
        if(str_ends_with($path,".js")&&str_starts_with($path,"/assets/js/")){
            $js = "./src".$path;
            if(file_exists($js)){
                header("Content-Type: application/javascript");
                echo file_get_contents($js);
                return "nothtml";
            }else{
                return 'php/page/error_404.php';
            }
        }
        //handle css file
        if(str_ends_with($path,".css")&&str_starts_with($path,"/assets/css/")){
            $css = "./src".$path;
            if(file_exists($css)){
                header("Content-Type: text/css");
                echo file_get_contents($css);
                return "nothtml";
            }else{
                return 'php/page/error_404.php';
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
            $img = "./src".$path;
            if(file_exists($img)){
                header("Content-Type: $mime_type");
                echo file_get_contents($img);
                return "nothtml";
            }else{
                return 'php/page/error_404.php';
            }
        }
        if(!$routers->right_method($path,$method)){
            return 'php/page/error_405.php';
        }
        if(!$routers->right_path($path,$method)){
            return 'php/page/error_404.php';
        }
        return $current_router->php_file;
    }
    function get_title(RouterList $routers, string $path, string $method):string{
        $current_router = $routers->get_router($path,$method);
        if(!$routers->right_method($path,$method)){
            return 'error 405';
        }
        if(!$routers->right_path($path,$method)){
            return 'error 404';
        }
        return $current_router->title;
    }
?>