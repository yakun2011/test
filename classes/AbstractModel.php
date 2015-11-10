<?php

abstract class AbstractModel {
    
    protected static $table;
    
    protected $data = [];
    
    public function __set($k, $v) {
        $this->data[$k] = $v;
    }

    public function __get($k) {
        return $this->data[$k];
    }
        
    public static function findAll() {
        
        $class = get_called_class();
        $sql = 'SELECT * FROM ' . static::$table;
        $db = new DB();
        $db->setClassName($class);
        return $db->query($sql);
    }

    public static function findOneByPk($id) {

        $class = get_called_class();
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';
        $db = new DB();
        $db->setClassName($class);
        return $db->query($sql, [':id'=>$id])[0];
    }
    
    public function insert() {
        $cols = array_keys($this->data);
        $ins = [];
        $data = [];
        
        foreach ($cols as $col) {
            $ins[] = ':' . $col;
            $data[':' . $col] = $this->data[$col];
        }
        
        $sql = 'INSERT INTO ' . static::$table . '
                (' . implode(', ', $cols) . ')
                VALUES
                (' . implode(', ', $ins) . ')
                ';
//        var_dump($data);die;
        $db = new DB();
        $db->execute($sql, $data);
    }
    
    public function fill($data = []) { // метод собирает в массив данные из формы и с помощью этого массива сам установит нужные свойства объекта 
        
    }
    
//    protected static $table;
//    protected static $class;
//
//    public static function getAll(){
//        $db = new DB;
//        $sql = 'SELECT * FROM ' . static::$table;
//        return $db->queryAll($sql, static::$class);
//    }
//
//    public static function getOne($id){
//        $db = new DB;
//        $sql = 'SELECT * FROM ' . static::$table . ' WHERE id=' . $id;
//        return $db->queryOne($sql, static::$class);
//    }
}