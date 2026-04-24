<?php
require_once 'config/db.php';
include 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM qr_codes ORDER BY created_at DESC");
$codes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="hero small-hero">
    <h1>Saved QR History</h1>
    <p>View, regenerate, and delete your saved QR records.</p>
</section>

<section class="history-grid">
    <?php if (count($codes) > 0): ?>
        <?php foreach ($codes as $code): ?>
            <div class="glass-card history-card">
                <h3><?= htmlspecialchars($code['title']); ?></h3>
                <p class="type-badge"><?= htmlspecialchars($code['qr_type']); ?></p>

                <p class="content-preview">
                    <?= htmlspecialchars($code['qr_content']); ?>
                </p>

                <p class="date-text">
                    Saved: <?= htmlspecialchars($code['created_at']); ?>
                </p>

                <div class="button-row">
                    <button
                        class="fancy-btn primary"
                        onclick="regenerateFromHistory('<?= htmlspecialchars($code['qr_content'], ENT_QUOTES); ?>')">
                        Preview
                    </button>

                    <a
                        class="fancy-btn danger"
                        href="delete_qr.php?id=<?= $code['id']; ?>"
                        onclick="return confirm('Delete this QR record?');">
                        Delete
                    </a>
                </div>

                <div class="mini-qr-box">
                    <div class="history-qr" data-content="<?= htmlspecialchars($code['qr_content'], ENT_QUOTES); ?>"></div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="glass-card empty-card">
            <h2>No QR codes saved yet</h2>
            <p>Go back to the generator and save your first QR code.</p>
            <br>
            <a href="index.php" class="fancy-btn primary">Create QR</a>
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>