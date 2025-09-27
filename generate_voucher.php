<?php
header('Content-Type: application/json');

// Get student ID from POST request
$studentId = $_POST['studentId'] ?? '';

// Validate student ID format (8 digits)
if (!preg_match('/^\d{8}$/', $studentId)) {
    echo json_encode(['success' => false, 'message' => 'Invalid student ID format']);
    exit;
}

// Load allowed student IDs from JSON file
// In production, this should be a database query
$allowedStudentsFile = 'allowed_students.json';
if (!file_exists($allowedStudentsFile)) {
    // Create sample allowed list if it doesn't exist
    $sampleStudents = [
        '12345678',
        '23456789',
        '34567890',
        '45678901',
        '56789012'
    ];
    file_put_contents($allowedStudentsFile, json_encode($sampleStudents, JSON_PRETTY_PRINT));
}

$allowedStudents = json_decode(file_get_contents($allowedStudentsFile), true);

// Check if student ID is in allowed list
if (!in_array($studentId, $allowedStudents)) {
    echo json_encode(['success' => false, 'message' => 'Student ID not authorized for WiFi access']);
    exit;
}

// Generate a unique voucher code (12 characters: XXXX-XXXX-XXXX)
$voucherCode = strtoupper(substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(9))), 0, 12));
$voucherCode = implode('-', str_split($voucherCode, 4));

// In a real system, you would:
// 1. Store the voucher in a database with expiration time
// 2. Log the issuance
// 3. Implement rate limiting

// For this demo, we'll just return the voucher
echo json_encode([
    'success' => true,
    'voucherCode' => $voucherCode,
    'expiresIn' => '24 hours'
]);
?>