<?php
ob_clean(); // Clears any previous output

require_once 'Database.php';

// Set header for JSON response
header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the incoming JSON data
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Get page URL from the input data
    $pageUrl = $input['page_url'] ?? '';
    $ipAddress = $_SERVER['REMOTE_ADDR'];

    // If page URL is provided, proceed
    if (!empty($pageUrl)) {
        try {
            // Instantiate Database class
            $db = new Database();

            // Get PDO instance via the getPdo() method
            $pdo = $db->getPdo();

            // Prepare and execute the database query to insert the visit data
            $stmt = $pdo->prepare("INSERT INTO visits (page_url, ip_address) VALUES (:page_url, :ip_address)");
            $stmt->execute([
                ':page_url' => $pageUrl,
                ':ip_address' => $ipAddress
            ]);

            // Send a success JSON response
            echo json_encode(['status' => 'success']);
        } catch (PDOException $e) {
            // Send error JSON if there's a database error
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        // Send error JSON if page URL is missing
        echo json_encode(['status' => 'error', 'message' => 'Page URL missing']);
    }
} else {
    // Send error JSON if request method is not POST
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
