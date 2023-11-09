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
		$i = random_int(11,12);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		//Korting
		$a			= random_int(101,499);
		$b			= random_int($a,999);
		$zinnen		= array(
						"De prijs van € #b zakt door een korting tot € #a. Hoeveel procent bedroeg de korting? ",
						"Vorige week waren er #b besmettingen, deze week #a. Met hoeveel procent zakte het aantal besmettingen?",
						"Je kocht cryptomunten ter waarde van € #b. Ze zijn nu € #a waard. Hoeveel procent zakte de waarde?",
						"De fuif trok vorig jaar #b bezoekers, dit jaar zijn het er #a. Met hoeveel procent zakte het aantal?",
					);
		$zin		= strReplaceAssoc(array("#a"=>puntkomma($a),"#b"=>puntkomma($b)), $zinnen[random_int(0, count($zinnen)-1)]);
		$opgave		= "\\)".$zin."\\(";
		$r			= ($b-$a)/$b*100;
		$oplossing	= "\\frac{".$b."-".$a."}{".$b."}\\times 100";
		$oplossing.= "\\approx ".puntkomma(round($r,2))."\%";
		$stamp		= '11.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		//Korting
		$b			= random_int(101,499);
		$a			= random_int($b,999);
		$zinnen		= array(
						"Je verhoogt je inkomsten van een taartenverkoop van € #b naar € #a. Met hoeveel procent stegen je inkomsten?",
						"Vorige week waren er #b besmettingen, deze week #a. Met hoeveel procent stegen het aantal besmettingen?",
						"Je kocht cryptomunten ter waarde van € #b. Ze zijn nu € #a waard. Hoeveel procent steeg de waarde?",
						"De fuif trok vorig jaar #b bezoekers, dit jaar zijn het er #a. Met hoeveel procent steeg het aantal?",
					);
		$zin		= strReplaceAssoc(array("#a"=>puntkomma($a),"#b"=>puntkomma($b)), $zinnen[random_int(0, count($zinnen)-1)]);
		$opgave		= "\\)".$zin."\\(";
		$r			= ($a-$b)/$b*100;
		$oplossing	= "\\frac{".$a."-".$b."}{".$b."}\\times 100";
		$oplossing.= "\\approx ".puntkomma(round($r,2))."\%";
		$stamp		= '12.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
