<?php
class Session{
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function getValue($key) {
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = [];
        }
        return $_SESSION[$key];
    }

    public function getColumn($key, $column, $unique = false) {
        if($unique){
            return array_unique(array_column($this->getValue($key), $column));
        }
        return array_column($this->getValue($key), $column);
    }
    
    public function setValue($key, $value) {
        $_SESSION[$key] = $value;
    }
}
?>