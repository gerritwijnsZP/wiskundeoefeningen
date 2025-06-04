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

    // Oefening 1: Exponentiële vorm → Logaritmische vorm
    private function oef1()
    {
        // Voorbeeld: 2^5 = 32 → log_2(32) = 5
        $grondtal = rand(2, 9);
        $exponent = rand(2, 5);
        $uitkomst = pow($grondtal, $exponent);

        $opgave = "{$grondtal}^{{$exponent}} = {$uitkomst}";
        $oplossing  = $opgave;
        $oplossing .= " \\Rightarrow \\log_{{$grondtal}}({$uitkomst}) = {$exponent}";
        $stamp = "{$grondtal}^{$exponent}";

        return new Oefening($this->titel, $opgave, $oplossing, $stamp);
    }

    // Oefening 2: Logaritmische vorm → Exponentiële vorm
    private function oef2()
    {
        // Voorbeeld: log_3(81) = 4 → 3^4 = 81
        $grondtal = rand(2, 5);
        $exponent = rand(2, 4);
        $uitkomst = pow($grondtal, $exponent);

        $opgave = "\\log_{{$grondtal}}({$uitkomst}) = {$exponent}";
        $oplossing = $opgave;
        $oplossing .= " \\Rightarrow {$grondtal}^{{$exponent}} = {$uitkomst}";
        $stamp = "log{$grondtal}({$uitkomst})={$exponent}";

        return new Oefening($this->titel, $opgave, $oplossing, $stamp);
    }
}
