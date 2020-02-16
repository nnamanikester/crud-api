<?php
    class Category {

        private $conn;
        private $table_name = "categories";
        
        public $id;
        public $name;
        public $description;
        public $created;

        public function __construct($db){
            $this->conn = $db;
        }
        
        public function readAll()
        {

            $query = "SELECT id, name, description FROM " . $this->table_name . " ORDER BY name";

            $stmt = $this->conn->query($query);

            return $stmt;

        }
        
        public function read()
        {

            $query = "SELECT id, name, description FROM " . $this->table_name . " ORDER BY name";

            $stmt = $this->conn->query( $query );

            return $stmt;
            
        }

    }