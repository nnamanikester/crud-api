<?php 
    
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST"); // post request only
    header("Access-Control-Max-Age: 3600"); // Request epiration time
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); //Headers to allow

    include_once '../config/database.php';
    include_once '../objects/product.php';

    $database = new Database();
    $db = $database->getConnection();

    $product = new Product($db);

    // get posted data
    $data = json_decode(file_get_contents("php://input")); // A better way to get posted data
    
    // make sure data is not empty
    if(!empty($data->name) && !empty($data->price) && !empty($data->description) && !empty($data->category_id)){

        // set product property values
        $product->name = $data->name;
        $product->price = $data->price;
        $product->description = $data->description;
        $product->category_id = $data->category_id;
        $product->created = date('Y-m-d H:i:s');
        
        if($product->create()){

            // set response code - 201 created
            http_response_code(201);
            echo json_encode(array("message" => "Product was created."));

        } else {

            // set response code - 503 service unavailable
            http_response_code(503);
            echo json_encode(array("message" => "Unable to create product."));
        }

    } else {

        // set response code - 400 bad request
        http_response_code(400);
        echo json_encode(array("message" => "Unable to create product. Data is incomplete."));

    }

