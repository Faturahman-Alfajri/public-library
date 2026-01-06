<?php
header("Content-Type: application/json; charset=utf-8");

require_once "db.php";

$result = $conn->query("SELECT id, created_at, user_name, category, complaint, status FROM complaints ORDER BY id DESC LIMIT 50");
$rows = [];

while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

echo json_encode(["ok" => true, "complaints" => $rows]);
$conn->close();
