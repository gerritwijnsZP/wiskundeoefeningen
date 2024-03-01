<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';
/*
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);
*/
require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,14);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$a	= nietnul(-10,10);
		$b	= nietnul(-10,10);
		$opgave = "(".p($a,2).").(".p($b,2).")=";
		$oplossing = $opgave . p($a*$b,2);
		$stamp		= "$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef12()
	{	
		$a	= nietnul(-10,10);
		$b	= nietnul(-10,10);
		$opgave = "(".p($a*$b,2)."):(".p($b,2).")=";
		$oplossing = $opgave . p($a,2);
		$stamp		= "$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef13()
	{	
		$a	= nietnul(-10,10);
		$b	= nietnul(-10,10);
		if($b < 0)
		{
			$opgave = $a.".(".p($b,2).")=";
		}else{
			$opgave = $a.".".$b."=";
		}
		$oplossing = $opgave . p($a*$b,2);
		$stamp		= "$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
	private function oef14()
	{	
		$a	= nietnul(-10,10);
		$b	= nietnul(-10,10);
		if($b < 0)
		{
			$opgave = ($a*$b).":(".p($b,2).")=";
		}else{
			$opgave = ($a*$b).":".$b."=";	
		}
		$oplossing = $opgave . p($a,2);
		$stamp		= "$a.$b";
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
