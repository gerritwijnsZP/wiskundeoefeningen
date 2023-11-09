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
		$a			= random_int(101,999);
		$k			= random_int(1,14)*5;
		$zinnen		= array(
						"Je krijgt #k% korting op een aankoop van € #a. Hoeveel betaal je?",
						"Vorige week waren er #a besmettingen, deze week #k% minder. Hoeveel besmettingen zijn er deze week?",
						"Je kocht cryptomunten ter waarde van €#a. Ze daalden #k% in waarde. Hoeveel zijn ze nog waard?",
						"De fuif trok vorig jaar #a bezoekers. Dit jaar zijn het er #k% minder. Hoeveel zijn er dat?",
					);
		$zin		= strReplaceAssoc(array("#a"=>puntkomma($a),"#k"=>$k), $zinnen[random_int(0, count($zinnen)-1)]);
		$opgave		= "\\)".$zin."\\(";
		$r			= $a*(1-$k/100);
		$oplossing	= puntkomma($a)."- $k\%=".puntkomma($r);
		if($r !== round($r))
		{
			$oplossing.= "\\approx ".puntkomma(round($r));
		}
		$stamp		= '11.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{
		//Korting
		$a			= random_int(101,999);
		$k			= random_int(1,14)*5;
		$zinnen		= array(
						"Je wint bij een kansspel #k% bovenop je inzet van € #a. Hoeveel heb je nu in totaal?",
						"Vorige week waren er #a besmettingen, deze week #k% meer. Hoeveel besmettingen zijn er deze week?",
						"Je kocht cryptomunten ter waarde van €#a. Ze stegen #k% in waarde. Hoeveel zijn ze nu waard?",
						"De fuif trok vorig jaar #a bezoekers. Nu zijn het er #k% meer. Hoeveel bezoekers zijn er nu?",
					);
		$zin		= strReplaceAssoc(array("#a"=>puntkomma($a),"#k"=>$k), $zinnen[random_int(0, count($zinnen)-1)]);
		$opgave		= "\\)".$zin."\\(";
		$r			= $a*(1+$k/100);
		$oplossing	= puntkomma($a)."+ $k\%=".puntkomma($r);
		if($r !== round($r))
		{
			$oplossing.= "\\approx ".puntkomma(round($r));
		}
		$stamp		= '12.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
