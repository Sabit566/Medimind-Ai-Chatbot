<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once 'db.php';

$query    = isset($_GET['q'])    ? trim($_GET['q'])    : '';
$category = isset($_GET['cat'])  ? trim($_GET['cat'])  : '';
$page     = isset($_GET['page']) ? (int)$_GET['page']  : 1;
$limit    = 12;
$offset   = ($page - 1) * $limit;

$conn = getDB();

// ── If DB not available, return demo data ──
if (!$conn) {
    echo json_encode([
        'success' => false,
        'error'   => 'Database not connected. Please set up MySQL and import schema.sql.',
        'data'    => [],
        'total'   => 0
    ]);
    exit;
}

// ── Build WHERE clause ──
$where  = [];
$params = [];
$types  = '';

if ($query !== '') {
    $where[]  = '(medicine_name LIKE ? OR generic_name LIKE ? OR category LIKE ? OR description LIKE ?)';
    $like     = '%' . $query . '%';
    $params   = array_merge($params, [$like, $like, $like, $like]);
    $types   .= 'ssss';
}

if ($category !== '' && $category !== 'All') {
    $where[]  = 'category = ?';
    $params[] = $category;
    $types   .= 's';
}

$whereSQL = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// ── Count total ──
$countSQL  = "SELECT COUNT(*) as total FROM medicines $whereSQL";
$countStmt = $conn->prepare($countSQL);
if ($types && $countStmt) {
    $countStmt->bind_param($types, ...$params);
}
$countStmt->execute();
$total = $countStmt->get_result()->fetch_assoc()['total'];

// ── Fetch data ──
$dataSQL  = "SELECT * FROM medicines $whereSQL ORDER BY medicine_name ASC LIMIT ? OFFSET ?";
$dataStmt = $conn->prepare($dataSQL);
$dataParams = array_merge($params, [$limit, $offset]);
$dataTypes  = $types . 'ii';
$dataStmt->bind_param($dataTypes, ...$dataParams);
$dataStmt->execute();
$result = $dataStmt->get_result();

$medicines = [];
while ($row = $result->fetch_assoc()) {
    $medicines[] = $row;
}

echo json_encode([
    'success'  => true,
    'data'     => $medicines,
    'total'    => (int)$total,
    'page'     => $page,
    'limit'    => $limit,
    'pages'    => ceil($total / $limit)
]);
?>
