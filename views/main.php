<ul class="list-group">
  <li class="list-group-item">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link <?= $is_image ? "active" : '' ?>" aria-current="page" href="/sint">
          Синтезатор
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $is_image ? "active" : '' ?>" aria-current="page" href="/sint/image">
          Картинка
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $is_info ? "active" : '' ?>" aria-current="page" href="/sint/info">
          Описание
        </a>
      </li>
    </ul>
  </li>
  <li class="list-group-item">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link <?= $is_img ? "active" : '' ?>" aria-current="page" href="/plug">Плагины</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $is_img ? "active" : '' ?>" aria-current="page" href="/plug/image">Картинка</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?= $is_info ? "active" : '' ?>" aria-current="page" href="/plug/info">Описание</a>
      </li>
    </ul>
  </li>
</ul>