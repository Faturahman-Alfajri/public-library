<?php
header("Content-Type: application/json; charset=utf-8");

require_once "db.php";

// Read JSON body
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

$user_name = trim($data["user"] ?? "Anon");
$category  = trim($data["category"] ?? "Other");
$complaint = trim($data["complaint"] ?? "");

if ($complaint === "") {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "Complaint cannot be empty"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO complaints (user_name, category, complaint) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $user_name, $category, $complaint);

if ($stmt->execute()) {
    echo json_encode(["ok" => true]);
} else {
    http_response_code(500);
    echo json_encode(["ok" => false, "error" => "Insert failed"]);
}

$stmt->close();
$conn->close();
