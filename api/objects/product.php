<?php 
    class Product
    {
        private $conn;
        private $table_name = 'products';

        public $id;
        public $name;
        public $description;
        public $price;
        public $category_id;
        public $category_name;
        public $created;

        public function __construct($db)
        {
            $this->conn = $db;
        }
        
    }