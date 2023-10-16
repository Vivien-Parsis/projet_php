<?php
  require_once('src\php\tool\sql\handle_sql.php');
  require_once('src\php\tool\sql\handle_query.php');
  class Sql_todo{
    static function add_todo(string $objective, string $id_user){
      if(!check_id($id_user) || !check_exist($objective)){
        require_once('src\php\component\alert.php');
        echo alertJS("error");
        return;
      }
      if(!check_illegal_sequence($objective)){
        require_once('src\php\component\alert.php');
        echo alertJS("error illegal sequence");
        return;
      }
      $query="insert into todo(objectif_todo,done_todo,id_utilisateurs) value ('$objective',0,'$id_user')";
      return connect_sql($query);
    }
    static function default_user_todo(string $id_user):void{
      if(!check_id($id_user)){
        require_once('src\php\component\alert.php');
        echo alertJS("error");
        return;
      }
      $query="INSERT INTO todo (done_todo,id_utilisateurs,objectif_todo) VALUES
      (0,$id_user,'Integer at odio porta, finibus mi vel, bibendum orci. Duis elit est, ornare in ornare eu, dictum et nulla. Pellentesque libero enim, consectetur sed lectus vitae, tristique interdum nisi. Suspendisse eget tempor erat, et cursus risus. Nam purus velit, facilisis a placerat tempus, consequat vitae mi. Nulla rhoncus, quam non imperdiet malesuada, erat enim sollicitudin nisi, in interdum orci mauris sit amet leo. Donec sagittis ligula ipsum, et pharetra augue porta ut. Donec vel posuere quam. Phasellus facilisis ligula a sem pretium, eu consequat nibh mattis. Fusce id turpis eget elit maximus laoreet eget nec turpis. Duis id sem lobortis, ornare turpis in, tempor augue. Donec at magna vel leo varius ullamcorper non ut elit.'),
      (1,$id_user,'Nulla facilisi. Maecenas tristique dolor in enim porttitor laoreet. Duis venenatis tincidunt purus, sed suscipit lorem rutrum ac. Proin mauris massa, blandit sit amet porttitor fermentum, pharetra sit amet diam. Aliquam id pulvinar orci, id condimentum lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed elementum risus tellus, nec pharetra tortor feugiat id. Fusce pretium tincidunt efficitur. Praesent ut sodales neque. Duis imperdiet, risus vitae commodo fringilla, metus nibh egestas lectus, sed congue lorem enim nec ex. Duis nec porttitor diam. Donec aliquet metus eu ante cursus tempor. Nunc malesuada mi venenatis, tincidunt est suscipit, tempor nunc. Sed scelerisque erat id magna dictum, ut posuere mauris sodales. Suspendisse interdum posuere tellus, ut commodo metus sagittis ut.'),
      (0,$id_user,'Nulla facilisi. Maecenas tristique dolor in enim porttitor laoreet. Duis venenatis tincidunt purus, sed suscipit lorem rutrum ac. Proin mauris massa, blandit sit amet porttitor fermentum, pharetra sit amet diam. Aliquam id pulvinar orci, id condimentum lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed elementum risus tellus, nec pharetra tortor feugiat id. Fusce pretium tincidunt efficitur. Praesent ut sodales neque. Duis imperdiet, risus vitae commodo fringilla, metus nibh egestas lectus, sed congue lorem enim nec ex. Duis nec porttitor diam. Donec aliquet metus eu ante cursus tempor. Nunc malesuada mi venenatis, tincidunt est suscipit, tempor nunc. Sed scelerisque erat id magna dictum, ut posuere mauris sodales. Suspendisse interdum posuere tellus, ut commodo metus sagittis ut.')";
      self::remove_all_todo();
      connect_sql($query);
    }
    static function read_all_todo():array{
      $query="select * from todo order by done_todo";
      return connect_sql($query);
    }
    static function read_todo(string $id_user):array{
      if(!check_id($id_user)){
        require_once('src\php\component\alert.php');
        echo alertJS("error");
        return [];
      }
      $query="select * from todo where id_utilisateurs=$id_user order by done_todo";
      return connect_sql($query);
    }
    static function remove_todo(string $id):void{
      if(!check_id($id)){
        require_once('src\php\component\alert.php');
        echo alertJS("error");
        return;
      }
      $query="delete from todo where id_todo=$id";
      connect_sql($query);
    }
    static function remove_all_todo():void{
      $query="delete from todo";
      connect_sql($query);
    }
    static function remove_all_user_todo(string $id_user):void{
      if(!check_id($id_user)){
        return;
      }
      $query="delete from todo where id_utilisateurs=$id_user";
      connect_sql($query);
    }
    static function update_done_todo(string $id, string $done):void{
      if(!check_exist($done) || !check_id($id)){
        require_once('src\php\component\alert.php');
        echo alertJS("error");
        return;
      }
      if(!check_illegal_sequence($done)){
        require_once('src\php\component\alert.php');
        echo alertJS("error illegal sequence");
        return;
      }
      if($done=="1"){
        $done="0";
      }else{
        $done="1";
      }
      $query="update todo set done_todo=$done where id_todo=$id";
      connect_sql($query);
    }
    static function modify_todo(string $id, string $newvalue):void{
      if(!check_id($id) || !check_exist($newvalue)){
        require_once('src\php\component\alert.php');
        echo alertJS("error");
        return;
      }
      if(!check_illegal_sequence($newvalue)){
        require_once('src\php\component\alert.php');
        echo alertJS("error illegal sequence");
        return;
      }
      $query="update todo set objectif_todo='$newvalue' where id_todo=$id";
      connect_sql($query);
    }
  }
?>