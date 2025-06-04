<?php
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
    public function run()
    {
        $i = random_int(11,11);
        return call_user_func(array($this,"oef".$i));
    }

    private function oef11()
    {
        // Drie willekeurige niet-collineaire punten
        do {
            $A = [rand(-10, 10), rand(-10, 10)];
            $B = [rand(-10, 10), rand(-10, 10)];
            $C = [rand(-10, 10), rand(-10, 10)];
        } while ($this->collinear($A, $B, $C));

        $opgave = "\\text{Gegeven de driehoek met hoekpunten } A(".$A[0].",".$A[1]."), B(".$B[0].",".$B[1]."), C(".$C[0].",".$C[1].")\\text{.} \\\\ \\text{Bepaal het middelpunt en de straal van de ingeschreven cirkel.}";

        // Bereken de lengtes van de zijden
        $a = $this->afstand($B, $C);
        $b = $this->afstand($A, $C);
        $c = $this->afstand($A, $B);

        // Halve omtrek
        $s = ($a + $b + $c) / 2;

        // Straal van de ingeschreven cirkel
        $oppervlakte = sqrt($s * ($s - $a) * ($s - $b) * ($s - $c));
        $r = $oppervlakte / $s;

        // Middelpunt van de ingeschreven cirkel
        $Px = ($a * $A[0] + $b * $B[0] + $c * $C[0]) / ($a + $b + $c);
        $Py = ($a * $A[1] + $b * $B[1] + $c * $C[1]) / ($a + $b + $c);

        // Opgave en oplossing
        $oplossing = $opgave;
        $oplossing .= "\\\\ \\textbf{Stap 1: Bereken de lengtes van de zijden}";
        $oplossing .= "\\\\ a = |BC| = ".round($a,2).",\\quad b = |AC| = ".round($b,2).",\\quad c = |AB| = ".round($c,2);

        $oplossing .= "\\\\ \\textbf{Stap 2: Bereken de halve omtrek}";
        $oplossing .= "\\\\ s = \\frac{a+b+c}{2} = ".round($s,2);

        $oplossing .= "\\\\ \\textbf{Stap 3: Bereken de oppervlakte van de driehoek}";
        $oplossing .= "\\\\ \\text{Oppervlakte} = \\sqrt{s(s-a)(s-b)(s-c)} = ".round($oppervlakte,2);

        $oplossing .= "\\\\ \\textbf{Stap 4: Straal van de ingeschreven cirkel}";
        $oplossing .= "\\\\ r = \\frac{\\text{Oppervlakte}}{s} = ".round($r,2);

        $oplossing .= "\\\\ \\textbf{Stap 5: Middelpunt van de ingeschreven cirkel}";
        $oplossing .= "\\\\ P = \\left( \\frac{aA_x + bB_x + cC_x}{a+b+c}, \\frac{aA_y + bB_y + cC_y}{a+b+c} \\right) = (".round($Px,2).", ".round($Py,2).")";

        $stamp = "11.".$A[0].$A[1].$B[0].$B[1].$C[0].$C[1];
        return new Oefening("Ingeschreven cirkel van een driehoek", $opgave, $oplossing, $stamp);
    }

    private function afstand($P, $Q)
    {
        return sqrt(pow($P[0] - $Q[0], 2) + pow($P[1] - $Q[1], 2));
    }

    private function collinear($A, $B, $C)
    {
        // Controleer of de punten collineair zijn
        return ($B[0] - $A[0]) * ($C[1] - $A[1]) == ($C[0] - $A[0]) * ($B[1] - $A[1]);
    }
}
?>