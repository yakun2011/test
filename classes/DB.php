<?php

class DB {
    
    private $dbh;
    private $className = 'stdClass';

    public function __construct() {

        $dsn = 'mysql:dbname=test;host=localhost';
        $this->dbh = new PDO($dsn, 'root', '');
    }
    
    public function setClassName($className) {
        $this->className = $className;
    }
    
    public function query($sql, $params = []) {
        
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    public function execute($sql, $params = []) {

        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);
    }
    
//    public function queryAll($sql, $className = 'stdClass') {
//
//        $res = mysql_query($sql);
//        if ($res === false) {
//            return false;
//        }
//        
//        $ret = [];
//        while ($row = mysql_fetch_object($res, $className)) {
//            $ret[] = $row;
//        }
//        return $ret;
//    }
//
//    public function queryOne($sql, $className = 'stdClass') {
//
//        $res = $this->queryAll($sql, $className = 'stdClass');
//        return $res[0];
//    }
}