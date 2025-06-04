<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");
require_once("class.hoek.php");
require_once("class.rational.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
    private function oef11()
    {
    $straal = rand(1, 10);
    $middelpuntXcoördinaat = rand(-10, 10);
    $middelpuntYcoördinaat = rand(-10, 10);

    $tekenX = "";
    $tekenY = "";
    $tekenSomKwadraten = "";

    if ($middelpuntXcoördinaat > 0) {
        $tekenX = "-";
    } else {
        $tekenX = "+";
    }
    if ($middelpuntYcoördinaat > 0) {
        $tekenY = "-";
    } else {
        $tekenY = "+";
    }
    if (($middelpuntXcoördinaat**2 + $middelpuntYcoördinaat**2) - $straal**2 < 0) {
        $tekenSomKwadraten = "-";
    } else {
        $tekenSomKwadraten = "+";
    }

 
    if ($middelpuntXcoördinaat == 0) {
        $tekenX = "";
    }
    if ($middelpuntYcoördinaat == 0) {
        $tekenY = "";
    }
    $verschil = ($middelpuntXcoördinaat**2 + $middelpuntYcoördinaat**2) - $straal**2;
    if ($verschil == 0) {
        $tekenSomKwadraten = "";
    }

    $opgave = "\\text{O(" . $middelpuntXcoördinaat . ", " . $middelpuntYcoördinaat . ") en r = " . $straal . "} \\\\ ";

    $oplossing = $opgave."\\\\";
    $oplossing .= "\\textbf{Middelpuntsvergelijking: } (x " . $tekenX . " " . abs($middelpuntXcoördinaat) . ")^2 + (y " . $tekenY . " " . abs($middelpuntYcoördinaat) . ")^2 = " . ($straal ** 2). "\\\\";

    $oplossing .= "\\textbf{Algemene vorm: } x^2 + y^2 "
                . $tekenX . " " . abs(($middelpuntXcoördinaat * 2)) . "x "
                . $tekenY . " " . abs(($middelpuntYcoördinaat * 2)) . "y "
                . $tekenSomKwadraten . " " . abs($verschil) . " = 0";

    $stamp = "O(" . $middelpuntXcoördinaat . "," . $middelpuntYcoördinaat . "), r=" . $straal;
    return new Oefening($this->titel, $opgave, $oplossing, $stamp);
    }


    }

?>