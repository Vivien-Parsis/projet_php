<?php
   require_once 'vendor/autoload.php';
   $loader = new \Twig\Loader\FilesystemLoader('templates');
   $twig = new \Twig\Environment($loader);
   
   include('.\src\main.php');
   include_once('./src/php/component/footer.php');
   include_once('./src/php/component/navbar.php');
   echo $twig->render('template.twig', ['title' => $title, 'page' => $page, 'nav' => $navbar, 'footer' => $footer]);
?>