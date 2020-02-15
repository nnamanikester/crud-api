<?php
    class Database {
        private $host = 'localhost';
        private $db_name = 'api_db';
        private $username = 'root';
        private $password = '';
        private $conn;

        public function getConnection()
        {
            $this->conn = null;
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name) or die('Connection Error => '.$this->conn->error);
            
            return $this->conn;
            
        }
    }