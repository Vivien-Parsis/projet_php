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