<?php
    class Router{
        private string $path;
        private string $http_method;
        private string $php_file;
        private string $title;
        function __construct(string $path, string $http_method, string $php_file, string $title){
            $this->path=$path;
            $this->http_method=$http_method;
            $this->php_file=$php_file;
            $this->title=$title;
        }
        function getphp_file():string{
            return $this->php_file;
        }
        function gettitle():string{
            return $this->title;
        }
        function getpath():string{
            return $this->path;
        }
        function gethttp_method():string{
            return $this->http_method;
        }
    }
    class RouterList{
        /**
         * array<Router>
         */
        private array $list;
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
        function get_router(string $path, string $method):router|null{
            foreach($this->list as $router){
                if($router->getpath()==$path && $router->gethttp_method()==$method){
                    return $router;
                }
            }
            return null;
        }
        function right_method(string $path, string $method):bool{
            $check = true;
            foreach($this->list as $router){
                if($router->getpath()==$path && $router->gethttp_method()!=$method){
                    $check=false;
                    break;
                }
            }
            return $check;
        }
        function right_path(string $path, string $method):bool{
            $check = false;
            foreach($this->list as $router){
                if($router->getpath()==$path && $router->gethttp_method()==$method){
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
        return $current_router->getphp_file();
    }
    function get_title(RouterList $routers, string $path, string $method):string{
        $current_router = $routers->get_router($path,$method);
        if(!$routers->right_method($path,$method)){
            return 'error 405';
        }
        if(!$routers->right_path($path,$method)){
            return 'error 404';
        }
        return $current_router->gettitle();
    }
?>