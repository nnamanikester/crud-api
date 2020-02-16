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

        public function read()
        {
            $query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM " . $this->table_name . " p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created DESC";

            $stmt = $this->conn->query($query);

            return $stmt;

        }

        public function create() 
        {
            $query = "INSERT INTO " . $this->table_name . " (name, price, description, category_id, created) " . "VALUES (?, ?, ?, ?, ?)";
            
            $stmt = $this->conn->prepare($query);

            // sanitize
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->created = htmlspecialchars(strip_tags($this->created));

            // bind values
            $stmt->bind_param("sssss", $name, $price, $description, $category_id, $created);

            $name = $this->name;
            $price = $this->price;
            $description = $this->description;
            $category_id = $this->category_id;
            $created = $this->created;
            

            if($stmt->execute()) {
                return true;
            }
            
            return false;

        }

        public function readOne()
        {
            $query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM " . $this->table_name . " p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = {$this->id} LIMIT 0,1";

            $stmt = $this->conn->query($query);
            $row = $stmt->fetch_assoc();
            
            $this->name = $row['name'];
            $this->price = $row['price'];
            $this->description = $row['description'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];

        }

        public function update()
        {
            $query = "UPDATE " . $this->table_name . " SET name = ?, price = ?, description = ?, category_id = ? WHERE id = ?";

            $stmt = $this->conn->prepare($query);

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // bind new values
            $stmt->bind_param("ssss", $name, $price, $description, $category_id, $id);

            $name = $this->name;
            $price = $this->price;
            $description = $this->description;
            $category_id = $this->category_id;
            $id = $this->id;
            
            if($stmt->execute()){
                return true;
            }

            return false;
        }
        

    }