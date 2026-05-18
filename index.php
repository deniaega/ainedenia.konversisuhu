<?php
$hasil = null;
$suhuInput = '';
$dariSatuan = 'C';
$keSatuan = 'F';

function konversiSuhu($nilai, $dari, $ke) {
    // Konversi semua ke Celsius dulu
    switch ($dari) {
        case 'C': $celsius = $nilai; break;
        case 'F': $celsius = ($nilai - 32) * 5 / 9; break;
        case 'K': $celsius = $nilai - 273.15; break;
        case 'R': $celsius = $nilai * 5 / 4; break;
    }

    // Konversi dari Celsius ke satuan tujuan
    switch ($ke) {
        case 'C': return $celsius;
        case 'F': return ($celsius * 9 / 5) + 32;
        case 'K': return $celsius + 273.15;
        case 'R': return $celsius * 4 / 5;
    }
}

function namaSatuan($kode) {
    $nama = ['C' => 'Celsius', 'F' => 'Fahrenheit', 'K' => 'Kelvin', 'R' => 'Reaumur'];
    return $nama[$kode] ?? $kode;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $suhuInput = $_POST['suhu'] ?? '';
    $dariSatuan = $_POST['dari'] ?? 'C';
    $keSatuan = $_POST['ke'] ?? 'F';

    if (is_numeric($suhuInput)) {
        $hasil = konversiSuhu((float)$suhuInput, $dariSatuan, $keSatuan);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌡️ Konversi Suhu — Pastel Purple</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="icon">🌡️</div>
            <h1>Konversi Suhu</h1>
            <p class="subtitle">Ubah satuan suhu dengan mudah & cepat</p>

            <form method="POST" action="">
                <div class="input-group">
                    <label for="suhu">Nilai Suhu</label>
                    <input type="number" step="any" name="suhu" id="suhu"
                           value="<?= htmlspecialchars($suhuInput) ?>"
                           placeholder="Masukkan angka..." required>
                </div>

                <div class="row">
                    <div class="input-group">
                        <label for="dari">Dari</label>
                        <select name="dari" id="dari">
                            <option value="C" <?= $dariSatuan==='C'?'selected':'' ?>>Celsius (°C)</option>
                            <option value="F" <?= $dariSatuan==='F'?'selected':'' ?>>Fahrenheit (°F)</option>
                            <option value="K" <?= $dariSatuan==='K'?'selected':'' ?>>Kelvin (K)</option>
                            <option value="R" <?= $dariSatuan==='R'?'selected':'' ?>>Reaumur (°R)</option>
                        </select>
                    </div>

                    <div class="arrow">→</div>

                    <div class="input-group">
                        <label for="ke">Ke</label>
                        <select name="ke" id="ke">
                            <option value="C" <?= $keSatuan==='C'?'selected':'' ?>>Celsius (°C)</option>
                            <option value="F" <?= $keSatuan==='F'?'selected':'' ?>>Fahrenheit (°F)</option>
                            <option value="K" <?= $keSatuan==='K'?'selected':'' ?>>Kelvin (K)</option>
                            <option value="R" <?= $keSatuan==='R'?'selected':'' ?>>Reaumur (°R)</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-convert">✨ Konversi Sekarang</button>
            </form>

            <?php if ($hasil !== null): ?>
                <div class="result">
                    <p class="result-label">Hasil Konversi</p>
                    <p class="result-value">
                        <?= number_format((float)$suhuInput, 2) ?>° <?= namaSatuan($dariSatuan) ?>
                        <span class="equals">=</span>
                    </p>
                    <p class="result-main"><?= number_format($hasil, 2) ?>° <?= namaSatuan($keSatuan) ?></p>
                </div>
            <?php endif; ?>
        </div>

        <footer>Made with 💜 Denia Ega</footer>
    </div>
</body>
</html>