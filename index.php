<?php

require_once __DIR__ . '/models/photo.php';

$items = photo_getAll();

require_once __DIR__ . '/views/index.php';

//var_dump($items);

// git clone - клонирование
// git add - добавить файл под контроль git'a
// git commit -m "Сообщение" - фиксация изменений в истории
// git push - отправка локальных изменений в удалённый репозиторий
// git pull - удалённые изменения в локальный репозиторий
// http://git-scm.com/book/ru/v2 кинга по гиту 2