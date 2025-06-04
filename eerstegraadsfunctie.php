<?php
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

function fractiemogelijk($getal)
{
    $tol = 1.0E-6;
    $h1 = 1; $h2 = 0;
    $k1 = 0; $k2 = 1;
    $b = $getal;

    do {
        $a = floor($b);
        $aux = $h1; $h1 = $a * $h1 + $h2; $h2 = $aux;
        $aux = $k1; $k1 = $a * $k1 + $k2; $k2 = $aux;

        if ($b - $a == 0) break;
        $b = 1 / ($b - $a);

    } while (abs($getal - $h1 / $k1) > $getal * $tol && $k1 < 1000);

    if ($k1 == 1) {
        return $h1;
    }

    return "\\dfrac{" . $h1 . "}{" . $k1 . "}";
}

class Fabriek extends OefeningFactory
{
    public function run()
    {
        return $this->oef13();
    }

    private function oef13()
    {
        $a = rand(-5, 5);
        while ($a == 0) {
            $a = rand(-5, 5);
        }
        $b = rand(-10, 10);

        $functie = "f(x) = ";
        if ($a == 1) {
            $functie .= "x";
        } elseif ($a == -1) {
            $functie .= "-x";
        } else {
            $functie .= $a . "x";
        }

        if ($b > 0) {
            $functie .= " + " . $b;
        } elseif ($b < 0) {
            $functie .= " - " . abs($b);
        }

        $nulpunt = -$b / $a;
        $nulpuntStr = fractiemogelijk($nulpunt);
        $nul = "Nulwaarde: x = " . $nulpuntStr;

        // Puntjes in tekenverloop
        $tekenverloop = "Tekenverloop:\n";
       if ($a > 0) {
    $tekenverloop .= " - voor x < $nulpuntStr\n";
    $tekenverloop .= ", 0 voor x = $nulpuntStr\n";
    $tekenverloop .= ", + voor x > $nulpuntStr";
} else {
    $tekenverloop .= " + voor x < $nulpuntStr\n";
    $tekenverloop .= ", 0 voor x = $nulpuntStr\n";
    $tekenverloop .= ", - voor x > $nulpuntStr";

        }

        $stijging = "Functie is: " . (($a > 0) ? "Stijgend" : "Dalend");

        // Samenstellen zonder lijnen en met lege regels ertussen
        $oplossing = $nul . "\n\n"
                    . $tekenverloop . "\n\n"
                    . $stijging;

        $stamp = "13." . $a . $b;

        return new Oefening($this->titel, $functie, $oplossing, $stamp);
    }
}
?>
