<?php
// afstand_punten.php
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Afstand tussen twee punten</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        fieldset { margin-bottom: 30px; padding: 20px; }
        label { display: inline-block; width: 120px; margin-bottom: 8px; }
        input[type="number"] { width: 100px; }
        .result { background: #f4f4f4; padding: 15px; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Afstand tussen twee punten</h1>

    <form method="post">
        <fieldset>
            <legend><strong>Afstand tussen twee punten</strong></legend>
            <label>A(x):</label><input type="number" step="any" name="x1" required><br>
            <label>A(y):</label><input type="number" step="any" name="y1" required><br>
            <label>B(x):</label><input type="number" step="any" name="x2" required><br>
            <label>B(y):</label><input type="number" step="any" name="y2" required><br>
        </fieldset>

        <input type="submit" value="Bereken">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $x1 = floatval($_POST["x1"]);
    $y1 = floatval($_POST["y1"]);
    $x2 = floatval($_POST["x2"]);
    $y2 = floatval($_POST["y2"]);

    $afstand = sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));

    echo '<div class="result">';
    echo '<h2>Afstand tussen twee punten</h2>';
    echo "Punt A = ($x1, $y1)<br>";
    echo "Punt B = ($x2, $y2)<br>";
    echo "Afstand = " . round($afstand, 2);
    echo '</div>';
}
?>
</body>
</html>
