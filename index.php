<?php
   require_once 'vendor/autoload.php';
   $loader = new \Twig\Loader\FilesystemLoader('templates');
   $twig = new \Twig\Environment($loader);
   
   include('.\src\main.php');
   include_once('./src/php/component/footer.php');
   include_once('./src/php/component/navbar.php');
   if(!$isCSS){
      echo $twig->render('template.twig', ['title' => $title, 'page' => $html, 'nav' => $navbar, 'footer' => $footer]);
   }
   
?>