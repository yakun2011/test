<?php

class DB {

    public function __construct(){
        
        mysql_connect('localhost', 'root', '');
        mysql_select_db('test');
    }
    
    public function queryAll($sql, $className = 'stdClass') {
        
        $res = mysql_query($sql);
        if ($res === false) {
            return false;
        }
        
        $ret = [];
        while ($row = mysql_fetch_object($res, $className)) {
            $ret[] = $row;
        }
        return $ret;
    }

    public function queryOne($sql, $className = 'stdClass') {

        $res = $this->queryAll($sql, $className = 'stdClass');
        return $res[0];
    }
}