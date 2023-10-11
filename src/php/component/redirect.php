<?php
    function redirect(string $path, int $duration):string{
        return "<div class='loading'><img src='/assets/img/loading-svgrepo-com.svg'></div>
        <meta http-equiv='refresh' content=\"$duration;URL='$path'\">";
    }
?>