<?php
   require_once('vendor\autoload.php');
   $loader = new \Twig\Loader\FilesystemLoader('src\templates');
   $twig = new \Twig\Environment($loader);
   
   require_once('src\main.php');
   require_once('src\php\component\footer.php');
   require_once('src\php\component\navbar.php');
   require_once('src\php\tool\http_info.php');
   
   if(!$isnotHTML){
      $title_header = isset($_SESSION['utilisateur']) ? $title : "";
      echo $twig->render('template.twig', ['title' => $title,'title_header' => $title_header, 'page' => $html, 'nav' => $navbar, 'footer' => $footer]);
   }
   
?>