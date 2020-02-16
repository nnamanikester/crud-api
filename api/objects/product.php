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
	        $query = "INSERT INTO" . $this->table_name . " SET name=:name, price=:price, description=:description, category_id=:category_id, created=:created";

            // sanitize
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->description = htmlspecialchars(strip_tags($this->description));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->created = htmlspecialchars(strip_tags($this->created));

            // bind values
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":price", $this->price);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":category_id", $this->category_id);
            $stmt->bindParam(":created", $this->created);
            
            $stmt = $this->conn->query($query);

            if($stmt) {
                return true;
            }
            
            return false;

        }

    }