<?php
require_once 'config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $pdo->prepare("DELETE FROM qr_codes WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: history.php?deleted=1");
exit();