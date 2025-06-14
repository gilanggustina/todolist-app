<?php
session_start();
require_once 'helpers.php';

if (!isset($_SESSION["tasks"])) {
    $_SESSION["tasks"] = [
        ["title" => "Belajar PHP", "done" => false, "deadline" => "2025-06-14 14:30"],
        ["title" => "Kerjakan tugas UX", "done" => true, "deadline" => "2025-06-14 09:00"],
    ];
}

$tasks = $_SESSION["tasks"];
$feedback = "";

foreach ($tasks as &$task) {
    if (!isset($task["deadline"])) $task["deadline"] = null;
}
unset($task);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $modified = false;

    if (isset($_POST["toggle_done"])) {
        $index = (int)$_POST["toggle_done"];
        if (isset($tasks[$index])) {
            $tasks[$index]["done"] = !$tasks[$index]["done"];
            $modified = true;
        }
    } elseif (isset($_POST["delete"])) {
        $index = (int)$_POST["delete"];
        if (isset($tasks[$index])) {
            array_splice($tasks, $index, 1);
            $modified = true;
        }
    } elseif (isset($_POST["task"])) {
        $newTask = trim($_POST["task"]);
        $deadline = $_POST["deadline"] ?? null;

        if ($newTask === "") {
            $feedback = "⚠️ Tugas tidak boleh kosong!";
        } else {
            if (isset($_POST["index"]) && $_POST["index"] !== "") {
                $index = (int)$_POST["index"];
                if (isset($tasks[$index])) {
                    $tasks[$index]["title"] = $newTask;
                    $tasks[$index]["deadline"] = $deadline;
                    $feedback = "✅ Tugas berhasil diperbarui!";
                    $modified = true;
                }
            } else {
                $tasks[] = ["title" => $newTask, "done" => false, "deadline" => $deadline];
                $feedback = "✅ Tugas berhasil ditambahkan!";
                $modified = true;
            }
        }
    }

    if ($modified) {
        $_SESSION["tasks"] = $tasks;
    }
}
