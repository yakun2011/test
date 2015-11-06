<?php

class NewsController {
    
    public function actionAll(){

        $news = News::getAll();
        $view = new View();
        $view->assign('items', $news);
        $view->display('news/all.php');
    }

    public function actionOne(){
        
        $id = $_GET['id'];
        $new = News::getOne($id);
        $view = new View();
        $view->assign('item', $new);
        $view->display('news/one.php');
    }
}