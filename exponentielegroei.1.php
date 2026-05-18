<?php
require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
    public function run()
    {
        $i = random_int(11, 11);
        return call_user_func(array($this, "oef" . $i));
    }

    private function oef11()
    {
        $beginwaarde = rand(1, 20) * 500;           // Veelvoud van 500, tussen 500 en 10000
        $interest = round(rand(10, 80) / 10, 1);    // Interest tussen 1% en 8% (stap 0.1%)
        $jaren = rand(3, 15);                        // Looptijd tussen 3 en 15 jaar
        $groeifactor = 1 + $interest / 100;
        $eindwaarde = round($beginwaarde * pow($groeifactor, $jaren), 2);

        $type = rand(1, 4);

        if ($type == 1) {
            $opgave = "\\text{Een kapitaal van } ".$beginwaarde." \\text{ euro wordt aan } ".$interest."\\% \\text{ uitgezet voor } ".$jaren." \\text{ jaar.}";
            $opgave .= " \\\\ \\text{Wat is het eindbedrag?}";

            $oplossing = $opgave;
            $oplossing .= "\\\\ \\textbf{Stap 1: Bepaal de groeifactor}";
            $oplossing .= "\\\\ g = 1 + \\frac{".$interest."}{100} = ".round($groeifactor, 4);
            $oplossing .= "\\\\ \\textbf{Stap 2: Bereken het eindbedrag}";
            $oplossing .= "\\\\ E = B \\cdot g^t = ".$beginwaarde." \\cdot ".round($groeifactor, 4)."^{".$jaren."}";
            $oplossing .= "\\\\ E = ".$beginwaarde." \\cdot ".round(pow($groeifactor, $jaren), 6);
            $oplossing .= "\\\\ \\boxed{E = ".$eindwaarde." \\text{ euro}}";

        } elseif ($type == 2) {
            $groeifactor_berekend = round(pow($eindwaarde / $beginwaarde, 1 / $jaren), 4);
            $interest_berekend = round(($groeifactor_berekend - 1) * 100, 2);

            $opgave = "\\text{Een kapitaal van } ".$beginwaarde." \\text{ euro groeit na } ".$jaren." \\text{ jaar naar } ".$eindwaarde." \\text{ euro.}";
            $opgave .= " \\\\ \\text{Welke interest werd toegepast?}";

            $oplossing = $opgave;
            $oplossing .= "\\\\ \\textbf{Stap 1: Bereken de groeifactor}";
            $oplossing .= "\\\\ g = \\left(\\frac{E}{B}\\right)^{\\frac{1}{t}} = \\left(\\frac{".$eindwaarde."}{".$beginwaarde."}\\right)^{\\frac{1}{".$jaren."}} = ".$groeifactor_berekend;
            $oplossing .= "\\\\ \\textbf{Stap 2: Bepaal de interest}";
            $oplossing .= "\\\\ i = (g - 1) \\cdot 100 = (".$groeifactor_berekend." - 1) \\cdot 100";
            $oplossing .= "\\\\ \\boxed{i = ".$interest_berekend."\\%}";

        } elseif ($type == 3) {
            $jaren_berekend = round(log($eindwaarde / $beginwaarde) / log($groeifactor), 2);

            $opgave = "\\text{Een kapitaal van } ".$beginwaarde." \\text{ euro groeit naar } ".$eindwaarde." \\text{ euro bij een interest van } ".$interest."\\%.";
            $opgave .= " \\\\ \\text{Hoe lang duurde dit?}";

            $oplossing = $opgave;
            $oplossing .= "\\\\ \\textbf{Stap 1: Bepaal de groeifactor}";
            $oplossing .= "\\\\ g = 1 + \\frac{".$interest."}{100} = ".round($groeifactor, 4);
            $oplossing .= "\\\\ \\textbf{Stap 2: Bereken de tijd via logaritme}";
            $oplossing .= "\\\\ t = \\frac{\\log\\left(\\frac{E}{B}\\right)}{\\log(g)} = \\frac{\\log\\left(\\frac{".$eindwaarde."}{".$beginwaarde."}\\right)}{\\log(".round($groeifactor, 4).")}";
            $oplossing .= "\\\\ t = \\frac{".round(log10($eindwaarde / $beginwaarde), 6)."}{".round(log10($groeifactor), 6)."}";
            $oplossing .= "\\\\ \\boxed{t = ".$jaren_berekend." \\text{ jaar}}";

        } else {
            $beginwaarde_berekend = round($eindwaarde / pow($groeifactor, $jaren), 2);

            $opgave = "\\text{Na } ".$jaren." \\text{ jaar aan } ".$interest."\\% \\text{ interest heb je } ".$eindwaarde." \\text{ euro.}";
            $opgave .= " \\\\ \\text{Met welk beginkapitaal ben je gestart?}";

            $oplossing = $opgave;
            $oplossing .= "\\\\ \\textbf{Stap 1: Bepaal de groeifactor}";
            $oplossing .= "\\\\ g = 1 + \\frac{".$interest."}{100} = ".round($groeifactor, 4);
            $oplossing .= "\\\\ \\textbf{Stap 2: Bereken het beginkapitaal}";
            $oplossing .= "\\\\ B = \\frac{E}{g^t} = \\frac{".$eindwaarde."}{".round($groeifactor, 4)."^{".$jaren."}}";
            $oplossing .= "\\\\ B = \\frac{".$eindwaarde."}{".round(pow($groeifactor, $jaren), 6)."}";
            $oplossing .= "\\\\ \\boxed{B = ".$beginwaarde_berekend." \\text{ euro}}";
        }

        $stamp = "11." . $type . $beginwaarde . $interest . $jaren;
        return new Oefening("Exponentiële groei", $opgave, $oplossing, $stamp);
    }
}
?>
