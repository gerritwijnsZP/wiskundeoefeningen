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
    $data = [
        'type' => 'vermenigvuldigen',
        'r1' => $r1, 'phi1' => $phi1,
        'r2' => $r2, 'phi2' => $phi2,
        'r' => $r, 'phi' => $phi
    ];
    return [$vraag, $antwoord, $data];
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
    $data = [
        'type' => 'delen',
        'r1' => $r1, 'phi1' => $phi1,
        'r2' => $r2, 'phi2' => $phi2,
        'r' => $r, 'phi' => $phi
    ];
    return [$vraag, $antwoord, $data];
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
    $data = [
        'type' => 'macht',
        'r' => $r, 'phi' => $phi,
        'n' => $n, 'rM' => $rM, 'phiM' => $phiM
    ];
    return [$vraag, $antwoord, $data];
}

// Oefening kiezen
$seed = isset($_GET['seed']) ? intval($_GET['seed']) : rand(1, 999999);
$types = ['vermenigvuldigen', 'delen', 'macht'];
$type = isset($_GET['type']) && in_array($_GET['type'], $types) ? $_GET['type'] : $types[array_rand($types)];
if ($type == 'vermenigvuldigen') {
    list($vraag, $antwoord, $data) = oefeningVermenigvuldigen($seed);
} elseif ($type == 'delen') {
    list($vraag, $antwoord, $data) = oefeningDelen($seed);
} else {
    list($vraag, $antwoord, $data) = oefeningMacht($seed);
}

$user_input = isset($_POST['antwoord']) ? trim($_POST['antwoord']) : '';
$show_solution = isset($_POST['show_solution']);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Bewerkingen met gon. vorm van complexe getallen</title>
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
    <h2>Bewerkingen met gon. vorm van complexe getallen</h2>
    <a class="refresh-link" href="?type=<?= $type ?>&seed=<?= rand(1,999999) ?>">Nieuwe oefening &#x21bb;</a>
    <div class="vraag"><?= $vraag ?></div>
    <form method="post" autocomplete="off">
        <label for="antwoord">Geef het antwoord in goniometrische vorm (bijv. 2 (cos(30°) + i sin(30°))):</label>
        <input class="inputveld" type="text" name="antwoord" id="antwoord" value="<?= htmlspecialchars($user_input) ?>" required>
        <button class="btn" type="submit" name="show_solution" value="1">Controleer &amp; Toon oplossing</button>
        <input type="hidden" name="seed" value="<?= $seed ?>">
        <input type="hidden" name="type" value="<?= $type ?>">
    </form>
    <?php
    if ($show_solution) {
        $goed = false;
        if ($type == 'vermenigvuldigen' || $type == 'delen') {
            $rk = $data['r'];
            $phik = $data['phi'];
        } else {
            $rk = $data['rM'];
            $phik = $data['phiM'];
        }
        if (preg_match('/([0-9\.\,]+)[^\d]+([0-9\.\,\-]+)/', str_replace(',', '.', $user_input), $m)) {
            $rin = floatval($m[1]);
            $phiin = floatval($m[2]);
            if (abs($rin - $rk) < 0.05 && abs(fmod($phiin - $phik + 360, 360)) < 2) {
                $goed = true;
            }
        }
        if ($goed) {
            echo '<div class="antwoord">Correct! Dit is het juiste antwoord.</div>';
        } else {
            echo '<div class="feedback">Niet correct of niet in juiste vorm. Bekijk de oplossing hieronder.</div>';
        }
        echo '<div class="antwoord">'.$antwoord.'</div>';

        ?>
        <div class="plot">
            <svg class="unitcircle" width="260" height="260" viewBox="-130 -130 260 260">
                <circle cx="0" cy="0" r="120" fill="none" stroke="#ccc"/>
                <line x1="-120" y1="0" x2="120" y2="0" stroke="#aaa"/>
                <line x1="0" y1="-120" x2="0" y2="120" stroke="#aaa"/>
                <?php
                $points = [];
                if ($type == 'vermenigvuldigen') {
                    $points[] = ['r' => $data['r1'], 'phi' => $data['phi1'], 'kleur' => '#2a5d9f'];
                    $points[] = ['r' => $data['r2'], 'phi' => $data['phi2'], 'kleur' => '#2a5d9f'];
                    $points[] = ['r' => $data['r'], 'phi' => $data['phi'], 'kleur' => 'red'];
                } elseif ($type == 'delen') {
                    $points[] = ['r' => $data['r1'], 'phi' => $data['phi1'], 'kleur' => '#2a5d9f'];
                    $points[] = ['r' => $data['r2'], 'phi' => $data['phi2'], 'kleur' => '#2a5d9f'];
                    $points[] = ['r' => $data['r'], 'phi' => $data['phi'], 'kleur' => 'red'];
                } else { 
                    $points[] = ['r' => $data['r'], 'phi' => $data['phi'], 'kleur' => '#2a5d9f'];
                    $points[] = ['r' => $data['rM'], 'phi' => $data['phiM'], 'kleur' => 'red'];
                }
                foreach ($points as $pt) {
                    $r = 100 * min($pt['r'], 1.2); 
                    $phi = deg2rad($pt['phi']);
                    $x = round($r * cos($phi), 1);
                    $y = round(-$r * sin($phi), 1);
                    echo '<circle cx="'.$x.'" cy="'.$y.'" r="7" fill="'.$pt['kleur'].'" stroke="black"/>';
                    echo '<line x1="0" y1="0" x2="'.$x.'" y2="'.$y.'" stroke="'.$pt['kleur'].'" stroke-dasharray="3,2"/>';
                }
                ?>
                <circle cx="0" cy="0" r="100" fill="none" stroke="#2a5d9f" stroke-width="2"/>
            </svg>
            <div style="font-size:small;">Het rode punt is het antwoord, blauw zijn de gegeven getallen (op de eenheidscirkel).</div>
        </div>
        <?php
    }
    ?>
</div>
</body>
</html>
