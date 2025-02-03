<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kalkulator Sederhana</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .calculator {
            background-color: #fff;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .calculator h2 {
            text-align: center;
        }
        input[type="number"], select {
            width: 100%;
            padding-left: 5px;
            padding-right: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .result {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="calculator">
    <h2>Kalkulator Sederhana</h2>

    <form method="POST">
        <label for="angka1">Angka 1:</label>
        <input type="number" name="angka1" id="angka1" required>
        <label for="angka2">Angka 2:</label>
        <input type="number" name="angka2" id="angka2" required>

        <label for="operasi">Operasi:</label>
        <select name="operasi" id="operasi" required>
            <option value="tambah">Tambah (+)</option>
            <option value="kurang">Kurang (-)</option>
            <option value="kali">Kali (×)</option>
            <option value="bagi">Bagi (÷)</option>
        </select>

        <input type="submit" value="Hitung">
        <a href="kalkulator2.php">Kalkulator ver 2</a>
    </form>

    <div class="result">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $angka1 = $_POST['angka1'];
            $angka2 = $_POST['angka2'];
            $operasi = $_POST['operasi'];
            $hasil = 0;

            // Menangani operasi berdasarkan pilihan
            switch ($operasi) {
                case 'tambah':
                    $hasil = $angka1 + $angka2;
                    break;
                case 'kurang':
                    $hasil = $angka1 - $angka2;
                    break;
                case 'kali':
                    $hasil = $angka1 * $angka2;
                    break;
                case 'bagi':
                    if ($angka2 != 0) {
                        $hasil = $angka1 / $angka2;
                    } else {
                        echo "Tidak bisa membagi dengan 0.";
                        exit;
                    }
                    break;
            }

            // Menampilkan hasil
            echo "Hasil: $hasil";
        }
        ?>
    </div>
</div>

</body>
</html>
