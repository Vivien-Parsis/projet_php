<?php 
    function alertJS(string $message):string{
        return "<script>console.log('$message');alert('$message');</script><p>$message</p>";
    }
?>