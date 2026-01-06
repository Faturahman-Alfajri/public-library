<?php
//Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "library_public";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    http_response_code(500);
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode(["ok" => false, "error" => "DB connection failed"]);
    exit;
}

$conn->set_charset("utf8mb4");
