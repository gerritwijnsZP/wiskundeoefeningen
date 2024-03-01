<?php
require $_SERVER["DOCUMENT_ROOT"] . '/config.php';

ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once(LIB . "class.oefening.php");
require_once(LIB . "class.math.php");
require_once(LIB . "class.helper.php");
//require_once(LIB . "class.rational.php");
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
		$e			= rand(2,9);
		$f			= rand(11-$e, 9);
		$opgave 	= $e." + " . $f ." = ";
		$oplossing 	= "\\begin{align} & $e + $f \\\\";
		if($e < $f  && $e < 5){ 
			$x = $e; $e = $f; $f = $x;
			$oplossing .= "= & $e + $f \\\\";
		}
		$oplossing .= "= & $e + ".color("green",10-$e)."+".color("red",$f+$e-10)."\\\\";
		$oplossing .= "= & ".color("green",10)." +".color("red",$f+$e-10)."\\\\";
		$oplossing .= "= & ".color("red",$e+$f) ."\\end{align}";
		$stamp		= $e.$f;
		return new Oefening($this->titel,$opgave, $oplossing, $stamp);
	}
}
?>
