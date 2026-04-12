    <?php
    require_once '../vendor/autoload.php';

    $loader = new \Twig\Loader\FilesystemLoader('../views');

    $twig = new \Twig\Environment($loader);


    $url = $_SERVER["REQUEST_URI"];

    if (preg_match("#^/main#", $url)) {
      require "../views/main.php";
    } elseif (preg_match("#^/sint#", $url)) {
      require "../views/sint.php";
    } elseif (preg_match("#^/plug#", $url)) {
      require "../views/plug.php";
    }
    ?>
  </div>


</body>

</html>