<?php
// Nouredine Tahrioui - Machtswortels trekken uit complexe getallen

function randomComplexCart() {
    $a = rand(-8, 8);
    $b = rand(-8, 8);
    if ($a == 0 && $b == 0) $a = 1;
    return [$a, $b];
}

function cartToGon($a, $b) {
    $r = sqrt($a*$a + $b*$b);
    $phi = rad2deg(atan2($b, $a));
    if ($phi < 0) $phi += 360;
    return [$r, $phi];
}

function wortelOefening($seed = null) {
    if ($seed !== null) srand($seed);
    $vorm = rand(0, 1);
    $n = rand(3, 5);
    if ($vorm == 0) {
        // a+bi vorm
        list($a, $b) = randomComplexCart();
        list($r, $phi) = cartToGon($a, $b);
        $vraag = "Bepaal alle {$n}-de machtswortels van het getal:<br>z = {$a} + {$b}i";
        $vraag_data = ['vorm' => 'cart', 'a' => $a, 'b' => $b, 'n' => $n, 'r' => $r, 'phi' => $phi];
    } else {
        // goniometrische vorm
        $r = rand(2, 8);
        $phi = rand(0, 359);
        $vraag = "Bepaal alle {$n}-de machtswortels van het getal:<br>z = {$r} (cos({$phi}°) + i sin({$phi}°))";
        $vraag_data = ['vorm' => 'gon', 'r' => $r, 'phi' => $phi, 'n' => $n];
    }
    $wortels = [];
    for ($k = 0; $k < $n; $k++) {
        $rk = round(pow($vraag_data['r'], 1/$n), 2);
        $phik = round(($vraag_data['phi'] + 360*$k)/$n, 2);
        $wortels[] = [$rk, $phik];
    }
    $antwoord = "De oplossingen zijn:<br>";
    foreach ($wortels as $i => $w) {
        $antwoord .= "z<sub>{$i}</sub> = {$w[0]} (cos({$w[1]}°) + i sin({$w[1]}°))<br>";
    }
    return [$vraag, $antwoord, $wortels, $vraag_data];
}

// Seed voor consistentie bij refresh zonder reload
$seed = isset($_GET['seed']) ? intval($_GET['seed']) : rand(1, 999999);
list($vraag, $antwoord, $wortels, $vraag_data) = wortelOefening($seed);

$user_input = isset($_POST['antwoord']) ? trim($_POST['antwoord']) : '';
$show_solution = isset($_POST['show_solution']);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Machtswortels trekken uit complexe getallen</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; }
        .container { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #0001; padding: 24px; }
        h2 { color: #2a5d9f; }
        .vraag { font-size: 1.15em; margin-bottom: 18px; }
        .antwoord { color: #155724; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; padding: 12px; margin-top: 18px; }
        .plot { margin-top: 20px; text-align: center; }
        .btn { background: #2a5d9f; color: #fff; border: none; border-radius: 4px; padding: 8px 18px; font-size: 1em; cursor: pointer; margin-right: 8px;}
        .btn:hover { background: #17406a; }
        .inputveld { width: 100%; padding: 8px; font-size: 1em; border: 1px solid #bbb; border-radius: 4px; margin-bottom: 10px;}
        .refresh-link { float: right; font-size: 0.95em; }
        .unitcircle { margin: 0 auto; display: block; }
        .feedback { margin-top: 10px; color: #b94a48; }
    </style>
</head>
<body>
<div class="container">
    <h2>Machtswortels trekken uit complexe getallen</h2>
    <a class="refresh-link" href="?seed=<?= rand(1,999999) ?>">Nieuwe oefening &#x21bb;</a>
    <div class="vraag"><?= $vraag ?></div>
    <form method="post" autocomplete="off">
        <label for="antwoord">Geef één van de wortels in goniometrische vorm (bijv. 2 (cos(30°) + i sin(30°))):</label>
        <input class="inputveld" type="text" name="antwoord" id="antwoord" value="<?= htmlspecialchars($user_input) ?>" required>
        <button class="btn" type="submit" name="show_solution" value="1">Controleer &amp; Toon oplossing</button>
        <input type="hidden" name="seed" value="<?= $seed ?>">
    </form>
    <?php
    if ($show_solution) {
        // Simpele check: komt het antwoord (ongeveer) overeen met een van de wortels?
        $goed = false;
        foreach ($wortels as $w) {
            $rk = $w[0];
            $phik = $w[1];
            // Zoek getallen in de input
            if (preg_match('/([0-9\.\,]+)[^\d]+([0-9\.\,\-]+)/', str_replace(',', '.', $user_input), $m)) {
                $rin = floatval($m[1]);
                $phiin = floatval($m[2]);
                // Vergelijk modulus en argument met tolerantie
                if (abs($rin - $rk) < 0.05 && abs(fmod($phiin - $phik + 360, 360)) < 2) {
                    $goed = true;
                    break;
                }
            }
        }
        if ($goed) {
            echo '<div class="antwoord">Correct! Dit is inderdaad een van de wortels.</div>';
        } else {
            echo '<div class="feedback">Niet correct of niet in juiste vorm. Bekijk de oplossing hieronder.</div>';
        }
        echo '<div class="antwoord">'.$antwoord.'</div>';
        // Plot
        ?>
        <div class="plot">
            <svg class="unitcircle" width="260" height="260" viewBox="-130 -130 260 260">
                <circle cx="0" cy="0" r="120" fill="none" stroke="#ccc"/>
                <line x1="-120" y1="0" x2="120" y2="0" stroke="#aaa"/>
                <line x1="0" y1="-120" x2="0" y2="120" stroke="#aaa"/>
                <?php foreach ($wortels as $w): 
                    $r = 100 * $w[0];
                    $phi = deg2rad($w[1]);
                    $x = round($r * cos($phi), 1);
                    $y = round(-$r * sin($phi), 1); // SVG y-axis inverted
                ?>
                <circle cx="<?= $x ?>" cy="<?= $y ?>" r="7" fill="red" stroke="black"/>
                <line x1="0" y1="0" x2="<?= $x ?>" y2="<?= $y ?>" stroke="red" stroke-dasharray="3,2"/>
                <?php endforeach; ?>
                <circle cx="0" cy="0" r="100" fill="none" stroke="#2a5d9f" stroke-width="2"/>
            </svg>
            <div style="font-size:small;">De wortels zijn in het complexe vlak getekend (rood) op de eenheidscirkel.</div>
        </div>
        <?php
    }
    ?>
</div>
</body>
</html>
