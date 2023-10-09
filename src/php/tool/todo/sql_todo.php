<?php
  require_once('src\php\tool\sql\handle_sql.php');
  class Sql_todo{
    private static string $dbname = "php_project";
    private array|null $url_query;
    private array|null  $http_body;

    function __construct(array|null $url_query, array|null $http_body){
      $this->url_query=$url_query;
      $this->http_body=$http_body;
    }

    function add_todo(string $objective){
      $query="insert into todo(objectif_todo,done) value ('$objective',0)";
      return connect_sql($query);
    }
    function default_todo(){
      $query="INSERT INTO `todo` VALUES (0,'Integer at odio porta, finibus mi vel, bibendum orci. Duis elit est, ornare in ornare eu, dictum et nulla. Pellentesque libero enim, consectetur sed lectus vitae, tristique interdum nisi. Suspendisse eget tempor erat, et cursus risus. Nam purus velit, facilisis a placerat tempus, consequat vitae mi. Nulla rhoncus, quam non imperdiet malesuada, erat enim sollicitudin nisi, in interdum orci mauris sit amet leo. Donec sagittis ligula ipsum, et pharetra augue porta ut. Donec vel posuere quam. Phasellus facilisis ligula a sem pretium, eu consequat nibh mattis. Fusce id turpis eget elit maximus laoreet eget nec turpis. Duis id sem lobortis, ornare turpis in, tempor augue. Donec at magna vel leo varius ullamcorper non ut elit.',0),(1,'Nulla facilisi. Maecenas tristique dolor in enim porttitor laoreet. Duis venenatis tincidunt purus, sed suscipit lorem rutrum ac. Proin mauris massa, blandit sit amet porttitor fermentum, pharetra sit amet diam. Aliquam id pulvinar orci, id condimentum lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed elementum risus tellus, nec pharetra tortor feugiat id. Fusce pretium tincidunt efficitur. Praesent ut sodales neque. Duis imperdiet, risus vitae commodo fringilla, metus nibh egestas lectus, sed congue lorem enim nec ex. Duis nec porttitor diam. Donec aliquet metus eu ante cursus tempor. Nunc malesuada mi venenatis, tincidunt est suscipit, tempor nunc. Sed scelerisque erat id magna dictum, ut posuere mauris sodales. Suspendisse interdum posuere tellus, ut commodo metus sagittis ut.',0),(2,'Nulla facilisi. Maecenas tristique dolor in enim porttitor laoreet. Duis venenatis tincidunt purus, sed suscipit lorem rutrum ac. Proin mauris massa, blandit sit amet porttitor fermentum, pharetra sit amet diam. Aliquam id pulvinar orci, id condimentum lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed elementum risus tellus, nec pharetra tortor feugiat id. Fusce pretium tincidunt efficitur. Praesent ut sodales neque. Duis imperdiet, risus vitae commodo fringilla, metus nibh egestas lectus, sed congue lorem enim nec ex. Duis nec porttitor diam. Donec aliquet metus eu ante cursus tempor. Nunc malesuada mi venenatis, tincidunt est suscipit, tempor nunc. Sed scelerisque erat id magna dictum, ut posuere mauris sodales. Suspendisse interdum posuere tellus, ut commodo metus sagittis ut.',0);";
      $this->remove_all_todo();
      return connect_sql($query);
    }
    function read_all_todo():array{
      $query="select * from todo";
      return connect_sql($query);
    }
    function remove_todo(string $id){
      $query="delete from todo where id_todo=$id";
      return connect_sql($query);
    }
    function remove_all_todo(){
      $query="delete from todo";
      return connect_sql($query);
    }
    function update_done_todo(string $id, string $done){
      if($done=="1"){
        $done="0";
      }else{
        $done="1";
      }
      $query="update todo set done_todo=$done where id_todo=$id";
      return connect_sql($query);
    }
    function modify_todo(string $id, string $newvalue){
      $query="update todo set objectif_todo='$newvalue' where id_todo=$id";
      return connect_sql($query);
    }
  }
?>