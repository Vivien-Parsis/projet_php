<?php
   require_once('vendor\autoload.php');
   $loader = new \Twig\Loader\FilesystemLoader('src\templates');
   $twig = new \Twig\Environment($loader);
   
   include('.\src\main.php');
   include_once('.\src\php\component\footer.php');
   include_once('.\src\php\component\navbar.php');
   include_once('.\src\php\tool\http_info.php');
   
   if(!$isnotHTML){
      $title_header = isset($_SESSION['utilisateur']) ? $title : "";
      echo $twig->render('template.twig', ['title' => $title,'title_header' => $title_header, 'page' => $html, 'nav' => $navbar, 'footer' => $footer]);
   }
   
?>