<?php 
    function alertJS(string $message):string{
        return <<<HTML
        <script>
            console.log('$message');
            alert('$message');
        </script>
        <p>$message</p>
HTML;
    }
?>