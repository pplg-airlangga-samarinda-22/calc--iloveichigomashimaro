<?php
// Menangani operasi kalkulator jika form disubmit
session_start(); // Start session to store numbers temporarily

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cek jika tombol angka ditekan
    if (isset($_POST['angka'])) {
        if (empty($_SESSION['current_number'])) {
            $_SESSION['current_number'] = $_POST['angka'];
        } else {
            $_SESSION['current_number'] .= $_POST['angka'];
        }
    }

    // Cek jika operasi matematika ditekan
    if (isset($_POST['operasi'])) {
        if (isset($_SESSION['current_number'])) {
            $_SESSION['angka1'] = $_SESSION['current_number'];
            $_SESSION['operasi'] = $_POST['operasi'];
            $_SESSION['current_number'] = '';  // Clear the current number after operation
        }
    }

    // Cek jika '=' ditekan untuk menghitung hasil
    if (isset($_POST['equal'])) {
        if (isset($_SESSION['angka1']) && isset($_SESSION['current_number']) && isset($_SESSION['operasi'])) {
            $angka1 = $_SESSION['angka1'];
            $angka2 = $_SESSION['current_number'];
            $operasi = $_SESSION['operasi'];

            switch ($operasi) {
                case 'tambah':
                    $_SESSION['hasil'] = $angka1 + $angka2;
                    break;
                case 'kurang':
                    $_SESSION['hasil'] = $angka1 - $angka2;
                    break;
                case 'kali':
                    $_SESSION['hasil'] = $angka1 * $angka2;
                    break;
                case 'bagi':
                    if ($angka2 != 0) {
                        $_SESSION['hasil'] = $angka1 / $angka2;
                    } else {
                        $_SESSION['error'] = "Tidak bisa membagi dengan 0.";
                    }
                    break;
            }
            $_SESSION['current_number'] = ''; // Reset the current number after calculation
        }
    }

    // Cek jika tombol 'C' ditekan untuk reset
    if (isset($_POST['clear'])) {
        $_SESSION = []; // Clear session to reset the calculator
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kalkulator Sederhana</title>
    <style>
        /* Same styles as before */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f2f2f2;
            margin: 0;
        }
        .calculator {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 280px;
        }
        .calculator h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .screen {
            width: 100%;
            height: 50px;
            background-color: #f0f0f0;
            border-radius: 5px;
            text-align: right;
            padding: 10px;
            font-size: 24px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        .buttons button {
            padding: 20px;
            font-size: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 100px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .buttons button:hover {
            background-color: #ddd;
        }
        .buttons button:active {
            background-color: #bbb;
        }
        .buttons button.operator {
            background-color: #4CAF50;
            color: white;
        }
        .buttons button.operator:hover {
            background-color: #45a049;
        }
        .buttons button.double {
            grid-column: span 2;
        }
        .result {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-top: 10px;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="calculator">
    <h2>Kalkulator</h2>
    <form method="POST">
        <div class="screen">
            <?php
            if (isset($_SESSION['hasil'])) {
                echo $_SESSION['hasil'];
            } elseif (isset($_SESSION['error'])) {
                echo '<span class="error">' . $_SESSION['error'] . '</span>';
            } elseif (isset($_SESSION['current_number'])) {
                echo $_SESSION['current_number'];
            }
            ?>
        </div>
        <div class="buttons">
            <!-- Tombol angka -->
            <button type="submit" name="angka" value="7">7</button>
            <button type="submit" name="angka" value="8">8</button>
            <button type="submit" name="angka" value="9">9</button>
            <button type="submit" name="operasi" value="tambah" class="operator">+</button>
            
            <button type="submit" name="angka" value="4">4</button>
            <button type="submit" name="angka" value="5">5</button>
            <button type="submit" name="angka" value="6">6</button>
            <button type="submit" name="operasi" value="kurang" class="operator">-</button>
            
            <button type="submit" name="angka" value="1">1</button>
            <button type="submit" name="angka" value="2">2</button>
            <button type="submit" name="angka" value="3">3</button>
            <button type="submit" name="operasi" value="kali" class="operator">×</button>
            
            <button type="submit" name="angka" value="0" class="double">0</button>
            <button type="submit" name="operasi" value="bagi" class="operator">÷</button>
            <button type="submit" name="equal" class="operator">=</button>
            
            <!-- Tombol Clear -->
            <button type="submit" name="clear" class="operator">Clear</button>
            <a href="index.php">Back</a>
        </div>
    </form>
</div>

</body>
</html>
