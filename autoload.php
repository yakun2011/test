<?php

function __autoload($className) {
    
    if (file_exists( __DIR__ . '/controllers/' . $className . '.php')) {
        require_once __DIR__ . '/controllers/' . $className . '.php';
    } elseif (file_exists( __DIR__ . '/models/' . $className . '.php')) {
        require_once __DIR__ . '/models/' . $className . '.php';
    } elseif (file_exists( __DIR__ . '/classes/' . $className . '.php')) {
        require_once __DIR__ . '/classes/' . $className . '.php';
    } else {
        $classParts = explode('\\', $className);
        $classParts[0] = __DIR__;
        $path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php';
        if (file_exists($path)) {
            require $path;
        }
//        var_dump($path);
//        die;
        
        
    }
    
}