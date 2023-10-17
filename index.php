<?php
   require_once('vendor/autoload.php');
   $loader = new \Twig\Loader\FilesystemLoader('src\templates');
   $twig = new \Twig\Environment($loader);
   require_once('src/main.php');
   require_once('src/php/component/footer.php');
   require_once('src/php/component/nav.php');
   if(!$isnotHTML){
      $twigContext = [
         'title' => $title,
         'title_header' => isset($_SESSION['utilisateur']) ? $title : "",
         'page' => $html,
         'nav' => $nav,
         'footer' => $footer
      ];
      echo $twig->render('template.twig', $twigContext);
   }
?>