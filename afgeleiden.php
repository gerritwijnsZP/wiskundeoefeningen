<?php
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
    public function run()
    {
        return $this->oef1();
    }

    private function oef1()
    {
        $mogelijkeMachten = [-3, -2, -1, 1, 2, 3, 4, 5, 6];
        shuffle($mogelijkeMachten);
        $aantalTermen = rand(2, 4);
        $machten = array_slice($mogelijkeMachten, 0, $aantalTermen);
        rsort($machten); // Grootste macht eerst

        $termen    = [];
        $afgeleide = [];

        foreach ($machten as $n) {
            do { $a = rand(-6, 6); } while ($a == 0);

            // Schrijf de term in LaTeX
            if ($n < 0) {
                $absN = abs($n);
                $termen[] = ($a == 1 ? "" : ($a == -1 ? "-" : $a)) . "\\frac{1}{x^{$absN}}";
            } elseif ($n == 1) {
                $termen[] = "{$a}x";
            } else {
                $termen[] = "{$a}x^{$n}";
            }

            // Bereken de afgeleide
            $da = $a * $n;
            $dn = $n - 1;

            if ($dn == 0) {
                $afgeleide[] = "{$da}";
            } elseif ($dn == 1) {
                $afgeleide[] = "{$da}x";
            } elseif ($dn < 0) {
                $absdn = abs($dn);
                $afgeleide[] = "\\frac{{$da}}{x^{$absdn}}";
            } else {
                $afgeleide[] = "{$da}x^{$dn}";
            }
        }

        $fx  = implode(" + ", $termen);
        $dfx = implode(" + ", $afgeleide);

        $opgave = "\\text{Bereken de afgeleide van } f(x) = " . $fx;

        $oplossing  = $opgave;
        $oplossing .= "\\\\ \\textbf{Leid elke term apart af (machtregel: } (ax^n)' = a \\cdot n \\cdot x^{n-1}\\textbf{)}";

        foreach ($machten as $i => $n) {
            $oplossing .= "\\\\ (" . $termen[$i] . ")' = " . $afgeleide[$i];
        }

        $oplossing .= "\\\\ \\boxed{f'(x) = " . $dfx . "}";

        $stamp = "1." . implode(".", $machten);
        return new Oefening("Afgeleide — willekeurige machten en breuken", $opgave, $oplossing, $stamp);
    }
}
?>