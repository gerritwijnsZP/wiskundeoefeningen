<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
//require_once(LIB . "class.hoek.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		//$breuken = array(1, 2, 3, 4, 5, 6, 9, 10, 12, 15, 18, 20, 30, 36, 45, 60, 90, 180);
		$teller = rand(2,12);
		$noemer = pow(10, rand(1,2));
		//$ggd = ggd($teller, $noemer);
		//if($ggd != 1){ $teller /= $ggd; $noemer /= $ggd;}
		$rad 	= $teller / $noemer;
		$opgave = puntkomma($rad) . "\\pi \\text{ rad}";
		$oplossing = $opgave;
		$oplossing .= "= \\frac{".$teller."}{".$noemer."} . 180^\circ";
		
		/*
		$ggd = ggd($teller, $noemer);
		if($ggd != 1){ $teller /= $ggd; $noemer /= $ggd;}
		if($noemer == 1)
		{
			$oplossing .= "= $teller^\circ";
		}else{
			$oplossing .= "= \\frac{".$teller."}{".$noemer."} .^\circ";
		}
		*/
		$noemer /= 10;
		if($noemer == 1)
		{
			$oplossing	.= "= $teller . 18^\circ";
		}elseif($noemer == 10)
		{
			$oplossing	.= "= \\frac{".$teller." . 18^\circ}{10}";
		}
		$teller *= 18;
		$oplossing	.= "=".puntkomma($teller/$noemer)."^\circ"; 
		$stamp		= "$rad"; 
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
