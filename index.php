<?php

require_once __DIR__ . '/autoload.php';

$contr = isset($_GET['contr']) ? $_GET['contr'] : 'News';
$act = isset($_GET['act']) ? $_GET['act'] : 'All';
$controllerClassName = $contr . 'Controller';

try {
    $controller = new $controllerClassName;
    $method = 'action' . $act;
    $controller->$method();

} catch (ModelException $e) {
    $view = new View();
    $view->error = $e->getMessage();
    $view->display('error.php');
}

// git clone - клонирование
// git add - добавить файл под контроль git'a
// git commit -m "Сообщение" - фиксация изменений в истории
// git push - отправка локальных изменений в удалённый репозиторий
// git pull - удалённые изменения в локальный репозиторий
// http://git-scm.com/book/ru/v2 кинга по гиту 2