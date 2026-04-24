const qrText = document.getElementById("qrText");
const qrcode = document.getElementById("qrcode");
const qrSize = document.getElementById("qrSize");
const placeholder = document.getElementById("placeholder");
const sizeText = document.getElementById("sizeText");
const lengthText = document.getElementById("lengthText");
const statusText = document.getElementById("statusText");
const messageBox = document.getElementById("messageBox");

function showMessage(message, type = "success") {
    if (!messageBox) return;

    messageBox.textContent = message;
    messageBox.className = `message-box ${type}`;
    messageBox.style.display = "block";

    setTimeout(() => {
        messageBox.style.display = "none";
    }, 3000);
}

function generateQR() {
    if (!qrText || !qrcode) return;

    const text = qrText.value.trim();
    const size = parseInt(qrSize.value);

    if (text === "") {
        showMessage("Enter a link or text first.", "error");
        return;
    }

    qrcode.innerHTML = "";

    new QRCode(qrcode, {
        text: text,
        width: size,
        height: size,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });

    if (placeholder) placeholder.style.display = "none";
    if (sizeText) sizeText.textContent = `${size}px`;
    if (lengthText) lengthText.textContent = text.length;
    if (statusText) statusText.textContent = "Generated";

    showMessage("QR generated successfully.", "success");
}

function generateRandomQR() {
    const randomItems = [
        "https://github.com/yourusername",
        "https://linkedin.com/in/yourusername",
        "https://yourportfolio.com",
        "mailto:yourname@email.com",
        "tel:+1234567890",
        "Code. Build. Repeat.",
        "Welcome to my QRNova project!",
        "https://example.com"
    ];

    const randomValue = randomItems[Math.floor(Math.random() * randomItems.length)];

    if (qrText) qrText.value = randomValue;

    const title = document.getElementById("title");
    if (title && title.value.trim() === "") {
        title.value = "Random QR Code";
    }

    generateQR();
}

function clearQR() {
    if (qrText) qrText.value = "";
    if (qrcode) qrcode.innerHTML = "";
    if (placeholder) placeholder.style.display = "block";
    if (sizeText) sizeText.textContent = "220px";
    if (lengthText) lengthText.textContent = "0";
    if (statusText) statusText.textContent = "Waiting";

    showMessage("QR cleared.", "success");
}

function downloadQR() {
    const canvas = qrcode ? qrcode.querySelector("canvas") : null;
    const img = qrcode ? qrcode.querySelector("img") : null;

    if (!canvas && !img) {
        showMessage("Generate a QR code before downloading.", "error");
        return;
    }

    let imageData;

    if (canvas) {
        imageData = canvas.toDataURL("image/png");
    } else {
        imageData = img.src;
    }

    const link = document.createElement("a");
    link.href = imageData;
    link.download = "qrnova-code.png";
    link.click();

    showMessage("QR downloaded.", "success");
}

function scrollToGenerator() {
    const section = document.getElementById("generator");
    if (section) {
        section.scrollIntoView({ behavior: "smooth" });
    }
}

function regenerateFromHistory(content) {
    localStorage.setItem("historyQR", content);
    window.location.href = "index.php";
}

document.addEventListener("DOMContentLoaded", () => {
    const savedContent = localStorage.getItem("historyQR");

    if (savedContent && qrText) {
        qrText.value = savedContent;
        localStorage.removeItem("historyQR");
        generateQR();
    }

    document.querySelectorAll(".history-qr").forEach((box) => {
        const content = box.dataset.content;

        new QRCode(box, {
            text: content,
            width: 120,
            height: 120,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    });

    const glow = document.querySelector(".cursor-glow");

    document.addEventListener("mousemove", (e) => {
        if (glow) {
            glow.style.left = e.clientX + "px";
            glow.style.top = e.clientY + "px";
        }
    });
});