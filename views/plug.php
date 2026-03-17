<?php
  $is_img = $url == '/plug/image';
  $is_info = $url == '/plug/info';
?>

<h1>Здесь о плагинах</h1>

<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link <?=  $is_img ? "active" : '' ?>" aria-current="page" href="/plug/image">Картинка</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?= $is_info ? "active" : '' ?>" aria-current="page" href="/plug/info">Описание</a>
  </li>
</ul>

<?php
  if($is_img){
    require "plug_image.php";
  } elseif($is_info){
    require "plug_info.php";
  }
?>