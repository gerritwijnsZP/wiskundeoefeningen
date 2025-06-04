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
        $puntXCoördinaat = rand(-10, 10);
        $puntYCoördinaat = rand(-10, 10);
        $waardeVanABijVergelijkingRechte = rand(-10, 10);
        $waardeVanBBijVergelijkingRechte = rand(-10, 10);
        $waardeVanCBijVergelijkingRechte = rand(-10, 10);
        if (($waardeVanABijVergelijkingRechte==0)&&($waardeVanBBijVergelijkingRechte==0)){
            $waardeVanABijVergelijkingRechte =  rand(1, 10);
        }
        $teken1 = "";
        $teken2 = "";
        if ($waardeVanABijVergelijkingRechte < 0) {
            $AfdrukwaardeVanABijVergelijkingRechte  = "(".$waardeVanABijVergelijkingRechte.")";
        } else {
            $AfdrukwaardeVanABijVergelijkingRechte  = $waardeVanABijVergelijkingRechte;
        }
        if ($waardeVanBBijVergelijkingRechte < 0) {
            $teken1 = "-";
            $AfdrukwaardeVanBBijVergelijkingRechte  = "(".$waardeVanBBijVergelijkingRechte.")";
        } else {
            $teken1 = "+";
            $AfdrukwaardeVanBBijVergelijkingRechte  = $waardeVanBBijVergelijkingRechte;
        }
        if ($waardeVanCBijVergelijkingRechte < 0) {
            $teken2 = "-";
        } else {
            $teken2 = "+";
        }
        if ($puntXCoördinaat < 0) {
            $afdrukpuntXCoördinaat = "(".$puntXCoördinaat.")";
        } else {
            $afdrukpuntXCoördinaat = $puntXCoördinaat;
        }
        if ($puntYCoördinaat < 0) {
            $afdrukpuntYCoördinaat = "(".$puntYCoördinaat.")";
        } else {
            $afdrukpuntYCoördinaat = $puntYCoördinaat;
        }

        $opgave = "\\textbf{Geg: } \\text{De rechte a: " . $waardeVanABijVergelijkingRechte . "x " . $teken1 . " " . abs($waardeVanBBijVergelijkingRechte) . "y ". $teken2 . " " . abs($waardeVanCBijVergelijkingRechte) . "=0 en middelpunt P(". $puntXCoördinaat. ",". $puntYCoördinaat.")" . "} \\\\ "
                . "\\textbf{Gevr: } \\text{De afstand d(P,a): }";

        $oplossing =$opgave."\\\\";
        $oplossing .= "d(P,a) = \\frac{\\left| u.x_1+v.y_1+w  \\right|  }{ \\sqrt{u^2 + v^2}}";
        $oplossing .= " = \\frac{\\left| " .
        $waardeVanABijVergelijkingRechte . " \\cdot " . $afdrukpuntXCoördinaat . " " .
        $teken1 . " " . abs($waardeVanBBijVergelijkingRechte) . " \\cdot " . $afdrukpuntYCoördinaat . " " .
        $teken2 . " " . abs($waardeVanCBijVergelijkingRechte) .
        " \\right|}{\\sqrt{" . $AfdrukwaardeVanABijVergelijkingRechte . "^2 + " . $AfdrukwaardeVanBBijVergelijkingRechte . "^2}} = ". abs(($waardeVanABijVergelijkingRechte * $puntXCoördinaat) + ($waardeVanBBijVergelijkingRechte * $puntYCoördinaat) + $waardeVanCBijVergelijkingRechte) / sqrt($waardeVanABijVergelijkingRechte ** 2 + $waardeVanBBijVergelijkingRechte ** 2);
        $afstand = abs(($waardeVanABijVergelijkingRechte * $puntXCoördinaat) + ($waardeVanBBijVergelijkingRechte * $puntYCoördinaat) + $waardeVanCBijVergelijkingRechte) / sqrt($waardeVanABijVergelijkingRechte ** 2 + $waardeVanBBijVergelijkingRechte ** 2);
        $stamp = "P(" . $puntXCoördinaat . "," . $puntYCoördinaat . "), d = " . round($afstand, 2);
        return new Oefening($this->titel, $opgave, $oplossing, $stamp);

     

    }

}

?>