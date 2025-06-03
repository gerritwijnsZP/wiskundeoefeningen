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
    return [$vraag, $antwoord, $wortels];
}

// Genereer 10 verschillende oefeningen met verschillende seeds
$oefeningen = [];
for ($i = 0; $i < 10; $i++) {
    $seed = rand(1, 999999) + $i * 1000;
    $oefeningen[] = wortelOefening($seed);
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Machtswortels trekken uit complexe getallen</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; }
        .container { max-width: 700px; margin: 30px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #0001; padding: 24px; }
        h2 { color: #2a5d9f; }
        .antwoord { color: #155724; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; padding: 12px; margin-top: 12px; }
        .plot { margin-top: 12px; text-align: center; }
        .refresh-btn { background: #2a5d9f; color: #fff; border: none; border-radius: 4px; padding: 8px 18px; font-size: 1em; cursor: pointer; margin: 18px 0 18px 0;}
        .refresh-btn:hover { background: #17406a; }
        ol { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Machtswortels trekken uit complexe getallen</h2>
    <form method="get" style="text-align:right;">
        <button class="refresh-btn" type="submit">Nieuwe oefeningen &#x21bb;</button>
    </form>
    <ol>
    <?php foreach ($oefeningen as $oef): list($vraag, $antwoord, $wortels) = $oef; ?>
        <li style="margin-bottom:32px;">
            <div><?= $vraag ?></div>
            <details>
                <summary>Toon antwoord</summary>
                <div class="antwoord"><?= $antwoord ?></div>
                <div class="plot">
                    <svg width="260" height="260" viewBox="-130 -130 260 260">
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
                        <?php endforeach; ?>
                        <circle cx="0" cy="0" r="100" fill="none" stroke="#2a5d9f" stroke-width="2"/>
                    </svg>
                    <div style="font-size:small;">De wortels zijn in het complexe vlak getekend (rood) op de eenheidscirkel.</div>
                </div>
            </details>
        </li>
    <?php endforeach; ?>
    </ol>
    <form method="get" style="text-align:right;">
        <button class="refresh-btn" type="submit">Nieuwe oefeningen &#x21bb;</button>
    </form>
</div>
</body>
</html>
