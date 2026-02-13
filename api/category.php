<?php

header("Content-Type: application/json");

require_once __DIR__ . '/../models/Category.php';

$category = new Category();

try {

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        echo json_encode([
            'status' => 'success',
            'data' => $category->getAll()
        ]);

    } else {

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
