<?php include 'includes/header.php'; ?>

<section class="hero">
    <h1>Generate Stylish QR Codes Instantly</h1>
    <p>
        Create QR codes for GitHub, LinkedIn, portfolio links, websites, email,
        phone numbers, or random demo content. Save your QR records and view them later.
    </p>

    <div class="hero-buttons">
        <button class="fancy-btn primary" onclick="generateRandomQR()">Generate Random QR</button>
        <button class="fancy-btn secondary" onclick="scrollToGenerator()">Create Custom QR</button>
    </div>
</section>

<section class="main-grid" id="generator">

    <div class="glass-card form-card">
        <h2>Create QR Code</h2>
        <p class="sub-text">Paste any link or text, then generate and save it.</p>

        <form action="save_qr.php" method="POST" id="saveForm">
            <label>QR Title</label>
            <input type="text" name="title" id="title" placeholder="Example: My GitHub Profile" required>

            <label>QR Content / Link</label>
            <textarea name="qr_content" id="qrText" placeholder="Paste your GitHub link or any text here..." required></textarea>

            <label>QR Type</label>
            <select name="qr_type" id="qrType">
                <option value="custom">Custom</option>
                <option value="github">GitHub</option>
                <option value="linkedin">LinkedIn</option>
                <option value="portfolio">Portfolio</option>
                <option value="email">Email</option>
                <option value="phone">Phone</option>
            </select>

            <label>QR Size</label>
            <select id="qrSize">
                <option value="180">180 x 180</option>
                <option value="220" selected>220 x 220</option>
                <option value="260">260 x 260</option>
                <option value="300">300 x 300</option>
            </select>

            <div class="button-row">
                <button type="button" class="fancy-btn primary" onclick="generateQR()">Generate</button>
                <button type="button" class="fancy-btn secondary" onclick="generateRandomQR()">Random</button>
                <button type="button" class="fancy-btn secondary" onclick="downloadQR()">Download</button>
                <button type="submit" class="fancy-btn save">Save</button>
                <button type="button" class="fancy-btn danger" onclick="clearQR()">Clear</button>
            </div>
        </form>

        <div id="messageBox" class="message-box"></div>
    </div>

    <div class="glass-card preview-card">
        <h2>QR Preview</h2>
        <p class="sub-text">Your QR code will appear below.</p>

        <div class="qr-box">
            <div id="placeholder">No QR generated yet</div>
            <div id="qrcode"></div>
        </div>

        <div class="stats-grid">
            <div class="stat">
                <span>Size</span>
                <strong id="sizeText">220px</strong>
            </div>
            <div class="stat">
                <span>Length</span>
                <strong id="lengthText">0</strong>
            </div>
            <div class="stat">
                <span>Status</span>
                <strong id="statusText">Waiting</strong>
            </div>
        </div>
    </div>

</section>

<?php include 'includes/footer.php'; ?>