<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");

class Fabriek extends OefeningFactory
{
    public function run()
    {
        $i = random_int(1, 2);
        return call_user_func(array($this, "oef" . $i));
    }

    // Oefening 1: Middelpunt bepalen op basis van 2 punten
    private function oef1()
    {
        // Genereer twee punten A en B
        $xA = rand(-8, 8);
        $yA = rand(-8, 8);
        $xB = rand(-8, 8);
        $yB = rand(-8, 8);
        
        // Zorg dat de punten niet samenvallen
        while($xA == $xB && $yA == $yB) {
            $xB = rand(-8, 8);
            $yB = rand(-8, 8);
        }

        // Bereken het middelpunt M
        $xM = ($xA + $xB) / 2;
        $yM = ($yA + $yB) / 2;

        // Formattering voor mooie weergave
        $xM_formatted = ($xM == floor($xM)) ? (int)$xM : number_format($xM, 1);
        $yM_formatted = ($yM == floor($yM)) ? (int)$yM : number_format($yM, 1);

//        $opgave = "Bepaal het middelpunt van het lijnstuk AB met A({$xA}, {$yA}) en B({$xB}, {$yB}).";
        $opgave = "\\text{Bepaal het midden van het lijnstuk AB met A({$xA}, {$yA}) en B({$xB}, {$yB})." . " "   . "} \\\\ ";
        $oplossing = $opgave . "\\\\\\\\";
        $oplossing .= "\\text{Het midden M wordt berekend met de formule:}\\\\";
        $oplossing .= "M = \\left(\\frac{x_A + x_B}{2}, \\frac{y_A + y_B}{2}\\right)\\\\\\\\";
        $oplossing .= "M = \\left(\\frac{{$xA} + ({$xB})}{2}, \\frac{{$yA} + ({$yB})}{2}\\right)\\\\";
        $oplossing .= "M = \\left(\\frac{" . ($xA + $xB) . "}{2}, \\frac{" . ($yA + $yB) . "}{2}\\right)\\\\";
        $oplossing .= "M = ({$xM_formatted}, {$yM_formatted})";

        $stamp = "M({$xA},{$yA})({$xB},{$yB})";

        return new Oefening($this->titel, $opgave, $oplossing, $stamp);
    }

    // Oefening 2: Zwaartepunt bepalen op basis van 3 punten van een driehoek
    private function oef2()
    {
        // Genereer drie punten A, B en C
        $xA = rand(-6, 6);
        $yA = rand(-6, 6);
        $xB = rand(-6, 6);
        $yB = rand(-6, 6);
        $xC = rand(-6, 6);
        $yC = rand(-6, 6);
        
        // Zorg dat de punten niet collineair zijn (eenvoudige controle)
        while(($xB - $xA) * ($yC - $yA) == ($yB - $yA) * ($xC - $xA)) {
            $xC = rand(-6, 6);
            $yC = rand(-6, 6);
        }
        // Bereken het zwaartepunt Z
        $xZ = ($xA + $xB + $xC) / 3;
        $yZ = ($yA + $yB + $yC) / 3;

        // Formattering voor mooie weergave
        $xZ_formatted = ($xZ == floor($xZ)) ? (int)$xZ : number_format($xZ, 2);
        $yZ_formatted = ($yZ == floor($yZ)) ? (int)$yZ : number_format($yZ, 2);

        $opgave = "\\text{Bepaal het zwaartepunt van driehoek ABC met A({$xA}, {$yA}), B({$xB}, {$yB}) en C({$xC}, {$yC})." . " "   . "} \\\\ ";
        $oplossing = $opgave . "\\\\\\\\";
        $oplossing .= "\\text{Het zwaartepunt Z wordt berekend met de formule:}\\\\";
        $oplossing .= "Z = \\left(\\frac{x_A + x_B + x_C}{3}, \\frac{y_A + y_B + y_C}{3}\\right)\\\\\\\\";
        $oplossing .= "Z = \\left(\\frac{{$xA} + ({$xB}) + ({$xC})}{3}, \\frac{{$yA} + ({$yB}) + ({$yC})}{3}\\right)\\\\";
        $oplossing .= "Z = \\left(\\frac{" . ($xA + $xB + $xC) . "}{3}, \\frac{" . ($yA + $yB + $yC) . "}{3}\\right)\\\\";
        $oplossing .= "Z = ({$xZ_formatted}, {$yZ_formatted})";

        $stamp = "Z({$xA},{$yA})({$xB},{$yB})({$xC},{$yC})";

        return new Oefening($this->titel, $opgave, $oplossing, $stamp);
    }
}