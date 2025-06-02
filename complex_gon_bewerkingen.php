<?php
// Nouredine Tahrioui - Bewerkingen met gon. vorm van complexe getallen

function randomComplexGon() {
    $r = rand(2, 9);
    $phi = rand(10, 350);
    return [$r, $phi];
}

function complexToString($r, $phi) {
    return "{$r} (cos({$phi}°) + i sin({$phi}°))";
}

function oefeningVermenigvuldigen($seed = null) {
    if ($seed !== null) srand($seed);
    list($r1, $phi1) = randomComplexGon();
    list($r2, $phi2) = randomComplexGon();
    $vraag = "Bereken het product van:<br>"
        . "z₁ = " . complexToString($r1, $phi1) . "<br>"
        . "z₂ = " . complexToString($r2, $phi2);
    $r = $r1 * $r2;
    $phi = ($phi1 + $phi2) % 360;
    $antwoord = "z₁·z₂ = {$r} (cos({$phi}°) + i sin({$phi}°))";
    $punten = [
        ['r' => $r1, 'phi' => $phi1, 'kleur' => '#2a5d9f', 'label' => 'z₁'],
        ['r' => $r2, 'phi' => $phi2, 'kleur' => '#2a5d9f', 'label' => 'z₂'],
        ['r' => $r, 'phi' => $phi, 'kleur' => 'red', 'label' => 'z₁·z₂']
    ];
    return [$vraag, $antwoord, $punten];
}

function oefeningDelen($seed = null) {
    if ($seed !== null) srand($seed + 1000);
    list($r1, $phi1) = randomComplexGon();
    list($r2, $phi2) = randomComplexGon();
    $vraag = "Bereken het quotiënt van:<br>"
        . "z₁ = " . complexToString($r1, $phi1) . "<br>"
        . "z₂ = " . complexToString($r2, $phi2);
    $r = round($r1 / $r2, 2);
    $phi = ($phi1 - $phi2 + 360) % 360;
    $antwoord = "z₁/z₂ = {$r} (cos({$phi}°) + i sin({$phi}°))";
    $punten = [
        ['r' => $r1, 'phi' => $phi1, 'kleur' => '#2a5d9f', 'label' => 'z₁'],
        ['r' => $r2, 'phi' => $phi2, 'kleur' => '#2a5d9f', 'label' => 'z₂'],
        ['r' => $r, 'phi' => $phi, 'kleur' => 'red', 'label' => 'z₁/z₂']
    ];
    return [$vraag, $antwoord, $punten];
}

function oefeningMacht($seed = null) {
    if ($seed !== null) srand($seed + 2000);
    list($r, $phi) = randomComplexGon();
    $n = rand(2, 4);
    $vraag = "Bereken de {$n}-de macht van:<br>"
        . "z = " . complexToString($r, $phi);
    $rM = pow($r, $n);
    $phiM = ($n * $phi) % 360;
    $antwoord = "z^{$n} = {$rM} (cos({$phiM}°) + i sin({$phiM}°))";
    $punten = [
        ['r' => $r, 'phi' => $phi, 'kleur' => '#2a5d9f', 'label' => 'z'],
        ['r' => $rM, 'phi' => $phiM, 'kleur' => 'red', 'label' => "z^{$n}"]
    ];
    return [$vraag, $antwoord, $punten];
}

// Genereer 10 verschillende oefeningen met verschillende seeds
$oefeningen = [];
for ($i = 0; $i < 10; $i++) {
    $seed = rand(1, 999999) + $i * 1000;
    $type = ['vermenigvuldigen', 'delen', 'macht'][array_rand(['vermenigvuldigen', 'delen', 'macht'])];
    if ($type == 'vermenigvuldigen') {
        $oefeningen[] = oefeningVermenigvuldigen($seed);
    } elseif ($type == 'delen') {
        $oefeningen[] = oefeningDelen($seed);
    } else {
        $oefeningen[] = oefeningMacht($seed);
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bewerkingen met gon. vorm van complexe getallen</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f7f7f7; }
        .container { max-width: 700px; margin: 30px auto; background: #fff; border-radius: 8px; box-shadow: 0 2px 8px #0001; padding: 24px; }
        h2 { color: #2a5d9f; }
        .antwoord { color: #155724; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; padding: 12px; margin-top: 12px; }
        .plot { margin-top: 12px; text-align: center; }
        .refresh-btn { background: #2a5d9f; color: #fff; border: none; border-radius: 4px; padding: 8px 18px; font-size: 1em; cursor: pointer; margin: 18px 0 18px 0;}
        .refresh-btn:hover { background: #17406a; }
        ol { margin-top: 20px; }
        .label { font-size: 12px; fill: #222; }
    </style>
</head>
<body>
<div class="container">
    <h2>Bewerkingen met gon. vorm van complexe getallen</h2>
    <form method="get" style="text-align:right;">
        <button class="refresh-btn" type="submit">Nieuwe oefeningen &#x21bb;</button>
    </form>
    <ol>
    <?php foreach ($oefeningen as $oef): list($vraag, $antwoord, $punten) = $oef; ?>
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
                        <?php foreach ($punten as $pt): 
                            $r = 100 * min($pt['r'], 1.2);
                            $phi = deg2rad($pt['phi']);
                            $x = round($r * cos($phi), 1);
                            $y = round(-$r * sin($phi), 1); // SVG y-axis inverted
                        ?>
                        <line x1="0" y1="0" x2="<?= $x ?>" y2="<?= $y ?>" stroke="<?= $pt['kleur'] ?>" stroke-width="2"/>
                        <circle cx="<?= $x ?>" cy="<?= $y ?>" r="7" fill="<?= $pt['kleur'] ?>" stroke="black"/>
                        <text x="<?= $x+8 ?>" y="<?= $y ?>" class="label"><?= $pt['label'] ?></text>
                        <?php endforeach; ?>
                        <circle cx="0" cy="0" r="100" fill="none" stroke="#2a5d9f" stroke-width="2"/>
                    </svg>
                    <div style="font-size:small;">Het rode punt is het antwoord, blauw zijn de gegeven getallen (op de eenheidscirkel).</div>
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
