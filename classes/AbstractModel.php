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
    
    public function __isset($k) {
        return isset($this->data[$k]);
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
        
    public static function findByColumn($column, $value) { // Возвращает массив объектов с заданным значением свойства
        $db = new DB();
        $db->setClassName(get_called_class());
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . '=:value';
        return $db->query($sql, [':value'=>$value]);
    }

    public static function findOneByColumn($column, $value) { // Возвращает объект с заданным значением свойства
        $db = new DB();
        $db->setClassName(get_called_class());
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $column . '=:value';
        $res = $db->query($sql, [':value'=>$value])[0];
        if (empty($res)){
            throw new ModelException('Шэф! Всё пропало!');
        }
        return false;
    }
    
    protected function insert() {
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
        $this->id = $db->lastInsertId();
    }
    
    protected function update() {
        $cols = [];
        $data = [];
        foreach ( $this->data as $k => $v ) {
            $data[':' . $k] = $v;
            if ($k == 'id') {
                continue;
            }
            $cols[] = $k . '=:' . $k;
        }
        $sql = '
            UPDATE ' . static::$table . '
            SET ' . implode(', ', $cols) . '
            WHERE id=:id
        ';

        $db = new DB();
        $db->execute($sql, $data);
    }
    
    public function save() {
        if ( !isset($this->id) ) {
            $this->insert();
        } else {
            $this->update();
        }
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