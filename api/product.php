<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../models/Product.php';

$product = new Product();

$method = $_SERVER['REQUEST_METHOD'];

try {

    if ($method === 'GET') {

        $data = $product->getAll();

        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }

    elseif ($method === 'POST') {

        $input = json_decode(file_get_contents("php://input"), true);

        if (!$input) {
            throw new Exception("Invalid input");
        }

        $product->create($input);

        echo json_encode([
            'status' => 'success',
            'message' => 'Product created successfully'
        ]);
    }

    else {
        http_response_code(405);
        echo json_encode([
            'status' => 'error',
            'message' => 'Method not allowed'
        ]);
    }

} catch (Exception $e) {

    http_response_code(400);

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
