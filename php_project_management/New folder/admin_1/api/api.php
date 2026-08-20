<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

session_name('PHPSESSID');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

require_once "../config/db.php";

// Load userclass first because authclass extends User
require_once "../models/userclass.php";
foreach (glob("../models/*class.php") as $filename) {
    require_once $filename; // already-loaded files are safely skipped by require_once
}

foreach (glob("*.api.php") as $filename) {
    require_once $filename;
}

if (isset($_GET["endpoint"])) {
    $method = $_GET["endpoint"];

    if ($method == "get-projects") {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        getProject($id);
    }
} else {
    echo json_encode(["error" => "No endpoint specified"]);
}
