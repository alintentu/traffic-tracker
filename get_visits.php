<?php

require_once 'Database.php';

$db = new Database();

$visitData = $db->getVisitData();

$response = [
    'status' => 'success',
    'total_visits' => count($visitData),  
    'data' => $visitData, 
];

header('Content-Type: application/json');
echo json_encode($response);
