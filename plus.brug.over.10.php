<?php

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once("class.oefening.php");
require_once("class.math.php");
require_once("class.helper.php");
//require_once("class.rational.php");
//require_once("class.hoek.php");

class Fabriek extends OefeningFactory
{
	public function run()
	{
		$i = random_int(11,11);
		return call_user_func(array($this,"oef".$i));
	}
	private function oef11()
	{	
		$e			= rand(5,9);
		$f			= rand(11-$e, 6);
		$opgave 	= $e." + " . $f ." = ";
		$oplossing 	= "\\begin{align} & $e + $f \\\\";
		$oplossing .= "= & $e + ".(10-$e)."+".($f+$e-10)."\\\\";
		$oplossing .= "= & 10 +".($f+$e-10)."\\\\";
		$oplossing .= "= & ".($e+$f) ."\\end{align}";
		$stamp		= $e.$f;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
