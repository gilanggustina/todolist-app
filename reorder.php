<?php
session_start();
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data["order"]) || !is_array($data["order"])) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid data"]);
        exit;
    }

    $order = array_map("intval", $data["order"]);
    $current = $_SESSION["tasks"] ?? [];
    $newTasks = [];

    foreach ($order as $idx) {
        if (isset($current[$idx])) {
            $newTasks[] = $current[$idx];
        }
    }

    $_SESSION["tasks"] = $newTasks;
    echo json_encode(["status" => "ok"]);
}
