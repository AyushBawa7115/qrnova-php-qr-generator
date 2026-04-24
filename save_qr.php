<?php
require_once 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"]);
    $qr_content = trim($_POST["qr_content"]);
    $qr_type = trim($_POST["qr_type"]);

    if (empty($title) || empty($qr_content)) {
        header("Location: index.php?error=empty");
        exit();
    }

    $stmt = $pdo->prepare("INSERT INTO qr_codes (title, qr_content, qr_type) VALUES (?, ?, ?)");
    $stmt->execute([$title, $qr_content, $qr_type]);

    header("Location: history.php?saved=1");
    exit();
}

header("Location: index.php");
exit();