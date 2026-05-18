<?php
// eerstegraadsfunctie.php
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Eerstegraadsfunctie</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        fieldset { margin-bottom: 30px; padding: 20px; }
        label { display: inline-block; width: 120px; margin-bottom: 8px; }
        input[type="number"] { width: 100px; }
        .result { background: #f4f4f4; padding: 15px; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>Bespreking van de eerstegraadsfunctie</h1>

    <form method="post">
        <fieldset>
            <legend><strong>f(x) = ax + b</strong></legend>
            <label>a:</label><input type="number" step="any" name="a" required><br>
            <label>b:</label><input type="number" step="any" name="b" required><br>
        </fieldset>

        <input type="submit" value="Bereken">
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = floatval($_POST["a"]);
    $b = floatval($_POST["b"]);

    echo '<div class="result">';
    echo '<h2>Bespreking van de eerstegraadsfunctie</h2>';
    echo "f(x) = {$a}x + {$b}<br><br>";

    if ($a != 0) {
        $nulpunt = -$b / $a;

        echo "<strong>Domein:</strong> ℝ<br>";
        echo "<strong>Bereik:</strong> ℝ<br>";

        echo "<strong>Nulpunt:</strong> x = " . round($nulpunt, 4) . "<br>";
        echo "<strong>Snijpunt met x-as:</strong> (" . round($nulpunt, 4) . ", 0)<br>";
        echo "<strong>Snijpunt met y-as:</strong> (0, $b)<br>";

        if ($a > 0) {
            echo "<strong>Verloop:</strong> stijgend<br>";
            echo "<strong>Tekenverloop:</strong> negatief voor x < " . round($nulpunt, 4) .
                 ", positief voor x > " . round($nulpunt, 4) . "<br>";
        } else {
            echo "<strong>Verloop:</strong> dalend<br>";
            echo "<strong>Tekenverloop:</strong> positief voor x < " . round($nulpunt, 4) .
                 ", negatief voor x > " . round($nulpunt, 4) . "<br>";
        }
    } else {
        echo "<strong>Dit is geen eerstegraadsfunctie</strong> (a = 0).<br>";
        echo "<strong>Domein:</strong> ℝ<br>";
        echo "<strong>Bereik:</strong> {$b}<br>";
        echo "<strong>Snijpunt met y-as:</strong> (0, $b)<br>";

        if ($b == 0) {
            echo "<strong>Functie:</strong> nulfunctie<br>";
        } else {
            echo "<strong>Functie:</strong> constante functie<br>";
        }
    }

    echo '</div>';
}
?>
</body>
</html>
