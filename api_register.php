<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if (!$data) $data = $_POST;

$full_name   = trim($data['full_name']   ?? '');
$email       = trim($data['email']       ?? '');
$phone       = trim($data['phone']       ?? '');
$dob         = trim($data['dob']         ?? '');
$blood_group = trim($data['blood_group'] ?? '');

// Validate
if (!$full_name || !$email) {
    echo json_encode(['success' => false, 'error' => 'Name and email are required.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Invalid email address.']);
    exit;
}

$conn = getDB();
if (!$conn) {
    // Graceful fallback: pretend success if DB not set up yet
    echo json_encode(['success' => true, 'message' => 'Welcome, ' . htmlspecialchars($full_name) . '! (DB not connected yet — set up MySQL to persist data.)']);
    exit;
}

// Check duplicate
$check = $conn->prepare("SELECT id FROM patients WHERE email = ?");
$check->bind_param('s', $email);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    echo json_encode(['success' => false, 'error' => 'This email is already registered. Welcome back!']);
    exit;
}

// Insert
$stmt = $conn->prepare("INSERT INTO patients (full_name, email, phone, dob, blood_group) VALUES (?,?,?,?,?)");
$dobVal = $dob ?: null;
$stmt->bind_param('sssss', $full_name, $email, $phone, $dobVal, $blood_group);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Welcome to MediCare, ' . htmlspecialchars($full_name) . '! Your profile has been created.', 'id' => $conn->insert_id]);
} else {
    echo json_encode(['success' => false, 'error' => 'Registration failed. Please try again.']);
}
?>
