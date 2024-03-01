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
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{
		$z	= array(2,3,4,5,6,7,8,9,11,12,13,14,15,16,17,18,19)[rand(0,16)];
		$x  = pow($z,2);
		$y	= pow(10, 2* rand(1,2));
		$a = $x/$y;
		$opgave		= "\\sqrt{".puntkomma($a)."}";
		$oplossing	= $opgave;
		$oplossing .= "=\\sqrt{\\frac{".$x." }{ ".$y."}}";
		$oplossing .= "=\\frac{".vkw($x). "}{".vkw($y)."}";
		$oplossing .= "=\\frac{".ivkw($x)."}{".ivkw($y)."}";
		$ggd= ggd(ivkw($x), ivkw($y));
		if($ggd != 0)
		{
			$oplossing .= "=\\frac{".(ivkw($x)/$ggd )."}{".(ivkw($y)/$ggd)."}";
		}
		$stamp		= '11.'.$a;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
