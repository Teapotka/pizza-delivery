<?php

class Admin extends Database {
    private $db;

    public function __construct(){
        $this->db = $this->db_connection(); // Establish database connection
    }

    // Method to create new user in admins table 
    public function register($login, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admins (login, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$login, $hashedPassword]);
    }

    // Method to authenticate user from admins table
    public function authenticate($login, $password) {
        $sql = "SELECT password FROM admins WHERE login = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user->password)) {
            return true;
        }
        return false;
    }
}
?>